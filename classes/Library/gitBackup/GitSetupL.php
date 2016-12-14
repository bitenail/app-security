<?php
/**
 * Created by PhpStorm.
 * User: suraj
 * Date: 29/04/2016
 * Time: 2:41 PM
 */
if (!defined('OSE_FRAMEWORK') && !defined('OSE_ADMINPATH') && !defined('_JEXEC'))
{
    die('Direct Access Not Allowed');
}
//require_once (dirname(__FILE__)."/Process.php");
oseFirewall::callLibClass('gitBackup', 'GitSetup');

class GitSetupL extends GitSetup{

    public function stageAllChanges($path)
    {
        //rest of the files indicate the remainaing file in the website directory except the folders
        if($path == "restoffiles")
        {
            $gitCmd = "git add --all";
        }
        else {
            $gitCmd = "git add ".OSE_ABSPATH.ODS.$path;
        }
        $output = $this->runShellCommand($gitCmd);
        if((strpos($output['stderr'], 'fatal') !== false)||(strpos($output['stderr'], 'error') !== false))
        {
            //ERROR : some problem with stagging the file
            $result['status'] = 0;
            $result['info'] = "There was some problem in stagging the files of ".$path."folder ERROR :".$output['stderr'];
        }
        else {
            //SUCCESS : the changes were staged successfully
            $result['status'] = 1;
            $result['info'] = "The Changes were stagged successfully";
        }
        return $result;
    }

    //returns the list of the folders in the website directory
    public function getFoldersList($path)      //path should not contain "/" at the end
    {
        $gitCmd = "cd ".$path.ODS."; ls -d */";
        $output = $this->runShellCommand($gitCmd);
        $output = preg_replace('/\s+/', '', $output['stdout']);
        $list = explode("/",$output);
        $newlist = array_filter($list);
        //reverse the list as the last element is popperd first
        $reversedList = array_reverse($newlist);
        return $reversedList;
    }


    //writes the list of folders in a temporary file named "folderlist"
    public function writeFolderList($list, $backedupfolers)
    {
        //$folderlist
        $content = "<?php\n" . '$folderslist = array("folderslist"=>' . var_export($list, true) . ', "backedupfolders" =>' . var_export($backedupfolers, true) . ");";
        $this->writeFile(FOLDER_LIST, $content);
    }

    //Deletes the folder list when all the folders are committed
    public function DeleteFolderListTable()
    {
        if(file_exists(FOLDER_LIST))
        {
            unlink(FOLDER_LIST);
        }
    }

    //return the list of folders from the temp file
    public function getFolderListFromFile()
    {
        $folderlist= array();
        if (file_exists(FOLDER_LIST)) {
            require(FOLDER_LIST);
        }
        return $folderslist;

    }
    protected function addIndexFile ($filepath) {
        touch($filepath.ODS.'.gitkeep');
    }

    //commit the changes
    public function commitChanges($type = false, $foldername)
    {
        $gitsetup =$this->loadgitLibrabry();
        $filepath = OSE_ABSPATH.ODS.$foldername;
        if($foldername == "restoffiles")
        {
            $commitMessagePrefix = $gitsetup->getCommitMessages($type,$foldername);
            $gitCmd = "git commit -m \"$commitMessagePrefix\"";
        }
        else {
            $commitMessagePrefix = $gitsetup->getCommitMessages($type,$foldername);
            $gitCmd = "git commit -m \"$commitMessagePrefix\" ".$filepath;
        }
        $output = $this->runShellCommand($gitCmd);
        if((strpos($output['stderr'], 'fatal') !== false)||(strpos($output['stderr'], 'error') !== false))
        {
            if (preg_match('/error\:\s*pathspec/', $output['stderr'])) {
                $this->addIndexFile($filepath);
                return $this->enableGitBackup($type);
            }
            //ERROR :problems in committing the changes
            $result['status'] = 0;
            $result['info'] = "There was some problem in commmitting the local changes for the folder ".$foldername."ERROR :".$output['stderr'];
            return $result;
        }
        else{
            $this->insertNewCommitDb();
            //SUCCESS : No problems in committing the changes
            $result['status'] = 1;
            $result['info'] = "The changes were committed successfully ".$commitMessagePrefix;
            return $result;
        }

    }

    public function localBackup($type = false)
    {
        $gitsetup = $this->loadgitLibrabry();
        //check if there are any changes
        $temp = $gitsetup->findChanges();
        if($temp['status'])
        {   //prepare and write the folder list into the file
            $this->prerequisitesforcommit();
//            $result = $this->createLocalBackup($type);
            if(file_exists(FOLDER_LIST))
            {
                //if list of folders w
                $result['status'] = 1; //SUCCESS
                return $result;
            }
            else { //if file was not created
                 $result['status'] = 0 ; //ERROR
                return $result;
            }
        }
        else {
            // if there are no changes, there is no need to commit
            $result['status'] = 2;  //STOP THE BACKUP NO NEED TO COMMIT
            $result['info'] = "The backup is up to date";
            if(file_exists(FOLDER_LIST))
            {
                unlink(FOLDER_LIST);
            }
            return $result;
        }
    }

    public function contLocalBackup($type = false)
    {
        $gitsetup = $this->loadgitLibrabry();
        $temp = $gitsetup->findChanges();
        if($temp['status'])
        {
            $result = $this->createLocalBackup($type);
            return $result;
        }
        else {
            // if there are no changes, there is no need to commit
            $result['status'] = 2;
            $result['info'] = "The backup is up to date";
            if(file_exists(FOLDER_LIST))
            {
                unlink(FOLDER_LIST);
            }
            return $result;
        }
    }


    //things to do before perfroming git init for large websitess
    public function prerequisitesforcommit()
    {
        $this->protectGit();
        oseFirewallBase::callLibClass('backup','oseBackup');
        $ose = new oseBackupManager();
        $ose->moveOldZipFilesPatch();
        $list = $this->getFoldersList(OSE_ABSPATH);
        if(OSE_CMS == "wordpress")
        {
            $new_list = $this->uploadPriotity($list);
            $this->gitIgnoreFile(FOLDER_LIST_GITIGNORE);
            $this->writeFolderList($new_list,array());
        }
        else
        {
            $this->gitIgnoreFile(FOLDER_LIST_GITIGNORE);
            $this->writeFolderList($list,array());
        }

    }

    //Complete mechanism to stage and commit all the changes
    public function createLocalBackup($type = false)
    {
            $result = null;
            $listfromfile = $this->getFolderListFromFile();
            $currentfolder = array_pop($listfromfile['folderslist']);
//            print_r($currentfolder);
            array_push($listfromfile['backedupfolders'], $currentfolder);
            if (!empty($currentfolder)) {
               $result =   $this->folderLocalBackup($currentfolder,$type);
                //if local backup for folders was successful
                if($result['status'] ==1 )
                {   //SUCCESS: folder was backed up successfully
                    $this->writeFolderList($listfromfile['folderslist'],$listfromfile['backedupfolders']);  //update the folderslist
                    return $result;
                }else
                {
                    // return ERROR and do not update the folderslist
                    return $result;
                }

            } else {
                $result =  $this->restofFilesLocalBackup($type);
                return $result;
            }
        }
    
    /*function to backup folders; stages the folders and then commits them
     *
     */
    public function folderLocalBackup($currentfolder, $type)
    {
        $result= $this->stageAllChanges($currentfolder);
        if ($result['status'] == 1) {
            $result = $this->commitChanges($type, $currentfolder);
            if ($result['status'] == 1) {
//                echo "commit result is ";
//                echo"<br/>";
//                print_r($result);
                $return = array("status" => 1 , "type" => $type);
                return $return;
            } else {
                //ERROR : problems in committing the changes
                return $result;
            }

        } else {
            //ERROR : problem in staging the files
            return $result;
        }
    }
    public function restofFilesLocalBackup($type)
    {
        //for rest of the files except the folders
        $currentfolder = "restoffiles";
        $result = $this->stageAllChanges($currentfolder);
        if ($result['status'] == 1)
        {
            $result = $this->commitChanges($type, $currentfolder);
            if ($result['status'] == 1)
            {
                $result['status'] = 4; // 4 => to indicate the end of backup loop
                $result['info'] = "The remaining file have been backed up successfully";
                //delete the files since this is the last step
                $this->DeleteFolderListTable();
                return $result;
            } else
            {
                //ERROR : problems in committing  the changes
                return  $result;
            }
        } else
        {
            //ERROR : problem in staging the files
            return $result;
        }
    }

//    public function createBackupAllFiles($type = false)
//    {
//        $git = $this->callgitLibrabry();
//        if($git->findChanges())
//        {
//
////            $ose->moveOldZipFilesPatch();
////            $this->prerequisitesforinit();
//            $result = $this->enableGitBackup($type);
//            return $result;
//        }else {
//            $return['status'] = 2;
//            $return['info'] = "You have an up to date copy of the backup"; //no changes in the files
//            return $return;
//        }
//
//    }

    public function loadgitLibrabry()
    {
        oseFirewallBase::callLibClass('gitBackup','GitSetup');
        $gitsetup = new GitSetup();
        return $gitsetup;
    }

    public static function aJaxReturns ($result, $status, $msg, $continue=false, $id = null) {
        $return = array (
            'success' => (boolean)$result,
            'status' => $status,
            'result' => $msg,
            'cont' => (boolean)$continue,
            'id' => (int)$id
        );
        $tmp = oseJSON::encode ($return);
        return $tmp;
    }


    //returns list of folders in the wp-content or media folder
//    public function getContentFolderList()
//    {
//        $contentfolderlist = $this->getFoldersList(OSE_CONTENTFOLDER);
//        return $contentfolderlist;
//    }
//
    //write the updated folder list
//    public function writeContentFolderList($list, $backedupfolers)
//    {
//        //$folderlist
//        $content = "<?php\n" . '$folderslist = array("folderslist"=>' . var_export($list, true) . ', "backedupfolders" =>' . var_export($backedupfolers, true) . ");";
//        $this->writeFile(CONTENT_FOLDER_LIST, $content);
//    }

//    //initial setup to start the backup for the folders in the wp-content folder
//    public function contentBackupFolderSetup($type = false)
//    {
//        $list = $this->getContentFolderList();
//        $this->gitIgnoreFile(CONTENT_FOLDER_LIST_GITIGNORE);
//        $this->writeContentFolderList($list,array());
//    }
//
//    public function getContentFolderListFromFile()
//    {
//        $folderlist= array();
//        if (file_exists(CONTENT_FOLDER_LIST)) {
//            require(CONTENT_FOLDER_LIST);
//        }
//        return $folderslist;
//    }


    public function uploadPriotity($list)
    {
        //add the upload folder and content folder to the end of the list
        //so that they will be backed up first
        $foldername = "wp-content";
        $uploadfolder = "wp-content" . ODS . 'uploads';
        $position = array_search($foldername, $list);
        if ($position !== false) {
            array_splice($list, $position, 1);
//            print_r($list); exit;
            array_push($list, $foldername, $uploadfolder);
            return $list;
        }
        else
        {
            return null;
        }
    }



}

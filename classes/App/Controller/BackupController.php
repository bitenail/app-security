<?php
namespace App\Controller;
/**
 * @version     2.0 +
 * @package       Open Source Excellence Security Suite
 * @subpackage    Centrora Security Firewall
 * @subpackage    Open Source Excellence WordPress Firewall
 * @author        Open Source Excellence {@link http://www.opensource-excellence.com}
 * @author        Created on 01-Jun-2013
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 *
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *  @Copyright Copyright (C) 2008 - 2012- ... Open Source Excellence
 */
if (!defined('OSE_FRAMEWORK') && !defined('OSEFWDIR') && !defined('_JEXEC'))
{
    die('Direct Access Not Allowed');
}

class BackupController extends \App\Base
{
    public $layout = '//layouts/grids';

    public function action_GetBackupList()
    {
        $this->model->loadRequest();
        if (isset($_REQUEST['mobiledevice'])) {
            $mobiledevice = oRequest::getInt('mobiledevice', 0);
        } else {
            $mobiledevice = 0;
        }
        $results = $this->model->getBackupList();

        $this->model->returnJSON($results, $mobiledevice);
    }

    public function action_Backup()
    {
        $this->model->loadRequest();
        $backup_type = $this->model->getInt('backup_type', null);
        $backup_to = $this->model->getInt('backup_to', null);
        $result = $this->model->backup($backup_type, $backup_to);
        $this->model->returnJSON($result);
    }

    public function action_contBackup()
    {
        $sourcePath = $this->model->getVar('sourcePath', null);
        $outZipPath = $this->model->getVar('outZipPath', null);
        $serializefile = $this->model->getVar('serializefile', null);
        $recall = true;
        $result = $this->model->contBackup($sourcePath, $outZipPath, $serializefile, $recall);
        exit;

    }

    public function action_DeleteBackup()
    {
        $this->model->loadRequest();
        $ids = $this->model->getVar('id', null);
        $result = $this->model->deleteBackUp($ids);
        $this->model->returnJSON($result);
    }

    public function action_DownloadBackupFile()
    {
        $this->model->loadRequest();
        $task = $this->model->getVar('task', null);
        if ($task == 'downloadBackupFile') {
            $this->model->downloadBackupFile();
        }
    }

    public function action_BackUpTypesCheck()
    {
        $code = '';
        $this->model->loadRequest();
        $backup_type = $this->model->getVar('backup_platform', '1');
        if ($backup_type == '3') {
            $code = $this->model->getVar('code', '');
        } else if ($backup_type == '4') {
            $code = $this->model->getVar('googlecode', '');
        }

        $result = $this->model->backupTypeCheck($backup_type, $code);
        $this->model->returnJSON($result);
    }

    public function action_BackupAuthenticationCallBack()
    {
        $this->model->loadRequest();
        $oneDriveCode = $this->model->getVar('code', null);
        $googleCode = $this->model->getVar('googlecode', null);
        //one drive
        if(!empty($oneDriveCode))
        {
            
            $this->model->oauthOneDrive($oneDriveCode);
            echo '<p>Authentication Successful!</p>';
            echo '<script type="text/javascript">setTimeout("window.close();", 3000);</script>';
            exit;
        }
        elseif(!empty($googleCode))
        {
            $this->model->oauthGoogleDrive($googleCode);
            echo '<p>Authentication Successful!</p>';
            echo '<script type="text/javascript">setTimeout("window.close();", 3000);</script>';
            exit;
        }
        else
        {
            echo '<p>No access code, authentication failed!</p>';
            echo '<script type="text/javascript">setTimeout("window.close();", 3000);</script>';
            exit;
        }

    }

    public function action_oauth()
    {
        $this->model->loadRequest();
        $type = $this->model->getVar('type', null);
        $reload = $this->model->getVar('reload', null);
        $result = $this->model->oauth($type, $reload);
        $this->model->returnJSON($result);
    }

    public function action_googledrive_logout()
    {
        $result = $this->model->googledrive_logout();
        $this->model->returnJSON($result);
    }

    public function action_onedrive_logout()
    {
        $result = $this->model->onedrive_logout();
        $this->model->returnJSON($result);
    }

    public function action_dropbox_init()
    {
        $result = $this->model->dropbox_init();
        $this->model->returnJSON($result);
    }

    public function action_dropbox_logout()
    {
        $result = $this->model->dropbox_logout();
        $this->model->returnJSON($result);
    }

    public function action_getNextSchedule()
    {
        $timezone = $this->model->getVar('timezone', null);
        $result = $this->model->getNextSchedule( $timezone );
        $return = array();
        //no schedule
        if(empty($result))
        {
            $return['status'] = 'empty';
            $return['schedule_time'] = '0';
        }
        else
        {
            $return['status'] = 'success';
            $return['schedule_time'] = $result;
        }
        $this->model->returnJSON($return);
    }

    public function action_getRecentBackup()
    {
        $result = $this->model->getRecentBackup();
        $return = array();
        if(sizeof($result)== 0)
        {
            $return['status'] = 'Empty';
            $return['result'] = '';
        }
        else
        {
            $return['status'] = 'Success';
            $return['result'] = $result[0];
        }
        $this->model->returnJSON($return);
    }

    public function action_getDropboxUploads(){
        $this->model->loadRequest();
        $id = $this->model->getVar('id', null);
        $result = $this->model->getDropboxUploads($id);
        $this->model->returnJSON($result);
    }

    public function action_dropboxUpload()
    {
        $this->model->loadRequest();
        $path = $this->model->getVar('path', null);
        $folder = $this->model->getVar('folder', null);
        $result = $this->model->dropboxUpload($path, $folder);
        $this->model->returnJSON($result);
    }

    public function action_getOneDriveUploads()
    {
        $this->model->loadRequest();
        $id = $this->model->getVar('id', null);
        $result = $this->model->getOneDriveUploads($id);
        $this->model->returnJSON($result);
    }

    public function action_oneDriveUpload(){
        $this->model->loadRequest();
        $path = $this->model->getVar('path', null);
        $folderID = $this->model->getVar('folderID', null);
        $result = $this->model->oneDriveUpload($path, $folderID);
        $this->model->returnJSON($result);
    }

    public function action_getGoogleDriveUploads()
    {
        $this->model->loadRequest();
        $id = $this->model->getVar('id', null);
        $result = $this->model->getGoogleDriveUploads($id);
        $this->model->returnJSON($result);
    }

    public function action_googledrive_upload()
    {
        $this->model->loadRequest();
        $path = $this->model->getVar('path', null);
        $folderID = $this->model->getVar('folderID', null);
        $result = $this->model->googledrive_upload($path, $folderID);
        $this->model->returnJSON($result);
    }

    public function action_easybackup()
    {
        $this->model->loadRequest();
        $cloudbackuptype = $this->model->getVar('cloudbackuptype', null);
        $cloudbackuprefix = $this->model->getVar('prefix', null);
        $result = $this->model->easybackup($cloudbackuptype, $cloudbackuprefix);
        $result['cms']= OSE_CMS;
        $this->model->returnJSON($result);
    }

    public function action_restore()
    {
        $this->model->loadRequest();
        $backup_id = $this->model->getVar('backup_id', null);
        $backup_path = $this->model->getBackUpPath($backup_id);
        $result = $this->model->restore($backup_path['file_backup'], $backup_path['db_backup']);
        $this->model->returnJSON($result);
    }

    public function action_listaccts()
    {
        $this->model->loadRequest();
        $connection = $this->model->getVar('connection', null);
        if ($connection == 'on') {
            $admin_email = $this->model->getVar('admin_email', null);
            $admin_password = $this->model->getVar('admin_password', null);
            $admin_username = $this->model->getVar('admin_username', null);
            $server_ip = $this->model->getVar('server_ip', null);
            $return = $this->model->listaccts($server_ip, $admin_password, $admin_email, $admin_username);
        } else {
            $admin_email = $this->model->getVar('admin_email', null);
            $admin_password = $this->model->getVar('admin_password', null);
            $admin_username = $this->model->getVar('admin_username', null);
            $server_ip = $this->model->getVar('server_ip', null);
            if (empty($admin_email) || empty($admin_password) || empty($admin_username) || empty($server_ip)) {
                $return['message'] = "Please fill out all the form";
                $return['status'] = "FAIL";
            } else {
                $return = $this->model->listaccts($server_ip, $admin_password, $admin_email, $admin_username);
            }
        }
        $this->model->returnJSON($return);
    }

    public function action_suitebackup()
    {
        $this->model->loadRequest();
        $acclists = $this->model->getVar('acclists', null);
        if (empty($acclists)) {
            $return['message'] = "Please select at least one account";
            $return['status'] = "FAIL";
        } else {
            $return = $this->model->suitebackup($acclists);
        }
        $this->model->returnJSON($return);
    }

    public function action_getSuiteBackupList()
    {
        $this->model->loadRequest();
        $connection = $this->model->getVar('connection', null);
        if ($connection == 'on') {
            $admin_email = $this->model->getVar('admin_email', null);
            $admin_password = $this->model->getVar('admin_password', null);
            $admin_username = $this->model->getVar('admin_username', null);
            $server_ip = $this->model->getVar('server_ip', null);
            $return = $this->model->getSuiteBackupList($server_ip, $admin_password, $admin_email, $admin_username);
        } else {
            $admin_email = $this->model->getVar('admin_email', null);
            $admin_password = $this->model->getVar('admin_password', null);
            $admin_username = $this->model->getVar('admin_username', null);
            $server_ip = $this->model->getVar('server_ip', null);
            if (empty($admin_email) || empty($admin_password) || empty($admin_username) || empty($server_ip)) {
                $return['message'] = "Please fill out all the form";
                $return['status'] = "FAIL";
            } else {
                $return = $this->model->saveSession($server_ip, $admin_password, $admin_email, $admin_username);
            }
        }
        $this->model->returnJSON($return);
    }
}
?>	
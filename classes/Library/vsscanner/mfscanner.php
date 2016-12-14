<?php
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
 * @Copyright Copyright (C) 2008 - 2012- ... Open Source Excellence
 */
if (!defined('OSE_FRAMEWORK') && !defined('OSEFWDIR') && !defined('_JEXEC')) {
    die('Direct Access Not Allowed');
}
oseFirewall::callLibClass('vsscanner', 'vsscanner');

class mfScanner extends virusScanner
{
    const CHUNK_SIZE = 2048;
    var $files = array();
    var $wordpressSites = array();
    var $joomlaSites = array();
    var $suiteSama = array();
    private $scanhisttablebl = '#__osefirewall_scanhist';
    private $db = null;
    var $file = array();
    var $folder = array();
    private $mfscanProgress;

    public function __construct()
    {
        $this->db = oseFirewall::getDBO();
        oseFirewall::loadFiles();
    }

    public function mfscan($startdate, $enddate, $symlink, $path, $step)
    {
        if (empty($path)) {
            $path = OSE_ABSPATH;
        }
        switch ($step) {
            case 1:
                $result = $this->generateMFScanList($path);
                break;
            case 2:
                $result = $this->runMfScan($startdate, $enddate, $symlink);
                break;
            case 3:
                $result = $this->completeMfScan();
                break;
        }
        return $result;

    }

    private function generateMFScanList($path)
    {

    	$this->deleteVSList();
        $scanList['scanlist'] = $this->setScanList($path);
        $scanList['totalscan'] = count($scanList['scanlist']);
        $scanList['totalvs'] = 0;
        $scanList['vsfilelist'] = array();

        //save scan list
        $this->saveScanList($scanList);

        //set scan progress
        $this->setScanProgress(0, oLang::_get('VL_GET_LIST'), 0, 0, true, 2, array());
        $this->mfscanProgress['scanDate'] = oseFirewall::getTime();
        $this->mfscanProgress['serverNow'] = $this->mfscanProgress['scanDate'];

        //$this->clearpreviousScanDB ();
        return $this->mfscanProgress;
    }

    private function setScanList($dir)
    {
        $files = array();
        $iter = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST,
            RecursiveIteratorIterator::CATCH_GET_CHILD // Ignore "Permission denied"
        );
        foreach ($iter as $path => $single) {
            if ($single != '.' && $single != '..' && $single != '.svn' && $single != '.idea') {
                $files[] = $path;
            }
        }

        return $files;
    }
    
    private function saveVSList($mfList)
    {
    	$filePath = OSE_FWDATA . ODS . "vsscanPath" . ODS . "mfList.inc";
    	$fileContent .="";
    	foreach ($mfList as $file) {
    		$fileContent .= $file;
    	}
    	$result = oseFile::write($filePath, $fileContent, false, true);
    }
    
    private function deleteVSList()
    {
    	$filePath = OSE_FWDATA . ODS . "vsscanPath" . ODS . "mfList.inc";
    	$result = oseFile::delete($filePath);
    	return $result;
    }
    
    private function saveScanList($scanList)
    {
        $filePath = OSE_FWDATA . ODS . "vsscanPath" . ODS . "mfScanList.inc";
        $fileContent = "<?php\n \$scanList = ". var_export($scanList, true)."; \n ?>";
        $result = oseFile::write($filePath, $fileContent);
    }

    private function readScanList()
    {
    	$this->optimizePHP ();
    	$filePath = OSE_FWDATA . ODS . "vsscanPath" . ODS . "mfScanList.inc";
        require_once($filePath);
        return $scanList;
    }

    private function deleteScanList()
    {
        $filePath = OSE_FWDATA . ODS . "vsscanPath" . ODS . "mfScanList.inc";
        $result = oseFile::delete($filePath);
        return $result;
    }

    private function setScanProgress($progress, $desc, $totalscan, $totalvs, $cont, $step, $content)
    {
        $this->mfscanProgress = array(
            'status' => array("progress" => $progress,
                "current_scan" => $desc,
                "total_scan" => $totalscan,
                "total_vs" => $totalvs,
                "cont" => $cont,
                "step" => $progress >= 100 ? 3 : $step), //overide step to 3 if complete
            'content' => $content);
    }

    protected function optimizePHP()
    {
    
    	if (function_exists('ini_set'))
    	{
    		ini_set('max_execution_time', 60);
    		ini_set('memory_limit', '256M');
    		ini_set("pcre.recursion_limit", "524");
    		set_time_limit(60);
    	}
    
    }
    private function runMfScan($startdate, $enddate, $symlink)
    {
        $scanList = $this->readScanList();
        $i = 0;
        $vsFileList = $scanList['vsfilelist'];
        $path = 'no more files';
        $starttime = time();
        sort($scanList['scanlist']);
        foreach ($scanList['scanlist'] as $key => $path) {
            $mdate1 = date('Y-m-d', filemtime($path));
            $mdate = date_create($mdate1);
            $leftdate = date_create(date_format(date_create($startdate), 'Y-m-d'));
            $rightdate = date_create(date_format(date_create($enddate), 'Y-m-d'));
            $left = date_diff($leftdate, $mdate);
            $right = date_diff($mdate, $rightdate);
            if ($left->format("%R%a") >= 0 && $right->format("%R%a") >= 0) {
                if (is_dir($path)) {
                    $path = realpath($path);
                    $bytestotal = 0;
                    if($path!==false){
                        foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)) as $object){
                            $bytestotal += $object->getSize();
                        }
                    }
                } else {
                    $vsFileList [] = "$path - " .$this->human_filesize(filesize($path)) .' - '.$mdate1 ."\n";
                }
            }
            if ($symlink == true && is_link($path)) {
                $vsFileList [] = "$path - " .$this->human_filesize(filesize($path)) .' - '.$mdate1 ."\n";
            }
            //unset clean files from scan list
            unset ($scanList['scanlist'][$key]);
            //break from loop to send progress every 3sec. Ajax handles recall of this function if scanning is not complete
            if (time() - $starttime >= 2) {
                //$vsFileList [] = $path; //testing
                break;
            }
        }
        $this->saveVSList($vsFileList);
        $scanList['totalvs'] = count($vsFileList);
        $numScanned = $scanList['totalscan'] - count($scanList['scanlist']);
        $this->saveScanList($scanList);
        $this->setScanProgress(round($numScanned / $scanList['totalscan'], 3) * 100, $path, $numScanned, $scanList['totalvs'], true, 2, $scanList['vsfilelist']);
        return $this->mfscanProgress;
    }

    private function completeMfScan()
    {
        $scanList = $this->readScanList();
        $this->setScanProgress(100, oLang::_get('VL_COMPLETE'), $scanList['totalscan'],
            $scanList['totalvs'], false, 3, $scanList['vsfilelist']);
        $this->saveDBLastScanResult($scanList);
        $this->deleteScanList();
        return $this->mfscanProgress;
    }

    protected function saveDBLastScanResult($content = '')
    {
        $varValues = array('super_type' => 'mfscan',
            'sub_type' => 1,
            'content' => oseJSON::encode(array($content)),
            'inserted_on' => oseFirewall::getTime()
        );
        $this->db->addData('insert', $this->scanhisttablebl, '', '', $varValues);
    }
    private function recurse_directory($dir)
    {
        if ($handle = @opendir($dir)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != '.' && $file != '..' && $file != '.svn' && $file != '.idea') {
                    $file = $dir . '/' . $file;
                    if (is_dir($file)) {
                        $this->recurse_directory($file);
                    } elseif (is_file($file)) {
                        $this->files[] = $file;
                    }
                }
            }
            closedir($handle);
        }
    }

    public function getLastScan()
    {
        $result = $this->getLastMfScanHist();
        $scanList = oseJSON::decode($result->content, true);
        $lastScan = array('scanDate' => $result->inserted_on
        , 'serverNow' => oseFirewall::getTime()
        , 'content' => $scanList[0]['vsfilelist']
        );
        return $lastScan;
    }

    private function getLastMfScanHist()
    {
        $query = "SELECT * FROM " . $this->db->quoteTable($this->scanhisttablebl)
            . " WHERE inserted_on = (SELECT max(inserted_on) FROM " . $this->db->quoteTable($this->scanhisttablebl)
            . " WHERE super_type = 'mfscan' AND sub_type = 1)";
        $this->db->setQuery($query);
        $result = $this->db->loadObject();
        return $result;
    }
}

?>

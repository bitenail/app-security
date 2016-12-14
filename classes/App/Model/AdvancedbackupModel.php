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
require_once('BackupModel.php');

class AdvancedbackupModel extends BackupModel
{
    public function loadLocalScript()
    {
        $this->loadAllAssets();
        oseFirewall::loadJSFile('CentroraManageIPs', 'advancedbackup.js', false);
        oseFirewall::loadJSFile('JSTimeZone', 'plugins/momentjs/jstz-1.0.4.min.js', false);
    }

    public function is_authorized()
    {
        $backupManager = new oseBackupManager ();
        $return = $backupManager->is_authorized();
        return $return;
    }

    public function getOneDriveUploads($id)
    {
        $backupManager = new oseBackupManager ();
        $return = $backupManager->getOneDriveUploads($id);
        return $return;
    }

    public function getGoogleDriveUploads($id)
    {
        $backupManager = new oseBackupManager ();
        $return = $backupManager->getGoogleDriveUploads($id);
        return $return;
    }
    public function oneDriveUpload($path, $folderID){
        $backupManager = new oseBackupManager ();
        $return = $backupManager->oneDriveUpload($path, $folderID);
        return $return;
    }

    public function getDropboxUploads($id)
    {
        $backupManager = new oseBackupManager ();
        $return = $backupManager->getDropboxUploads($id);
        return $return;
    }

    public function dropboxUpload($path, $folder)
    {
        $backupManager = new oseBackupManager ();
        $return = $backupManager->dropboxUpload($path, $folder);
        return $return;
    }

    public function googledrive_upload($path, $folderID)
    {
        $backupManager = new oseBackupManager ();
        $return = $backupManager->googledrive_upload($path, $folderID);
        return $return;
    }
    public function sendemail($id, $type)
    {
        $backupManager = new oseBackupManager ();
        $return = $backupManager->sendemail($id, $type);
        return $return;
    }

    /**
     * @param $cloudbackuptype
     * @return bool
     */
    public function checkCloudAuthentication ($cloudbackuptype){
        switch($cloudbackuptype){
            case 1:
                return true;
                break;
            case 2:
                oseFirewall::callLibClass('backup', 'oseBackup');
                $oseBackupManager = new oseBackupManager();
                $dropboxautho = $oseBackupManager->is_authorized();
                if ($dropboxautho == 'fail'){
                    return false;
                }elseif ($dropboxautho == 'ok'){
                    return true;
                }
                break;
            case 3:
                oseFirewall::callLibClass('backup/onedrive', 'onedrive');
                $oneDrive = new onedriveModelBup ();
                return $oneDrive->isAuthenticated();
                break;
            case 4:
                oseFirewall::callLibClass('backup/googledrive', 'googledrive');
                $gDrive = new gdriveModelBup ();
                return $gDrive->isAuthenticated();
                break;
            default:
                return false;
        }
    }

    public function restore($filezip, $dbzip)
    {
        $restoreManager = new oseRestoreManager();
        $return = $restoreManager->restore($filezip, $dbzip);
        return $return;
    }

    public function easybackup($cloudbackuptype, $cloudbackuprefix=null)
    {
        $backupManager = new oseBackupManager ();
        $return = $backupManager->easybackup($cloudbackuptype, $cloudbackuprefix);
        return $return;
    }

    private function getNowDaysNDates ($now, $todayifscheduled)
    {
        if ($now < $todayifscheduled){
            $array[strtolower(date("D", strtotime($todayifscheduled)))] = date("Y-m-d H:i:s", strtotime($todayifscheduled));
        }
        $array[strtolower(date("D", strtotime($todayifscheduled . " +1 day")))] = date("Y-m-d H:i:s", strtotime($todayifscheduled . " +1 day"));
        $array[strtolower(date("D", strtotime($todayifscheduled . " +2 day")))] = date("Y-m-d H:i:s", strtotime($todayifscheduled . " +2 day"));
        $array[strtolower(date("D", strtotime($todayifscheduled . " +3 day")))] = date("Y-m-d H:i:s", strtotime($todayifscheduled . " +3 day"));
        $array[strtolower(date("D", strtotime($todayifscheduled . " +4 day")))] = date("Y-m-d H:i:s", strtotime($todayifscheduled . " +4 day"));
        $array[strtolower(date("D", strtotime($todayifscheduled . " +5 day")))] = date("Y-m-d H:i:s", strtotime($todayifscheduled . " +5 day"));
        $array[strtolower(date("D", strtotime($todayifscheduled . " +6 day")))] = date("Y-m-d H:i:s", strtotime($todayifscheduled . " +6 day"));

        if($now >= $todayifscheduled){
            $array[strtolower(date("D", strtotime($todayifscheduled . " +7 day")))] = date("Y-m-d H:i:s", strtotime($todayifscheduled . " +7 day"));
        }
        return $array;
    }

    private function convertTime($dec)
    {
        $seconds = ($dec * 3600);
        $hours = floor($dec);
        $seconds -= $hours * 3600;
        $minutes = floor($seconds / 60);
        $seconds -= $minutes * 60;

        $return = date("Y-m-d H:i:s", strtotime($this->lz($hours).":".$this->lz($minutes).":".$this->lz($seconds)));
        return $return;
    }

    private function lz($num)
    {
        return (strlen($num) < 2) ? "0{$num}" : $num;
    }
}
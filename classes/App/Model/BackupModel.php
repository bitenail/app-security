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
 *  @Copyright Copyright (C) 2008 - 2012- ... Open Source Excellence
 */
if (! defined ( 'OSE_FRAMEWORK' ) && ! defined ( 'OSEFWDIR' ) && ! defined ( '_JEXEC' )) {
	die ( 'Direct Access Not Allowed' );
}
require_once ('BaseModel.php');
class BackupModel extends BaseModel {

	public function __construct() {
		$this->loadLibrary ();
		$this->loadDatabase ();
	}
    public function is_authorized(){
    }
	protected function loadLibrary() {
		oseFirewall::callLibClass('backup', 'oseBackup');
		oseFirewall::callLibClass('backup/onedrive', 'onedrive');
		oseFirewall::callLibClass('backup/googledrive', 'googledrive');
		oseFirewall::callLibClass ('backup', 'oseBackup' );
        oseFirewall::callLibClass('backup', 'oseRestore');
	}
	public function loadLocalScript() {
		$this->loadAllAssets ();
		if (!class_exists('SConfig')) {
			oseFirewall::loadJSFile('CentroraManageIPs', 'backup.js', false);
			oseFirewall::loadJSFile('JSTimeZone', 'plugins/momentjs/jstz-1.0.4.min.js', false);
		} else {
			oseFirewall::loadJSFile('CentroraManageIPs', 'suitebackup.js', false);
			oseFirewall::loadJSFile('JSTimeZone', 'plugins/momentjs/jstz-1.0.4.min.js', false);
		}
	}
	public function getCHeader() {
		return oLang::_get ( 'BACKUP_TITLE' );
	}
	public function getCDescription() {
		return oLang::_get ( 'BACKUP_DESC' );
	}

	public function getBackupList() {
		$backupManager = new oseBackupManager ();
		$return = $backupManager->getBackupList ();
		return $return;
	}
	public function backup($backup_type, $backup_to) {
		$backupManager = new oseBackupManager ();
		$return ['data'] = utf8_encode ( $backupManager->backup ( $backup_type, $backup_to ) );
		return $return;
	}
    public function contBackup($sourcePath, $outZipPath, $serializefile, $recall) {
        $backupManager = new oseBackupManager ();
        $backupManager-> addFilesToArchive ($sourcePath, $outZipPath, $serializefile, $recall);
    }
	public function deleteBackUp($ids) {
		$backupManager = new oseBackupManager ();
		$result = $backupManager->deleteBackUp ( $ids );
        return $result;
	}
    public function downloadBackupFile(){
        oseBackupManager::downloadBackupFile();
    }

	//--------------authentication----------------------
	//dropbox oauth

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

	public function oauth($type, $reload)
	{
		$backupManager = new oseBackupManager ();
		$return = $backupManager->oauth($type, $reload);
		return $return;
	}
	public function dropBoxVerify(){
		$oseBackupManager = new oseBackupManager();
		$dropboxautho = $oseBackupManager->is_authorized();
		if ($dropboxautho == 'fail'){
			return false;
		}elseif ($dropboxautho == 'ok'){
			return true;
		}
	}

	public function dropbox_init()
	{
		$backupManager = new oseBackupManager ();
		$return = $backupManager->is_authorized();
		return $return;
	}

	public function dropbox_logout()
	{
		$backupManager = new oseBackupManager ();
		$return = $backupManager->dropbox_logout();
		return $return;
	}

	// onedrive oauth
	public function oneDriveVerify()
	{
		$oneDrive = new onedriveModelBup ();
		$return = $oneDrive->isAuthenticated();
		return $return;
	}

	public function oauthOneDrive($code = null)
	{
		$oneDrive = new onedriveModelBup ();
		if (!empty($code)) {
			$return = $oneDrive->authorize($code);
		} else {
			$return = $oneDrive->getAuthorizationUrl();
		}
		return $return;
	}

	public function  onedrive_logout()
	{
		$oneDrive = new onedriveModelBup ();
		$return = $oneDrive->logout();
		return $return;
	}

	//google drive oauth
	public function  oauthGoogleDrive($code = null)
	{
		$gDrive = new gdriveModelBup ();
		if (!empty($code)) {
			$return = $gDrive->authenticate($code);
		} else {
			$return = $gDrive->getAuthenticationURL();
		}
		return $return;
	}

	public function googleDriveVerify()
	{
		$gDrive = new gdriveModelBup ();
		$return = $gDrive->isAuthenticated();
		return $return;
	}

	public function googledrive_logout()
	{
		$gDrive = new gdriveModelBup ();
		$return = $gDrive->logout();
		return $return;
	}

	//--------------end of authentication------------------

	public function backupTypeCheck($backup_type, $code = '')
	{
		$result = array('result' => '0', 'url'=>'');
		if(oseFirewall::checkSubscriptionStatus(false)) {
			$authenticate_result = '0';
			$url = '';
			switch ($backup_type) {
				case '1':
					break;
				case '2':
					if($this->dropBoxVerify())
					{
						$authenticate_result = '1';
//						$url = $this->dropbox_logout();
					}
					else
					{
						$authenticate_result = '2';
					}

					break;
				case '3':
					if($this->oneDriveVerify() || !empty($code))
					{
						$authenticate_result = '1';
//						$url = $this->onedrive_logout();
					}
					else
					{
						$authenticate_result = '2';
						$url = $this->oauthOneDrive();
					}

					break;
				case '4':
					if($this->googleDriveVerify() || !empty($code))
					{
						$authenticate_result = '1';
//						$url = $this->googledrive_logout();
					}
					else
					{
						$authenticate_result = '2';
						$url = $this->oauthGoogleDrive();
					}

					break;
				default:
					$authenticate_result = '0';
					break;
			}
		}
		else
			$authenticate_result = '3';

		if(empty($url))
		{
			$url = 'javascript:void(0)';
		}
		$result['result'] = $authenticate_result;
		$result['url'] = $url;

		return $result;
	}

	public function getRecentBackup()
	{
		$backupManager = new oseBackupManager ();
		$return = $backupManager->getRecentBackup();
		return $return;
	}

	public function getNextSchedule($timezone)
	{
		oseFirewall::callLibClass('panel','panel');
		$panel = new panel ();
        return $panel->getNextSchedule($timezone, 2);

	}

	public function getBackUpPath($id)
	{
		$backupManager = new oseBackupManager ();
		$return = $backupManager->getBackupDBByID($id);
		if(!isset($return['file_backup']))
		{
			$return['file_backup'] = '';
		}

		if(!isset($return ['db_backup']))
		{
			$return ['db_backup'] = '';
		}
		return $return;
	}

	public function restore($filezip, $dbzip)
	{
		oseFirewall::callLibClass('backup', 'oseRestore');
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

	public function listaccts($server_ip, $admin_password, $admin_email, $admin_username)
	{
		$session = JFactory::getSession();
		$authSession = $session->get('cpanelUsername');
		if (!empty($authSession)) {
			$admin_email = $session->get('cpanelEmail');
			$admin_password = $session->get('cpanelPassword');
			$admin_username = $session->get('cpanelUsername');
			$server_ip = $session->get('cpanelServerIP');
		}
		oseFirewall::callLibClass('cpanelAPI', 'cpbackup');
		$backupManager = new cpbackup ();
		$return = $backupManager->listaccts($server_ip, $admin_password, $admin_email, $admin_username);
		return $return;
	}

	public function suitebackup($acclists)
	{
		$session = JFactory::getSession();
		$authSession = $session->get('cpanelUsername');
		if (!empty($authSession)) {
			$admin_email = $session->get('cpanelEmail');
			$admin_password = $session->get('cpanelPassword');
			$admin_username = $session->get('cpanelUsername');
			$server_ip = $session->get('cpanelServerIP');
		}
		oseFirewall::callLibClass('cpanelAPI', 'cpbackup');
		$backupManager = new cpbackup ();
		$return = $backupManager->suitebackup($server_ip, $admin_password, $admin_email, $admin_username, $acclists);
		return $return;
	}

	public function checkAuthSession()
	{
		$session = JFactory:: getSession();
		$authSession = $session->get('cpanelUsername');
		if (empty($authSession)) {
			return false;
		} else {
			return true;
		}
	}

	public function getSuiteBackupList($server_ip, $admin_password, $admin_email, $admin_username)
	{
		$session = JFactory::getSession();
		$authSession = $session->get('cpanelUsername');
		if (!empty($authSession)) {
			$admin_email = $session->get('cpanelEmail');
			$admin_password = $session->get('cpanelPassword');
			$admin_username = $session->get('cpanelUsername');
			$server_ip = $session->get('cpanelServerIP');
		}
		oseFirewall::callLibClass('cpanelAPI', 'cpbackup');
		$backupManager = new cpbackup ();
		$return = $backupManager->listfullbackups($server_ip, $admin_password, $admin_email, $admin_username);
		return $return;
	}

	public function saveSession($server_ip, $admin_password, $admin_email, $admin_username)
	{
		oseFirewall::callLibClass('cpanelAPI', 'cpbackup');
		$backupManager = new cpbackup ();
		$return = $backupManager->saveSession($server_ip, $admin_password, $admin_email, $admin_username);
		return $return;
	}

	public function backuptest()
	{
		oseFirewall::callLibClass('cpanelAPI', 'cpbackup');
		$backupManager = new cpbackup ();
		$server_ip = '158.69.201.59';
		$admin_password = '*&FD*876asdfd88';
		$admin_email = 'kyle@centrora.com';
		$admin_username = 'root';
		// $return =  $backupManager->backup('158.69.201.59', '*&FD*876asdfd88', 'kyle@centrora.com');
		//return $return;
	}
}
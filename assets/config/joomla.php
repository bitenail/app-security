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
if (!defined('OSE_FRAMEWORK') && !defined('OSEFWDIR') && !defined('_JEXEC'))
{
 	die('Direct Access Not Allowed');
}

define('OSEAPPDIR', OSEFWDIR);
define('OSE_FRAMEWORK', true);
define('OSE_FRAMEWORKDIR', OSEFWDIR . 'vendor');
define('OSE_ABSPATH', dirname(dirname(dirname(OSEFWDIR))));
define('OSE_BACKUPPATH', dirname(dirname(OSEFWDIR)));
define('OSE_SUITEPATH', dirname(OSE_ABSPATH));

if (class_exists('SConfig')) {
	define('OSE_FWURL',OURI::root().'components/com_ose_firewall/');
	if(!defined('JOOMLA15'))
	{
		define('JOOMLA15',false);
	}
	$conf = new SConfig ();
	if (!empty($conf->assets_url)) {
		define('OSE_BANPAGE_ADMIN', $conf->assets_url.'administrator/components/com_ose_firewall/');
	}
	else {
		define('OSE_BANPAGE_ADMIN', str_replace('administrator/', '', OURI::root() ). 'administrator/components/com_ose_firewall/');
	}
	define('CENTRORABACKUP_FOLDER', OSE_ABSPATH.ODS.'media'.ODS.'CentroraBackup');
	define('CENTRORABACKUP_ZIPFILE', OSE_ABSPATH.ODS.'media'.ODS.'CentroraBackup'.ODS.'Backup.zip');
}
else {
	if (class_exists ('JURI')) {
		define('OSE_FWURL',JURI::root().'administrator/components/com_ose_firewall/');
	}
	else {
		define('OSE_FWURL',OURI::root().'components/com_ose_firewall/');
	}
	if (class_exists('JVersion')) {
		$version = new JVersion();
		$version = substr($version->getShortVersion(),0,3);
		if(!defined('JOOMLA15'))
		{
			$value = ($version >= '1.5' && $version < '1.6')?true:false;
			define('JOOMLA15',$value);
		}
	}
	else {
		define('JOOMLA15',false);
	}
	define('OSE_BANPAGE_ADMIN', str_replace('administrator/', '', OURI::root() ). 'administrator/components/com_ose_firewall');
	define('CENTRORABACKUP_FOLDER', JPATH_SITE.ODS.'media'.ODS.'CentroraBackup');
	define('CENTRORABACKUP_ZIPFILE', JPATH_SITE.ODS.'media'.ODS.'CentroraBackup'.ODS.'Backup.zip');
}
define('OSE_BANPAGE_URL', OSE_BANPAGE_ADMIN . ODS . 'public');
define('CENTRORABACKUP_FOLDER_GITIGNORE','media'.ODS.'CentroraBackup'.ODS.'*');
define('PRIVATEKEY_PATH',CENTRORABACKUP_FOLDER.ODS.'centrorakey');
define('PUBLICKEY_PATH',CENTRORABACKUP_FOLDER.ODS.'centrorakey.pub');
define('OSE_FWDATABACKUP', OSEFWDIR . 'protected' . ODS . 'data' . ODS . 'backup');
define('FOLDER_LIST',CENTRORABACKUP_FOLDER.ODS.'folderlist.php');
//define('CONTENT_FOLDER_LIST',CENTRORABACKUP_FOLDER.ODS.'contentfolderlist.php');
define('FOLDER_LIST_GITIGNORE','media'.ODS.'CentroraBackup'.ODS.'folderlist.php');
//define('CONTENT_FOLDER_LIST_GITIGNORE','media'.ODS.'CentroraBackup'.ODS.'contentfolderlist.php');
define('OSE_FWRELURL',OURI::root().'components/com_ose_firewall/');
define('OSE_FWASSETS', OSEFWDIR . ODS . 'assets');
define('OSE_WPURL',rtrim(OURI::base(), '/') );
define('OSE_ADMINURL', OSE_WPURL.'/index.php?option=com_ose_firewall');
define('OSE_FWRECONTROLLERS' , OSEFWDIR . 'classes' .ODS. 'App' . ODS . 'Controller' . ODS . 'remoteControllers');  
define('OSE_FWCONTROLLERS', OSEFWDIR . 'protected' . ODS . 'controllers');
define('OSE_FWMODEL', OSEFWDIR . 'classes' . ODS.'App' . ODS . 'Model');
define('OSE_FWFRAMEWORK', OSEFWDIR . ODS . 'classes' . ODS.'Library'); 
define('OSE_FWPUBLIC', OSEFWDIR . ODS . 'public');
define('OSE_FWPUBLICURL', OSE_FWURL . 'public');
define('OSE_FWLANGUAGE', OSE_FWPUBLIC . ODS.'messages');
define('OSE_FWWDATA', OSEFWDIR . ODS . 'protected' . ODS.'data');
define('OSE_TEMPFOLDER', OSEFWDIR . ODS . 'protected' . ODS.'data'.ODS.'tmp');
define('OSE_QATESTFILE',CENTRORABACKUP_FOLDER.ODS.'QATest.php');
define('OSE_DEFAULT_SCANPATH', dirname(dirname(dirname(OSEFWDIR))));
define('OSE_DBTABLESFILE', OSE_FWDATABACKUP .ODS . "dbtables.php"); //TODO  CHECK
define('BACKUP_DOWNLOAD_URL', '?option=com_ose_firewall&view=backup&task=downloadBackupFile&action=downloadBackupFile&controller=backup&id=');
define('ZIP_DOWNLOAD_URL', '?option=com_ose_firewall&view=gitbackup&task=downloadzip&action=downloadzip&controller=gitbackup');
//define('ZIP_DOWNLOAD_URL', '?page=ose_fw_gitbackup&option=ose_firewall&task=downloadzip&action=downloadzip&controller=downloadzip&id=Backup.zip');
define('BACKUP_ZIPFOLDER_GITIGNORE_PATH','media'.ODS.'CentroraBackup'.ODS.'BackupFiles');
define('BACKUP_ZIPFOLDER',CENTRORABACKUP_FOLDER.ODS.'BackupFiles');
define('EXPORT_DOWNLOAD_URL', '?option=com_ose_firewall&view=manageips&task=downloadCSV&action=downloadCSV&controller=manageips&filename=');
define('UPDATE_ADFIREWALL_RULE', '?option=com_ose_firewall&view=rulesets#adfirewall-rule');
define('DOWANLOAD_COUNTRYBLOCK_DB', '?option=com_ose_firewall&view=countryblock');
define('EXPORT_VSFILES_URL', '?option=com_ose_firewall&view=scanreport&task=downloadCSV&action=downloadCSV&controller=scanreport&filename=');
define('APP_FOLDER_NAME', basename(OSE_ABSPATH));
define('BACKUPFILES_EXCLUDEPATH',APP_FOLDER_NAME.ODS.BACKUP_ZIPFOLDER_GITIGNORE_PATH);
define('OSE_CONTENTFOLDER', OSE_ABSPATH.ODS.'media');


define('MOVE_PRIVATEKEY_PATH',CENTRORABACKUP_FOLDER.ODS.'keybackup'.ODS.'centrorakey');
define('MOVE_PUBLICKEY_PATH',CENTRORABACKUP_FOLDER.ODS.'keybackup'.ODS.'centrorakey.pub');
define('KEY_BACKUP',CENTRORABACKUP_FOLDER.ODS.'keybackup'.ODS.'*');
define('KEY_BACKUP_GITIGNORE','media'.ODS.'CentroraBackup'.ODS.'keybackup'.ODS.'*');
define('OSE_FWDATA', OSEFWDIR . 'protected' . ODS.'data');


?>
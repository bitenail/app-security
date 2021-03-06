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
define('GITFOLDER', ABSPATH.ODS.'.git');
define('OSE_FRAMEWORK', true);
define('OSE_FRAMEWORKDIR', OSEFWDIR . 'vendor');
define('OSE_FWURL',plugins_url('',dirname(dirname(__FILE__))));
define('OSE_ABSPATH', dirname(dirname(dirname(OSEFWDIR))));
define('OSE_BACKUPPATH', dirname(dirname(OSEFWDIR)));
define('CENTRORABACKUP_FOLDER', OSE_ABSPATH.ODS.'wp-content'.ODS.'CentroraBackup');
define('CENTRORABACKUP_ZIPFILE', OSE_ABSPATH.ODS.'wp-content'.ODS.'CentroraBackup'.ODS.'Backup.zip');
define('CENTRORABACKUP_FOLDER_GITIGNORE','wp-content'.ODS.'CentroraBackup'.ODS.'*');
define('PRIVATEKEY_PATH',CENTRORABACKUP_FOLDER.ODS.'centrorakey');
define('PUBLICKEY_PATH',CENTRORABACKUP_FOLDER.ODS.'centrorakey.pub');
define('MOVE_PRIVATEKEY_PATH',CENTRORABACKUP_FOLDER.ODS.'keybackup'.ODS.'centrorakey');
define('MOVE_PUBLICKEY_PATH',CENTRORABACKUP_FOLDER.ODS.'keybackup'.ODS.'centrorakey.pub');
define('KEY_BACKUP',CENTRORABACKUP_FOLDER.ODS.'keybackup');
define('KEY_BACKUP_GITIGNORE','wp-content'.ODS.'CentroraBackup'.ODS.'keybackup'.ODS.'*');
define('FOLDER_LIST',CENTRORABACKUP_FOLDER.ODS.'folderlist.php');
define('CONTENT_FOLDER_LIST',CENTRORABACKUP_FOLDER.ODS.'contentfolderlist.php');
define('FOLDER_LIST_GITIGNORE','wp-content'.ODS.'CentroraBackup'.ODS.'folderlist.php');
define('CONTENT_FOLDER_LIST_GITIGNORE','wp-content'.ODS.'CentroraBackup'.ODS.'contentfolderlist.php');
define('OSE_SUITEPATH', dirname(OSE_ABSPATH));
define('OSE_BANPAGE_URL', OSE_FWURL . ODS . 'public');
define('OSE_BANPAGE_ADMIN', OSE_FWURL );
$plugins = parse_url(WP_PLUGIN_URL);
define('OSE_FWRELURL',$plugins['path'].'/ose-firewall');
define('OSE_FWASSETS', OSEFWDIR . 'assets');
define('OSE_WPURL',rtrim(site_url(), '/') );
define('OSE_ADMINURL', OSE_WPURL.'/wp-admin/admin.php');  
define('OSE_FWRECONTROLLERS' , OSEFWDIR . 'classes' .ODS. 'App' . ODS . 'Controller' . ODS . 'remoteControllers');
define('OSE_FWCONTROLLERS', OSEFWDIR . 'protected' . ODS . 'controllers');
define('OSE_FWMODEL', OSEFWDIR . 'classes' . ODS.'App' . ODS . 'Model');
define('OSE_FWFRAMEWORK', OSEFWDIR . 'classes' . ODS.'Library');
define('OSE_FWPUBLIC', OSEFWDIR . 'public');
define('OSE_FWPUBLICURL', OSE_FWURL . '/public/');
define('OSE_FWLANGUAGE', OSE_FWPUBLIC . ODS.'messages');
define('OSE_FWDATA', OSEFWDIR . 'protected' . ODS.'data'); 
define('OSE_TEMPFOLDER', OSEFWDIR . 'protected' . ODS.'data'.ODS.'tmp');
define('OSE_DBTABLESFILE', OSE_FWDATA . ODS . "backup" . ODS . "dbtables.php");
define('OSE_QATESTFILE', CENTRORABACKUP_FOLDER.ODS.'QATest.php');
define('OSE_FWDATABACKUP',OSEFWDIR . 'protected' . ODS.'data'.ODS.'backup');
define('OSE_DEFAULT_SCANPATH', ABSPATH);
define('BACKUP_DOWNLOAD_URL', '?page=ose_fw_backup&option=ose_firewall&task=downloadBackupFile&action=downloadBackupFile&controller=backup&id=');
define('ZIP_DOWNLOAD_URL', '?page=ose_fw_gitbackup&option=ose_firewall&task=downloadzip&action=downloadzip&controller=gitbackup');
define('EXPORT_DOWNLOAD_URL', '?page=ose_fw_manageips&option=ose_firewall&task=downloadCSV&action=downloadCSV&controller=manageips&filename=');
define('UPDATE_ADFIREWALL_RULE', '?page=ose_fw_rulesets#adfirewall-rule');
define('DOWANLOAD_COUNTRYBLOCK_DB', '?page=ose_fw_countryblock');
define('EXPORT_VSFILES_URL', '?page=ose_fw_scanreport&option=ose_firewall&task=downloadCSV&action=downloadCSV&controller=scanreport&filename=');
define('JOOMLA15',false);
define('BACKUP_ZIPFOLDER_GITIGNORE_PATH','wp-content'.ODS.'CentroraBackup'.ODS.'BackupFiles');
define('BACKUP_ZIPFOLDER',CENTRORABACKUP_FOLDER.ODS.'BackupFiles');
define('APP_FOLDER_NAME', basename(ABSPATH));
define('BACKUPFILES_EXCLUDEPATH',APP_FOLDER_NAME.ODS.BACKUP_ZIPFOLDER_GITIGNORE_PATH);
define('OSE_CONTENTFOLDER', OSE_ABSPATH.ODS.'wp-content');
define('OSE_UPLOADFOLDER', OSE_ABSPATH.ODS.'wp-content'.ODS.'uploads');

?>
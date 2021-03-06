<?php
/**
 * @version     2.0 +
 * @package       Open Source Excellence Security Suite
 * @subpackage    Gabmedia Security Firewall
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
//Start here;
define('O_LATEST_SIGNATURE', '20140901');
define('O_LATEST_PATTERN', 'Latest version of virus pattern (major update) is 20140901, updated on 1st Sep 2014');
define('OSE_WORDPRESS_FIREWALL_SETTING', ''.OSE_WORDPRESS_FIREWALL.' indstillinger');
define('OSE_WORDPRESS_FIREWALL_SETTING_DESC', ''.OSE_WORDPRESS_FIREWALL.' er en Web Application Firewall til Wordpress oprettet af <a href="'.OSE_OEM_URL_MAIN.'" target="_blank">Beskyt din hjemmeside</a>. Den beskytter dit websted mod angreb og hacking fors&oslash;g effektivt.');
define('OSE_WORDPRESS_FIREWALL_UPDATE_DESC', ''.OSE_WORDPRESS_FIREWALL.' er en Web Application Firewall til Wordpress oprettet af <a href="'.OSE_OEM_URL_MAIN.'" target="_blank">Beskyt din hjemmeside</a>. Den beskytter dit websted mod angreb og hacking fors&oslash;g effektivt.');
define('OSE_DASHBOARD', 'Dashboard');
define('OSE_DASHBOARD_SETTING', 'Dashboard Indstillinger');
define('NOTIFICATION_EMAIL_ATTACKS', 'Den e-mail som skal modtage meddelelsen om angreb');
define('EMAIL_ADDRESS', 'Email Adresse');
define('FIREWALL_SCANNING_OPTIONS', 'Firewall scannings indstillinger');
define('BLOCKBL_METHOD', 'Bloker sortlistet metoder (Trace / Slet / Track)');
define('CHECK_MUA', 'Kontrollerer ondsindet User Agent');
define('checkDOS', 'Kontrollerer Basis DoS / Web Application Flooding Angreb');
define('checkDFI', 'Kontrollerer Basis Direkte Fil Inklusion');
define('checkRFI', 'Kontrollerer Basic Fjernstyret Fil Inklusion');
define('checkJSInjection', 'Kontrollerer Basis Javascript Injektion');
define('checkSQLInjection', 'Kontrollerer Basis Database SQL Injektion');
define('checkTrasversal', 'Detect Directory Traversal');
define('ADVANCE_SETTING', 'Avancerede indstillinger');
define('OTHER_SETTING', 'Andre indstilling');
define('BLOCK_QUERY_LONGER_THAN_255CHAR', 'Bloker foresp&oslash;rgsler l&aelig;ngere end 255 tegn');
define('BLOCK_PAGE', 'Bloker side det bliver vist til angribere');
define('OSE_BAN_PAGE', 'Brug vores bloker side');
define('BLANK_PAGE', 'Vis en blank side');
define('ERROR403_PAGE', 'Vis en 403 fejl side');
define('TEST_CONFIGURATION', 'Test din ops&aelig;tning');
define('TEST_CONFIGURATION_NOW', 'Test din ops&aelig;tning nu!');
define('SAVE_CHANGES', 'Gem &aelig;ndringer');
define('WHITELIST_VARS', 'Whitelisted variabler (brug et komma "," for at adskille variablerne.)');
define('BLOCK_MESSAGE', 'Din anmodning er blevet blokeret!');
define('FOUNDBL_METHOD', 'Fundet blacklisted metoder (Trace / Slet / Track)');
define('FOUNDMUA', 'Fundet ondsindet User Agent');
define('FOUNDDOS', 'Fundet Basis DoS Angreb');
define('FOUNDDFI', 'Fundet Basis Direct Fil Inklusion');
define('FOUNDRFI', 'Fundet Basis Remote Fil Inklusion');
define('FOUNDJSInjection', 'Fundet Basis Javascript Injektion');
define('FOUNDSQLInjection', 'Fundet Basis Database SQL Injektion');
define('FOUNDTrasversal', 'Fundet Directory Traversal');
define('FOUNDQUERY_LONGER_THAN_255CHAR', 'Fundet foresp&oslash;rgsler lï¿½ngere end 255 tegn');
define('MAX_TOLERENCE', 'Maksimal tolerance for et angreb');
// Langauges for version 1.5 + start from here;
define('OSE_SCANNING_SETTING','Scanning indstillinger');
define('OSE_SCANNING','Scanning');
define('SERVERIP','Din ip adresse (at undg&aring; falske alarmer p&aring; grund af tom user agent)');
define('OSE_WORDPRESS_FIREWALL_CONFIG',''.OSE_WORDPRESS_FIREWALL.' konfiguration');
define('OSE_WORDPRESS_VIRUSSCAN_CONFIG','Virus Scanner konfiguration');
define('OSE_WORDPRESS_VIRUSSCAN_CONFIG_DESC','Venligst konfigurere scanningsparametre virus her.');
define('START_DB_INIT','Initialiser Database');
define('STOP_DB_INIT','Stop Handling');
define('START_NEW_VIRUSSCAN','Start ny Multi-tr&aring;ds Scan');
define('CONT_VIRUSSCAN','Continue Multi-Threads Scan');
define('START_NEW_SING_VIRUSSCAN','Start ny single-Tr&aring;d Scan');
define('OSE_SCANNED',''.OSE_WORDPRESS_FIREWALL.' har scannet');
define('OSE_FOLDERS','mapper');
define('OSE_AND','og');
define('OSE_FILES','filer');
define('OSE_INFECTED_FILES','inficerede filer');
define('OSE_INTOTAL','i alt af' );
define('OSE_THERE_ARE','Der er');
define('OSE_IN_DB','i databasen');
define('OSE_VIRUS_SCAN','Virus Scanner');
define('OSE_VIRUS_SCAN_DESC',''.OSE_WORDPRESS_FIREWALL.' virus scaner har til form&aring;l at scanne og rense WordPress ondsindede koder og overv&aring;ger din hjemmeside p&aring; en 24/7 basis.');
define('CUSTOM_BANNING_MESSAGE','Tilpasset banned besked');
define('FILEEXTSCANNED','Fil extensions, bliver scannet');
define('DONOTSCAN','Scan ikke filer st&oslash;rre end (Enhed: Megabytes)');
define('PLEASE_CHOOSE_OPTION','V&aelig;lg en mulighed');
define('COMPATIBILITY','Kompatibilitet');
define('OSE_PLEASE_CONFIG_FIREWALL','Venligst konfigurere firewallens indstillingen her .');
define('OSE_FOLLOWUS','F&oslash;lg os og hold dig opdateret.');
define('OSE_ID_INFO',''.OSE_WORDPRESS_FIREWALL.' konto informaiton (Venligst kun udfylde din konto, hvis du er en avanceret / professionelt).');
define('OSE_ID','OSE ID (Brugernavn hos '.OSE_WORDPRESS_FIREWALL.' website).');
define('OSE_PASS','OSE Password (Password hos '.OSE_WORDPRESS_FIREWALL.' website).');
define('OSE_SCAN_SUMMARY','Scanning rapport');
define('OSE_SCAN_ACTIVITY','Scaning detajleret aktivitet');
define('OSE_WEBSITE_PROTECTED_BY','Denne hjemmeside er beskyttet af');
define('OSE_PROTECTION_MODE','Beskyttelse tilstand');
define('OSE_FIREWALL_ONLY','Beskyttet kun af Gabmedia Security');
define('OSE_SECSUITE_ONLY','Beskyttet kun af Gabmedia Security');
define('OSE_FWANDSUITE','Beskyttet af Gabmedia Security');
define('OSE_SUITE_PATH','Absolut sti af '.OSE_WORDPRESS_FIREWALL.' <br/>e.g. /home/youraccount/public_html/yoursite/ <br/> (Kontroller, at du har installeret <a href ="'.OSE_OEM_URL_MAIN.'" target="_blank">vores plugin</a>)');
define('NEED_HELP_CLEANING','Malware fjernelse?');
define('NEED_HELP_CLEANING_DESC','Viruser &aelig;ndrer sig over tid. Vores m&oslash;nstre n&aring;r m&aring;ske ikke blive opdateret til at scanne de nyeste ondsindede filer i din inficerede system. I dette tilf&aelig;lde, kan du overveje at k&oslash;be vores <a href="'.OSE_OEM_URL_MALWARE_REMOVAL.'" target="_blank" >Malware fjernelses produkt</a>. De nye m&oslash;nstre der findes i dit websted vil blive bidraget til samfundet til at hj&aelig;lpe andre brugere.');
define('OSE_DEVELOPMENT','Udvikling tilstand (midlertidigt deaktiveret beskyttelse)');
// Langauges for version 1.6 + start from here;
define('OSE_ENABLE_SFSPAM','Aktiver Stop Forum Spam Scanning');
define('OSE_YES','Ja');
define('OSE_NO','Nej');
define('OSE_SFSPAM_API','Stop Forum Spam API key');
define('SFSPAMIP','Stop Forum Spam IP');
define('OSE_SFS_CONFIDENCE','Konfidensniveau (mellem 1 og 100, jo h&oslash;jere jo mere sandsynligt en spam)');
define('OSE_SHOW_BADGE','Vis hjemmeside beskyttelse ikon <br/>(Brug venligst virus scanner til at scanne hjemmesiden f&oslash;rst)');
// Languages for version 2.0 start from here:
define('DBNOTREADY','<b>ADVARSEL</b>: Databasen er ikke klar, du skal klikke p&aring; knappen installere oprette databasetabeller');
define('DBNOTREADY_OTHER','<b>ADVARSEL</b>: Databasen er ikke klar, du skal vende tilbage til Dashboard for at installere databasen.');
define('DASHBOARD_TITLE','<b>Over</b><span><b>sigt</b></span>');
define('INSTALLNOW','Installer nu');
define('UNINSTALLDB', 'Afinstaller');
define('UNINSTALLDB_INTRO', 'Fjernelse af databasen oprettet af Gabmedia Security fra din hjemmeside');
define('UPDATEVERSION', 'opdatering');
define('SUBSCRIBE', 'Tilmeld');
define('READYTOGO','Alt er klar til at g&aring;! Hvis du &oslash;nsker at fjerne database, skal du g&aring; til konfigurering');
define('CREATE_BASETABLE_COMPLETED',' > Oprettelse af grund tabler afsluttet, forts&aelig;t...');
define('INSERT_CONFIGCONTENT_COMPLETED',' > Inds&aelig;ttelse af konfiguration data afsluttet, fors&aelig;t...');
define('INSERT_EMAILCONTENT_COMPLETED',' > Inds&aelig;ttelse af Email indhold Afsluttet, forts&aelig;t...');
define('INSTALLATION_COMPLETED',' > Database Installation Gennemf&oslash;rt.');
define('INSERT_ATTACKTYPE_COMPLETED',' > Attack Type Information Installation Gennemf&oslash;rt, forts&aelig;t...');
define('INSERT_BASICRULESET_COMPLETED',' > Basic regels&aelig;t Installation Gennemf&oslash;rt, forts&aelig;t...');
define('CREATE_IPVIEW_COMPLETED',' > IP-ACL Kortl&aelig;gning Gennemf&oslash;rt, forts&aelig;t...');
define('CREATE_ADMINEMAILVIEW_COMPLETED',' > Admin-Email Gennemf&oslash;rt, forts&aelig;t...');
define('CREATE_ATTACKMAPVIEW_COMPLETED',' > ACL-Attack Gennemf&oslash;rt, forts&aelig;t...');
define('CREATE_ATTACKTYPESUMEVIEW_COMPLETED',' > Attack Type Gennemf&oslash;rt, forts&aelig;t...');
define('INSERT_FILEEXTENSION_COMPLETED', ' > File extension Installation Completed, continue...');
define('INSERT_OEMID_COMPLETED', ' > OEM ID Installation Completed, continue...');
define('INSERT_STAGE1_GEOIPDATA_COMPLETED',' > GeoIP Data Stage 1 Installation Gennemf&oslash;rt, forts&aelig;t...');
define('INSERT_STAGE2_GEOIPDATA_COMPLETED',' > GeoIP Data Stage 2 Installation Gennemf&oslash;rt, forts&aelig;t...');
define('INSERT_STAGE3_GEOIPDATA_COMPLETED',' > GeoIP Data Stage 3 Installation Gennemf&oslash;rt, forts&aelig;t...');
define('INSERT_STAGE4_GEOIPDATA_COMPLETED',' > GeoIP Data Stage 4 Installation Gennemf&oslash;rt, forts&aelig;t...');
define('INSERT_STAGE5_GEOIPDATA_COMPLETED',' > GeoIP Data Stage 5 Installation Gennemf&oslash;rt, forts&aelig;t...');
define('INSERT_STAGE6_GEOIPDATA_COMPLETED',' > GeoIP Data Stage 6 Installation Gennemf&oslash;rt, forts&aelig;t...');
define('INSERT_STAGE7_GEOIPDATA_COMPLETED',' > GeoIP Data Stage 7 Installation Gennemf&oslash;rt, forts&aelig;t...');
define('INSERT_STAGE8_GEOIPDATA_COMPLETED',' > GeoIP Data Stage 8 Installation Gennemf&oslash;rt, forts&aelig;t...');
define('INSERT_VSPATTERNS_COMPLETED',' > Virus M&oslash;nstre Inds&aelig;ttelse Gennemf&oslash;rt, forts&aelig;t...');
define('MANAGEIPS_TITLE','<b>IP</b> <span><b>Management</b></span>');
define('MANAGEIPS_DESC','Bloker, Manage and Kontrol adgang IP-adresser. '.OSE_WORDPRESS_FIREWALL.' Plugin Automatisk registrerer mist&aelig;nkelig IP for dig og set som overv&aring;get som standard.');
define('IP_EMPTY','IP er tom');
define('IP_INVALID_PLEASE_CHECK','IP er ugyldig, skal du tjekke, om din nogen af dine oktetter er st&oslash;rre end 255');
define('IP_RULE_EXISTS','Adgangs kontrol regl for denne IP / IP r&aelig;kkevidde findes allerede.');
define('IP_RULE_ADDED_SUCCESS','Adgangs kontrol regl for denne IP / IP r&aelig;kkevidde blev tilf&oslash;jet.');
define('IP_RULE_ADDED_FAILED','Adgangs kontrol regl for denne IP / IP r&aelig;kkevidde blev ikke tilf&oslash;jet.');
define('IP_RULE_DELETE_SUCCESS','Adgangs kontrol regl for denne IP / IP r&aelig;kkevidde blev fjernet med succes.');
define('IP_RULE_DELETE_FAILED','Adgangs kontrol regl for denne IP / IP r&aelig;kkevidde blev ikke fjernet.');
define('IP_RULE_CHANGED_SUCCESS','Adgangs kontrol regl for denne IP / IP r&aelig;kkevidde er blevet &aelig;ndret.');
define('IP_RULE_CHANGED_FAILED','Adgangs kontrol regl for denne IP / IP r&aelig;kkevidde er ikke blevet &aelig;ndret.');
define('MANAGE_IPS','IP Management');
define('RULESETS','Firewall Konfiguration');
define('MANAGERULESETS_TITLE','<b>Firewall</b> <span><b>regl optimering</b></span>');
define('MANAGERULESETS_DESC','Aktivere eller deaktivere specifikke firewall-regler. Du kan &aelig;ndre sikkerhedsfunktionerne i '.OSE_WORDPRESS_FIREWALL.' ved at deaktivere specifikke sikkerhedsfunktion. Vi anbefaler at aktivere alle de sikkerhedsfunktioner til at b&aelig;re det bedste ud af Gabmedia Security');
define('ADRULESETS','Avanceret Firewall Indstillinger');
define('MANAGE_AD_RULESETS_TITLE','<b>Avanceret Firewall Indstillinger</b>');
define('MANAGE_AD_RULESETS_DESC','Panelet til Administrer din Avanceret Regler');
define('ITEM_STATUS_CHANGED_SUCCESS','Status for element er blevet &aelig;ndret med succes');
define('ITEM_STATUS_CHANGED_FAILED','Status for punkt blev ikke &aelig;ndret');
define('CONFIGURATION','Konfiguration');
define('CONFIGURATION_TITLE','<b>Installation</b>');
define('CONFIGURATION_DESC','Du kan installere eller afinstallere databasetabeller her');
define('SEO_CONFIGURATION_TITLE','<b>S&oslash;gemaskine</b> <span><b>Konfiguration</b></span>');
define('SEO_CONFIGURATION_DESC','S&oslash;gemaskine indstillinger som beskytter dine placeringer, selvom Google bots blokere din hjemmeside. Design besked, der skal vises for blokerede IP bes&oslash;gende');
define('CONFIG_SAVE_SUCCESS','Konfiguration er blevet &aelig;ndret.');
define('CONFIG_SAVE_FAILED','The configuration er ikke blevet &aelig;ndret.');
define('SCAN_CONFIGURATION','Scannings Konfiguration');
define('SCAN_CONFIGURATION_TITLE', 'Firewall Scanning Konfiguration');
define('SCAN_CONFIGURATION_DESC','Forbind til '.OSE_WORDPRESS_FIREWALL.' with an API key og konfigurer Firewall Scanning indstillinger');
define('ANTISPAM_CONFIGURATION','Anti-Spam Konfiguration');
define('ANTISPAM_CONFIGURATION_TITLE','<b>Anti-Spam</b> <span><b>Konfiguration</b></span>');
define('ANTISPAM_CONFIGURATION_DESC','Aktiver/Deaktiver stop-forum spam for at undg&aring; vedvarende spammere p&aring; message boards og blogs');
define('EMAIL_CONFIGURATION','Email Konfiguration');
define('EMAIL_CONFIGURATION_TITLE','<b>Email</b> <span><b>Konfiguration</b></span>');
define('EMAIL_CONFIGURATION_DESC','E-mail-skabelon konfiguration for sortlistet, filtreret og 403 blokerede post for opdagede angreb');
define('EMAIL_TEMPLATE_UPDATED_SUCCESS','Email templaten er blevet &aelig;ndret.');
define('EMAIL_TEMPLATE_UPDATED_FAILED','The email template er ikke blevet &aelig;ndret.');
define('EMAIL_ADMIN','Admin-Email Kortl&aelig;gning');
define('EMAIL_ADMIN_TITLE','<b>Administrator-Email</b> <span><b>Kortl&aelig;gning</b></span>');
define('EMAIL_ADMIN_DESC','Beslut hvilke admin bruger kan modtage anden e-mail til sortlistet, filtreret og 403 blokerede post for opdagede angreb');
define('LINKAGE_ADDED_SUCCESS','Koblingen er blevet tilf&oslash;jet.');
define('LINKAGE_ADDED_FAILED','Koblingen er ikke blevet tilf&oslash;jet.');
define('LINKAGE_DELETED_SUCCESS','Koblingen er blevet slettet.');
define('LINKAGE_DELETED_FAILED','Koblingen er ikke blevet slettet.');
define('ANTIVIRUS_CONFIGURATION','Virus Scanner Konfiguration');
define('ANTIVIRUS_CONFIGURATION_TITLE','<b>Virus Scanner</b> <span><b>Konfiguration</b></span>');
define('ANTIVIRUS_CONFIGURATION_DESC','Konfigurer indstillingerne for Virus Scanner , kontrollere filtypen , der skal scannes , og begr&aelig;nse st&oslash;rrelsen af scannede filer');
define('ANTIVIRUS','Virus Scanner <small>(Premium)</small>');
define('ANTIVIRUS_TITLE','<b>Virus</b> <span><b>Scanner</b></span>');
define('ANTIVIRUS_DESC','Virus Scanner er en kraftfuld malware detektor, det virker som en antivirus, men er mere kraftfuld end en antivirus. Det scanner igennem hver eneste filer p&aring; din server eller en specifik vej filer til virus, malware, spam, ondsindede koder, SQL injektion, sikkerhedshuller osv');
define('LAST_SCANNED','Seneste scannet mappe: ');
define('LAST_SCANNED_FILE','Seneste scannet fil: ');
define('OSE_FOUND',OSE_WORDPRESS_FIREWALL.' fundet');
define('OSE_ADDED',OSE_WORDPRESS_FIREWALL.' tilf&oslash;jet');
define('IN_THE_LAST_SCANNED','i den sidste scanning,');
define('O_CONTINUE','Fors&aelig;t...');
define('SCANNED_PATH_EMPTY','S&oslash;rg det scannede stien ikke er tom .');
define('O_PLS', 'Venligst');
define('O_SHELL_CODES', 'Shell Koder');
define('O_BASE64_CODES', 'Base64 Encoded Koder');
define('O_JS_INJECTION_CODES', 'Javascript injektion Koder');
define('O_PHP_INJECTION_CODES', 'PHP injektion Koder');
define('O_IFRAME_INJECTION_CODES', 'iFrame injektion Koder');
define('O_SPAMMING_MAILER_CODES', 'Spam Mail Koder');
define('O_EXEC_MAILICIOUS_CODES','Executable Ondsindede Koder');
define('O_OTHER_MAILICIOUS_CODES','Diverse Ondsindede Koder');
define('WEBSITE_CLEAN','Sikret');
define('COMPLETED','Gennemf&oslash;rt');
define('YOUR_SYSTEM_IS_CLEAN','Dit system er rent.');
define('VSREPORT','Scan Rapport <small>(Premium)</small>');
define('SCANREPORT_TITLE','<b>Scan</b> <span><b>Rapport</b></span>');
define('SCANREPORT_DESC','Viser de inficerede filer der sidst blev scannet af virus scanneren');
define('SCANREPORT_CLEAN', 'Ingen filer blev smittet.');
define('VARIABLES','Variabler');
define('VARIABLES_TITLE','<b>Variabler</b> <span><b>Management</b></span>');
define('VARIABLES_DESC','Variabl scanning. '.OSE_WORDPRESS_FIREWALL.' automatisk scanner variablerne i baggrunden for at forhindre angreb gennem variabler');
define('MANAGE_VARIABLES','Administrer variabler');
define('VIRUS_SCAN_REPORT','Virus Scanning Rapport');
define('VERSION_UPDATE', 'Anti-Virus Database Opdatering');
define('VERSIONUPDATE_DESC', 'Panelet er til at opdatere Virus Databasen');
define('ANTI_VIRUS_DATABASE_UPDATE', 'Anti-Virus Database Opdatering');
define('VERSION_UPDATE_TITLE', '<b>'.OSE_WORDPRESS_FIREWALL.' Version Opdaterings Panel</b>');
define('VERSION_UPDATE_DESC', 'Panelet er at opdatere din lokale anti-virus database');
define('CHECK_UPDATE_VERSION', 'Forbinder med server og kontrollere opdaterings version...');
define('START_UPDATE_VERSION', 'Starter med at downloade opdateringer...');
define('UPDATE_COMPLETED', 'Opdatering Gennemf&oslash;rt!');
define('CHECK_UPDATE_RULE', 'Kontrollere opdaterings regel...');
define('ALREADY_UPDATED', 'Allerede opdateret idag');
define('UPDATE_LOG', 'Opdater Log...');
//Since 2.3.0
define('FILE_UPLOAD_VALIDATION', 'File Upload Validering');
define('REQUEST_DELIMITER','-----');
define('GEONOTREADY', 'Du skal installere GeoIP Country List for at aktivere land blokererings funktion.');
define('COUNTRYBLOCK_TITLE', '<b>Land</b> <span><b>Blokering</b></span>');
define('COUNTRYBLOCK_DESC','Panelet til blokkere IPer fra lande');
define('COUNTRYBLOCK', 'Land Blokering <small>(Premium)</small>');
define('BACKUP', 'Backup');
define('ADVANCEDBACKUP', 'Avanceret Backup <small>(Premium)</small>');
define('BACKUP_MANAGER', 'Backup Management');
define('BACKUP_TITLE', '<b>Backup Management</b>');
define('BACKUP_DESC', 'Du kan centralt tage backup af din database her');
define('BACKUP_FILES', 'filer er blevet sikkerhedskopieret');
define('PREFIX_EMPTY', 'Angiv et pr&aelig;fiks');
define('BACKUP_TYPE_EMPTY', 'V&aelig;lg en backup type');
define('DB_BACKUP_FAILED_INCORRECT_PERMISSIONS', 'Mislykket sikkerhedskopiering database, skal du sikre backup mappe "'.OSE_FWDATA.'/backup/" er skrivebar.');
define('DB_COUNTRYBLOCK_FAILED_INCORRECT_PERMISSIONS','Mislykket sikkerhedskopiering database, skal du sikre backup mappen "'.OSE_FWDATA.'/backup/" er skrivebar.');
define('FILE_VSSCAN_FAILED_INCORRECT_PERMISSIONS', 'Mislykkedes Scanning Virus, skal du sikre scanningsfilen "'.OSE_FWDATA.'/vsscanPath/path.json" er skrivebar.');
define('DB_BACKUP_SUCCESS', 'Database backup er en succes.');
define('DB_DELETE_SUCCESS', 'Backup punkt blev fjernet med succes.');
define('DB_DELETE_FAILED', 'Backup punkt blev ikke fjernet.');
define('ADVRULESET_INSTALL_SUCCESS', 'Avancerede sikkerheds regels&aelig;t er blevet installeret');
define('ADVRULESET_INSTALL_FAILED', 'Avancerede sikkerheds regels&aelig;t er ikke blevet installeret');
define('GAUTHENTICATOR','googleVerification');
define('IPMANAGEMENT_INTRO', 'Block, styre og kontrollere adgangen for IP-adresser. Gabmedia Security registrerer automatisk mist&aelig;nkelig IP for dig og indstillet til at overv&aring;ge som standard.');
define('FIREWALL_SETTING_INTRO', 'Aktivere eller deaktivere firewall-funktion. Du kan begr&aelig;nse sikkerhedsfunktionerne i Gabmedia Security ved at deaktivere enhver sikkerhedsfunktion. Vi anbefaler at aktivere alle de sikkerhedsfunktioner til at b&aelig;re det bedste ud af Gabmedia Security');
define('VARIABLES_INTRO', 'Variabel scanning. Gabmedia Security automatisk scanne variablerne i baggrunden for at forhindre angreb gennem variabler');
define('VIRUS_SCANNER_INTRO', 'Virus Scanner er en kraftfuld malware detektor, det virker som en antivirus, men er mere kraftfuld end en antivirus. Det scanner igennem hver eneste filer p&aring; din server eller en specifik vej filer til virus, malware, spam, ondsindede koder, SQL injektion, sikkerhedshuller osv');
define('SCAN_REPORT_INTRO', 'Viser de inficerede filer sidst scannet af virus scanner');
define('CONFIGURATION_INTRO', 'Konfigurer standardindstillingerne for Gabmedia Security der passer bedst til dine personlige behov. Det omfatter indstillinger for scanning, virus scanner, SEO, anti-spam, e-mail og admin email kortl&aelig;gning');
define('BACK_UP_INTRO', 'Backup database ind i din egen server gratis');
define('COUNTRY_BLOCK_INTRO', 'Bloker IP-omr&aring;de for hele landet, som du insisterer p&aring; at. Gabmedia Security vil holde g&aelig;sterne i blokerede landet ud af din hjemmeside');
define('SCANCONFIG_INTRO', 'Konfigurer Firewall Scanning Indstillinger');
define('VSCONFIG_INTRO', 'Konfigurer indstillingerne for Virus Scanner, kontrollere filtypen, der skal scannes, og begr&aelig;nse st&oslash;rrelsen af scannede filer ');
define('SEOCONFIG_INTRO', 'S&oslash;gemaskine-indstillinger, som beskytter dine placeringer, selvom Google bots blokere din hjemmeside. Design besked, der skal vises for blokerede IP bes&oslash;gende');
define('ANTISPAMCONFIG_INTRO', 'Aktiver/Deaktiver stop-forum spam for at undg&aring; vedvarende spammere p&aring; message boards og blogs');
define('EMAILCONFIG_INTRO', 'E-mail-skabelon konfiguration for sortlistet, filtreret og 403 blokerede post for opdagede angreb');
define('ADMINEMAILCONFIG_INTRO', 'Beslut hvilke admin bruger kan modtage anden e-mail til sortlistet, filtreret og 403 blokerede post for opdagede angreb');
define('ANTI_HACKING', 'Anti-Hacking');
define('ANTI_VIRUS', 'Anti-Virus');
define('PREMIUM_FEATURES', 'Velligeholdelse');
define('LOGIN_FAILED', 'Login mislykkedes. Brugernavn, adgangskode eller privat n&oslash;gle er forkert!');
define('LOGIN_STATUS', 'Login Status');
define('LOGIN', 'Login');
define('SUBSCRIPTION', 'Abonnement');
define('O_CONTINUE_SCAN', 'Forts&aelig;t Scanning');
define('STOP_VIRUSSCAN', 'Stop Scanning');
define('CONFIG_SAVECOUNTRYBLOCK_FAILE', 'Gem Land Blokering konfig mislykkedes, Land Blokering Database er ikke klar.');
define('CONFIG_ADPATTERNS_FAILE', 'Gen Advanceret Virus Pattern config mislykkedes, Advanced Virus Pattern Databasen er ikke klar.');
define('UNINSTALL_SUCCESS', 'Afinstaller database tabel succes!');
define('UNINSTALL_FAILED', 'Afinstaller database tabel mislykkedes!');
define('SCAN_READY','Klar til at scanne virus');
define('ADVANCERULESNOTREADY', '<b>[Bedre Beskyttelse] </b><b>FORBEDRING</b>: T&aelig;nd venligst for advanceret firewall for at f&aring; &oslash;get beskyttelse. Beskyttelsen forh&aring;nd firewall tilbyder 45+ afsl&oslash;ring teknik til at beskytte dit websted fra hacking fors&oslash;g');
define('ABOUT', 'Features');
define('ABOUT_DESC', 'De detaljerede beskrivelser af hver sektion af vores plugin, og hvad den g&oslash;r');
define('ADVANCERULES_READY','<b>[Bedre Beskyttelse] </b>FEDT! Dit website er mere sikker nu');
define('ADMINUSER_EXISTS','<b>[Admin Beskyttelse] </b><b>ADVARSEL</b>: Administratoren konto \'admin\' eksisterer stadig , du skal  &aelig;ndre brugernavnet for administrator brugeren ASAP.');
define('ADMINUSER_REMOVED','<b>[Admin Beskyttelse] </b>FEDT! The admin kontoen \'admin\' er blevet fjernet.');
define('FIREWALL','Firewall');
define('OSE_AUDIT','Revision');
define('GAUTHENTICATOR_NOTUSED','<b>[Admin Beskyttelse] </b><b>ADVARSEL</b>: Google 2 Trin Authenticator anvendes ikke. Dette er en effektiv metode til at undg&aring; brute force angreb, vi kraftigt foresl&aring; du aktiverer denne funktion. F&oslash;lg venligst denne tutorial for at aktivere den.');
define('GAUTHENTICATOR_READY','<b>[Admin Beskyttelse] </b>FEDT! Google Autentificering er tilg&aelig;ngelig i denne hjemmeside, skal du sikre, at alle web adminsitrators har aktiveret funktionen for deres konti.');
define('WORDPRESS_OUTDATED','<b>[Wordpress Opdatering] </b><b>ADVARSEL</b>: Din Wordpress er for&aelig;ldet, skal du opdatere det ASAP. Nuv&aelig;rende version er');
define('WORDPRESS_UPTODATE','<b>[Wordpress Opdatering] </b>FEDT! Dit website er up-to- date med den nuv&aelig;rende version af ');
define('USERNAME_CANNOT_EMPTY','Brugernavn kan ikke v&aelig;re tomt');
define('USERNAME_UPDATE_SUCCESS','Succesfuld &aelig;ndret brugernavn. Browseren vil blive opdateret, hvis du er logget p&aring; som \'admin\', skal du logge ind med dit nye brugernavn derefter.');
define('USERNAME_UPDATE_FAILED','Kunne ikke &aelig;ndre brugernavnet');
define('GOOGLE_IS_SCANNED', '<b>[SEO Beskyttelse] </b><b>ADVARSEL</b>: Bem&aelig;rk, at Google bots bliver scannet, hvis dit websted ikke er under kraftig angreb, skal du deaktivere denne funktion for at undg&aring; at din SEO bliver afftected.');
define('CLAMAV', 'ClamAV Integration');
define('ACTION_PANEL', 'Action Panel');
define('CLAMAV_STATUS', 'ClamAV Status');
define('RELOAD_DB_DESC', 'Genindl&aelig;s ClamAV Database');
define('CLAMAV_DEF_VIRSION', 'ClamAV Virus Definition Version');
define('CLAMAV_TITLE', '<b>ClamAV Integration</b>');
define('CLAMAV_DESC', 'ClamAV er en open source anti- virus software til Linux-server. Gabmedia Security kan integrere ClamAV til virusscanning funktion for at forbedre str&oslash;mmen til plukning ondsindede filer. For server installation instruktion, se <a href ="'.OSE_OEM_URL_MAIN.'" target="_blank">denne tutorial</a>. N&aring;r det er installeret, kan du se <a href="'.OSE_OEM_URL_MAIN.'" target = "_blank">denne tutorial</a> for at aktivere ClamAV scanning i Gabmedia Security.');
define('CLAMAV_CONNECT_SUCCESS', 'Oprettet forbindelse til Clam Daemon');
define('CLAMAV_DEF_VERSION','ClamAV Definition Version');
define('CLAMAV_CANNOT_CONNECT','Kan ikke oprette forbindelse til ClamAV Daemon');
define('SIGNATURE_UPTODATE','<b>[Bedre Beskyttelse] </b>Din firewall regler er opdateret');
define('SIGNATURE_OUTDATED','<b>[Bedre Beskyttelse] </b><b>FORBEDRING</b>: Din firewall regler er utidssvarende, skal du opdatere reglerne for at forbedre beskyttelsen. Den opdaterede forh&aring;nd firewall-beskyttelse giver 45+ afsl&oslash;ring teknik til at beskytte dit websted fra hacking fors&oslash;g');
define('IS_MY_WEBSITE_SAFE_BROWSING','Ser min hjemmeside sikker i store anti-virus software sortliste database ?
');
define('SAFE_BROWSING_CHECKUP',''.OSE_WORDPRESS_FIREWALL.' Sikker Browsing Checkup (Sortliste Overv&aring;gning)');
define('SECURITY_CONFIG_AUDIT','Security Konfiguration Revision');
define('CHECK_SAFE_BROWSING','Tjekke din hjemmeside sikker browsing status nu.');
define('SAFE_BROWSING_CHECKUP_UPDATED','Din Beskyttet browsing Checkup opdateres');
define('SAFE_BROWSING_CHECKUP_OUTDATED','Din Beskyttet browsing Checkup er for&aelig;ldet, planl&aelig;gger den daglige helbredsunders&oslash;gelse nu.');
define('API_CONFIGURATION','API Konfiguration');
define('API_INTRO','Opret forbindelse til '.OSE_WORDPRESS_FIREWALL.' with an API key');
define('SYSTEM_SECURITY_AUDIT','System Security Revision');
define ('WORDPRESS_FOLDER_PERMISSIONS','Wordpres Folder Permissions');
define('CHANGE_PHPINI', 'Hvis dette hash blevet slukket i afsnittet konfiguration, skal du &aelig;ndre det i php.ini');
define('REG_GLOBAL_OFF','PHP Setting register_global er <b>Ikke aktiv</b>.');
define('REG_GLOBAL_ON','PHP Setting register_global er <b>Aktiv</b>, Deaktiver venligst. '.CHANGE_PHPINI);
define('SAFEMODE_OFF','PHP Setting safe_mode er <b>Ikke aktiv</b>');
define('SAFEMODE_ON','PHP Setting safe_mode er <b>Aktiv</b>, Deaktiver venligst. '.CHANGE_PHPINI);
define('URL_FOPEN_OFF','PHP Setting allow_url_fopen er <b>Ikke aktiv</b>');
define('URL_FOPEN_ON','PHP Setting allow_url_fopen er <b>Aktiv</b>, Deaktiver venligst. '.CHANGE_PHPINI);
define('DISPLAY_ERROR_OFF','PHP Setting display_errors er <b>Ikke aktiv</b>');
define('DISPLAY_ERROR_ON','PHP Setting display_errors er <b>Aktiv</b>, Deaktiver venligst. '.CHANGE_PHPINI);
define('DISABLE_FUNCTIONS_READY','F&oslash;lgende PHP funktioner er blevet deaktiveret: ');
define('DISABLE_FUNCTIONS_NOTREADY','F&oslash;lgende PHP funktioner skal v&aelig;re deaktiveret: ');
define('RETRIEVE_UPDATED_PATTERNS','Hent opdaterede Virus Patterns');
define('YOUR_VERSION', 'Din version: ');
define('SCHEDULE_SCANNING', 'Tidsplanl&aelig;g Virus Scanning');
define('SYSTEM_PLUGIN_DISABLED', ''.OSE_WORDPRESS_FIREWALL.' system plugin er deaktiveret, skal du aktivere det og s&aelig;tte det til den f&oslash;rste position.');
define('SYSTEM_PLUGIN_READY', ''.OSE_WORDPRESS_FIREWALL.' system plugin er klar.');
define('SCAN_SPECIFIC_FOLDER', 'Scan specifik mappe');
define('O_DROPBOX_FAILED', 'Uploaded backup fil til Dropbox mislykkedes. Pr&oslash;v venligst igen bemyndige Dropbox API igen.');

define('O_FILE_ID', 'Fil ID');
define('O_FILE_NAME', 'Fil Navn');
define('O_CONFIDENCE', 'Ondsindet angivet i %');
define('O_PATTERNS', 'M&oslash;nstre');
define('O_PATTERN_ID', 'M&oslash;nstre ID');

define('O_BACKUPFILE_ID', 'ID');
define('O_BACKUPFILE_DATE', 'Tid');
define('O_BACKUPFILE_NAME', 'Fil Navn');
define('O_BACKUPFILE_TYPE', 'Backup Type');
define('O_BACKUP_DROPBOX', 'Dropbox');
define('O_BACKUP_LOCAL', 'Local');


define('O_IP_RULE_TITLE', 'IP Regl Titel');
define('O_ID', 'ID');
define('O_DATE', 'Dato');
define('O_RISK_SCORE', 'Score');
define('O_START_IP', 'Start IP');
define('O_END_IP', 'Slut IP');
define('O_ADD_AN_IP', 'Tilf&oslash;j IP');
define('O_IP_RULE', 'IP Regl Titel');
define('O_IP_TYPE', 'IP Type');
define('O_RANGE', 'IP afstand');
define('O_SINGLE_IP', 'Single IP');
define('O_STATUS', 'Status');
define('O_HOST', 'Host');
define('O_VISITS', 'Bes&oslash;g');
define('O_VIEWDETAIL', 'Handling');
define('O_DELETE_ITEMS', 'Slet objekt');
define('O_STATUS_MONITORED_DESC', 'Overv&aring;get');
define('O_STATUS_BLACKLIST_DESC', 'Blacklist');
define('O_STATUS_WHITELIST_DESC', 'Whitelist');

define('O_DEFAULT_VARIABLES_WARNING', 'Please enable the default variables to avoid false alerts from the firewall');
define('O_DEFAULT_VARIABLE_BUTTON','Enable Whitelist default variables');

define('ADD_IPS', 'Tilf&oslash;j IP');
define('O_BLACKLIST_IP', 'Blacklist IPer');
define('O_WHITELIST_IP', 'Whitelist IPer');
define('O_MONITORLIST_IP', 'Overv&aring;get IPer');
define('ADD_IP_FORM','Tilf&oslash;j IP Form');
define('IPFORM_DESC', 'Denne formular giver dig mulighed for at tilf&oslash;je en IP eller IP Range i systemet');
define('O_DELETE__ALLITEMS', 'Fjern alle');
define('SAVE', 'Gem');

define('PLEASE_SELECT_ITEMS', 'V&aelig;lg mindst et element .');
define('O_UPDATE_HOST', 'Opdater Host');
define('O_IMPORT_IP_CSV', 'Import IP fra CSV');
define('O_EXPORT_IP_CSV', 'Export IP til CSV');
define('O_IMPORT_NOW', 'Importer Nu');
define('GENERATE_CSV_NOW', 'Generer CSV fil nu');

define('O_ATTACKTYPE', 'Attack Type');
define('O_RULE', 'Regl');
define('O_IMPACT', 'Impact');

define('ADD_A_VARIABLE', 'Tilf&oslash;j en variabel');
define('O_VARIABLE_NAME', 'Variabel navn');
define('O_VARIABLE_TYPE', 'Variabel Type');
define('O_VARIABLES', 'Variabler');
define('VARIABLE_NAME_REQUIRED', 'Variabel Navn p&aring;kr&aelig;vet');
define('LOAD_WORDPRESS_DATA', 'Indl&aelig;s WordPress standard variabler');
define('LOAD_WORDPRESS_CONFIRMATION', 'Bekr&aelig;ft venligst, at du &oslash;nsker at indl&aelig;se Wordpress whitelisten variable regler');
define('O_CLEAR_DATA', 'Ryd data');
define('O_CLEAR_DATA_CONFIRMATION', 'Ryd data Bekr&aelig;ftelse');
define('O_CLEAR_DATA_CONFIRMATION_DESC', 'Bekr&aelig;ft venligst, at du gerne vil slette alle variabler , vil det fjerne nogle andre hacking information relateret til denne regel');
define('O_STATUS_EXP', 'Status Forklaring');
define('SCAN_VARIABLE', 'Scan Variable');
define('FILTER_VARIABLE', 'Filterer Variablen');
define('IGNORE_VARIABLE', 'Ignorere Variablen');
define('VARIABLE_CHANGED_SUCCESS', 'Variabelen er blevet &aelig;ndret.');
define('VARIABLE_CHANGED_FAILED', 'Variabelen er ikke blevet &aelig;ndret');
define('VARIABLE_ADDED_SUCCESS', 'Variabelen er blevet tilf&oslash;jet.');
define('VARIABLE_ADDED_FAILED', 'Variabelen er ikke blevet tilf&oslash;jet.');
define('VARIABLE_DELETED_SUCCESS', 'Variabelen er blevet slettet');
define('VARIABLE_DELETED_FAILED', 'Variabelen er ikke blevet slettet');

define('LOAD_JOOMLA_DATA', 'Indl&aelig;s Joomla Variabler');
define('LOAD_JSOCIAL_DATA', 'Indl&aelig;s JomSocial Variabler');
define('LOAD_JOOMLA_CONFIRMATION', 'Bekr&aelig;ft venligst, at du &oslash;nsker at indl&aelig;se Joomla whitelisten variable regler');

define('O_BLACKLIST_COUNTRY', 'Blacklist Land');
define('O_WHITELIST_COUNTRY', 'Whitelist Land');
define('DOWNLOAD_COUNTRY', 'Hent Land Database');
define('DOWNLOAD_NOW', 'Download nu');
define('O_MONITOR_COUNTRY', 'Overv&aring;g land');
define('O_CHANGEALL_COUNTRY', 'Skift Alle lande');
define('O_CHANGEALL_COUNTRY_STATUS', 'Hvilken status vil du gerne &aelig;ndre alle lande ?');
define('O_COUNTRY', 'Land');
define('COUNTRY_STATUS_CHANGED_SUCCESS', 'Landets status er &aelig;ndret med succes.');
define('COUNTRY_STATUS_CHANGED_FAILED', 'Landets status er ikke &aelig;ndret.');
define('COUNTRY_DATA_DELETE_SUCCESS', 'Land data er blevet slettet.');
define('COUNTRY_DATA_DELETE_FAILED', 'Land data er ikke blevet slettet.');

define('O_SCANREPORT_BACKUP', 'Backup');
define('O_SCANREPORT_BKCLEAN', 'Backup og Rens');
define('O_SCANREPORT_RESTORE', 'Genskab');
define('O_SCANREPORT_DELETE', 'Slet');
define('O_SCANREPORT_DELETEALL', 'Slet alt');

define('O_BACKUP_BACKUPDB', 'Backup Database');
define('O_BACKUP_BACKUPFILE', 'Backup Filer');
define('O_BACKUP_DELETEBACKUPFILE', 'Slet');

define('SECURITY_MANAGEMENT','Sikkerheds indstillinger');
define('VARIABLES_MANAGEMENT','Variabler administration');
define('PREMIUM_SERVICE','Velligeholdelse');

define('O_DEVELOPMENT_MODE','Udvikling mode');
define('O_FRONTEND_BLOCKING_MODE','Frontend Blokering tilstand');
define('O_COUNTRY_BLOCKING','Land Blokering');
define('O_SILENTLY_FILTER_HACKING_VALUES_RECOMMENDED_FOR_NEW_USERS','Stille filtrere hacking v&aelig;rdier - Anbefales til nye brugere');
define('O_ADRULESETS','Avanceret Firewall indstillinger (Se <a href ="'.OSE_OEM_URL_ADVFW_TUT.'" target=\'_blank\'>tutorial her</a>)');
define('O_GOOGLE_2_VERIFICATION','Google 2-Step verifikation');
define('O_FILE_UPLOAD_SCANNING','Scan uploadede filer i frontend?');

define('O_SEO_PAGE_TITLE','SEO Side Titel');
define('O_SEO_META_KEY','SEO Meta S&oslash;geord');
define('O_SEO_META_DESC','SEO Meta Beskrivelse');
define('O_SEO_META_GENERATOR','SEO Meta Generator');
define('O_WEBMASTER_EMAIL','Webmaster Kontakt Email');
define('O_CUSTOM_BAN_PAGE','Tilpasset Ban Side');
define('O_SCAN_YAHOO_BOTS','Scan Yahoo Bots');
define('O_SCAN_GOOGLE_BOTS','Scan Google Bots');
define('O_SCAN_MSN_BOTS','Scan MSN Bots');
define('O_SCANNED_FILE_EXTENSIONS','Filtypenavne, der scannes');
define('MAX_FILE_SIZE','Maksimal filst&oslash;rrelse, der skal scannes');
define('AUDIT_WEBSITE','Revision mit Website');
define('OVERVIEW_COUNTRY_MAP','Oversigt over Hacking Aktiviteter By lande');
define('OVERVIEW_TRAFFICS','Trafik Oversigt');
define('RECENT_HACKING_INFO','Seneste Hacking Trafik');
define('PLEASE_ENTER_REQUIRED_INFO','Indtast venligst de n&oslash;dvendige oplysninger.');
define('MY_PREMIUM_SERVICE','Aktiver Min Premium Service');
define('INSTALLATION','Installation');
define('INSTALLDB','Installer Database Tabler');
define('INSTALLDB_INTRO','Installer database oprettet af Gabmedia Security fra din hjemmeside');
define('UNINSTALLNOW','Afinstallere nu');
define('CHANGE_ADMINFORM','Ny Administrator Brugernavn');
define('CHANGE','&aelig;ndre');
define('PHP_CONFIGURATION','PHP Konfiguration');
define('O_RECURRING_ID', 'Tilbagevendende ID');
define('O_CREATED', 'Oprettet');
define('O_PRODUCT', 'Produkt');
define('O_PROFILE_ID', 'Profil ID');
define('O_REMAINING', 'Resterende');
define('O_VIEW', 'Se');
define('CREATE', 'Opret');
define('CREATE_ACCOUNT', 'Opret konto');
define('CREATE_AN_ACCOUNT', 'Opret en konto');
define('FIRSTNAME', 'Fornavn');
define('LASTNAME', 'Efternavn');
define('EMAIL', 'Email');
define('PASSWORD', 'Password');
define('PASSWORD_CONFIRM', 'Bekr&aelig;ft Password');
define('TUTORIAL', 'Tutorial');
define('COUNTRY_CHANGED_SUCCESS','Landet status &aelig;ndres med succes');
define('ACTIVATION_CODES', 'Firewall Aktiverings Koder');
define('ACTIVATION_CODE_TITLE', 'Aktiverings Koder');
define('ACTIVATION_CODE_DESC', 'Dette panel viser aktivering koder af firewallen i php.ini eller .htaccess for hele serveren.');
define('AFFILIATE_ACCOUNT', 'Affiliate kontooplysninger');
define('ADD_TRACKING_CODE', 'Tilf&oslash;j Tracking Koder');
define('TRACKINGCODE_CANNOT_EMPTY', 'Sporing Koder kan ikke v&aelig;re tomme');
define('TRACKINGCODE_UPDATE_SUCCESS', 'FEDT! Succesfuld opdateret sporingskoder. I fremtiden, n&aring;r ejeren af denne hjemmeside abonnerer p&aring; vores abonnementstyper, transaktionen vil blive logget ind p&aring; din affiliate konti.');
define('TRACKINGCODE_UPDATE_FAILED', 'Mislykkede opdatering Tracking Koder');
define('WORDPRESS_ADMIN_AJAX_PROTECTION', 'WordPress Admin Ajax Beskyttelse');
define('SCAN', 'Scan');
define('FILE_CONTENT', 'Fil Indhold');
define('O_CUSTOM_BAN_PAGE_URL', 'Brugerdefineret Ban Side URL');
define('SUCCESS', 'Vellykket');
define('SUCCESS_LOGOUT', 'Log ud vellykket ');
define('FIREWALL_RULES','Firewall Regl Optimering');
define('FIREWALL_CONFIGURATION','Firewall Konfiguration');
define('FIREWALL_CONFIGURATION_DESC','Det er den side, som du kan &aelig;ndre indstillingerne for '.OSE_WORDPRESS_FIREWALL.' Firewall.');
define('CRONJOBS','Planlagt Opgaver <small>(Premium)</small>');
define('CRONJOBS_TITLE','Planlagt Opgaver');
define('CRONJOBS_DESC','Opret en planlagt opgave til automatisk at køre på en bestemt dag(e) og tid.');
define('CRONJOBS_LONG','Planlagt Opgaver er en tjeneste, der k&oslash;rer p&aring; '.OSE_WORDPRESS_FIREWALL.' server, der giver dig mulighed for at planl&aelig;gge virus scanner til at k&oslash;re p&aring; et regelm&aelig;ssigt tidspunkt.');
define('HOURS','Timer');
define('WEEKDAYS','Uge dage (Brug Ctrl til multi-v&aelig;lge elementer)');
define('CRON_SETTING_EMPTY','Kontroller, at du har valgt b&aring;de timer og hverdage i cron indstilling form.');
define('LAST_DETECTED_FILE','Mappe med de filer, der tilf&oslash;jes i det scannede k&oslash; i den sidste scanning');
define('ENTER_ACTIVATION_CODE', 'Indtast aktiveringskode');
define('ACTIVATION_CODE', 'Aktiveringskode');
define('ACTIVATE', 'Aktiver');
define('ERROR', 'Fejl');
define('ACTIVATION_CODE_EMPTY', 'Aktiveringskode kan ikke v&aelig;re tom');
define('MAX_DB_CONN', 'Maksimal Database Forbindelse');

// Version 4.4.0
define('PERMCONFIG', 'File/Mappe Tilladelser Konfiguration');
define('PERMCONFIG_DESC', 'Administrere din server\'s  filer & mappe tilladelser konfiguration');
define('PERMCONFIGFORM_DESC', 'V&aelig;lg de nye attributter for den valgte.');
define('PERMCONFIGFORM_NB', '<h5><small><b>NB: </b>Generelt brugte tilladelser: Files 0644 (drw-r--r--) og mapper 0755 (drwxr-xr-x) </small></h5>');
define('PERMCONFIG_SAVE', 'Anvend & Gem konfiguration');
define('PERMCONFIG_EDITOR', 'Rediger tilladelser');
define('PERMCONFIG_CHANGE', 'Skift tilladelser');
define('PERMCONFIG_SHORT', 'Tilladelser Konfiguration');
define('PERMCONFIG_NAME', 'Navn');
define('PERMCONFIG_TYPE', 'Type');
define('PERMCONFIG_OWNER', 'Ejer/Gruppe');
define('PERMCONFIG_PERM', 'Tilladelser');
define('O_DOWNLOAD', 'Download');

// Version 4.4.1;
define('CHOOSE_A_PLAN', 'V&aelig;lg et abonnements plan');
define('SUBSCRIPTION_PLAN', 'Abonnementstyper');
define('SUBSCRIPTION_PLAN_EMPTY', 'Abonnementstyper kan ikke v&aelig;re tom , skal du v&aelig;lge mindst ét abonnement planen.');
define('PAYMENT_METHOD', 'Betalingsmetode');
define('COUNTRY', 'Land');
define('FIRST_NAME', 'Fornavn');
define('LAST_NAME', 'Efternavn');
define('O_NEXT', 'Bekr&aelig;ft ordre');
define('PERMCONFIG_ONECLICKPERMFIX', 'One Click Permisions Fix <small>(Premium)</small>');

// Version 4.7.0;
define('O_CHECKSTATUS', 'Status');
define('RECENT_SCANNING_RESULT', 'Seneste scanning resultat');
define('RECENT_BACKUP', 'Seneste backup');
define('ADMINEMAILS_TITLE', '<b>Administrator Management</b>');
define('ADMINEMAILS_DESC', 'Du kan centralt styre din administrator og dom&aelig;neadressen her');
define('ADMINEMAILS', 'Administrator Management');
define('O_VARIABLE', 'Variabel');
define('EMAIL_EDIT', 'Rediger Email');
define('SCANPATH', 'V&aelig;lg sti');
define('PATH', 'sti');
define('FILETREENAVIGATOR', 'Vejviser Navigator');
define('ADD_DOMAIN', 'Tilf&oslash;j dom&aelig;ne');
define('ADD_ADMIN', 'Tilf&oslash;j Administrator');
define('ADD_ADMIN_ID', 'ID');
define('ADD_ADMIN_NAME', 'Navn');
define('ADD_ADMIN_EMAIL', 'Email');
define('ADD_ADMIN_STATUS', 'Status');
define('ADD_ADMIN_DOMAIN', 'Tildel Dom&aelig;ne');
define('TABLE_DOMAIN', 'Dom&aelig;ne');
define('O_SCANREPORT_CLEAN', 'Ren');
define('O_SCANREPORT_QUARANTINE', 'karant&aelig;ne');
define('O_GOOGLE_2_SECRET', 'Google Autentificering hemmelighed');
define('O_GOOGLE_2_QRCODE', 'Google Autentificering QRCode');
define('PREMIUM_SERVICE_FREE', 'F&aring; din Premium Service gratis');
define('SUBSCRIPTION_SETP1', 'Trin 1 - Opret konto');
define('SUBSCRIPTION_SETP2', 'Trin 2 - Placer en ordre');
define('SUBSCRIPTION_SETP3', 'Trin 3 - Aktiver abonnementet');
define('SUBSCRIPTION_ACTIVATION', 'Abonnement aktivering');
define('SUBSCRIPTION_DESCRIPTION1', 'Du skal blot oprette en konto ved hj&aelig;lp af formularen i h&oslash;jre side nedenfor, eller hvis du har en konto hos '.OSE_WORDPRESS_FIREWALL.' allerede, blot logge p&aring ved hj&aelig;lp af formularen i venstre side nedenfor. <br/> Vi tilbyder 60 dage 100% tilfredshedsgaranti, hvis du ikke er tilfreds, udsteder vi fuld refusion til dig uden at stille sp&oslash;rgsm&aring;l.');
define('SUBSCRIPTION_DESCRIPTION2', 'Klik derefter p&aring; knappen abonnere at placere en ordre til en subscrption planen. N&aring;r ordren er afgivet, betaler dit abonnement via Paypal eller kreditkort. N&aring;r betalingerne foretages, vil du se et abonnement er aktiv i den abonnementer tabellen.');
define('SUBSCRIPTION_DESCRIPTION3', 'Sidste trin: Klik p&aring; linket abonnement-knappen for at aktivere abonnementet for dette website.');
define('REGISTERED_ACCOUNT_DESC', 'Hvis du allerede har en konto, skal du indtaste din <code> '.OSE_WORDPRESS_FIREWALL.' </code> Kontooplysninger');
define('CENTRORA', ''.OSE_WORDPRESS_FIREWALL.'');
define('OSE', 'Open Source Excellence [OSE]');
define('WEBSITE', 'Websted');
define('NEW_ACCOUNT_DESC', 'Hvis du ikke har en konto, kan du bruge nedenst&aring;ende formular til at oprette en konto.');
define('SIGN_IN', 'Log ind');

define('ADMIN_MANAGEMENT', 'Admin Administration');
define('O_ADVANCED_BACKUP', 'Avanceret Backup Administration');
define('O_ADVANCED_RULE', 'Avanceret Regls&aelig;t Tabel');
define('O_AUTHENTICATION', 'Godkendelse');
define('O_BACKUP_TITLE', 'Backup Administration');
define('DBNOTREADY_AFTER', 'Efter dette, kan du forts&aelig;tte til konfigurationssiden for at &aelig;ndre indstillinger.');
define('SAVE_SETTINGS', 'Gem indstillinger');
define('IP_TABLE_TITLE', 'IP Tabel');
define('PHP_CHECK_STATUS', 'Tjekker status');
define('O_RULESETS_TABLE_TITLE', 'Regls&aelig;t Tabel ');
define('O_SCAN_REPORT_TITLE', 'Scannings Rapport');
define('MY_SUBSCRIPTION', 'Mine abonnementer');
define('VARIABLE_TABLE_TITLE', 'Variabl tabel');
define('O_HELP_CLEAN', '<strong>Brug for rensning?</strong> Vi kan hj&aelig;lpe dig rense inficerede filer. ');
define('RECURSE_INTO', 'Recurse undermapper');
define('APPLY_TO_ALL', 'Anvend p&aring; alle filer og mapper');
define('APPLY_TO_FILES', 'Anvend p&aring;  kun filer');
define('APPLY_TO_FOLDERS', 'Anvend p&aring;  mapper kun');
define('CLICK_TO_ACTIVATE', 'for at aktivere dit abonnement og bruge denne funktion.');
define('AFFILIATE_PROGRAM_DESC', '<b>[Affiliate Tracking] </b>: G&aring; ikke glip af chancen for at tjene mindst $ 14,500 for 1. &aring;r og $ 338,900 i fem &aring;r med vores affiliate program!');
define('SECURITY_BADGE_DESC', '<b>[Security Badge] </b>: Sikkerheds m&aelig;rket er nu deaktiveret. Du kan &oslash;ge salg konvertering af din hjemmeside ved at aktivere den. ');
define('CALL_TO_ACTION_TITLE', 'Vi er her for at hj&aelig;lpe dig');
define('CALL_TO_ACTION_P', 'Vi betjener nu <span id="numofWebsite"></span> Hjemmesider.');
define('CALL_TO_ACTION_UL', '<li>Vi har hjulpet tusindvis af kunder til at beskytte og rense deres hjemmesider siden 2009, hvis du har brug for hj&aelig;lp til at beskytte eller reng&oslash;ring virus p&aring; din hjemmeside, er du velkommen til at <a href="'.OSE_OEM_URL_MAIN.'" target="_blank"><span class="strong">Kontakte os</span></a>.</li>
					<li>Med '.OSE_WORDPRESS_FIREWALL.', har den <span class="strong">Grundl&aelig;ggendefirewall</span> allerede hjulpet dig med at blokere <b>99%</b> systematisk hacking og sikre, at din kunde data er sikret. Hvis du har brug for et <span class="strong">ekstra lag af beskyttelse</span> med de avancerede firewall regler, er du velkommen til at tegne et abonnement plan for at f&aring; den beskyttelse, aktiveret.</li>
					<li>N&aring;r du har mistanke om din hjemmeside er inficeret af ondsindede koder, kan '.OSE_WORDPRESS_FIREWALL.' virus scanner hj&aelig;lpe dig med at s&oslash;ge efter virus indenfor f&aring; minutter. Scanneren vil blive aktiveret, n&aring;r abonnementet aktiveres.</li>
					<li>Ikke alle har brug for faciliteter til at blokere et helt land, men hvis du gerne vil have denne funktion, skal du blot abonnere p&aring; en plan og stoppe trafikker fra et bestemt land nemt og enkelt.</li>');
define('CALL_TO_ACTION_TITLE2', 'Bliv partner');
define('CALL_TO_ACTION_DESC2', 'Hvorfor ikke blive vores partner ved at henvise '.OSE_WORDPRESS_FIREWALL.' til andre virksomheder og kunder. ');
define('CALL_TO_ACTION_TITLE3', 'Brug for mere hj&aelig;lp?');
define('CALL_TO_ACTION_DECS3', 'Hvis du &oslash;nsker at tilf&oslash;je mere beskyttelse, kan du l&aelig;se ');
define('SUBSCRIBE_NOW', 'K&oslash;b nu!');
define('PLEASE_ENTER_CORRECT_EMAIL', 'Indtast venligst den korrekte mail');
define('PASSWORD_DONOT_MATCH', 'Passwordet skal v&aelig;re ens');
define('LOGOUT', 'Log ud');
define('O_DONT_BRACE', 'Redigere ikke teksten i disse felter');

// Version 4.8.0
define('CURRENT_DATABASE_CONNECTIONS','Nuv&aelig;rende database forbindelse');
define('WAITING_DATABASE_CONNECTIONS','Afventende database forbindelse.');
define('YOUR_MAX_DATABASE_CONNECTIONS','Maximalt antalt forbindelser du har angivet.');
define('SCHEDULE_BACKUP', 'Planl&aelig;g backup');
define('CRONJOBSBACKUP_LONG', 'V&aelig;lg backup type samt dag(e) og tid du &oslash;nsker backup til at k&oslash;re.');
define('O_AUTHENTICATION_ONEDRIVE', 'OneDrive bekr&aelig;ftelse');
define('O_ONEDRIVE_LOGOUT', 'OneDrive Logud');
define('O_DROPBOX_LOGOUT' , 'Dropbox Logud');
define('CLOUD_BACKUP_TYPE', 'Cloud Backup Type');
define('O_BACKUP_ONEDRIVE','OneDrive');
define('NONE','Kun lokalt');
define('SAVE_SETTING_DESC','<h5><small>Klik p&aring; Gem indstillinger, hver gang du &aelig;ndrer en indstilling</small></h5>');
define('CLOUD_SETTING_REMINDER','<h5><small>Godkend andre tjenester for at se flere muligheder</small></h5>');
define('OEM_PASSCODE', 'Password');
define('PASSCODE_CONTROL', 'Password Kontrol');
define('PASSCODE', 'Password');
define('VERIFY', 'Bekr&aelig;ft');
define('AUTHENTICATION', 'Cloud Backup Bekr&aelig;ftelse');
define('AUTHENTICATION_TITLE', '<b>Trejde part bekr&aelig;ftelse</b>');
define('AUTHENTICATION_DESC', 'For at aktivere cloud backup bedes bemyndige '.OSE_WORDPRESS_FIREWALL.' til din foretrukne cloud-tjeneste.');

// Version 4.9.0
define('O_UPDATE_SIGNATURE', 'Opdatering Firewall Underskrift');
define('O_UPDATE_VIRUS_SIGNATURE', 'Opdatering Virus Underskrift');
define('RESTORE_EMAIL', 'Gendan til standard');
define('CHANGE_PASSCODE', '&aelig;ndre password');
define('OLD_PASSCODE', 'Gamle password');
define('NEW_PASSCODE', 'Ny password');
define('CONFIRM_PASSCODE', 'Bekr&aelig;ft password');
define('VSSCAN_AND_BACKUP', 'Virus Scan & Backup');
define('CENTRORA_SETTINGS', ''.OSE_WORDPRESS_FIREWALL.' Indstillinger');
define('MY_ACCOUNT', 'Min konto');
define('LOGIN_OR_SUBSCIRPTION', 'Login/abonnement');
define('ADVANCED_FIREWALL_SETTINGS', 'Advanced Firewall Configuration <small>(Premium)</small>');
define('BASIC_FIREWALL_RULES', 'Basic Firewall Rules');
define('ADVANCED_FIREWALL_RULES', 'Advanced Firewall Rules <small>(Premium)</small>');
define('O_GOOGLEDRIVE_LOGOUT', 'Google Drive logud');
define('O_AUTHENTICATION_GOOGLEDRIVE', 'GoogleDrive bekr&aelig;ftelse');
define('O_AUTHENTICATION_DROPBOX', 'Dropbox bekr&aelig;ftelse');
define('O_BACKUP', 'Backup');
define('ADMINISTRATION', 'Administration');
define('FILE_PERMISSION', 'Fil godkendelse');
define('O_BACKUP_GOOGLEDRIVE', 'GoogleDrive');
define('DOWNLOAD_SUCCESS', 'Signatures are updated successfully');

//Version 5.0.0
define('O_FRONTEND_BLOCKING_MODE_403','Vis en 403 fejl side');//previously O_SHOW_A_403_ERROR_PAGE_AND_STOP_THE_ATTACK
define('O_FRONTEND_BLOCKING_MODE_403_HELP','Vis en 403 fejl side og stoppe angreb');
define('O_FRONTEND_BLOCKING_MODE_BAN','Vis forbud side');// previously O_BAN_IP_AND_SHOW_BAN_PAGE_TO_STOP_AN_ATTACK
define('O_FRONTEND_BLOCKING_MODE_BAN_HELP','Ban IP og vis forbud side for at stoppe et angreb');
define('O_ALLOWED_FILE_TYPES','Tilladt upload filtypenavne*');
define('O_ALLOWED_FILE_TYPES_HELP',''.OSE_WORDPRESS_FIREWALL.' Firewall protects against untrusted file uploads. Add extentions of allowed files e.g. jpg, png, doc *Bem&aelig;rk : Fileinfo modul skal installeres korrekt');

define('O_SILENTLY_FILTER_ATTACK','Silent Mode');
define('O_SILENTLY_FILTER_ATTACK_HELP', 'Silently filter hacking values.  To enable this mode, you must have the setting “Frontend Blocking Mode” set as “Show a 403 error page”. Under this mode, the user will be redirected having the URL with the suspicious string trimmed. The IP will not be blocked and will be added into the Monitored IP list. This can avoid false positive detections in some cases. *Recommended for new users');
define('ATTACK_BLOCKING_THRESHOLD','Angreb blokerer RS t&aelig;rskel');
define('ATTACK_BLOCKING_THRESHOLD_HELP', 'Angreb blokerer risikoscore t&aelig;rskel (standard : 35)');
define('SILENT_MODE_BLOCK_MAX_ATTEMPTS','Silent Mode Allowed Threshold');
define('SILENT_MODE_BLOCK_MAX_ATTEMPTS_HELP', 'Maksimalt angreb fors&oslash;g tilladt for en IP i lydl&oslash;s tilstand (standard : 10)');

define('O_WEBMASTER_EMAIL_HELP','This Email address will be used to send Alert Emails from this installation of '.OSE_WORDPRESS_FIREWALL.'');
define('O_RECEIVE_EMAIL','Receive Update Email');
define('O_RECEIVE_EMAIL_HELP','Receive '.OSE_WORDPRESS_FIREWALL.' Firewall or SafeBrowsing Update Email');
define('O_STRONG_PASSWORD', 'Force Strong Password');
define('O_STRONG_PASSWORD_HELP', 'Use this to enforce the use of strong passwords for all users. A strong password incorporates the use of alphanumeric characters & symbols');
define('FIREWALL_HELP','When on, the Firewall is active. Turn this off to deacitivate the Firewall (NOT RECOMMENDED)');
define('O_FRONTEND_BLOCKING_MODE_HELP','Select the blocking mode type used by the Firewall when it\'s turned on');
define('O_GOOGLE_2_VERIFICATION_HELP','Use this to further protect against malicious Admin Login attempts. Turn on and link your wordpress user account under wordpress users!.');
define('O_SEO_PAGE_TITLE_HELP','This is the text you\'ll see at the top of your browser. Search engines view this text as the title of your ban page.');
define('O_SEO_META_KEY_HELP','A series of keywords relevant to the ban page.');
define('O_SEO_META_DESC_HELP','A brief description of the ban page.');
define('O_SEO_META_GENERATOR_HELP','Ban page CMS Generator');
define('O_CUSTOM_BAN_PAGE_HELP','This is the message shown to a Banned User. Custom Ban Page URL below overides this Message.');
define('O_CUSTOM_BAN_PAGE_URL_HELP','When this function is enabled, the attacker will be redirected to the URL as defined which replaces the Custom Ban Page as defined above.');
define('HOURS_HELP', 'Select the hour in the day you want the schedule to run. The hour is based on your timezone as shown e.g. GMT: 10 is Australia/Melbourne Timezone');
define('O_GOOGLE_2_SECRET_HELP', 'Use this code with the Google Authenticator browser plugin');
define('O_GOOGLE_2_QRCODE_HELP', 'Scan this QRCode with a smartphone which has the Google Authenticator App installed');
define('SEO_CONFIGURATION_HELP', 'The SEO Configuration here gives you control over your ban page SEO. This ensures your main site is not affected in search engine rankings.');
define('SEO_CONFIGURATION','Ban Page SEO Configuration');
define('O_STRONG_PASSWORD_SETTING', 'Strong Password Settings');
define('MPL', 'Minimum Password Length');
define('PMI', 'Password Minimum Integers');
define('PMS', 'Password Minimum Symbols');
define('PUCM', 'Password Upper Case Minimum');
define('RECOMMOND_PASSWORD', 'Recommend Settings');
define('RECOMMOND_JOOMLA', 'Joomla Default Settings');
define('COUNTRYBLOCK_HELP', 'This function allows you to block the IPs for specific countries. Please note that you need to Download the Country Database under the menu “Firewall” –> “Country Blocking” first if you want to use this function.');
define('O_ADRULESETS_HELP', '');
define('CONFIG_ADRULES_FAILE', 'Save failed, \'Advanced Firewall Database\' is not ready, please update Firewall Signatures in Advanced Firewall Rules.');
define('DEVELOPMODE_DISABLED','<b>[Firewall Activated] </b>Great! Your website is now protected by Gabmedia Security');
define('DISDEVELOPMODE', '<b>WARNING</b>: Please turn on the Firewall in the Firewall Scanning Configuration to activate the firewall protection.');
define('O_DELETE_ADMIN_SUCCESS', 'Successfully deleted the administrator account');
define('O_DELETE_ADMIN_FAIL', 'There are errors when deleting the administrator account');
define('AFFILIATE_TRACKING', 'Affiliate Program');
define('LOGIN_TITLE', 'Centrora Member Login');
define('LOGIN_DESC', 'You can login here with your Centrora Account or OSE Account to activate your premium services');
define('HOW_TO_ACTIVATE', 'How to activate my premium service?');
define('SUBSCRIPTION_TITLE','Subscription Activation');
define('SUBSCRIPTION_DESC','Please select the subscription plan that you would like to link with this website.');
define ('NEWS_TITLE', '<b>What\'s New</b>');
define ('NEWS_DESC', 'Find out the latest news from Centrora');
define ('PASSCODE_TITLE', 'Passcode');
define ('PASSCODE_DESC', 'Please enter your passcode to access the administrator panel');

// Version 5.0.1
define ('O_LOGIN_PAGE_SETTING', 'Login Url');
define ('O_LOGIN_PAGE_HELP', 'Login Hilfe');
define ('CALL_TO_ACTION_P2', 'Website being hacked? Clean the malware with a free 6 month subscription PLUS 3 months warranty. <br/> <button class="btn btn-primary btn-sm" onClick ="location.href=\''.OSE_OEM_URL_MALWARE_REMOVAL.'\'">Leave the hard work to us now.</button>');
define ('FILE_UPLOAD_MANAGEMENT', 'Uploadkontrolle');
define('FILEEXTENSION', 'Uploadkontrolle');
define('FILEEXTENSION_TITLE', '<b>File</b> <span><b>Uploadkontrolle</b></span>');
define('FILEEXTENSION_DESC', ''.OSE_WORDPRESS_FIREWALL.' Firewall schützt vor nicht vertrauenswürdigen Dateiuploads. In diesem Modul können Sie: <b>1)</b> erlaubte Dateien festlegen <b>2)</b> und den Überblick über hochgeladene Dateien behalten <b>3)</b> sowie bösartige Upload-Versuche verfolgen');
define('FILE_EXTENSION_LIST', 'Liste der Dateierweiterungen');
define('FILE_EXTENSION_LOG', 'Datei Uploadbericht <small>(Premium)</small>');
define('O_VSSCAN_STATUS', 'Virenscan Status');
define('O_IP_STATUS', 'Datei Validierung Status');
define('O_FILETYPE', 'Dateityp');
define('O_FILENAME', 'Dateiname');
define('O_EXTENSION_ID', 'ID');
define('O_EXTENSION_NAME', 'Erweiterung');
define('O_EXTENSION_TYPE', 'Typ');
define('O_EXTENSION_STATUS', 'Status');
define('ADD_EXT', 'Erweiterung hinzufügen');
define ('O_BACKEND_SECURE_KEY', 'Backendzugriff Sicherheitsschlüssel (beta)');
define ('O_BACKEND_SECURE_KEY_HELP', 'Backendzugriff Sicherheitsschlüssel');
define('UPLOAD_FILE_403WARN', 'Der Upload für diesen Dateityp ist auf dieser Website nicht zulässig. <br /> <br />Wenn Sie der Serveradministrator sind, gestatten Sie diesen Dateityp unter Firewall-> Uploadkonfiguration.');
define('FILE_UPLOAD_LOG', 'Datei hochgeladenen');
define('BLOCKED_UPLOAD_LOG', 'Datei gesperrt');
define('INCONSISTENT_FILE', 'Inkonsistente Datei! -IP blockiert');
define('PASSCODE_ENTRY', 'Passcode Entry');
define('PASSCODE_ENTRY_HELP', 'Require passcode to access other views exclude dashboard');
define('UNBAN_PAGE_GOOGLE_AUTH_DESC', 'If you have Unban Google Authenticator enabled and setup, please input your code here');

// Version 5.0.5
define('ADMIN_MANAGER', 'Administrator Manager');
define('SECURITY_MANAGER', 'Security Manager <sup><span>(beta)</span></sup>');
define('O_READMORE', 'Read More');
define('O_OUR_TUTORIAL', 'our tutorial here');
define('O_SUBSCRIBE_PLAN', 'to subscribe a plan');
define('SECURITY_NAME', 'Name');
define('SECURITY_USERNAME', 'Username');
define('SECURITY_EMAIL', 'Email');
define('SECURITY_STATUS', 'Status');
define('SECURITY_CONTACT', 'Contact');
define('ADD_SECURITY_MANAGER', 'Add Security Manager');
define('SECURITY_PASSWORD', 'Password');
define('SECURITY_PASSWORD2', 'Confirm Password');

// Version 5.1.0
define('CORE_SCAN', 'Core Directories Scanner<sup><span>(beta)</span></sup>');
define('CORE_SCAN_TITLE', '<b>Core Directories </b> <span><b>Scanner</b><sup><span>(beta)</span></sup>');
define('CORE_SCAN_DESC', 'Core directories Scanner is a neat and quick detector, it scans the core directories of your website and detects suspicious files.');
define('Vl_SCAN', 'Vulnerabilities Scanner');
define('Vl_SCAN_TITLE', '<b>Vulnerabilities Scanner</b> <sup><span>(beta)</span></sup>');
define('Vl_SCAN_DESC', 'Vulnerabilities Scanner is a powerful vulnerability detector. It scans through your website and detects any real vulnerabilities.');
define('Vl_SCAN_CRED_WPSCAN', 'Credits to WPScan Vulnerability');
define('START_NEW_SCAN', 'Start Scanning');

define('JOOMLA_TWOFACTORAUTH', 'Two Factor Authentication - Google Authenticator');
define('JOOMLA_TWOFACTORAUTH_HELP', 'Allows users on your site to use two factor authentication using Google Authenticator or other compatible time-based One Time Password generators. To use two factor authentication please edit the user profile and enable two factor authentication.');
define('NO_HASHES_FOR_ALPHA', "Current Joomla! version is a non-stable version, we recommand you upgrade to the latest stable version. Hashes for non-stable version is not available. <strong>Centrora will update hashes once a new joomla stable version releases.</strong>");
define('BRUTEFORCE_SETTINGS', 'Brute Force Protection');
define('BRUTEFORCE_MAX_ATT', 'Maximum login attempts');
define('BRUTEFORCE_MAX_ATT_HELP', 'This will blacklist the IP address if the user exceeds the maximum login attempts.');
define('BRUTEFORCE_TIME', 'Time Period of counting login attempts');
define('BRUTEFORCE_TIME_HELP', 'This period is the time frame of counting login attempts');
define('BRUTE_FORCE_STATUS', 'Brute Force Protection Status');
define('BRUTE_FORCE_STATUS_HELP', 'Brute Force Protection will set a login attempts limit and time frame to ensure that hackers who try to brute force into your sites will be blocked');

define('VL_CHECK_VUL','Scanning for vulnerabilities...');
define('VL_GET_LIST','Generating scan list...');
define('VL_COMPLETE','Scanning Complete with the result:');
define('VL_CALL_TOACTION', 'We highly recommend you update the following to the latest version immediately, or if you are no longer using it, remove it from your site. If your site has been compromised due to this vulnerability, <a href="'.OSE_OEM_URL_MALWARE_REMOVAL.'" target="_blank" > we can help </a>.');

define('ADMIN_SETTINGS', 'Administrator Settings');
define('CENTRORA_GOOGLE_AUTH', 'Centrora Google Authenticator');
define('CENTRORA_GOOGLE_AUTH_HELP', 'Enable centrora google authenticator and scan the QR code, you can pass through the ban page or 403 forbidden page by inputting the correct google authentication code');
define('UPLOAD_FILE_403WARN2', 'You are uploading a suspicous file(file content <strong>does not</strong> match file extension). <br /> <br />If you are the server administrator, please notice that this is a suspicious file.');
define('SETSCANPATH', 'Set Scan Path');
define('SURF_SCAN', 'Static Scanner <sup><span>(beta)</span></sup>');
define('SURF_SCAN_TITLE', '<b>Static Scanner</b> <span><sup>(beta)</sup></span>');
define('SURF_SCAN_DESC', 'Static Scanner checks for all known viruses and malware. It is recommended that if nothing is detected you use the Dynamic Scanner');
define('DEEPSCAN', 'Dynamic Scanner');
define('SURF_SCAN_SIG_UPDATED', 'Your Static Scan signatures have been updated!');
define('SURF_SCAN_SIG_UPTODATE', 'Great! Your Static Scan signatures are up-to-date.');
define('SURF_SCAN_SIG_NOTUPTODATE', 'Updating Your Static Scan signatures.');
define('SURF_SCAN_CALL_TOACTION', 'We highly recommend you review the files listed immediately! If your site has been compromised due to the malicious file(s), <a href="'.OSE_OEM_URL_MALWARE_REMOVAL.'" target="_blank" > we can help</a>.');

// Version 5.1.5
define('FILE_PERM_SCAN', 'File Permissions Scanner<sup><span>(beta)</span></sup>');
define('FILE_PERM_SCAN_TITLE', '<b>File Permissions Scanner</b> <sup><span>(beta)</span></sup>');
define('FILE_PERM_SCAN_DESC', 'File Permissions Scanner can detect files with insecure file permission and repair them with just one click(For folders, folder permission will be set to 755, for files, file permission will be set to 644). ');
define('CHOOSE_MULTISITE', 'Choose sites to scan');
define('SUITE_CF_NOTICE', 'Please notice that this core file scanner only works on wordpress or joomla site');
define('NO_DETECT_WEBSITE', 'No Joomla or Wordpress sites detected, Please note only Joomla or Wordpress site can use this function');
define('CLEAR_BACKUP_TIME', 'Clean old backups');
define('LAST_ONE_WEEK', 'Keep last one week');
define('LAST_TWO_WEEK', 'Keep last two weeks');
define('LAST_THREE_WEEK', 'Keep last three weeks');
define('LAST_FOUR_WEEK', 'Keep last four weeks');
define('LAST_TWO_MONTH', 'Keep last two months');
define('LAST_THREE_MONTH', 'Keep last three months');
define('LAST_HALF_YEAR', 'Keep last half year');
define('LAST_FOREVER', 'Keep all backups');
define('O_BK_TAB_BACKUPS', 'Backups');
define('O_BK_TAB_NEW_BACKUP', 'Create New');
define('O_AUTHENTICATION_BACKUP', '&nbspAuthentication');
define('O_LOGOUT', '&nbspLogout');

define('SETDATE', 'Set Date Range');
define('SETSTARTDATE', 'Set Start Date');
define('SETENDDATE', 'Set End Date');
define('SYMLINK', 'Scan symbolic link');
define('MF_SCAN', 'Modified Files Scanner');
define('MF_SCAN_TITLE', '<b>Modified Files Scanner</b> <sup><span>(beta)</span></sup>');
define('MF_SCAN_DESC', 'The Modified Files Scanner can detect modified files within a certain time period and files which are symbolic links.');
define('O_RESTORE_TEST', 'Restore testing button');
define('O_BASE_FILEPERM', 'Base file permission');
define('O_BASE_FOLDERPERM', 'Base folder permission');
define('CLEAR_BLACKLIST_URL', 'Clear Blacklist Cronjob Url (See <a href ="' . OSE_OEM_URL_ADVFW_TUT . '" target=\'_blank\'>Tutorial Here</a>)');
define('CATCH_VIRUS_MD5', 'Update Virus MD5');
define('O_BACKUP_ACTION', 'Action');
define('FPSCAN_CALL_TOACTION', 'Please review the modified files listed.');

define('O_SCANREPORT_MARKASCLEAN', 'Mark As Clean');

define('BLOCKED_SUS_UPLOAD_LOG', 'Suspicious upload attempt! - IP Blocked');
define('UPLOAD_FILE_403WARN3', 'You are uploading a suspicous file to a not existing url. <br /> <br />If you are the server administrator, please notice that this is a suspicious file.');
define('AI_SCANNER', 'AI Scanner');
define('OVERVIEW_COUNTRY_MAP_BTN', 'Hacking Overview');
define('OVERVIEW_TRAFFICS_BTN', 'Traffic Overview');
define('RECENT_SCANNING_RESULT_BTN', 'Recent Scanning');
define('RECENT_HACKING_INFO_BTN', 'Recent Hacking');
define('RECENT_BACKUP_BTN', 'Recent Backup');
define('AI_SCAN_TITLE', 'AI Scanner');
define('AI_SCAN_DESC', 'AI Scanner, internal use only');

//brief description for subscription
define('COUNTRYBLOCK_DESC_BRIEF', '<b>Blocking countries</b> with high spam scores will save you bandwidth and reduce the chance of being hacked.  Country Blocking Panel allows you to block specific countries in our feature rich web application firewall.');
define('ANTIVIRUS_DESC_BRIEF', 'Though viruses keep changing, the <b>Dynamic Virus Scanner</b> detects virus files based on our daily updated signatures, fast and accurately !');
define('CORE_SCAN_DESC_BRIEF', '<b>Core Directory Scanner </b>checks the core files against the standard package to dig out suspicious files quickly.');
define('SCANREPORT_DESC_BRIEF', '<b>Detail report</b> of virus detected with the ability of batch malware removal, backup and quarantine.');
define('CRONJOBS_DESC_BRIEF', '<b></b>Allows you leave the machine do the routine maintenance tasks so you can focus on your core business.');
define('AUTHENTICATION_DESC_BRIEF', 'Make the best use of free resources from <br><b>Dropbox, Google and Microsoft Drive</b>. <br>Store the files in the cloud drives.');
define('FIREWALL_CONFIGURATION_DESC_BRIEF', 'With <b>'.OSE_WORDPRESS_FIREWALL.'</b>, the basic firewall we have already helped you block over 95% of threats. To further harden your web application firewall you might consider an additional layer of protection with the advanced firewall rules, feel free to subscribe.');
define('MANAGERULESETS_DESC_BRIEF', 'We highly recommend to activate all of the security functions to carry the best out of '.OSE_WORDPRESS_FIREWALL.'');

//slogan for subscription
define('COUNTRYBLOCK_DESC_SLOGAN', 'Simply subscribe to a plan and stop spammers traffic<br> from a specific country immediately.');
define('ANTIVIRUS_DESC_SLOGAN', 'Dig out the well-hidden virus / malicious codes in your website within minutes.<br>'. OSE_WORDPRESS_FIREWALL .' Dynamic Virus Scanner can help you');
define('CORE_SCAN_DESC_SLOGAN', 'Detect underlying malware and modified core files more efficiently<br> by checking current core files against the original ones.');
define('SCANREPORT_DESC_SLOGAN', 'Review, clean, quarantine and delete malware and malicious codes,<br> get your site back on track within minutes.');
define('CRONJOBS_DESC_SLOGAN', 'Set up schedule tasks for automatic Virus Scanning and Backup.');
define('AUTHENTICATION_DESC_SLOGAN', 'Save your backups remotely with Cloud Backup.');
define('FIREWALL_CONFIGURATION_DESC_SLOGAN', 'Enhance your website security by adding an Advanced Web Application Firewall <br>Get your websites <b>malware-free</b>.');
define('MANAGERULESETS_DESC_SLOGAN', 'Fine-tune the firewall rules to better suit your online business!');

define('O_EXPORT_INFECTED_CSV', 'Export infected files to CSV');
define('IMPROVE', 'Improve');
define('SCHEDULE', 'Schedule');
define('PROTECT', 'Protect');
define('MANAGE', 'Manage');
define('FILEPERM_EDITOR', 'File Permissions Editor');
define('BACK_TO_JOOMLA', 'Back to Joomla');


// 6.1.0
define('ACTIVATE_SPECIFIC_DOMAIN', 'Activate');
define('MAX_EX_TIME', 'Maximum Execution Time');
define('GIT_ID', 'Commit ID');
define('GIT_DATE', 'Commit Time');
define('SR_NO', "No");
define('HEAD', 'Current Copy');
define('GIT_MESSAGE', 'Commit Message');
define('GIT_ROLLBACK', 'Restore');

//6.2.0
define('GITBACKUP', 'Git Backup<sup><span>(New)</span></sup>');
define('CRONJOBS_GITBACKUP','Select how often git backup to run.');
define('CRONJOBS_FREQUENCY','Frequency');
define('CRONJOBS_FREQUENCY_HELP','Select the frequency you want the schedule git backup to run.');
define('SCHEDULE_GITBACKUP', 'Schedule Git Backup' );
define('BITBUCKET_ACC' , 'Bitbucket Account');
define('GITCREMOTE_USERNAME', 'Username');
define('GITCREMOTE_PASSWORD', 'Password');
define('GITCREMOTE_REPO_NAME', 'Repository name');
define('GITCREMOTE_OWNER_NAME', 'Owner');

define('CREATE_REPOSITORY', 'Create a private repository in Bitbucket');
define("O_ENABLED_IPV6", "Enable IPv6");

define("COMMIT_MESSAGE", "Backup Description");
define("SUBMIT_COMMIT_MSG", "Backup Now");
define("ZIP_DOWNLOAD","Download");
define("COMMIT","Backup");
define("RECOMMENDATION_COMMIT", "The system has detected some unsaved changes, It is highly recommended to do a backup first");
define("RECOMMENDATION_DATABASE","It is highly recommended that you should NOT restore the old database");


?>
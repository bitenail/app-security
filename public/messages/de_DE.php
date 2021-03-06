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
//Start here;
define('O_LATEST_SIGNATURE', '20140901');
define('O_LATEST_PATTERN', 'Neueste Version der Viren-Signaturen (Hauptupdate) ist 20140901, aktualisiert am 1. September 2014');
define('OSE_WORDPRESS_FIREWALL_SETTING', ''.OSE_WORDPRESS_FIREWALL.' Einstellungen');
define('OSE_WORDPRESS_FIREWALL_SETTING_DESC', ''.OSE_WORDPRESS_FIREWALL.' ist eine Web Application Firewall für Wordpress erstellt von <a href="'.OSE_OEM_URL_MAIN.'" target="_blank">'.OSE_WORDPRESS_FIREWALL_SHORT.'</a>. Diese schützt Ihre Website effektiv vor Angriffen und Hacker.');
define('OSE_WORDPRESS_FIREWALL_UPDATE_DESC', ''.OSE_WORDPRESS_FIREWALL.' ist eine Web Application Firewall für Wordpress erstellt von <a href="'.OSE_OEM_URL_MAIN.'" target="_blank">'.OSE_WORDPRESS_FIREWALL_SHORT.'</a>. Diese schützt Ihre Website effektiv vor Angriffen und Hacker.');
define('OSE_DASHBOARD', 'Armaturenbrett');
define('OSE_DASHBOARD_SETTING', 'Armaturenbrett Einstellungen');
define('NOTIFICATION_EMAIL_ATTACKS', 'E-Mail-Adresse, welche die Benachrichtigung über Angriffe empfängt');
define('EMAIL_ADDRESS', 'E-Mail-Adresse');
define('FIREWALL_SCANNING_OPTIONS', 'Firewall Scanoptionen');
define('BLOCKBL_METHOD', 'Blacklist-Methoden (Verfolgen / Löschen / Beobachten)');
define('CHECK_MUA', 'Überprüft böswillige Benutzeragenten');
define('checkDOS', 'Überprüft grundlegende DoS / Web-Anwendung Überschwemmungs-Angriffe');
define('checkDFI', 'Überprüft grundlegenden direkten Datei-Einschluss');
define('checkRFI', 'Überprüft grundlegenden entfernten Datei-Einschluss');
define('checkJSInjection', 'Überprüft grundlegende Javascript-Injektion');
define('checkSQLInjection', 'Überprüft grundlegende Datenbank SQL-Injektion');
define('checkTrasversal', 'Erkennen von Verzeichnis-Übergängen');
define('ADVANCE_SETTING', 'Erweiterte Einstellungen');
define('OTHER_SETTING', 'Weitere Einstellungen');
define('BLOCK_QUERY_LONGER_THAN_255CHAR', 'Blockiere Abfragen länger als 255 Zeichen');
define('BLOCK_PAGE', 'Sperrseite für Angreifer');
define('OSE_BAN_PAGE', ''.OSE_WORDPRESS_FIREWALL.' Sperrseite verwenden');
define('BLANK_PAGE', 'Eine leere Seite anzeigen');
define('ERROR403_PAGE', '403-Fehlerseite anzeigen');
define('TEST_CONFIGURATION', 'Testen der Konfiguration');
define('TEST_CONFIGURATION_NOW', 'Testen Sie Ihre Konfiguration jetzt!');
define('SAVE_CHANGES', 'Änderungen sichern');
define('WHITELIST_VARS', 'Whitelist Variablen (verwenden Sie bitte ein Komma "," um die Variablen zu trennen.)');
define('BLOCK_MESSAGE', 'Ihre Anfrage wurde gesperrt!');
define('FOUNDBL_METHOD', 'Blacklist-Methoden gefunden (Verfolgen / Löschen / Beobachten)');
define('FOUNDMUA', 'Böswilliger Benutzeragent gefunden');
define('FOUNDDOS', 'Grundlegende DoS-Attacken gefunden');
define('FOUNDDFI', 'Grundlegender direkter Datei-Einschluss gefunden');
define('FOUNDRFI', 'Grundlegender entfernter Datei-Einschluss gefunden');
define('FOUNDJSInjection', 'Grundlegende Javascript-Injektion gefunden');
define('FOUNDSQLInjection', 'Grundlegende Datenbank SQL-Injektion gefunden');
define('FOUNDTrasversal', 'Verzeichnis-Übergang gefunden');
define('FOUNDQUERY_LONGER_THAN_255CHAR', 'Abfrage länger als 255 Zeichen gefunden');
define('MAX_TOLERENCE', 'Maximale Toleranz für einen Angriff');
// Langauges for version 1.5 + start from here;
define('OSE_SCANNING_SETTING','Scaneinstellung');
define('OSE_SCANNING','Scan');
define('SERVERIP','Ihre Server-IP (zur Vermeidung von Fehlalarmen durch leeren Benutzeragent)');
define('OSE_WORDPRESS_FIREWALL_CONFIG',''.OSE_WORDPRESS_FIREWALL.' Konfiguration');
define('OSE_WORDPRESS_VIRUSSCAN_CONFIG','Virenscannerkonfiguration');
define('OSE_WORDPRESS_VIRUSSCAN_CONFIG_DESC','Bitte konfigurieren Sie Ihre Virenschutzparameter hier.');
define('START_DB_INIT','Initialisiere Datenbank');
define('STOP_DB_INIT','Aktion stoppen');
define('START_NEW_VIRUSSCAN','Neuen Multi-Threads Scan starten');
define('CONT_VIRUSSCAN','Multi-Threads Scan fortsetzen');
define('START_NEW_SING_VIRUSSCAN','Neuen Single-Thread Scan starten');
define('OSE_SCANNED',''.OSE_WORDPRESS_FIREWALL.' hat gescannt');
define('OSE_FOLDERS','Ordner');
define('OSE_AND','und');
define('OSE_FILES','Dateien');
define('OSE_INFECTED_FILES','infizierte Dateien');
define('OSE_INTOTAL','in Summe von');
define('OSE_THERE_ARE','Es gibt');
define('OSE_IN_DB','in der Datenbank');
define('OSE_VIRUS_SCAN','Virenscanner');
define('OSE_VIRUS_SCAN_DESC',''.OSE_WORDPRESS_FIREWALL.' WordPress Virenscanner sucht und bereinigt WordPress Schadsoftware und überwacht Ihre Website auf einer 7x24-Basis.');
define('CUSTOM_BANNING_MESSAGE','Benutzerdefinierte Sperrnachricht');
define('FILEEXTSCANNED','Zu scannende Dateierweiterungen');
define('DONOTSCAN','Scanne keine Dateien größer als (Einheit: Megabyte)');
define('PLEASE_CHOOSE_OPTION','Bitte wählen Sie eine Option');
define('COMPATIBILITY','Kompatibilität');
define('OSE_PLEASE_CONFIG_FIREWALL','Konfigurieren Sie die Firewalleinstellungen hier.');
define('OSE_FOLLOWUS','Folgen Sie uns, um auf dem laufenden zu bleiben.');
define('OSE_ID_INFO',''.OSE_WORDPRESS_FIREWALL.'-Kontoinformationen (Bitte nur ausfüllen, wenn Sie ein advanced/professional Mitglied sind).');
define('OSE_ID','OSE ID (Benutzername auf der '.OSE_WORDPRESS_FIREWALL.' Website).');
define('OSE_PASS','OSE Password (Kennwort auf der '.OSE_WORDPRESS_FIREWALL.' Website).');
define('OSE_SCAN_SUMMARY','Scan-Zusammenfassung');
define('OSE_SCAN_ACTIVITY','Detaillierte Scanaktivität');
define('OSE_WEBSITE_PROTECTED_BY','Diese Website ist geschützt druch');
define('OSE_PROTECTION_MODE','Schutzmodus');
define('OSE_FIREWALL_ONLY','Geschützt durch '.OSE_WORDPRESS_FIREWALL.'');
define('OSE_SECSUITE_ONLY','Geschützt durch '.OSE_WORDPRESS_FIREWALL.'');
define('OSE_FWANDSUITE','Geschützt durch '.OSE_WORDPRESS_FIREWALL.'');
define('OSE_SUITE_PATH','Absoluter Pfad von '.OSE_WORDPRESS_FIREWALL.'.<br/>z.B. /home/youraccount/public_html/osesecurity/ <br/> (Bitte stellen Sie sicher, dass Sie die <a href ="'.OSE_OEM_URL_MAIN.'" target="_blank">'.OSE_WORDPRESS_FIREWALL.'</a> bereits installiert haben)');
define('NEED_HELP_CLEANING','Brauchen Sie Hilfe, um die schädlichen Dateien zu entfernen?');
define('NEED_HELP_CLEANING_DESC','Viren verändern sich im Laufe der Zeit. Unsere Virendefinitionen können möglicherweise nicht so aktuell sein, um die neuesten Schädlinge in Ihrem infizierten System zu erkennen. In diesem Fall können Sie gerne unseren Malware-Entfernungs-Dienst <a href="'.OSE_OEM_URL_MAIN.'" target="_blank" >beauftragen</a>. Die neu gefundenen Muster in Ihrer Website werden der Gemeinschaft bereitgestellt und tragen zur besseren Erkennung bei.');
define('OSE_DEVELOPMENT','Entwicklungsmodus (Schutz wird vorübergehend deaktiviert)');
// Langauges for version 1.6 + start from here;
define('OSE_ENABLE_SFSPAM','Stop Forum Spam Erkennung aktivieren');
define('OSE_YES','Ja');
define('OSE_NO','Nein');
define('OSE_SFSPAM_API','Stop Forum Spam API-Schlüssel');
define('SFSPAMIP','Stop Forum Spam IP');
define('OSE_SFS_CONFIDENCE','Konfidenzintervall (zwischen 1 und 100, je höher desto wahrscheinlicher Spam)');
define('OSE_SHOW_BADGE','Website-Schutzsiegel zeigen <br/>(Bitte benutzen Sie zuerst den Virenscanner um Ihre Website zu durchsuchen)');
// Languages for version 2.0 start from here:
define('DBNOTREADY','<b>WARNUNG</b>: Die Datenbank ist nicht bereit, bitte klicken Sie auf die Schaltfläche "installieren", um die Tabellen in der Datenbank zu erstellen');
define('DBNOTREADY_OTHER','<b>WARNUNG</b>: Die Datenbank ist nicht bereit, rufen Sie das Armaturenbrett auf um die Datenbank zu installieren.');
define('DASHBOARD_TITLE','Armaturenbrett');
define('INSTALLNOW','Jetzt installieren');
define('UNINSTALLDB', 'Deinstallieren');
define('UNINSTALLDB_INTRO', 'Entfernen der von '.OSE_WORDPRESS_FIREWALL.' erstellten Datenbank von Ihrer Website');
define('UPDATEVERSION', 'Aktualisieren');
define('SUBSCRIBE', 'Abonnieren');
define('READYTOGO','Alles ist bereit! Wenn Sie die Datenbank entfernen möchten, gehen Sie bitte zur Konfiguration');
define('CREATE_BASETABLE_COMPLETED',' > Erstellen der Basistabelle abgeschlossen, weiter...');
define('INSERT_CONFIGCONTENT_COMPLETED',' > Einfügen der Konfigurationsdaten abgeschlossen, weiter...');
define('INSERT_EMAILCONTENT_COMPLETED',' > Einfügen von E-Mail-Daten abgeschlossen, weiter...');
define('INSTALLATION_COMPLETED',' > Datenbankinstallation abgeschlossen.');
define('INSERT_ATTACKTYPE_COMPLETED',' > Angriffsmuster-Informationen Installation abgeschlossen, weiter...');
define('INSERT_BASICRULESET_COMPLETED',' > Grundlegende Rolleninformationen Installation abgeschlossen, weiter...');
define('CREATE_IPVIEW_COMPLETED',' > IP-ACL Zuordnungsansicht Erstellung abgeschlossen, weiter...');
define('CREATE_ADMINEMAILVIEW_COMPLETED',' > Admin-E-Mmail Zuordnungsansicht Erstellung abgeschlossen, weiter...');
define('CREATE_ATTACKMAPVIEW_COMPLETED',' > ACL-Angriff Zuordnungsansicht Erstellung abgeschlossen, weiter...');
define('CREATE_ATTACKTYPESUMEVIEW_COMPLETED',' > Angriffstyp Zuordnungsansicht Erstellung abgeschlossen, weiter...');
define('INSERT_FILEEXTENSION_COMPLETED', ' > File extension Installation Completed, continue...');
define('INSERT_OEMID_COMPLETED', ' > OEM ID Installation Completed, continue...');
define('INSERT_STAGE1_GEOIPDATA_COMPLETED',' > GeoIP Daten-Stufe 1 Installation abgeschlossen, weiter...');
define('INSERT_STAGE2_GEOIPDATA_COMPLETED',' > GeoIP Daten-Stufe 2 Installation abgeschlossen, weiter...');
define('INSERT_STAGE3_GEOIPDATA_COMPLETED',' > GeoIP Daten-Stufe 3 Installation abgeschlossen, weiter...');
define('INSERT_STAGE4_GEOIPDATA_COMPLETED',' > GeoIP Daten-Stufe 4 Installation abgeschlossen, weiter...');
define('INSERT_STAGE5_GEOIPDATA_COMPLETED',' > GeoIP Daten-Stufe 5 Installation abgeschlossen, weiter...');
define('INSERT_STAGE6_GEOIPDATA_COMPLETED',' > GeoIP Daten-Stufe 6 Installation abgeschlossen, weiter...');
define('INSERT_STAGE7_GEOIPDATA_COMPLETED',' > GeoIP Daten-Stufe 7 Installation abgeschlossen, weiter...');
define('INSERT_STAGE8_GEOIPDATA_COMPLETED',' > GeoIP Daten-Stufe 8 Installation abgeschlossen, weiter...');
define('INSERT_VSPATTERNS_COMPLETED',' > Virensignaturen einfügen abgeschlossen, weiter...');
define('MANAGEIPS_TITLE','IP-Steuerung');
define('MANAGEIPS_DESC','Blockieren und verwalten Sie den Zugriff von IP-Adressen. '.OSE_WORDPRESS_FIREWALL.' erkennt automatisch verdächtige IP-Adressen und überwacht diese standardmäßig.');
define('IP_EMPTY','IP ist leer');
define('IP_INVALID_PLEASE_CHECK','Die IP-Adresse ist ungültig. Überprüfen Sie bitte, ob eines Ihrer Oktette größer als 255 ist');
define('IP_RULE_EXISTS','Die Zugriffsregeln für diese IP-Adresse / IP-Bereich sind bereits vorhanden.');
define('IP_RULE_ADDED_SUCCESS','Die Zugriffsregeln für diese IP-Adresse / IP-Bereich wurden erfolgreich hinzugefügt.');
define('IP_RULE_ADDED_FAILED','Die Zugriffsregeln für diese IP-Adresse / IP Adressbereich wurden erfolglos hinzugefügt.');
define('IP_RULE_DELETE_SUCCESS','Die Zugriffsregeln für diese IP-Adresse / IP-Bereich wurden erfolgreich entfernt.');
define('IP_RULE_DELETE_FAILED','Die Zugriffsregeln für diese IP-Adresse / IP-Bereich wurden erfolglos entfernt.');
define('IP_RULE_CHANGED_SUCCESS','Die Zugriffsregeln für diese IP-Adresse / IP-Bereich wurden erfolgreich geändert.');
define('IP_RULE_CHANGED_FAILED','Die Zugriffsregeln für diese IP-Adresse / IP-Bereich wurden erfolglos geändert.');
define('MANAGE_IPS', 'IP-Steuerung');
define('RULESETS','Firewallkonfiguration');
define('MANAGERULESETS_TITLE','<b>Firewallregeln</b> <span><b>Feinabstimmung</b></span>');
define('MANAGERULESETS_DESC','Aktivieren oder deaktivieren Sie bestimmte Firewallregeln. Sie können die Sicherheitsfeatures von '.OSE_WORDPRESS_FIREWALL.' durch Deaktivieren von bestimmten Sicherheitsfunktion ändern. Um das bestmögliche Ergebnis zu erziehlen, wird dringend empfohlen, alle Sicherheitsfunktionen zu aktivieren');
define('ADRULESETS', 'Erweiterte Firewallregeln Feinabstimmung');
define('MANAGE_AD_RULESETS_TITLE','<b>Erweiterte Firewalleinstellungen</b>');
define('MANAGE_AD_RULESETS_DESC','Modul um Ihre erweiterten Regeln zu verwalten');
define('ITEM_STATUS_CHANGED_SUCCESS','Der Status des Elements wurde erfolgreich geändert');
define('ITEM_STATUS_CHANGED_FAILED','Der Status des Elements wurde erfolglos geändert');
define('CONFIGURATION','Konfiguration');
define('CONFIGURATION_TITLE','<b>Installation</b>');
define('CONFIGURATION_DESC','Sie können hier die Tabellen der Datenbank installieren oder deinstallieren');
define('SEO_CONFIGURATION_TITLE','<b>Suchmaschinenkonfiguration</b>');
define('SEO_CONFIGURATION_DESC','Suchmaschineneinstellungen welche Ihre Rankings schützen, selbst wenn Ihre Website Google-Bots blockiert. Entwerfen Sie eine Nachricht, welche für blockierte Besucher angezeigt wird');
define('CONFIG_SAVE_SUCCESS','Die Konfiguration wurde erfolgreich gespeichert.');
define('CONFIG_SAVE_FAILED','Die Konfiguration wurde erfolglos gespeichert');
define('SCAN_CONFIGURATION','Scankonfiguration');
define('SCAN_CONFIGURATION_TITLE', 'Firewallkonfiguration');
define('SCAN_CONFIGURATION_DESC','Verbinden Sie '.OSE_WORDPRESS_FIREWALL.' mit Ihrem API-Schlüssel und konfigurieren Sie die Firewall-Scaneinstellungen');
define('ANTISPAM_CONFIGURATION','AntiSpam-Konfiguration');
define('ANTISPAM_CONFIGURATION_TITLE','<b>AntiSpam-Konfiguration</b>');
define('ANTISPAM_CONFIGURATION_DESC','Aktivieren oder deaktivieren Sie Stop Forum Spam um beständige Spammer auf Message-Boards und Blogs zu sperren');
define('EMAIL_CONFIGURATION','E-Mail-Konfiguration');
define('EMAIL_CONFIGURATION_TITLE','<b>E-Mail-Konfiguration</b>');
define('EMAIL_CONFIGURATION_DESC','Konfiguration der E-Mail-Vorlage für gesperrte, gefilterte und als 403 blockierte erkannte Angriffe');
define('EMAIL_TEMPLATE_UPDATED_SUCCESS','Die E-Mail-Vorlage wurde erfolgreich geändert.');
define('EMAIL_TEMPLATE_UPDATED_FAILED','Die E-Mail-Vorlage wurde erfolglos geändert.');
define('EMAIL_ADMIN','Administrator-E-Mail-Zuordnung');
define('EMAIL_ADMIN_TITLE','<b>Administrator-E-Mail</b> <span><b>Zuordnung</b></span>');
define('EMAIL_ADMIN_DESC','Entscheiden Sie, welcher Administrator E-Mails für erkannte Angriffe (gesperrte, gefilterte, und 403 blockierte Einträge) erhält');
define('LINKAGE_ADDED_SUCCESS','Die Verbindung wurde erfolgreich hinzugefügt.');
define('LINKAGE_ADDED_FAILED','Die Verbindung wurde erfolglos hinzugefügt.');
define('LINKAGE_DELETED_SUCCESS','Die Verbindung wurde erfolgreich gelöscht.');
define('LINKAGE_DELETED_FAILED','Die Verbindung wurde erfolglos gelöscht.');
define('ANTIVIRUS_CONFIGURATION','Virenscannerkonfiguration');
define('ANTIVIRUS_CONFIGURATION_TITLE','<b>Virenscannerkonfiguration</b>');
define('ANTIVIRUS_CONFIGURATION_DESC','Konfigurieren Sie die Einstellungen für den Virenscanner, legen Sie die zu prüfenden Dateierweiterung fest und begrenzen Sie die Größe der zu prüfenden Dateien');
define('ANTIVIRUS', 'Virenscanner <small>(Premium)</small>');
define('ANTIVIRUS_TITLE','<b>Virenscanner</b>');
define('ANTIVIRUS_DESC','Der Virenscanner ist ein leistungsstarker Schadsoftware-Detektor, er wirkt wie ein Antivirus ist aber leistungsfähiger. Er scannt durch jede einzelne Datei auf Ihrem Server oder in einem bestimmten Pfad nach Viren, Malware, Spam, Schadsoftware, SQL-Injektionen, Sicherheitslücken usw.');
define('LAST_SCANNED','Zuletzt geprüfter Ordner:');
define('LAST_SCANNED_FILE','Zuletzt geprüfte Datei: ');
define('OSE_FOUND',OSE_WORDPRESS_FIREWALL.' gefunden');
define('OSE_ADDED',OSE_WORDPRESS_FIREWALL.' hinzugefügt');
define('IN_THE_LAST_SCANNED','in der letzten Prüfung,');
define('O_CONTINUE','weiter...');
define('SCANNED_PATH_EMPTY','Bitte stellen Sie sicher, dass der zu prüfende Pfad nicht leer ist.');
define('O_PLS', 'Bitte');
define('O_SHELL_CODES', 'Shell Codes');
define('O_BASE64_CODES', 'Base64 codierte Codes');
define('O_JS_INJECTION_CODES', 'Javascript Injektions-Codes');
define('O_PHP_INJECTION_CODES', 'PHP Injektions-Codes');
define('O_IFRAME_INJECTION_CODES', 'iFrame Injektions-Codes');
define('O_SPAMMING_MAILER_CODES', 'Spamming Mailer Codes');
define('O_EXEC_MAILICIOUS_CODES','Ausführbare böswillige Codes');
define('O_OTHER_MAILICIOUS_CODES','Andere böswillige Codes');
define('WEBSITE_CLEAN','Gesichert');
define('COMPLETED','Abgeschlossen');
define('YOUR_SYSTEM_IS_CLEAN','Ihr System ist sauber.');
define('VSREPORT','Prüfbericht <small>(Premium)</small>');
define('SCANREPORT_TITLE','<b>Prüfbericht</b>');
define('SCANREPORT_DESC','Zeigen Sie die zuletzt vom Virenscanner gescannten infizierten Dateien an');
define('SCANREPORT_CLEAN', 'Keine Dateien waren infiziert.');
define('VARIABLES','Variablen');
define('VARIABLES_TITLE','Variablenübersicht');
define('VARIABLES_DESC','Prüfung von Variablen. '.OSE_WORDPRESS_FIREWALL.' prüft automatisch die Variablen im Hintergrund um Angriffe durch diese zu verhindern');
define('MANAGE_VARIABLES','Verwalten von Variablen');
define('VIRUS_SCAN_REPORT','Virenscanbericht');
define('VERSION_UPDATE', 'Antivirus Datenbank Update');
define('VERSIONUPDATE_DESC', 'Modul zum Aktualisieren der Antivirus Datenbank');
define('ANTI_VIRUS_DATABASE_UPDATE', 'AntiVirus Datenbank Update');
define('VERSION_UPDATE_TITLE', '<b>Modul zum Aktualisieren der '.OSE_WORDPRESS_FIREWALL.' Version</b>');
define('VERSION_UPDATE_DESC', 'Modul zum Aktualisieren der lokalen Antivirus Datenbank');
define('CHECK_UPDATE_VERSION', 'Verbinde mit Server und prüfe auf neue Updates...');
define('START_UPDATE_VERSION', 'Updates werden heruntergeladen...');
define('UPDATE_COMPLETED', 'Update abgeschlossen!');
define('CHECK_UPDATE_RULE', 'Updateregel wird überprüft...');
define('ALREADY_UPDATED', 'Heutiges Update bereits verarbeitet');
define('UPDATE_LOG', 'Updatebericht...');
//Since 2.3.0
define('FILE_UPLOAD_VALIDATION', 'Datei-Uploadvalidierung');
define('REQUEST_DELIMITER','-----');
define('GEONOTREADY', 'Bitte installieren Sie die GeoIP-Länderliste zum Aktivieren der Funktion und zum Blockieren von Ländern.');
define('COUNTRYBLOCK_TITLE', '<b>Länderblockade</b>');
define('COUNTRYBLOCK_DESC','Modul zum Sperren von länderbezogenen IP-Adressen');
define('COUNTRYBLOCK', 'Länderblockade <small>(Premium)</small>');
define('BACKUP', 'Sicherungsübersicht');
define('ADVANCEDBACKUP', 'CloudBackup <small>(Premium)</small>');
define('ADMINEMAILS_TITLE', '<b>Administratormanagement</b>');
define('ADMINEMAILS_DESC', 'Hier können Sie zentral Ihren Administrator und Ihre Domainadressen verwalten');
define('ADMINEMAILS', 'Administratoren verwalten');
define('BACKUP_MANAGER', 'Sicherungsübersicht');
define('BACKUP_TITLE', '<b>Sicherungsverwaltung</b>');
define('BACKUP_DESC', 'Hier können Sie zentral die Sicherung Ihrer Datenbank und Ihrer Dateien verwalten');
define('BACKUP_FILES', 'Dateien wurden gesichert');
define('PREFIX_EMPTY', 'Bitte geben Sie ein Präfix an');
define('BACKUP_TYPE_EMPTY', 'Bitte wählen Sie eine Sicherungsvariante' );
define('DB_BACKUP_FAILED_INCORRECT_PERMISSIONS', 'Fehler beim Sichern der Datenbank, stellen Sie bitte sicher, dass das Sicherungsverzeichnis "'.OSE_FWDATA.'/backup/" beschreibbar ist.');
define('DB_COUNTRYBLOCK_FAILED_INCORRECT_PERMISSIONS','Fehler beim Sichern der Datenbank, stellen Sie bitte sicher, dass das Sicherungsverzeichnis "'.OSE_FWDATA.'/backup/" beschreibbar ist.');
define('FILE_VSSCAN_FAILED_INCORRECT_PERMISSIONS', 'Fehler bei Virenprüfung, stellen Sie bitte sicher, dass die zu prüfende Datei "'.OSE_FWDATA.'/vsscanPath/path.json" beschreibbar ist.');
define('DB_BACKUP_SUCCESS', 'Die Datenbanksicherung war erfolgreich');
define('DB_DELETE_SUCCESS', 'Das Sicherungselement wurde erfolgreich entfernt.');
define('DB_DELETE_FAILED', 'Das Sicherungselement wurde erfolglos entfernt.');
define('ADVRULESET_INSTALL_SUCCESS', 'Erweiterte Sicherheitsregeln wurden erfolgreich installiert');
define('ADVRULESET_INSTALL_FAILED', 'Erweiterte Sicherheitsregeln wurden erfolglos installiert');
define('GAUTHENTICATOR','Google-Verifizierung ');
define('IPMANAGEMENT_INTRO', 'Blockieren und verwalten Sie den Zugriff von IP-Adressen. '.OSE_WORDPRESS_FIREWALL.' erkennt automatisch verdächtige IP-Adressen und überwacht diese standardmäßig.');
define('FIREWALL_SETTING_INTRO', 'Aktivieren oder deaktivieren Sie die Firewallfunktion. Sie können die Sicherheitsfeatures von '.OSE_WORDPRESS_FIREWALL.' durch Deaktivieren von bestimmten Sicherheitsfunktion ändern. Um das bestmögliche Ergebnis zu erziehlen, wird dringend empfohlen, alle Sicherheitsfunktionen zu aktivieren');
define('VARIABLES_INTRO', 'Prüfung von Variablen. '.OSE_WORDPRESS_FIREWALL.' prüft automatisch die Variablen im Hintergrund um Angriffe durch diese zu verhindern');
define('VIRUS_SCANNER_INTRO', 'Der Virenscanner ist ein leistungsstarker Schadsoftware-Detektor, er wirkt wie ein Antivirus ist aber leistungsfähiger. Er scannt durch jede einzelne Datei auf Ihrem Server oder in einem bestimmten Pfad nach Viren, Malware, Spam, Schadsoftware, SQL-Injektionen, Sicherheitslücken usw.');
define('SCAN_REPORT_INTRO', 'Zeigen Sie die zuletzt vom Virenscanner gescannten infizierten Dateien an');
define('CONFIGURATION_INTRO', 'Konfigurieren Sie die Standardeinstellungen von '.OSE_WORDPRESS_FIREWALL.' welche Ihren persönlichen Anforderungen am besten entsprechen. Diese enthalten Einstellungen für das Scannen von Viren, SEO, AntiSpam, E-Mail und die Administrator-E-Mail Zuordnung');
define('BACK_UP_INTRO', 'Sicherung der Datenbank innerhalb Ihres eigenen Servers kostenlos');
define('COUNTRY_BLOCK_INTRO', 'Blockieren Sie den IP-Adressbereich eines gesamten Landes. '.OSE_WORDPRESS_FIREWALL.' wird Besucher aus diesen Ländern abweisen');
define('SCANCONFIG_INTRO', 'Konfigurieren der Firewall-Scaneinstellungen');
define('VSCONFIG_INTRO', 'Konfigurieren Sie die Einstellungen für den Virenscanner. Steuern Sie die zu scannenden Dateierweiterungen und begrenzen Sie die Größe der zu prüfenden Dateien');
define('SEOCONFIG_INTRO', 'Suchmaschineneinstellungen die Ihre Rankings schützen, selbst wenn Ihre Website Google-Bots blockiert. Entwerfen Sie eine Nachricht, welche für blockierte Besucher angezeigt wird');
define('ANTISPAMCONFIG_INTRO', 'Aktivieren oder deaktivieren Sie Stop Forum Spam um beständige Spammer auf Message-Boards und Blogs zu sperren');
define('EMAILCONFIG_INTRO', 'Konfiguration der E-Mail-Vorlage für gesperrte, gefilterte und als 403 blockierte erkannte Angriffe');
define('ADMINEMAILCONFIG_INTRO', 'Entscheiden Sie, welcher Administrator E-Mails für erkannte Angriffe (gesperrte, gefilterte, und 403 blockierte Einträge) erhält');
define('ANTI_HACKING', 'Antihacking');
define('ANTI_VIRUS', 'Antivirus');
define('PREMIUM_FEATURES', 'Premiumfunktionen');
define('LOGIN_FAILED', 'Login fehlgeschlagen. Benutzername, Kennwort oder der private Schlüssel ist falsch!');
define('LOGIN_STATUS', 'Loginstatus');
define('LOGIN', 'Login');
define('SUBSCRIPTION', 'Abonnement');
define('O_CONTINUE_SCAN', 'Scanvorgang fortsetzen');
define('STOP_VIRUSSCAN', 'Scanvorgang stoppen');
define('CONFIG_SAVECOUNTRYBLOCK_FAILE', 'Speichern der länderbezogenen Sperren fehlgeschlagen, da Länderdatenbank nicht bereit.');
define('CONFIG_ADPATTERNS_FAILE', 'Speichern der erweiterten Virendefinitionen fehlgeschlagen, da Virendefinitionsdatenbank nicht bereit.');
define('UNINSTALL_SUCCESS', 'Deinstallieren der Datenbanktabelle erfolgreich!');
define('UNINSTALL_FAILED', 'Deinstallieren der Datenbanktabelle erfolglos!');
define('SCAN_READY','Virenscanner bereit');
define('ADVANCERULESNOTREADY', '<b>[Besserer Schutz] </b><b>VERBESSERUNG</b>: Bitte aktivieren Sie die erweiterte Firewall um verstärkten Schutz zu erhalten. Der erweiterte Firewallschutz bietet 45 + Erkennungstechniken um Ihre Website vor Hackerangriffen zu schützen');
define('ABOUT', 'Funktionen');
define('ABOUT_DESC', 'Ausführliche Beschreibung der einzelnen Module unseres Plugins und der Funktion');
define('ADVANCERULES_READY','<b>[Besserer Schutz] </b>Toll! Ihre Website ist jetzt sicherer');
define('ADMINUSER_EXISTS','<b>[Administratorschutz] </b><b>WARNUNG</b>: Der Administrator-Account \'admin\' existiert noch, bitte ändern Sie den Benutzernamen für den Administrator schnellstmöglich.');
define('ADMINUSER_REMOVED','<b>[Administratorschutz] </b>Toll! Der Administrator-Account \'admin\' wurde umbenannt');
define('FIREWALL','Firewall');
define('OSE_AUDIT','Audit');
define('GAUTHENTICATOR_NOTUSED','<b>[Administratorschutz] </b><b>WARNUNG</b>: Google 2 Schritt Authenticator wird nicht verwendet. Dies ist eine wirksame Methode, um Brute-Force-Angriffe zu vermeiden, wir empfhelen das Aktivieren dieser Funktion. Zur Aktivierung folgen Sie bitte der Anleitung.');
define('GAUTHENTICATOR_READY','<b>[Administratorschutz] </b>TOLL! Google Authenticator ist auf dieser Website aktiviert. Bitte stellen Sie sicher, dass alle Web-Adminsitratoren die Funktion für ihre Konten aktiviert haben.');
define('WORDPRESS_OUTDATED','<b>[Wordpress Update] </b><b>WARNUNG</b>: Ihre Wordpress Version ist veraltet, bitte aktualisieren Sie diese schnellstmöglich. Die aktuelle Version ist ');
define('WORDPRESS_UPTODATE','<b>[Wordpress Update] </b>TOLL! Ihre Website ist auf dem neuesten Stand mit der aktuellen Version ');
define('USERNAME_CANNOT_EMPTY','Benutzername darf nicht leer sein.');
define('USERNAME_UPDATE_SUCCESS','Benutzername erfolgreich geändert. Der Browser wird in Kürze aktualisieren, wenn Sie als Administrator \'admin\' angemeldet sind, melden Sie sich dannach bitte mit Ihrem neuen Benutzernamen an.');
define('USERNAME_UPDATE_FAILED','Fehler beim Ändern des Benutzernamens');
define('GOOGLE_IS_SCANNED', '<b>[SEO-Schutz] </b><b>WARNUNG</b>: Bitte beachten Sie, dass Google Bots gescannt werden, wenn Ihre Website nicht unter schweren Angriffen steht, deaktivieren Sie diese Funktion um einen möglichen negativen Effekt auf Ihre SEO zu vermeiden.');
define('CLAMAV', 'ClamAV Integration');
define('ACTION_PANEL', 'Action Modul');
define('CLAMAV_STATUS', 'ClamAV Status');
define('RELOAD_DB_DESC', 'ClamAV Datenbank neu laden');
define('CLAMAV_DEF_VIRSION', 'ClamAV Virendefinitionsversion');
define('CLAMAV_TITLE', '<b>ClamAV Integration</b>');
define('CLAMAV_DESC', 'ClamAV ist eine open Source Antivirussoftware für Linuxserver. '.OSE_WORDPRESS_FIREWALL.' kann ClamAV in die Virenscannerfunktion integrieren um die Erkennungsrate zu erhöhen');
define('CLAMAV_CONNECT_SUCCESS', 'Erfolgreich mit dem Clam Daemon verbunden');
define('CLAMAV_DEF_VERSION','ClamAV Virendefinitionsversion');
define('CLAMAV_CANNOT_CONNECT','Verbindung mit dem ClamAV Daemon fehlgeschlagen');
define('SIGNATURE_UPTODATE','<b>[Besserer Schutz] </b>Ihre Firewallregeln sind aktuell');
define('SIGNATURE_OUTDATED','<b>[Besserer Schutz] </b><b>VERBESSERUNG</b>: Ihre Firewallregeln sind veraltet, bitte aktualisieren Sie diese um den Schutz zu erhöhen. Der aktualisierte und erweiterte Firewallschutz bietet 45 + Erkennungstechniken um Ihre Website vor Hackerangriffen zu schützen');
define('IS_MY_WEBSITE_SAFE_BROWSING','Ist meine Website in der Blacklist-Datenbank der großen Antiviren Hersteller?');
define('SAFE_BROWSING_CHECKUP',''.OSE_WORDPRESS_FIREWALL.' Safe-Browsing Prüfung (Blacklisten Überwachung)');
define('SECURITY_CONFIG_AUDIT','Sicherheitskonfiguration Audit');
define('CHECK_SAFE_BROWSING','Überprüfen Sie jetzt Ihren Website Safe-Browsing Status.');
define('SAFE_BROWSING_CHECKUP_UPDATED','Ihre Safe-Browsing Prüfung ist aktuell');
define('SAFE_BROWSING_CHECKUP_OUTDATED','Ihre Safe-Browsing Prüfung ist veraltet, planen Sie jetzt die tägliche Kontrolle.');
define('API_CONFIGURATION','API Konfiguration');
define('API_INTRO','Verbinden Sie '.OSE_WORDPRESS_FIREWALL.' mit Ihrem API-Schlüssel');
define('SYSTEM_SECURITY_AUDIT','Systemsicherheit Audit');
define ('WORDPRESS_FOLDER_PERMISSIONS','Wordpres Folder Permissions');
define('CHANGE_PHPINI', 'Wenn Hasb im Konfigurationsabschnitt deaktiviert ist, ändern Sie es bitte in der php.ini');
define('REG_GLOBAL_OFF','Die PHP Einstellung register_global ist <b>AUS</b>.');
define('REG_GLOBAL_ON','Die PHP Einstellung register_global ist <b>AN</b>, bitte schalten Sie dies aus. '.CHANGE_PHPINI);
define('SAFEMODE_OFF','Die PHP Einstellung safe_mode ist <b>AUS</b>');
define('SAFEMODE_ON','Die PHP Einstellung safe_mode ist <b>AN</b>, bitte schalten Sie dies aus. '.CHANGE_PHPINI);
define('URL_FOPEN_OFF','Die PHP Einstellung allow_url_fopen ist <b>AUS</b>');
define('URL_FOPEN_ON','Die PHP Einstellung allow_url_fopen ist <b>AN</b>, bitte schalten Sie dies aus. '.CHANGE_PHPINI);
define('DISPLAY_ERROR_OFF','Die PHP Einstellung display_errors ist <b>AUS</b>');
define('DISPLAY_ERROR_ON','Die PHP Einstellung display_errors ist <b>AN</b>, bitte schalten Sie dies aus. '.CHANGE_PHPINI);
define('DISABLE_FUNCTIONS_READY','Die folgenden PHP Funktionen wurden deaktiviert: ');
define('DISABLE_FUNCTIONS_NOTREADY','Die folgenden PHP Funktionen müssen deaktiviert werden: ');
define('RETRIEVE_UPDATED_PATTERNS','Abrufen der aktualisierten Virendefinitionen');
define('YOUR_VERSION', 'Ihre Version: ');
define('SCHEDULE_SCANNING', 'Virenscan planen');
define('SYSTEM_PLUGIN_DISABLED', ''.OSE_WORDPRESS_FIREWALL.' System-Plugin ist deaktiviert, bitte aktivieren Sie es und setzen Sie es an die erste Position.');
define('SYSTEM_PLUGIN_READY', ''.OSE_WORDPRESS_FIREWALL.' System-Plugin ist bereit.');
define('SCAN_SPECIFIC_FOLDER', 'Bestimmten Ordner scannen');
define('O_DROPBOX_FAILED', 'Das Hochladen der Sicherungsdatei auf Ihre Dropbox ist fehlgeschlagen. Bitte autorisieren Sie die Dropbox API erneut.');

define('O_FILE_ID', 'Datei ID');
define('O_FILE_NAME', 'Dateiname');
define('O_CONFIDENCE', 'Vertrauen');
define('O_PATTERNS', 'Definitionen');
define('O_PATTERN_ID', 'Definition ID');
define('O_CHECKSTATUS', 'Status');

define('O_BACKUPFILE_ID', 'ID');
define('O_BACKUPFILE_DATE', 'Zeit');
define('O_BACKUPFILE_NAME', 'Dateiname');
define('O_BACKUPFILE_TYPE', 'Sicherungstyp');
define('O_BACKUP_DROPBOX', 'Dropbox');
define('O_BACKUP_LOCAL', 'Lokal');


define('O_IP_RULE_TITLE', 'IP/Regelname');
define('O_ID', 'ID');
define('O_DATE', 'Datum');
define('O_RISK_SCORE', 'Score');
define('O_START_IP', 'Start-IP');
define('O_END_IP', 'End-IP');
define('O_VARIABLE', 'Variable');
define('O_ADD_AN_IP', 'IP hinzufügen');
define('O_IP_RULE', 'IP/Regelname');
define('O_IP_TYPE', 'IP-Typ');
define('O_RANGE', 'IP-Bereich');
define('O_SINGLE_IP', 'Einzelne IP');
define('O_STATUS', 'Status');
define('O_HOST', 'Host');
define('O_VISITS', 'Besuche');
define('O_VIEWDETAIL', 'Aktion');
define('O_DELETE_ITEMS', 'Objekte löschen');
define('O_STATUS_MONITORED_DESC', 'Überwacht');
define('O_STATUS_BLACKLIST_DESC', 'Blacklist');
define('O_STATUS_WHITELIST_DESC', 'Whitelist');

define('O_DEFAULT_VARIABLES_WARNING', 'Please enable the default variables to avoid false alerts from the firewall');
define('O_DEFAULT_VARIABLE_BUTTON','Enable Whitelist default variables');

define('ADD_IPS', 'IP hinzufügen');
define('O_BLACKLIST_IP', 'Blacklist IPs');
define('O_WHITELIST_IP', 'Whitelist IPs');
define('O_MONITORLIST_IP', 'Überwache IPs');
define('ADD_IP_FORM','Formular IP hinzufügen');
define('IPFORM_DESC', 'Mit diesem Formular können Sie eine IP oder einen IP-Bereich hinzufügen');
define('O_DELETE__ALLITEMS', 'Alle Objekte löschen');
define('SAVE', 'Speichern');

define('PLEASE_SELECT_ITEMS', 'Bitte wählen Sie mindestens ein Element.');
define('O_UPDATE_HOST', 'Update Host');
define('O_IMPORT_IP_CSV', 'IP von CSV importieren');
define('O_EXPORT_IP_CSV', 'IP in CSV exportieren');
define('O_IMPORT_NOW', 'Jetzt importieren');
define('GENERATE_CSV_NOW', 'CSV jetzt erstellen');

define('O_ATTACKTYPE', 'Angriffstyp');
define('O_RULE', 'Regel');
define('O_IMPACT', 'Auswirkungen');

define('ADD_A_VARIABLE', 'Variable hinzufügen');
define('O_VARIABLE_NAME', 'Variablen-Name');
define('O_VARIABLE_TYPE', 'Variablen-Typ');
define('O_VARIABLES', 'Variablen');
define('VARIABLE_NAME_REQUIRED', 'Variablen-Name benötigt');
define('LOAD_WORDPRESS_DATA', 'Standardvariablen für WordPress laden');
define('LOAD_WORDPRESS_CONFIRMATION', 'Bitte bestätigen Sie das Laden der Whitelist-Variablen für Wordpress');
define('O_CLEAR_DATA', 'Daten löschen');
define('O_CLEAR_DATA_CONFIRMATION', 'Datenlöschbestätigung');
define('O_CLEAR_DATA_CONFIRMATION_DESC', 'Bitte bestätigen Sie, dass Sie alle Variablen löschen möchten. Es werden einige andere Hacker Informationen welche dieser Regel zugeordnet sind entfernt');
define('O_STATUS_EXP', 'Status-Erklärung');
define('SCAN_VARIABLE', 'Scannen der Variable');
define('FILTER_VARIABLE', 'Filtern der Variable');
define('IGNORE_VARIABLE', 'Ignorieren der Variable');
define('VARIABLE_CHANGED_SUCCESS', 'Der Variablenstatus wurde erfolgreich geändert.');
define('VARIABLE_CHANGED_FAILED', 'Der Variablenstatus wurde erfolglos geändert');
define('VARIABLE_ADDED_SUCCESS', 'Die Variable wurde erfolgreich hinzugefügt.');
define('VARIABLE_ADDED_FAILED', 'Die Variable wurde erfolglos hinzugefügt.');
define('VARIABLE_DELETED_SUCCESS', 'Die Variable wurde erfolgreich gelöscht.');
define('VARIABLE_DELETED_FAILED', 'Die Variable wurde erfolglos gelöscht.');

define('LOAD_JOOMLA_DATA', 'Joomla Variablen laden');
define('LOAD_JSOCIAL_DATA', 'JomSocial Variablen laden');
define('LOAD_JOOMLA_CONFIRMATION', 'Bitte bestätigen Sie das Laden der Whitelist-Variablen für Joomla');

define('O_BLACKLIST_COUNTRY', 'Blacklist Land');
define('O_WHITELIST_COUNTRY', 'Whitelist Land');
define('DOWNLOAD_COUNTRY', 'Länderdatenbank herunterladen');
define('DOWNLOAD_NOW', 'Jetzt herunterladen');
define('O_MONITOR_COUNTRY', 'Land Überwachen');
define('O_CHANGEALL_COUNTRY', 'Alle Länder ändern');
define('O_CHANGEALL_COUNTRY_STATUS', 'Welchen Status möchten Sie allen Ländern zuweisen?');
define('O_COUNTRY', 'Land');
define('COUNTRY_STATUS_CHANGED_SUCCESS', 'Der Länderstatus wurde erfolgreich geändert.');
define('COUNTRY_STATUS_CHANGED_FAILED', 'Der Länderstatus wurde erfolglos geändert.');
define('COUNTRY_DATA_DELETE_SUCCESS', 'Länderdaten wurden erfolgreich gelöscht.');
define('COUNTRY_DATA_DELETE_FAILED', 'Länderdaten wurden erfolglos gelöscht.');

define('O_SCANREPORT_CLEAN', 'Bereinigen');
define('O_SCANREPORT_QUARANTINE', 'Quarantäne');
define('O_SCANREPORT_RESTORE', 'Wiederherstellen');
define('O_SCANREPORT_DELETE', 'Löschen');

define('O_BACKUP_BACKUPDB', 'Datenbank sichern');
define('O_BACKUP_BACKUPFILE', 'Deteien sichern');
define('O_BACKUP_DELETEBACKUPFILE', 'Löschen');
define('O_AUTHENTICATION_CONTINUE', 'Weiter');


define('SECURITY_MANAGEMENT','Sicherheitsmanagement');
define('VARIABLES_MANAGEMENT', 'Variablenübersicht');
define('PREMIUM_SERVICE','Premium Service');

define('O_DEVELOPMENT_MODE','Entwicklermodus');
define('O_FRONTEND_BLOCKING_MODE','Frontend Sperrmodus');
define('O_COUNTRY_BLOCKING','Länderblockade');
define('O_SILENTLY_FILTER_HACKING_VALUES_RECOMMENDED_FOR_NEW_USERS','Im Hintergrund Angriffe filtern - Empfohlen für neue Benutzer');
define('O_ADRULESETS','Erweiterte Firewall aktivieren (<a href ="'.OSE_OEM_URL_ADVFW_TUT.'" target=\'_blank\'>Anleitung hier</a>)');
define('O_GOOGLE_2_VERIFICATION','Google Bestätigung in zwei Schritten');
define('O_FILE_UPLOAD_SCANNING','Scannen von hochgeladenen Dateien im Frontend?');

define('O_SEO_PAGE_TITLE','SEO Seitentitel');
define('O_SEO_META_KEY','SEO Meta Keywords');
define('O_SEO_META_DESC','SEO Meta Beschreibung');
define('O_SEO_META_GENERATOR','SEO Meta Generator');
define('O_WEBMASTER_EMAIL','Webmaster E-Mail');
define('O_CUSTOM_BAN_PAGE','Benutzerdefinierte Sperrseite');
define('O_SCAN_YAHOO_BOTS','Scan Yahoo Bots');
define('O_SCAN_GOOGLE_BOTS','Scan Google Bots');
define('O_SCAN_MSN_BOTS','Scan MSN Bots');
define('O_SCANNED_FILE_EXTENSIONS','Zu scannende Dateierweiterungen');
define('MAX_FILE_SIZE','Maximale zu scannende Dateigröße');
define('AUDIT_WEBSITE','Meine Website prüfen');
define('OVERVIEW_COUNTRY_MAP','Übersicht der Hacker-Aktivitäten nach Land');
define('OVERVIEW_TRAFFICS','Datenverkehr-Übersicht');
define('RECENT_HACKING_INFO','Jüngster Hacker-Datenverkehr');
define('RECENT_SCANNING_RESULT', 'Letztes Scanergebnis');
define('RECENT_BACKUP', 'Letzte Sicherung');
define('PLEASE_ENTER_REQUIRED_INFO','Bitte geben Sie die erforderliche Informationen an.');
define('MY_PREMIUM_SERVICE','Premium Service aktivieren');
define('INSTALLATION', 'Installieren/Deinstallieren');
define('INSTALLDB','Datenbanktabellen installieren');
define('INSTALLDB_INTRO','Installation der von '.OSE_WORDPRESS_FIREWALL.' für Ihre Website erstellen Datenbank');
define('UNINSTALLNOW','Jetzt deinstallieren');
define('CHANGE_ADMINFORM','Neuer Administrator Benutzername');
define('CHANGE','Ändern');
define('PHP_CONFIGURATION','PHP Konfiguration');
define('O_RECURRING_ID', 'Wiederkehrende ID');
define('O_CREATED', 'Erstellt');
define('O_PRODUCT', 'Produkt');
define('O_PROFILE_ID', 'Profil ID');
define('O_REMAINING', 'Verbleibend');
define('O_VIEW', 'Anzeigen');
define('CREATE', 'Erstellen');
define('CREATE_ACCOUNT', 'Account erstellen');
define('CREATE_AN_ACCOUNT', 'Account erstellen');
define('FIRSTNAME', 'Vorname');
define('LASTNAME', 'Nachname');
define('EMAIL', 'E-Mail');
define('PASSWORD', 'Kennwort');
define('PASSWORD_CONFIRM', 'Kennwort bestätigen');
define('TUTORIAL', 'Anleitung');
define('COUNTRY_CHANGED_SUCCESS','Der Länderstatus wurde erfolgreich geändert');
define('ACTIVATION_CODES', 'Firewall Aktivierungscode');
define('ACTIVATION_CODE_TITLE', 'Aktivierungscodes');
define('ACTIVATION_CODE_DESC', 'Dieses Modul zeigt die Aktivierungscodes der Firewall in der php.ini oder .htaccess für den gesamten Server.');
define('AFFILIATE_ACCOUNT', 'Partner-Account Information');
define('ADD_TRACKING_CODE', 'Partner Tracking-Code hinzufügen');
define('TRACKINGCODE_CANNOT_EMPTY', 'Tracking-Code darf nicht leer sein');
define('TRACKINGCODE_UPDATE_SUCCESS', 'Toll! Tracking-Code erfolgreich hinzugefügt. Wenn der Besitzer dieser Website künftig Abonnements bezieht, werden diese in Ihrem Partnerkonto erfasst.');
define('TRACKINGCODE_UPDATE_FAILED', 'Update der Tracking-Codes fehlgeschlagen');
define('WORDPRESS_ADMIN_AJAX_PROTECTION', 'WordPress Administrator Ajax Schutz');
define('ADD_DOMAIN', 'Domäne hinzufügen');
define('ADD_ADMIN', 'Administrator hinzufügen');
define('ADD_ADMIN_ID', 'ID');

define('ADD_ADMIN_NAME', 'Name');
define('ADD_ADMIN_EMAIL', 'E-Mail');
define('ADD_ADMIN_STATUS', 'Status');
define('ADD_ADMIN_DOMAIN', 'Domäne zuweisen');
define('TABLE_DOMAIN', 'Domäne');
define('SCAN', 'Scan');
define('FILE_CONTENT', 'Dateiinhalt');
define('O_CUSTOM_BAN_PAGE_URL', 'Benutzerdefinierte Sperrseiten-URL');
define('SUCCESS', 'Erfolgreich');
define('SUCCESS_LOGOUT', 'Erfolgreich abgemeldet');
define('FIREWALL_RULES', 'Firewallregeln Feinabstimmung');
define('FIREWALL_CONFIGURATION','Firewallkonfiguration');
define('FIREWALL_CONFIGURATION_DESC','Auf dieser Seite können Sie die Einstellungen der '.OSE_WORDPRESS_FIREWALL.' Firewall ändern.');
define('CRONJOBS', 'Aufgabenplanung <small>(Premium)</small>');
define('CRONJOBS_TITLE','Geplante Aufgaben');
define('CRONJOBS_DESC','Richten Sie eine geplante Aufgabe zur automatischen Ausführung an einem angegebenen Tag und Uhrzeit ein. Die Zeit basiert auf Ihrem System.');
define('CRONJOBS_LONG','Wählen Sie die Zeit und Tag für die Ausführung des Virenscanners.');
define('HOURS','Stunden');
define('WEEKDAYS','Wochentage (Verwenden Sie STRG für die Mehrfachauswahl von Elementen)');
define('CRON_SETTING_EMPTY','Bitte stellen Sie sicher, dass Sie die Stunden und die Tage der Woche auf dem Formular ausgewählt haben.');
define('LAST_DETECTED_FILE','Ordner, die der letzten Warteschlange zur Überprüfung hinzugefügt wurden');
define('ENTER_ACTIVATION_CODE', 'Aktivierungscode eingeben');
define('ACTIVATION_CODE', 'Aktivierungscode');
define('ACTIVATE', 'Aktivieren');
define('ERROR', 'Fehler');
define('ACTIVATION_CODE_EMPTY', 'Der Aktivierungscode darf nicht leer sein');
define('MAX_DB_CONN', 'Maximale Datenbankverbindungen');

// Version 4.4.0
define('PERMCONFIG', 'Berechtigungsvergabe');
define('PERMCONFIG_DESC', 'Verwalten Sie die Berechtigungen Ihrer Server-Dateien & Ordner');
define('PERMCONFIGFORM_DESC', 'Bitte wählen Sie die neuen Eigenschaften für die ausgewählten Elemente.');
define('PERMCONFIGFORM_NB', '<h5><small><b>NB: </b>Im Allgemeinen verwendete Berechtigungen: Dateien 0644 (drw-r--r--) und Ordner 0755 (drwxr-xr-x) </small></h5>');
define('PERMCONFIG_SAVE', 'Anwenden & Konfiguration speichern');
define('PERMCONFIG_EDITOR', 'Berechtigungen bearbeiten');
define('PERMCONFIG_CHANGE', 'Berechtigungen ändern');
define('PERMCONFIG_SHORT', 'Berechtigungskonfiguration');
define('PERMCONFIG_NAME', 'Name');
define('PERMCONFIG_TYPE', 'Typ');
define('PERMCONFIG_OWNER', 'Besitzer/Gruppe');
define('PERMCONFIG_PERM', 'Berechtigung');
define('O_DOWNLOAD', 'Herunterladen');

// Version 4.4.1
define('CHOOSE_A_PLAN', 'Bitte wählen Sie einen Abonnementenplan');
define('SUBSCRIPTION_PLAN', 'Abonnementpläne');
define('SUBSCRIPTION_PLAN_EMPTY', 'Abonnementpläne dürfen nicht leer sein, bitte wählen Sie mindestens einen Abonnementenplan.');
define('PAYMENT_METHOD', 'Zahlungsmethode');
define('COUNTRY', 'Land');
define('FIRST_NAME', 'Vorname');
define('LAST_NAME', 'Nachname');
define('O_NEXT', 'Bestellung aufgeben');
define('PERMCONFIG_ONECLICKPERMFIX', 'Berechtigungen mit einem Klick berichtigen <small>(Premium)</small>');

// Version 4.6.0
define('SCANPATH', 'Pfad auswählen');
define('PATH', 'Pfad');
define('FILETREENAVIGATOR', 'Verzeichnisnavigator');

// Version 4.7.0
define('EMAIL_EDIT', 'E-Mail-Vorlage bearbeiten');
define('O_GOOGLE_2_SECRET', 'Google Authenticator Secret');
define('O_GOOGLE_2_QRCODE', 'Google Authenticator QRcode');
define('PREMIUM_SERVICE_FREE', 'Holen Sie sich Ihren Premiumservice kostenlos');
define('SUBSCRIPTION_SETP1', 'Schritt 1: Erstellen Sie ein Konto');
define('SUBSCRIPTION_SETP2', 'Schritt 2: Bestellung');
define('SUBSCRIPTION_SETP3', 'Schritt 3: Abonnement aktivieren');
define('SUBSCRIPTION_ACTIVATION', 'Abonnement-Aktivierung');
define('SUBSCRIPTION_DESCRIPTION1', 'Einfach mit dem Formular auf der rechten unteren Seite ein Konto erstellen oder wenn Sie bereits ein '.OSE_WORDPRESS_FIREWALL.' Konto haben, melden Sie sich einfach über das Formular auf der linken unteren Seite an. <br/>Wir bieten Ihnen 60 Tage eine Zufriendheitsgarantie an, wenn nicht 100% zufrieden erhalten sie Ihre Erstattung ohne weitere Fragen.');
define('SUBSCRIPTION_DESCRIPTION2', 'Klicken Sie anschließend auf Anmelden, um einen Abonnementenplan zu bestellen und per Paypal oder Kreditkarte zu bezahlen. Sobald die Zahlungen geleistet wurde, sehen Sie Ihr aktives Abonnement in der Abonnementsübersicht.');
define('SUBSCRIPTION_DESCRIPTION3', 'Letzter Schritt: Klicken Sie zum Aktivieren des Abonnements auf Abonnement für diese Website verknüpfen. ');
define('REGISTERED_ACCOUNT_DESC', 'Wenn Sie bereits ein Konto haben, geben Sie bitte die <code>'.OSE_WORDPRESS_FIREWALL.'</code> Kontodaten ein.');
define('CENTRORA', ''.OSE_WORDPRESS_FIREWALL.'');
define('OSE', ''.OSE_WORDPRESS_FIREWALL.'');
define('WEBSITE', 'Website');
define('NEW_ACCOUNT_DESC', 'Wenn Sie noch kein Konto besitzen, verwenden Sie bitte das folgende Formular um ein Konto zu erstellen.');
define('ADMIN_MANAGEMENT', 'Administratormanagement');
define('O_ADVANCED_BACKUP', 'Erweiterte Sicherungsverwaltung');
define('O_ADVANCED_RULE', 'Erweiterte Rulesets Tabelle');
define('O_AUTHENTICATION', 'Authentifizierung');
define('O_BACKUP_TITLE', 'Sicherungsverwaltung');
define('DBNOTREADY_AFTER', 'Danach können Sie auf die Konfigurationsseite wechseln und Einstellungen ändern.');
define('SAVE_SETTINGS', 'Einstellungen speichern');
define('IP_TABLE_TITLE', 'IP Tabelle');
define('PHP_CHECK_STATUS', 'Statusüberprüfung');
define('O_RULESETS_TABLE_TITLE', 'Rulesets Tabelle ');
define('O_SCAN_REPORT_TITLE', 'Scanbericht');
define('MY_SUBSCRIPTION', 'Meine Abonnements');
define('VARIABLE_TABLE_TITLE', 'Variablen Tabelle');
define('O_HELP_CLEAN', '<strong>Brauchen Sie Hilfe, um schädliche Dateien zu entfernen?</strong> Verlassen Sie sich auf uns, damit Sie sich auf Ihr Geschäft konzentrieren können.');
define('RECURSE_INTO', 'Rekursion in Unterverzeichnissen');
define('APPLY_TO_ALL', 'Für alle Dateien und Ordner übernehmen');
define('APPLY_TO_FILES', 'Für alle Dateien übernehmen');
define('APPLY_TO_FOLDERS', 'Für alle Ordner übernhemen');
define('CLICK_TO_ACTIVATE', 'um Ihr Abonnement zu aktivieren und diese Funktion zu nutzen.');
define('AFFILIATE_PROGRAM_DESC', 'Verpassen Sie nicht die Chance, mindestens $24.50 für das 1. Jahr und $338.90 in fünf Jahren mit unserem Partnerprogramm zu verdienen!  ');
define('SECURITY_BADGE_DESC', '<b>[Sicherheitabzeichen] </b>: Das Sicherheitabzeichen ist deaktiviert. Durch die Aktivierung können Sie den Umsatz Ihrer Website erhöhen.  ');
define('CALL_TO_ACTION_TITLE', 'Wir sind immer da, um zu helfen');
define('CALL_TO_ACTION_P', 'Wir schützen jetzt <span id="numofWebsite"></span> Websites.');
define('CALL_TO_ACTION_UL', '<li>Wir haben dabei geholfen, tausende Kunden zu schützen und säubern Websites seit 2011. Wenn Sie Hilfe benötigen, für den Schutz oder Virenbeseitigung auf Ihrer Website, so
 <a href="'.OSE_OEM_URL_MALWARE_REMOVAL.'" target="_blank"><span class="strong">kontaktieren Sie uns bitte</span></a>.</li>
					<li>Mit der '.OSE_WORDPRESS_FIREWALL.', Basis-Firewall blockieren wir bereits 95% der Bedrohungen. Um Ihren Schutz weiter auszubauen können Sie jederzeit die <b>erweiterte Firewall</b> abonnieren.</li>
					<li>Wenn Sie vermuten, dass ist Ihre Website durch Schadsoftware infiziert ist, kann Ihnen der <b>'.OSE_WORDPRESS_FIREWALL.' Virenscanner</b> helfen innerhalb von Minuten Ihre Seite zu prüfen. Der Virenscanner wird freigeschaltet, wenn das Abonnement aktiviert ist.</li>
					<li>Nicht jeder braucht die Möglichkeit <b>ganze Länder</b>, zu sperren. Wenn Sie aber diese Funktionalität gerne nutzen würden abonnieren Sie einen Plan und stoppen Sie den Zugriff aus einem bestimmten Land mit Leichtigkeit</li>
					<li>Speichern Sie Ihre Sicherung online mit <b>CloudBackup</b> </li>
					<li><b>Aufgabenplaner</b> für automatisierten Virenscan und automatisierte Sicherungen</li>');
define('CALL_TO_ACTION_TITLE2', 'Partner werden');
define('CALL_TO_ACTION_DESC2', 'Warum werden Sie nicht unser Partner und genießen Sie Provisionen für Ihre Empfehlungen?');
define('CALL_TO_ACTION_TITLE3', 'Benötigen Sie weitere Hilfe?');
define('CALL_TO_ACTION_DECS3', 'Wenn Sie mehr Schutz möchten, lesen Sie ');
define('SUBSCRIBE_NOW', 'ABONNIEREN SIE JETZT!');
define('SIGN_IN', 'Anmelden');
define('PLEASE_ENTER_CORRECT_EMAIL', 'Bitte geben Sie die korrekte E-Mail an.');
define('PASSWORD_DONOT_MATCH', 'Das Kennwort ist nicht identisch.');
define('LOGOUT', 'Abmelden');
define('O_DONT_BRACE', 'Bitte ändern Sie keinen Text in Klammern');

// Version 4.8.0 
define('CURRENT_DATABASE_CONNECTIONS','Aktuelle Datenbankverbindungen');
define('WAITING_DATABASE_CONNECTIONS','Warten bis die Datenbankverbindungen freigegeben werden.');
define('YOUR_MAX_DATABASE_CONNECTIONS','Die maximale Anzahl von Verbindungen, die Sie konfiguriert haben.');
define('SCHEDULE_BACKUP', 'Sicherung planen');
define('CRONJOBSBACKUP_LONG', 'Wählen Sie den Sicherungstyp sowie Tag und Zeit für das Ausführen der Sicherung.');
define('O_AUTHENTICATION_ONEDRIVE', 'OneDrive Authentifizierung');
define('O_ONEDRIVE_LOGOUT', 'OneDrive Abmelden');
define('O_DROPBOX_LOGOUT' , 'Dropbox Abmelden');
define('CLOUD_BACKUP_TYPE', 'Backuptyp');
define('O_BACKUP_ONEDRIVE','OneDrive');
define('NONE','Nur Lokal');
define('SAVE_SETTING_DESC','Klicken Sie bei jeder Änderung in der Aufgabenplanung auf Speichern');
define('CLOUD_SETTING_REMINDER','<h5><small>Authentifizieren Sie weitere Dienste um mehr Optionen anzuzeigen</small></h5>');
define('OEM_PASSCODE', 'Kennwort');
define('PASSCODE_CONTROL', 'Kennwortkontrolle');
define('PASSCODE', 'Kennwort');
define('VERIFY', 'Überprüfen');
define('AUTHENTICATION', 'CloudBackup Authentifizierung');
define('AUTHENTICATION_TITLE', '<b>Authentifizierung</b>');
define('AUTHENTICATION_DESC', 'Zum Aktivieren des CloudBackups, autorisieren Sie bitte '.OSE_WORDPRESS_FIREWALL.' in Ihrem bevorzugen Clouddienst.');

// Version 4.9.0
define('O_UPDATE_SIGNATURE', 'Update Firewallsignaturen');
define('O_UPDATE_VIRUS_SIGNATURE', 'Update Virensignaturen');
define('RESTORE_EMAIL', 'Standardeinstellung wiederherstellen');
define('CHANGE_PASSCODE', 'Kennwort ändern');
define('OLD_PASSCODE', 'Altes Kennwort eingeben');
define('NEW_PASSCODE', 'Neues Kennwort eingeben');
define('CONFIRM_PASSCODE', 'Neues Kennwort bestätigen');
define('VSSCAN_AND_BACKUP', 'Virenscan & Sicherungen');
define('CENTRORA_SETTINGS', ''.OSE_WORDPRESS_FIREWALL.' Einstellungen');
define('MY_ACCOUNT', 'Mein Konto');
define('LOGIN_OR_SUBSCIRPTION', 'Anmeldung/Abo');
define('ADVANCED_FIREWALL_SETTINGS', 'Erweiterte Firewallkonfiguration <small>(Premium)</small>');
define('BASIC_FIREWALL_RULES', 'Grundlegende Firewallregeln');
define('ADVANCED_FIREWALL_RULES', 'Erweiterte Firewallregeln <small>(Premium)</small>');
define('O_GOOGLEDRIVE_LOGOUT', 'Google Drive Abmelden');
define('O_AUTHENTICATION_GOOGLEDRIVE', 'GoogleDrive Authentifizierung');
define('O_AUTHENTICATION_DROPBOX', 'Dropbox Authentifizierung');
define('O_BACKUP', 'Sicherung');
define('ADMINISTRATION', 'System-Menü');
define('FILE_PERMISSION', 'Dateiberechtigung');
define('O_BACKUP_GOOGLEDRIVE', 'GoogleDrive');
define('DOWNLOAD_SUCCESS', 'Signaturen wurden erfolgreich aktualisiert.');

// Version 5.0.0
define('O_FRONTEND_BLOCKING_MODE_403','403-Fehlerseite anzeigen');//previously O_SHOW_A_403_ERROR_PAGE_AND_STOP_THE_ATTACK
define('O_FRONTEND_BLOCKING_MODE_403_HELP','403-Fehlerseite anzeigen und den Angriff stoppen');
define('O_FRONTEND_BLOCKING_MODE_BAN','Sperrseite anzeigen');// previously O_BAN_IP_AND_SHOW_BAN_PAGE_TO_STOP_AN_ATTACK
define('O_FRONTEND_BLOCKING_MODE_BAN_HELP','IP sperren und Sperrseite anzeigen um den Angriff zu stoppen');
define('O_ALLOWED_FILE_TYPES','Zulässige Upload Dateierweiterungen *');
define('O_ALLOWED_FILE_TYPES_HELP',''.OSE_WORDPRESS_FIREWALL.' Firewall schützt vor nicht vertrauenswürdigen Dateiuploads. Verwenden Sie diese Liste für Ausnahmen (z.B. jpg, png, doc) *Bitte beachten Sie: Das FILEINFO-Modul muss installiert und richtig konfiguriert sein');

define('O_SILENTLY_FILTER_ATTACK','Stiller Modus');
define('O_SILENTLY_FILTER_ATTACK_HELP', 'Hackerangriff im Hintergrund filtern. Um diesen Modus zu aktivieren müssen Sie den Frontend-Sperrmodus auf 403-Fehlerseite anzeigen gesetzt haben. In diesem Modus wird der Besucher auf die URL ohne den schadhaften String umgeleitet. Die IP wird nicht gesperrt und wird als zu überwachen gekennzeichnet. Dies kann Fehlalarme in einigen Fällen vermeiden. *Empfohlen für neue Benutzer');
define('ATTACK_BLOCKING_THRESHOLD','Angriff blockieren RS Schwellenwert');
define('ATTACK_BLOCKING_THRESHOLD_HELP', 'Angriffsabwehr Risiko-Schwellenwert (Standard: 35)');
define('SILENT_MODE_BLOCK_MAX_ATTEMPTS','Stiller Modus Schwellenwert');
define('SILENT_MODE_BLOCK_MAX_ATTEMPTS_HELP', 'Maximale Angriffsversuche für eine IP im stillen Modus (Standard: 10)');

define('O_WEBMASTER_EMAIL_HELP','Alarme werden durch '.OSE_WORDPRESS_FIREWALL.' an diese E-Mail-Adresse gesendet');
define('O_RECEIVE_EMAIL','Update E-Mail erhalten');
define('O_RECEIVE_EMAIL_HELP',''.OSE_WORDPRESS_FIREWALL.' Firewall oder Safe-Browsing Update E-Mails erhalten');
define('O_STRONG_PASSWORD', 'Sicheres Kennwort erzwingen');
define('O_STRONG_PASSWORD_HELP', 'Hiermit können Sie die Verwendung sicherer Kennwörter für alle Benutzer erzwingen. Ein sicheres Kennwort umfasst die Verwendung von alphanumerischen Zeichen & Symbolen');
define('FIREWALL_HELP','Wenn aktiviert, Firewall aktiv. Dies abzuschalten würde die Firewall deaktivieren (nicht empfohlen)');
define('O_FRONTEND_BLOCKING_MODE_HELP','Auswahl des Sperrmodus bei aktivierter Firewall');
define('O_GOOGLE_2_VERIFICATION_HELP','Schützen Sie durch die Aktivierung Ihr Administratorkonto vor unberechtigten Anmeldeversuchen. Aktivieren Sie diese Option und verknüpfen Sie Ihren Wordpressbenutzer!');
define('O_SEO_PAGE_TITLE_HELP','Dies ist der Text, welchen Sie am oberen Rand Ihres Browsers sehen. Suchmaschinen zeigen diesen Text als Titel Ihrer Sperrseite.');
define('O_SEO_META_KEY_HELP','Eine Reihe von Keywords relevant für die Sperrseite');
define('O_SEO_META_DESC_HELP','Eine kurze Beschreibung der Sperrseite.');
define('O_SEO_META_GENERATOR_HELP','CMS Generator der Sperrseite');
define('O_CUSTOM_BAN_PAGE_HELP','Diese Nachricht wird einem gesperrten Besucher angezeigt. Eine benutzerdefinierte Sperrseiten-URL überschreibt diese Nachricht.');
define('O_CUSTOM_BAN_PAGE_URL_HELP','Wenn diese Funktion aktiviert ist, wird der Angreifer umgeleitet auf die URL, welche in der benutzerdefinierte Sperrseite definiert ist');
define('HOURS_HELP', 'Wählen Sie die Stunde des Tages, an dem der Zeitplan ausgeführt werden soll. Die Stunde basiert auf Ihrer Zeitzone wie z.B. GMT:10 für Australien/Melbourne');
define('O_GOOGLE_2_SECRET_HELP', 'Verwenden Sie diesen Code mit dem Google Authenticator Browser-Plugin');
define('O_GOOGLE_2_QRCODE_HELP', 'Scannen Sie diesen QRCode mit einem Smartphone und der Google Authenticator App');
define('SEO_CONFIGURATION_HELP', 'Die SEO-Konfiguration gibt Ihnen die Kontrolle über Ihre Sperrseite. Dadurch wird sichergestellt, dass Ihre Website in Suchmaschinen-Rankings nicht beeinträchtigt wird.');
define('SEO_CONFIGURATION','Sperrseite SEO-Konfiguration');
define('O_STRONG_PASSWORD_SETTING', 'Sichere Kennworteinstellungen');
define('MPL', 'Minimale Kennwortlänge');
define('PMI', 'Minimale numerische Zeichen');
define('PMS', 'Minimale Sonderzeichen');
define('PUCM', 'Minimale Großbuchstaben');
define('RECOMMOND_PASSWORD', 'Empfohlene Einstellungen');
define('RECOMMOND_JOOMLA', 'Joomla empfohlene Einstellungen');
define('COUNTRYBLOCK_HELP', 'Mit dieser Funktion können Sie IPs für bestimmte Länder blockieren. Bitte beachten Sie, dass die Länderdatenbank unter dem Menüpunkt Firewall > Länderblockade zunächst heruntergeladen werden muss.');
define('O_ADRULESETS_HELP', '');
define('CONFIG_ADRULES_FAILE', 'Speichern fehlgeschlagen, die erweiterte Firewalldatenbank ist nicht bereit. Bitte aktualisieren Sie die Firewallsignaturen in den erweiterten Firewallregeln.');
define('DEVELOPMODE_DISABLED','<b>[Firewall aktiviert] </b>TOLL! Ihre Website ist nun durch '.OSE_WORDPRESS_FIREWALL.' geschützt');
define('DISDEVELOPMODE', '<b>WARNUNG</b>: Bitte aktivieren Sie die Firewall in der Firewallkonfiguration um den Firewallschutz zu aktivieren.');
define('O_DELETE_ADMIN_SUCCESS', 'Das Administratorkonto wurde erfolgreich gelöscht');
define('O_DELETE_ADMIN_FAIL', 'Fehler beim Löschen des Administratorkontos');
define('AFFILIATE_TRACKING', 'Partnerschaft');
define('LOGIN_TITLE', ''.OSE_WORDPRESS_FIREWALL.' Mitglieder-Login');
define('LOGIN_DESC', 'Sie können sich hier mit Ihrem '.OSE_WORDPRESS_FIREWALL.'-Konto einloggen um Ihre Premiumdienste zu aktivieren');
define('HOW_TO_ACTIVATE', 'Wie kann ich meinen Premiumservice aktivieren?');
define('SUBSCRIPTION_TITLE','Abonnementaktivierung');
define('SUBSCRIPTION_DESC','Bitte wählen Sie den Abonnementenplan, den Sie mit dieser Website verlinken möchten.');
define ('NEWS_TITLE', '<b>Was ist neu</b>');
define ('NEWS_DESC', 'Erfahren Sie die neuesten Nachrichten von '.OSE_WORDPRESS_FIREWALL.'');
define ('PASSCODE_TITLE', 'Kennwort');
define ('PASSCODE_DESC', 'Bitte geben Sie Ihr Kennwort ein um auf das Administrator-Modul zugreifen zu können´');

// Version 5.0.1
define ('O_LOGIN_PAGE_SETTING', 'Login Url');
define ('O_LOGIN_PAGE_HELP', 'Login Hilfe');
define ('CALL_TO_ACTION_P2', 'Website gehackt? Reinigen Sie die Schadsoftware mit einem 6 Monate Gratis Abo PLUS 3 Monate Garantie. <br/> <button class="btn btn-primary btn-sm" onClick ="location.href=\''.OSE_OEM_URL_MALWARE_REMOVAL.'\'">Überlassen Sie die harte Arbeit uns.</button>');
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

// Version 6.0
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
define("ZIP_DOWNLOAD","Download");



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
define('GITBACKUP', 'Git Sicherungsübersicht<sup><span>(New)</span></sup>');
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
define("COMMIT","Backup");
define("RECOMMENDATION_COMMIT", "The system has detected some unsaved changes, It is highly recommended to do a backup first");
define("RECOMMENDATION_DATABASE","It is highly recommended that you should NOT restore the old database");

?>
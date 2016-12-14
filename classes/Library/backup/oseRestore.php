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
    die ('Direct Access Not Allowed');
}

class oseRestoreManager
{

    public function __construct()
    {
        $this->setDBO();
        $this->optimizePHP();
        oseFirewall::loadRequest();
        oseFirewall::loadFiles();
        oseFirewall::loadDateClass();
    }

    protected function setDBO()
    {
        $this->db = oseFirewall::getDBO();
    }

    private function optimizePHP()
    {
        if (function_exists('ini_set')) {
            ini_set('max_execution_time', 300);
            ini_set('memory_limit', '1024M');
            ini_set("pcre.recursion_limit", "524");
        }
    }

    public function restore($filezip, $dbzip)
    {
        $result = array();
        $this->clearDB();
        $this->renameDB();

        if (file_exists($dbzip)) {
            $dbresult = $this->restoreDB($dbzip);
        }

        if (file_exists($filezip)) {
            $fileresult = $this->restoreFile($filezip);
        }
        if ($dbresult == true && $fileresult == true) {
            $result['status'] = "Completed";
        } else {
            $result['status'] = "Interrupted";
        }
        return $result;
    }

    private function clearDB()
    {
        $sql = "SHOW TABLES LIKE 'centrorabk_%'";
        $this->db->setQuery($sql);
        $results = $this->db->loadResultList();
        if (!empty($results)) {
            foreach ($results as $result) {
            	$arrayValue = array_values($result);
                $query = "DROP TABLE `" . $arrayValue[0] . "`;";
                $this->db->setQuery($query);
                $this->db->query();
            }
        }
    }
    private function restoreFile($filezip)
    {
        $zip = new ZipArchive;
        // make a list of all the files in the archive
        $entries = array();
        if ($zip->open($filezip) === TRUE) {
            for ($idx = 0; $idx < $zip->numFiles; $idx++) {
                $entries[] = $zip->getNameIndex($idx);
            }
            //remove config file
            if (($key = array_search('configuration.php', $entries)) !== false || ($key = array_search('wp-config.php', $entries)) !== false) {
                unset($entries[$key]);
            }
            array_filter($entries);

            $result = $zip->extractTo(OSE_ABSPATH . '/', $entries);

            $zip->close();
            if ($result == true) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    private function renameDB()
    {
        if (OSE_CMS == 'wordpress') {
            global $wpdb;
            $prefix = $wpdb->prefix;
            $dbname = $wpdb->dbname;
        } else {
            $config = JFactory::getConfig();
            $dbname = $config->get('db');
            $prefix = $config->get('dbprefix');
        }
        $sql = "SELECT Concat('ALTER TABLE ', TABLE_NAME, ' RENAME TO centrorabk_', TABLE_NAME, ';') FROM information_schema.tables WHERE table_schema = '" . $dbname . "' and TABLE_NAME LIKE '" . $prefix . "%';";
        $this->db->setQuery($sql);
        $results = $this->db->loadResultList();

        foreach ($results as $result) {
        	$arrayValue = array_values($result); 
            $this->db->setQuery($arrayValue[0]);
            $this->db->query();
        }
    }
    private function restoreDB($dbzip)
    {
        $zd = gzopen($dbzip, "r");
        $contents = gzread($zd, 10000);
        gzclose($zd);

        oseFirewall::loadInstaller();
        $installer = new oseFirewallInstaller ();

        $queries = $installer->_splitQueries($contents);
        foreach ($queries as $query) {
            $this->db->setQuery($query);
            if (!$this->db->query()) {
                return false;
            }
        }
        return true;
    }
}
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
class cfScanner extends virusScanner
{
    const CHUNK_SIZE = 2048;
    var $files = array();
    var $wordpressSites = array();
    var $joomlaSites = array();
    var $suiteSama = array();
    private $db = null;
    protected $filestable = '#__osefirewall_files';
    private $vshashtable = '#__osefirewall_vshash';
    private $scanhisttablebl = '#__osefirewall_scanhist';

    public function __construct()
    {
        $this->db = oseFirewall::getDBO();
        $this->optimizePHP();
    }
    public function wpcfscan()
    {
        global $wp_version;
        $modified = array();
        $suspicious = array();
        $return = array();
        $wproot = array(
            'index.php', 'wp-activate.php', 'wp-blog-header.php', 'wp-comments-post.php', 'wp-config.php', 'wp-config-sample.php',
            'wp-cron.php', 'wp-links-opml.php', 'wp-load.php', 'wp-login.php', 'wp-mail.php', 'wp-settings.php', 'wp-signup.php',
            'wp-trackback.php', 'xmlrpc.php'
        );
        $condition = array('type' => 'S');
        $this->db->deleteRecordString($condition, $this->filestable);
        if (true) {
            unset($filehashes);
            $hashes = OSE_FWDATA . ODS . 'wpHashList' . ODS . 'hashes-' . $wp_version . '.php';
            if (file_exists($hashes)) {
                include($hashes);
            } else {
                $return['cont'] = false;
                $return['summary'] = 'hashes-' . $wp_version . '.php not found';
                $return['details'] = 'The file containing hashes of all WordPress core files currently not available, please contact centrora support team';
                $return['status'] = 'Interupted';
                return $return;
            }

            $this->recurse_directory(OSE_ABSPATH);

            foreach ($this->files as $k => $file) {
                // don't scan unmodified core files
                if (isset($filehashes[$file])) {
                    if ($filehashes[$file] == md5_file(OSE_ABSPATH . '/' . $file)) {
                        unset($this->files[$k]);
                        continue;
                    } else {
                        $insertFolder = array(
                            'filename' => OSE_ABSPATH . '/' . $file,
                            'ext' => 'file',
                            'type' => 'S'
                        );
                        $fileID = $this->db->addData('insert', $this->filestable, '', '', $insertFolder);
                        if (CENT_AI == true) {
                            $file_with_filesize = $file . "---" . $this->human_filesize(filesize(OSE_ABSPATH . '/' . $file)) . '---<button onclick="addToAi(' . $fileID . ')">Add to AI</button>';
                        } else {
                            $file_with_filesize = $file . "---" . $this->human_filesize(filesize(OSE_ABSPATH . '/' . $file));
                        }
                        array_push($modified, $file_with_filesize);
                    }
                } else {
                    // scan suspicious files
                    list($dir, $flag) = explode('/', $file);
                    if ($dir == 'wp-includes' || $dir == 'wp-admin' || empty($flag)) {
                        if (substr($file, -4) == '.php' && !in_array($dir, $wproot)) {
                            $insertFolder = array(
                                'filename' => OSE_ABSPATH . '/' . $file,
                                'ext' => 'file',
                                'type' => 'S'
                            );
                            $fileID = $this->db->addData('insert', $this->filestable, '', '', $insertFolder);
                            if (CENT_AI == true) {
                                $file_with_filesize = $file . "---" . $this->human_filesize(filesize(OSE_ABSPATH . '/' . $file)) . '---<button onclick="addToAi(' . $fileID . ')">Add to AI</button>';
                            } else {
                                $file_with_filesize = $file . "---" . $this->human_filesize(filesize(OSE_ABSPATH . '/' . $file));
                            }
                            array_push($suspicious, $file_with_filesize);
                        }
                    }
                }
            }
            $count1 = sizeof($modified);
            $count2 = sizeof($suspicious);
            $detail1 = implode('<br>', $modified);
            $detail2 = implode('<br>', $suspicious);

            $return['cont'] = false;
            $return['summary'] = 'There are ' . $count1 . ' core files modified and ' . $count2 . ' suspicious files found in wp-includes/ or wp-admin/ or root directory.';
            $return['modified'] = $detail1;
            $return['suspicious'] = $detail2;
        $return['status'] = 'Completed';
            $return['count1'] = $count1;
            $return['count2'] = $count2;

            $scanList['scanlist'] = array();
            $scanList['totalscan'] = count($this->files);
            $scanList['totalvs'] = $count1 + $count2;
            $scanList['vsfilelist'] = array();
            $this->saveDBLastScanResult($scanList);

            return $return;
        }
    }

    private function recurse_directory($dir)
    {
        if ($handle = @opendir($dir)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != '.' && $file != '..') {
                    $file = $dir . '/' . $file;
                    if (is_dir($file)) {
                        $this->recurse_directory($file);
                    } elseif (is_file($file)) {
                        $this->files[] = str_replace(OSE_ABSPATH . '/', '', $file);
                    }
                }
            }
            closedir($handle);
        }
    }

    public function jcfscan($start = 0)
    {
        $return = array();
        $modified = array();
        $missing = array();
        $suspicious = array();
        // version information
        $version = $this->getCurrentJoomlaVersion();
        $condition = array('type' => 'S');
        $this->db->deleteRecordString($condition, $this->filestable);
        // Below stable?
        if ($this->isAlpha($version)) {
            $return['cont'] = false;
            $return['summary'] = 'Current version ' . $version . ' is not a stable version';
            $return['details'] = NO_HASHES_FOR_ALPHA;
            $return['status'] = 'Interupted';
            return $return;
        }

        try {
            $jcorefile = OSE_FWDATA . ODS . 'jHashList' . ODS . 'jcore' . $version . '.php';
            if (file_exists($jcorefile)) {
                include($jcorefile);
            } else {
                $return['cont'] = false;
                $return['summary'] = 'jcore.php file not found';
                $return['details'] = 'The file containing all Joomla core files currently not available, please contact centrora support team';
                $return['status'] = 'Interupted';
                return $return;
            }
            $hashes = OSE_FWDATA . ODS . 'jHashList' . ODS . $version . '.csv';
            if (file_exists($hashes)) {
                if ($handle = @fopen($hashes, 'r')) {

                    // set pointer to last value
                    fseek($handle, $start);

                    // read data
                    while (($data = fgetcsv($handle, self::CHUNK_SIZE, ',')) !== false) {

                        list($file_path, $file_hash) = $data;

                        $full_path = JPATH_SITE . '/' . $file_path;

                        if (file_exists($full_path)) {
                            // does this file have a wrong checksum ?
                            if (md5_file($full_path) != $file_hash) {
                                $insertFolder = array(
                                    'filename' => $full_path,
                                    'ext' => 'file',
                                    'type' => 'S'
                                );
                                $fileID = $this->db->addData('insert', $this->filestable, '', '', $insertFolder);
                                if (CENT_AI == true) {
                                    $file_with_filesize = $file_path . "---" . $this->human_filesize(filesize($full_path)) . '---<button onclick="addToAi(' . $fileID . ')">Add to AI</button>';
                                } else {
                                    $file_with_filesize = $file_path . "---" . $this->human_filesize(filesize($full_path));
                                }
                                array_push($modified, $file_with_filesize);
                            }
                        } else {
                            // record missing files
                            $file_with_filesize = $file_path . "---" . $this->human_filesize(filesize($full_path));
                            array_push($missing, $file_with_filesize);
                        }
                    }
                    // scan suspicious files
                    $core_dir = array(
                        JPATH_SITE . '/administrator/includes', JPATH_SITE . '/includes', JPATH_SITE . '/templates/beez3',
                        JPATH_SITE . '/templates/protostar', JPATH_SITE . '/templates/system', JPATH_SITE . '/libraries',
                    );
                    $core_root = array(
                        'index.php', 'configuration.php'
                    );
                    $files = scandir(JPATH_SITE);

                    foreach ($files as $file) {
                        if (is_file(JPATH_SITE . ODS . $file)) {

                            if (!in_array($file, $core_root) && substr($file, -4) == '.php') {
                                $insertFolder = array(
                                    'filename' => JPATH_SITE . ODS . $file,
                                    'ext' => 'file',
                                    'type' => 'S'
                                );
                                $fileID = $this->db->addData('insert', $this->filestable, '', '', $insertFolder);
                                if (CENT_AI == true) {
                                    $file_with_filesize = $file . "---" . $this->human_filesize(filesize(JPATH_SITE . '/' . $file)) . '---<button onclick="addToAi(' . $fileID . ')">Add to AI</button>';
                                } else {
                                    $file_with_filesize = $file . "---" . $this->human_filesize(filesize(JPATH_SITE . '/' . $file));
                                }
                                array_push($suspicious, $file_with_filesize);
                            }
                        }
                    }

                    foreach ($core_dir as $single) {
                        if (file_exists($single)) {
                            foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($single)) as $filename) {

                                if ($filename->isDir()) continue;
                                $filename = str_replace(JPATH_SITE . '/', '', $filename);
                                $exclude = explode('/', $filename);
                                if ($exclude[1] == 'f0f') continue;
                                if ($exclude[1] == 'fof') continue;
                                if (!in_array($filename, $jcole) && substr($filename, -4) == '.php') {
                                    $insertFolder = array(
                                        'filename' => JPATH_SITE . ODS . $filename,
                                        'ext' => 'file',
                                        'type' => 'S'
                                    );
                                    $fileID = $this->db->addData('insert', $this->filestable, '', '', $insertFolder);
                                    if (CENT_AI == true) {
                                        $file_with_filesize = $filename . "---" . $this->human_filesize(filesize(JPATH_SITE . '/' . $filename)) . '---<button onclick="addToAi(' . $fileID . ')">Add to AI</button>';
                                    } else {
                                        $file_with_filesize = $filename . "---" . $this->human_filesize(filesize(JPATH_SITE . '/' . $filename));
                                    }
                                    array_push($suspicious, $file_with_filesize);
                                }
                                closedir($single);
                            }
                        }
                    }
                    fclose($handle);

                    $count1 = sizeof($modified);
                    $count2 = sizeof($suspicious);
                    $count3 = sizeof($missing);
                    $detail1 = implode('<br>', $modified);
                    $detail2 = implode('<br>', $suspicious);
                    $detail3 = implode('<br>', $missing);

                    $return['cont'] = false;
                    $return['summary'] = 'There are ' . $count1 . ' core files modified, ' . $count2 . ' suspicious files, ' . $count3 . ' files missing.';
                    $return['modified'] = $detail1;
                    $return['missing'] = $detail3;
                    $return['suspicious'] = $detail2;
                    $return['status'] = 'Completed';
                    $return['count1'] = $count1;
                    $return['count2'] = $count2;
                    $return['count3'] = $count3;

                    $scanList['scanlist'] = array();
                    $scanList['totalscan'] = count($data);
                    $scanList['totalvs'] = $count1 + $count2 + $count3;
                    $scanList['vsfilelist'] = array();
                    $this->saveDBLastScanResult($scanList);

                    return $return;
                }
            } else {
                $return['cont'] = false;
                $return['summary'] = 'hash file ' . $version . '.csv missing';
                $return['details'] = 'The file containing hashes of all Joomla core files appears to be missing';
                $return['status'] = 'Interupted';
                return $return;
            }

        } catch (Exception $e) {
            $return['cont'] = false;
            $return['summary'] = 'There are unknown errors during scanning' . $e->getMessage();
            $return['details'] = 'Cannot scan files, possible reason is memory limit or file size too large';
            $return['status'] = 'Interupted';
            return $return;
        }
    }

    public function isAlpha($version = null)
    {
        if (is_null($version)) {
            $version = $this->getCurrentJoomlaVersion();
        }

        return preg_match('#[a-z]+#i', $version);
    }

    protected function getCurrentJoomlaVersion()
    {
        static $current = null;

        if (is_null($current)) {
            $jversion = new JVersion();
            $current = $jversion->getShortVersion();
            if (strpos($current, ' ') !== false) {
                $current = reset(explode(' ', $current));
            }
        }
        return $current;
    }

    private function isStandardSuite()
    {
        $container = array();
        if (is_readable('/home')) {
            $suiteFolders = array('httpdocs', 'htdocs', 'public_html');
            $roots = scandir('/home');
            foreach ($roots as $root) {
                $rootDir = '/home' . ODS . $root;
                if (is_dir($rootDir) && $root != '.' && $root != '..') {
                    foreach ($suiteFolders as $suiteFolder) {
                        if (is_dir($rootDir . '/' . $suiteFolder)) {
                            $container[] = $rootDir . '/' . $suiteFolder;
                        }
                    }
                }
            }
            if (empty($container)) {
                return false;
            } else {
                return $container;
            }
        } else {
            $suiteFolders = array('httpdocs', 'htdocs', 'public_html');
            $roots = scandir(OSE_SUITEPATH);
            foreach ($roots as $root) {
                $rootDir = OSE_SUITEPATH . ODS . $root;
                if (is_dir($rootDir) && $root != '.' && $root != '..') {
                    foreach ($suiteFolders as $suiteFolder) {
                        if (is_dir($rootDir . '/' . $suiteFolder)) {
                            $container[] = $rootDir . '/' . $suiteFolder;
                        }
                    }
                }
            }
            if (empty($container)) {
                return false;
            } else {
                return $container;
            }
        }
    }

    private function isJoomla($dir)
    {
        $result = array();
        $joomlaDirs = scandir($dir);
        foreach ($joomlaDirs as $joomlaDir) {
            if (is_dir($dir . ODS . $joomlaDir) && $joomlaDir == 'libraries') {
                $joomlaVersionFile = $dir . ODS . $joomlaDir . ODS . 'cms/version/version.php';
                if (file_exists($joomlaVersionFile)) {
                    $versionContent = file_get_contents($joomlaVersionFile);
                    preg_match_all("/(RELEASE|DEV_LEVEL) = ('\d+'|'\d.\d+')/", $versionContent, $output_array);
                    $joomla_version = str_replace("'", "", $output_array[2][0]) . '.' . str_replace("'", "", $output_array[2][1]);
                    $result['cms'] = 'jm';
                    $result['message'] = '<label>Joomla Site</label>';
                    $result['version'] = $joomla_version;
                } else {
                    $result['cms'] = false;
                }
            }
        }
        return $result;
    }

    private function isWordpress($dir)
    {
        $result = array();
        $wordpressDirs = scandir($dir);
        foreach ($wordpressDirs as $wordpressDir) {
            if (is_dir($dir . ODS . $wordpressDir) && $wordpressDir == 'wp-includes') {
                $wpVersionFile = $dir . ODS . $wordpressDir . ODS . 'version.php';
                if (file_exists($wpVersionFile)) {
                    require_once($wpVersionFile);
                    $result['cms'] = 'wp';
                    $result['message'] = '<label>Wordpress Site</label>';
                    $result['version'] = $wp_version;
                    return $result;
                } else {
                    $result['cms'] = false;
                    return $result;
                }
            }
        }
        return $result;
    }

    public function getMultiSite()
    {
        $standardSuites = $this->isStandardSuite();
        // scan root folder
        if ($standardSuites) {
            foreach ($standardSuites as $standardSuite) {
                $websites = scandir($standardSuite);
                foreach ($websites as $website) {
                    if ($website != '.' && $website != '..' && $website != '.DS_Store') {
                        $dir = $standardSuite . ODS . $website;
                        $this->isJoomla($dir);
                        $this->isWordpress($dir);
                    }
                }
                }
        } else {
            $this->isJoomla(OSE_SUITEPATH);
            $websites = scandir(OSE_SUITEPATH);
            foreach ($websites as $website) {
                if ($website != '.' && $website != '..' && $website != '.DS_Store') {
                    $dir = OSE_SUITEPATH . ODS . $website;
                    $this->isJoomla($dir);
                    $this->isWordpress($dir);
                }
                }
            }
    }

    public function suitecfscan($path, $type, $version)
    {
        $condition = array('type' => 'S');
        $this->db->deleteRecordString($condition, $this->filestable);
        $vsCount = 0;
        $totalCount = 0;
        if ($type == 'wp') {
            $this->suiteSama = $this->suitewpcfscan($version, $path);
            $vsCount = $this->suiteSama['count1'] + $this->suiteSama['count2'];
            $totalCount = $this->suiteSama['totalScan'];
        } elseif ($type == 'jm') {

            $this->suiteSama = $this->suitejoomlacfscan($version, $path);
            $vsCount = $this->suiteSama['count1'] + $this->suiteSama['count2'] + $this->suiteSama['count3'];
            $totalCount = $this->suiteSama['totalScan'];
        }
        $scanList['scanlist'] = array();
        $scanList['totalscan'] = $totalCount;
        $scanList['totalvs'] = $vsCount;
        $scanList['vsfilelist'] = array();
        $this->saveDBLastScanResult($scanList);
        return $this->suiteSama;
    }

    public function suitejoomlacfscan($joomla_version, $joomlapath)
    {
        $return = array();
        $modified = array();
        $missing = array();
        $suspicious = array();

        try {
            $jcorefile = OSE_FWDATA . ODS . 'jHashList' . ODS . 'jcore' . $joomla_version . '.php';
            if (file_exists($jcorefile)) {
                include($jcorefile);
            } else {
                $return['cont'] = false;
                $return['summary'] = 'jcore.php file not found';
                $return['details'] = 'The file containing all Joomla core files currently not available, please contact centrora support team';
                $return['status'] = 'Interupted';
                return $return;
            }
            $hashes = OSE_FWDATA . ODS . 'jHashList' . ODS . $joomla_version . '.csv';
            if (file_exists($hashes)) {
                if ($handle = @fopen($hashes, 'r')) {

                    // set pointer to last value
                    fseek($handle, 0);

                    // read data
                    while (($data = fgetcsv($handle, self::CHUNK_SIZE, ',')) !== false) {

                        list($file_path, $file_hash) = $data;

                        $full_path = $joomlapath . '/' . $file_path;

                        if (file_exists($full_path)) {
                            // does this file have a wrong checksum ?
                            if (md5_file($full_path) != $file_hash) {
                                $file_with_filesize = $file_path . "---" . $this->human_filesize(filesize($full_path));
                                array_push($modified, $file_with_filesize);
                            }
                        } else {
                            // record missing files
                            $file_with_filesize = $file_path . "---" . $this->human_filesize(filesize($full_path));
                            array_push($missing, $file_with_filesize);
                        }
                    }
                    // scan suspicious files
                    $core_dir = array(
                        $joomlapath . '/administrator/includes', $joomlapath . '/includes', $joomlapath . '/templates/beez3',
                        $joomlapath . '/templates/protostar', $joomlapath . '/templates/system', $joomlapath . '/libraries'
                    );
                    $core_root = array(
                        'index.php', 'configuration.php'
                    );
                    $files = scandir($joomlapath);

                    foreach ($files as $file) {
                        if (is_file($joomlapath . ODS . $file)) {

                            if (!in_array($file, $core_root) && substr($file, -4) == '.php') {
                                $file_with_filesize = $file . "---" . $this->human_filesize(filesize($joomlapath . ODS . $file));
                                array_push($suspicious, $file_with_filesize);
                                $insertFolder = array(
                                    'filename' => $joomlapath . ODS . $file,
                                    'ext' => 'folder',
                                    'type' => 'S'
                                );
                                $this->db->addData('insert', $this->filestable, '', '', $insertFolder);
                            }
                        }
                    }

                    foreach ($core_dir as $single) {
                        if (file_exists($single)) {
                            foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($single)) as $filename) {

                                if ($filename->isDir()) continue;
                                $filename = str_replace($joomlapath . '/', '', $filename);

                                $exclude = explode('/', $filename);
                                if ($exclude[1] == 'f0f') continue;

                                if (!in_array($filename, $jcole) && substr($filename, -4) == '.php') {
                                    $file_with_filesize = $filename . "---" . $this->human_filesize(filesize($joomlapath . ODS . $filename));
                                    array_push($suspicious, $file_with_filesize);
                                    $insertFolder = array(
                                        'filename' => $joomlapath . ODS . $file,
                                        'ext' => 'folder',
                                        'type' => 'S'
                                    );
                                    $this->db->addData('insert', $this->filestable, '', '', $insertFolder);
                                }
                                closedir($single);
                            }
                        }
                    }
                    fclose($handle);

                    $count1 = sizeof($modified);
                    $count2 = sizeof($suspicious);
                    $count3 = sizeof($missing);
                    $detail1 = implode('<br>', $modified);
                    $detail2 = implode('<br>', $suspicious);
                    $detail3 = implode('<br>', $missing);

                    $return['cont'] = false;
                    $return['summary'] = 'There are ' . $count1 . ' core files modified, ' . $count2 . ' suspicious files, ' . $count3 . ' files missing.';
                    $return['modified'] = $detail1;
                    $return['missing'] = $detail3;
                    $return['suspicious'] = $detail2;
                    $return['status'] = 'Completed';
                    $return['count1'] = $count1;
                    $return['count2'] = $count2;
                    $return['count3'] = $count3;
                    $return['totalScan'] = count($data);

                    return $return;
                }
            } else {
                $return['cont'] = false;
                $return['summary'] = 'hash file ' . $joomla_version . '.csv missing';
                $return['details'] = 'The file containing hashes of all Joomla core files appears to be missing';
                $return['status'] = 'Interupted';
                return $return;
            }

        } catch (Exception $e) {
            $return['cont'] = false;
            $return['summary'] = 'There are unknown errors during scanning '.$e->getMessage();
            $return['details'] = 'Cannot scan files, possible reason is memory limit or file size too large';
            $return['status'] = 'Interupted';
            return $return;
        }
    }

    public function suitewpcfscan($wp_version, $wppath)
    {
        $modified = array();
        $suspicious = array();
        $return = array();
        $wproot = array(
            'index.php', 'wp-activate.php', 'wp-blog-header.php', 'wp-comments-post.php', 'wp-config.php', 'wp-config-sample.php',
            'wp-cron.php', 'wp-links-opml.php', 'wp-load.php', 'wp-login.php', 'wp-mail.php', 'wp-settings.php', 'wp-signup.php',
            'wp-trackback.php', 'xmlrpc.php'
        );
        if (true) {
            unset($filehashes);
            $hashes = OSE_FWDATA . ODS . 'wpHashList' . ODS . 'hashes-' . $wp_version . '.php';
            if (file_exists($hashes)) {
                include($hashes);
            } else {
                $return['cont'] = false;
                $return['summary'] = 'hashes-' . $wp_version . '.php not found';
                $return['details'] = 'The file containing hashes of all WordPress core files currently not available, please contact centrora support team';
                $return['status'] = 'Interupted';
                return $return;
            }

            $this->recurse_directory($wppath);
            foreach ($this->files as $k => $file) {
                // don't scan unmodified core files
                if (isset($filehashes[$file])) {
                    if ($filehashes[$file] == md5_file($wppath . '/' . $file)) {
                        unset($this->files[$k]);
                        continue;
                    } else {
                        $file_with_filesize = $file . "---" . $this->human_filesize(filesize($wppath . '/' . $file));
                        array_push($modified, $file_with_filesize);
                    }
                } else {
                    // scan suspicious files
                    list($dir, $flag) = explode('/', $file);

                    if ($dir == 'wp-includes' || $dir == 'wp-admin' || empty($flag)) {
                        if (substr($file, -4) == '.php' && !in_array($dir, $wproot)) {
                            $file_with_filesize = $file . "---" . $this->human_filesize(filesize($wppath . '/' . $file));
                            array_push($suspicious, $file_with_filesize);
                            $insertFolder = array(
                                'filename' => $wppath . '/' . $file,
                                'ext' => 'folder',
                                'type' => 'S'
                            );
                            $this->db->addData('insert', $this->filestable, '', '', $insertFolder);
                        }
                    }
                }
            }
            $count1 = sizeof($modified);
            $count2 = sizeof($suspicious);
            $detail1 = implode('<br>', $modified);
            $detail2 = implode('<br>', $suspicious);

            $return['cont'] = false;
            $return['summary'] = 'There are ' . $count1 . ' core files modified and ' . $count2 . ' suspicious files found in wp-includes/ or wp-admin/ or root directory.';
            $return['modified'] = $detail1;
            $return['suspicious'] = $detail2;
            $return['status'] = 'Completed';
            $return['count1'] = $count1;
            $return['count2'] = $count2;
            $return['totalScan'] = count($this->files);
            return $return;
        }
    }

    public function catchVirusMD5()
    {
        $return = array();
        $query = "SELECT `filename` FROM " . $this->db->quoteTable($this->filestable) . " WHERE type = 'S'";
        $this->db->setQuery($query);
        $result = $this->db->loadObjectList();
        if (!empty($result)) {
            foreach ($result as $single) {

                $insertFolder = array(
                    'hash' => md5_file($single->filename),
                    'name' => 'local.' . $single->filename,
                    'type' => 0,
                    'inserted_on' => oseFirewall::getTime()
                );
                $this->db->addData('insert', $this->vshashtable, '', '', $insertFolder);
            }
        }
        $return['status'] = 'update';
        return $return;
    }

    protected function saveDBLastScanResult($content = '')
    {
        $varValues = array('super_type' => 'cfscan',
            'sub_type' => 1,
            'content' => oseJSON::encode(array($content)),
            'inserted_on' => oseFirewall::getTime()
        );
        $this->db->addData('insert', $this->scanhisttablebl, '', '', $varValues);
    }

    public function addToAi($id)
    {
        $query = "SELECT `filename` FROM " . $this->db->quoteTable($this->filestable) . " WHERE id = " . $id;
        $this->db->setQuery($query);
        $result = $this->db->loadObject();
        $file = $result->filename;
        $insertFolder = array(
            'filename' => $file,
            'type' => 'I'
        );
        $fileID = $this->db->addData('insert', $this->filestable, '', '', $insertFolder);
        return $fileID;
    }

    protected function optimizePHP()
    {

        if (function_exists('ini_set')) {
            ini_set('max_execution_time', 60);
            ini_set('memory_limit', '256M');
            ini_set("pcre.recursion_limit", "524");
            set_time_limit(60);
        }

    }

    public function suitePathDetect($path)
    {
        $flag = $this->isWordpress($path);
        if ($flag['cms'] == false) {
            $flag = $this->isJoomla($path);
        }
        return $flag;
    }

    public function coreFileCheck()
    {
        $return = array();
        $results = $this->getRawFile();
        if (!empty($results)) {
            if (OSE_CMS == 'wordpress') {
                global $wp_version;
                $hashes = OSE_FWDATA . ODS . 'wpHashList' . ODS . 'hashes-' . $wp_version . '.php';
                if (file_exists($hashes)) {
                    include($hashes);

                    foreach ($results as $result) {
                        $coreFile = str_replace(OSE_ABSPATH . '/', "", $result->filename);
                        if (isset($filehashes[$coreFile])) {
                            $notes = 1;
                        } else {
                            $notes = 0;
                        }
                        $statusArray = array(
                            'content' => $notes
                        );
                        $this->db->addData('update', $this->filestable, 'id', $result->id, $statusArray);
                    }
                } else {
                    $return['status'] = 'raw';
                }
            } else {
                $version = $this->getCurrentJoomlaVersion();
                $jcorefile = OSE_FWDATA . ODS . 'jHashList' . ODS . 'jcore' . $version . '.php';
                if (file_exists($jcorefile)) {
                    include($jcorefile);
                    foreach ($results as $result) {
                        $coreFile = str_replace(OSE_ABSPATH . '/', "", $result->filename);
                        if (in_array($coreFile, $jcole)) {
                            $notes = 1;
                        } else {
                            $notes = 0;
                        }
                        $statusArray = array(
                            'content' => $notes
                        );
                        $this->db->addData('update', $this->filestable, 'id', $result->id, $statusArray);
                    }
                } else {
                    $return['status'] = 'raw';
                }
            }
        } else {
            $return['status'] = 'raw';
        }
        $this->db->closeDBO();
        return $return;
    }

    public function getRawFile()
    {
        $query = "SELECT `id`, `filename` FROM `#__osefirewall_files` WHERE `content` IS NULL AND `type` = 'f'";
        $this->db->setQuery($query);
        $results = $this->db->loadObjectList();
        return $results;
    }
}

?>

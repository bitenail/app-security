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

class aiScanner extends virusScanner
{
    protected $filestable = '#__osefirewall_files';
    private $scanhisttablebl = '#__osefirewall_scanhist';
    protected $malwaretable = '#__osefirewall_malware';
    private $db = null;
    var $files = array();
    var $folder = array();
    var $md5 = array();
    var $name = array();
    var $date = array();
    var $size = array();
    var $ulti = array();
    var $found = array();
    var $fullPatterns = array();
    private $fpscanProgress;
    protected $country_ready = false;
    protected $where = array();
    protected $orderBy = ' ';
    protected $limitStm = ' ';
    private $aiscanProgress;

    public function __construct()
    {
        $this->db = oseFirewall::getDBO();
        oseFirewall::loadFiles();
        $this->setFullPatterns();
        $this->optimizePHP();
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

    public function aiscan($samples)
    {
        $this->cleanMalwareData();
        $this->clearTable();
        $this->db->truncateTable('#__osefirewall_aiscan');

        $this->files = explode(';', $samples);
//                foreach ($this->files as $file){
//                    $md5 = md5_file(trim($file));
//                    if (!empty($md5)) {
//                        $this->md5[] = $md5;
//                    }
//            }
        foreach ($this->files as $file) {
            $name = basename(trim($file));
            if (!empty($name)) {
                $this->name[] = $name;
            }
        }
        foreach ($this->files as $file) {
            $date = date('Y-m-d H:m:s', filemtime(trim($file)));
            if (!empty($date)) {
                $this->date[] = $date;
            }
        }
        foreach ($this->files as $file) {
            $size = filesize(trim($file));
            if (!empty($size)) {
                $this->size[] = $size;
            }
        }
        foreach ($this->files as $file) {
            $this->accurateScan(trim($file));
        }
        $fileList = $this->getAllFiles(OSE_ABSPATH);

        if (!empty($this->name)) {
            $this->saveNameFeatures($this->name);
        }
        if (!empty($this->date)) {
            $this->saveDateFeatures($this->date);
        }
        if (!empty($this->size)) {
            $this->saveSizeFeatures($this->size);
        }
        if (!empty($this->ulti)) {
            $this->savePatternFeatures($this->ulti);
        }
        if (!empty($fileList)) {
            $this->saveFiles($fileList);
        }
        $this->setScanProgress(0, oLang::_get('VL_GET_LIST'), true);
        return $this->aiscanProgress;

    }

    public function aiscan_main()
    {
        $fileList = $this->setFiles();
        $this->setNameFeatures();
        $this->setDateFeatures();
        $this->setSizeFeatures();
        $this->setPatternFeatures();
        $total = count($fileList);
        $starttime = time();
        $path = "complete";
        $i = 0;
        foreach ($fileList as $key => $single) {
            $this->found = array();
            $single = trim($single);
            foreach ($this->name as $namefeature) {
                similar_text(basename($single), $namefeature, $percent);
                if ($percent > 60) {
                    $this->found['filename'] = $single;
                    $this->found['name'] = 1;
                }
            }
//           foreach ($this->md5 as $md5feature) {
//               if ($md5feature == md5_file($single)){
//                   $this->found['filename'] = $single;
//                   $this->found['md5'] = 1;
//               }
//           }
//
            foreach ($this->date as $datefeature) {
                if ($datefeature == date('Y-m-d H:m:s', filemtime($single))) {
                    $this->found['filename'] = $single;
                    $this->found['date'] = 1;
                }
            }
            foreach ($this->size as $sizefeature) {
                if ($sizefeature == filesize($single)) {
                    $this->found['filename'] = $single;
                    $this->found['size'] = 1;
                }
            }
            foreach ($this->ulti as $ultifeature) {
                $this->ultiscan($single, $ultifeature);
            }
            if (!empty($this->found['filename'])) {
                //$md5score = (empty($this->found['md5'])) ? 0:1;
                $namescore = (empty($this->found['name'])) ? 0 : 1;
                $datescore = (empty($this->found['date'])) ? 0 : 1;
                $patternscore = (empty($this->found['pattern'])) ? 0 : 1;
                $sizescore = (empty($this->found['size'])) ? 0 : 1;
                $this->found['score'] = $namescore * 35 + $patternscore * 45 + $sizescore * 10 + $datescore * 10;
                if ($this->found['score'] > 40) {
                    $this->db->addData('insert', '#__osefirewall_aiscan', '', '', $this->found);
                }
            }
            $path = $single;
            //unset clean files from scan list
            unset ($fileList[$key]);
            if (empty($fileList)) {
                $this->setScanProgress(100, $path, false);
                return $this->aiscanProgress;
            }
            //break from loop to send progress every 3sec. Ajax handles recall of this function if scanning is not complete
            if (time() - $starttime >= 5) {
                //$vsFileList [] = $path; //testing
                break;
            }
        }
        $numScanned = $total - count($fileList);
        $this->saveFiles($fileList);

        $this->setScanProgress(round($numScanned / $total, 3) * 100, $path, true);

        return $this->aiscanProgress;

    }

    public function aiscan_finish()
    {
        $result = $this->getAIscanResult();
        $this->deleteFeatures();
        return $result;
    }
    private function getAIscanResult()
    {
        $query = "SELECT `filename`,`score` FROM `#__osefirewall_aiscan` WHERE `score` > 40";
        $this->db->setQuery($query);
        $results = $this->db->loadObjectList();
        foreach ($results as $result) {
            $return[] = $result->filename . '---------------' . $result->score;
        }
        $return = implode('<br>', $return);
        return $return;
    }

    private function ultiscan($scan_file, $ultiFeature)
    {
        if (empty($scan_file)) {
            return false;
        }
        $pattern = $ultiFeature['pattern'];
        $patternID = $ultiFeature['id'];
        oseFirewall::loadFiles();
        $content = oseFile::read($scan_file);
        $array = preg_split('/' . trim($pattern) . '/im', $content, 2);

        if (count($array) > 1) {
            $this->found['filename'] = $scan_file;
            $this->found['pattern'] = 1;
            $file_id = $this->insertData($scan_file, 'f', '');
            $this->logMalware($file_id, $patternID);
        }
    }

    private function recurse_directory($dir)
    {
        if ($handle = @opendir($dir)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != '.' && $file != '..' && $file != '.DS_Store') {
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

    private function setFullPatterns()
    {
        $query = "SELECT `id`,`patterns` FROM `#__osefirewall_vspatterns`";
        $this->db->setQuery($query);
        $this->fullPatterns = $this->db->loadObjectList();
    }

    private function accurateScan($scan_file)
    {
        $tmp = array();
        if (empty($scan_file)) {
            return false;
        }
        oseFirewall::loadFiles();
        $virus_found = false;
        $content = oseFile::read($scan_file);
        $matches = array();
        $i = 0;

        foreach ($this->fullPatterns as $key => $pattern) {
            $i++;
            $array = preg_split('/' . trim($pattern->patterns) . '/im', $content, 2);

            if (count($array) > 1) {
                $tmp['pattern'] = $pattern->patterns;
                $tmp['id'] = $pattern->id;

                $this->ulti[] = $tmp;
                break;
            }
        }
        usleep(100);
    }


    private function getAllFiles($dir)
    {
        $files = array();
        $extArray = array('php', 'js', 'txt', '');

        $objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(realpath($dir), RecursiveDirectoryIterator::SKIP_DOTS), RecursiveIteratorIterator::SELF_FIRST, RecursiveIteratorIterator::CATCH_GET_CHILD);

        foreach ($objects as $path => $single) {
            if ($single != '.' && $single != '..' && $single != '.svn' && $single != '.idea') {
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                if (is_file($path) && $ext != 'pbk' && in_array($ext, $extArray)) {
                    $files[] = $path;
                }
            }
        }
        return $files;
    }

    public function getPatterns()
    {
        $columns = oRequest::getVar('columns', null);
        $limit = oRequest::getInt('length', 15);
        $start = oRequest::getInt('start', 0);
        $search = oRequest::getVar('search', null);
        $orderArr = oRequest::getVar('order', null);
        $sortby = null;
        $orderDir = 'asc';
        if (!empty($orderArr[0]['column'])) {
            $sortby = $columns[$orderArr[0]['column']]['data'];
            $orderDir = $orderArr[0]['dir'];
        }
        $return = $this->getPatternsDB($search['value'], $start, $limit, $sortby, $orderDir);
        return $return;
    }

    public function getPatternsDB($search, $start, $limit, $sortby, $orderDir)
    {
        $return = array();
        if (!empty($search)) {
            $this->getWhereName($search);
        }

        $this->getOrderBy($sortby, $orderDir);
        if (!empty($limit)) {
            $this->getLimitStm($start, $limit);
        }
        $where = $this->db->implodeWhere($this->where);
        // Get Records Query;
        $return['data'] = $this->getAllRecords($where);
        $count = $this->getAllCounts($where);
        $return['recordsTotal'] = $count['recordsTotal'];
        $return['recordsFiltered'] = $count['recordsFiltered'];

        return $return;
    }

    protected function getWhereName($search)
    {
        $this->where[] = "`patterns` LIKE " . $this->db->quoteValue($search . '%', true) . " OR `type_id` = " . $this->db->quoteValue($search, true);
    }

    protected function getLimitStm($start, $limit)
    {
        if (!empty($limit)) {
            $this->limitStm = " LIMIT " . (int)$start . ", " . (int)$limit;
        }
    }

    protected function getOrderBy($sortby, $orderDir)
    {
        if (empty($sortby)) {
            $this->orderBy = "";
        } else {
            $this->orderBy = " ORDER BY " . addslashes($sortby) . ' ' . addslashes($orderDir);
        }
    }

    private function getAllRecords($where)
    {
        $sql = 'SELECT `id`, `patterns`, `type_id` FROM `#__osefirewall_vspatterns`';
        $query = $sql . $where . $this->orderBy . " " . $this->limitStm;
        $this->db->setQuery($query);
        $results = $this->convertPatterns($this->db->loadObjectList());
        return $results;
    }

    private function convertPatterns($results)
    {
        foreach ($results as $result) {
            $result->patterns = htmlentities($result->patterns);
        }
        return $results;
    }
    private function getAllCounts($where)
    {
        $return = array();
        // Get total count
        $sql = 'SELECT COUNT(`id`) AS count FROM `#__osefirewall_vspatterns`';
        $this->db->setQuery($sql);
        $result = $this->db->loadObject();
        $return['recordsTotal'] = $result->count;
        // Get filter count
        $this->db->setQuery($sql . $where);
        $result = $this->db->loadObject();
        $return['recordsFiltered'] = $result->count;
        return $return;
    }

    public function addPattern($pattern, $type)
    {
        $patternArray = array(
            'patterns' => $pattern,
            'type_id' => $type,
            'confidence' => 50
        );
        $result = $this->db->addData('insert', '#__osefirewall_vspatterns', '', '', $patternArray);
        return $result;
    }

    public function deletePattern($ids)
    {
        foreach ($ids as $id) {
            $result = $this->db->deleteRecord(array('id' => $id), '#__osefirewall_vspatterns');
            $this->db->closeDBO();
        }
        return $result;
    }

    protected function insertData($filename, $type, $fileext = '')
    {
        $result = $this->getfromDB($filename, $type, $fileext);
        if (empty($result)) {
            return $this->insertInDB($filename, $type, $fileext);
        } else {
            $this->updateFile($result->id, 'checked', 0);
            return $result->id;
        }
    }

    private function getfromDB($filename, $type, $fileext)
    {
        $query = "SELECT `id` "
            . "FROM " . $this->db->quoteTable($this->filestable)
            . " WHERE `filename` = " . $this->db->quoteValue($filename)
            . " AND `type` = " . $this->db->quoteValue($type)
            . " AND `ext` = " . $this->db->quoteValue($fileext);
        $this->db->setQuery($query);
        $result = $this->db->loadObject();
        return $result;
    }

    public function insertInDB($filename, $type, $fileext)
    {
        $varValues = array(
            'filename' => $filename,
            'type' => $type,
            'checked' => 0,
            'patterns' => '',
            'ext' => $fileext
        );
        $id = $this->db->addData('insert', $this->filestable, '', '', $varValues);
        return $id;
    }

    private function updateFile($id, $field, $value)
    {
        $query = " UPDATE `" . $this->filestable . "` SET `{$field}` = " . $this->db->quoteValue($value)
            . " WHERE id = " . (int)$id;
        $this->db->setQuery($query);
        $result = $this->db->query();
        return $result;
    }

    protected function logMalware($file_id, $pattern_id)
    {
        $detectedMal = $this->getDectectedMal($file_id, $pattern_id);
        if (empty($detectedMal)) {
            $db = oseFirewall::getDBO();
            $varValues = array(
                'file_id' => (int)$file_id,
                'pattern_id' => (int)$pattern_id
            );
            $id = $db->addData('insert', $this->malwaretable, '', '', $varValues);
            return $id;
        } else {
            return /*$varObject->id*/
                ;
        }
    }

    protected function getDectectedMal($file_id, $pattern_id)
    {
        $db = oseFirewall::getDBO();
        $query = "SELECT COUNT(`file_id`) as `count` FROM `" . $this->malwaretable . "`" .
            " WHERE `file_id` = " . (int)$file_id;
        " AND `pattern_id` = " . (int)$pattern_id;
        $db->setQuery($query);
        $result = (object)($db->loadResult());
        $db->closeDBO();
        return $result->count;
    }

    private function clearTable()
    {
        $query = "TRUNCATE TABLE " . $this->db->quoteTable($this->filestable);
        $this->db->setQuery($query);
        $result = $this->db->query();
        return $result;
    }

    private function cleanMalwareData()
    {
        $query = "TRUNCATE TABLE `" . $this->malwaretable . "`;";
        $this->db->setQuery($query);
        $result = $this->db->query();
        return $result;
    }

    public function resetSamples()
    {
        $result = $this->db->deleteRecordString(array('type' => 'I'), '#__osefirewall_files');
        $this->db->closeDBO();
    }

    public function getSamples()
    {
        $db = oseFirewall::getDBO();
        $query = "SELECT `filename` FROM `" . $this->filestable . "`" .
            " WHERE `type` = 'I'";
        $db->setQuery($query);
        $result = $db->loadArrayList();
        if (!empty($result)) {
            foreach ($result as $single) {
                $reassemble[] = $single['filename'];
            }
            $return = implode(';', $reassemble);
        } else {
            $return = '';
        }
        $db->closeDBO();
        echo $return;
    }

    public function contentScan()
    {
        //   '/Applications/MAMP/htdocs/hacktest'
        $files = $this->getAllFiles('/home/mkbadmin/public_html/');
        foreach ($files as $single) {
            $back = $this->contentSingleScan($single);
            if (!empty($back)) {
                $return[] = $back;
            }
        }
        $return = implode('<br>', $return);
        return $return;
    }

    private function contentSingleScan($scan_file)
    {
       return;
    }

    private function saveNameFeatures($files)
    {
        $filePath = OSE_FWDATA . ODS . "vsscanPath" . ODS . "nameFeatures.json";
        $fileContent = implode("\n", $files);
        if (file_exists($filePath)) {
            $content = oseFile::read($filePath);
            if (!empty($content)) {
                $fileContent = $content . "\n" . $fileContent;
            } else {
                $fileContent = "0\n" . $fileContent;
            }
            $result = oseFile::write($filePath, $fileContent);
        } else {
            $fileContent = "0\n" . $fileContent;
            $result = oseFile::write($filePath, $fileContent, false, true);
        }
    }

    private function setNameFeatures()
    {
        oseFirewall::loadJSON();
        $filePath = OSE_FWDATA . ODS . "vsscanPath" . ODS . "nameFeatures.json";
        $fileContent = oseFile::read($filePath);
        $array = explode("\n", $fileContent);
        $this->name = $array;
    }

    private function saveSizeFeatures($files)
    {
        $filePath = OSE_FWDATA . ODS . "vsscanPath" . ODS . "sizeFeatures.json";
        $fileContent = implode("\n", $files);
        if (file_exists($filePath)) {
            $content = oseFile::read($filePath);
            if (!empty($content)) {
                $fileContent = $content . "\n" . $fileContent;
            } else {
                $fileContent = "0\n" . $fileContent;
            }
            $result = oseFile::write($filePath, $fileContent);
        } else {
            $fileContent = "0\n" . $fileContent;
            $result = oseFile::write($filePath, $fileContent, false, true);
        }
    }

    private function setSizeFeatures()
    {
        oseFirewall::loadJSON();
        $filePath = OSE_FWDATA . ODS . "vsscanPath" . ODS . "sizeFeatures.json";
        $fileContent = oseFile::read($filePath);
        $array = explode("\n", $fileContent);
        $this->size = $array;
    }

    private function saveDateFeatures($files)
    {
        $filePath = OSE_FWDATA . ODS . "vsscanPath" . ODS . "dateFeatures.json";
        $fileContent = implode("\n", $files);
        if (file_exists($filePath)) {
            $content = oseFile::read($filePath);
            if (!empty($content)) {
                $fileContent = $content . "\n" . $fileContent;
            } else {
                $fileContent = "0\n" . $fileContent;
            }
            $result = oseFile::write($filePath, $fileContent);
        } else {
            $fileContent = "0\n" . $fileContent;
            $result = oseFile::write($filePath, $fileContent, false, true);
        }
    }

    private function setDateFeatures()
    {
        oseFirewall::loadJSON();
        $filePath = OSE_FWDATA . ODS . "vsscanPath" . ODS . "dateFeatures.json";
        $fileContent = oseFile::read($filePath);
        $array = explode("\n", $fileContent);
        $this->date = $array;
    }

    private function savePatternFeatures($files)
    {
        $filePath = OSE_FWDATA . ODS . "vsscanPath" . ODS . "patternFeatures.json";
        $fileContent = oseJSON::encode($files);
        $result = oseFile::write($filePath, $fileContent);
    }

    private function setPatternFeatures()
    {
        oseFirewall::loadJSON();
        $filePath = OSE_FWDATA . ODS . "vsscanPath" . ODS . "patternFeatures.json";
        $fileContent = oseFile::read($filePath);
        $result = oseJSON::decode($fileContent, true);
        $this->ulti = $result;
    }

    private function saveFiles($files)
    {
        $filePath = OSE_FWDATA . ODS . "vsscanPath" . ODS . "fileList.json";
        $fileContent = implode("\n", $files);
        $result = oseFile::write($filePath, $fileContent);
    }

    private function setFiles()
    {
        oseFirewall::loadJSON();
        $filePath = OSE_FWDATA . ODS . "vsscanPath" . ODS . "fileList.json";
        $fileContent = oseFile::read($filePath);
        $array = explode("\n", $fileContent);
        return $array;
    }

    private function deleteFeatures()
    {
        $filePath = OSE_FWDATA . ODS . "vsscanPath" . ODS . "fileList.json";
        $patternPath = OSE_FWDATA . ODS . "vsscanPath" . ODS . "patternFeatures.json";
        $datePath = OSE_FWDATA . ODS . "vsscanPath" . ODS . "dateFeatures.json";
        $sizePath = OSE_FWDATA . ODS . "vsscanPath" . ODS . "sizeFeatures.json";
        $namePath = OSE_FWDATA . ODS . "vsscanPath" . ODS . "nameFeatures.json";
        oseFile::delete($filePath);
        oseFile::delete($patternPath);
        oseFile::delete($datePath);
        oseFile::delete($sizePath);
        oseFile::delete($namePath);
    }

    private function setScanProgress($progress, $desc, $cont)
    {
        $this->aiscanProgress = array(
            'status' => array("progress" => $progress,
                "current_scan" => $desc,
                "cont" => $cont,
            ), //overide step to 3 if complete
        );
    }
}

?>

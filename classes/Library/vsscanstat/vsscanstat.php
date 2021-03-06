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
class oseVsscanStat {
    private $filestable = '#__osefirewall_files';
    private $logstable = '#__osefirewall_logs';
    private $malwaretable = '#__osefirewall_malware';
    private $scanhisttablebl = '#__osefirewall_scanhist';
    protected $db = null;
    protected $where = array ();
    protected $orderBy = ' ';
    protected $limitStm = ' ';
    public function __construct()
    {
        $this->setDBO ();
        oseFirewall::loadRequest();
        oseFirewall::loadFiles();
        oseFirewall::callLibClass('convertviews', 'convertviews');
    }
    protected function setDBO () {
        $this->db = oseFirewall::getDBO();
    }
    public function getTypeList() {
        $query = "SELECT * FROM `#__osefirewall_vstypes`";
        $this->db->setQuery($query);
        $result = $this->db->loadObjectList();
        $this->db->closeDBO ();
        return $result;
    }
    public function getMalwareMap () {
        $columns = oRequest::getVar('columns', null);
        $limit = oRequest::getInt('length', 15);
        if ($limit == -1) {
            $limit = 5;
        }
        $start = oRequest::getInt('start', 0);
        //$type_id = oRequest::getInt('type_id', 0);
        $search = oRequest::getVar('search', null);
        $orderArr = oRequest::getVar('order', null);
        $sortby = null;
        $orderDir = 'asc';
        if (!empty($columns[3]['search']['value']))
        {
            $status = $columns[3]['search']['value'];
        }
        else
        {
            $status = null;
        }
        if (!empty($orderArr[0]['column']))
        {
            $sortby = $columns[$orderArr[0]['column']]['data'];
            $orderDir = $orderArr[0]['dir'];
        }
        $return = $this->getMalwareMapDB($search['value'], $status, $start, $limit, $sortby, $orderDir);
        $return['data'] = $this->convertMalwareMap($return['data']);
        return $return;
    }
    private function convertMalwareMap ($results) {
        $status = oseFirewall::checkSubscriptionStatus(false);
        $type = oRequest::getVar('type', null);
        $return = array();
        $i=0;
        foreach ($results as $result)
        {
            $return[$i] = $result;
            if ($result->content == 1) {
                $return[$i]->notes = "Core File, do not quarantined!";
            } else {
                $return[$i]->notes = "";
            }
            $return[$i] ->checkbox = '';
            if($status == true){
                $return[$i]->view = "<a href='#' title = 'View detail' onClick= 'viewFiledetail(" . $result->file_id . ", " . $result->checked . ")' ><i class='im-dashboard'></i></a>";
            }else{
                $return[$i]->view = "<a href='#' title = 'View detail' onClick= 'callSubPop(); return false;'  ><i class='im-dashboard'></i></a>";
            }

            if ($type == 'home') {
                $draft = substr($result->filename, -20, 20);
                $final = "..." . $draft;
                $return[$i]->filename = $final;
            }
            if ($status == 0 ) {
                $tmp = explode(ODS, $return[$i]->filename);
                $return[$i]->filename = 'Subscribe to Premium to review the full path: ***'.array_pop($tmp);
            }
            if ($result->checked == 0) {
                $return[$i]->checked = "No action";
            } elseif ($result->checked == 1) {
                $return[$i]->checked = "Cleaned";
            } elseif ($result->checked == 2) {
                $return[$i]->checked = "Quarantined";
            } elseif ($result->checked == -1) {
                $return[$i]->checked = "Marked As Clean";
            }
            $i++;
        }
        return $return;
    }
    protected function getWhereName ($search) {
        $this->where[] = "`f`.`filename` LIKE ".$this->db->quoteValue($search.'%', true) ;
    }
    protected function getWhereStatus ($status) {
        $this->where[] = "`f`.`checked` = " . (int)$status;
    }
    protected function getOrderBy ($sortby, $orderDir) {
        if (empty($sortby))
        {
            $this->orderBy= " ORDER BY `f`.`filename` DESC ";
        }
        else
        {
            $this->orderBy= " ORDER BY ".addslashes($sortby).' '.addslashes($orderDir);
        }
    }
    protected function getLimitStm ($start, $limit) {
        if (!empty($limit))
        {
            $this->limitStm = " LIMIT ".(int)$start.", ".(int)$limit;
        }
    }
    private function getAllRecords ($where) {
        $attrList = array("*");
        $sql = convertViews::convertDetMalware($attrList);
        $query = $sql.$where.$this->orderBy." ".$this->limitStm;
        $this->db->setQuery($query);
        $results = $this->db->loadObjectList();
        return $results;
    }
    private function getAllCounts($where) {
        $return = array();
        // Get total count
        $attrList = array("COUNT(`f`.`id`) AS count");
        $sql = convertViews::convertDetMalware($attrList);
        $this->db->setQuery($sql);
        $result = $this->db->loadObject();
        $return['recordsTotal'] = $result->count;
        // Get filter count
        $this->db->setQuery($sql.$where);
        $result = $this->db->loadObject();
        $return['recordsFiltered'] = $result->count;
        return $return;
    }

    public function getMalwareMapDB($search, $status, $start, $limit, $sortby, $orderDir)
    {
        $return = array ();
        if (!empty($search)) {$this->getWhereName ($search);}
        if (!empty($status)) {
            $this->getWhereStatus($status);
        }
        $this->getOrderBy ($sortby, $orderDir);
        if (!empty($limit)) {$this->getLimitStm ($start, $limit);}
        $where = $this->db->implodeWhere($this->where);
        // Get Records Query;
        $return['data'] = $this->getAllRecords ($where);
        $counts = $this->getAllCounts($where);
        $return['recordsTotal'] = $counts['recordsTotal'];
        $return['recordsFiltered'] = $counts['recordsFiltered'];
        return $return;
    }
    public function getMalwareTotal () {
        oseFirewall::callLibClass('convertviews','convertviews');
        $attrList = array("COUNT(`file_id`) as `count`");
        $sql = convertViews::convertDetMalware($attrList);
        $query = $sql;
        $this->db->setQuery($query);
        $result = (object) ($this->db->loadResult());
        $this->db->closeDBO ();
        return $result->count;
    }
    public function getFileContent($id)
    {
        $filename = $this->getFilePath($id);
        $pattern = $this->getPattern($id);
        $pattern = str_replace(' ', '', $pattern);
        if (!empty($filename))
        {
            $fileContent = oseFile::read($filename);
            $fileContent = preg_replace_callback(
                "/".$pattern."/im",
                function ($matches) {
                    return "<span class='bg-warning'>" . str_replace(array('<span ', '</span>'), array('<div ', '</div>'), $matches[0]) . "</span>";
                },
                $fileContent
            );

            $fileContent = htmlspecialchars($fileContent,ENT_QUOTES,'ISO-8859-1' );

        }
        else
        {
            $fileContent .='Cannot read the file';
        }
        return $fileContent;
    }

    public function batchqt($id)
    {
        if (is_array($id)) {
            $cleanID = $this->pickupID(1, $id);
            $noActionID = $this->pickupID(0, $id);
            foreach ($noActionID as $noActionSingle) {
                $return = $this->vsbackup($noActionSingle->id);
                if ($return == "success") {
                    $flag = $this->qtDelete($noActionSingle->id);
                    $this->changeStatus($noActionSingle->id, 2);
                }
            }
            foreach ($cleanID as $cleanSingle) {
                $flag = $this->qtDelete($cleanSingle->id);
                $this->changeStatus($cleanSingle->id, 2);
            }
        } else {
            $status = $this->getStatus($id);
            if ($status == 1) {
                $flag = $this->qtDelete($id);
                $this->changeStatus($id, 2);
            } else {
                $return = $this->vsbackup($id);
                if ($return == "success") {
                    $flag = $this->qtDelete($id);
                    $this->changeStatus($id, 2);
                }
            }
        }
        return $flag;
    }
    public function batchbkcl($id)
    {
        if (is_array($id)) {
            $newid = $this->pickupID(0, $id);

            foreach ($newid as $single) {
                $return = $this->vsbackup($single->id);
                if ($return == "success") {
                    $this->vsclean($single->id);
                    $this->changeStatus($single->id, 1);
                    $re = "success";
                } else {
                    $re = "fail";
                }
            }
        } else {
            $return = $this->vsbackup($id);
            if ($return == "success") {
                $this->vsclean($id);
                $this->changeStatus($id, 1);
                $re = "success";
            } else {
                $re = "fail";
            }
        }
        return $re;
    }
    public function batchrs($id)
    {
        if (is_array($id)) {
            foreach ($id as $single) {
                $return = $this->vsrestore($single);
                $this->changeStatus($single, 0);
            }
        } else {
            $return = $this->vsrestore($id);
            $this->changeStatus($id, 0);
        }
        return $return;
    }
    public function vsrestore($id)
    {
        $flag = $this->copyback($id);
        if ($flag == 1) {
            return "success";
        } else {
            return "fail";
        }
    }
    private function copyback($id)
    {
        $filename = $this->getFilePath($id);
        $re = "/^(.*\\/)(.*\\..*)$/ims";
        preg_match($re, $filename, $matches);
        $re1 = "/(\\w+)$/";
        $subst = "pbk";
        $result = preg_replace($re1, $subst, $matches[2], 1);
        $result = $id . "_" . $result;
        $dest = OSE_FWDATABACKUP . ODS . $result;
        $flag = copy($dest, $filename);
        if ($flag) {
            $return = unlink($dest);
        }
        return $return;
    }
    private function deletevsDB($id)
    {
        $query = "DELETE FROM `#__osefirewall_files` WHERE `#__osefirewall_files`.`id` = $id";
        $query1 = $this->db->setQuery($query);
        $this->db->query($query1);

        $sql = "DELETE FROM `#__osefirewall_malware` WHERE `#__osefirewall_malware`.`file_id` = $id";
        $sql1 = $this->db->setQuery($sql);
        $this->db->query($sql1);
    }
    private function getFilePath ($id)
    {
        $query = "SELECT `filename` FROM `#__osefirewall_files` WHERE `id` =".(int)$id;
        $this->db->setQuery($query);
        $result = (object) $this->db->loadResult();
        $this->db->closeDBO ();
        return $result ->filename;
    }
    public function getPattern ($file_id)
    {
        $query = "SELECT patterns FROM `#__osefirewall_vspatterns` WHERE `id` = ".
            "(SELECT `pattern_id` FROM `#__osefirewall_malware` WHERE `file_id` = ".(int)$file_id.")";
        $this->db->setQuery($query);
        $result = $this->db->loadObject();
        $this->db->closeDBO ();
        return $result ->patterns;
    }

    public function batchdl($id)
    {
        if (is_array($id)) {
            foreach ($id as $single) {
                $return = $this->vsLocalDelete($single);
            }
        } else {
            $return = $this->vsLocalDelete($id);
        }
        return $return;
    }

    private function vsLocalDelete($id)
    {
        $filename = $this->getFilePath($id);
        $re = "/^(.*\\/)(.*\\..*)$/ims";
        preg_match($re, $filename, $matches);
        $re1 = "/(\\w+)$/";
        $subst = "pbk";
        $result = preg_replace($re1, $subst, $matches[2], 1);
        $result = $id . "_" . $result;
        $dest = OSE_FWDATABACKUP . ODS . $result;
        $return = unlink($dest);
        $this->deletevsDB($id);
        return $return;
    }

    public function qtDelete($id)
    {
        $filename = $this->getFilePath($id);
        $flag = unlink($filename);
        return $flag;
    }
    public function vsdelete($id)
    {
        $filename = $this->getFilePath($id);
        $flag = unlink($filename);
        $this->deletevsDB($id);
        return $flag;
    }
    public function vsbkclean($id)
    {
        $return = $this->vsbackup($id);
        if ($return == "success") {
            $this->changeStatus($id, 1);
            $filecontent = $this->vsclean($id);
            return $filecontent;
        } else {
            return "fail";
        }
    }

    public function vsclean($id)
    {
        $filename = $this->getFilePath($id);
        $pattern = $this->getPattern($id);
        $pattern = str_replace(' ', '', $pattern);
        if (!empty($filename)) {
            $fileContent = oseFile::read($filename);
            $fileContent = preg_replace_callback(
                "/" . $pattern . "/im",
                function ($matches) {
                    return "";
                },
                $fileContent
            );
            chmod($filename, 0666);
            file_put_contents($filename, $fileContent, LOCK_EX);
            chmod($filename, 0644);
            $fileContent = htmlspecialchars($fileContent, ENT_QUOTES, 'ISO-8859-1');
        } else {
            $fileContent .= 'Cannot read the file';
        }
        return $fileContent;

    }

    public function vsbackup($id)
    {
        $scan_file = $this->getFilePath($id);
        $return = $this->copyvsfile($scan_file, $id);
        return $return;
    }

    private function copyvsfile($scan_file, $id)
    {
        $re = "/^(.*\\/)(.*\\..*)$/ims";
        preg_match($re, $scan_file, $matches);
        $re1 = "/(\\w+)$/";
        $subst = "pbk";
        $result = preg_replace($re1, $subst, $matches[2], 1);
        $result = $id . "_" . $result;
        $dest = OSE_FWDATABACKUP . ODS . $result;
        chmod($dest, 0777);
        $flag = copy($scan_file, $dest);
        chmod($dest, 0755);
        if ($flag) {
            $return = "success";
        } else {
            $return = "fail";
        }
        return $return;
    }
    private function getFileType($filepath)
    {
        $s_info = pathinfo( $filepath );
        $s_extension = str_replace('.', '', $s_info['extension'] );
        switch (strtolower($s_extension)) {
            case 'txt':
            case 'ini':
                $cp_lang = 'text'; break;
            case 'cs':
                $cp_lang = 'csharp'; break;
            case 'css':
                $cp_lang = 'css'; break;
            case 'html':
            case 'htm':
            case 'xml':
            case 'xhtml':
                $cp_lang = 'html'; break;
            case 'java':
                $cp_lang = 'java'; break;
            case 'js':
                $cp_lang = 'javascript'; break;
            case 'pl':
                $cp_lang = 'perl'; break;
            case 'ruby':
                $cp_lang = 'ruby'; break;
            case 'sql':
                $cp_lang = 'sql'; break;
            case 'vb':
            case 'vbs':
                $cp_lang = 'vbscript'; break;
            case 'php':
                $cp_lang = 'php'; break;
            default:
                $cp_lang = 'generic';
        }
        return $cp_lang;
    }

    public function pickupID($status, $id)
    {
        $stringID = " AND `id` IN (" . implode(", ", $id) . ")";
        $query = "SELECT `id` FROM `#__osefirewall_files` WHERE `checked` =" . (int)$status . $stringID;
        $this->db->setQuery($query);
        $result = (array)$this->db->loadObjectList();
        $this->db->closeDBO();
        return $result;
    }

    public function getStatus($id)
    {
        $query = "SELECT `checked` FROM `#__osefirewall_files` WHERE `id` =" . (int)$id;
        $this->db->setQuery($query);
        $result = $this->db->loadObjectList();
        $this->db->closeDBO();
        return $result->checked;
    }

    public function changeStatus($id, $changeTo)
    {
        if ($changeTo == 1) {
            $statusArray = array(
                'checked' => $changeTo
            );
            $db = oseFirewall::getDBO();
            $db->addData('update', $this->filestable, 'id', $id, $statusArray);
            $db->closeDBO();
        } elseif ($changeTo == 2) {
            $statusArray = array(
                'checked' => $changeTo
            );
            $db = oseFirewall::getDBO();
            $db->addData('update', $this->filestable, 'id', $id, $statusArray);
            $db->closeDBO();
        } elseif ($changeTo == 0) {
            $statusArray = array(
                'checked' => $changeTo
            );
            $db = oseFirewall::getDBO();
            $db->addData('update', $this->filestable, 'id', $id, $statusArray);
            $db->closeDBO();
        }
    }

    public function markAsClean ($ids)
    {
        $this->db = oseFirewall::getDBO();
        if (is_array($ids)) {
            foreach ($ids as $single) {
                $return = $this->markAsCleanSgl($single);
            }
        } else {
            $return = $this->markAsCleanSgl($ids);
        }
        $this->exportMarkAsCleanFile();
        $this->db->closeDBO();
        return $return;
    }

    public function markAsCleanSgl ($id)
    {
        $statusArray = array(
            'checked' => -1,
            'content' => md5_file($this->getFilePath($id))
        );
        $this->db->addData('update', $this->filestable, 'id', $id, $statusArray);
        return true;
    }

    public function exportMarkAsCleanFile()
    {
        $query = "SELECT `filename`, `content` FROM `#__osefirewall_files` WHERE `checked` = -1";
        $this->db->setQuery($query);
        $result = $this->db->loadArrayList();
        $filePath = CENTRORABACKUP_FOLDER . ODS . "markasclean.php";
        file_put_contents($filePath, '<?php $whitelist = ' . var_export($result, true) . ';');
    }

    public function downloadcsv($filename)
    {
        $fileContent = $this->getOutputData();
        if (ob_get_contents()) {ob_clean();}
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Length: " . strlen($fileContent));
        // Output to browser with appropriate mime type, you choose ;)
        header("Content-Type: application/csv; charset=UTF-8");
        header("Content-Disposition: attachment; filename=$filename");
        print_r($fileContent);
        exit;
    }

    private function getOutputData()
    {
        $output = implode(",", $this->headerArray()) . "\n";
        $results = $this->getMalwareMapDB('', '', 0, 0, 'checked', 'asc');
        $results['data'] = $this->convertMalwareMap($results['data'] );
        foreach ($results['data'] as $data) {
            $output .= $this->getTmpOutput($data) . "\n";
        }
        return $output;
    }

    private function headerArray()
    {
        return array('file_id', 'file_name', 'pattern_id', 'action');
    }

    private function getTmpOutput($data)
    {
        $tmp = array();
        $tmp[] = $data->file_id;
        $tmp[] = $data->filename;
        $tmp[] = $data->pattern_id;
        $tmp[] = $data->checked;
        $return = implode(",", $tmp);
        return $return;
    }

    public function getScanHist()
    {
        $query = "SELECT `content`, `inserted_on` FROM " . $this->db->quoteTable($this->scanhisttablebl)
            . " WHERE inserted_on = (SELECT max(inserted_on) FROM " . $this->db->quoteTable($this->scanhisttablebl)
            . " WHERE super_type = 'vsscan' AND sub_type = 1)";
        $this->db->setQuery($query);
        $result = $this->db->loadObject();
        $this->db->closeDBO();
        if (empty($result->content)) {
            $lastScan = array('inserted_on' => 'N/A'
            , 'totalscan' => 'N/A'
            , 'totalvs' => 'N/A'
            );
        } else {
            $scanList = oseJSON::decode($result->content, true);
            $lastScan = array('inserted_on' => $result->inserted_on
            , 'totalscan' => $scanList[0]['totalscan']
            , 'totalvs' => $scanList[0]['totalvs']
            );
        }
        return $lastScan;
    }

    public function getVirusStats()
    {
        $query = "SELECT SUM(total) total, SUM(clean) clean, SUM(quarantined) quarantined FROM (SELECT CASE WHEN `checked` = 0 THEN 1 ELSE 0 END total, CASE WHEN `checked` = 1 THEN 1 ELSE 0 END clean, CASE WHEN `checked` = 2 THEN 1 ELSE 0 END quarantined FROM `#__osefirewall_files` WHERE `type` = 'f') AS t";
        $this->db->setQuery($query);

        $result = $this->db->loadObject();
        if (is_null($result->total)) {
            $result->total = 0;
        }
        if (is_null($result->clean)) {
            $result->clean = 0;
        }
        if (is_null($result->quarantined)) {
            $result->quarantined = 0;
        }
        $this->db->closeDBO();
        return $result;
    }
}	
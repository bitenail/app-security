<?php
namespace App\Controller;
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
class SurfscanController extends \App\Base
{
    public function action_runSurfScan()
    {
        $this->model->loadRequest();
        $path = $this->model->getVar('scanPath', null);
        $step = $this->model->getInt('step', null);

        if (empty($path)) {
            $results = $this->model->runSurfScan($step);
        } else {
            $path = $this->model->fileClean ($path);
            $results = $this->model->runSurfScan ( $step, $path );
        }
        $this->model->returnJSON($results);
    }

    public  function action_getLastScanRecord()
    {
        $results = $this->model->getLastScan ( );
        $this->model->returnJSON($results);
    }

    public  function action_updateMD5DB()
    {
        $booleanresult = $this->model->updateMD5DB ( );
        if ($booleanresult) {
            $this->model->aJaxReturn(true, 'SUCCESS', $this->model->getLang("SURF_SCAN_SIG_UPDATED"));
        } else {
            $this->model->aJaxReturn(false, 'FAIL', $this->model->getLang("SURF_SCAN_SIG_UPDATED"));
        }
    }

    public  function action_checkMD5DBUpToDate()
    {
        $booleanresult = $this->model->checkMD5DBUpToDate ( );
        if ($booleanresult['status']) {
            $this->model->aJaxReturn(true, 'SUCCESS', $this->model->getLang("SURF_SCAN_SIG_UPTODATE"), false);
        } else {
            $this->model->aJaxReturn(false, 'Update Signatures', $this->model->getLang("SURF_SCAN_SIG_NOTUPTODATE"), false);
        }
    }

    public function action_getFileTree()
    {
        $results = $this ->model->getFileTree();
        exit;
    }
}
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
 * @Copyright Copyright (C) 2008 - 2012- ... Open Source Excellence
 */
if (!defined('OSE_FRAMEWORK') && !defined('OSEFWDIR') && !defined('_JEXEC')) {
    die('Direct Access Not Allowed');
}

class AuthenticationController extends \App\Base
{
    public function action_oauth()
    {
        $this->model->loadRequest();
        $type = $this->model->getVar('type', null);
        $reload = $this->model->getVar('reload', null);
        $result = $this->model->oauth($type, $reload);
        $this->model->returnJSON($result);
    }

    public function action_googledrive_logout()
    {
        $result = $this->model->googledrive_logout();
        $this->model->returnJSON($result);
    }

    public function action_onedrive_logout()
    {
        $result = $this->model->onedrive_logout();
        $this->model->returnJSON($result);
    }

    public function action_dropbox_init()
    {
        $result = $this->model->dropbox_init();
        $this->model->returnJSON($result);
    }

    public function action_dropbox_logout()
    {
        $result = $this->model->dropbox_logout();
        $this->model->returnJSON($result);
    }

    public function action_BackupAuthenticationCallBack()
    {
        $this->model->loadRequest();
        $code = $this->model->getVar('code', null);
        $googleCode = $this->model->getVar('googlecode', null);
        //one drive
        if (!empty($code)) {
            $this->model->oauthOneDrive($code);
            echo '<p style="font-size:20px"><strong>Success!</strong> Authentication Successful! This page will automatically close in 3 seconds.</p>';
            echo '<script type="text/javascript">setTimeout("window.close();", 3000);</script>';
            exit;
        } elseif (!empty($googleCode)) {
            $this->model->oauthGoogleDrive($googleCode);
            echo '<p style="font-size:20px"><strong>Success!</strong> Authentication Successful! This page will automatically close in 3 seconds.</p>';
            echo '<script type="text/javascript">setTimeout("window.close();", 3000);</script>';
            exit;
        } else {
            echo '<p style="font-size:20px"><strong>Success!</strong> No access code, authentication failed! This page will automatically close in 3 seconds.</p>';
            echo '<script type="text/javascript">setTimeout("window.close();", 3000);</script>';
            exit;
        }

    }
}

?>
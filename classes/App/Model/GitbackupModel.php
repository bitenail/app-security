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
if (! defined ( 'OSE_FRAMEWORK' ) && ! defined ( 'OSEFWDIR' ) && ! defined ( '_JEXEC' )) {
    die ( 'Direct Access Not Allowed' );
}
require_once ('BaseModel.php');
class GitBackupModel extends BaseModel {

    public function __construct() {
        $this->loadLibrary ();
    }
    protected function loadLibrary () {
        oseFirewall::callLibClass('gitBackup', 'GitSetup');
        oseFirewall::callLibClass('panel','panel');
        $this->qatest = oRequest :: getInt('qatest', false);
        $this->gitbackup = new GitSetup($this->qatest);
    }
    public function loadLocalScript() {
        $this->loadAllAssets ();
        oseFirewall::loadCSSFile('CentroraFeatureCSS', 'featuretable.css', false);
        oseFirewall::loadJSFile ('CentroraDashboard', 'gitbackup.js', false);
    }
    public function getCHeader() {
        return oLang :: _get('Git_backup_tittle');
    }
    public function getCDescription() {
        return oLang :: _get('Git_backup_desc');
    }
    public function enableGitBackup()
    {
        $result = $this->gitbackup->init();
        return $result;
    }
    public function createBackupAllFiles()
    {
        oseFirewall::callLibClass('gitBackup', 'GitSetupL');
        $gitsetupl = new GitSetupL();
        $result = $gitsetupl->createBackupAllFiles();
        return $result;
    }

    public function getGitStatus()
    {
        $result = $this->gitbackup->getStatus();
        return $result;
    }
    public function gitRollback($commitHead, $recall)
    {

        $result = $this->gitbackup->gitRollback($commitHead, $recall);
        return $result;
    }

    public function getGitLog()
    {
        $result = $this->gitbackup->getGitLogFromDb();
        return $result;
    }

    public function stageAllChange()
    {
        $result = $this->gitbackup->stageAllChange();
        return $result;
    }

    public function backupDB()
    {
        $result = $this->gitbackup->backupDB();
        return $result;
    }

    public function contBackupDB() {
        $result =  $this->gitbackup-> writeSQL ();
        return $result;
    }


    public function gitCloudCheck()
    {
        $result = $this->gitbackup->gitCloudCheck();
        return $result;
    }
    public function saveRemoteGit($username, $password)
    {
        $result0 = $this->gitbackup->saveRemoteGit($username, $password);
        if($result0['status'] == 1) {
            $result1 = $this->gitbackup->sshSetup($username, $password);
            $result['repo-status'] = $result0['status'];
            $result['repo-info'] = $result0['message'];
            $result['ssh-status'] = $result1['status'];
            $result['ssh-info'] = $result1['info'];
            return $result;
        }
        else {
            $result['repo-status'] = $result0['status'];
            $result['repo-info'] = $result0['message'];
            $result['ssh-status'] = 0;   ///failure of ssh keys aas they are not generated
            $result['ssh-info'] = "The ssh keys has not been generated, please create the repository first";
            return $result;
        }
    }

    public function gitCloudPush()
    {
        $result = $this->gitbackup->bitbucketBackup();
        return $result;
    }
    public function isinit() {
        $is_init = $this->gitbackup->isinit();
        return $is_init;
    }
    public function getActivationPanel () {
        oseFirewall::callLibClass('gitBackup', 'gitActivationPanel');
        $activationpanel = new gitActivationPanel();
        return $activationpanel;
    }
    public function checkSysteminfo () {
        $activationpanel = $this->getActivationPanel ();
        $flag = $activationpanel->checkSysteminfo();
        return $flag;
    }
    public function checkProcOpen () {
        $activationpanel = $this->getActivationPanel ();
        $flag = $activationpanel->checkProcOpen();
        return $flag;
    }
    public function websiteZipBackup()
    {
        $result = $this->gitbackup->downloadZipBackup();
        return $result;
    }
    public function deleteZipBakcupFile()
    {
        $result = $this->gitbackup->deleteZipBakcupFile();
        return $result;
    }
    public function findChanges()
    {
        $result = $this->gitbackup->findChanges();
        return $result;
    }

    public function discardChanges()
    {
        $result = $this->gitbackup->discardChanges();
        return $result;
    }
    public function downloadzip()
    {
        $this->gitbackup->downloadzip();
//        return $result;
    }
    public function getZipUrl()
    {
        $result = $this->gitbackup->getZipUrl();
        return $result;
    }

    public function viewChangeHistory($commitid)
    {
        $result = $this->gitbackup->viewChangeHistory($commitid);
        return $result;
    }

    public function userSubscription()
    {
        $result = oseFirewallBase::checkSubscriptionStatus();
        return $result;
    }
    public function setCommitMessage($commitmessage)
    {
        $key = "commitMessage";
        $result = $this->gitbackup->setSessionValue($key,$commitmessage);
        return $result;
    }
    public function getLastBackupTime()
    {
        $result['commitTime'] = $this->gitbackup->getLastBackupTime();
        return $result;
    }

    public function chooseRandomCommitId()
    {
        $result = $this->gitbackup->chooseRandomCommitId();
        return $result;
    }

//    public function localbackup() {
//        $result =  $this->gitbackup-> writeSQL ();
//        return $result;
//    }

    public function localBackup($type)
    {
        oseFirewallBase::callLibClass('gitBackup','GitSetupL');
        $gitsetupl = new GitSetupL();
        $result = $gitsetupl->localBackup($type);
        return $result;
    }

    public function contLocalBackup($type)
    {
        oseFirewallBase::callLibClass('gitBackup','GitSetupL');
        $gitsetupl = new GitSetupL();
        $result = $gitsetupl->contLocalBackup($type);
        return $result;
    }

    public function finalGitPush()
    {
        $result = $this->gitbackup->finalGitPush();
        return $result;
    }





}
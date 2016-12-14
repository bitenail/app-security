<?php
oseFirewall::checkDBReady();
$status = oseFirewall::checkSubscriptionStatus(false);
if ($status == true) {
?>
<div id="oseappcontainer">
    <div class="container">
        <?php
        $this->model->showLogo();
        $this->model->showHeader();
        ?>
        <div class="content-inner">
            <div class="row ">
                <div class="col-lg-12 sortable-layout">
                    <!-- col-lg-12 start here -->
                    <div class="panel panel-primary plain ">
                        <!-- Start .panel -->
                        <div class="panel-heading white-bg">
                        </div>
                        <div class="panel-controls">

                        </div>
                        <div class="panel-controls-buttons">


                        <button class="btn btn-sm mr5 mb10" type="button"
                                    onClick="backup(2,1)"><i class="text-primary glyphicon glyphicon-hdd"></i> <?php oLang::_('O_BACKUP_BACKUPDB'); ?></button>
                            <button class="btn btn-sm mr5 mb10" type="button"
                                    onClick="backup(1,1)"><i class="text-primary glyphicon glyphicon-duplicate"></i> <?php oLang::_('O_BACKUP_BACKUPFILE'); ?></button>
                            <button class="btn btn-danger btn-sm mr5 mb10" type="button"
                                    onClick="deletebackup()"><i class="glyphicon glyphicon-erase"></i> <?php oLang::_('O_BACKUP_DELETEBACKUPFILE'); ?></button>
                            <button class="btn btn-danger btn-sm mr5 mb10" type="button"
                                    onClick="restore('/Applications/MAMP/htdocs/wpdev2013/wp-content/CentroraBackup/filesbackup-20150628_234119/filesbackup-20150628_234119.zip','/Applications/MAMP/htdocs/wpdev2013/wp-content/CentroraBackup/dbbackup-20150628_234009.sql.gz')">
                                <i class="glyphicon glyphicon-erase"></i> <?php oLang::_('O_RESTORE_TEST'); ?></button>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><?php oLang::_('CLOUD_BACKUP_TYPE'); ?></h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-8">
                                            <form id='backup-form' class="form-horizontal group-border stripped"
                                                  role="form">
                                                <select class="form-control" id="cloudbackuptype" name="cloudbackuptype"
                                                        size="0.3">
                                                    <?php
                                                    if ($this->model->checkCloudAuthentication(1)) {
                                                        echo '<option value="1" selected>' . $this->model->getLang('NONE') . '</option>';
                                                    }
                                                    if ($this->model->checkCloudAuthentication(2)) {
                                                        echo '<option value="2">' . $this->model->getLang('O_BACKUP_DROPBOX') . '</option>';
                                                    }
                                                    if ($this->model->checkCloudAuthentication(3)) {
                                                        echo '<option value="3">' . $this->model->getLang('O_BACKUP_ONEDRIVE') . '</option>';
                                                    }
                                                    if ($this->model->checkCloudAuthentication(4)) {
                                                        echo '<option value="4">' . $this->model->getLang('O_BACKUP_GOOGLEDRIVE') . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                                <input type="hidden" name="option" value="com_ose_firewall">
                                                <input type="hidden" name="controller" value="advancedbackup">
                                                <input type="hidden" name="action" value="easybackup">
                                                <input type="hidden" name="task" value="easybackup">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-8">
                                            <button class="btn btn-sm mr5 mb10" type="submit"><i
                                                    class="text-primary glyphicon glyphicon-hdd"></i> <?php oLang::_('O_BACKUP'); ?>
                                            </button>
                                            </form>
                                        </div>
                                        <label id="cloudbackupicon"></label>
                                    </div>
                                </div>
                            </div>
                            <table class="table display" id="advancedbackupTable">
                                <thead>
                                <tr>
                                    <th><?php oLang::_('O_BACKUPFILE_ID'); ?></th>
                                    <th><?php oLang::_('O_BACKUPFILE_DATE'); ?></th>
                                    <th><?php oLang::_('O_BACKUPFILE_NAME'); ?></th>
                                    <th><?php oLang::_('O_BACKUPFILE_TYPE'); ?></th>
                                    <th><?php oLang::_('CLOUD_BACKUP_TYPE'); ?></th>
                                    <th><input id='checkbox' type='checkbox'></th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th><?php oLang::_('O_BACKUPFILE_ID'); ?></th>
                                    <th><?php oLang::_('O_BACKUPFILE_DATE'); ?></th>
                                    <th><?php oLang::_('O_BACKUPFILE_NAME'); ?></th>
                                    <th><?php oLang::_('O_BACKUPFILE_TYPE'); ?></th>
                                    <th><?php oLang::_('CLOUD_BACKUP_TYPE'); ?></th>
                                    <th></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <input id="dropboxauth" style="display: none" value="<?php echo ($this->model->checkCloudAuthentication (2))? 1 : 0;?>">
                    <input id="onedriveauth" style="display: none" value="<?php echo ($this->model->checkCloudAuthentication (3))? 1 : 0;?>">
                    <input id="googledriveauth" style="display: none" value="<?php echo ($this->model->checkCloudAuthentication(4)) ? 1 : 0; ?>">
                    <!-- End .panel -->
                </div>
            </div>
        </div>
    </div>
</div>
<?php
} else {
    ?>
    <div id="oseappcontainer">
        <div class="container">
            <?php
            $this->model->showLogo();
            $this->model->showHeader();
            ?>
            <div class="row">
                <?php
                $image = OSE_FWURL . '/public/images/premium/cloudbackup.png';
                include_once dirname(__FILE__) . '/calltoaction.php';
                ?>
            </div>
        </div>
    </div>
    <?php
    $this->model->showFooterJs();
}
?>
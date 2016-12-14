<?php
oseFirewall::checkDBReady();
$this->model->getNounce();
if (!class_exists('SConfig')) {
?>
<div id="oseappcontainer">
    <div class="container">
        <?php
        $this->model->showLogo();
        $this->model->showHeader();
        //$this->model->backuptest();

        ?>
        <div class="content-inner">
            <div class="row ">
                <div class="col-lg-12 sortable-layout">
                    <!-- col-lg-12 start here -->
                    <div class="panel panel-primary plain">
                        <!-- Start .panel -->
                        <div class="panel-heading white-bg"></div>
                        <div class="panel-body">
                            <ul class="nav nav-tabs">
                                <li role="presentation" class="vl-tabs active">
                                    <a data-toggle="tab" onclick="reloadBackupList()" href="#sectionBKs"><?php oLang::_('O_BK_TAB_BACKUPS') ?>
                                    </a>
                                </li>
                                <li role="presentation" class="vl-tabs ">
                                    <a data-toggle="tab" href="#sectionNew"><?php oLang::_('O_BK_TAB_NEW_BACKUP') ?>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <!-- backups section -->
                                <div id="sectionBKs" class="tab-pane fade in active">
                                    <div class="panel-body">
                                        <div class="panel">
                                            <div class="panel-header">
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div id="recent_backup_section">
                                                            <strong style="font-size: 20px;">Recent Backup</strong>

                                                            <div id="recent_backup_content">
<!--                                                                <div class="backup-short-desc"><i-->
<!--                                                                        class="fa fa-minus-circle"></i>&nbsp<strong>test-12122015.zip</strong>-->
<!--                                                                </div>-->

                                                            </div>
                                                        </div>
                                                        <div class="dot-line backup-list-dotline"></div>
                                                        <div id="rencent_backup_schedule_section">
                                                            <strong style="font-size: 20px;">Scheduled Backups</strong>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div id = "div_scheduled_bk_content"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="dot-line backup-list-dotline"></div>
                                                        <div id="rencent_backup_schedule_section">

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-md-2">
                                                                            <strong style="font-size: 20px;">Backup
                                                                                List</strong>
                                                                        </div>
                                                                        <div class="col-md-offset-4 col-md-6">
<!--                                                                            <span>From:&nbsp<input/>&nbspTo&nbsp<input></span>-->
<!--                                                                            <a href="javascript:void(0)" class = "btn btn-success"><i class="fa fa-search"></i></a>-->
                                                                            <button class="pull-right btn btn-danger btn-sm mr5 mb10" type="button"
                                                                                    onClick="deletebackup()"><i class="glyphicon glyphicon-erase"></i> <?php oLang::_('O_BACKUP_DELETEBACKUPFILE'); ?></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <table class="table display" id="advancedbackupTable">
                                                                        <thead>
                                                                        <tr>
                                                                            <th><?php oLang::_('O_BACKUPFILE_ID'); ?></th>
                                                                            <th><?php oLang::_('O_BACKUPFILE_DATE'); ?></th>
                                                                            <th><?php oLang::_('O_BACKUPFILE_NAME'); ?></th>
                                                                            <th><?php oLang::_('O_BACKUPFILE_TYPE'); ?></th>
                                                                            <th><?php oLang::_('CLOUD_BACKUP_TYPE'); ?></th>
                                                                            <th><?php oLang::_('O_DOWNLOAD'); ?></th>
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
                                                                            <th><?php oLang::_('O_BACKUP_ACTION'); ?></th>
                                                                            <th></th>
                                                                        </tr>
                                                                        </tfoot>
                                                                    </table>
                                                                    <input id="dropboxauth" style="display: none" value="<?php echo ($this->model->checkCloudAuthentication (2))? 1 : 0;?>">
                                                                    <input id="onedriveauth" style="display: none" value="<?php echo ($this->model->checkCloudAuthentication (3))? 1 : 0;?>">
                                                                    <input id="googledriveauth" style="display: none" value="<?php echo ($this->model->checkCloudAuthentication(4)) ? 1 : 0; ?>">
                                                                    <input id="needsubscription" style="display: none" value="<?php echo (oseFirewall::checkSubscriptionStatus(false)) ? 1 : 0; ?>">
                                                                    <input id="subscriptionlink" style="display: none" value="<?php oLang::_('OSE_OEM_URL_SUBSCRIBE');?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- new backup section -->
                                <div id="sectionNew" class="tab-pane fade ">
                                    <div class="panel-body">
                                        <div class="panel">
                                            <div class="panel-header">
                                            </div>
                                            <div class="panel-body">
                                                <ul id="breadcrumb">
                                                    <?php $icon_one = OSE_FWURL . '/public/images/num/1-white.png'; ?>
                                                    <?php $icon_two = OSE_FWURL . '/public/images/num/2-white.png'; ?>
                                                    <?php $icon_three = OSE_FWURL . '/public/images/num/3-white.png'; ?>
                                                    <li class="breadcrumb-nav">
                                                        <a href="#" onclick="goback_backupcontent()" panel="#new_backup_setup">
                                                            <span class="icon icon-beaker"> </span>
                                                            <img src="<?php echo $icon_one; ?>"/>&nbspSetup
                                                        </a>
                                                    </li>
                                                    <li class="breadcrumb-nav" style="display: none;">
                                                        <a panel="#new_backup_config">
                                                            <span class="icon icon-double-angle-right"></span>
                                                            <img src="<?php echo $icon_two; ?>"/>&nbspConfiguration
                                                        </a>
                                                    </li>
                                                    <li class="breadcrumb-nav" style="display: none;">
                                                        <a panel="#new_backup_building">
                                                            <span class="icon icon-rocket"> </span>
                                                            <img src="<?php echo $icon_three; ?>"/>&nbspBuild
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div class="dot-line"></div>
                                                <span class="breadcrumb-span">Step 1: Setup Backup</span>
                                                <div class="dot-line"></div>
                                                <div class="col-md-offset-2">
                                                    <div class="new_backup_content" id="new_backup_setup">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <label for="input_prefix_backup">Backup
                                                                        Prefix</label>
                                                                </div>
                                                                <div class="col-md-5"><input
                                                                        id="input_prefix_backup"
                                                                        class="form-control"
                                                                        placeholder="Please Enter Prefix"/>
                                                                </div>
                                                            </div>
                                                        </div>
<!--                                                        <div class="form-group">-->
<!--                                                            <div class="row">-->
<!--                                                                <div class="col-md-3">-->
<!--                                                                    <label for="input_prefix_backup">Backup-->
<!--                                                                        Description</label>-->
<!--                                                                </div>-->
<!--                                                                <div class="col-md-5"><textarea-->
<!--                                                                        id="input_desc_backup"-->
<!--                                                                        class="form-control"-->
<!--                                                                        placeholder="Please Enter Description"></textarea>-->
<!--                                                                </div>-->
<!--                                                            </div>-->
<!--                                                        </div>-->
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <label for="lb_archive">Archive</label>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label>
                                                                        <input type="checkbox" checked
                                                                               disabled="disabled">&nbsp&nbsp<i
                                                                            class="text-primary glyphicon glyphicon-duplicate"></i>&nbspFiles
                                                                    </label>
                                                                    <label>
                                                                        <input type="checkbox" checked
                                                                               disabled="disabled">&nbsp&nbsp<i
                                                                            class="text-primary glyphicon glyphicon-hdd"></i>&nbspDataBase
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-offset-7">
                                                                    <button onclick="setupBackup()"
                                                                            class="btn btn-primary">
                                                                        Next&nbsp<i class="fa fa-angle-right"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="new_backup_content" style="display: none;"
                                                         id="new_backup_config">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <label
                                                                        for="select_platform_backup">Platforms</label>
                                                                </div>
                                                                <div class="col-md-5 select-platform">
                                                                    <select id="select_platform_backup"
                                                                            class="form-control" onchange="backupTypeChange()">
                                                                        <option value="1" selected>Local Only</option>
                                                                        <option value="2">DropBox</option>
                                                                        <option value="3">OneDrive</option>
                                                                        <option value="4">GoogleDrive</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label for="select_platform_backup">Status</label>
                                                                </div>
                                                                <div id="new_backup_status_content">

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-offset-7">
                                                                    <button id = 'btn_build_backup' onclick="setConfig()"
                                                                            class="btn btn-primary" disabled="disabled">
                                                                        Build Backup&nbsp<i
                                                                            class="fa fa-angle-right"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="new_backup_content col-" style="display: none;"
                                                         id="new_backup_building">
                                                        <div class="row">
                                                            <div class="col-md-offset-2 col-md-10">
                                                                <h3 class="text-primary"><i
                                                                        class="fa fa-cog fa-spin fa-1x fa-fw margin-bottom"></i>&nbspBuilding
                                                                    Backup</h3>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <div class="progress" style="height: 40px;">
                                                                    <div
                                                                        class="progress-bar progress-bar-striped active"
                                                                        role="progressbar" aria-valuenow="100"
                                                                        aria-valuemin="0" aria-valuemax="100"
                                                                        style="width:100%;">
                                                                    </div>
                                                                </div>
                                                                <div class="backup-loading-info">Please Wait...</div>
                                                                <div class="backup-loading-info-snippet">This may take a
                                                                    few seconds, please keep this page open until this
                                                                    backup is successfully built
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="new_backup_content" style="display: none;"
                                                         id="new_backup_building_success">
                                                        <div class="row">
                                                            <div class="col-md-offset-2 col-md-10">
                                                                <h3 class="text-success"><i
                                                                        class="fa fa-check-circle"></i>&nbspBackup&nbspSuccessful
                                                                </h3>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-offset-1 col-md-4 " style="font-weight: bold;">Backup
                                                                Name:
                                                            </div>
                                                            <div class="col-md-4"><span id = 'span_easy_backup_filename'
                                                                    class="text-primary"
                                                                    style="font-weight: bold;">test-20151223.zip</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-offset-1 col-md-4" style="font-weight: bold;">Backup
                                                                Time:
                                                            </div>
                                                            <div class="col-md-4"><span id = 'span_easy_backup_time'
                                                                    class="text-default"
                                                                    style="font-weight: bold;">Dec, 23 2015</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-offset-1 col-md-4" style="font-weight: bold;">
                                                                Backup Platforms:
                                                            </div>
                                                            <div class="col-md-4" id="span_easy_backup_type">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-offset-1 col-md-4" style="font-weight: bold;">
                                                                Backup Files:
                                                            </div>
                                                            <div class="col-md-6"><a href="javascript:void(0)"
                                                                                     class="text-warning"
                                                                                     title="Files"><i
                                                                        class="text-primary glyphicon glyphicon-duplicate"></i></a>&nbsp<a
                                                                    href="javascript:void(0)"
                                                                    class="text-warning"
                                                                    title="DataBase"><i
                                                                        class="text-primary glyphicon glyphicon-hdd"></i></a>

                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-offset-1">
                                                                <div class="btn-toolbar" role="toolbar">
                                                                    <div class="btn-group ">
                                                                        <button class="btn btn-primary" onclick="redirectNewBackUp()"><i
                                                                                class="fa fa-angle-left" ></i>&nbspNew
                                                                            Backup
                                                                        </button>
                                                                    </div>
                                                                    <div class="btn-group ">
                                                                        <a id = 'btn_easy_bk_download' class="btn btn-success" ><i
                                                                                class="fa fa-download"></i>&nbspDownload
                                                                            Backup File
                                                                        </a>
                                                                    </div>
                                                                    <div class="btn-group ">
                                                                        <button class="btn btn-primary" onclick="redirectBackupList()">&nbspBackup
                                                                            Lists&nbsp<i class="fa fa-angle-right"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        </div>

                    </div>

                </div>
                <!-- End .panel -->
            </div>
                </div>
        </div>
    </div>
</div>
<?php } else {
    include_once (dirname ( __FILE__ ) . '/suitebackup.php');
}
?>
<?php
/**
 * Created by PhpStorm.
 * User: phil
 * Date: 31/08/15
 * Time: 9:55 AM
 */
oseFirewall::checkDBReady();
$this->model->getNounce();
$msg = $this->model->checkMD5DBUpToDate();
?>
    <div id="oseappcontainer">
        <div class="container">
            <?php $this->model->showLogo(); $this->model->showHeader(); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary plain ">
                        <!-- Start .panel -->
                        <div class="panel-heading">

                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div id="time-bar"><?php echo $msg['msg'] ?></div>
                                <!--Scan Status-->
                                <div id="scan-window" class="col-md-12">
                                    <button id = "updateMD5Sig" title="Update MD5 Signatures" type="button" class="pull-right btn btn-config btn-sm mr5">
                                        <i class="glyphicon glyphicon-refresh color-blue"></i>
                                    </button>
                                    <div id='scan_progress' class="alert alert-info fade in">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <div class="bg-primary alert-icon">
                                                    <i class="glyphicon glyphicon-info-sign s24"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div id = "status_content" class="col-md-12" style="display: none;" >
                                                    <div id='status' class='col-md-12'>
                                                        <strong>Status </strong>
                                                        <div class="progress progress-striped active">
                                                            <div id="vs_progress" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                                                <span id="p4text" ></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id = "last_batch" class='col-md-12'>Last Batch:
                                                        <strong id='last_file' class="text-success"></strong>
                                                    </div>
                                                    <div class='col-md-12'># Scanned:
                                                        <strong id='total_number' class="text-warning"></strong>
                                                    </div>
                                                    <div class='col-md-12'># Virus Files:
                                                        <a href="#scanresult"><strong id='vs_num' class="text-danger"></strong></a>
                                                    </div>
                                                    <div id="surfcalltoaction" class='alert alert-dismissable alert-danger col-md-12' style="display: none;">
    <!--                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                                                        <?php oLang::_('SURF_SCAN_CALL_TOACTION') ?>
                                                    </div>
                                                </div>
                                                <div id = "scanpathtext" class='col-md-12' style="display: none;">Scan Path:
                                                    <label class="text-primary" id="selectedfile"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pull-right">
                                            <i class="fa fa-clock-o"></i>Last Scan:
                                            <strong id="scan-date" class="text-success"></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div id="scanbuttons">
                                    <button id="sfsstop" class='centrora-btn' style="display: none;">
                                        <i id="ic-change" class="glyphicon glyphicon-stop color-red"></i> <?php oLang::_('STOP_VIRUSSCAN') ?>
                                    </button>
                                    <button id="sfsstart" class='centrora-btn'>
                                        <i id="ic-change" class="glyphicon glyphicon-play color-green"></i> <?php oLang::_('START_NEW_SCAN') ?>
                                    </button>
                                    <button data-target="#scanPathModal" data-toggle="modal" id="setscanpath" title ="<?php oLang::_('SETSCANPATH') ?>"
                                            class='pull-right centrora-btn'>
                                        <i id="ic-change" class="glyphicon glyphicon-folder-close text-primary"></i>
                                        Set Scan Path
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-12" id ="scan-result" class="row" style="display: none;">
                                <strong class="alert-danger">Virus Files Detected!</strong>
                                <div id="scan-result-panel"></div>
                            </div>
                        </div>
                    </div>
                    <!--Scan Path Modal-->
                    <div class="modal fade" id="scanPathModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel2"><?php oLang::_('SCANPATH'); ?></h4>
                                </div>
                                <div class="modal-body" style="height:400px">
                                    <label style="vertical-align: top;"><?php oLang::_('FILETREENAVIGATOR'); ?></label>
                                    <div class="panel-body" id="FileTreeDisplay"></div>
                                </div>
                                <div class="modal-footer">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="scanPath" class="col-sm-1 control-label"><?php oLang::_('PATH');?></label>
                                            <div class="col-sm-11">
                                                <input type="text" name="scanPath" id="selected_file" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div>
                                                <button type="button" class="btn btn-sm" id='save-button'><i class="glyphicon glyphicon-save text-success"></i> <?php oLang::_('SET');?></button>
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
<?php
oseFirewall::checkDBReady();
$status = oseFirewall::checkSubscriptionStatus(false);
$confArray = $this->model->getConfiguration('vsscan');
$this->model->getNounce();
if (isset($confArray['data']['vsScanExt']) && !isset($confArray['data']['file_ext'])) {
    $confArray['data']['file_ext'] = $confArray['data']['vsScanExt'];
}
if ($status == true) {
    ?>
    <div id="oseappcontainer">
        <div class="container">
            <?php
            $this->model->showLogo();
            $this->model->showHeader();
            ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary plain ">
                        <!-- Start .panel -->
                        <div class="panel-heading">

                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div id="scan-window" class="col-md-12">
                                    <div id='scan_progress' class="alert alert-info fade in">
                                        <div class="bg-primary alert-icon">
                                            <i class="glyphicon glyphicon-info-sign s24"></i>
                                        </div>
                                        <strong>Status: </strong> <span id="p4text"></span>

                                        <div id='summary' class='col-md-12'>&nbsp;</div>
                                        <div id='modified' class='col-md-12'>&nbsp;</div>
                                        <div id='suspicious' class='col-md-12'>&nbsp;</div>
                                        <div id='missing' class='col-md-12'>&nbsp;</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div id="scanbuttons">
                                    <?php if (class_exists('SConfig')) { ?>
                                        <button data-target="#scanModal" data-toggle="modal" id="customscan"
                                                class='btn btn-sm mr5 mb10'><i
                                                class="glyphicon glyphicon-screenshot text-primary"></i> <?php oLang::_('START_NEW_SCAN') ?>
                                        </button>
                                    <?php } else { ?>
                                        <button id="cfscan" onclick="cfscan()" class='centrora-btn'><i
                                                id="ic-change" class="glyphicon glyphicon-search text-primary"></i> <?php oLang::_('START_NEW_SCAN') ?>
                                        </button>
                                    <?php }
                                    if ($_GET['centrora'] == 1) { ?>
                                        <button id="catchVirusMD5" onclick="catchVirusMD5()"
                                                class='btn btn-sm mr5 mb10'><i
                                                class="glyphicon glyphicon-search text-primary"></i> <?php oLang::_('CATCH_VIRUS_MD5') ?>
                                        </button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div id='fb-root'></div>
    <?php
//\PHPBenchmark\Monitor::instance()->snapshot('Finish loading Centrora');
    ?>
    <?php
} else {
    ?>
    <div id="oseappcontainer">
        <div class="container">
            <?php
            $this->model->showLogo();
            ?>
            <div id="sub-header" class="row"
                 style="background:url('<?php echo 'http://www.googledrive.com/host/0B4Hl9YHknTZ4X2sxNTEzNTBJUlE/sub_hd_bg.png' ?>') top center;  min-height:500px;">
                <div class="col-md-6" id="unsub-left">
                    <?php $this->model->showSubHeader(); ?>
                    <?php echo $this->model->getBriefDescription(); ?>
                </div>
                <div class="col-md-6" id="unsub-right">
                    <a href="https://www.centrora.com/malware-removal" id="leavetous">leave the work to us now</a>
                </div>
            </div>
            <div class="row">
                <div id="unsub-lower">
                    <?php
                    include_once dirname(__FILE__) . '/calltoaction.php';
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    $this->model->showFooterJs();
}
?>

<!-- Form Modal -->
<div class="modal fade" id="scanModal" tabindex="-1" role="dialog" aria-hidden="true">
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
                    <form id='scan-form' class="form-horizontal group-border stripped" role="form">
                        <div class="form-group">
                            <label for="scanPath" class="col-sm-1 control-label"><?php oLang::_('PATH'); ?></label>
                            <div class="col-sm-11">
                                <input type="text" name="scanPath" id="selected_file" class="form-control">
                            </div>
                        </div>
                        <input type="hidden" name="option" value="com_ose_firewall">
                        <input type="hidden" name="controller" value="cfscan">
                        <input type="hidden" name="action" value="suitecfscan">
                        <input type="hidden" name="task" value="suitecfscan">
                        <input id="cms" type="hidden" name="cms" value="">
                        <input id="version" type="hidden" name="version" value="">
                        <div class="form-group">
                            <div id="board"></div>
                            <div>
                                <button type="submit" class="btn btn-sm" id='save-button' disabled><i
                                        class="glyphicon glyphicon-screenshot"></i> <?php oLang::_('SCAN_SPECIFIC_FOLDER'); ?>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
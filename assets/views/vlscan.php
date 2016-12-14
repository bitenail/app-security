<?php
oseFirewall::checkDBReady();
$this->model->getNounce();
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
                    <div class="panel-body">
                        <div class="row config-buttons pull-right">
                            <div class="col-md-12">
                            </div>
                        </div>
                        <div class="row">
                            <?php require_once('template/vls/template-vls-scanstatus.php') ?>
                        </div>

                        <div class="row">
                            <div id="scanbuttons">
                                <button id="vlstop" class='centrora-btn'><i id="ic-change"
                                        class="glyphicon glyphicon-stop color-red"></i> <?php oLang::_('STOP_VIRUSSCAN') ?>
                                </button>
                                <button id="vlscan" class='centrora-btn'><i id="ic-change"
                                        class="glyphicon glyphicon-play color-green"></i> <?php oLang::_('START_NEW_SCAN') ?>
                                </button>
                            </div>
                        </div>
                        <?php require_once('template/vls/template-vls-records.php') ?>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>


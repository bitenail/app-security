<?php
oseFirewall::checkDBReady();
$this->model->getNounce();
$confArray = $this->model->getConfiguration('scan');
$seoConfArray = $this->model->getConfiguration('seo');
?>
<div id="oseappcontainer">
    <div class="container">
        <?php
        $this->model->showLogo();
        //$this->model->showHeader();
        ?>
        <div class="content-inner">
            <div class="row ">
                <div class="col-lg-12 sortable-layout">
                    <!-- col-lg-12 start here -->
                    <div class="panel panel-primary plain ">
                        <!-- Start .panel -->
                        <div class="panel-controls"></div>
                        <div class="panel-heading white-bg"></div>
                        <div class="panel-body">
                            <ul class="nav nav-tabs" data-tabs="tabs">
                                <li class="active"><a data-toggle="tab"
                                                      href="#bsfirewall-rule"><?php oLang::_('BASIC_FIREWALL_RULES'); ?></a>
                                </li>
                                <li><a data-toggle="tab"
                                       href="#adfirewall-rule"><?php oLang::_('ADVANCED_FIREWALL_RULES'); ?></a></li>
                            </ul>
                            <div class="tab-content">
                                <!-- basic firewall rules-->
                                <div class="panel-heading white-bg"></div>
                                <div class="tab-pane active" id="bsfirewall-rule">
                                    <div class="panel-controls-buttons">
                                        <?php oseFirewall::isSigUpdated(); ?>
                                        <button class="btn btn-config btn-sm mr5 mb10" type="button"
                                                onClick="redirectTut('<?php oLang::_('OSE_OEM_URL_ADVFW_TUT'); ?>');"
                                                title="<?php oLang::_('TUTORIAL'); ?>">
                                            <i class="glyphicon glyphicon-list-alt"></i>
                                        </button>
                                        <button data-target="#configModal" data-toggle="modal"
                                                class="btn btn-config btn-sm mr5 mb10" type="button"
                                                onClick="location.href='<?php echo oseFirewall::getConfigurationURL();; ?>'"
                                                title="<?php oLang::_('CONFIGURATION'); ?>">
                                            <i class="glyphicon glyphicon-cog color-orange"></i>
                                        </button>

                                    </div>
                                    <div class="panel-body">
                                        <table class="table display" id="rulesetsTable">
                                            <thead>
                                            <tr>
                                                <th  style="width:3%"><?php oLang::_('O_ID'); ?></th>
                                                <th><?php oLang::_('O_RULE'); ?></th>
                                                <th><?php oLang::_('O_ATTACKTYPE'); ?></th>
                                                <th><?php oLang::_('O_STATUS'); ?></th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                <th><?php oLang::_('O_ID'); ?></th>
                                                <th><?php oLang::_('O_RULE'); ?></th>
                                                <th><?php oLang::_('O_ATTACKTYPE'); ?></th>
                                                <th><?php oLang::_('O_STATUS'); ?></th>
                                                <th></th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <!-- advanced firewall rules-->
                                <div class="tab-pane" id="adfirewall-rule">
                                    <?php
                                    $status = oseFirewall::checkSubscriptionStatus(false);
                                    if ($status == true) {
                                        ?>
                                        <div class="panel-controls-buttons">
                                            <button class="btn btn-config btn-sm mr5 mb10" type="button"
                                                    onClick="downloadRequest('ath')" data-toggle="tooltip"
                                                    data-placement="left"
                                                    title="<?php oLang::_('O_UPDATE_SIGNATURE'); ?>">
                                                <i class="glyphicon glyphicon-refresh color-blue"></i>
                                            </button>
                                            <button data-target="#configModal" data-toggle="modal"
                                                    onClick="location.href='<?php echo oseFirewall::getConfigurationURL() . '#adfirewall'; ?>'"
                                                    class="btn btn-config btn-sm mr5 mb10" type="button"
                                                    title="<?php oLang::_('ADVANCED_FIREWALL_SETTINGS'); ?>">
                                                <i class="glyphicon glyphicon-cog color-orange"></i>
                                            </button>
                                        </div>
                                        <div class="panel-body">
                                            <table class="table display" id="AdvrulesetsTable">
                                                <thead>
                                                <tr>
                                                    <th style="width:3%")><?php oLang::_('O_ID'); ?></th>
                                                    <th><?php oLang::_('O_RULE'); ?></th>
                                                    <th><?php oLang::_('O_ATTACKTYPE'); ?></th>
                                                    <th><?php oLang::_('O_IMPACT'); ?></th>
                                                    <th><?php oLang::_('O_STATUS'); ?></th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tfoot>
                                                <tr>
                                                    <th><?php oLang::_('O_ID'); ?></th>
                                                    <th><?php oLang::_('O_RULE'); ?></th>
                                                    <th><?php oLang::_('O_ATTACKTYPE'); ?></th>
                                                    <th><?php oLang::_('O_IMPACT'); ?></th>
                                                    <th><?php oLang::_('O_STATUS'); ?></th>
                                                    <th></th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div id="oseappcontainer">
                                            <div class="container">
                                                <div id="sub-header" class="row"
                                                     style="background:url('<?php echo "http://www.googledrive.com/host/0B4Hl9YHknTZ4X2sxNTEzNTBJUlE/sub_hd_bg.png" ?>') top center;  min-height:500px;">
                                                    <div id="unsub-left">
                                                        <?php $this->model->showSubHeader(); ?>
                                                        <?php echo $this->model->getBriefDescription(); ?>
                                                    </div>
                                                    <div id="unsub-right">
                                                        <a href="https://www.centrora.com/malware-removal"
                                                           id="leavetous-adfirewall">leave the work to us
                                                            now</a>
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
                                    <?php } ?>
                                    <!-- End .panel -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
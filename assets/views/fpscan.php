<?php
oseFirewall::checkDBReady();
$confArray = $this->model->getConfiguration('vsscan');
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
                    <div class="panel-heading">

                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div id="scan-window" class="col-md-12">
                                <div id='scan_progress' class="alert alert-info fade in">
                                    <div class="row">
                                        <!--                                        <div class="col-md-1">-->
                                        <!--                                            <div class="bg-primary alert-icon">-->
                                        <!--                                                <i class="glyphicon glyphicon-info-sign s24"></i>-->
                                        <!--                                            </div>-->
                                        <!--                                        </div>-->
                                        <div class="col-md-11">
                                            <div id="status_content" class="col-md-12" style="display: none;">
                                                <div id='status' class='col-md-12'>
                                                    <strong>Status </strong>

                                                    <div class="progress progress-striped active"
                                                         style="margin-left: 0px;">
                                                        <div id="vs_progress" class="progress-bar" role="progressbar"
                                                             aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                                             style="width: 0%">
                                                            <span id="p4text"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="last_batch" class='col-md-12'>Last Batch:
                                                    <strong id='last_file' class="text-success"></strong>
                                                </div>
                                                <div class='col-md-12'>Files Scanned:
                                                    <strong id='total_number' class="text-warning"></strong>
                                                </div>
                                                <div class='col-md-12'>Insecure permission Files:
                                                    <a href="#scanresult"><strong id='vs_num' class="text-danger"></strong></a>
                                                </div>
                                                <div id="surfcalltoaction"
                                                     class='col-md-12'
                                                     style="display: none;">
                                                    <!--                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                                                    <?php oLang::_('FPSCAN_CALL_TOACTION') ?>
                                                </div>
                                            </div>
                                            <div id="scanpathtext" class='col-md-12' style="display: none;">Scan Path:
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
                        <div class="row col-md-12">
                            <div class="col-sm-3 col-md-offset-3">
                                <label for="filePerm"
                                       class="control-label"><?php oLang::_('O_BASE_FILEPERM'); ?></label>
                                <input title="default file permission is 0644" type="text" name="filePerm"
                                       placeholder="0644" id="filePerm" pattern="^[0-7]{3}$">
                            </div>

                            <div class="col-sm-3">
                                <label for="folderPerm"
                                       class="control-label"><?php oLang::_('O_BASE_FOLDERPERM'); ?></label>
                                <input title="default folder permission is 0755" type="text" name="folderPerm"
                                       placeholder="0755"
                                       id="folderPerm" pattern="^[0-7]{3}$">
                            </div>
                            <div id="scanbuttons">
                                <button id="sfsstop" class='centrora-btn' style="display: none">
                                    <i id="ic-change"
                                       class="glyphicon glyphicon-stop color-red"></i> <?php oLang::_('STOP_VIRUSSCAN') ?>
                                </button>
                                <button id="sfsstart" class='centrora-btn'>
                                    <i id="ic-change"
                                       class="glyphicon glyphicon-play color-white"></i> <?php oLang::_('START_NEW_SCAN') ?>
                                </button>
                                <button data-target="#scanPathModal" data-toggle="modal" id="setscanpath"
                                        title="<?php oLang::_('SETSCANPATH') ?>"
                                        class='centrora-btn'>
                                    <i id="ic-change" class="glyphicon glyphicon-folder-close text-primary"></i>
                                    Set Scan Path
                                </button>
                                <button class="centrora-btn" type="button"
                                        onClick="location.href='<?php $this->model->getPageUrl('permconfig'); ?>'"><i
                                        id="ic-change"
                                        class="text-primary glyphicon glyphicon-cog"></i><?php oLang::_('FILEPERM_EDITOR') ?>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-12" id="scan-result" class="row" style="display: none;">
                            <strong class="alert-danger">Insecure permission Files Detected!</strong>
                            <strong class="col-md-12">
                                <div class='col-md-8'>Path</div>
                                <div class='col-md-1'>Permission</div>
                            </strong>
                            <div id="scan-result-panel"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div id='fb-root'></div>

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
            <div class="modal-body">
                <label style="vertical-align: top;"><?php oLang::_('FILETREENAVIGATOR'); ?></label>
                <div class="panel-body" id="FileTreeDisplay"></div>
            </div>
            <div class="modal-footer">
                <div class="panel-body">
                    <div class="form-group">
                        <label for="scanPath" class="col-sm-1 control-label"><?php oLang::_('PATH'); ?></label>

                        <div class="col-sm-11">
                            <input type="text" name="scanPath" id="selected_file" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                            <button type="button" class="btn btn-sm" id='save-button'><i
                                    class="glyphicon glyphicon-save text-success"></i> <?php oLang::_('SET'); ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="popoverhiddenhtml"  class="col-sm-2" style="display: none">
    <form name="fmode">
        <table class="table display table-condensed" id="chmodtbl">
            <tbody>
            <tr>
                <td align="center"><b>Mode</b></td>
                <td align="center">Owner</td>
                <td align="center">Group</td>
                <td align="center">Public</td>
            </tr>
            <tr>
                <td align="right">Read</td>
                <td align="center"><input type="checkbox" onclick="calcperm();" value="4" id="ur"></td>
                <td align="center"><input type="checkbox" onclick="calcperm();" value="4" id="gr"></td>
                <td align="center"><input type="checkbox" onclick="calcperm();" value="4" id="wr"></td>
            </tr>
            <tr>
                <td align="right">Write</td>
                <td align="center"><input type="checkbox" onclick="calcperm();" value="2" id="uw"></td>
                <td align="center"><input type="checkbox" onclick="calcperm();" value="2" id="gw"></td>
                <td align="center"><input type="checkbox" onclick="calcperm();" value="2" id="ww"></td>
            </tr>
            <tr>
                <td align="right">Execute</td>
                <td align="center"><input type="checkbox" onclick="calcperm();" value="1" id="ux"></td>
                <td align="center"><input type="checkbox" onclick="calcperm();" value="1" id="gx"></td>
                <td align="center"><input type="checkbox" onclick="calcperm();" value="1" id="wx"></td>
            </tr>
            <tr>
                <td align="right">Permission</td>
                <td><input style="text-align: center;" type="text" readonly="readonly" id="u" class="form-control"></td>
                <td><input style="text-align: center;" type="text" readonly="readonly" id="g" class="form-control"></td>
                <td><input style="text-align: center;" type="text" readonly="readonly" id="w" class="form-control"></td>
            </tr>
            </tbody>
        </table>
    </form>
</div>


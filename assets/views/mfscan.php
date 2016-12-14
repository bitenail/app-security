<?php
/**
 * Created by PhpStorm.
 * User: phil
 * Date: 31/08/15
 * Time: 9:55 AM
 */
oseFirewall::checkDBReady();
$this->model->getNounce();
?>
<div id="oseappcontainer">
    <div class="container">
        <?php $this->model->showLogo();
        $this->model->showHeader(); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary plain ">
                    <!-- Start .panel -->
                    <div class="panel-heading">

                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <!--Scan Status-->
                            <div id="scan-window" class="col-md-12">
                                <div id='scan_progress' class="alert alert-info fade in">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <div class="bg-primary alert-icon">
                                                <i class="glyphicon glyphicon-info-sign s24"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div id="status_content" class="col-md-12" style="display: none;">
                                                <div id='status' class='col-md-12'>
                                                    <strong>Status </strong>

                                                    <div class="progress progress-striped active">
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
                                                <div class='col-md-12'># Scanned:
                                                    <strong id='total_number' class="text-warning"></strong>
                                                </div>
                                                <div class='col-md-12'># Modified Files:
                                                    <a href="#scanresult"><strong id='vs_num' class="text-danger"></strong></a>
                                                </div>
                                                <div id="surfcalltoaction"
                                                     class='alert alert-dismissable alert-warning col-md-12'
                                                     style="display: none;">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
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
                       
                        <div class="row">
                            <div class="col-md-3">
                                <label for="datepicker1"><?php oLang::_('SETSTARTDATE'); ?></label>
                                <input id='datepicker1' type='text' name="startdate"/>
                            </div>
                            <div class="col-md-3">
                                <label for="datepicker2"><?php oLang::_('SETENDDATE'); ?></label>
                                <input id='datepicker2' type='text' name="enddate"/>
                            </div>

                            <div class="col-md-2">
                                <label for="symlink"><?php oLang::_('SYMLINK'); ?></label>
                                (<i class="im im-redo2 text-warning"></i>)
                                <input type='checkbox' id="symlink"/>
                            </div>

                            <div id="scanbuttons">
                                <button id="sfsstop" class='btn btn-sm mr5 mb10' style="display: none;">
                                    <i class="glyphicon glyphicon-stop color-red"></i> <?php oLang::_('STOP_VIRUSSCAN') ?>
                                </button>
                                <button id="sfsstart" class='centrora-btn'>
                                    <i id="ic-change" class="glyphicon glyphicon-play color-green"></i> <?php oLang::_('START_NEW_SCAN') ?>
                                </button>
                                <button data-target="#scanPathModal" data-toggle="modal" id="setscanpath"
                                        title="<?php oLang::_('SETSCANPATH') ?>"
                                        class='pull-right btn btn-config btn-sm mr5'>
                                    <i class="glyphicon glyphicon-folder-close text-primary"></i>
                                </button>
                            </div>
                        </div>
                         <div class="row">
                        	<div id="mfiles-results">
                        	<?php
                        		$filePath = OSE_FWDATA . ODS . "vsscanPath" . ODS . "mfList.inc";
                        		if (file_exists($filePath)) {
                        			oseFirewall::loadFiles();
                        			$data = str_replace("\n", '<br/>',oseFile::read($filePath));
                        			echo $data;
                        		}
                        	?>
                        	</div>
                        </div>
                        <div class="col-md-12" id="scan-result" class="row" style="display: none;">
                            <strong class="alert-warning">Modified files found:</strong>
                            <strong class="col-md-12">
                                <div class='col-md-7'>Path</div>
                                <div class='col-md-1'>Size</div>
                                <div class='col-md-2'>Modified</div>
                            </strong>
                            <div id="scan-result-panel"></div>
                        </div>
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
                                    <label for="scanPath"
                                           class="col-sm-1 control-label"><?php oLang::_('PATH'); ?></label>

                                    <div class="col-sm-11">
                                        <input type="text" name="scanPath" id="selected_file" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div>
                                        <button type="button" class="btn btn-sm" id='save-button'><i class="glyphicon glyphicon-save text-success"></i> Set Path
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

<?php
oseFirewall::checkDBReady ();
$status = oseFirewall::checkSubscriptionStatus ( false );
$version = oseFirewall::checkVersion();
$this->model->getNounce ();
$urls = oseFirewall::getDashboardURLs ();
if ($version >= 6.0) {
$vscansettings = $this->model->getCronSettings ( 3 );
 } else {
 $vscansettings = $this->model->getCronSettings ( 1 );
 }
$backupsettings = $this->model->getCronSettings ( 2 );
$gitbackupsettings = $this->model->getCronSettings ( 4 );
if (class_exists('SConfig')){
    $confArray = $this->model->getConfiguration('vsscan');
}
if ($status == true) {
	?>
<div id="oseappcontainer">
	<div class="container">
	<?php
	$this->model->showLogo ();
	$this->model->showHeader ();
	?>
	<div class="row">
			<div class="col-md-12">
				<div class="bs-component">
					<div class="panel-body panelRefresh">
						<ul class="nav nav-tabs" role="tablist" data-tabs="tabs">
							<li class="active"><a data-toggle="tab" href="#vscannercron"><?php oLang::_('SCHEDULE_SCANNING'); ?></a></li>
							<?php if (!class_exists('SConfig')) { ?>
							<li><a data-toggle="tab" href="#backupcron"><?php oLang::_('SCHEDULE_BACKUP'); ?></a></li>
							<?php } ?>
							<li><a data-toggle="tab" href="#gitbackupcron"><?php oLang::_('SCHEDULE_GITBACKUP'); ?></a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="vscannercron">
								<div class="alert alert-info fade in mt15">
									<p>
										<div class="bg-primary alert-icon">
											<i class="glyphicon glyphicon-info-sign s24"></i>
										</div>
										<?php oLang::_('CRONJOBS_LONG'); ?></p>
								</div>
								<form id='cronjobs-form' class="form-horizontal group-border stripped" role="form">
									<div class="form-group">
										<div class="col-md-4">
											<div class="panel panel-primary">
												<div class="panel-heading">
													<h3 class="panel-title"><?php oLang::_('HOURS'); ?>
                                                        <i tabindex="0" class="fa fa-question-circle color-gray" data-toggle="popover" data-content="<?php oLang::_('HOURS_HELP');?>"></i>
													</h3>
												</div>
												<div class="panel-body">
													<div class="row">
														<div class="col-xs-8">
															<select class="form-control" id="vscancusthours" name="custhours" size="1"></select>
														</div>
														<label id="vscanusertime"></label> <input id="vscansvrusertime" style="display: none" value="<?php echo $vscansettings['hour'] ?>">
													</div>
												</div>
											</div>
											<div class="panel panel-primary">
												<div class="panel-heading">
													<h3 class="panel-title"><?php oLang::_('WEEKDAYS'); ?></h3>
												</div>
												<div id="panel-weekdays" class="panel-body">
													<select class="form-control" name="custweekdays[]" size="7" multiple="" id="vscanweekdays">
														<option value="0" <?php echo ($vscansettings[0] == true)?" selected ":""; ?>>Sunday</option>
														<option value="1" <?php echo ($vscansettings[1] == true)?" selected ":""; ?>>Monday</option>
														<option value="2" <?php echo ($vscansettings[2] == true)?" selected ":""; ?>>Tueday</option>
														<option value="3" <?php echo ($vscansettings[3] == true)?" selected ":""; ?>>Wednesday</option>
														<option value="4" <?php echo ($vscansettings[4] == true)?" selected ":""; ?>>Thursday</option>
														<option value="5" <?php echo ($vscansettings[5] == true)?" selected ":""; ?>>Friday</option>
														<option value="6" <?php echo ($vscansettings[6] == true)?" selected ":""; ?>>Saturday</option>
													</select>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="row">
												<div class="col-xs-12">
													<p class="bg-danger"><small><i class="glyphicon glyphicon-warning-sign"></i> <?php oLang::_('SAVE_SETTING_DESC'); ?></small></p>
												</div>
											</div>
											
											<div class="row">
												<div class="form-group">
													<div class="col-xs-6"><?php oLang::_('SCHEDULE_SCANNING'); ?>:</div>
													<div class="col-xs-6">
														<div class="onoffswitch">
															<input type="checkbox" class="onoffswitch-checkbox" <?php echo ($vscansettings ['enabled'] == 1 && isset ( $vscansettings ['enabled'] )) ? " checked " : "";?> id="vscanonoffswitch">
															<label class="onoffswitch-label" for="vscanonoffswitch">
                                                                <span class="onoffswitch-inner"></span>
                                                                <span class="onoffswitch-switch"></span>
															</label>
														</div>
													</div>
												</div>
											</div>
											
											<div class="col-xs-12 form-group row">
                                                <?php if (class_exists('SConfig')){?>
                                                <div class="input-group">
                                                    <span class="input-group-btn">
                                                        <button data-target="#scanPathModal" data-toggle="modal" type="button" id="setscanpath" class='btn btn-sm mr5 mb10'><i class="glyphicon glyphicon-folder-close text-primary"></i> <?php oLang::_('SETSCANPATH'); ?></button>
                                                    </span>
                                                    <input type="text" id="selected_file2" class="form-control" disabled value="<?php echo $confArray['data']['scanPath']?>">
                                                </div>
                                                <?php }?>
												<div class="pull-right">
													<button class="btn btn-sm" type="submit"><i class="glyphicon glyphicon-save"></i> <?php oLang::_('SAVE_SETTINGS'); ?></button>
												</div>
											</div>
										</div>
									</div>
									<input type="hidden" name="option" value="com_ose_firewall">
									<input type="hidden" name="controller" value="cronjobs">
									<input type="hidden" name="action" value="saveCronConfig">
									<input type="hidden" name="task" value="saveCronConfig">
									<?php if ($version >= 6.0) { ?>
									<input type="hidden" name="schedule_type" value="3">
									<?php } else {?>
									<input type="hidden" name="schedule_type" value="1">
									<?php } ?>
									<input type="hidden" name="cloudbackuptype" value="1">
									<input type="hidden" name="enabled" value="<?php echo ($vscansettings ['enabled'] == 1 && isset ( $vscansettings ['enabled'] )) ? 1 : 0;?>" id="vscanenabled">
									<!--also set in js for myonoffswitch-->
								</form>
								<!--Set Scan Path Modal-->
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
                                                    <form id = 'setscanpath-form' class="form-horizontal group-border stripped" role="form">
                                                        <div class="form-group">
                                                            <label for="scanPath" class="col-sm-1 control-label"><?php oLang::_('PATH');?></label>
                                                            <div class="col-sm-11">
                                                                <input type="text" name="scanPath" id="selected_file" class="form-control">
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="option" value="com_ose_firewall">
                                                        <input type="hidden" name="controller" value="cronjobs">
                                                        <input type="hidden" name="action" value="saveScanPath">
                                                        <input type="hidden" name="task" value="saveScanPath">
                                                        <input type="hidden" name="type" value="vsscan">
                                                        <div class="form-group">
                                                            <div>
                                                                <button type="submit" class="btn btn-sm" id='save-button'><i class="glyphicon glyphicon-save text-success"></i> <?php oLang::_('SAVE');?></button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
							</div>
							<div class="tab-pane" id="backupcron">
								<div class="alert alert-info fade in mt15">
									<p>
										<div class="bg-primary alert-icon">
											<i class="glyphicon glyphicon-info-sign s24"></i>
										</div>
										<?php oLang::_('CRONJOBSBACKUP_LONG'); ?></p>
								</div>
								<form id='backup-cronjobs-form' class="form-horizontal group-border stripped" role="form">
									<div class="form-group">
										<div class="col-md-4">
											<div class="panel panel-primary">
												<div class="panel-heading">
													<h3 class="panel-title"><?php oLang::_('HOURS'); ?>
                                                    <i tabindex="0" class="fa fa-question-circle color-gray" data-toggle="popover" data-content="<?php oLang::_('HOURS_HELP');?>"></i>
													</h3>
												</div>
												<div class="panel-body">
													<div class="row">
														<div class="col-xs-8">
															<select class="form-control" id="backupcusthours" name="custhours" size="1"></select>
														</div>
														<label id="backupusertime"></label> <input id="backupsvrusertime" style="display: none" value="<?php echo $backupsettings['hour'] ?>">
													</div>
												</div>
											</div>
											<div class="panel panel-primary">	
												<div class="panel-heading">
													<h3 class="panel-title"><?php oLang::_('WEEKDAYS'); ?></h3>
												</div>
												<div class="panel-body">
													<select class="form-control" name="custweekdays[]" size="7" multiple="" id="backupweekdays">
														<option value="0" <?php echo ($backupsettings[0] == true)?" selected ":""; ?>>Sunday</option>
														<option value="1" <?php echo ($backupsettings[1] == true)?" selected ":""; ?>>Monday</option>
														<option value="2" <?php echo ($backupsettings[2] == true)?" selected ":""; ?>>Tueday</option>
														<option value="3" <?php echo ($backupsettings[3] == true)?" selected ":""; ?>>Wednesday</option>
														<option value="4" <?php echo ($backupsettings[4] == true)?" selected ":""; ?>>Thursday</option>
														<option value="5" <?php echo ($backupsettings[5] == true)?" selected ":""; ?>>Friday</option>
														<option value="6" <?php echo ($backupsettings[6] == true)?" selected ":""; ?>>Saturday</option>
													</select>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="panel panel-primary">
												<div class="panel-heading">
													<h3 class="panel-title"><?php oLang::_('CLOUD_BACKUP_TYPE'); ?></h3>
												</div>
												<div class="panel-body">
													<div class="row">
														<div class="col-xs-8">
															<select class="form-control" id="cloudbackuptype" name="cloudbackuptype" size="1">
                                                            <?php
	if ($this->model->checkCloudAuthentication ( 1 )) {
		echo '<option value="1" ' . (($backupsettings ['cloudbt'] == 1) ? " selected " : "") . '>' . $this->model->getLang ( 'NONE' ) . '</option>';
	}
	if ($this->model->checkCloudAuthentication ( 2 )) {
		echo '<option value="2" ' . (($backupsettings ['cloudbt'] == 2) ? " selected " : "") . '>' . $this->model->getLang ( 'O_BACKUP_DROPBOX' ) . '</option>';
	}
	if ($this->model->checkCloudAuthentication ( 3 )) {
		echo '<option value="3" ' . (($backupsettings ['cloudbt'] == 3) ? " selected " : "") . '>' . $this->model->getLang ( 'O_BACKUP_ONEDRIVE' ) . '</option>';
	}
	if ($this->model->checkCloudAuthentication ( 4 )) {
		echo '<option value="4" ' . (($backupsettings ['cloudbt'] == 4) ? " selected " : "") . '>' . $this->model->getLang ( 'O_BACKUP_GOOGLEDRIVE' ) . '</option>';
	}
	?>
                                                        </select>
														</div>
														<label id="cloudbackupicon"></label>
														<div class="col-xs-8">
															<label><?php oLang::_('CLOUD_SETTING_REMINDER'); ?></label>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-xs-12">
													<p class="bg-danger"><small><i class="glyphicon glyphicon-warning-sign"></i> <?php oLang::_('SAVE_SETTING_DESC'); ?></small></p>
												</div>
											</div>
											<div class="row">
												<div class="form-group">
													<div class="col-xs-6"><?php oLang::_('SCHEDULE_BACKUP'); ?>:</div>
													<div class="col-xs-6">
														<div class="onoffswitch">
															<input type="checkbox" class="onoffswitch-checkbox" <?php echo ($backupsettings ['enabled'] == 1 && isset ( $backupsettings ['enabled'] )) ? " checked " : "";	?>
																id="backuponoffswitch"
															> <label class="onoffswitch-label" for="backuponoffswitch"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
															</label>
														</div>
													</div>
												</div>
											</div>
											
											<div class="row">
												<div class="col-xs-12 form-group">
													<div class="pull-right">
														<button class="btn btn-sm" type="submit"><i class="glyphicon glyphicon-save"></i> <?php oLang::_('SAVE_SETTINGS'); ?></button>
													</div>
												</div>
											</div>
										</div>

                                        <div class="col-md-4">
                                            <div class="panel panel-primary">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title"><?php oLang::_('CLEAR_BACKUP_TIME'); ?></h3>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-xs-8">
                                                                <select class="form-control" id="clearbackuptime"
                                                                        name="clearbackuptime" size="0.3">
                                                                    <?php
                                                                    $this->model->getClearBackup();
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
									<input type="hidden" name="option" value="com_ose_firewall"> <input type="hidden" name="controller" value="cronjobs"> <input type="hidden" name="action" value="saveCronConfig"> <input
										type="hidden" name="task" value="saveCronConfig"
									> <input type="hidden" name="schedule_type" value="2"> <input type="hidden" name="enabled"
										value="<?php
	
	echo ($backupsettings ['enabled'] == 1 && isset ( $backupsettings ['enabled'] )) ? 1 : 0;
	?>" id="backupenabled"
									>
									<!--also set in js for myonoffswitch-->
								</form>
							</div>

							<div class="tab-pane" id="gitbackupcron">
								<div class="alert alert-info fade in mt15">
									<p>
										<div class="bg-primary alert-icon">
											<i class="glyphicon glyphicon-info-sign s24"></i>
										</div>
										<?php oLang::_('CRONJOBS_GITBACKUP'); ?>
										</p>
								</div>
								<form id='gitbackup-cronjobs-form' class="form-horizontal group-border stripped" role="form">
									<div class="form-group">
										<div class="col-md-4">
											<div class="panel panel-primary">
												<div class="panel-heading">
													<h3 class="panel-title"><?php oLang::_('CRONJOBS_FREQUENCY'); ?>
                                                        <i tabindex="0" class="fa fa-question-circle color-gray" data-toggle="popover" data-content="<?php oLang::_('CRONJOBS_FREQUENCY_HELP');?>"></i>
													</h3>
												</div>
												<div class="panel-body">
													<div class="row">
														<div class="col-xs-8">
                                      						<select class="form-control" name="gitbackupfrequency" size="6"  id="gitbackupfrequency">
														<option value="1" <?php echo ($gitbackupsettings['frequency'] == 1)?" selected ":""; ?>>1 hour</option>
														<option value="3" <?php echo ($gitbackupsettings['frequency'] == 3)?" selected ":""; ?>>3 hours</option>
														<option value="6" <?php echo ($gitbackupsettings['frequency'] == 6)?" selected ":""; ?>>6 hours</option>
														<option value="12" <?php echo ($gitbackupsettings['frequency'] == 12)?" selected ":""; ?>>12 hours</option>
														<option value="24" <?php echo ($gitbackupsettings['frequency'] == 24)?" selected ":""; ?>>24 hours</option>
													</select>
                                                          </div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="row">
												<div class="col-xs-12">
													<p class="bg-danger"><small><i class="glyphicon glyphicon-warning-sign"></i> <?php oLang::_('SAVE_SETTING_DESC'); ?></small></p>
												</div>
											</div>

											<div class="row">
												<div class="form-group">
													<div class="col-xs-6"><?php oLang::_('SCHEDULE_GITBACKUP'); ?>:</div>
													<div class="col-xs-6">
														<div class="onoffswitch">
															<input type="checkbox" class="onoffswitch-checkbox" <?php echo ($gitbackupsettings ['enabled'] == 1 && isset ( $gitbackupsettings ['enabled'] )) ? " checked " : "";?> id="gitbackuponoffswitch">
															<label class="onoffswitch-label" for="gitbackuponoffswitch">
                                                                <span class="onoffswitch-inner"></span>
                                                                <span class="onoffswitch-switch"></span>
															</label>
														</div>
													</div>
												</div>
											</div>
											<div class="col-xs-12 form-group row">
												<div class="pull-right">
													<button class="btn btn-sm" type="submit"><i class="glyphicon glyphicon-save"></i> <?php oLang::_('SAVE_SETTINGS'); ?></button>
												</div>
											</div>
										</div>
									</div>
									<input type="hidden" name="option" value="com_ose_firewall">
									<input type="hidden" name="controller" value="cronjobs">
									<input type="hidden" name="action" value="saveCronConfig">
									<input type="hidden" name="task" value="saveCronConfig">
									<input type="hidden" name="schedule_type" value="4">
									<input type="hidden" name="cloudbackuptype" value="1">
									<input type="hidden" name="enabled" value="<?php echo ($gitbackupsettings ['enabled'] == 1 && isset ( $gitbackupsettings ['enabled'] )) ? 1 : 0;?>" id="gitbackupenabled">
									<!--also set in js for myonoffswitch-->
								</form>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id='fb-root'></div>
<?php
} else {
	?>
<div id="oseappcontainer">
        <div class="container">
            <?php
            $this->model->showLogo();
            ?>
             <div id="sub-header" class="row"
                 style="background:url('<?php echo'http://www.googledrive.com/host/0B4Hl9YHknTZ4X2sxNTEzNTBJUlE/sub_hd_bg.png' ?>') top center;  min-height:500px;">
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
	$this->model->showFooterJs ();
}
?>
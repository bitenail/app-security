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
if (!defined('OSE_FRAMEWORK') && !defined('OSEFWDIR') && !defined('_JEXEC'))
{
    die('Direct Access Not Allowed');
}
oseFirewall::checkDBReady ();
$this->model->getNounce();
$status = oseFirewall::checkSubscriptionStatus(false);
$proc_open = $this->model->checkProcOpen();
if($proc_open) {
    $flag = $this->model->checkSysteminfo ();
    $is_init = $this->model->isinit();
    if ($flag && ($is_init == 1)) {
        ?>
        <div id="oseappcontainer">
            <div class="container wrapbody">
                <?php
                $this->model->showLogo();
                ?>
                <!-- Row Start -->
                <div class="row" style="padding-left: 15px; padding-right: 15px;">
                    <div class="col-md-12 wrap-container">
                        	<div class="row row-set">
										<div class="col-sm-3 p-l-r-0">
											<div id="c-tag" style="height:130px;">
												<div class="col-sm-12" style="padding-left: 0px;">
                                <span class="tag-title" style="height: 130px;">Git Backup<span>
												</div>
												<p class="tag-content">Git Backup is a innovatie and potential tool for website backup and restore in seconds.</p>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="screport-line-1" style="padding-left: 25px;">
												<div class="title-icon" style="font-size: 45px;"><i class="fa  fa-clock-o"></i></div>
												<div class="title-content">
													Last Backup<br>&nbsp;<span id="backup-time">2016/05/02 08:50:41</span>
												</div>
											</div>
										</div>
										<div class="col-sm-3">
											 <div class="vs-line-1" style="height:130px;">
                                <div class="vs-line-1-title" onclick="createBackupAllFiles()" style="padding-top: 25px;">
                                 <i class="fa fa-save btn-backup"></i></div>
                                <div class="vs-line-1-number" style="font-size: 18px; font-weight: 300;">
                               Create local backup
                                </div>
                                </div>
										</div>
										<div class="col-sm-3" style="padding-left:0px;">
											<div class="vs-line-1" style="height:130px;">
											<?php if ($status == true) { ?>
                                    <div onclick="gitCloudBackup()" class="vs-line-1-title" style="padding-top: 25px;">
                                    <i class="fa fa-cloud-upload btn-backup"></i></div>
                                <?php } else { ?>
                                     <div id="subscribe-button" class="vs-line-1-title" style="padding-top: 25px;">
                                     <i class="fa fa-cloud-upload btn-backup"></i></div>
                                <?php } ?>
                                <div class="vs-line-1-number" style="font-size: 18px; font-weight: 300;">
                               Push backup to cloud
                                </div>
                                </div>
										</div>
									</div>
                        <!--                            push and zip-->
                                                   <input type="hidden" id="push" value= "0"/>
                                                   <input type="hidden" id="zip"  value = "0"/>
                                                   <input type="hidden" id="rollback" value= "0"/>
                                                   <input type="hidden" id="recall"  value = "0"/>
                                                   <input type="hidden" id="commitid"  value = "0"/>

                        <div class="row row-set" style="padding-right: 20px;">
                         <div id="msg-box" class="col-sm-12 message-row">
<!--                         <i id="close-msg-box" class="fa fa-close icon_close" style="margin-top: -5px; margin-right: 1px;"></i>-->
                         <div class="col-sm-5" style="padding-left: 5px;">
                         <div class="msg-title">Current Version Column</div>
                         <p style="opacity: 0.6">This column shows the current Git head in your Git Repository,  which indicates in which backup version your website is currently at.
                        </p>
                        </div>
                        <div class="col-sm-1" style="padding-left: 3%; padding-top: 27px;">
                        <div class="chip"></div>
                        </div>
                                <div class="col-sm-5">
                                    <div class="msg-title">Restore Column</div>
                                    <p style="opacity: 0.6">
                                    This column shows the current Git head in your Git Repository,  which indicates in which backup version your website is currently at.
                                    </p>
                                </div>
                        </div>
                         </div>

                        <div id="pop_subscription" class="col-lg-6">
                            <span>This is a Premium Feature &nbsp;<i class="fa fa-certificate"></i></span>
							<img id="pop_close" src="<?php echo $this->model->getImgUrl('close_cross.png'); ?>">
							<p>Premium features includes</p>
							<ul class="pop_ul">
								<li>Free Malware Removal Service for annual subscribers until the website is 100% clean.</li>
								<li>View infected files in detail by browsing source codes with suspicious codes highlighted..</li>
								<li>Clean or quarantine infected files within the scan report without accessing FTP.</li>
								<li>Monitor website malware with scheduled automatic virus scanning and email notifications.</li>
								<li>Automated backup to Bitbucket every 1 hour.</li>
								<li>Store your files securely in Bitbuckets.</li>
								<li>2GB free spaces for each website in Bitbucket.</li>
								<li>Roll back from copies in Bitbucket in case of server fault</li>
								<li>Save your hosting space and save you money</li>
							</ul>
                            <a  target="_blank" href="http://www.centrora.com/developers/">
                            <button id="btn_gopremium">Go Premium</button></a>

                        </div>
                        <!--                        <div class="panel-heading">-->
                        <!--                            <h3 class="panel-title">-->
                        <?php //echo 'CURRENT BACKUP HISTORY :'; ?><!--</h3>-->
                        <!--                        </div>-->

                        <!-- Panels Start -->
                        <div class="row row-set" style="padding-right: 20px;">
                        <table class="table display" id="gitBackupTable">
                            <thead>
                            <tr>
                                <th><?php oLang::_('SR_NO'); ?></th>
                                <th><?php oLang::_('GIT_DATE'); ?></th>
                                <th><?php oLang::_('GIT_ID'); ?></th>
                                <th><?php oLang::_('GIT_MESSAGE'); ?></th>
                                <th><?php oLang::_('GIT_ROLLBACK'); ?></th>
                                <th><?php oLang::_('ZIP_DOWNLOAD'); ?></th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th><?php oLang::_('SR_NO'); ?></th>
                                <th><?php oLang::_('GIT_DATE'); ?></th>
                                <th><?php oLang::_('GIT_ID'); ?></th>
                                <th><?php oLang::_('GIT_MESSAGE'); ?></th>
                                <th><?php oLang::_('GIT_ROLLBACK'); ?></th>
                                <th><?php oLang::_('ZIP_DOWNLOAD'); ?></th>
                            </tr>
                            </tfoot>
                        </table>
                            </div>
                        <!-- Panels Ends -->
                        <!-- Panels Ends -->
                        <div class="row row-set">
										<div class="col-sm-12" style="padding-left: 0px; padding-right: 20px; margin-top: 15px;">
											<a href="http://www.centrora.com/developers/" target="_blank"><div class="call-to-action">
													<div class="call-to-action-txt">
														<img width="35" height="35" alt="C_puma" src="http://googledrive.com/host/0BzcQR8G4BGjUX0ZzTzBvUVNEb00"> &nbsp;
														Schedule your scanning and update with Centrora Premium <sup>Now</sup></div>
												</div></a>
										</div>
									</div>
									<div class="row">
										<div id="footer" class="col-sm-12">
											<div>Centrora 2016 a portfolio of Luxur Group PTY LTD,  All rights reserved.</div>
										</div>
									</div>
                    </div>
                </div>
            </div>
            <!-- Row Ends -->
        </div>
        </div>
        <div id='fb-root'></div>


        <div class="modal fade" id="bitBucketModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2"><?php oLang::_('BITBUCKET_ACC'); ?></h4>
                    </div>
                    <div class="modal-body">
                        <form id='remoteGit-form' class="form-horizontal group-border stripped" role="form">
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?php oLang::_('GITCREMOTE_USERNAME'); ?></label>
                                <div class="col-sm-8">
                                    <input type="text" name="username" value="" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?php oLang::_('GITCREMOTE_PASSWORD'); ?></label>
                                <div class="col-sm-8">
                                    <input type="password" name="password" value="" class="form-control" required>
                                </div>
                            </div>

                            <input type="hidden" name="option" value="com_ose_firewall"> <input type="hidden"
                                                                                                name="controller"
                                                                                                value="gitbackup">
                            <input type="hidden" name="action" value="saveRemoteGit"> <input
                                type="hidden" name="task" value="saveRemoteGit">

                    </div>
                    <div class="modal-footer">
                        <div id="buttonDiv">
                            <div class="form-group">
                                <a class="create-repos btn-xs" href="https://bitbucket.org/" target="_blank"> Create an
                                    account for free in Bitbucket </a>
                                <button type="submit" class="btn btn-sm">
                                    <i class="text-primary glyphicon glyphicon-save"></i> <?php oLang::_('CREATE_REPOSITORY'); ?>
                                </button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>


<!--        form to enter commit message-->

        <div class="modal fade" id="commitMessageModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2"><?php oLang::_('COMMIT'); ?></h4>
                        <span class = "text-danger"><h6 class="modal-title" id="myModalLabel2"><?php oLang::_('RECOMMENDATION_COMMIT'); ?></h6></span>
                    </div>
                    <div class="modal-body">
                        <form id='commitMessage-form' class="form-horizontal group-border stripped" role="form">
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?php oLang::_('COMMIT_MESSAGE'); ?></label>
                                <div class="col-sm-8">
                                    <input type="text" id="message" value="" class="form-control" required>
                                </div>
                            </div>
                    <div class="modal-footer">
                        <div id="buttonDiv">
                            <div class="form-group">
                                <div id ="errormessage">
                                </div>
                                <button type="submit" class="btn btn-sm" >
                                    <i class="text-primary glyphicon glyphicon-save"></i> <?php oLang::_('SUBMIT_COMMIT_MSG'); ?>
                                </button>
                                <input type="hidden" name="option" value="com_ose_firewall"> <input type="hidden"
                                                                                                    name="controller"
                                                                                                    value="gitbackup">
                                <input type="hidden" name="action" value="setCommitMessage"> <input
                                    type="hidden" name="task" value="setCommitMessage">
                            </div>

                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
<!--                                                form for commit ends-->
    <?php } else {  //else part ?>
         <div id="oseappcontainer">
            <div class="container wrapbody">
                <?php
                $this->model->showLogo();
//                $this->model->showHeader();
                ?>
                <!-- Row Start -->
                <div class="row" style="padding-left: 15px; padding-right: 15px;">
                    <div class="col-md-12 wrap-container">

                <div class="row row-set" style="padding-right: 20px;">
						<div class="col-sm-12 goforpremium">
                        <div class="col-sm-12 st-git-line-1">
                        	Compared to the traditional backup methods, the technology with Git has  <b>4</b>  significant advantages.
                        	</div>
                        	<div id="carousel-generic" class="col-sm-12 carousel slide" data-ride="carousel">

                               <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                 <div class="item active" style="padding-top: 90px;">
                                 <div class=" st-git-content">
                                 <div> <b>1. Efficient in resource consumption </b></div>
                                 <div>Git only tracks the changes. So unlike the traditional backup method, it will not keep the full website files and data upon each backup. Only changes will be committed to the last backup package and it takes much less space and saves a lot of time in a new backup.
Assume a website takes 100MB space originally and the size increases by 5MB every day. Let’s see how Git Backup
works compared to the traditional way. We can observe the dramatic difference just after 5 days.</div>
                                   </div>
                                   </div>
                                   <div class="item">
                                   <div class=" st-git-content">
                                 <div> <b>Example Diagram:</b></div>
                                 <div data-example-id="condensed-table" class="bs-example"> <table class="table table-condensed">
                                  <thead>
                                    <tr><th></th><th></th><th colspan="2">New added backup size (MB)</th></tr>
                                    <tr> <th>Day</th> <th>Site Size (MB)</th> <th>Traditional method </th> <th>Git method</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <th scope="row">1</th> <td>100</td> <td>100</td> <td>100</td>
                                    </tr>
                                    <tr>
                                      <th scope="row">2</th> <td>105</td> <td>+105</td> <td>+5</td>
                                    </tr>
                                    <tr>
                                      <th scope="row">3</th> <td>110</td> <td>+110</td> <td>+5</td>
                                    </tr>
                                    <tr>
                                      <th scope="row">4</th> <td>115</td> <td>+115</td> <td>+5</td>
                                    </tr>
                                    <tr>
                                      <th scope="row">5</th> <td>120</td> <td>+120</td> <td>+5</td>
                                    </tr>

                                    <tr>
                                      <th scope="row">Accumulation</th> <td></td> <td>+550</td> <td>+120</td>
                                    </tr>

                                  </tbody>
                                </table> </div>
                                   </div>
                                   </div>
                                    <div class="item" style="padding-top: 90px;">
                                   <div class=" st-git-content">
                                 <div> <b>2. Super fast in rollback</b></div>
                                 <div>With the Git method, just one click can resolve all the issues and it could just take less than 30 seconds because it only rollback the changed contents based on the previous version. It totally avoids the boring process
                                  of removing the old files, uploading the package, and extracting it as with the traditional way.</div>
                                   </div>
                                   </div>
                                    <div class="item" style="padding-top: 90px;">
                                  <div class=" st-git-content">
                                 <div><b>3. Easy to track the differences</b></div>
                                 <div>Whenever we need to compare the files between different versions for development or security purposes, it will be as easy as pie with Git functions. Git is designed to have a complete history and full
                                 version tracking abilities. With a few operations, we can get a full list of changed files and also the detailed changed codes of each file.</div>
                                   </div>
                                   </div>
                                    <div class="item" style="padding-top: 90px;">
                                  <div class=" st-git-content">
                                 <div><b>4. Unlimited space when uploading the backup to Cloud</b></div>
                                 <div>Cloud backup is a popular solution as we can easily bring the backup with us at any place at any time as long as there is an internet connection. However, the consideration of space will more or less restricts the freedom of keeping the backup in a long term. This is not a problem at all for Git solution. With Bitbucket
                                 free service, we can create unlimited repositories, Git work directories, and each repository offers 2GB space.</div>
                                   </div>
                                   </div>
                            </div>
                             <!-- Indicators -->
                              <ol class="carousel-indicators">
                                <li data-target="#carousel-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-generic" data-slide-to="2"></li>
                                <li data-target="#carousel-generic" data-slide-to="3"></li>
                                <li data-target="#carousel-generic" data-slide-to="4"></li>
                              </ol>
                            <!-- Controls -->
                              <a class="left carousel-control" href="#carousel-generic" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                              </a>
                              <a class="right carousel-control" href="#carousel-generic" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                              </a>
							</div>
							<div class="col-sm-12"  style="margin:20px 0px 15px 0px;">
							<?php
                if ($flag == false && $is_init == 0) { ?>
            <div class="git-systemcheck">
                   <div class="systeminfosection">
            <div>
                <?php
                $activationpanel = $this->model->getActivationPanel();
                foreach ($activationpanel->systemInfo() as $value) {
                    if ($value['status'] == false) {
                        echo "<ul>";
                        echo "<span class=\"fa fa-times color-red\">";
                        echo " " . $value['info'];
                        echo "</span> </ul>";
                    } else
                        if ($value['status'] == true) {
                            echo "<ul>";
                            echo "<span class=\"fa fa-check color-green\">";
                            echo " " . $value['info'];
                            echo "</span> </ul>";
                        }
                }
                ?>
            </div>
        </div>
                 <?php   echo "<a class=\"st-git-line-1  color-dark\" onclick=\"#\">Please check the system requirements</a>";
                }
                if ($flag == false && $is_init == 1) { ?>
                <div class="git-systemcheck">
                   <div class="systeminfosection">
            <div>
                <?php
                $activationpanel = $this->model->getActivationPanel();
                foreach ($activationpanel->systemInfo() as $value) {
                    if ($value['status'] == false) {
                        echo "<ul>";
                        echo "<span class=\"fa fa-times color-red\">";
                        echo " " . $value['info'];
                        echo "</span> </ul>";
                    } else
                        if ($value['status'] == true) {
                            echo "<ul>";
                            echo "<span class=\"fa fa-check color-green\">";
                            echo " " . $value['info'];
                            echo "</span> </ul>";
                        }
                }
                ?>
            </div>
        </div>
        <?php
                    echo "<p class=\"st-git-line-1\" onclick=\"#\">Please check the system requirements</p>";
                    echo "<strong class=\"fx-button\"> The git has already been initiliazed</strong>";
                }
                if ($flag && $is_init == 0) {
                    echo "<a class=\"btn-new\" onclick=\"enableGitBackup()\">Enable GitBackup 'Now'</a>";
                }
                ?>
                            </div>
				</div>
				</div>
						<div class="row row-set">
						<div class="col-sm-12" style="padding-left: 0px; padding-right: 20px; margin-top: 15px;">
							<a href="http://www.centrora.com/developers/" target="_blank"><div class="call-to-action">
									<div class="call-to-action-txt">
										<img width="35" height="35" alt="C_puma" src="http://googledrive.com/host/0BzcQR8G4BGjUX0ZzTzBvUVNEb00"> &nbsp;
										Schedule your scanning and update with Centrora Premium <sup>Now</sup></div>
								</div></a>
						</div>
					</div>
				<div class="row" style="margin-bottom: 15px;">
					<div id="footer" class="col-sm-12">
						<div>Centrora 2016 a portfolio of Luxur Group PTY LTD,  All rights reserved.</div>
					</div>
				</div>
                        	</div>
                        	</div>
                        	</div>
        <?php
    } }
else {

        $this->model->showLogo();
        $this->model->showHeader();
        ?>
            <div class="git-systemcheck">
                <h3> Welcome to GitBackup </h3>
                <?php
    echo "<a class=\"btn disabled btn-xs  mr5\" onclick=\"#\">Your website has disabled proc open, Please enable it</a></a></li>";

    }
?>
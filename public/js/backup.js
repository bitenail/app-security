var controller = "backup";
var option = "com_ose_firewall";
var disable_build_backup = 'disabled';
var ose_cms = '';
var dropboxlink = '';
var dropboxicon = '';
var needSubscription = '';
var subscriptionLink = '';
var dropboxauth = '';
var onedrivelink = '';
var onedriveicon = '';
var onedriveauth = '';
var googledrivelink = '';
var googledriveicon = '';
var googledriveauth = '';
var isRunning = false;

// Create Base64 Object
var Base64 = {
    _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=", encode: function (e) {
        var t = "";
        var n, r, i, s, o, u, a;
        var f = 0;
        e = Base64._utf8_encode(e);
        while (f < e.length) {
            n = e.charCodeAt(f++);
            r = e.charCodeAt(f++);
            i = e.charCodeAt(f++);
            s = n >> 2;
            o = (n & 3) << 4 | r >> 4;
            u = (r & 15) << 2 | i >> 6;
            a = i & 63;
            if (isNaN(r)) {
                u = a = 64
            } else if (isNaN(i)) {
                a = 64
            }
            t = t + this._keyStr.charAt(s) + this._keyStr.charAt(o) + this._keyStr.charAt(u) + this._keyStr.charAt(a)
        }
        return t
    }, decode: function (e) {
        var t = "";
        var n, r, i;
        var s, o, u, a;
        var f = 0;
        e = e.replace(/[^A-Za-z0-9\+\/\=]/g, "");
        while (f < e.length) {
            s = this._keyStr.indexOf(e.charAt(f++));
            o = this._keyStr.indexOf(e.charAt(f++));
            u = this._keyStr.indexOf(e.charAt(f++));
            a = this._keyStr.indexOf(e.charAt(f++));
            n = s << 2 | o >> 4;
            r = (o & 15) << 4 | u >> 2;
            i = (u & 3) << 6 | a;
            t = t + String.fromCharCode(n);
            if (u != 64) {
                t = t + String.fromCharCode(r)
            }
            if (a != 64) {
                t = t + String.fromCharCode(i)
            }
        }
        t = Base64._utf8_decode(t);
        return t
    }, _utf8_encode: function (e) {
        e = e.replace(/\r\n/g, "\n");
        var t = "";
        for (var n = 0; n < e.length; n++) {
            var r = e.charCodeAt(n);
            if (r < 128) {
                t += String.fromCharCode(r)
            } else if (r > 127 && r < 2048) {
                t += String.fromCharCode(r >> 6 | 192);
                t += String.fromCharCode(r & 63 | 128)
            } else {
                t += String.fromCharCode(r >> 12 | 224);
                t += String.fromCharCode(r >> 6 & 63 | 128);
                t += String.fromCharCode(r & 63 | 128)
            }
        }
        return t
    }, _utf8_decode: function (e) {
        var t = "";
        var n = 0;
        var r = 0, c1 = 0, c2 = 0;
        while (n < e.length) {
            r = e.charCodeAt(n);
            if (r < 128) {
                t += String.fromCharCode(r);
                n++
            } else if (r > 191 && r < 224) {
                c2 = e.charCodeAt(n + 1);
                t += String.fromCharCode((r & 31) << 6 | c2 & 63);
                n += 2
            } else {
                c2 = e.charCodeAt(n + 1);
                c3 = e.charCodeAt(n + 2);
                t += String.fromCharCode((r & 15) << 12 | (c2 & 63) << 6 | c3 & 63);
                n += 3
            }
        }
        return t
    }
};

function downloadAjax(url)
{
    window.open(url, '_blank');
    window.focus();
}

function reloadBackupList()
{
    jQuery('#advancedbackupTable').dataTable().api().ajax.reload();
    getRecentBackup();
}

function backup() {
    //showLoading('Please wait...');
    isRunning = true;
    jQuery(document).ready(function ($) {
        var backup_type = $('#select_platform_backup').val();
        var bk_prefix = $('#input_prefix_backup').val();
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'easybackup',
                task: 'easybackup',
                cloudbackuptype: backup_type,
                prefix: bk_prefix,
                centnounce: $('#centnounce').val()
            },
            success: function (data) {
                if (data.status == 'fail') {
                    hideLoading();
                    showDialogue(data.errorMsg, O_FAIL, O_OK);
                }else if (data.conti == 1) {
                    contbackup(data.sourcePath, data.outZipPath, data.serializefile);
                }else /*if (typeof data.data == "number" && data.conti == 0 )*/ {
                    $("#new_backup_building").hide();
                    $("#new_backup_building_success").show();
                    ose_cms = data.cms;
                    $("#btn_easy_bk_download").attr('onclick', 'downloadAjax("'+data.downloadLink+'")');
                    $("#span_easy_backup_filename").html(data.backupFileName);
                    $("#span_easy_backup_time").html(moment(data.backupTime).format('MMMM Do YYYY, h:mm:ss a'));
                    $("#span_easy_backup_type").html(getEazyBackupType(data.backupType));
                }
            },
            error: function (request, textStatus, thrownError) {
                hideLoading();
                showDialogue(O_BACKUP_ERROR + thrownError + "<br /><pre>" + request.responseText + "</pre>",
                    O_ERROR, O_OK);
            },
            complete: function(){isRunning = false;}
        })
    })
}

function contbackup(sourcePath, outZipPath, serializefile) {
    showLoading('Archiving files, Please wait...');
    jQuery(document).ready(function ($) {
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'contBackup',
                task: 'contBackup',
                sourcePath: sourcePath,
                outZipPath: outZipPath,
                serializefile: serializefile,
                centnounce: $('#centnounce').val()
            },
            success: function (data) {
                if (data.data == false) {
                    hideLoading();
                    showDialogue(O_BACKUP_FAIL, O_FAIL, O_OK);
                } else if (data.conti == 1) {
                    contbackup(data.sourcePath, data.outZipPath, data.serializefile);

                } else if (data.conti == 0) {
                    showLoading(O_BACKUP_SUCCESS);
                    hideLoading();
                    $('#backupTable').dataTable().api().ajax.reload();
                }
            },
            error: function (request, textStatus, thrownError) {
                hideLoading();
                showDialogue(O_BACKUP_ERROR + thrownError + "<br /><pre>" + request.responseText + "</pre>",
                    O_ERROR, O_OK);
            },
            complete: function(){isRunning = false;}
        })
    })
}

function goback_backupcontent() {
    if (!isRunning){
        jQuery(document).ready(function ($) {
            $("#breadcrumb .breadcrumb-nav:nth-child(2)").hide();
            $("#breadcrumb .breadcrumb-nav:nth-child(3)").hide();
            $("#new_backup_config").hide();
            $("#new_backup_building_success").hide();
            $(".breadcrumb-span").html(O_BACKUP_CREATENEW_STEP1);
            $("#new_backup_setup").show();
        });
    }

}

function setupBackup() {
    jQuery(document).ready(function ($) {
        $(".breadcrumb-span").html(O_BACKUP_CREATENEW_STEP2);
        $("#breadcrumb .breadcrumb-nav:nth-child(2)").show();
        $(".new_backup_content").hide();
        $("#new_backup_config").show();
        checkCloudAuthentication();
    });
}

function backupTypeChange() {
    checkCloudAuthentication();
}

function setConfig() {
    jQuery(document).ready(function ($) {
        $(".breadcrumb-span").html(O_BACKUP_CREATENEW_STEP3);
        $("#breadcrumb .breadcrumb-nav:nth-child(3)").show();
        $(".new_backup_content").hide();
        $("#new_backup_building").show();
        backup();
    });
}

function checkCloudAuthentication() {
    jQuery(document).ready(function ($) {
        var backUpType = $('#select_platform_backup').val();
        $('#btn_build_backup').prop('disabled', 'disabled');

        $("#new_backup_status_content").html('<span><i class="fa fa-refresh fa-spin fa-1x fa-fw margin-bottom"></i>Loading Backup Types...</span>');
        if (backUpType == '1') {
            var html = getNewBackUpStatusHtml('1', '1');
            $('#btn_build_backup').prop('disabled', null);
            $("#new_backup_status_content").html(html);
        }
        else {
            switch (backUpType) {
                case "2":
                    task = "dropBoxVerify";
                    break;
                case "3":
                    task = "oneDriveVerify";
                    break;
                case "4":
                    task = "googleDriveVerify";
                    break;
            }
            $.ajax({
                type: "POST",
                url: url,
                dataType: 'json',
                data: {
                    option: option,
                    controller: controller,
                    action: 'backUpTypesCheck',
                    task: 'task',
                    backup_platform: backUpType,
                    centnounce: $('#centnounce').val()
                },
                success: function (data) {
                    var html = getNewBackUpStatusHtml(backUpType, data.result, data.url);
                    if (data.result == '2' || data.result == '3')
                        $('#btn_build_backup').prop('disabled', disable_build_backup);
                    else
                        $('#btn_build_backup').prop('disabled', null);

                    $("#new_backup_status_content").html(html);
                },
                error: function (request, textStatus, thrownError) {
                    hideLoading();
                    showDialogue(O_BACKUP_ERROR + thrownError + "<br /><pre>" + request.responseText + "</pre>",
                        O_ERROR, O_OK);
                }
            })
        }
    });
}

function getNewBackUpStatusHtml(type, status, url) {
    var html = "";
    html += '<div class="col-md-8 new_backup_pf_info">' +
        '<div class="row backup-config-item">' +
        '<div class="col-md-4" style="font-weight: bold;">Local Backup: </div>' +
        '<div class="col-md-4"><span class="text-success" style="font-weight: bold;">Enabled</span></div>' +
        '</div> ';
    switch (type) {
        //local backup
        case '1':
            break;
        //Dropbox backup
        case '2':
            html += '<div class="row backup-config-item">' +
                '<div class="col-md-4" style="font-weight: bold;">Dropbox&nbspBackup: </div>';
            html += getCloudAuthenticationHtml(type, status, url);
            html += '</div></div>';
            break;
        //One Drive backup
        case '3':
            html += '<div class="row backup-config-item">' +
                '<div class="col-md-4" style="font-weight: bold;">OneDrive&nbspBackup: </div>';
            html += getCloudAuthenticationHtml(type, status, url);
            html += '</div></div>';
            break;
        //Google Drive backup
        case '4':
            html += '<div class="row backup-config-item">' +
                '<div class="col-md-4" style="font-weight: bold;">GoogleDrive&nbspBackup: </div>';
            html += getCloudAuthenticationHtml(type, status, url);
            html += '</div></div>';
            break;

    }

    html += '</div></div>';
    return html;
}

function openAuthenticationWindow(url, backUpType) {
    var url = Base64.decode(url);
    if (url == 'javascript:void(0)' || url == '')
    //window.open('' , '_blank');
        initial_dropboxauth();
    else {
        if (backUpType == 3) {
            var title = O_ONEDRIVE_AUTHO;
            var message = O_ONEDRIVE_AUTHO_DESC;
        }
        else {
            var title = O_GOOGLEDRIVE_AUTHO;
            var message = O_GOOGLEDRIVE_AUTHO_DESC;
        }

        bootbox.dialog({
            message: message,
            title: title,
            buttons: {
                main: {
                    label: 'OK',
                    className: "btn-primary btn-alt",
                    callback: function () {
                        checkCloudAuthentication();
                    }
                }
            }
        });
        window.open(url, '_blank');

    }

}

function initial_dropboxauth() {
    jQuery(document).ready(function ($) {
        showLoading('Getting Request Token....');
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'oauth',
                task: 'oauth',
                type: 'dropbox',
                reload: 'yes',
                centnounce: $('#centnounce').val()
            },
            success: function (data) {
                hideLoading();
                bootbox.dialog({
                    message: O_DROPBOX_AUTHO_DESC2,
                    title: O_DROPBOX_AUTHO,
                    buttons: {
                        main: {
                            label: 'OK',
                            className: "btn-primary btn-alt",
                            callback: function () {
                                showLoadingStatus('Getting Access Token...');
                                oauth_step2(data);
                            }
                        }
                    }
                });

            }
        })
    });
}
function oauth_step2(url) {
    window.open(url);
    hideLoading();
    //document.getElementById('dropbox_authorize').innerHTML = "Continue";
    bootbox.dialog({
        message: O_DROPBOX_AUTHO_DESC3,
        title: O_DROPBOX_AUTHO,
        buttons: {
            main: {
                label: 'OK',
                className: "btn-primary btn-alt",
                callback: function () {
                    showLoadingStatus('Final Authentication...');
                    dropbox_oauth();
                }
            }
        }
    });
}

// dropbox authentication
function dropbox_oauth() {
    jQuery(document).ready(function ($) {
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'oauth',
                task: 'oauth',
                type: 'dropbox',
                centnounce: $('#centnounce').val()
            },
            success: function (data) {
                checkCloudAuthentication();
                hideLoading();
            }
        })
    })
}

//----------logout------------

function dropbox_logout() {
    jQuery(document).ready(function ($) {
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'dropbox_logout',
                task: 'dropbox_logout',
                centnounce: $('#centnounce').val()
            },
            success: function (data) {
                //     document.getElementById('dropbox_authorize').innerHTML = O_DROPBOX_AUTHETICATION;
                //if (cms == 'wordpress') {
                //    window.location = 'admin.php?page=ose_fw_authentication';
                //    window.location.reload;
                //} else {
                //    window.location = 'index.php?option=com_ose_firewall&view=authentication';
                //    window.location.reload;
                //}
                checkCloudAuthentication();
            }
        })
    })
}

function onedrive_logout() {
    jQuery(document).ready(function ($) {
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'onedrive_logout',
                task: 'onedrive_logout',
                centnounce: $('#centnounce').val()
            },
            success: function (data) {
                checkCloudAuthentication();
            }
        })
    })
}

function googledrive_logout() {
    jQuery(document).ready(function ($) {
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'googledrive_logout',
                task: 'googledrive_logout',
                centnounce: $('#centnounce').val()
            },
            success: function (data) {
                checkCloudAuthentication();
                //if (cms == 'wordpress') {
                //    window.location = 'admin.php?page=ose_fw_authentication';
                //    window.location.reload;
                //} else {
                //    window.location = 'index.php?option=com_ose_firewall&view=authentication';
                //    window.location.reload;
                //}
            }
        })
    })
}

function logoutAuthentication(type) {
    switch (type) {
        case 1:
            break;
        case 2:
            dropbox_logout();
            break;
        case 3:
            onedrive_logout();
            break;
        case 4:
            googledrive_logout();
            break;
    }
}

function getCloudAuthenticationHtml(type, authenticate, url) {
    var html = '';
    var icon = '';
    switch (type) {
        case "1":
            break;
        case "2":
            icon += '<i class="fa fa-dropbox"></i>';
            break;
        case "3":
            icon += '<i class="fa fa-windows"></i>';
            break;
        case "4":
            icon += '<i class="fa fa-google"></i>';
            break;
    }

    // authenticated
    switch (authenticate) {

        //authenticated
        case "1":
            html += '<div class="col-md-4">' +
                '<span class="text-success" style="font-weight: bold;">' +
                '<i class="fa fa-check-circle"></i>&nbspAuthenticated' +
                '</span> ' +
                '</div> ' +
                '<div class="col-md-4">' +
                '<a class="btn-warning btn" onclick = "logoutAuthentication(' + type + ')">' + icon + '&nbsp' + 'Logout</a>' +
                '</div>';
            break;
        //not authenticated
        case "2":
            html += '<div class="col-md-4">' +
                '<span class="text-danger" style="font-weight: bold;">' +
                '<i class="fa fa-exclamation-circle"></i>&nbspNot Authenticated' +
                '</span> ' +
                '</div> ' +
                '<div class="col-md-4">' +
                '<a class="btn-primary btn" onclick = "openAuthenticationWindow(\'' + Base64.encode(url) + '\', ' + type + ')">' + icon + '&nbsp' + 'Authentication</a>' +
                '</div>';
            break;
        //not a subscriber
        case "3":
            icon = '<i class="fa fa-credit-card"></i>';
            html += '<div class="col-md-4">' +
                '<span class="text-danger" style="font-weight: bold;">' +
                '<i class="fa fa-exclamation-circle"></i>&nbspNeed Subscription' +
                '</span> ' +
                '</div> ' +
                '<div class="col-md-4">' +
                '<button class="btn btn-danger mr5 mb10" type="button" onClick="location.href=\''+subscriptionLink+'\'"> <i class="im-cart6 mr5"></i> Subscribe Now</button>' +
                '</div>';
            break;

    }

    return html;
}

function redirectNewBackUp(cms) {
    if (ose_cms == 'wordpress') {
        window.location = 'admin.php?page=ose_fw_backup#sectionNew';
        window.location.reload();
    }
    else {
        window.location = 'index.php?option=com_ose_firewall&view=backup#sectionNew';
        window.location.reload();
    }


}

function redirectBackupList(cms) {
    if (ose_cms == 'wordpress') {
        window.location = 'admin.php?page=ose_fw_backup#sectionBKs';
        window.location.reload();
    }
    else {
        window.location = 'index.php?option=com_ose_firewall&view=backup#sectionBKs';
        window.location.reload();
    }
}


//-------------advance backup-----------------
jQuery(document).ready(function ($) {

    dropboxlink = '';
    needSubscription = $("#needsubscription").val();
    subscriptionLink = $("#subscriptionlink").val();
    dropboxauth = $("#dropboxauth").val();
    onedrivelink = '';
    onedriveauth = $("#onedriveauth").val();
    googledrivelink = '';
    googledriveauth = $("#googledriveauth").val();

    if (dropboxauth == 1) {
        dropboxlink = "<div class='clickdropbox'><a href='#' title='Dropbox' class='text-primary fa fa-dropbox'></a></div> ";
        dropboxicon = "<a  title='Dropbox' class='text-primary fa fa-dropbox'></a>&nbsp";
    }
    if (googledriveauth == 1) {
        googledrivelink = "<div class='clickgoogledrive'><a href='#' title='GoogleDrive' class='text-danger fa fa-google'></a></div>";
        googledriveicon = "<a  title='GoogleDrive' class='text-danger fa fa-google'></a>&nbsp";
    }
    if (onedriveauth == 1) {
        onedrivelink = "<div class='clickonedrive'><a href='#' title='OneDrive' class='text-success fa fa-windows'></a></div>";
        onedriveicon = "<a  title='OneDrive' class='text-success fa fa-windows'></a>&nbsp";
    } else if (onedriveauth == 0 && dropboxauth == 0 && googledriveauth == 0) {
        dropboxlink = O_AUTH_CLOUD;
    }
    $('#cloudbackuptype').change(function () {
        iconload();
    });
    $('#advancedbackupTable').dataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: url,
            type: "POST",
            data: function (d) {
                d.option = option;
                d.controller = controller;
                d.action = 'getBackupList';
                d.task = 'getBackupList';
                d.centnounce = $('#centnounce').val();
            }
        },
        columns: [
            {"data": "ID", "visible": false},
            {"data": "time"},
            {"data": "fileName"},
            {"data": "fileType"},
            {
                "data": null,
                "defaultContent": dropboxlink + onedrivelink + googledrivelink,
                "orderable": false, "searchable": false
            },
            { "data": "downloadLink" },
            {"data": null, "defaultContent": " ", "orderable": false, "searchable": false}
        ],
        order: [0, 'desc']
    });
    $('#advancedbackupTable tbody').on('click', 'div.clickdropbox', function () {
        var data = $('#advancedbackupTable').dataTable().api().row($(this).parents('tr')).data();
        var id = data["ID"];
        showLoading(O_PREP_FILES);
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'getDropboxUploads',
                task: 'getDropboxUploads',
                id: id,
                centnounce: $('#centnounce').val()
            },
            success: function (data) {
                if (data.error === null) {
                    multiDropboxUpload(data.numFiles, data.varArray);
                } else {
                    hideLoading();
                    showDialogue(O_UPLOAD_ERROR + "<br /><pre>" + data.error + "</pre>", O_ERROR, O_OK);
                }
            },
            error: function (request, textStatus, thrownError) {
                hideLoading();
                showDialogue(O_UPLOAD_ERROR + thrownError + "<br /><pre>" + request.responseText + "</pre>", O_ERROR, O_OK);
            }
        })
    });

    function multiDropboxUpload(numFiles, varArray) {
        for (index = 0; index < numFiles; ++index) {
            dropboxUpload(varArray[index]['path'], varArray[index]['folder'], numFiles);
        }
    }

    var DBxindex = 0;
    var DBxfiles = 'Uploaded: ';

    function dropboxUpload(path, folder, numFiles) {
        var filename = path.replace(/^.*[\\\/]/, '');
        showLoading('Uploading: ' + filename + '(' + numFiles + ')');
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'dropboxUpload',
                task: 'dropboxUpload',
                path: path,
                folder: folder,
                centnounce: $('#centnounce').val()
            },
            curfile: filename,
            success: function (data) {
                if (data.code == 200) {
                    DBxfiles += this.curfile + "<br />";
                    ++DBxindex;
                    if (numFiles == DBxindex) {
                        hideLoading();
                        showDialogue(O_UPLOAD_DROPBOX + "<br />" + DBxfiles, O_SUCCESS, O_OK);
                        DBxindex = 0;
                        DBxfiles = '';
                    }
                }
                else {
                    hideLoading();
                    ++DBxindex;
                    window.stop();
                    showDialogue(O_UPLOAD_ERROR + "<pre>" + "File: " + this.curfile + "<br />" + data + "</pre>", O_FAIL, O_OK);
                    DBxindex = 0;
                    DBxfiles = '';

                }
            },
            error: function (request, textStatus, thrownError) {
                hideLoading();
                showDialogue(O_UPLOAD_ERROR + thrownError + "<br /><pre>" + request.responseText + "</pre>", O_ERROR, O_OK);
            }
        });
    }

    $("#backup-form").submit(function () {
        showLoading(O_PLEASE_WAIT);
        var data = $("#backup-form").serialize();
        data += '&centnounce=' + $('#centnounce').val();
        $.ajax({
            type: "POST",
            url: url,
            data: data, // serializes the form's elements.
            dataType: 'json',
            success: function (data) {
                if (data.status == 'success') {
                    hideLoading();
                    showDialogue(data.successMsg, O_SUCCESS, O_OK);
                }
                else {
                    hideLoading();
                    showDialogue(data.errorMsg, O_FAIL, O_OK);
                }
                $('#advancedbackupTable').dataTable().api().ajax.reload();
            }
        });
        return false; // avoid to execute the actual submit of the form.
    });

    $('#advancedbackupTable tbody').on('click', 'div.clickonedrive', function () {
        showLoading(O_PREP_FILES);
        var data = $('#advancedbackupTable').dataTable().api().row($(this).parents('tr')).data();
        var id = data["ID"];
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'getOneDriveUploads',
                task: 'getOneDriveUploads',
                id: id,
                centnounce: $('#centnounce').val()
            },
            success: function (data) {
                multiOneDriveUpload(data.numFiles, data.varArray);
            },
            error: function (request, textStatus, thrownError) {
                hideLoading();
                showDialogue(O_UPLOAD_ERROR + thrownError + "<br /><pre>" + request.responseText + "</pre>", O_ERROR, O_OK);
            }
        })
    });

    function multiOneDriveUpload(numFiles, varArray) {
        for (index = 0; index < numFiles; ++index) {
            oneDriveUpload(varArray[index]['path'], varArray[index]['folderID'], numFiles);
        }
    }

    var ODindex = 0;
    var ODfiles = 'Uploaded: ';

    function oneDriveUpload(path, folderID, numFiles) {
        var filename = path.replace(/^.*[\\\/]/, '');
        showLoading('Uploading: ' + filename + '(' + numFiles + ')');
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'oneDriveUpload',
                task: 'oneDriveUpload',
                path: path,
                folderID: folderID,
                centnounce: $('#centnounce').val()
            },
            curfile: filename,
            success: function (data) {
                if (data == true || data === null) {
                    ODfiles += this.curfile + "<br />";
                    ++ODindex;
                    if (numFiles == ODindex) {
                        hideLoading();
                        showDialogue(O_UPLOAD_ONEDRIVE + "<br />" + ODfiles, O_SUCCESS, O_OK);
                        ODindex = 0;
                        ODfiles = '';
                    }
                }
                else {
                    hideLoading();
                    ++ODindex;
                    window.stop();
                    showDialogue(O_UPLOAD_ERROR + "<pre>" + "File: " + this.curfile + "<br />" +
                        data['error']['message'] + "</pre>", O_FAIL, O_OK);
                    ODindex = 0;
                    ODfiles = '';

                }
            },
            error: function (request, textStatus, thrownError) {
                hideLoading();
                //showDialogue(O_UPLOAD_ERROR + thrownError + "<br /><pre>" + request.responseText + "</pre>", O_ERROR, O_OK);
            }
        });
    }

    $('#advancedbackupTable tbody').on('click', 'div.clickgoogledrive', function () {
        showLoading(O_PREP_FILES);
        var data = $('#advancedbackupTable').dataTable().api().row($(this).parents('tr')).data();
        var id = data["ID"];
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'getGoogleDriveUploads',
                task: 'getGoogleDriveUploads',
                id: id,
                centnounce: $('#centnounce').val()
            },
            success: function (data) {
                multiGoogleDriveUpload(data.numFiles, data.varArray);
            },
            error: function (request, textStatus, thrownError) {
                hideLoading();
                showDialogue(O_UPLOAD_ERROR + thrownError + "<br /><pre>" + request.responseText + "</pre>", O_ERROR, O_OK);
            }
        })
    });

    function multiGoogleDriveUpload(numFiles, varArray) {
        for (index = 0; index < numFiles; ++index) {
            googleDriveUpload(varArray[index]['path'], varArray[index]['folderID'], numFiles);
        }
    }

    var GDindex = 0;
    var GDfiles = 'Uploaded: ';

    function googleDriveUpload(path, folderID, numFiles) {
        var filename = path.replace(/^.*[\\\/]/, '');
        showLoading('Uploading: ' + filename + '(' + numFiles + ')');
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'googledrive_upload',
                task: 'googledrive_upload',
                path: path,
                folderID: folderID,
                centnounce: $('#centnounce').val()
            },
            curfile: filename,
            success: function (data) {
                if (data == true || data === null) {
                    GDfiles += this.curfile + "<br />";
                    ++GDindex;
                    if (numFiles == GDindex) {
                        hideLoading();
                        showDialogue(O_UPLOAD_GOOGLEDRIVE + "<br />" + ODfiles, O_SUCCESS, O_OK);
                        GDindex = 0;
                        GDfiles = '';
                    }
                }
                else {
                    hideLoading();
                    ++GDindex;
                    window.stop();
                    showDialogue(O_UPLOAD_ERROR + "<pre>" + "File: " + this.curfile + "<br />" +
                        data['error']['message'] + "</pre>", O_FAIL, O_OK);
                    GDindex = 0;
                    GDfiles = '';
                }
            },
            error: function (request, textStatus, thrownError) {
                hideLoading();
                //showDialogue(O_UPLOAD_ERROR + thrownError + "<br /><pre>" + request.responseText + "</pre>", O_ERROR, O_OK);
            }
        })
    }

    $('#checkbox').prop('checked', false);
    $('#advancedbackupTable tbody').on('click', 'tr', function () {
        $(this).toggleClass('selected');
    });
    $('#checkbox').click(function () {
        if ($('#checkbox').is(':checked')) {
            $('#advancedbackupTable tr').addClass('selected');
        } else {
            $('#advancedbackupTable tr').removeClass('selected');
        }
    });

    $("a.panel-refresh").click(function () {
        $('#advancedbackupTable').dataTable().api().ajax.reload();
    });
});

function sendemail(id) {
    jQuery(document).ready(function ($) {
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'sendemail',
                task: 'sendemail',
                type: 'dropbox',
                id: id,
                centnounce: $('#centnounce').val()
            },
            success: function (data) {
                hideLoading();
                if (data == true) {
                    showDialogue(O_CONFIRM_EMAIL_NOTICE, O_SUCCESS, O_OK);
                }
                else {
                    showDialogue(O_SEND_EMAIL_ERROR, O_FAIL, O_OK);
                }
            },
            error: function (request, textStatus, thrownError) {
                hideLoading();
                showDialogue(O_SEND_EMAIL_ERROR + thrownError + "<br /><pre>" + request.responseText + "</pre>",
                    O_ERROR, O_OK);
            }
        })
    })
}
function ajaxdeletebackup() {
    jQuery(document).ready(function ($) {
        var ids = $('#advancedbackupTable').dataTable().api().rows('.selected').data();
        var multiids = [];
        var index = 0;
        for (index = 0; index < ids.length; ++index) {
            multiids[index] = (ids[index]['ID']);
        }
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: {
                option: option,
                controller: controller,
                action: 'deleteBackup',
                task: 'deleteBackup',
                id: multiids,
                centnounce: $('#centnounce').val()
            },
            success: function (data) {
                if (data == true) {
                    showLoading(O_BACKUP_DELE_DESC);
                    hideLoading(1000);
                } else {
                    showDialogue(O_DELE_FAIL_DESC, O_FAIL, O_OK);
                }
                hideLoading();

                $('#advancedbackupTable').dataTable().api().ajax.reload();
                getRecentBackup();
            },
            error: function (request, textStatus, thrownError) {
                hideLoading();
                showDialogue(O_DELE_FAIL_DESC + thrownError + "<br /><pre>" + request.responseText + "</pre>",
                    O_ERROR, O_OK);
            }
        });
    })
}
function deletebackup() {
    jQuery(document).ready(function ($) {
        ids = $('#advancedbackupTable').dataTable().api().rows('.selected').data();
        if (ids.length > 0) {
            bootbox.dialog({
                message: O_DELETE_CONFIRM_DESC,
                title: O_CONFIRM,
                buttons: {
                    success: {
                        label: O_YES,
                        callback: function () {
                            ajaxdeletebackup();
                        }
                    },
                    main: {
                        label: O_NO,
                        callback: function () {
                            this.close();
                        }
                    }
                }
            });
        } else {
            showDialogue(O_SELECT_FIRST, O_NOTICE, O_OK);
        }
    })
}

function getEazyBackupType(backup_type)
{
    var type = '';
    switch (backup_type) {
        case 'dropbox':
            type = '<a  class="text-warning" title="Local Backup"><i class="fa fa-unlink"></i></a>&nbsp<a  class="text-primary" title="Dropbox Backup"><i class="fa fa-dropbox"></i></a>';
            break;
        case 'local':
            type = '<a  class="text-warning" title="Local Backup"><i class="fa fa-unlink"></i></a>';
            break;
        case 'onedrive':
            type = '<a  class="text-warning" title="Local Backup"><i class="fa fa-unlink"></i></a>&nbsp<a  class="text-success" title="OneDrive Backup"><i class="fa fa-windows"></i></a>';
            break;
        case 'googledrive':
            type = '<a  class="text-warning" title="Local Backup"><i class="fa fa-unlink"></i></a>&nbsp<a  class="text-primary" title="GoogleDrive Backup"><i class="fa fa-google"></i></a>';
            break;
    }

    return type;

}

function iconload() {
    var classname;
    switch ($('#cloudbackuptype').val()) {
        case "1":
            classname = "fa fa-desktop";
            break;
        case "2":
            classname = "fa fa-dropbox";
            break;
        case "3":
            classname = "fa fa-windows";
            break;
        case "4":
            classname = "fa fa-google";
            break;
        default:
            classname = "";
    }
    $('#cloudbackupicon').removeClass().addClass(classname);
}


jQuery(document).ready(function($) {
    var timezone = jstz.determine().name();
    $('#div_scheduled_bk_content').html('<span class = "text-primary"><i class="fa fa-refresh fa-spin fa-1x fa-fw margin-bottom"></i>&nbspLoading Schedule Backup Records</span>');
    if(needSubscription == 1) {
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'getNextSchedule',
                task: 'getNextSchedule',
                centnounce: $('#centnounce').val(),
                timezone: timezone
            },
            success: function (data) {
                if (data.status == "empty") {
                    var html = getScheduledBkEmptyHtml();

                }
                else {
                    var html = getScheduledBkHtml(data.schedule_time);
                }
                $('#div_scheduled_bk_content').html(html);
            },
            error: function (request, textStatus, thrownError) {
                hideLoading();
                showDialogue(thrownError + "<br /><pre>" + request.responseText + "</pre>",
                    O_ERROR, O_OK);
            }
        });
    }
    else{
        var html = getScheduledBKNeedSubHtml();
        $('#div_scheduled_bk_content').html(html);
    }
    getRecentBackup();

});

function getRecentBackup()
{
    jQuery(document).ready(function ($) {
        $('#recent_backup_content').html('<span class = "text-primary"><i class="fa fa-refresh fa-spin fa-1x fa-fw margin-bottom"></i>&nbspLoading Last Backup Records</span>');
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'getRecentBackup',
                task: 'getRecentBackup',
                centnounce: $('#centnounce').val()
            },
            success: function (data) {
                if (data.status == 'Empty') {
                    var html = getLastBackupEmptyHtml();
                    $('#recent_backup_content').html(html);
                }
                else {
                    var html = getLastBackupHtml(data.result);
                    $('#recent_backup_content').html(html);
                }
            },
            error: function (request, textStatus, thrownError) {
                hideLoading();
                showDialogue(thrownError + "<br /><pre>" + request.responseText + "</pre>",
                    O_ERROR, O_OK);
            }
        });
    });
}

function getScheduledBkHtml(schedule_bk_time)
{
    var html = '';
    html += '<div class="row">' +
        '<div class="col-md-2">' +
        '<strong>Files:</strong>' +
        '</div>' +
        '<div class="col-md-10">' +
        '<a  class="text-warning" title="Files">' +
        '<i class="text-primary glyphicon glyphicon-duplicate"></i></a>&nbsp' +
        '<a  class="text-warning" title="DataBase">' +
        '<i class="text-primary glyphicon glyphicon-hdd"></i></a> ' +
        '</div> ' +
        '</div> ' +
        '<div class="row"> ' +
        '<div class="col-md-2"><strong>Types:</strong></div> ' +
        '<div class="col-md-10"> ' +
        '<div id = "div_schedule_bk_types"><a  class="text-warning fa fa-unlink" title="Local Backup"></a>&nbsp'+dropboxicon + onedriveicon + googledriveicon+'</div> ' +
        '</div> ' +
        '</div> ' +
        '<div class="row"> ' +
        '<div class="col-md-2"><strong>Schedule Time:</strong></div> ' +
        '<div class="col-md-10"> ' +
        '<div id = "div_schedule_bk_time"></div> ' +
        '<strong class="color-green" title="'+moment(schedule_bk_time).format('llll')+'">' +
        '<i class="fa fa-clock-o"></i>&nbsp'+moment(schedule_bk_time).startOf('second').from()+'' +
        '</strong> ' +
        '</div> ' +
        '</div>';

    return html;
}

function getScheduledBkEmptyHtml()
{
    var html = '<strong class="text-danger">No Schedule Backup Records Found</strong>';
    return html;
}

function getScheduledBKNeedSubHtml()
{
    var html = '<strong class="text-danger">Need Subscription&nbsp <br><button class="btn btn-danger mr5 mb10" type="button" onClick="location.href=\''+subscriptionLink+'\'"> <i class="im-cart6 mr5"></i> Subscribe Now</button> </strong>';
    return html;
}

function getLastBackupHtml(data)
{
    var html = '<div class="backup-long-desc">' +
        '<div class="row" style="margin-top: 10px;"> ' +
        '<div class="col-md-offset-9"> ' +
        //     '<button class="btn btn-success" onclick="restore('+data.ID+')">Restore</button>&nbsp' +
        '<a class="btn btn-primary" href="'+data.downloadUrl+'" >Download</a>&nbsp' +
        '</div> ' +
        '</div> ' +
        '<div class="row backup-item">' +
        '<div class="col-md-2">' +
        '<strong>Backup Name:</strong>' +
        '</div>' +
        '<div class="col-md-8">' +
        '<strong class="text-primary">'+data.fileName+'</strong>' +
        '</div>' +
        '</div>' +
        '<div class="row backup-item">' +
        '<div class="col-md-2">' +
        '<strong>Backup Time:</strong>' +
        '</div> ' +
        '<div class="col-md-8">' +
        '<i class="fa fa-clock-o"></i>&nbsp<strong>'+moment(data.time).format('MMMM Do YYYY, h:mm:ss a')+'</strong>' +
        '</div> ' +
        '</div>' +
        '<div class="row backup-item">' +
        '<div class="col-md-2">' +
        '<strong>Backup Platforms:</strong>' +
        '</div>' +
        '<div class="col-md-8">' +
        '<a  class="text-warning fa fa-unlink" title="Local Backup"></a>&nbsp' +
        dropboxicon + onedriveicon + googledriveicon +
        '</div>' +
        '</div>' +
        '<div class="row backup-item"> ' +
        '<div class="col-md-2"> ' +
        '<strong>Backup Files:</strong>' +
        '</div>' +
        '<div class="col-md-8">' +
        '<a  class="text-warning" title="Files"><i class="text-primary glyphicon glyphicon-duplicate"></i></a>&nbsp<a  class="text-warning" title="DataBase"><i class="text-primary glyphicon glyphicon-hdd"></i></a> ' +
        '</div> ' +
        '</div> ' +
        '</div>';
    return html;
}

function getLastBackupEmptyHtml()
{
    var html = '<strong class="text-danger">No Backup Records Found</strong>';
    return html;
}

function restore(id) {
    showLoading('Please wait...');
    jQuery(document).ready(function ($) {
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'restore',
                task: 'restore',
                backup_id:id,
                centnounce: $('#centnounce').val()
            },
            success: function (data) {
                if (data.status = 'Completed') {
                    showLoading(O_RESTORE_SUCCESS);
                } else {
                    showLoading(O_RESTORE_FAIL);
                }
                hideLoading();
            },
            error: function (request, textStatus, thrownError) {
                hideLoading();
                showDialogue(O_BACKUP_ERROR + thrownError + "<br /><pre>" + request.responseText + "</pre>",
                    O_ERROR, O_OK);
            }
        })
    })
}
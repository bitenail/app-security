var controller = "gitbackup";
var option = "com_ose_firewall";
var url = ajaxurl;

jQuery(document).ready(function ($) {
    addHiddenalues(0,0);
    addHiddenaluesRollback(0,0,0);
    var gitBackupDataTable = $('#gitBackupTable').dataTable({
        processing: true,
        serverSide: true,
        paging: false,
        bFilter: false,
        ajax: {
            url: url,
            type: "POST",

            data: function (d) {
                d.option = option;
                d.controller = controller;
                d.action = 'getGitLog';
                d.task = 'getGitLog';
                d.centnounce = $('#centnounce').val();
            }
        },
        columns: [
            {"data": "id"},
            {"data": "commitTime"},
            {"data": "commitID"},
            {"data": "commitMsg"},
            {"data": "rollback"},
            {"data": "zipDownload"},

        ]
    });
    $('#gitBackupTable tbody').on('click', 'tr', function () {
        $(this).toggleClass('selected');
    });
});

//initialise the git and copy the git log to the db
function enableGitBackup() {
    showLoading("The system is now initialising gitbackup  " +
        "<br/>  Please Wait......");
    backupDatabase('init'); return;
    }

//generates a backup of all the files and commits them in the repo after checking the status
function createBackupAllFiles() {
    hideLoading();
    jQuery('#commitMessageModal').modal();
}

//form to accept user message for the backup amd stores that in the session variable
jQuery(document).ready(function ($) {
    $("#commitMessage-form").submit(function () {
        var message = document.getElementById("message").value;
        if(!/^[a-zA-Z0-9 _]+$/.test(message))
        {
            $("#errormessage").text("PLEASE ENTER ALPHANUMERIC CHARACTERS ONLY");
            return false;
        }
        else {
            showLoading('Please wait...');
            var data = $("#commitMessage-form").serialize();
            data += '&centnounce=' + $('#centnounce').val();
            data += '&commitmessage=' + message;
            $.ajax({
                type: "POST",
                url: url,
                dataType: 'json',
                data: data, // serializes the form's elements.
                success: function (data) {
                    if (data.status) {
                        $('#commitMessageModal').modal('hide');
                        showLoading("The system is now generating a backup of the complete website and the database." +
                            " <br/>  Please Wait......");
                        //check view hiddden
                        push=document.getElementById("push").value;
                        zip = document.getElementById("zip").value;
                        push = (push === undefined) ? 0 : push;
                        zip = (zip === undefined) ? 0 : zip;
                        rollback=document.getElementById("rollback").value;
                        recall=document.getElementById("recall").value;
                        commitid=document.getElementById("commitid").value;
                        rollback = (rollback === undefined) ? 0 : rollback;
                        recall = (recall === undefined) ? 0 : recall;
                        commitid = (commitid === undefined) ? 0 : commitid;
                        //localBackup("commit");
                        backupDatabase('commit',push,zip,rollback,recall,commitid);
                        return;
                    }
                }
            });
            return false; // avoid to execute the actual submit of the form.
        }
    });
});

function confirmRollback(commitHead)
{
    bootbox.dialog({
        message: "Do you want to restore the database of "+commitHead+ "<br/>" +
        "<h6><span class =\"text-danger\">It is highly recommended that you should should NOT restore the old database</span></h6>",
        title: "Confirmation",
        buttons: {
            success: {
                label: "Yes",
                className: "btn-success",
                callback: function() {
                    //rollback(commitHead, "old");
                    addHiddenaluesRollback(1,0,commitHead); //0=> old database
                    createBackupAllFiles();

                }
            },
            danger: {
                label: "No",
                className: "btn-danger",
                callback: function() {
                    //rollback(commitHead, "new");
                    addHiddenaluesRollback(1,1,commitHead); //1=>new databse
                    createBackupAllFiles();

                }
            },
            main: {
                label: "Close",
                className: "btn-primary",
                callback: function() {
                    window.close();
                }
            }
        }
    });
}

//rollback mechanism to reset back to an old backup
function gitRollback(commitHead , recall) {
    showLoading("The system is now rolling back <br/> Please Wait......");
    jQuery(document).ready(function ($) {
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'gitRollback',
                task: 'gitRollback',
                commitHead: commitHead,
                recall: recall,
                centnounce: $('#centnounce').val()
            },
            success: function (data) {
                if (data.status == 1) {
                    hideLoading(10);
                    jQuery('#gitBackupTable').dataTable().api().ajax.reload();
                    addHiddenaluesRollback(0,0,0);
                    showDialogue("The system has been rolled back to "+ commitHead , "UPDATE", "close");
                }
                else {
                    hideLoading(10);
                    addHiddenaluesRollback(0,0,0);
                    showDialogue(data.info, "ERROR", "close");
                }
            }
        });
    });
}
function backupDatabase(type, push,zip,rollback,recall,commitid) {
    showLoading("The system is now backing up your website <br/> please wait......");
    push = (push === undefined) ? 0 : push;
    zip = (zip === undefined) ? 0 : zip;
    rollback = (rollback === undefined) ? 0 : rollback;
    recall = (recall === undefined) ? 0 : recall;
    commitid = (commitid === undefined) ? 0 : commitid;
    jQuery(document).ready(function ($) {
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'backupDB',
                task: 'backupDB',
                type: type,
                push: push,
                centnounce: $('#centnounce').val()
            },
            success: function (data) {
               if (data.table) {
                   contBackupDB(data.table, data.type, push,zip,rollback,recall,commitid);
               }
               else if(data.result.status  == 1)
               {
                   hideLoading(10);
                   showDialogue("The Backup has been Created Successfully" , "SUCCESS", "close");
                   setTimeout(1000);
                   location.reload();
               }
               else {
                   addHiddenalues(0,0);
                   addHiddenaluesRollback(0,0,0);
                   hideLoading(10);
                   showDialogue("The git could not backup the website, please contact the support team." , "ERROR", "close");
               }
            }
        });
    });
}


function contBackupDB(table, type, push,zip,rollback, recall,commitid) {
    showLoading("The system is now backing up " +table+
        " <br/>  Please Wait......");
    push = (push === undefined) ? 0 : push;
    zip = (zip === undefined) ? 0 : zip;
    rollback = (rollback === undefined) ? 0 : rollback;
    recall = (recall === undefined) ? 0 : recall;
    commitid = (commitid === undefined) ? 0 : commitid;
    jQuery(document).ready(function ($) {
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'contBackupDB',
                task: 'contBackupDB',
                table: table,
                type: type,
                centnounce: $('#centnounce').val()
            },
            success: function (data) {
                if (data.table) {
                    contBackupDB(data.table, data.type, push,zip,rollback,recall,commitid);
                } else {
                    localBackup(type,push,zip,rollback,recall,commitid);
                }
            }
        });
    });
}
//TODO : manage the type variable
function localBackup(type,push,zip,rollback,recall,commitid) {
    type = (type === undefined) ? 0 : type;
    push = (push === undefined) ? 0 : push;
    zip = (zip === undefined) ? 0 : zip;
    rollback = (rollback === undefined) ? 0 : rollback;
    recall = (recall === undefined) ? 0 : recall;
    commitid = (commitid === undefined) ? 0 : commitid;
    jQuery(document).ready(function ($) {
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'localBackup',
                task: 'localBackup',
                type : type,
                centnounce: $('#centnounce').val()
            },
            success: function (data) {
                if(data.status == 1)
                {
                    contLocalBackup(type,push,zip,rollback,recall,commitid);
                }
                else if(data.status == 2)
                {
                    hideLoading();
                    showDialogue("There are no new changes ", "UPDATE", "close");
                }
                else {
                    addHiddenalues(0,0);
                    addHiddenaluesRollback(0,0,0);
                    hideLoading();
                    showDialogue(data.info, "ERROR", "close");
                }
            }
        });
    });
}

function contLocalBackup(type,push,zip,roll_back,recall,commitid)
{
    type = (type === undefined) ? 0 : type;
    push = (push === undefined) ? 0 : push;
    zip = (zip === undefined) ? 0 : zip;
    roll_back = (roll_back === undefined) ? 0 : roll_back;
    recall = (recall === undefined) ? 0 : recall;
    commitid = (commitid === undefined) ? 0 : commitid;
    jQuery(document).ready(function ($) {
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'contLocalBackup',
                task: 'contLocalBackup',
                type : type,
                centnounce: $('#centnounce').val()
            },
            success: function (data) {
                if(data.status == 1)
                {
                    //call contlocalbackup
                    contLocalBackup(type,push,zip,roll_back,recall,commitid);
                }
                else if(data.status == 4 || data.status ==2)  //4 to indicate the end of the backup loop and 2 to indicate there no new chnages
                {
                    //SUCCESS
                    switch(type){
                        case 'init' :
                            if(data.status == 4 || data.status ==2 ){
                                hideLoading(10);
                                showDialogue("The git has been initialised for the website" , "UPDATE", "close");
                                setTimeout(1000);
                                location.reload();
                            }
                            else {
                                hideLoading(10);
                                showDialogue(data.info ,"ERROR", "close");
                            }
                        break;

                        case 'commit' :
                        default :
                            if(roll_back == 1)
                            {
                                if(data.status == 4 || data.status ==2 )
                                {
                                    if(recall == 1)
                                    {
                                        gitRollback(commitid, "new");
                                    }
                                    else
                                    {
                                        gitRollback(commitid, "old");
                                       
                                    }

                                }
                                else {
                                    //ERROR WITH THE COMMIT IN THE ROLLBACK
                                    addHiddenaluesRollback(0,0,0);
                                    hideLoading(10);
                                    showDialogue(data.info, "ERROR", "close");
                                }

                            }
                            else if(push == 1) {
                                //need to push after commit is successfull
                                //hideLoading();
                                if(data.status == 4 || data.status ==2 ){
                                    //if commit was successfull
                                    //gitCloudPush(zip);
                                    var finalpush = 1;
                                    gitCloudBackup(zip, finalpush);
                                }
                                else
                                {
                                    addHiddenalues(0,0);
                                    //problems with the commit , backup will not be pushed
                                    hideLoading(10);
                                    showDialogue(data.info, "ERROR", "close");
                                }
                            }
                            else {
                                //complete the local backup and download the zip => for the free users
                                if(data.status == 4 || data.status ==2 )
                                {
                                    if(zip ==1)
                                    {
                                        websiteZipBackup();
                                    }
                                    else
                                    {
                                        hideLoading(10);
                                        showDialogue("The Backup has been Created Successfully" , "SUCCESS", "close");
                                        setTimeout(1000);
                                        location.reload();
                                    }
                                }
                                else {
                                    hideLoading(10);
                                    showDialogue(data.info, "ERROR", "close");
                                }
                            }
                        break;
                    }

                }
                else {
                    //ERROR
                    addHiddenalues(0,0);
                    addHiddenaluesRollback(0,0,0);
                    hideLoading(10);
                    showDialogue(data.info, "ERROR", "close");
                }
            }
        });
    });
}

function gitCloudBackup(zip,finalpush) {
    showLoading("The system is now uploading the backup to the cloud " +
        "<br/>  Please Wait......");
    zip = (zip === undefined) ? 0 : zip;
    finalpush = (finalpush === undefined) ? 0 : finalpush;
    jQuery(document).ready(function ($) {
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'gitCloudCheck',
                task: 'gitCloudCheck',
                centnounce: $('#centnounce').val()
            },
            success: function (data) {
                if (data) {
                    if(finalpush == 0)
                    {
                        gitCloudPush(zip);
                    }else
                    {
                        finalGitPush(zip);
                    }
                } else {
                    hideLoading(10);
                    $('#bitBucketModal').modal();
                }
            }
        });
    });
}
function gitCloudPush(zip) {
    zip = (zip === undefined) ? 0 : zip;
    showLoading("The system is now uploading the backup to the cloud " +
        " <br/> Please Wait......");
    jQuery(document).ready(function ($) {
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'gitCloudPush',
                task: 'gitCloudPush',
                centnounce: $('#centnounce').val()
            },
            success: function (data) {
                if(data.status == 1) {
                    addHiddenalues(0,0);
                    if(zip == 1){
                        websiteZipBackup();
                    }else {
                        hideLoading();
                        showDialogue("A copy of backup is stored on the cloud", "UPDATE", "close");
                        setTimeout(1000);
                        location.reload();
                    }
                }
                else
                if(data.status == 2)
                {
                    //assign value to the view push and zip
                    addHiddenalues(1,zip);
                    createBackupAllFiles();
                }
                else
                if(data.status == 3)
                { //FREE USERS
                    hideLoading(10);
                    addHiddenalues(0,0);
                    $("#pop_subscription").fadeIn();
                }
                else
                {
                    hideLoading();
                    addHiddenalues(0,0);
                    showDialogue(data.info, "ERROR", "close");
                }
            }
        });
    });
}

//commit all the code and pushes them directly to the repository
function finalGitPush(zip) {
    showLoading("The system is now uploading the backup to the cloud " +
        "  Please Wait......");
    zip = (zip === undefined) ? 0 : zip;
    jQuery(document).ready(function ($) {
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'finalGitPush',
                task: 'finalGitPush',
                centnounce: $('#centnounce').val()
            },
            success: function (data) {
                if (data.status == 1) {
                    //SUCCESS
                    addHiddenalues(0,0);
                        //push was successfull
                        if(zip == 1)
                        {
                            websiteZipBackup();
                        }else {
                            hideLoading();
                            showDialogue("A copy of backup is stored on the cloud", "UPDATE", "close");
                            setTimeout(1000);
                            location.reload();

                        }
                }else
                     if(data.status == 3)
                    { //FREE USERS
                        hideLoading(10);
                        addHiddenalues(0,0);
                        $("#pop_subscription").fadeIn();
                    }
                    else
                     {  //ERROR IN THE FINAL GIT PUSH
                        hideLoading();
                        addHiddenalues(0,0);
                        showDialogue(data.info, "ERROR", "close");
                    }
            }
        });
    });
}

jQuery(document).ready(function ($) {
        $("#pop_subscription").hide();
        $("#git_pre_info").click(function() {
            $("#pop_subscription").fadeIn();
        });
        $("#subscribe-button").click(function() {
            $("#pop_subscription").fadeIn();
        });
        $("#pop_close").click(function() {
            $("#pop_subscription").fadeOut();
        });
});

function websiteZipBackup() {
    showLoading("The system is now generating the Zip file of the website " +
        " <br/> Please Wait......");
    jQuery(document).ready(function ($) {
        $.ajax({
            type: "GET",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'websiteZipBackup',
                task: 'websiteZipBackup',
                centnounce: $('#centnounce').val()
            },
            success: function (data) {
                if (data.status == 1 ) {
                    downloadzip();
                } else {
                    addHiddenalues(0,0);
                    hideLoading();
                    showDialogue(data.message, "ERROR", "close");
                }
            }
        });
    });
}

function downloadzip() {
    showLoading("The system is now preparing to download the Zip file of the website " +
        "<br/> Please Wait......");
    jQuery(document).ready(function ($) {
        $.ajax({
            type: "GET",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'getZipUrl',
                task: 'getZipUrl',
                centnounce: $('#centnounce').val()
            },
            success: function (data) {
                hideLoading();
                var win = window.open(data.url, '_blank');
                win.focus();
                addHiddenalues(0,0);
            }
        });
    });
}
//function called by cron jobs every 1 hour to delete the old zip file of the backup
function deleteZipBakcupFile() {
    jQuery(document).ready(function ($) {
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'deleteZipBakcupFile',
                task: 'deleteZipBakcupFile',
                centnounce: $('#centnounce').val()
            },
            success: function (data) {
                if(data.status == 1)
                {
                    //alert("The zip backup file has been deleted");
                }else
                {
                    showDialogue("The zip Backup file does not exists", "ERROR", "close");
                }
            }
        });
    });
}
function discardChanges(zip) {
    zip = (zip === undefined) ? false : zip;
    jQuery(document).ready(function ($) {
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'discardChanges',
                task: 'discardChanges',
                centnounce: $('#centnounce').val()
            },
            success: function (data) {
                if(data.status == 1){
                    if(zip ==1)
                    {
                        websiteZipBackup();
                    }
                }
                else {
                    showDialogue(data.info, "ERROR", "close");
                }

            }
        });
    });
}


function findChanges() {
    jQuery(document).ready(function ($) {
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'findChanges',
                task: 'findChanges',
                centnounce: $('#centnounce').val()
            },
            success: function (data) {
                if(data.status == 1)
                {
                    bootbox.dialog({
                        message: "There are some unsaved changes do you want to keep them ?",
                        title: "Confirmation",
                        buttons: {
                            success: {
                                label: "Yes",
                                className: "btn-success",
                                callback: function() {
                                    //if you have changes and the user wants to keep them
                                    //push the changes first and then genrate a backup
                                    if(data.subscription == 0)
                                    { // for free users commit the changes and download the zip
                                        addHiddenalues(0,1);
                                        createBackupAllFiles();
                                    }
                                    else {
                                        //premium users will push the changes
                                        addHiddenalues(1,1);
                                        gitCloudBackup(1); // 1 to indicate its a zip backup request
                                    }

                                }
                            },
                            danger: {
                                label: "No",
                                className: "btn-danger",
                                callback: function() {
                                    discardChanges(1);
                                }
                            },
                            main: {
                                label: "Close",
                                className: "btn-primary",
                                callback: function() {
                                    window.close();
                                }
                            }
                        }
                    });
                }
                else
                { //if there are no changes
                    showLoading("The system is now preparing to download the Zip file of the website " +
                        " <br/> Please Wait......");
                    websiteZipBackup();
                }
            }
        });
    });
}

function viewChangeHistory(commitid) {

    jQuery(document).ready(function ($) {
        $.ajax({
            type: "GET",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'viewChangeHistory',
                task: 'viewChangeHistory',
                commitid: commitid,
                centnounce: $('#centnounce').val()
            },
            success: function (data) {
                if (data.status == 1) {
                    //alert(data.files);
                    var filelist ='' ;
                    for(var i=0; i<data.files.length; ++i) {
                        filelist = filelist+data.files[i] + '<br/>';
                        }
                        bootbox.dialog({
                            message: "Date :" + data.date + "<br>" + "Files changed: " + filelist,
                            title: "Details",
                            buttons: {
                                main: {
                                    label: "Close",
                                    className: "btn-primary",
                                    callback: function () {
                                        window.close();
                                    }
                                }
                            }
                        });

                }else if(data.status == 0)
                {
                    //ERROR
                    showDialogue(data.info, "ERROR", "close");
                }
                else {
                    $("#pop_subscription").fadeIn();
                }
            }

        });
    });
}

function addHiddenalues(push, zip) {
    jQuery(document).ready(function ($) {
        $("#push").val(push);   //1
        $("#zip").val(zip);
    });
}

function addHiddenaluesRollback(rollback, recall,commitid) {
    jQuery(document).ready(function ($) {
        $("#rollback").val(rollback);
        $("#recall").val(recall);
        $("#commitid").val(commitid);
    });
}

jQuery(document).ready(function($){

    $('#carousel-generic').carousel({
        interval: false
    });

    getLastBackupTime();
   $('#close-msg-box').click(function(){
       $("#msg-box").fadeOut();
       }
   );
    $('.git-backup-infoTag .text-success .glyphicon .glyphicon-info-sign').click(function(){
            $("#pop_subscription").fadeIn();
        }
    );
});

function getLastBackupTime() {
    jQuery(document).ready(function ($) {
        $.ajax({
            type: "GET",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'getLastBackupTime',
                task: 'getLastBackupTime',
                centnounce: $('#centnounce').val()
            },
            success: function (data) {
                var time = data.commitTime;
                time = time.substring(0,time.length - 5);
                $('#backup-time').text(time);
            }
        });
    });
}



//
//function userSubscriptionStatus() {
//    jQuery(document).ready(function ($) {
//        $.ajax({
//            type: "GET",
//            url: url,
//            dataType: 'json',
//            data: {
//                option: option,
//                controller: controller,
//                action: 'userSubscription',
//                task: 'userSubscription',
//                centnounce: $('#centnounce').val()
//            },
//            success: function (data) {
//                alert(data.status);
//                return data.status;
//            }
//        });
//    });
//}

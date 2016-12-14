var url = ajaxurl;
var controller = "cfscan";
var option = "com_ose_firewall";

jQuery(document).ready(function ($) {
    $('#board').html('');
    $('#customscan').on('click', function () {
        var element = $('#FileTreeDisplay');
        element.html('<ul class="filetree start"><li class="wait">' + 'Generating Tree...' + '<li></ul>');
        getfilelist(element, '');
        element.on('click', 'LI', function () { /* monitor the click event on foldericon */
            var entry = $(this);
            var current = $(this);
            var id = 'id';
            getfiletreedisplay(entry, current, id);
            return false;
        });
        element.on('click', 'LI A', function () { /* monitor the click event on links */
            document.getElementById("cms").value = "";
            document.getElementById("version").value = "";
            document.getElementById("save-button").disabled = true;
            $('#board').html('');
            var currentfolder;
            var current = $(this);
            currentfolder = current.attr('id');
            $("#selected_file").val(currentfolder);
            $.ajax({
                type: "POST",
                url: url,
                dataType: 'json',
                data: {
                    option: option,
                    controller: controller,
                    action: 'suitePathDetect',
                    task: 'suitePathDetect',
                    scanPath: $('#selected_file').val(),
                    centnounce: $('#centnounce').val()
                },
                success: function (data) {
                    if (data.cms == 'wp') {
                        $('#board').html(data.message);
                        document.getElementById("save-button").disabled = false;
                        document.getElementById("cms").value = "wp";
                        document.getElementById("version").value = data.version;
                    } else if (data.cms == 'jm') {
                        $('#board').html(data.message);
                        document.getElementById("save-button").disabled = false;
                        document.getElementById("cms").value = "jm";
                        document.getElementById("version").value = data.version;
                    }
                }
            });
            return false;
        });
    });

    $("#selected_file").bind("change paste keyup", function () {
        document.getElementById("cms").value = "";
        document.getElementById("version").value = "";
        document.getElementById("save-button").disabled = true;
        $('#board').html('');
        if (!$(this).val()) {                      //if it is blank.

        } else {
            $.ajax({
                type: "POST",
                url: url,
                dataType: 'json',
                data: {
                    option: option,
                    controller: controller,
                    action: 'suitePathDetect',
                    task: 'suitePathDetect',
                    scanPath: $('#selected_file').val(),
                    centnounce: $('#centnounce').val()
                },
                success: function (data) {
                    if (data.cms == 'wp') {
                        $('#board').html(data.message);
                        document.getElementById("save-button").disabled = false;
                        document.getElementById("cms").value = "wp";
                        document.getElementById("version").value = data.version;
                    } else if (data.cms == 'jm') {
                        $('#board').html(data.message);
                        document.getElementById("save-button").disabled = false;
                        document.getElementById("cms").value = "jm";
                        document.getElementById("version").value = data.version;
                    }
                }
            });
        }
    });

    $("#scan-form").submit(function () {
        $('#scanModal').modal('hide');
        showLoading();
        var data = $("#scan-form").serialize();
        data += '&centnounce=' + $('#centnounce').val();
        $.ajax({
            type: "POST",
            url: url,
            data: data, // serializes the form's elements.
            dataType: 'json',
            success: function (data) {
                hideLoading();
                for (var prop in data) {
                    if (data.hasOwnProperty(prop)) {
                                switch (prop) {
                                    case 'summary' :
                                        $('#summary').html('<strong>Scan Summary</strong>: <br>' + data[prop]);
                                        break;
                                    case 'modified' :
                                        $('#modified').html('<strong>Detected modified core files</strong>: <br>' + data[prop]);
                                        break;
                                    case 'missing' :
                                        $('#missing').html('<strong>Detected missing files</strong>: <br>' + data[prop]);
                                        break;
                                    case 'suspicious' :
                                        $('#suspicious').html('<strong>Detected suspicious files</strong>: <br>' + data[prop]);
                                        break;
                                }
                            }
                }
            }
        });
        return false; // avoid to execute the actual submit of the form.
    });
});

function cfscan() {
    jQuery(document).ready(function ($) {
        showLoading();
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'cfscan',
                task: 'cfscan',
                centnounce: $('#centnounce').val()
            },
            success: function (data) {
                hideLoading();
                if (cms == 'wordpress') {
                    if (data.status == 'Completed') {
                        $('#p4text').html(data.summary);
                        if (data.count1 != 0) {
                            $('#modified').html('<strong>Detected modified core files</strong>: <br>' + data.modified);
                        }
                        if (data.count2 != 0) {
                            $('#suspicious').html('<strong>Detected suspicious files</strong>: <br>' + data.suspicious);
                        }
                    } else {
                        $('#p4text').html(data.summary);
                        $('#modified').html(data.details);
                    }
                } else {
                    if (data.status == 'Completed') {
                        $('#p4text').html(data.summary);
                        if (data.count1 != 0) {
                            $('#modified').html('<strong>Detected modified core files</strong>: <br>' + data.modified);
                        }
                        if (data.count2 != 0) {
                            $('#suspicious').html('<strong>Detected suspicious files</strong>: <br>' + data.suspicious);
                        }
                        if (data.count3 != 0) {
                            $('#missing').html('<strong>Detected missing files</strong>: <br>' + data.missing);
                        }
                    } else {
                        $('#p4text').html(data.summary);
                        $('#modified').html(data.details);
                    }
                }
            }
        });
    });
}
function toggleChangelist(sitename) {
    jQuery(document).ready(function ($) {
        var changelist = $('#changelist' + sitename);
        var showmenu = $('#btnshowmenu' + sitename);
        if (changelist.hasClass('collapsed')) {
            changelist.slideDown({duration: 300});
            changelist.removeClass('collapsed').addClass('expanded');
            showmenu.attr('title', 'Hide Changelog');
        } else if (changelist.hasClass('expanded')) {
            changelist.slideUp({duration: 300});
            changelist.removeClass('expanded').addClass('collapsed');
            showmenu.attr('title', 'Show Changelog');
        }
    });
}

function catchVirusMD5() {
    jQuery(document).ready(function ($) {
        showLoading();
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'catchVirusMD5',
                task: 'catchVirusMD5',
                centnounce: $('#centnounce').val()
            },
            success: function (data) {
                hideLoading();
                if (data.status == 'update') {
                    showDialogue(O_VSPATTERN_UPDATE, O_SUCCESS, O_OK);
                } else {
                    showDialogue(O_VSPATTERN_UPDATE_FAIL, O_FAIL, O_OK);

                }
            }
        });
    });
}

function addToAi(id) {
    jQuery(document).ready(function ($) {
        showLoading();
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'addToAi',
                task: 'addToAi',
                id: id,
                centnounce: $('#centnounce').val()
            },
            success: function (data) {
                hideLoading();
            }
        });
    });
}
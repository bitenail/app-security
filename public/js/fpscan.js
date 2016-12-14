var url = ajaxurl;
var controller = "fpscan";
var option = "com_ose_firewall";
var isRunning = false;
jQuery(document).ready(function ($) {
    $('#scan_progress').hide();
    fpscan(1, 'getLastScanRecord');
    $('#sfsstart').on('click', function () {
        $("#scan-result").hide();
        $('#surfcalltoaction').hide();
        showLoading(O_LOADING_TEXT);
        isRunning = true;
        $('#sfsstop').show();
        fpscan(1, 'fpscan');
    });
    $('#sfsstop').on('click', function () {
        if (isRunning) {
            isRunning = false;
            showLoading(O_TERMINATE_SCAN);
            location.reload();
        }
    });
    $('#selected_file').val(''); //reset on refresh
    $('#save-button').on('click', function () {
        $('#scanPathModal').modal('hide');
        $('#scanpathtext').show();
        $('#selectedfile').text($('#selected_file').val());
    });

    $( "#filePerm" ).click(function() {
        openpermselector ('#filePerm');
    });

    $('#folderPerm').on('click', function (){
        openpermselector ('#folderPerm');
    });

    function openpermselector (inputfield){
        $( "#popoverhiddenhtml" ).dialog({
            title : $('label[for="'+$(inputfield).attr('id')+'"]').text(),
            open: true,
            modal : true,
            resizeable : false,
            buttons: {
                "OK": function() {
                    $( this ).dialog( "close" );
                    var val = '0' + document.fmode.u.value + document.fmode.g.value + document.fmode.w.value;
                    $ (inputfield).val(val);
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
        return false;
    }
});
jQuery(document).ready(function ($) {
    $('#FileTreeDisplay').html('<ul class="filetree start"><li class="wait">' + 'Generating Tree...' + '<li></ul>');
    getfilelist($('#FileTreeDisplay'), '');
    $('#FileTreeDisplay').on('click', 'LI', function () { /* monitor the click event on foldericon */
        var entry = $(this);
        var current = $(this);
        var id = 'id';
        getfiletreedisplay(entry, current, id);
        return false;
    });
    $('#FileTreeDisplay').on('click', 'LI A', function () { /* monitor the click event on links */
        var currentfolder;
        var current = $(this);
        currentfolder = current.attr('id');
        $("#selected_file").val(currentfolder);
        return false;
    });
});
function fpscan(step, action) {
    jQuery(document).ready(function ($) {
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                step: step,
                action: action,
                task: action,
                scanPath: $('#selected_file').val(),
                baseFilePerm: $('#filePerm').val(),
                baseFolderPerm: $('#folderPerm').val(),
                centnounce: $('#centnounce').val()
            },
            success: function (data) {
                hideLoading();
                //update virus list
                if (typeof data.invalid !== 'undefined' && data.invalid !== null) {
                    showDialogue(data.summary, O_FAIL, O_OK)
                }

                if (typeof data.content !== 'undefined' && data.content !== null) {
                    if (typeof data.content[0] !== 'undefined' && data.content[0] !== null) {
                        setscanResult(data.content);
                    }
                }

                //update status
                if (typeof data.status !== 'undefined' && data.status !== null) {
                    setscanstatus(data.status);

                    //check for next step
                    if (typeof data.status.cont !== 'undefined' && data.status.cont == true) {
                        fpscan(data.status.step, action)
                    } else {
                        isRunning = false;
                        $('#sfsstop').hide();
                    }
                }

                //update scanDate
                if (typeof data.scanDate !== 'undefined' && data.scanDate !== null) {
                    $('#scan-date').text(
                        moment(ko.unwrap(data.scanDate)).startOf('second').from(ko.unwrap(data.serverNow))
                    ).attr("title", moment(ko.unwrap(data.scanDate)).format('llll'));
                }
            }
        });
        function setscanResult(array) {
            $("#scan-result").show();
            $("#scan-result-panel").html(array.map(function (value) {
                return ('<span class="col-md-12"> ' + value + '</span>');
            }).join(""));
        }

        function setscanstatus(status) {
            $('#last_file').text(status.current_scan);
            $('#total_number').text(status.total_scan);
            $('#vs_num').text(status.total_vs);
            $('#status_content').show();
            $('#scan_progress').show();

            if (status.progress >= 100) {
                $('#vs_progress').attr({
                    "aria-valuenow": 100, style: "width: 100%"
                }).removeClass().addClass("progress-bar progress-bar-success").text(O_SCAN_COMPLETE)
                    .parent().removeClass("progress-striped active");
                if (status.total_vs > 0) {
                    $('#surfcalltoaction').show();
                }
                $('#last_batch').hide();
            } else {
                $('#vs_progress').attr({
                    "aria-valuenow": status.progress, style: "width: " + status.progress + "%"
                }).removeClass("progress-bar-success").text(status.progress + "%")
                    .parent().addClass("progress-striped active");
            }
        }
    });
}

function calcperm() {
    document.fmode.u.value = 0;
    if (document.fmode.ur.checked) {
        document.fmode.u.value = document.fmode.u.value * 1 + document.fmode.ur.value * 1;
    }
    if (document.fmode.uw.checked) {
        document.fmode.u.value = document.fmode.u.value * 1 + document.fmode.uw.value * 1;
    }
    if (document.fmode.ux.checked) {
        document.fmode.u.value = document.fmode.u.value * 1 + document.fmode.ux.value * 1;
    }
    document.fmode.g.value = 0;
    if (document.fmode.gr.checked) {
        document.fmode.g.value = document.fmode.g.value * 1 + document.fmode.gr.value * 1;
    }
    if (document.fmode.gw.checked) {
        document.fmode.g.value = document.fmode.g.value * 1 + document.fmode.gw.value * 1;
    }
    if (document.fmode.gx.checked) {
        document.fmode.g.value = document.fmode.g.value * 1 + document.fmode.gx.value * 1;
    }
    document.fmode.w.value = 0;
    if (document.fmode.wr.checked) {
        document.fmode.w.value = document.fmode.w.value * 1 + document.fmode.wr.value * 1;
    }
    if (document.fmode.ww.checked) {
        document.fmode.w.value = document.fmode.w.value * 1 + document.fmode.ww.value * 1;
    }
    if (document.fmode.wx.checked) {
        document.fmode.w.value = document.fmode.w.value * 1 + document.fmode.wx.value * 1;
    }
}


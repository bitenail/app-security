var controller = "adminemails";
var option = "com_ose_firewall";
jQuery(document).ready(function ($) {

    $('#adminTable').dataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: url,
            type: "POST",
            data: function (d) {
                d.option = option;
                d.controller = controller;
                d.action = 'getAdminList';
                d.task = 'getAdminList';
                d.centnounce = $('#centnounce').val();
            }
        },
        columns: [{
            "data": "ID"
        }, {
            "data": "Name"
        }, {
            "data": "Email"
        }, {
            "data": "Status"
        }, {
            "data": "Domain"
        }, {
            "data": null,
            "defaultContent": " ",
            "orderable": false,
            "searchable": false
        }]
    });
    $('#checkbox').prop('checked', false);

    $('#adminTable tbody').on('click', 'tr', function () {
        $(this).toggleClass('selected');
    });
    $('#checkbox').click(function () {
        if ($('#checkbox').is(':checked')) {
            $('#adminTable tr').addClass('selected');
        } else {
            $('#adminTable tr').removeClass('selected');
        }
    });
    tinymce.init({
        selector: "textarea.tinymce",
        menubar: false,
        plugins: [
            "fullpage advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code ",
            "insertdatetime table contextmenu paste"
        ],
        height: '500',
        allow_html_in_named_anchor: true,
        forced_root_block: false,
        entity_encoding: 'raw',
        toolbar: "bold italic strikethrough bullist numlist blockquote hr alignleft aligncenter alignright alignjustify link unlink code image media | fullscreen"
    });
    $("#emailEditorForm").submit(function () {
        tinyMCE.triggerSave();
        var postdata = $("#emailEditorForm").serialize();
        postdata += '&centnounce=' + $('#centnounce').val();
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: postdata,
            success: function (data) {
                showLoading(O_EMAIL_TEMP_SAVE);
            	hideLoading();
                document.getElementById('emailEditorForm').style.display = "none";
                document.getElementById('adminBody').style.display = "block";
            }
        });
        return false; // avoid to execute the actual submit of the form.
    });
});
function restoreDefault() {
    jQuery(document).ready(function ($) {
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'restoreDefault',
                task: 'restoreDefault',
                centnounce: $('#centnounce').val()
            },
            success: function (data) {
                if (data == true) {
                    showDialogue(O_EMAILTEMP_SUCESSS, O_SUCCESS, O_OK);
                    setTimeout(function () {
                        window.location.reload();
                    }, 1300);
                } else {
                    showDialogue(
                        O_EMAILTEMP_FAIL,
                        O_FAIL, O_OK);
                }
            }
        })
    });
}
function emailEditor() {
    jQuery(document).ready(function ($) {
        document.getElementById('emailEditorForm').style.display = "block";
        document.getElementById('adminBody').style.display = "none";
    })
}
function addAdmin() {
    jQuery(document).ready(function ($) {
        document.getElementById('emailEditorForm').style.display = "none";
        document.getElementById('adminBody').style.display = "block";
        $('#addAdminModal').modal();
    })
}

function addDomain() {
    jQuery(document).ready(function ($) {
        $('#addAdminModal').modal('hide');
        $('#addDomainModal').modal();
    });
}
function getDomain() {
    jQuery(document).ready(function ($) {
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'getDomain',
                task: 'getDomain',
                centnounce: $('#centnounce').val()
            },
            success: function (data) {
                var i = 0;
                var text;
                while (i < data.length) {
                    text += data[i];
                    i++;
                }
                $('#admin-domain').html(text);
            }
        })
    });
}
function changeStatus(status, id) {
    jQuery(document).ready(function ($) {
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'changeStatus',
                task: 'changeStatus',
                status: status,
                id: id,
                centnounce: $('#centnounce').val()
            },
            success: function (data) {

                if (status == 0) {
                    document.getElementById(id).onclick = function () {
                        changeStatus(1, id);
                    };
                    document.getElementById(id).innerHTML = '<div class="fa fa-times color-red">';
                } else {
                    document.getElementById(id).onclick = function () {
                        changeStatus(0, id);
                    };
                    document.getElementById(id).innerHTML = '<div class="fa fa-check color-green">';
                }
            }
        })
    });
}
function deleteAdminAjax(id) {
    jQuery(document).ready(function ($) {
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'deleteAdmin',
                task: 'deleteAdmin',
                id: id,
                centnounce: $('#centnounce').val()
            },
            success: function (data) {
           		showLoading(data.result);
            	hideLoading();
                $('#adminTable').dataTable().api().ajax.reload();
            }
        });
    })
}
function deleteAdmin() {
    document.getElementById('emailEditorForm').style.display = "none";
    document.getElementById('adminBody').style.display = "block";
    jQuery(document).ready(
        function ($) {
            ids = $('#adminTable').dataTable().api().rows('.selected').data();
            id = [];
            index = 0;
            for (index = 0; index < ids.length; ++index) {
                id[index] = (ids[index]['ID']);
            }
            if (ids.length > 0) {
                bootbox.dialog({
                    message: O_DELETE_CONFIRM_DESC,
                    title: O_CONFIRM,
                    buttons: {
                        success: {
                            label: O_YES,
                            callback: function () {
                                deleteAdminAjax(id);
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

//******************** Security Manager datatable **********************


jQuery(document).ready(function ($) {
    $('#secManagerTable').dataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: url,
            type: "POST",
            data: function (d) {
                d.option = option;
                d.controller = controller;
                d.action = 'getSecManagers';
                d.task = 'getSecManagers';
                d.centnounce = $('#centnounce').val();
            }
        },
        columns: [
            {"data": "id"},
            {"data": "username"},
            {"data": "email"},
            {"data": "block"},
            {"data": "contact"},
        ]
    });
    $('#secManagerTable tbody').on('click', 'tr', function () {
        $(this).toggleClass('selected');
    });
});
function addSecManager() {
    jQuery(document).ready(function ($) {
        $('#addSecManagerModal').modal();
    })
}
function changeBlock(status, id) {
    jQuery(document).ready(function ($) {
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                option: option,
                controller: controller,
                action: 'changeBlock',
                task: 'changeBlock',
                status: status,
                id: id,
                centnounce: $('#centnounce').val()
            },
            success: function (data) {

                if (status == 0) {
                    document.getElementById(id).onclick = function () {
                        changeBlock(1, id);
                    };
                    document.getElementById(id).innerHTML = '<div class="fa fa-times color-red">';
                } else {
                    document.getElementById(id).onclick = function () {
                        changeBlock(0, id);
                    };
                    document.getElementById(id).innerHTML = '<div class="fa fa-check color-green">';
                }
            }
        })
    });
}


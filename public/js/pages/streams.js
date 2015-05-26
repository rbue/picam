$(document).ready(function() {
    // Initialize dataTable
    $('#streamList').dataTable({
        "ajax": {
            "url": "./streams/res"
        },
        "columns": [
            { "data": "id" },
            { "data": "title" },
            { "data": "ip" },
            {
                "data": null,
                "defaultContent": '<button type="button" class="btn btn-default watchStream" data-toggle="tooltip" data-placement="top" title="Stream anschauen"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button> ' + '<button type="button" class="btn btn-danger deleteStream" data-toggle="tooltip" data-placement="top" title="Stream löschen"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>',
                "searchable": false,
                "orderable": false
            }
        ],
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.7/i18n/German.json"
        }
    }).on( 'init.dt', function () {
        // Init tooltips
        $('[data-toggle="tooltip"]').tooltip();

        // Deletion handler/listener
        $('.deleteStream').click(function() {
            var tr = $(this).parent().parent();
            var id = tr.children().first().html();
            //delete
        });
    });

    // Modal submit listener
    $('#btn_addStream').click(function() {
        var res = validateForm();

        // save the streamEntry if the validation was successful
        if(res === true) {
            JSON.stringify($('#frm_addStream').serialize())
            $.ajax({
                method: "post",
                url: "./streams/save",
                data: $('#frm_addStream').serialize(),
                success: function(data) {
                    if(data.status == "success") {
                        // request was successful -> reset form, close modal and show a message (plus reload dataTable source)
                        $('#frm_addStream').trigger("reset");
                        $('#addStream').modal('hide');
                        $('#streamList').DataTable().ajax.reload();
                        $.notify("Speichern erfolgreich!", "success");
                    } else {
                        $.notify("Beim Speicher ist ein Fehler aufgetreten!", "error");
                    }
                },
                error: function() {
                    $.notify("Beim Speicher ist ein Fehler aufgetreten!", "error");
                }

            });
        }
    });
});

function validateForm() {
    var errors = new Array(); // error array (placeholder)

    var title = $('#title').val().trim();
    var ip = $('#ip').val().trim();

    if(title.length == 0) {
        errors.push("Bitte geben Sie einen Titel ein!");
    }

    if(ip.length == 0) {
        errors.push("Bitte geben Sie eine IP-Adresse ein!");
    }

    if(/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/.test(ip) === false) {
        errors.push("Bitte geben Sie eine gültige IP-Adresse ein!");
    }

    if(errors.length > 0) {
        errors.reverse(); // reverse the array for the correct order of html fields
        errors.forEach(function(v) {
            $.notify(v, 'error');
        });
        return false;
    } else {
        return true;
    }
}
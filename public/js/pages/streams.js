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
                "defaultContent": '<button type="button" class="btn btn-default showStream" data-toggle="tooltip" data-placement="top" title="Stream anschauen"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button> ' + '<button type="button" class="btn btn-danger deleteStream" data-toggle="tooltip" data-placement="top" title="Stream löschen"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>',
                "searchable": false,
                "orderable": false
            }
        ],
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.7/i18n/German.json" //todo: replace with an internal solution
        }
    }).on( 'init.dt draw.dt', function () { // on init and redraw
        // Init tooltips
        $('[data-toggle="tooltip"]').tooltip();

        // Deletion handler/listener
        $('.deleteStream').click(function() {
            var tr = $(this).parent().parent();
            var id = tr.children().first().html();

            // show deletion modal
            $('#deleteStream').modal('show');
            $('#frm_deleteStream #deleteId').val(id); // store the "target's" id in a hidden field
        });

        // Handler/Listener to show a stream
        $('.showStream').click(function() {
            //todo: show a brief info or a player
            $('#showStream').modal('show');
        });
    });

    // Add a stream (Modal submit listener)
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
                        $.notify("Erfolgreich gespeichert!", "success");
                    } else {
                        $.notify("Beim Speichern ist ein Fehler aufgetreten!", "error");
                    }
                },
                error: function() {
                    $.notify("Beim Speichern ist ein Fehler aufgetreten!", "error");
                }
            });
        }
    });

    // Remove a stream (Modal submit listener)
    $('#btn_deleteStream').click(function() {
        var deleteId = $('#frm_deleteStream #deleteId').val();
        $.ajax({
            method: "post",
            url: "./streams/delete",
            data: {deleteId: deleteId},
            success: function(data) {
                if(data.status == "success") {
                    // request was successful -> reset form, close modal and show a message (plus reload dataTable source)
                    $('#frm_deleteStream').trigger("reset");
                    $('#deleteStream').modal('hide');
                    $('#streamList').DataTable().ajax.reload();
                    $.notify("Erfolgreich gelöscht!", "success");
                } else {
                    $.notify("Beim Löschen des Streams ist ein Fehler aufgetreten!", "error");
                }
            },
            error: function() {
                $.notify("Beim Löschen des Streams ist ein Fehler aufgetreten!", "error");
            }

        });
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
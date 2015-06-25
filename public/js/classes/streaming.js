/**
 * Streaming class which handles the Streaming-Page
 * @author Robin Bürkli <robinbuerkli at bluewin dot ch>
 */

// Properties
var self;

/**
 * Constructor of the streaming class
 *
 * @constructor
 */
function Streaming() {
    self = this;

    // Init datatable
    this.initTable();

    // Register/Bind Events
    $('#btn_addStream').click(this.addStream);
    $('#btn_deleteStream').click(this.deleteStream);
};

/**
 * [function description]
 * @return {[type]} [description]
 */
Streaming.prototype.initTable = function() {
    $('#streamList').dataTable({
        "ajax": {
            "url": "./streams/res"
        },
        "columns": [
            { "data": "id" },
            { "data": "title", className: "title" },
            { "data": "ip", className: "ip" },
            {
                "data": null,
                "defaultContent": '<button type="button" class="btn btn-default showStream" data-toggle="tooltip" data-placement="top" title="Stream anschauen"><span class="glyphicon glyphicon-play" aria-hidden="true"></span></button> ' + '<button type="button" class="btn btn-danger deleteStream" data-toggle="tooltip" data-placement="top" title="Stream löschen"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>',
                "searchable": false,
                "orderable": false
            }
        ],
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.7/i18n/German.json"
        }
    }).on( 'init.dt draw.dt', function () { // on init and redraw
        // Init tooltips
        $('[data-toggle="tooltip"]').tooltip();

        // Deletion handler/listener
        $('.deleteStream').click(self.showDeleteModal);

        // Handler/Listener to show a stream
        $('.showStream').click(this, self.showStreamModal);
    });
};

/**
 * Function to add a stream via ajax
 */
Streaming.prototype.addStream = function() {
    var res = self.validateAdd();

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
};

/**
 * Show the deletion modal on the registered event
 */
Streaming.prototype.showDeleteModal = function() {
    // "fetch" the id of the stream which should be deleted
    var tr = $(this).parent().parent();
    var id = tr.children().first().html();

    // show deletion modal
    $('#deleteStream').modal('show');
    $('#frm_deleteStream #deleteId').val(id); // store the "target's" id in a hidden field
};

/**
 * Function to delete a stream via ajax
 */
Streaming.prototype.deleteStream = function() {
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
};

/**
 * Show the streaming modal on the registered event
 */
Streaming.prototype.showStreamModal = function(e) {
    // get required vars
    var ip = $(e.currentTarget).parent().parent().find('.ip').text().trim();
    var title = $(e.currentTarget).parent().parent().find('.title').text().trim();
    // clear inner html of the modal and create a new vlc embedded object
    $('#showStream #player_wrapper').empty();
    $('#showStream #player_wrapper').html('<embed id="vlc" target="http://' + ip + ':8554" autoplay="yes" loop="yes" version="VideoLAN.VLCPlugin.2" pluginspage="http://www.videolan.org" type="application/x-vlc-plugin" width="100%" height="420">');
    // show modal and edit title
    $('#showStream').modal('show');
    $('#showStreamLabel').text('Stream anzeigen (' + title + ')');
};

/**
 * Validate the "addStream" form
 *
 * @returns {boolean} true of false, depending on the validation success
 */
Streaming.prototype.validateAdd = function() {
    var errors = new Array(); // error array (placeholder)

    var title = $('#title').val().trim();
    var ip = $('#ip').val().trim();

    if(title.length == 0) {
        errors.push("Bitte geben Sie einen Titel ein!");
    }

    if(ip.length == 0) {
        errors.push("Bitte geben Sie eine IP-Adresse ein!");
    } else if(/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/.test(ip) === false) {
        errors.push("Bitte geben Sie eine gültige IP-Adresse ein!");
    }

    // if there are errors -> display them in a reversed order
    if(errors.length > 0) {
        errors.reverse(); // reverse the array for the correct order of html fields
        errors.forEach(function(v) {
            $.notify(v, 'error');
        });
        return false;
    } else {
        return true;
    }
};

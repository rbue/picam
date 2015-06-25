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
function Archive() {
    self = this;

    // Init datatable
    this.initTable();
};

/**
 * Initialize the datatable and it's event functions
 */
Archive.prototype.initTable = function() {
    $('#vidsList').dataTable({
        "ajax": {
            "url": "./dashboard/archive"
        },
        "columns": [
            { "data": "name", className: "fileName" },
            {
                "data": null,
                "defaultContent": '<button type="button" class="btn btn-default showRecord" data-toggle="tooltip" data-placement="top" title="Aufzeichnung ansehen"><span class="glyphicon glyphicon-play" aria-hidden="true"></span></button>',
                "searchable": false,
                "orderable": false
            }
        ],
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.7/i18n/German.json"
        },
        "order": [[ 0, "desc" ]] // default sorting (recent recordings first)
    }).on( 'init.dt draw.dt', function () { // on init and redraw
        // Init tooltips
        $('[data-toggle="tooltip"]').tooltip();

        // Handler/Listener to show a recording
        $('.showRecord').click(self.showRecordModal, null);
    });
};

/**
 * Show the record modal on the registered event
 */
Archive.prototype.showRecordModal = function(e) {
    var fileName = $(e.currentTarget).parent().parent().find('.fileName').text().trim();
    // clear inner html of the modal and create a new vlc embedded object
    console.log(fileName);
    $('#showRecording #record_wrapper').empty();
    $('#showRecording #record_wrapper').html('<embed id="vlc" target="./videos/' + fileName + '" autoplay="yes" loop="yes" version="VideoLAN.VLCPlugin.2" pluginspage="http://www.videolan.org" type="application/x-vlc-plugin" width="100%" height="420">');
    /*$('#showRecording #record_wrapper').html('<embed id="vlc" target="http://link.ac/4Twe10" autoplay="yes" loop="yes" version="VideoLAN.VLCPlugin.2" pluginspage="http://www.videolan.org" type="application/x-vlc-plugin" width="100%" height="420">');*/
    $('#showRecording').modal('show');
};
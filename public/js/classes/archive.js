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
            { "data": "name", className: "filename" },
            { "data": "date" },
            {
                "data": null,
                "defaultContent": '<button type="button" class="btn btn-default showRecord" data-toggle="tooltip" data-placement="top" title="Aufzeichnung ansehen"><span class="glyphicon glyphicon-play" aria-hidden="true"></span></button>',
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

        // Handler/Listener to show a recording
        $('.showRecord').click(this, null);
    });
};
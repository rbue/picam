/**
 * Dashboard class which handles the Dashboard-Page
 * @author Robin Bürkli <robinbuerkli at bluewin dot ch>
 */

// Properties
var self;

/**
 * Constructor of the dashboard class
 *
 * @constructor
 */
function Dashboard() {
    self = this;

    // register / bind events
    $('button').click({d: this}, this.changeMode);
};

Dashboard.prototype.changeMode = function(d) {
    // do some frontend stuff
    $('button').removeClass('active');
    $('button').removeAttr('disabled');
    var curElem = $(d.currentTarget);
    curElem.addClass('active');
    curElem.attr('disabled', 'disabled');

    // get mode
    var mode = curElem.attr('id').split('_')[1];

    // get mode view
    self.getModeView(mode);

    // block ui
    $.blockUI({message: null});

    // call via ajax to start the behaviour
    $.ajax({
        method: "post",
        url: "./dashboard/change",
        data: {mode : mode},
        success: function(data) {
            if(data.status == "success") {
                $.notify("Modus erfolgreich geändert!", "success");
            } else {
                $.notify("Beim Wechseln des Modus ist ein Fehler aufgetreten!", "error");
            }
            $.unblockUI();
        },
        error: function() {
            $.notify("Beim Wechseln des Modus ist ein Fehler aufgetreten!", "error");
            $.unblockUI();
        }
    });
};

Dashboard.prototype.getModeView = function(mode) {
    $.ajax({
        method: "post",
        url: "./dashboard/view",
        data: {mode : mode},
        success: function(data) {
            // set response as inner htnl of panel content
            $('#panel-content').html(data);
        }
    });
}
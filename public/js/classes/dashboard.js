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

/**
 * This function handles the modechange functionality.
 *
 * @param d Dashboard var
 */
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
    if(mode === 'stream') {
        $.blockUI({message: 'Biite waren Sie, bis der Stream gestartet ist (~10 Sekunden)'});
    } else {
        $.blockUI({message: null});
    }


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
            if(mode == 'stream') {
                setTimeout(function() {
                    $.unblockUI(); // unblock after x(10) secs, so that we're sure that the stream started successfully
                    location.reload();
                }, 10000);
            } else {
                $.unblockUI(); // unblock instant
            }

        },
        error: function() {
            $.notify("Beim Wechseln des Modus ist ein Fehler aufgetreten!", "error");
            $.unblockUI();
        }
    });
};

/**
 * This function fetches the inner content (html view) for the target mode.
 *
 * @param mode target mode
 */
Dashboard.prototype.getModeView = function(mode) {
    $.ajax({
        method: "post",
        url: "./dashboard/view",
        data: {mode : mode},
        success: function(data) {
            // set response as inner html of panel content
            $('#panel-content').html(data);
        }
    });
}
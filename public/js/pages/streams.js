$(document).ready(function() {
    // Modal submit listener
    $('#btn_addStream').click(function() {
        var res = validateForm();

        // save the streamEntry if the validation was successfull
        if(res === true) {
            // todo
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
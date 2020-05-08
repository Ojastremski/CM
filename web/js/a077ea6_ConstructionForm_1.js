$(document).ready(function() {

    if ($('#construction_form_note').val().length != 0) {
        $("#construction_form_noteVisibility").prop("disabled", false);
    }

    $('#construction_form_note').on('input', function() {
        var val = $(this).val();
        if (val.length == 0) {
            $("#construction_form_noteVisibility").prop("disabled", true);
        } else {
            $("#construction_form_noteVisibility").prop("disabled", false);
        }
    });

});
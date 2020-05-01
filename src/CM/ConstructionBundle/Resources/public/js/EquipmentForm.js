$(document).ready(function() {

    if ($('#equipment_form_note').val().length != 0) {
        $("#equipment_form_noteVisibility").prop("disabled", false);
    }

    $('#equipment_form_note').on('input', function() {
        var val = $(this).val();
        if (val.length == 0) {
            $("#equipment_form_noteVisibility").prop("disabled", true);
        } else {
            $("#equipment_form_noteVisibility").prop("disabled", false);
        }
    });

});
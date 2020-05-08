$(document).ready(function() {
    window.setTimeout(function() {
        $("#message").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 2000);

    $('#confirmationModal').on('show.bs.modal', function(event) {
        var previousAction = $(event.relatedTarget);

        var elementId = previousAction.attr('data-element-id');

        var modal = $(this);
        modal.find('form #element_id').val(elementId);
    });
});
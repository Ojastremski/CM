$(document).ready(function() {
    window.setTimeout(function() {
        $("#message").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 2000);

    $('#scroll').DataTable({
        "paging": false,
        "info": false,
        "language": { search: '', searchPlaceholder: "Wyszukaj po nazwie ..." }
    });

    $("input[type='search']").addClass('searchBox');

    $('#confirmationModal').on('show.bs.modal', function(event) {
        var previousAction = $(event.relatedTarget);

        var constructionId = previousAction.attr('data-construction-id');

        var modal = $(this);
        modal.find('form #construction_id').val(constructionId);
    });
});
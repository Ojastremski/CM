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
});
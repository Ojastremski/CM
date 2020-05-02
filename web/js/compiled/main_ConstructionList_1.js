$(document).ready(function() {
    $('#scroll').DataTable({
        "paging": false,
        "info": false,
        "language": { search: '', searchPlaceholder: "Wyszukaj po nazwie ..." }
    });

    $("input[type='search']").addClass('searchBox');
});
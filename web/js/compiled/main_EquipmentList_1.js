$(document).ready(function() {
    var table = $('#scroll').DataTable({
        "paging": false,
        "info": false,
        "language": { search: '', searchPlaceholder: "Wyszukaj po nazwie/kategorii" }
    });

    $('.dataTables_filter input').unbind().on('keyup', function() {
        var searchTerm = this.value.toLowerCase();
        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
            //search only in column 1 and 2
            if (~data[0].toLowerCase().indexOf(searchTerm)) return true;
            if (~data[1].toLowerCase().indexOf(searchTerm)) return true;
            return false;
        })
        table.draw();
        $.fn.dataTable.ext.search.pop();
    })

    $("input[type='search']").addClass('searchBox');

});
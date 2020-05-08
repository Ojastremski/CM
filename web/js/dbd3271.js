$(document).ready(function() {
    var table = $('#scroll').DataTable({
        "paging": false,
        "info": false,
        "language": { search: '', searchPlaceholder: "Wyszukaj po nazwie/kategorii/przydziale" }
    });

    $('.dataTables_filter input').unbind().on('keyup', function() {
        var searchTerm = this.value.toLowerCase();
        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
            //search only in column 1 and 2
            if (~data[1].toLowerCase().indexOf(searchTerm)) return true;
            if (~data[2].toLowerCase().indexOf(searchTerm)) return true;
            if (~data[4].toLowerCase().indexOf(searchTerm)) return true;
            return false;
        })
        table.draw();
        $.fn.dataTable.ext.search.pop();
    })

    $("#param_to_equipment_form_allCategory").css("display", "none");
    $("#param_to_equipment_form_allConstruction").css("display", "none");
    $("#param_to_equipment_form_recipient").css("display", "none");
    $("#param_to_equipment_form_owner").css("display", "none");
    $("#assignForm .form-group").css('display', "inline-block")

    $('.checkedrow').change(function() {
        var checked = $("tbody input:checked").length > 0;
        if (!checked) {
            $("#assignparam").css("display", "none");
            $("#param_to_equipment_form_allCategory").css("display", "none");
            $("#param_to_equipment_form_allConstruction").css("display", "none");
            $("#param_to_equipment_form_recipient").css("display", "none");
            $("#param_to_equipment_form_owner").css("display", "none");
        } else {
            $("#assignparam").css("display", "block");
            $("#param_to_equipment_form_allConstruction").css("display", "block");
            $("#param_to_equipment_form_allCategory").css("display", "block");
            $("#param_to_equipment_form_recipient").css("display", "block");
            $("#param_to_equipment_form_owner").css("display", "block");
            $('#param_to_equipment_form_owner').prop('disabled', true);
            $('#param_to_equipment_form_recipient').prop('disabled', true);
        }

    });

    $('#param_to_equipment_form_allConstruction').change(function() {
        var selected = $(this).length > 0;
        if (selected) {
            console.log(typeof($(this).val()));
            if ($(this).val() === "") {
                $('#param_to_equipment_form_recipient').prop('disabled', true);
                $('#param_to_equipment_form_owner').prop('disabled', true);
            } else {
                $('#param_to_equipment_form_recipient').prop('disabled', false);
                $('#param_to_equipment_form_owner').prop('disabled', false);
            }
        }
    });

    $("input[type='search']").addClass('searchBox');

});
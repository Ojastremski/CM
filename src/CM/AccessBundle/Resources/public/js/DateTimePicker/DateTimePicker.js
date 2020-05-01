$(document).ready(function() {
    // Datetime picker initialization.
    $('[data-toggle="datetimepicker"]').datetimepicker({
        icons: {
            time: 'far fa-clock',
            date: 'fas fa-calendar-alt',
            up: 'fas fa-chevron-up',
            down: 'fas fa-chevron-down',
            previous: 'fas fa-chevron-left',
            next: 'fas fa-chevron-right',
            today: 'fas fa-check-circle',
            clear: 'fas fa-trash-alt',
            close: 'fa fa-remove'
        },
        locale: 'pl',
        defaultDate: new Date()
    });

});
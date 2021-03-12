import moment from "moment";

$.noConflict();
$(function() {
    $('input[name="birthdate"]').daterangepicker({
        locale: {
            format: 'YYY/MM/DD'
        },
        singleDatePicker: true,
        showDropdowns: true,
        "maxDate": moment().format('YYYY.MM.DD')
    });
});
$.noConflict();
$(function() {
    $('input[name="birthdate"]').datepicker({
        format: 'yyyy-mm-dd',
        endDate: '-1d'
    });
});

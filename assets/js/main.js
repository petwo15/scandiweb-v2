$(document).ready(function() {
    $('#productType').change(function() {
        var productType = $(this).val();
        $('.dynamic-field').hide();
        $('#' + productType).show();
    });
});
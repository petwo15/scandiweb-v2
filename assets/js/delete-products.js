$(document).ready(function() {
    $('#delete-product-btn').click(function() {
        var skus = [];
        $('.delete-checkbox:checked').each(function() {
            skus.push($(this).data('sku'));
        });

        if (skus.length > 0) {
            $.ajax({
                type: 'POST',
                url: 'delete-product.php',
                data: { sku: skus },
                success: function(data) {
                    location.reload();
                }
            });
        }
    });
});
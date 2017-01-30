$(document).ready(function () {

    $('.status').click(function (e) {
        e.preventDefault();
        var status = $(this).attr('data-status');
        var id_provider = $(this).attr('data-provider');
        var id_product = $(this).attr('data-product');
        var id_order = $(this).attr('data-order');
        var id_email = $(this).attr('data-email');

        $.ajax({
            type: 'POST',
            url: '/modules/autorestocking/status_ajax.php',
            data: {
                id_order: id_order,
                status: status,
                id_provider: id_provider,
                id_product: id_product,
                id_email: id_email
            },
            success: function (data) {
                console.log(data);
                if (data) {
                    $('#myModal').modal('show');
                }
            }
        });

    });

});

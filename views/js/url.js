$(document).ready(function () {

    $('.status').click(function (e) {
        e.preventDefault();
        var status = $(this).attr('data-status');
        var id_provider = $(this).attr('data-provider');
        var id_product = $(this).attr('data-product');

        $.ajax({
            type: 'POST',
            url: '/modules/autorestocking/status_ajax.php',
            data: {status: status, id_provider: id_provider, id_product: id_product},
            success: function (data) {
                if (data) {
                    $('#myModal').modal('show');
                }
            }
        });

    });

});

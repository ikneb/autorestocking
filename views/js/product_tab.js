$(document).ready(function () {
    $('body').on('click', '.submitCombination', function (e) {
        e.preventDefault();
        var _this = $(this).closest('.product-tab');
        var id_provider = _this.find("#id_provider").val();
        var min_count = _this.find("input[name='min_count']").val();
        var product_count = _this.find("input[name='product_count']").val();
        var order_day = _this.find(".selectpicker").val();
        var id_attribute = _this.attr('data-atrt');
        var name_combination = _this.attr('data-comb');
        var id_category = _this.attr('data-cat');
        var id_relations = _this.attr('data-rel');
        var id_product = _this.attr('data-prod');

        $.ajax({
            type: 'POST',
            url: '/modules/autorestocking/ajax.php',
            data: {
                id_product: id_product,
                id_provider: id_provider,
                id_relation: id_relations,
                min_count: min_count,
                product_count: product_count,
                order_day: order_day,
                id_attribute: id_attribute,
                name_combination: name_combination,
                id_category: id_category,
                ajax: 12
            },
            success: function (data) {
                if (id_relations == 0) {
                    _this.attr('data-rel', data);
                }
                checkReturnData(data);
            }
        });
    });

    function checkReturnData(data) {
        if (data) {
            $('#ajax_confirmation').text('Update successfully!').removeClass('hide alert-danger').addClass('alert-success');
            setTimeout(function () {
                $('#ajax_confirmation').addClass('hide');
            }, 2000);
        } else {
            $('#ajax_confirmation').text('Not update try again later!').removeClass('hide alert-success').addClass('alert-danger');
            setTimeout(function () {
                $('#ajax_confirmation').addClass('hide');
            }, 2000);
        }
    }

});
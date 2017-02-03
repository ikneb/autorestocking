/**
 * 2016 WeeTeam
 *
 * @author    WeeTeam
 * @copyright 2016 WeeTeam
 * @license   http://www.gnu.org/philosophy/categories.html (Shareware)
 */

$(document).ready(function () {
    $('body').on('click', '.submitCombination', function (e) {
        e.preventDefault();
        var _this = $(this).closest('.product-tab');
        var id_provider = _this.find("#id_provider").val();
        var min_count = _this.find("input[name='min_count']").val();
        var product_count = _this.find("input[name='product_count']").val();
        var type_order_day = _this.find('.selectpicker').val();
        var id_attribute = _this.attr('data-atrt');
        var name_combination = _this.attr('data-comb');
        var id_category = _this.attr('data-cat');
        var id_relations = _this.attr('data-rel');
        var id_product = _this.attr('data-prod');

        var order_day  = [];

        if(type_order_day == 1){
            var days = Array.apply(null, document.getElementById('days_' + id_attribute).querySelectorAll('.days [type=checkbox]'));
            $(days).each(function (i) {
                if($(this).prop('checked'))
                    order_day[i] = $(this).val();
            });
        }else if(type_order_day == 2){
            var selectElement = $('#month_days_' + id_attribute +', .ui-state-active');
            $(selectElement).each(function (i) {
                order_day[i] = $(this).html();
            });
        }

        $.ajax({
            type: 'POST',
            url: '/modules/autorestocking/ajax.php',
            data: {
                id_product: id_product,
                id_provider: id_provider,
                id_relation: id_relations,
                min_count: min_count,
                type_order_day: type_order_day,
                product_count: product_count,
                order_day: order_day,
                id_attribute: id_attribute,
                name_combination: name_combination,
                id_category: id_category,
                ajax: 'update_relation_for_product_tab'
            },

            success: function (data) {
                if (id_relations == 0 && data.length < 10) {
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

    $('body').on('click', '.selectpicker', function(e){
        e.preventDefault();
        var id_attr_comb = $(this).closest('.product-tab').attr('data-atrt');

        if($(this).val() == 1){
            $(this).closest('.text-center').find('.select-days-week').removeClass('no-active');
            $(this).closest('.text-center').find('.select-days-week').addClass('select-group');

            $(this).closest('.text-center').find('.select-days-month').addClass('no-active');
            $(this).closest('.text-center').find('.select-days-month').removeClass('select-group');

            function isChecked(element) {
                return element.checked;
            }

            function getValue(element) {
                return element.value;
            }

            function WeekdayWidget(element) {
                var parts = Array.apply(null, element.querySelectorAll('.week-parts [type=checkbox]'));
                var days = Array.apply(null, element.querySelectorAll('.days [type=checkbox]'));

                function value() {
                    return days.filter(isChecked).map(getValue);
                }

                this.value = value;

                function updateParts(selected) {

                    function notSelected(val) {
                        return selected.indexOf(val) === -1;
                    }

                    parts.forEach(function(part) {
                        var partDays = part.dataset.values.split(',');
                        var notSelectedParts = partDays.filter(notSelected);
                        if (notSelectedParts.length === 0) {
                            part.checked = true;
                            part.indeterminate = false;
                        } else if (notSelectedParts.length === partDays.length) {
                            part.checked = false;
                            part.indeterminate = false;
                        } else {
                            part.indeterminate = true;
                        }
                        if (partDays.length === partDays.filter(notSelected).length)
                            part.checked = partDays.filter(notSelected).length === 0;
                    });
                }

                function updateDays(values, checked) {
                    days.forEach(function(ele) {
                        if (values.indexOf(ele.value) > -1) {
                            ele.checked = checked;
                        }
                    });
                }

                element.addEventListener('change', function(event) {
                    if (event.target.tagName === 'INPUT') {
                        if (event.target.name === element.dataset.name) {
                            updateParts(value());
                        } else {
                            updateDays(event.target.dataset.values.split(','), event.target.checked);
                            updateParts(value());
                        }
                    }
                });
            }

            var widget = new WeekdayWidget(document.getElementById('days_' + id_attr_comb));

        }else if($(this).val() == 2){
            $(this).closest('.text-center').find('.select-days-week').addClass('no-active');
            $(this).closest('.text-center').find('.select-days-week').removeClass('select-group');

            $(this).closest('.text-center').find('.select-days-month').removeClass('no-active');
            $(this).closest('.text-center').find('.select-days-month').addClass('select-group');
        }

    });

    $('body').on('click', '.ui-state-default', function(e){
        e.preventDefault();
        if($(this).hasClass('ui-state-active')){
            $(this).removeClass('ui-state-active');

        }else{
            $(this).addClass('ui-state-active');
        }
    });

    $('body').on('mouseleave', '.select-days-week, .select-days-month',function () {
        $(this).addClass('no-active');
    });
});

$( document ).ready(function() {

    $('.list-group-item').click(function(){
        $('.list-group-item').removeClass('active');
        $(this).addClass('active');
    });

    $('#providers_form').submit(function(e){
        e.preventDefault();
        var provider = $('#providers_form').serialize();
        var id_provider = $('#id_providers').val();
        $.ajax({
            type: 'POST',
            url: '/modules/autorestocking/ajax.php',
            data: provider,
            success: function(data){
                if(id_provider == ''){
                    $('#id_providers').val(data);
                }
                checkReturnData(data);
            }
        });
    })


    $("body").on("submit", ".relationForm", function (e) {
        e.preventDefault();
        var provider = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '/modules/autorestocking/ajax.php',
            data: provider,
            success: function(data){
                checkReturnData(data);
            }
        });
    });


   /* $('#addRelationForm').submit(function(e){
        e.preventDefault();
        var box = [];
        var submitRelation = $("input[name='submitRelation']").val();
        var id_providers = $("input[name='id_providers']").val();

       if(id_providers == ''){
            $('#ajax_confirmation').text('Add provider please!').removeClass('hide alert-success').addClass('alert-danger');
            setTimeout(function () {
                $('#ajax_confirmation').addClass('hide');
            }, 2000);
       }else{
           $('.tree-selected input').each(function(i) {
               box[i] = $(this).val();
           });

           console.log(box);
           $.ajax({
               type: 'POST',
               url: '/modules/autorestocking/ajax.php',
               data: { box: box,  submitRelation: submitRelation, id_provider: id_providers},
               success: function(data){
                   checkReturnData(data);
               }
           });
       }
    });
*/

    /*$('#addRelationProductForm').submit(function(e){
        e.preventDefault();
        var id_product = $("input[name='product_autocomplete']").attr('data');
        var id_providers = $("input[name='id_providers']").val();
        var submitProductRelation = $("input[name='submitProductRelation']").val();
        if(id_providers == ''){
            $('#ajax_confirmation').text('Add provider please!').removeClass('hide alert-success').addClass('alert-danger');
            setTimeout(function () {
                $('#ajax_confirmation').addClass('hide');
            }, 2000);
            return true;
        }else{
            $.ajax({
                type: 'POST',
                url: '/modules/autorestocking/ajax.php',
                data: { id_product: id_product, submitProductRelation: submitProductRelation, id_provider: id_providers},
                success: function(data){
                    console.log(data);
                    checkReturnData(data);
                }
            });
        }

    });*/

    $('.add-product').click(function(e){
        e.preventDefault();
        var id_product = $("input[name='product_autocomplete']").attr('data');
        var id_providers = $("input[name='id_providers']").val();
        var name = $("input[name='product_autocomplete']").val();


        if(id_providers == '') {
            $('#ajax_confirmation').text('Add provider, please!').removeClass('hide alert-success').addClass('alert-danger');
            setTimeout(function () {
                $('#ajax_confirmation').addClass('hide');
            }, 2000);
            return true;
        }else if(id_product == undefined){
            $('#ajax_confirmation').text('Find product, please!').removeClass('hide alert-success').addClass('alert-danger');
            setTimeout(function () {
                $('#ajax_confirmation').addClass('hide');
            }, 2000);
            return true;
        }else{
            try {
                $.ajax({
                    type: 'POST',
                    url: '/modules/autorestocking/ajax.php',
                    data: { id_product: id_product, ajax: 8  },
                    success: function(data){
                        $('.product').each(function (i) {
                            if ($(this).attr('data-prod') == id_product) {
                                throw new Error();
                            }
                        });
                        $('.product-list').append("<li class='list-group-item justify-content-between product' data-cat='" + data + "' data-prod='" + id_product + "' data-save='1' data-name = " + name + "><span class='product-col'>" + id_product + "</span><span class='product-col-name'>" + name + "</span><span class='badge badge-default badge-pill'><i class='icon-check check-product'></i><i class='icon-remove remove-product hidden'></i></span></li>");
                    }
                });
            }catch(e){
                $('#ajax_confirmation').text('This product already added in list!').removeClass('hide alert-success').addClass('alert-danger');
                setTimeout(function () {
                    $('#ajax_confirmation').addClass('hide');
                }, 2000);
            }
        }
    });

    function Parida_Categories_Tree_Init(){
        var tree = $('#associated-categories-tree');
       $('li input[type="checkbox"]', tree).change(function(){
            var _this = $(this);
            var li = _this.closest('li');
            var class_checked = 'tree-selected';
            $('input[type="checkbox"]', li).attr({checked: _this.is(':checked')});
            if (_this.is(':checked')){
                $('span', li).addClass(class_checked);
            }else{
                $('span', li).removeClass(class_checked);
            }
            var ps = _this.parents('li');
            if (ps.length){
                for (var i = 0; i < ps.length; i++){
                    if (!_this.is(':checked') && !jQuery('ul input[type="checkbox"]:checked', ps.eq(i)).length){
                        $('input[type="checkbox"]', ps.eq(i)).attr({
                            checked: false
                        });
                        $('span', ps.eq(i)).removeClass(class_checked);
                    }else if (_this.is(':checked')){
                        $('> span > input[type="checkbox"]', ps.eq(i)).attr({
                            checked: true
                        }).parent().addClass(class_checked);
                    };
                }
            }
        });
    }

    $('body').on('click','#providers_form_submit_btn', function(e){
        e.preventDefault();
        var products = [];
        var id_provider = $("input[name='id_providers']").val();

        $('#product-list').find('.product').each(function(index){
            if($(this).attr('data-save') == 1) {
                products[index] = {
                    'id_provider':  $("input[name='id_providers']").val(),
                    'name':        $(this).attr('data-name'),
                    'id_product':  $(this).attr('data-prod'),
                    'id_category': $(this).attr('data-cat')
                };
            }
        });
        $.ajax({
            type: 'POST',
            url: '/modules/autorestocking/ajax.php',
            data: { products: products, ajax: 6 , id_provider: id_provider },
            success: function(data){
                console.log(data);
                checkReturnData(data);
            }
        });

    });


    $('body').on('change',':checkbox',function(){
        if(this.checked){
            var categories = [];
            Parida_Categories_Tree_Init();
            $('.tree-selected input').each(function(i) {
                categories[i] = $(this).val();
            });
            $.ajax({
                type: 'POST',
                url: '/modules/autorestocking/ajax.php',
                data: {categories: categories, ajax: 7},
                success: function(data){
                   var products = JSON.parse(data);
                    var product_list = [];
                    for(i = 0; i < products.length; i++) {
                        $('.product').each(function (i) {
                            product_list[i] = $(this).attr('data-prod');
                        });

                        if(product_list.length == 0 || product_list.indexOf(products[i][0]['id_product']) == -1){
                            $('.product-list').append("<li class='list-group-item justify-content-between product' data-cat='" + products[i][0]['id_category_default'] + "' data-prod='" + products[i][0]['id_product'] + "' data-save='1' data-name = " + products[i][0]['name'] + "><span class='product-col'>"+ products[i][0]['id_product']+"</span><span class='product-col-name'>" + products[i][0]['name'] + "</span><span class='badge badge-default badge-pill'><i class='icon-check check-product'></i><i class='icon-remove remove-product hidden'></i></span></li>");
                        }
                    }
                }
            });
        }else{
            Parida_Categories_Tree_Init();
        }
    });



    $('body').on('click','.check-product', function(e){
        e.preventDefault();
        $(this).addClass('hidden')
        $(this).closest('.badge').find('.remove-product').removeClass('hidden');
        $(this).closest('.product').attr('data-save', '0');

    });

    $('body').on('click', '.remove-product', function(e){
        e.preventDefault();
        $(this).addClass('hidden')
        $(this).closest('.badge').find('.check-product').removeClass('hidden');
        $(this).closest('.product').attr('data-save', '1');
    });


    $('#linkRelation').click(function(){
        var id_provider = $("input[name='id_providers']").val();
        if(id_provider == ''){
            $('#ajax_confirmation').text('Please add provider and relation!').removeClass('hide alert-success').addClass('alert-danger');
            setTimeout(function () {
                $('#ajax_confirmation').addClass('hide');
            }, 3000);
            return true;
        }else{
            $.ajax({
                type: 'POST',
                url: '/modules/autorestocking/ajax.php',
                data: {id_provider: id_provider,ajax: 5},
                success: function(data){
                    $('.place-add-relation').html(data);
                }
            });
        }

    });


    $('#linkAddRelation').click(function(){
        var id_provider = $("input[name='id_providers']").val();
        if(id_provider == ''){
            $('#ajax_confirmation').text('Please add provider!').removeClass('hide alert-success').addClass('alert-danger');
            setTimeout(function () {
                $('#ajax_confirmation').addClass('hide');
            }, 3000);
            return true;
        }

    });


    $('#related_product_autocomplete_input')
        .autocomplete('/modules/autorestocking/autocomplete_ajax.php', {
            minChars: 0,
            autoFill: true,
            max:20,
            matchContains: true,
            mustMatch:false,
            scroll:false,
            formatItem: function(item) {
                return item[0]+' - '+item[1];
            }
        }).result(function(e, i){
        if(i != undefined)
            addRelatedProduct(i[1], i[0]);
            $(this).val(i[0]);
            $(this).attr('data', i[1])
    });

    function addRelatedProduct(id_product_to_add, product_name)
    {
        if (!id_product_to_add)
            return;
        $('#related_product_name').html(product_name);
        $('input[name=id_product_redirected]').val(id_product_to_add);
        //$('#related_product_autocomplete_input').parent().hide();
        // $('#related_product_remove').show();
    }

    var supervise = {};
    $('a').each(function() {
        var txt = $(this).text();
        if (supervise[txt])
            $(this).remove();
        else
            supervise[txt] = true;
    });


    function checkReturnData(data){
        if(data) {
            $('#ajax_confirmation').text('Update successfully!').removeClass('hide alert-danger').addClass('alert-success');
            setTimeout(function () {
                $('#ajax_confirmation').addClass('hide');
            }, 2000);
        }else{
            $('#ajax_confirmation').text('Not update try again later!').removeClass('hide alert-success').addClass('alert-danger');
            setTimeout(function () {
                $('#ajax_confirmation').addClass('hide');
            }, 2000);
        }
    }



});
$( document ).ready(function() {

    $('.list-group-item').click(function(){
        $('.list-group-item').removeClass('active');
        $(this).addClass('active');
    });

    $('#providers_form').submit(function(e){
        e.preventDefault();
        var id_provider = $('#id_providers').val();
        var name = $('#name').val();
        var description = $('#description').val();
        var email = $('#email').val();

        $.ajax({
            type: 'POST',
            url: '/modules/autorestocking/ajax.php',
            data: {id_provider: id_provider,name: name, description: description,email: email, ajax: 4},
            success: function(data){
                console.log(data);
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
            $.ajax({
                type: 'POST',
                url: '/modules/autorestocking/ajax.php',
                data: { id_product: id_product, ajax: 8  },
                success: function(data){
                    try {
                        $('.product').each(function (i) {
                            if ($(this).attr('data-prod') == id_product) {
                                throw new Error();
                            }
                        });
                        var attributeSpan = "<span class='caret'></span>";
                        $('.product-list').append("<li id='" +
                            id_product + "' class='list-group-item justify-content-between product' data-cat='" +
                            data + "' data-prod='" +
                            id_product + "' data-save='1' data-name = " +
                            name + "><span class='product-col'>" +
                            id_product + "</span><span class='product-col-name'>" +
                            name + "</span>"+ attributeSpan +"<span class='badge badge-default badge-pill'><i class='icon-check check-product'></i><i class='icon-remove remove-product hidden'></i></span></li>");
                    }catch(e){
                        $('#ajax_confirmation').text('This product already added in list!').removeClass('hide alert-success').addClass('alert-danger');
                        setTimeout(function () {
                            $('#ajax_confirmation').addClass('hide');
                        }, 2000);
                    }
                }
            });
        }
    });

    /*function checkAttribute(id_products){

        $.ajax({
            type: 'POST',
            url: '/modules/autorestocking/ajax.php',
            data: { id_products: id_products, ajax: 11},
            success: function(data){
                if(data){
                    window.attributeSpan =   "<span class='caret'></span>";
                }
            }
        });
        console.log(attributeSpan);
        return attributeSpan;
    }*/

    $('body').on('click', '.caret', function(){

        var id_product = $(this).closest('.product').attr('data-prod');
        var _this = $(this);
        if(_this.hasClass('off')){
            $('.attribute').each(function (i) {
                if ($(this).attr('data-prod') == id_product) {
                    $(this).addClass('no-active');
                }
            });
            _this.addClass('on');
            _this.removeClass('off');
        }else{
            if(_this.hasClass('on')){
                $('.attribute').each(function (i) {
                    if ($(this).attr('data-prod') == id_product) {
                        $(this).removeClass('no-active');
                    }
                });
                _this.addClass('off');
                _this.removeClass('on');
            }else{
                $.ajax({
                    type: 'POST',
                    url: '/modules/autorestocking/ajax.php',
                    data: { id_product: id_product, ajax: 10 },
                    success: function(data){
                        var data_decoder = JSON.parse(data);
                        var attr = '';
                        for(i = 0; i < data_decoder.length; i++) {
                            attr += "<li class='list-group-item justify-content-between product attribute ' data-cat='" +
                                data_decoder[i]['id_category_default'] + "' data-prod='" + id_product + "' data-save='1' data-name = " +
                                data_decoder[i]['comb'] + " data-attr=" + data_decoder[i]['id_product_attribute'] + " ><span class='product-col'></span><span class='attribute-col-name'>" +
                                name + "(" + data_decoder[i]['comb'] + ")</span><span class='badge badge-default badge-pill'><i class='icon-check check-product'></i><i class='icon-remove remove-product hidden'></i></span></li>";
                        }
                        _this.addClass('off');
                        _this.closest('li').after(function(){
                            return attr;
                        });
                        _this.closest('.product').attr('data-save', '0');
                    }
                });
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
                    if (!_this.is(':checked') && ! $('ul input[type="checkbox"]:checked', ps.eq(i)).length){
                        $('input[type="checkbox"]', ps.eq(i)).attr({
                            checked: false
                        });
                        $('span', ps.eq(i)).removeClass(class_checked);
                    }
                }
            }
        });
    }

    $('body').on('click','#addSubmitProduct', function(e){
        e.preventDefault();
        var products = [];
        var id_provider = $("input[name='id_providers']").val();

        $('#product-list').find('.product').each(function(index){
                products[index] = {
                    'id_provider':  $("input[name='id_providers']").val(),
                    'id_product':  $(this).attr('data-prod'),
                    'id_category': $(this).attr('data-cat'),
                    'id_attribute': $(this).attr('data-attr'),
                    'name_combination' : $(this).children('.attribute-col-name').text(),
                    'data_save' : $(this).attr('data-save')
                };
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
        var categories = [];
        if(this.checked){
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
                            $('.product-list').append("<li id='product_" + products[i][0]['id_product']
                                + "' class='list-group-item justify-content-between product' data-cat='" +
                                products[i][0]['id_category_default'] + "' data-prod='" +
                                products[i][0]['id_product'] + "' data-save='1' data-name = " +
                                products[i][0]['name'] + "><span class='product-col'>"+
                                products[i][0]['id_product']+"</span><span class='product-col-name'>" +
                                products[i][0]['name'] + "</span><span class='caret'></span><span class='badge badge-default badge-pill'><i class='icon-check check-product'></i><i class='icon-remove remove-product hidden'></i></span></li>");
                        }
                    }
                }
            });
        }else{
            Parida_Categories_Tree_Init();
            $('.tree-selected input').each(function(i) {
                categories[i] = $(this).val();
            });
            if(categories.length == 0){
                $('.product').remove();
            }else{
                $.ajax({
                    type: 'POST',
                    url: '/modules/autorestocking/ajax.php',
                    data: {categories: categories, ajax: 7},
                    success: function(data){
                        var products = JSON.parse(data);
                        var product_new = [];
                        var product_list = [];
                        for(i = 0; i < products.length; i++) {
                            product_new[i] = products[i][0]['id_product'];
                        }
                        $('.product').each(function (i) {
                            product_list[i] = $(this).attr('data-prod');
                        });
                        for(i = 0; i < product_list.length; i++){
                            if(product_new.indexOf(product_list[i]) == -1){
                                $('#'+product_list[i]).remove();
                            }
                        }
                    }
                });
            }

        }
    });


    $('body').on('click','.check-product', function(e){
        e.preventDefault();
        $(this).addClass('hidden')
        $(this).closest('.badge').find('.remove-product').removeClass('hidden');
        $(this).closest('.product').attr('data-save', 0);

    });

    $('body').on('click', '.remove-product', function(e){
        e.preventDefault();
        $(this).addClass('hidden')
        $(this).closest('.badge').find('.check-product').removeClass('hidden');
        $(this).closest('.product').attr('data-save', 1);
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
                data: {id_provider: id_provider, ajax: 5},
                success: function(data){
                    $('.place-add-relation').html(data);
                }
            });
        }

    });


    $('body').on('click', '.page-link', function(){
        var page = $(this).attr('data-page');
        var id_provider = $("input[name='id_providers']").val();
        var sel = $(this).closest('.pagination-sm').attr('data-sel');
        var count = $(this).closest('.pagination-sm').attr('data-count');
        var newPage = '';
        if(page == '-1'){
            if(sel != 1){
                newPage = --sel;
            }else{
                return;
            }
        }else if(page == '+1' ){
            if(sel != count){
                newPage = ++sel;
            }else{
                return;
            }
        }else{
            newPage = page;
        }
        $.ajax({
            type: 'POST',
            url: '/modules/autorestocking/ajax.php',
            data: {id_provider: id_provider, page: newPage, ajax: 5},
            success: function(data){
                $('.place-add-relation').html(data);
            }
        });

    });


    $('body').on('click', '.update-relation', function(e){
        e.preventDefault();
        var parent =  $(this).closest('.items-relation');
        var id_relation = parent.find('input[name=id_relation]').val();
        var min_count = parent.find('input[name=min_count]').val();
        var product_count = parent.find('input[name=product_count]').val();
        var order_day = parent.find('select').val();

        $.ajax({
            type: 'POST',
            url: '/modules/autorestocking/ajax.php',
            data: {id_relations: id_relation,
                min_count: min_count,
                product_count: product_count,
                order_day: order_day,
                ajax: 3},
            success: function(data){
                console.log(data);
                checkReturnData(data);
            }
        });
    });

    $('body').on('click', '.delete-relation', function(e){
        e.preventDefault();
        var page = $(this).closest('.panel').find('.pagination-sm').attr('data-sel');
        var id_provider = $("input[name='id_providers']").val();
        var sel = $(this).closest('.panel').find('.pagination-sm').attr('data-sel');
        var count = $(this).closest('.panel').find('.pagination-sm').attr('data-count');
        var parent =  $(this).closest('.items-relation');
        var id_relation = parent.find('input[name=id_relation]').val();

        console.log(sel , count ,id_provider, page);

        $.ajax({
            type: 'POST',
            url: '/modules/autorestocking/ajax.php',
            data: {id_relation: id_relation,
                ajax: 9},
            success: function(data){
                checkReturnData(data);
                $.ajax({
                    type: 'POST',
                    url: '/modules/autorestocking/ajax.php',
                    data: {id_provider: id_provider, page: page, ajax: 5},
                    success: function(data){
                        $('.place-add-relation').html(data);
                    }
                });
            }
        });
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
    }

    var supervise = {};
    $('.tree-actions a').each(function() {
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
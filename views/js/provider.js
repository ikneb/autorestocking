$( document ).ready(function() {

    $('.list-group-item').click(function(){
        $('.list-group-item').removeClass('active');
        $(this).addClass('active');
    });

    $('#providers_form').submit(function(e){
        e.preventDefault();
        var provider = $('#providers_form').serialize();
        var id_provider = $('#id_providers').val();
        console.log(id_provider);
        $.ajax({
            type: 'POST',
            url: '/modules/autorestocking/ajax.php',
            data: provider,
            success: function(data){
                if(data) {
                    if(id_provider == ''){
                        $('#id_providers').val(data);
                    }
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
    })

    $('.relationForm').submit(function(e){
        e.preventDefault();
        var provider = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '/modules/autorestocking/ajax.php',
            data: provider,
            success: function(data){
                console.log(data);
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
    })

    $('#addRelationForm').submit(function(e){
        e.preventDefault();
        var box = [];
        var submitRelation = $("input[name='submitRelation']").val();
        var product = $("input[name='product_autocomplete']").val();
        var id_providers = $("input[name='id_providers']").val();
        if(id_providers == ''){
            $('#ajax_confirmation').text('Add provider please!').removeClass('hide alert-success').addClass('alert-danger');
            setTimeout(function () {
                $('#ajax_confirmation').addClass('hide');
            }, 2000);
        }

        $('.tree-selected input').each(function(i) {
            box[i] = $(this).val();
        });

        $.ajax({
            type: 'POST',
            url: '/modules/autorestocking/ajax.php',
            data: { box: box, product: product, submitRelation: submitRelation, id_provider: id_providers},
            success: function(data){
                console.log(data);
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

    })

    $('#linkAddRelation').click(function(){
        var id_provider = $("input[name='id_providers']").val();
        $.ajax({
            type: 'POST',
            url: '/modules/autorestocking/ajax_tab.php',
            data: {id_provider: id_provider,ajax_tab: true},
            success: function(data){
                var obj = JSON.parse(data);

                    for (key in obj) {
                        $('.tree-item-name input, .tree-folder-name input').each(function(i) {
                            if($(this).val() == obj[key] ){
                                $(this).attr('checked','checked');
                                $(this).closest('.tree-items-name').addClass('tree-selected');
                            }
                        });
                    }
            }
        });
    })

});
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


});
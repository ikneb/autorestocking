$( document ).ready(function() {

    $('#template_email_form').submit(function(e){
        e.preventDefault();
        var tiny = tinyMCE.activeEditor.getContent();

        $.ajax({
            type: 'POST',
            url: '/modules/autorestocking/ajax.php',
            data: {tiny : tiny, ajax: 2},
            success: function(data){
                checkReturnData(data);
            }
        });
    });



    $('body').on('click', '#configuration_form_submit_btn', function(e){
        e.preventDefault();
        var method_value = '';
        var name = $('#cron_autorestocking_method_1').attr('name');
        if (document.getElementById('cron_autorestocking_method_1').checked) {
            method_value = document.getElementById('cron_autorestocking_method_1').value;
        }else{
            method_value = document.getElementById('cron_autorestocking_method_2').value;
        }
        //console.log(conf);
        $.ajax({
            type: 'POST',
            url: '/modules/autorestocking/ajax.php',
            data: {method_value: method_value, name: name, ajax: 11},
            success: function(data){
                checkReturnData(data);
            }
        });

    });
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
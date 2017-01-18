$( document ).ready(function() {

    $('#template_email_form').submit(function(e){
        e.preventDefault();
        var tiny = tinyMCE.activeEditor.getContent();

        $.ajax({
            type: 'POST',
            url: '/modules/autorestocking/ajax.php',
            data: {tiny : tiny, ajax: 2},
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
    });
});
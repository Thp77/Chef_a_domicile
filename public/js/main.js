$(function() {
    $('select').select2();

    $('#cookiealert > span.btn').click(function() {
        $.ajax({
            url: '/accept_cookie',
            type: 'post',
            success: function(json) {
                $('#cookiealert').hide();
            }
        });
    });



});
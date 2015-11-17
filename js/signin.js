$(function(){
    $(".form-signin").on('submit', function(event){
        event.preventDefault();
        var email = $('#inputEmail').val();
        var data = {
            'email': $('#inputEmail').val(),
            'password': $('#inputPassword').val()
        }
        $.post('php/handleSignin.php', {'data': data}, function(msg){
            if (msg == 1) {
                alert('登录成功');
            };
        });
    });
});
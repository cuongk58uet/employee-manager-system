$(document).ready(function() {
    $(document).on('click', '#submit', function(e) {
        var password = $('#password').val();
        var confirm = $('#password-confirm').val();
        if (password != confirm) {
            e.preventDefault();
            $('#password').val('');
            $('#password-confirm').val('');
            $('#password-confirm').addClass('is-invalid');
            $('.invalid-feedback').text('Password do not match');
        } else {
            $('#form-reset').submit();
        }
    });

});

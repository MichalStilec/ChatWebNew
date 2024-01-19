$(document).ready(function() {
    $('#login-form').submit(function(e) {
        e.preventDefault(); 

        // Get form data
        var username = $('#username').val();
        var password = $('#password').val();
        var action = $('button[type="submit"]:focus').val(); // Gets the value of the focused submit button
        
        $.ajax({
            type: 'POST',
            url: 'login.php',
            data: {
                username: username,
                password: password,
                action: action
            },
            dataType: 'json',
            success: function(response) {
                
                // Handle the response from login.php
                $('#loginmessage').text(response.message); 

                if (action === 'register') {
                    return; // Stop execution here to prevent automatic login
                }

                // Clears the form fields after successful login
                $('#username').val('');
                $('#password').val('');

                // Check if the login was successful
                if (response.success) {
                    setTimeout(function() {
                        location.reload();
                    }, 1200);
                }
            }
        });
    });
});
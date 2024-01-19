<?php
session_start();

function logout()
{
    // Unset session variables
    $_SESSION = array();

    session_destroy();

    header("Location: login.php");
    exit;
}

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    logout();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chattin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="icon" href="images/icon.png">
    <link rel="stylesheet" href="stylesecondary.css">
    <link rel="stylesheet" href="stylegeneral.css">
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="navbar-brand-container">
        </div>
        <div class="navbar-nav nav-middle">
            <a class="nav-link" href="globalchat.php">Global Chat</a>
        </div>
        <div class="navbar-buttons ml-auto">
            <?php if (isset($_SESSION['username'])): ?>
                <span class="nav-link">
                    <?php echo $_SESSION['username']; ?>  
                    <span>&#160;</span>
                    <a href="?action=logout" class="btn btn-sm btn-outline-light">Logout</a>
                </span>
            <?php else: ?>
                <a class="nav-link" href="login.php" id="login"><u>Login</u></a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="container">
        <div id="chat-container">
            <div id="chat-messages"></div>
            <div id="input-container">
                <input type="text" id="message-input" placeholder="Type your message...">
                <button id="send-button">Send</button>
            </div>
        </div>
    </div>


    <footer class="footer">
        <p>&copy; Michal Stilec C4b</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="loginscript.js"></script>
    <script>
        $(document).ready(function () {
            function loadChat() {
                $.ajax({
                    type: 'GET',
                    url: 'chat.php',
                    dataType: 'json',
                    success: function (data) {
                        var chatMessages = $('#chat-messages');
                        chatMessages.empty();
                        data.forEach(function (message) {
                            chatMessages.append('<p><strong>' + message.username + '</strong> (' + message.time + '): ' + message.message + '</p>');
                        });
                        chatMessages.scrollTop(chatMessages[0].scrollHeight);
                    }
                });
            }

            loadChat();

            $('#send-button').click(function () {
                var message = $('#message-input').val();
                $.ajax({
                    type: 'POST',
                    url: 'chat.php',
                    data: { message: message },
                    success: function () {
                        $('#message-input').val('');
                        loadChat();
                    }
                });
            });
            
            function sendMessage() {
                // Check if the user is logged in before sending the message
                $.ajax({
                    type: 'GET',
                    url: 'check_login.php',
                    dataType: 'json',
                    success: function (response) {
                        if (response.isLoggedIn) {
                            var message = $('#message-input').val();

                            if (message.trim() !== '') {
                                $.ajax({
                                    type: 'POST',
                                    url: 'chat.php',
                                    data: { message: message },
                                    success: function () {
                                        // Clear input field
                                        $('#message-input').val('');
                                        // Load updated chat messages
                                        loadChat();
                                    }
                                });
                            }
                        } else {
                            alert('You need to log in to send messages.'); // You can replace this with a more user-friendly notification
                        }
                    }
                });
            }

            // Function to check if the user is logged in
            function isLoggedIn() {
                return <?php echo isset($_SESSION['username']) ? 'true' : 'false'; ?>;
            }

            // Event listener for Enter key press in the message input field
            $('#message-input').keypress(function (e) {
                if (e.which === 13) {
                    e.preventDefault();
                    sendMessage();
                }
            });
            
            setInterval(function () {
                loadChat();
            }, 5000);
        });
    </script>
</body>

</html>

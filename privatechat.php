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
            <a class="nav-link" href="privatechat.php">Private Chat</a>
        </div>
        <div class="navbar-buttons ml-auto">
            <?php if (isset($_SESSION['username'])): ?>
                <a class="nav-link" href="?action=logout"><?php echo $_SESSION['username']; ?></a>
            <?php else: ?>
                <a class="nav-link" href="login.php" id="login"><u>Login</u></a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="container">

    </div>


    <footer class="footer">
        <p>&copy; Michal Stilec C4b</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="loginscript.js"></script>
</body>

</html>

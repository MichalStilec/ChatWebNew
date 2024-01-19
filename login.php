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

// Check if the form is filled
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Gets the username and password that you have written
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Checks the action 
    $action = $_POST['action'];
    if ($action === 'login') {
        handleLogin($username, $password);
    } elseif ($action === 'register') {
        handleRegistration($username, $password);
    }
}

function handleLogin($username, $password)
{
    // This checks if the user is already in the JSON file
    $users = getUsers();
    $user = findUser($username, $users);
    if (!$user) {
        $response = [
            'success' => false,
            'message' => 'Invalid username or password.'
        ];
        echo json_encode($response);
        exit;
    }

    // Verify the password
    if (!password_verify($password, $user['password'])) {
        $response = [
            'success' => false,
            'message' => 'Invalid username or password.'
        ];
        echo json_encode($response);
        exit;
    }

    // Set the logged-in user in the session
    $_SESSION['username'] = $user['username'];

    $response = [
        'success' => true,
        'message' => 'Login successful. Welcome, ' . $user['username'] . '!'
    ];
    echo json_encode($response);
    exit;
}

function handleRegistration($username, $password)
{
    $users = getUsers();
    if (userExists($username, $users)) {
        $response = [
            'success' => false,
            'message' => 'Username already exists. Please choose a different username.'
        ];
        echo json_encode($response);
        exit;
    }

    // Adds the new user
    $users[] = [
        'username' => $username,
        'password' => password_hash($password, PASSWORD_DEFAULT) // Store hashed password
    ];

    // This saves the updated users array to the JSON file
    saveUsers($users);

    $response = [
        'success' => true,
        'message' => 'Registration successful. You can now login.'
    ];
    echo json_encode($response);
    exit;
}

function getUsers()
{
    $data = file_get_contents('users.json');
    return json_decode($data, true);
}

function saveUsers($users)
{
    $data = json_encode($users);
    file_put_contents('users.json', $data);
}

function userExists($username, $users)
{
    foreach ($users as $user) {
        if ($user['username'] === $username) {
            return true;
        }
    }
    return false;
}

function findUser($username, $users)
{
    foreach ($users as $user) {
        if ($user['username'] === $username) {
            return $user;
        }
    }
    return null;
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
        <div id="login-form">
            <h2>Login / Register</h2>
            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="action" value="login">Login</button>
                    <button type="submit" class="btn btn-primary" name="action" value="register">Register</button>
                </div>
            </form>
        </div>
    </div>

    <p id="loginmessage"></p>

    <footer class="footer">
        <p>&copy; Michal Stilec C4b</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="loginscript.js"></script>
</body>

</html>

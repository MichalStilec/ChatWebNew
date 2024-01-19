<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message'];
    $username = $_SESSION['username'];
    $time = date('H:i:s');

    $chatData = json_decode(file_get_contents('chatData.json'), true);

    $chatData[] = [
        'username' => $username,
        'message' => $message,
        'time' => $time,
    ];

    file_put_contents('chatData.json', json_encode($chatData));
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Handle retrieving messages
    $chatData = json_decode(file_get_contents('chatData.json'), true);
    echo json_encode($chatData);
}
?>

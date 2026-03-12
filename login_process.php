<?php
session_start();
require_once 'db.php';
require_once 'functions.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        // Use password_verify if you hashed passwords, otherwise simple compare
        if ($password === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;
            
            // Trigger the log
            logUserActivity($user['id'], "Logged in successfully");
            
            header("Location: dashboard.php");
            exit();
        }
    }
    echo "Invalid username or password. <a href='login.php'>Try again</a>";
}
?>
<?php
session_start();

// Database connection
$host = "localhost";
$user = "root";
$password = "";
$database = "classroom_noise_detection";

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $password = md5($_POST['password']); // match MD5 in DB

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Login successful
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];

        header("Location: Home.php");
        exit();
    } else {
        // Invalid credentials
        $_SESSION['error'] = "Invalid email or password!";
        header("Location: Login.php");
        exit();
    }
}

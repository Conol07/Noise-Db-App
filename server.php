<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'classroom_db');

// Handle Auth
if (isset($_POST['type']) && $_POST['type'] == 'login') {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();
    
    if ($res && password_verify($pass, $res['password'])) {
        $_SESSION['user'] = $user;
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error']);
    }
}

// Handle Noise Logging gpyt ni sir wa jud ko kasabot ge try ra nako mo simulate ba if mic gamit since wala me IOT
if (isset($_POST['type']) && $_POST['type'] == 'log') {
    $val = $_POST['db'];
    $sim = $_POST['is_sim'];
    $stmt = $conn->prepare("INSERT INTO noise_readings (reading, is_simulation) VALUES (?, ?)");
    $stmt->bind_param("di", $val, $sim);
    $stmt->execute();
}
?>
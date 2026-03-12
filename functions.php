<?php
// functions.php

function logUserActivity($userId, $action) {
    global $conn; // Uses the connection from db.php
    $ip = $_SERVER['REMOTE_ADDR'];
    
    // Ensure the table 'user_logs' exists in your database
    $stmt = $conn->prepare("INSERT INTO user_logs (user_id, action, ip_address) VALUES (?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("iss", $userId, $action, $ip);
        $stmt->execute();
        $stmt->close();
    }
}
?>
<?php
require_once 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $fullName = $_POST['full_name']; // New field
    $schoolId = $_POST['school_id']; // New field
    $email = $_POST['email'];

    // Update query including the new columns
    $stmt = $conn->prepare("UPDATE users SET full_name = ?, school_id = ?, email = ? WHERE id = ?");
    $stmt->bind_param("sssi", $fullName, $schoolId, $email, $userId);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => $conn->error]);
    }
}
?>
<?php
require_once 'db.php'; // Your file that defines $conn
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';

    if (!empty($name)) {
        // Use prepared statements to prevent injection
        $stmt = $conn->prepare("INSERT INTO classrooms (name, status) VALUES (?, 'Normal')");
        $stmt->bind_param("s", $name);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => $conn->error]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Empty name']);
    }
}
?>
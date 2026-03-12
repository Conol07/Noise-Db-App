<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'noisedbmeter');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/* ================= Login ================= */
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

/* ================= Noise Logging & Alerts ================= */
if (isset($_POST['type']) && ($_POST['type'] == 'log' || $_POST['type'] == 'alert')) {

    $val = $_POST['db'];
    $sim = $_POST['is_sim'] ?? 1; // default to simulation if not sent
    $location = $_POST['location'] ?? 'Laboratory 1';
    $threshold = 70;

    // Insert into noise_readings
    $stmt = $conn->prepare("INSERT INTO noise_readings (reading, is_simulation, location) VALUES (?, ?, ?)");
    $stmt->bind_param("dis", $val, $sim, $location);
    $stmt->execute();

    // If the reading exceeds threshold, insert into noise_alerts
    if ($val >= $threshold) {
        $stmt2 = $conn->prepare("INSERT INTO noise_alerts (location, noise_level, threshold) VALUES (?, ?, ?)");
        $stmt2->bind_param("sii", $location, $val, $threshold);
        $stmt2->execute();
    }
}
?>
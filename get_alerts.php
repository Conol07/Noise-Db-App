<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'db.php'; 

// 1. Check if the connection exists
if (!isset($conn)) {
    die("Error: Database connection variable \$conn is not defined.");
}

// 2. Run the query
$query = "SELECT classroom_name, timestamp, level, db_value, severity FROM alerts ORDER BY timestamp DESC LIMIT 5";
$result = $conn->query($query);

// 3. Debug the result
if (!$result) {
    die("SQL Error: " . $conn->error);
}

$alerts = [];
while ($row = $result->fetch_assoc()) {
    $alerts[] = $row;
}

// 4. Return JSON
header('Content-Type: application/json');
echo json_encode($alerts);
?>
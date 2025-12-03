<?php
require '../config/conn.php';

header("Content-Type: application/json");

$class = isset($_GET['class']) ? $_GET['class'] : "";

// Base SQL
$sql = "SELECT voter_id, student_name, class, password, created_at FROM voters";

// If filter exists
if (!empty($class)) {
    $stmt = $conn->prepare($sql . " WHERE class = ?");
    $stmt->bind_param("s", $class);
} else {
    $stmt = $conn->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();

$voters = [];
while ($row = $result->fetch_assoc()) {
    $voters[] = $row;
}

echo json_encode([
    "status" => true,
    "data" => $voters
]);

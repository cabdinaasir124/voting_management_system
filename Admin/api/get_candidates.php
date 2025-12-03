<?php
header('Content-Type: application/json');
include('../config/conn.php');

// Presidents
$presQuery = "SELECT * FROM candidates WHERE status = 1 AND position_id = 1";
$presResult = mysqli_query($conn, $presQuery);
$presidents = [];
while ($row = mysqli_fetch_assoc($presResult)) {
    $presidents[] = $row;
}

// Vice Presidents
$vpQuery = "SELECT * FROM candidates WHERE status = 1 AND position_id = 5";
$vpResult = mysqli_query($conn, $vpQuery);
$vicePresidents = [];
while ($row = mysqli_fetch_assoc($vpResult)) {
    $vicePresidents[] = $row;
}

echo json_encode([
    'president' => $presidents,
    'vice' => $vicePresidents
]);

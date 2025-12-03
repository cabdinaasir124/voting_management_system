<?php
header('Content-Type: application/json');
include('../config/conn.php');

// Get POSTed data
$data = json_decode(file_get_contents('php://input'), true);
$voterId    = mysqli_real_escape_string($conn, $data['voterId'] ?? '');
$voterPin   = mysqli_real_escape_string($conn, $data['voterPin'] ?? '');
$presidentId = mysqli_real_escape_string($conn, $data['presidentId'] ?? '');
$viceId     = mysqli_real_escape_string($conn, $data['viceId'] ?? '');

// Check for empty fields
if(empty($voterId) || empty($voterPin) || empty($presidentId) || empty($viceId)){
    echo json_encode([
        'success'=>false,
        'message'=>'Fadlan buuxi dhammaan meelaha loo baahan yahay'
    ]);
    exit;
}

// Verify voter credentials
$voterQuery = "SELECT * FROM voters WHERE voter_id='$voterId' AND password='$voterPin' LIMIT 1";
$voterResult = mysqli_query($conn, $voterQuery);

if(!$voterResult){
    echo json_encode([
        'success'=>false,
        'message'=>'Waxbaa qaldamay marka la baarayay codbixiyaha',
        'error'=>mysqli_error($conn)
    ]);
    exit;
}

if(mysqli_num_rows($voterResult) == 0){
    echo json_encode([
        'success'=>false,
        'message'=>'Voter ID ama PIN-ka waa khalad'
    ]);
    exit;
}

$voter = mysqli_fetch_assoc($voterResult);

// Check if voter already voted
$voteCheck = "SELECT * FROM votes WHERE voter_id='$voterId' LIMIT 1";
$voteResult = mysqli_query($conn, $voteCheck);

if(!$voteResult){
    echo json_encode([
        'success'=>false,
        'message'=>'Waxbaa qaldamay marka la hubinayay cod bixinta hore',
        'error'=>mysqli_error($conn)
    ]);
    exit;
}

if(mysqli_num_rows($voteResult) > 0){
    echo json_encode([
        'success'=>false,
        'message'=>"Salaan {$voter['student_name']}, hore ayaad u codeysay!"
    ]);
    exit;
}

// Insert vote
$insert = "INSERT INTO votes (voter_id, president_id, vice_id, created_at) 
           VALUES ('$voterId', '$presidentId', '$viceId', NOW())";

if(mysqli_query($conn, $insert)){
    echo json_encode([
        'success'=>true,
        'message'=>"Mahadsanid {$voter['student_name']}! Codkaaga waa la diiwaangeliyey."
    ]);
} else {
    echo json_encode([
        'success'=>false,
        'message'=>'Codka lama diiwaangelin',
        'error'=>mysqli_error($conn)
    ]);
}

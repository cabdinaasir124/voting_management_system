<?php
session_start();
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if(!isset($data['username']) || !isset($data['password'])) {
    echo json_encode(['status'=>'error', 'message'=>'Missing credentials']);
    exit;
}

require_once '../config.php'; // adjust path if needed

$username = trim($data['username']);
$password = trim($data['password']);

$stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
$stmt->bindParam(':username', $username);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if($user && password_verify($password, $user['password'])){
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];

    echo json_encode(['status'=>'success']);
} else {
    echo json_encode(['status'=>'error', 'message'=>'Invalid username or password']);
}
?>

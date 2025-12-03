<?php
header("Content-Type: application/json");
include "../config/conn.php"; // your DB connection file

$action = $_POST['action'] ?? $_GET['action'] ?? '';

if ($action === "fetch") {
    $sql = $conn->query("SELECT id, username, role, created_at FROM users ORDER BY id DESC");
    $data = [];
    while ($row = $sql->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode(["status" => true, "data" => $data]);
    exit;
}

/* CREATE USER */
if ($action === "add") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $role);

    if ($stmt->execute()) {
        echo json_encode(["status" => true, "message" => "User created successfully"]);
    } else {
        echo json_encode(["status" => false, "message" => "Failed to add user"]);
    }
    exit;
}

/* GET SINGLE USER */
if ($action === "getUser") {
    $id = $_GET['id'];
    $sql = $conn->query("SELECT * FROM users WHERE id = '$id'");
    echo json_encode($sql->fetch_assoc());
    exit;
}

/* UPDATE USER */
if ($action === "update") {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $role = $_POST['role'];

    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $conn->query("UPDATE users SET username='$username', role='$role', password='$password' WHERE id='$id'");
    } else {
        $conn->query("UPDATE users SET username='$username', role='$role' WHERE id='$id'");
    }

    echo json_encode(["status" => true, "message" => "User updated successfully"]);
    exit;
}

/* DELETE USER */
if ($action === "delete") {
    $id = $_POST['id'];
    if ($conn->query("DELETE FROM users WHERE id='$id'")) {
        echo json_encode(["status" => true, "message" => "User deleted"]);
    } else {
        echo json_encode(["status" => false, "message" => "Delete failed"]);
    }
    exit;
}

echo json_encode(["status" => false, "message" => "Invalid action"]);
?>

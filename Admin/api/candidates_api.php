<?php
include "../config/conn.php";
header("Content-Type: application/json");

$action = $_GET['action'] ?? '';


// ----------------------------------------------------------------------
// 1️⃣ FETCH POSITIONS (status = active only)
// ----------------------------------------------------------------------
if ($action == "get_positions") {

    $sql = "SELECT id, position_name FROM positions WHERE status = 1 ORDER BY priority ASC";
    $query = $conn->query($sql);

    $data = [];
    while ($row = $query->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode(["status" => true, "data" => $data]);
    exit;
}



// ----------------------------------------------------------------------
// 2️⃣ ADD CANDIDATE
// ----------------------------------------------------------------------
if ($action == "add_candidate") {

    $full_name  = $_POST['f_name'];
    $phone      = $_POST['p_num'];
    $sex        = $_POST['sex'];
    $position   = $_POST['position'];  // position_id
    $age        = $_POST['Age'];
    $email      = $_POST['email'] ?? "";  // optional
    $status     = 1; // active

    // Upload Image
    $fileName = "";
   if (!empty($_FILES['file']['name'])) {

    $fileName = time() . "_" . $_FILES['file']['name'];
    $uploadPath = "../uploads/" . $fileName;

    if (!move_uploaded_file($_FILES['file']['tmp_name'], $uploadPath)) {
        echo json_encode(["status" => false, "message" => "File upload failed"]);
        exit;
    }
}


  $stmt = $conn->prepare("INSERT INTO candidates 
    (full_name, email, phone, position_id, status, image, sex, age)
    VALUES (?,?,?,?,?,?,?,?)");

if (!$stmt) {
    echo json_encode([
        "status" => false,
        "message" => "Prepare failed",
        "error" => $conn->error
    ]);
    exit;
}

$stmt->bind_param("sssiissi", 
    $full_name, 
    $email,
    $phone, 
    $position, 
    $status, 
    $fileName, 
    $sex,
    $age
);


    if ($stmt->execute()) {
        echo json_encode(["status" => true, "message" => "Candidate added successfully"]);
    } else {
        echo json_encode(["status" => false, "message" => "Database insert failed"]);
    }

    exit;
}



// ----------------------------------------------------------------------
// 3️⃣ FETCH CANDIDATES AS CARDS
// ----------------------------------------------------------------------
if ($action == "get_candidates") {

    $sql = "SELECT c.*, p.position_name 
            FROM candidates c
            LEFT JOIN positions p ON p.id = c.position_id
            ORDER BY c.id DESC";

    $query = $conn->query($sql);

    $data = [];
    while ($row = $query->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode(["status" => true, "data" => $data]);
    exit;
}



// ----------------------------------------------------------------------
echo json_encode(["status" => false, "message" => "Invalid action"]);
?>

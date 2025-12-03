<?php
// File: api/positions_api.php
// Purpose: Single AJAX endpoint to list/add/edit/delete/export positions (JSON)

header('Content-Type: application/json');
include __DIR__ . '/../config/conn.php'; // adjust path if needed

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'list';

// ---------------- LIST ----------------
if ($action == 'list') {
    $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
    $sort = isset($_GET['sort']) ? $conn->real_escape_string($_GET['sort']) : 'priority';
    $order = (isset($_GET['order']) && strtoupper($_GET['order']) == 'DESC') ? 'DESC' : 'ASC';
    $page = isset($_GET['page']) ? max(1,intval($_GET['page'])) : 1;
    $per_page = isset($_GET['per_page']) ? intval($_GET['per_page']) : 10;
    $offset = ($page-1) * $per_page;

    $where = "WHERE 1";
    if ($search !== '') $where .= " AND (position_name LIKE '%$search%' OR description LIKE '%$search%')";

    $totalRes = $conn->query("SELECT COUNT(*) AS cnt FROM positions $where");
    $total = intval($totalRes->fetch_assoc()['cnt']);

    $res = $conn->query("SELECT * FROM positions $where ORDER BY $sort $order LIMIT $offset, $per_page");
    $data = [];
    while ($row = $res->fetch_assoc()) $data[] = $row;

    echo json_encode(['status'=>'success','data'=>$data,'total'=>$total,'page'=>$page,'per_page'=>$per_page]);
    exit;
}

// ---------------- ADD ----------------
if ($action == 'add') {
    $post = json_decode(file_get_contents('php://input'), true);
    $name = trim($conn->real_escape_string($post['position_name'] ?? ''));
    $max_candidates = intval($post['max_candidates'] ?? 1);
    $priority = intval($post['priority'] ?? 1);
    $description = trim($conn->real_escape_string($post['description'] ?? ''));

    if ($name == '') { echo json_encode(['status'=>'error','message'=>'Position name required']); exit; }

    $stmt = $conn->prepare("INSERT INTO positions (position_name, max_candidates, priority, description, status) VALUES (?, ?, ?, ?, 1)");
    $stmt->bind_param('siis', $name, $max_candidates, $priority, $description);
    if ($stmt->execute()) echo json_encode(['status'=>'success','message'=>'Position added']);
    else echo json_encode(['status'=>'error','message'=>'DB error']);
    exit;
}

// ---------------- EDIT ----------------
if ($action == 'edit') {
    $post = json_decode(file_get_contents('php://input'), true);
    $id = intval($post['id'] ?? 0);
    $name = trim($conn->real_escape_string($post['position_name'] ?? ''));
    $max_candidates = intval($post['max_candidates'] ?? 1);
    $priority = intval($post['priority'] ?? 1);
    $description = trim($conn->real_escape_string($post['description'] ?? ''));
    $status = (isset($post['status']) && $post['status']=='1') ? 1 : 0;

    if ($id <= 0 || $name == '') { echo json_encode(['status'=>'error','message'=>'Invalid data']); exit; }

    $stmt = $conn->prepare("UPDATE positions SET position_name=?, max_candidates=?, priority=?, description=?, status=? WHERE id=?");
    $stmt->bind_param('siisii', $name, $max_candidates, $priority, $description, $status, $id);
    if ($stmt->execute()) echo json_encode(['status'=>'success','message'=>'Position updated']);
    else echo json_encode(['status'=>'error','message'=>'DB error']);
    exit;
}

// ---------------- DELETE ----------------
if ($action == 'delete') {
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    if ($id <= 0) { echo json_encode(['status'=>'error']); exit; }
    $stmt = $conn->prepare("DELETE FROM positions WHERE id = ?");
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) echo json_encode(['status'=>'success']);
    else echo json_encode(['status'=>'error']);
    exit;
}

// ---------------- GET SINGLE ----------------
if ($action == 'get') {
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    if ($id <= 0) { echo json_encode(['status'=>'error']); exit; }
    $res = $conn->query("SELECT * FROM positions WHERE id = $id LIMIT 1");
    if ($res && $res->num_rows) echo json_encode(['status'=>'success','data'=>$res->fetch_assoc()]);
    else echo json_encode(['status'=>'error','message'=>'Position not found']);
    exit;
}

// ---------------- EXPORT CSV ----------------
if ($action == 'export') {
    $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
    $where = "WHERE 1";
    if ($search !== '') $where .= " AND (position_name LIKE '%$search%' OR description LIKE '%$search%')";

    $res = $conn->query("SELECT id, position_name, max_candidates, priority, status, created_at FROM positions $where ORDER BY priority ASC");

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="positions_export.csv"');

    $out = fopen('php://output', 'w');
    fputcsv($out, ['ID','Position Name','Max Candidates','Priority','Status','Created At']);
    while ($row = $res->fetch_assoc()) {
        fputcsv($out, [$row['id'],$row['position_name'],$row['max_candidates'],$row['priority'],($row['status']==1?'Active':'Inactive'),$row['created_at']]);
    }
    fclose($out);
    exit;
}

// ---------------- DEFAULT ----------------
echo json_encode(['status'=>'error','message'=>'Unknown action']);
exit;
?>

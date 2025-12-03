<?php
header('Content-Type: application/json');

$conn = new mysqli("localhost","root","","kaamil_voting");
if($conn->connect_error){
    die(json_encode(['error'=>"DB Connection failed: ".$conn->connect_error]));
}

// Total votes
$totalVotesResult = $conn->query("SELECT COUNT(*) as total FROM votes");
if(!$totalVotesResult){
    die(json_encode(['error'=>"Total votes query failed: ".$conn->error]));
}
$totalVotesRow = $totalVotesResult->fetch_assoc();
$totalVotes = $totalVotesRow['total'];

// Fetch candidates
$candidates = [];
$sql = "SELECT c.id, c.full_name, c.position_id, c.image, p.position_name as position,
        (SELECT COUNT(*) FROM votes v WHERE v.president_id = c.id OR v.vice_id = c.id) as votes
        FROM candidates c 
        LEFT JOIN positions p ON c.position_id = p.id
        ORDER BY votes DESC";

$result = $conn->query($sql);
if(!$result){
    die(json_encode(['error'=>"Candidates query failed: ".$conn->error]));
}

while($row = $result->fetch_assoc()){
    $candidates[] = $row;
}

echo json_encode(['candidates'=>$candidates, 'totalVotes'=>$totalVotes]);
?>
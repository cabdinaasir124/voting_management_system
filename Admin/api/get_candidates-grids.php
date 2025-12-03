<?php
header("Content-Type: application/json");
include('../config/conn.php');

$response = [];

// Get all candidates with positions
$sql = "
    SELECT 
        c.id,
        c.full_name,
        c.image,
        p.position_name,
        p.priority
    FROM candidates c
    LEFT JOIN positions p ON p.id = c.position_id
    ORDER BY p.priority ASC, c.full_name ASC
";

$query = $conn->query($sql);

if (!$query) {
    die(json_encode(["error" => "SQL ERROR: " . $conn->error]));
}

while ($row = $query->fetch_assoc()) {

    // Determine vote column
    $voteColumn = '';
    if (strtolower($row['position_name']) === 'president') {
        $voteColumn = 'president_id';
    } elseif (strtolower($row['position_name']) === 'vice president' || strtolower($row['position_name']) === 'vice-president') {
        $voteColumn = 'vice_id';
    } else {
        $voteColumn = null; // other positions
    }

    $totalVotes = 0;
    $percentage = 0;

    if ($voteColumn) {
        // Count votes for this candidate
        $voteQuery = $conn->query("SELECT COUNT(*) AS total FROM votes WHERE $voteColumn = {$row['id']}");
        $totalVotes = $voteQuery->fetch_assoc()['total'] ?? 0;

        // Count total votes for this position
        $positionVotesQuery = $conn->query("SELECT COUNT(*) AS total FROM votes WHERE $voteColumn IS NOT NULL");
        $totalPositionVotes = $positionVotesQuery->fetch_assoc()['total'] ?? 0;

        if ($totalPositionVotes > 0) {
            $percentage = round(($totalVotes / $totalPositionVotes) * 100, 2);
        }
    }

    $response[] = [
        "id"         => $row['id'],
        "name"       => $row['full_name'],
        "image"      => $row['image'],
        "votes"      => $totalVotes,
        "position"   => $row['position_name'],
        "percentage" => $percentage
    ];
}

echo json_encode($response);
?>

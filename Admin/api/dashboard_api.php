<?php
header('Content-Type: application/json');
include '../config/conn.php';

try {
    // Total voters
    $stmtVoters = $conn->prepare("SELECT COUNT(*) AS total FROM voters");
    $stmtVoters->execute();
    $totalVoters = $stmtVoters->get_result()->fetch_assoc()['total'];

    // New voters this week
    $stmtNewWeek = $conn->prepare("SELECT COUNT(*) AS new_week FROM voters WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)");
    $stmtNewWeek->execute();
    $newWeek = $stmtNewWeek->get_result()->fetch_assoc()['new_week'];

    // Total candidates
    $stmtCandidates = $conn->prepare("SELECT COUNT(*) AS total FROM candidates");
    $stmtCandidates->execute();
    $totalCandidates = $stmtCandidates->get_result()->fetch_assoc()['total'];

    // Positions covered
    $stmtPositionsCovered = $conn->prepare("SELECT COUNT(DISTINCT position_id) AS positions_covered FROM candidates");
    $stmtPositionsCovered->execute();
    $positionsCovered = $stmtPositionsCovered->get_result()->fetch_assoc()['positions_covered'];

    // Total positions
    $stmtPositions = $conn->prepare("SELECT COUNT(*) AS total_positions FROM positions");
    $stmtPositions->execute();
    $totalPositions = $stmtPositions->get_result()->fetch_assoc()['total_positions'];

    // New positions this week
    $stmtNewPositions = $conn->prepare("SELECT COUNT(*) AS new_positions FROM positions WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)");
    $stmtNewPositions->execute();
    $newPositions = $stmtNewPositions->get_result()->fetch_assoc()['new_positions'];

    // Calculate positions coverage percentage
    $positionsPercentage = ($positionsCovered / max($totalPositions,1)) * 100; // avoid division by zero

    // Total votes cast
    $stmtVotes = $conn->prepare("SELECT COUNT(*) AS total_votes FROM votes");
    $stmtVotes->execute();
    $totalVotes = $stmtVotes->get_result()->fetch_assoc()['total_votes'];

   // President votes
$presidentVotes = [];
$sqlPresidentVotes = $conn->query("
    SELECT c.full_name, COUNT(v.id) AS votes
    FROM candidates c
    LEFT JOIN votes v ON v.president_id = c.id
    WHERE c.position_id = 1
    GROUP BY c.id
");
while($row = $sqlPresidentVotes->fetch_assoc()){
    $firstName = explode(' ', trim($row['full_name']))[0];
    $presidentVotes[] = [
        'full_name' => $firstName,
        'votes' => $row['votes']
    ];
}

// Vice president votes
$viceVotes = [];
$sqlViceVotes = $conn->query("
    SELECT c.full_name, COUNT(v.id) AS votes
    FROM candidates c
    LEFT JOIN votes v ON v.vice_id = c.id
    WHERE c.position_id = 5
    GROUP BY c.id
");
while($row = $sqlViceVotes->fetch_assoc()){
    $firstName = explode(' ', trim($row['full_name']))[0];
    $viceVotes[] = [
        'full_name' => $firstName,
        'votes' => $row['votes']
    ];
}


// Vice president votes
$viceVotes = [];
$sqlViceVotes = $conn->query("
    SELECT c.full_name, COUNT(v.id) AS votes
    FROM candidates c
    LEFT JOIN votes v ON v.vice_id = c.id
    WHERE c.position_id = 5
    GROUP BY c.id
");
while($row = $sqlViceVotes->fetch_assoc()){
    // Take only the first name
    $firstName = explode(' ', trim($row['full_name']))[0];
    $viceVotes[] = [
        'full_name' => $firstName,
        'votes' => $row['votes']
    ];
}

// Votes per position
$positionVotes = [];
$sqlPositions = $conn->query("SELECT id, position_name FROM positions");
while($pos = $sqlPositions->fetch_assoc()){
    $positionId = $pos['id'];
    $positionName = $pos['position_name'];

    // Count votes where this position is covered
    $sqlVotes = $conn->query("
        SELECT COUNT(*) AS votes
        FROM votes v
        LEFT JOIN candidates c 
        ON ( (v.president_id = c.id AND c.position_id = $positionId) 
             OR (v.vice_id = c.id AND c.position_id = $positionId) )
    ");
    $votesCount = $sqlVotes->fetch_assoc()['votes'];

    $positionVotes[] = [
        'position_name' => $positionName,
        'votes' => (int)$votesCount
    ];
}

// Voter Turnout - Hourly (24 hours)
$hourlyTurnout = [];
for($h = 0; $h <= 23; $h++){
    $start = sprintf("%02d:00:00", $h);
    $end   = sprintf("%02d:59:59", $h);

    $stmtHour = $conn->prepare("
        SELECT COUNT(*) AS voters_count
        FROM votes
        WHERE TIME(created_at) BETWEEN ? AND ?
    ");
    $stmtHour->bind_param("ss", $start, $end);
    $stmtHour->execute();
    $votersCount = $stmtHour->get_result()->fetch_assoc()['voters_count'];

    // Label: 12 AM, 1 AM, ..., 11 PM
    $hourLabel = date("g A", strtotime($start));
    $hourlyTurnout[] = [
        'hour' => $hourLabel,
        'voters' => (int)$votersCount
    ];
}




    // Turnout rate = votes / total voters * 100
    $turnoutRate = ($totalVoters > 0) ? ($totalVotes / $totalVoters) * 100 : 0;

   echo json_encode([
    'status' => true,
    'voters' => [
        'total' => $totalVoters,
        'new_week' => $newWeek
    ],
    'candidates' => [
        'total' => $totalCandidates,
        'positions_covered' => $positionsCovered,
        'percentage' => round($positionsPercentage, 2)
    ],
    'positions' => [
        'total' => $totalPositions,
        'new_week' => $newPositions
    ],
   'votes' => [
    'total' => $totalVotes,
    'turnout' => round($turnoutRate, 2),
    'president' => $presidentVotes,
    'vice_president' => $viceVotes,
    'per_position' => $positionVotes,
    'hourly_turnout' => $hourlyTurnout  // ✅ hourly turnout added
]

]);


} catch (Exception $e) {
    echo json_encode([
        'status' => false,
        'message' => $e->getMessage()
    ]);
}
?>

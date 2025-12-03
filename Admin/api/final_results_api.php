<?php
header('Content-Type: application/json');
include '../config/conn.php';

try {
    // Fetch all positions
    $positions = [];
    $sqlPositions = $conn->query("SELECT id, position_name FROM positions ORDER BY priority ASC");

    while ($pos = $sqlPositions->fetch_assoc()) {
        $positionId = $pos['id'];
        $positionName = $pos['position_name'];

        // Fetch candidates for this position with vote counts
        $candidates = [];
        $sqlCandidates = $conn->query("
            SELECT c.full_name, COUNT(v.id) AS votes
            FROM candidates c
            LEFT JOIN votes v ON 
                (c.position_id = 1 AND v.president_id = c.id) OR
                (c.position_id != 1 AND v.vice_id = c.id)
            WHERE c.position_id = $positionId
            GROUP BY c.id
            ORDER BY votes DESC
        ");

        $maxVotes = 0;
        while ($row = $sqlCandidates->fetch_assoc()) {
            $votes = (int)$row['votes'];
            if ($votes > $maxVotes) $maxVotes = $votes;

            $candidates[] = [
                'name' => explode(' ', $row['full_name'])[0], // first name
                'votes' => $votes
            ];
        }

        // Mark winner(s)
        foreach ($candidates as &$c) {
            $c['winner'] = ($c['votes'] == $maxVotes && $maxVotes > 0) ? true : false;
        }

        $positions[] = [
            'id' => $positionId,
            'position_name' => $positionName,
            'candidates' => $candidates
        ];
    }

    echo json_encode([
        'status' => true,
        'results' => $positions
    ]);

} catch (Exception $e) {
    echo json_encode([
        'status' => false,
        'message' => $e->getMessage()
    ]);
}
?>

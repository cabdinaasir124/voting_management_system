<?php
require '../config/conn.php'; // Database connection
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

header('Content-Type: application/json');

/**
 * Generate a unique 4-digit numeric password
 */
function generateUniquePassword($conn) {
    do {
        $password = rand(1000, 9999); // 4-digit number
        $stmt = $conn->prepare("SELECT id FROM voters WHERE password = ?");
        $stmt->bind_param("s", $password);
        $stmt->execute();
        $stmt->store_result();
    } while($stmt->num_rows > 0);
    return $password;
}

/**
 * Get next voter count for generating voter ID
 */
function getNextVoterCount($conn) {
    $result = $conn->query("SELECT COUNT(*) as total FROM voters");
    $row = $result->fetch_assoc();
    return $row['total'] + 1;
}

if(isset($_FILES['excel_file'])) {
    $filePath = $_FILES['excel_file']['tmp_name'];

    try {
        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        $count = 0;
        $voterStart = getNextVoterCount($conn);

        for($i = 1; $i < count($rows); $i++) { // Skip header row
            $studentName = trim($rows[$i][0]);
            $class = trim($rows[$i][1]);

            if(empty($studentName) || empty($class)) continue;

            // Generate Voter ID
            $voterId = 'KML-' . str_pad($voterStart + $count, 3, '0', STR_PAD_LEFT);

            // Generate unique 4-digit numeric password
            $password = generateUniquePassword($conn);

            // Insert into database
            $stmt = $conn->prepare("INSERT INTO voters (student_name, class, voter_id, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $studentName, $class, $voterId, $password);
            $stmt->execute();

            $count++;
        }

        echo json_encode([
            'status' => true,
            'message' => "Voters imported successfully!",
            'total_imported' => $count
        ]);

    } catch(Exception $e) {
        echo json_encode([
            'status' => false,
            'message' => "Error reading Excel file: " . $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'status' => false,
        'message' => "No file uploaded."
    ]);
}

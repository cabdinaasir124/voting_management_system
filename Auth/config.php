<?php
$host = "localhost";
$dbname = "kaamil_voting";  // change to your DB name
$dbuser = "root";        // your DB user
$dbpass = "";            // your DB password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

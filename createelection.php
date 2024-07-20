<?php
require 'db.php';

$title = "Student Council Election";
$description = "Election for the 2024 Student Council";
$start_date = "2024-09-01 08:00:00";
$end_date = "2024-09-05 18:00:00";

$stmt = $conn->prepare("INSERT INTO elections (title, description, start_date, end_date) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $title, $description, $start_date, $end_date);

if ($stmt->execute()) {
    $election_id = $stmt->insert_id;
    echo "Election created successfully!";
} else {
    echo "Error: " . $stmt->error;
}
?>

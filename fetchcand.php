<?php
require 'db.php';

$election_id = $_GET['election_id'];

$stmt = $conn->prepare("SELECT id, name, description FROM candidates WHERE election_id = ?");
$stmt->bind_param("i", $election_id);
$stmt->execute();
$result = $stmt->get_result();

$candidates = [];
while ($row = $result->fetch_assoc()) {
    $candidates[] = $row;
}

echo json_encode($candidates);
?>

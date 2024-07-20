<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to vote.";
    exit;
}

$user_id = $_SESSION['user_id'];
$election_id = 1; // The student council election ID
$candidate_id = $_POST['candidate_id'];

$stmt = $conn->prepare("INSERT INTO votes (user_id, election_id, candidate_id) VALUES (?, ?, ?)");
$stmt->bind_param("iii", $user_id, $election_id, $candidate_id);

if ($stmt->execute()) {
    echo "Vote cast successfully!";
} else {
    echo "Error: " . $stmt->error;
}
?>

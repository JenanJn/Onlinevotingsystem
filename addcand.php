<?php
require 'db.php';

$election_id = 1;

$candidates = [
    ["name" => "John Doe", "description" => "Candidate for President"],
    ["name" => "Jane Smith", "description" => "Candidate for Vice President"],
    ["name" => "Emily Johnson", "description" => "Candidate for Treasurer"]
];

foreach ($candidates as $candidate) {
    $stmt = $conn->prepare("INSERT INTO candidates (election_id, name, description) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $election_id, $candidate['name'], $candidate['description']);

    if ($stmt->execute()) {
        echo "Candidate " . $candidate['name'] . " added successfully!<br>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
    }
}
?>

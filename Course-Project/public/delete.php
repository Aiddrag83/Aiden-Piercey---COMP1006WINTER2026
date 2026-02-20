<?php
include("../config/database.php");

// Ensure ID exists
if (!isset($_GET['id'])) {
    die("Resume ID not provided.");
}

$id = $_GET['id'];

// Delete record
$stmt = $conn->prepare("DELETE FROM resumes WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

// Redirect back to index
header("Location: index.php");
exit;
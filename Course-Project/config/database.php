<?php
// Database connection file

$host = "localhost";
$username = "root";
$password = "";
$database = "resume_builder_live";

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Checking said connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
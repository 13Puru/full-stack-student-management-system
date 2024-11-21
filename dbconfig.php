<?php
// Database configuration
$servername = "localhost"; // Typically localhost for local development
$username = "root";        // Your MySQL username (default is 'root' for WAMP, XAMPP, etc.)
$password = "";            // Your MySQL password (default is empty for local setups)
$dbname = "fsms"; // Your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optionally, set the character encoding to handle special characters
$conn->set_charset("utf8");
?>

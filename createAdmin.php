<?php
include 'dbconfig.php';

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Predefined admin credentials
$admin_username = "admin"; // Predefined username
$admin_password = "admin@1234"; // Predefined password
$otp = ""; // Optional OTP (can be empty or you can set a value)

// Hash the password
$hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);

// Prepare SQL to insert admin into the database
$stmt = $conn->prepare("INSERT INTO admins (username, password, otp) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $admin_username, $hashed_password, $otp);

// Execute the statement
if ($stmt->execute()) {
    echo "Admin created successfully.";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>

<?php
include 'dbconfig.php';
include('checklogin.php');

// Check if the required parameters are set
if (isset($_GET['student_id']) && isset($_GET['current_class'])) {
    $student_id = $_GET['student_id'];
    $current_class = $_GET['current_class'];

    // Check if the student is already in Class 10 (no promotion beyond this point)
    if ($current_class >= 10) {
        echo json_encode(['success' => false, 'message' => 'Student is already in Class 10 and cannot be promoted further.']);
        exit();
    }

    // Increment the class by 1
    $new_class = $current_class + 1;

    // Update the student's admission class in the database
    $update_query = "UPDATE students SET admission_class = ? WHERE student_id = ?";
    $stmt = mysqli_prepare($conn, $update_query);
    mysqli_stmt_bind_param($stmt, 'ii', $new_class, $student_id);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true, 'message' => "Student has been successfully promoted to Class {$new_class}."]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error occurred while promoting the student.']);
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request. Missing parameters.']);
}

// Close the database connection
mysqli_close($conn);
?>

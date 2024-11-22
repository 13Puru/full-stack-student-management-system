<?php
include 'dbconfig.php';

// Check if a file has been uploaded
if (isset($_FILES['marksheet']) && $_FILES['marksheet']['error'] == UPLOAD_ERR_OK) {
    $studentId = $_POST['student_id'];
    $marksheet = $_FILES['marksheet'];

    // Validate file type (only allow PDF)
    if ($marksheet['type'] !== 'application/pdf') {
        die("Invalid file type. Only PDF files are allowed.");
    }

    // Validate file size (max 10MB)
    if ($marksheet['size'] > 10 * 1024 * 1024) {
        die("File size exceeds the maximum limit of 10MB.");
    }

    // Read the content of the uploaded PDF file
    $fileContent = file_get_contents($marksheet['tmp_name']);

    // Prepare the SQL query to insert the file content into the database
    $query = "INSERT INTO marksheet (student_id, marksheet_data) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    // Bind the parameters and execute the query
    mysqli_stmt_bind_param($stmt, 'ib', $studentId, $fileContent);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "Marksheet uploaded successfully.";
    } else {
        echo "Error uploading the marksheet: " . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    echo "No file uploaded or there was an error during the upload.";
}
?>

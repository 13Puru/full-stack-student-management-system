<?php
include 'dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if a file has been uploaded
    if (isset($_FILES['marksheet']) && $_FILES['marksheet']['error'] === UPLOAD_ERR_OK) {
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

        // Ensure the content is not empty
        if (strlen($fileContent) === 0) {
            die("The uploaded file appears to be empty.");
        }

        // Prepare the SQL query to insert the file content into the database
        $query = "INSERT INTO marksheet (student_id, marksheet_data) VALUES (?, ?)";
        $stmt = $conn->prepare($query);

        if (!$stmt) {
            die("Database preparation error: " . $conn->error);
        }

        // Bind the parameters
        $stmt->bind_param('ib', $studentId, $fileContent);

        // Send long data for BLOB
        $stmt->send_long_data(1, $fileContent);

        // Execute the query
        if ($stmt->execute()) {
            echo "Marksheet uploaded successfully.";

            // Verify the length of the stored data
            $verifyQuery = "SELECT LENGTH(marksheet_data) AS file_length FROM marksheet WHERE student_id = ? ORDER BY id DESC LIMIT 1";
            $verifyStmt = $conn->prepare($verifyQuery);

            if ($verifyStmt) {
                $verifyStmt->bind_param('i', $studentId);
                $verifyStmt->execute();
                $verifyStmt->bind_result($fileLength);
                $verifyStmt->fetch();

                if ($fileLength > 0) {
                    echo " File successfully stored with a size of $fileLength bytes.";
                } else {
                    echo " File storage failed.";
                }
                $verifyStmt->close();
            } else {
                echo "Verification query preparation failed: " . $conn->error;
            }
        } else {
            echo "Error uploading the marksheet: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "No file uploaded or there was an error during the upload.";
    }
} else {
    echo "Invalid request method.";
}
?>

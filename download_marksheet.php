<?php
include 'dbconfig.php';

// Check if student_id or marksheet_id is provided
if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];

    // Fetch the latest marksheet
    $query = "SELECT marksheet_data, upload_date FROM marksheet WHERE student_id = ? ORDER BY upload_date DESC LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $marksheet = $result->fetch_assoc();
        $marksheet_data = $marksheet['marksheet_data'];
        $upload_date = date("Y-m-d", strtotime($marksheet['upload_date'])); // Use upload_date to generate file name

        // Set headers to download the file
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="marksheet_' . $upload_date . '.pdf"');
        echo $marksheet_data;
    } else {
        echo "No marksheet found for this student.";
    }
} elseif (isset($_GET['marksheet_id'])) {
    $marksheet_id = $_GET['marksheet_id'];

    // Fetch the specific marksheet
    $query = "SELECT marksheet_data, upload_date FROM marksheet WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $marksheet_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $marksheet = $result->fetch_assoc();
        $marksheet_data = $marksheet['marksheet_data'];
        $upload_date = date("Y-m-d", strtotime($marksheet['upload_date'])); // Use upload_date to generate file name

        // Set headers to download the file
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="marksheet_' . $upload_date . '.pdf"');
        echo $marksheet_data;
    } else {
        echo "Marksheets not found.";
    }
} else {
    echo "Invalid request.";
}

$stmt->close();
$conn->close();
?>

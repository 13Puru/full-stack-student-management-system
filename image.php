<?php
include 'dbconfig.php';

// Check if an ID is provided
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $query = "SELECT image FROM registration_requests WHERE id = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($imageContent);

        if ($stmt->fetch()) {
            header("Content-Type: image/jpeg"); // Adjust MIME type if necessary
            echo $imageContent;
        } else {
            echo "Image not found.";
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
} else {
    echo "No image ID specified.";
}
?>

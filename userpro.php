<?php
include 'dbconfig.php';
include('checklogin.php');
session_start();

// Fetch student ID from session
$student_id = $_SESSION['student_id']; // Ensure this is set after login

// Fetch student data
$query = "SELECT * FROM students WHERE student_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $student = $result->fetch_assoc();
    $student_name = $student['name'];
    $student_fathers_name = $student['father_name'];
    $student_phone = $student['mobile_number'];
    $student_email = $student['username'];
    $student_class = $student['admission_class'];
    $student_roll_number = $student['student_id'];
    $student_status = $student['status'];
    $student_image = $student['image']; // Image stored as a BLOB
} else {
    echo "No student found.";
    exit;
}

// Fetch notices
$notices_query = "SELECT * FROM notices ORDER BY created_at DESC";
$notices_result = $conn->query($notices_query);

// Close statement and connection
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/full-stack-student-management-system/css/style.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .profile-card,
        .notice-card {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .profile-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #007bff;
        }

        .profile-header {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border-radius: 10px 10px 0 0;
            text-align: center;
        }

        .notice-header {
            background-color: #17a2b8;
            color: white;
            padding: 10px;
            border-radius: 10px 10px 0 0;
            text-align: center;
        }

        .notice-item {
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><ion-icon name="book-outline"></ion-icon>FSMS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                
                </ul>
                <span class="navbar-text">
                    Student-Management-System
                </span>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <!-- Profile Card -->
            <div class="col-lg-8">
                <div class="profile-card">
                    <!-- Header -->
                    <div class="profile-header">
                        <h2>Student Profile</h2>
                    </div>
                    <!-- Body -->
                    <div class="text-center">
                        <!-- Display the student's image -->
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($student_image); ?>" 
                            alt="Student Image" class="profile-img mb-3">
                        <h3><?php echo $student_name; ?></h3>
                        <p class="text-muted">Class: <?php echo $student_class; ?></p>
                    </div>

                    <hr>

                    <!-- Personal Information -->
                    <h5>Personal Information</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Full Name:</strong> <?php echo $student_name; ?></p>
                            <p><strong>Father's Name:</strong> <?php echo $student_fathers_name; ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Mobile Number:</strong> <?php echo $student_phone; ?></p>
                            <p><strong>Email:</strong> <?php echo $student_email; ?></p>
                        </div>
                    </div>

                    <hr>

                    <!-- Academic Details -->
                    <h5>Academic Details</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Current Class:</strong> <?php echo $student_class; ?></p>
                            <p><strong>Student ID:</strong> <?php echo $student_roll_number; ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Status:</strong> <?php echo $student_status; ?></p>
                        </div>
                    </div>

                    <hr>

                    <!-- Actions -->
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-success btn-sm">Download Report</button>
                        <a href="logout.php" class="btn btn-danger">Logout</a>
                        <button class="btn btn-secondary btn-sm">View Academic History</button>
                    </div>
                </div>
            </div>

            <!-- Notice Section -->
            <div class="col-lg-4">
                <div class="notice-card">
                    <div class="notice-header">
                        <h4>Notices</h4>
                    </div>
                    <div class="mt-3">
                        <?php if ($notices_result->num_rows > 0): ?>
                            <?php while ($notice = $notices_result->fetch_assoc()): ?>
                                <div class="notice-item">
                                    <h6><?php echo htmlspecialchars($notice['title']); ?></h6>
                                    <p class="text-muted"><?php echo htmlspecialchars($notice['description']); ?></p>
                                    <small class="text-muted">Posted on:
                                        <?php echo date("d-M-Y", strtotime($notice['created_at'])); ?></small>
                                </div>
                                <hr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p>No notices available at the moment.</p>
                        <?php endif; ?>
                        <button class="btn btn-primary btn-sm w-100">View All Notices</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-center py-3 mt-5">
        <p class="mb-0 text-light">&copy; 2024 FSMS. All Rights Reserved. Designed and developed by Purab Das</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>   

</body>

</html>

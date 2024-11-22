<?php
include 'dbconfig.php';
include('checklogin.php');

// Fetch registration requests from the database
$registrationRequests = [];
$sql = "SELECT * FROM registration_requests WHERE status='Pending'";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $registrationRequests[] = $row;
}

// Handle approve or reject actions
if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];

    if ($action == 'approve') {
        // Get student details from registration_requests
        $requestSql = "SELECT * FROM registration_requests WHERE id='$id' LIMIT 1";
        $requestResult = mysqli_query($conn, $requestSql);
        $request = mysqli_fetch_assoc($requestResult);

        // Check if student already exists by username
        $username = mysqli_real_escape_string($conn, $request['username']);
        $checkUsernameSql = "SELECT * FROM students WHERE username='$username'";
        $checkResult = mysqli_query($conn, $checkUsernameSql);

        if (mysqli_num_rows($checkResult) == 0) {
            // Insert the student into the students table
            $name = mysqli_real_escape_string($conn, $request['name']);
            $fatherName = mysqli_real_escape_string($conn, $request['father_name']);
            $mobileNumber = mysqli_real_escape_string($conn, $request['mobile_number']);
            $admissionClass = mysqli_real_escape_string($conn, $request['admission_class']);
            $username = mysqli_real_escape_string($conn, $request['username']);
            $password = mysqli_real_escape_string($conn, $request['password']);
            $image = $request['image']; // Assuming this is properly stored as LONGBLOB

            // Insert student details into students table
            $insertStudentSql = "INSERT INTO students (name, father_name, mobile_number, admission_class, username, password, image) 
                                 VALUES ('$name', '$fatherName', '$mobileNumber', '$admissionClass', '$username', '$password', ?)";
            $stmt = mysqli_prepare($conn, $insertStudentSql);
            mysqli_stmt_bind_param($stmt, 's', $image);
            mysqli_stmt_execute($stmt);
        }

        // Update registration request status to 'Approved'
        $updateSql = "UPDATE registration_requests SET status='Approved' WHERE id='$id'";
        mysqli_query($conn, $updateSql);
    } elseif ($action == 'reject') {
        // Update registration request status to 'Rejected'
        $updateSql = "UPDATE registration_requests SET status='Rejected' WHERE id='$id'";
        mysqli_query($conn, $updateSql);
    }

    // Redirect back to admin page
    header('Location: admin.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/full-stack-student-management-system/css/admin.css">
    
</head>
<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg bg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><ion-icon name="book-outline"></ion-icon>FSMS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="admin.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="notice.php">Upload Notice</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="stdMgmt.php">Student Management</a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="btn btn-danger">Logout</a>
                    </li>
                </ul>
                <span class="navbar-text">Student-Management-System</span>
            </div>
        </div>
    </nav>

    <div class="container my-4">
        <div class="welcome-message">
            <h1>Welcome to the FSMS Admin Panel</h1>
            <p>Manage student registration requests and class configurations effortlessly.</p>
        </div>

        <!-- Registration Requests Tab -->
        <div class="tab-content mt-3">
            <div class="tab-pane fade show active" id="registration-requests" role="tabpanel">
                <h3>Registration Requests</h3>
                <p>Here you can view and manage pending student registration requests.</p>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Seeking Admission for</th>
                            <th>Father's Name</th>
                            <th>Email</th>
                            <th>Photo</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($registrationRequests as $request): ?>
                        <tr>
                            <td><?= $request['id'] ?></td>
                            <td><?= $request['name'] ?></td>
                            <td><?= $request['admission_class'] ?></td>
                            <td><?= $request['father_name'] ?></td>
                            <td><?= $request['username'] ?></td>
                            <td>
                            <?php

    // Base64 encode the image and display it
    echo '<img src="data:image/jpeg;base64,' . base64_encode($request['image']) . '" alt="Student Photo" width="100" height="100">';

?>

                            </td>
                            <td><?= $request['status'] ?></td>
                            <td>
                                <a href="admin.php?action=approve&id=<?= $request['id'] ?>" class="btn btn-success btn-sm">Approve</a>
                                <a href="admin.php?action=reject&id=<?= $request['id'] ?>" class="btn btn-danger btn-sm">Reject</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-center py-3 mt-5 fixed-bottom">
        <p class="mb-0 text-light">&copy; 2024 FSMS. All Rights Reserved. Designed and developed by Purab Das</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>

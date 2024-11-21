<?php
include 'dbconfig.php';

// Fetch registration requests from the database
$registrationRequests = [];
$sql = "SELECT * FROM registration_requests WHERE status='Pending'";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
    $registrationRequests[] = $row;
}

// Handle approve or reject actions
// Handle approve or reject actions
if(isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];

    if($action == 'approve') {
        // First, get the student's details from registration_requests
        $requestSql = "SELECT * FROM registration_requests WHERE id='$id' LIMIT 1";
        $requestResult = mysqli_query($conn, $requestSql);
        $request = mysqli_fetch_assoc($requestResult);

        // Check if student already exists by username
        $username = $request['username'];
        $checkUsernameSql = "SELECT * FROM students WHERE username='$username'";
        $checkResult = mysqli_query($conn, $checkUsernameSql);

        if(mysqli_num_rows($checkResult) == 0) {
            // Insert the student into the students table
            $name = mysqli_real_escape_string($conn, $request['name']);
            $fatherName = mysqli_real_escape_string($conn, $request['father_name']);
            $mobileNumber = mysqli_real_escape_string($conn, $request['mobile_number']); // Make sure the field exists in the table
            $admissionClass = mysqli_real_escape_string($conn, $request['admission_class']);
            $username = mysqli_real_escape_string($conn, $request['username']);
            $password = mysqli_real_escape_string($conn, $request['password']);
            $image = $request['image']; // Handle image properly; either upload it or save its path

            // Fix the SQL query with proper escaping and handling of image
            $insertStudentSql = "INSERT INTO students (name, father_name, mobile_number, admission_class, username, password, image) 
                                 VALUES ('$name', '$fatherName', '$mobileNumber', '$admissionClass', '$username', '$password', '$image')";
            mysqli_query($conn, $insertStudentSql);
        }

        // Update the registration request status to 'Approved'
        $updateSql = "UPDATE registration_requests SET status='Approved' WHERE id='$id'";
        mysqli_query($conn, $updateSql);
    } else if($action == 'reject') {
        // Update the registration request status to 'Rejected'
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/full-stack-student-management-system/css/style.css">
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
            </ul>
            <span class="navbar-text">
              Student-Management-System
            </span>
          </div>
        </div>
      </nav>

      <div class="container my-4">
        <!-- Welcome Message -->
        <div class="welcome-message">
            <h1>Welcome to the FSMS Admin Panel</h1>
            <p>Manage student registration requests and class configurations effortlessly.</p>
        </div>

        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs" id="adminTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="registration-requests-tab" data-bs-toggle="tab" data-bs-target="#registration-requests" type="button" role="tab" aria-controls="registration-requests" aria-selected="true">
                    Registration Requests
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="class-manager-tab" data-bs-toggle="tab" data-bs-target="#class-manager" type="button" role="tab" aria-controls="class-manager" aria-selected="false">
                    Class Manager
                </button>
            </li>
        </ul>

        <!-- Tabs Content -->
        <div class="tab-content mt-3">
            <!-- Registration Requests Tab -->
            <div class="tab-pane fade show active" id="registration-requests" role="tabpanel" aria-labelledby="registration-requests-tab">
                <h3>Registration Requests</h3>
                <p>Here you can view and manage pending student registration requests.</p>
                <!-- Add table or content for requests -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Seeking Admission for</th>
                            <th>Fathers Name</th>
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
        // Check if image data exists
        if (!empty($request['image'])) {
            // Encode image data to base64
            echo '<img src="data:image/jpeg;base64,' . base64_encode($request['image']) . '" alt="Student Photo" width="100" height="100">';
        } else {
            // Placeholder if no image is available
            echo '<img src="path_to_placeholder_image.jpg" alt="No Photo Available" width="100" height="100">';
        }
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

            <!-- Class Manager Tab -->
            <div class="tab-pane fade" id="class-manager" role="tabpanel" aria-labelledby="class-manager-tab">
                <h3>Class Manager</h3>
                <p>Manage and configure classes here.</p>
                <!-- Add content for class manager -->
                <form method="POST" action="class_manager.php">
                    <div class="mb-3">
                        <label for="selectClass" class="form-label">Select Class</label>
                        <select class="form-select" id="selectClass" name="select_class" required>
                            <option value="" disabled selected>Select Class</option>
                            <option value="1">Class 1</option>
                            <option value="2">Class 2</option>
                            <option value="3">Class 3</option>
                            <option value="4">Class 4</option>
                            <option value="5">Class 5</option>
                            <option value="6">Class 6</option>
                            <option value="7">Class 7</option>
                            <option value="8">Class 8</option>
                            <option value="9">Class 9</option>
                            <option value="10">Class 10</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="classCapacity" class="form-label">Class Capacity</label>
                        <input type="number" class="form-control" id="classCapacity" placeholder="Enter class capacity" name="class_capacity" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Class</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-center py-3 mt-5">
        <p class="mb-0 text-light">&copy; 2024 FSMS. All Rights Reserved. Designed and developed by Purab Das</p>
    </footer>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-GLhlTQ8iRABdV4xq6Xz5b93eRZ5b/hvxs61W2CbmBBdDof1W2ECoJlq+poS2aRrt"></script>
</body>
</html>

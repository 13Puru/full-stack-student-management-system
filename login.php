<?php
include 'dbconfig.php'; // Include your database configuration file
// Start the session to store login information
session_start();

// Initialize variables for error messages
$error_msg = '';

// Check if the form is submitted
if (isset($_POST['form_type'])) {
    $form_type = $_POST['form_type'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($form_type === 'student') {
        // Student Login
        $query = "SELECT * FROM students WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $student = $result->fetch_assoc();
            if (password_verify($password, $student['password'])) {
                // Set session variables for student login
                $_SESSION['student_id'] = $student['student_id'];
                $_SESSION['student_name'] = $student['name'];
                $_SESSION['student_email'] = $student['username'];

                // Redirect to the student dashboard
                header('Location: userpro.php');
                exit();
            } else {
                $error_msg = 'Invalid password.';
            }
        } else {
            $error_msg = 'No student found with this username.';
        }
    } elseif ($form_type === 'admin') {
        // Admin Login
        $query = "SELECT * FROM admins WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $admin = $result->fetch_assoc();
            if (password_verify($password, $admin['password'])) {
                // Set session variables for admin login
                $_SESSION['admin_id'] = $admin['admin_id'];
                $_SESSION['admin_username'] = $admin['username'];

                // Redirect to the admin dashboard
                header('Location: admin.php');
                exit();
            } else {
                $error_msg = 'Invalid password for admin.';
            }
        } else {
            $error_msg = 'No admin found with this username.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="/full-stack-student-management-system/css/login.css">
    
</head>
<body>
    <nav class="navbar navbar-expand-lg bg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><ion-icon name="book-outline"></ion-icon>FSMS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                </ul>
                <span class="navbar-text">
                    Student-Management-System
                </span>
            </div>
        </div>
    </nav>

    <!-- Main Section -->
    <div class="container-fluid">
        <div class="row">
            <!-- Student Login Section -->
            <div class="col-md-6 login-section bg-primary text-white">
                <div class="form-container">
                    <h2 class="form-title">Student Login</h2>
                    <form action="login.php" method="POST">
                        <input type="hidden" name="form_type" value="student">
                        <div class="mb-3">
                            <label for="studentUsername" class="form-label">Username</label>
                            <input type="text" class="form-control" id="studentUsername" name="username" placeholder="Enter your username" required>
                        </div>
                        <div class="mb-3">
                            <label for="studentPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="studentPassword" name="password" placeholder="Enter your password" required>
                        </div>
                        <button type="submit" class="btn btn-light text-primary">Login</button>
                    </form>
                </div>
            </div>

            <!-- Admin Login Section -->
            <div class="col-md-6 login-section bg-secondary text-white">
                <div class="form-container">
                    <h2 class="form-title">Admin Login</h2>
                    <form action="login.php" method="POST">
                        <input type="hidden" name="form_type" value="admin">
                        <div class="mb-3">
                            <label for="adminUsername" class="form-label">Username</label>
                            <input type="text" class="form-control" id="adminUsername" name="username" placeholder="Enter your username" required>
                        </div>
                        <div class="mb-3">
                            <label for="adminPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="adminPassword" name="password" placeholder="Enter your password" required>
                        </div>
                        <button type="submit" class="btn btn-light text-secondary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-center py-3 mt-10 fixed-bottom">
        <p class="mb-0 text-light">&copy; 2024 FSMS. All Rights Reserved. Designed and developed by Purab Das</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>   
</body>
</html>

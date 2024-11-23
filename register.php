<?php
include 'dbconfig.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $name = $_POST['name'];
    $father_name = $_POST['father_name'];
    $mobile_number = $_POST['mobile_number'];
    $admission_class = $_POST['admission_class'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        // Validate file type
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($_FILES['image']['type'], $allowedTypes)) {
            die("Invalid file type. Only JPEG, PNG, and GIF are allowed.");
        }

        // Validate file size (max 5MB)
        if ($_FILES['image']['size'] > 5 * 1024 * 1024) {
            die("File size exceeds the maximum limit of 5MB.");
        }

        // Read and encode image data
        $image = $_FILES['image']['tmp_name'];
        $imageContent = file_get_contents($image);

        // Ensure the image content is non-zero
        if ($imageContent === false || strlen($imageContent) === 0) {
            die("Error reading the uploaded image file.");
        }
    } else {
        die("Error: No image uploaded or an error occurred during upload.");
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if the username already exists
    $query = "SELECT * FROM registration_requests WHERE username = ? UNION SELECT * FROM students WHERE username = ?";

    if ($stmt = $conn->prepare($query)) {
        // Bind parameters and execute
        $stmt->bind_param("ss", $username, $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "<script>alert('Error: Username already exists!');</script>";
        } else {
            // Insert registration request if username doesn't exist
            $insertQuery = "INSERT INTO registration_requests (name, father_name, mobile_number, admission_class, username, password, image) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)";

            if ($insertStmt = $conn->prepare($insertQuery)) {
                $insertStmt->bind_param("sssssss", $name, $father_name, $mobile_number, $admission_class, $username, $hashedPassword, $imageContent);

                if ($insertStmt->execute()) {
                    echo "<script>alert('Registration request submitted successfully! Your registration is pending approval.');</script>";
                } else {
                    echo "<script>alert('Error: " . $insertStmt->error . "');</script>";
                }

                $insertStmt->close();
            } else {
                echo "<script>alert('Error: " . $conn->error . "');</script>";
            }
        }

        $stmt->close();
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }

    $conn->close();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/full-stack-student-management-system/css/register.css">
    
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
                <a class="nav-link" href="login.php">Login</a>
              </li>
            </ul>
            <span class="navbar-text">
              Student-Management-System
            </span>
          </div>
        </div>
      </nav>

    <!-- Registration Form -->
    <div class="container">
        <div class="form-container">
            <h2 class="form-title">Student Registration</h2>
            <form action="register.php" method="POST" enctype="multipart/form-data">
                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                </div>

                <!-- Upload Image -->
                <div class="mb-3 text-center">
                    <label for="image" class="form-label">Upload Image</label>
                    <div>
                        <img id="imagePreview" src="https://via.placeholder.com/150" alt="Image Preview" class="image-preview">
                    </div>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*" onchange="previewImage()" required>
                </div>

                <!-- Father's Name -->
                <div class="mb-3">
                    <label for="fathersName" class="form-label">Father's Name</label>
                    <input type="text" class="form-control" id="fathersName" name="father_name" placeholder="Enter father's name" required>
                </div>

                <!-- Mobile Number -->
                <div class="mb-3">
                    <label for="mobileNumber" class="form-label">Mobile Number</label>
                    <input type="tel" class="form-control" id="mobileNumber" name="mobile_number" placeholder="Enter mobile number" pattern="[0-9]{10}" required>
                </div>


                <!-- Admission For -->
                <div class="mb-3">
                    <label for="admissionClass" class="form-label">Seeking Admission For</label>
                    <select class="form-select" id="admissionClass" name="admission_class" required>
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
                
                <!-- Username -->
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Choose a username" required>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Choose a password" required>
                </div>

                <!-- Register Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-center py-3 mt-5">
        <p class="mb-0 text-light">&copy; 2024 FSMS. All Rights Reserved. Designed and developed by Purab Das</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <script>
        function previewImage() {
            var file = document.getElementById("image").files[0];
            var reader = new FileReader();
            
            reader.onload = function (e) {
                document.getElementById("imagePreview").src = e.target.result;
            };
            
            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>

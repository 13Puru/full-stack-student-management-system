<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/full-stack-student-management-system/css/style.css">
    <style>
         .form-container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 600px;
            margin: 50px auto;
        }
        .form-title {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .image-preview {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
        }
    </style>
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
                <a class="nav-link active" aria-current="page" href="index.html">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="login.html">Login</a>
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
            <form action="/register" method="POST" enctype="multipart/form-data">
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
                    <input type="text" class="form-control" id="fathersName" name="fathers_name" placeholder="Enter father's name" required>
                </div>

                <!-- Mobile Number -->
                <div class="mb-3">
                    <label for="mobileNumber" class="form-label">Mobile Number</label>
                    <input type="tel" class="form-control" id="mobileNumber" name="mobile_number" placeholder="Enter mobile number" pattern="[0-9]{10}" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address" required>
                </div>

                <!-- admission for -->
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
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
 <script src="/full-stack-student-management-system/js/script.js"></script>
 <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>  
<script>
    // Function to preview image
    function previewImage() {
        const file = document.getElementById('image').files[0];
        const preview = document.getElementById('imagePreview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
</script>
</body>
</html>
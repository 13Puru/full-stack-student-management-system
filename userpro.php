<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
        .edit-btn {
            float: right;
            margin-top: -50px;
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
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.html">Home</a>
              </li>
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
                        <img src="student-placeholder.jpg" alt="Student Image" class="profile-img mb-3">
                        <h3>John Doe</h3>
                        <p class="text-muted">Class: 9</p>
                        <button class="btn btn-primary btn-sm edit-btn">Edit Profile</button>
                    </div>

                    <hr>

                    <!-- Personal Information -->
                    <h5>Personal Information</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Full Name:</strong> John Doe</p>
                            <p><strong>Father's Name:</strong> Mr. Richard Doe</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Mobile Number:</strong> +91-9876543210</p>
                            <p><strong>Email:</strong> john.doe@example.com</p>
                        </div>
                    </div>

                    <hr>

                    <!-- Academic Details -->
                    <h5>Academic Details</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Current Class:</strong> 9</p>
                            <p><strong>Roll Number:</strong> 23</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Age:</strong> 14</p>
                            <p><strong>Status:</strong> Active</p>
                        </div>
                    </div>

                    <hr>

                    <!-- Actions -->
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-success btn-sm">Download Report</button>
                        <button class="btn btn-secondary btn-sm">View Academic History</button>
                    </div>
                </div>
            </div>

            <!-- Notice Section -->
            <div class="col-lg-4">
                <div class="notice-card">
                    <!-- Header -->
                    <div class="notice-header">
                        <h4>Notices</h4>
                    </div>
                    <!-- Body -->
                    <div class="mt-3">
                        <div class="notice-item">
                            <h6>Holiday on Friday</h6>
                            <p class="text-muted">There will be a holiday on Friday due to maintenance.</p>
                            <small class="text-muted">Posted on: 20-Nov-2024</small>
                        </div>
                        <hr>
                        <div class="notice-item">
                            <h6>Mid-Term Exams</h6>
                            <p class="text-muted">Mid-term exams start from 1-Dec-2024. Prepare accordingly.</p>
                            <small class="text-muted">Posted on: 15-Nov-2024</small>
                        </div>
                        <hr>
                        <div class="notice-item">
                            <h6>Sports Meet</h6>
                            <p class="text-muted">The annual sports meet will be held on 10-Dec-2024.</p>
                            <small class="text-muted">Posted on: 18-Nov-2024</small>
                        </div>
                        <hr>
                        <button class="btn btn-primary btn-sm w-100">View All Notices</button>
                    </div>
                </div>
            </div>
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
</body>
</html>
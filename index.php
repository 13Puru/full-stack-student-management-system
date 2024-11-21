<?php
include 'dbconfig.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to FSMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/full-stack-student-management-system/css/style.css">
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

      <!--main section-->
      <div class="container mt-5">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 text-primary fw-bold">Welcome to FSMS</h1>
                <p class="lead text-muted mt-3">
                    Experience the power of a Full Stack Student Management System (FSMS) that revolutionizes the way you manage student data, track performance, and stay organized.
                </p>
                <p class="text-muted">
                    FSMS is designed to simplify student management with intuitive interfaces, real-time updates, and seamless integration across departments. Unlock the potential of digital education with FSMS!
                </p>
                <a href="#features" class="btn btn-primary btn-lg">Learn More</a>
            </div>
            <div class="col-lg-6 text-center">
                <img src="/full-stack-student-management-system/img/FSMS.jpg" alt="FSMS Illustration" class="img-fluid rounded" width="522">
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
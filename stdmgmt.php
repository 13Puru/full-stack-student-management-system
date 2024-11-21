<?php
include 'dbconfig.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/full-stack-student-management-system/css/style.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 30px;
        }
        .table-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg">
        <div class="container-fluid">
          <a class="navbar-brand" href="#"><ion-icon name="book-outline"></ion-icon> FSMS</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="admin.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="notice.html">Upload Notice</a>
              </li>
            </ul>
            <span class="navbar-text">
              Student-Management-System
            </span>
          </div>
        </div>
    </nav>

    <div class="container">
        <!-- Header -->
        <div class="text-center mb-4">
            <h1>Student Management</h1>
            <p class="text-muted">Manage students by selecting a class below.</p>
        </div>

        <!-- Class Selection -->
        <div class="mb-4">
            <label for="classSelect" class="form-label">Select Class to Manage</label>
            <select class="form-select" id="classSelect">
                <option value="" selected disabled>Select Class</option>
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

        <!-- Table Container -->
        <div class="table-container">
            <h3 id="classHeading" class="mb-3">Students of Class</h3>
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Roll No.</th>
                        <th>Age</th>
                        <th>Current Class</th>
                        <th>Marksheet</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="studentTableBody">
                    <!-- Rows will be dynamically added here -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-center py-3 mt-5">
        <p class="mb-0 text-light">&copy; 2024 FSMS. All Rights Reserved. Designed and developed by Purab Das</p>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/full-stack-student-management-system/js/script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
        const studentsData = {
            1: [
                { id: 1, name: 'Alice', roll: 101, age: 6, class: 1 },
                { id: 2, name: 'Bob', roll: 102, age: 6, class: 1 }
            ],
            2: [
                { id: 3, name: 'Charlie', roll: 201, age: 7, class: 2 },
                { id: 4, name: 'David', roll: 202, age: 7, class: 2 }
            ],
        };

        const classSelect = document.getElementById('classSelect');
        const studentTableBody = document.getElementById('studentTableBody');
        const classHeading = document.getElementById('classHeading');

        classSelect.addEventListener('change', () => {
            const selectedClass = classSelect.value;
            loadStudents(selectedClass);
        });

        function loadStudents(selectedClass) {
            studentTableBody.innerHTML = '';
            classHeading.textContent = `Students of Class ${selectedClass}`;
            const students = studentsData[selectedClass] || [];

            if (students.length === 0) {
                studentTableBody.innerHTML = `
                    <tr>
                        <td colspan="7" class="text-center text-muted">No students found for this class.</td>
                    </tr>`;
                return;
            }

            students.forEach((student, index) => {
                studentTableBody.innerHTML += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${student.name}</td>
                        <td>${student.roll}</td>
                        <td>${student.age}</td>
                        <td>${student.class}</td>
                        <td><button class="btn btn-info btn-sm">View</button></td>
                        <td>
                            <button class="btn btn-success btn-sm" onclick="promoteStudent(${student.id}, ${student.class})">Promote</button>
                        </td>
                    </tr>`;
            });
        }

        function promoteStudent(studentId, currentClass) {
            if (currentClass < 10) {
                const confirmPromotion = confirm(`Promote Student ID ${studentId} to Class ${currentClass + 1}?`);
                if (confirmPromotion) {
                    alert(`Student ID ${studentId} has been promoted to Class ${currentClass + 1}`);
                }
            } else {
                alert(`Student ID ${studentId} is already in Class 10 and cannot be promoted further.`);
            }
        }
    </script>
</body>
</html>

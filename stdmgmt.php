<?php
include 'dbconfig.php';
include('checklogin.php');

// Fetch students data from the database based on the selected class
$class_id = isset($_GET['class_id']) ? $_GET['class_id'] : 1; // Default to Class 1 if no class is selected
$query = "SELECT student_id, name, father_name, mobile_number, image, admission_class FROM students WHERE admission_class = $class_id";
$result = mysqli_query($conn, $query);

// Handle database errors
if (!$result) {
    die("Error fetching student data: " . mysqli_error($conn));
}
$students = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
        .student-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
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
            <select class="form-select" id="classSelect" onchange="loadStudents()">
                <option value="1" <?= $class_id == 1 ? 'selected' : '' ?>>Class 1</option>
                <option value="2" <?= $class_id == 2 ? 'selected' : '' ?>>Class 2</option>
                <option value="3" <?= $class_id == 3 ? 'selected' : '' ?>>Class 3</option>
                <option value="4" <?= $class_id == 4 ? 'selected' : '' ?>>Class 4</option>
                <option value="5" <?= $class_id == 5 ? 'selected' : '' ?>>Class 5</option>
                <option value="6" <?= $class_id == 6 ? 'selected' : '' ?>>Class 6</option>
                <option value="7" <?= $class_id == 7 ? 'selected' : '' ?>>Class 7</option>
                <option value="8" <?= $class_id == 8 ? 'selected' : '' ?>>Class 8</option>
                <option value="9" <?= $class_id == 9 ? 'selected' : '' ?>>Class 9</option>
                <option value="10" <?= $class_id == 10 ? 'selected' : '' ?>>Class 10</option>
            </select>
        </div>

        <!-- Table Container -->
        <div class="table-container">
            <h3 id="classHeading" class="mb-3">Students of Class <?php echo $class_id; ?></h3>
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Father's Name</th>
                        <th>Mobile No.</th>
                        <th>Admission Class</th>
                        <th>Image</th>
                        <th>Marksheet</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="studentTableBody">
                    <?php
                    if (count($students) > 0) {
                        $index = 1;
                        foreach ($students as $student) {
                            echo "
                            <tr>
                                <td>{$index}</td>
                                <td>{$student['name']}</td>
                                <td>{$student['father_name']}</td>
                                <td>{$student['mobile_number']}</td>
                                <td>{$student['admission_class']}</td>
                                <td><img src='data:image/jpeg;base64," . base64_encode($student['image']) . "' class='student-image' alt='Student Image'></td>
                                <td><button class='btn btn-info btn-sm' onclick='uploadMarksheet({$student['student_id']})'>Upload Marksheet</button></td>
                                <td>
                                    <button class='btn btn-success btn-sm' onclick='promoteStudent({$student['student_id']}, {$student['admission_class']})'>Promote</button>
                                </td>
                            </tr>";
                            $index++;
                        }
                    } else {
                        echo "
                        <tr>
                            <td colspan='8' class='text-center text-muted'>No students found for this class.</td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-center py-3 mt-5 fixed-bottom">
        <p class="mb-0 text-light">&copy; 2024 FSMS. All Rights Reserved. Designed and developed by Purab Das</p>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/full-stack-student-management-system/js/script.js"></script>
    <script>
        const classSelect = document.getElementById('classSelect');
        const studentTableBody = document.getElementById('studentTableBody');
        const classHeading = document.getElementById('classHeading');

        function loadStudents() {
            const selectedClass = classSelect.value;
            // Reload the page with the selected class id
            window.location.href = `stdmgmt.php?class_id=${selectedClass}`;
        }

        function promoteStudent(studentId, currentClass) {
            if (currentClass < 10) {
                const confirmPromotion = confirm(`Promote Student ID ${studentId} to Class ${currentClass + 1}?`);
                if (confirmPromotion) {
                    // Perform the promotion by updating the admission class in the database
                    const url = `promote_student.php?student_id=${studentId}&current_class=${currentClass}`;
                    fetch(url)
                        .then(response => response.json())
                        .then(data => {
                            alert(data.message);
                            if (data.success) {
                                loadStudents(); // Reload the students list
                            }
                        })
                        .catch(error => {
                            alert('An error occurred during promotion.');
                        });
                }
            } else {
                alert('This student cannot be promoted as they are already in the highest class.');
            }
        }
    </script>
</body>
</html>

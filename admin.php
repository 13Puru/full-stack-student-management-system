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
                <a class="nav-link active" aria-current="page" href="admin.html">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="notice.html">Upload Notice</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="stdMgmt.html">Student Management</a>
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
                            <th>Class</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>John Doe</td>
                            <td>Class 5</td>
                            <td>Pending</td>
                            <td>
                                <button class="btn btn-success btn-sm">Approve</button>
                                <button class="btn btn-danger btn-sm">Reject</button>
                            </td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>

            <!-- Class Manager Tab -->
            <div class="tab-pane fade" id="class-manager" role="tabpanel" aria-labelledby="class-manager-tab">
                <h3>Class Manager</h3>
                <p>Manage and configure classes here.</p>
                <!-- Add content for class manager -->
                <form>
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
                        <input type="number" class="form-control" id="classCapacity" placeholder="Enter class capacity">
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
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
 <script src="/full-stack-student-management-system/js/script.js"></script>
 <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>  
</body>
</html>
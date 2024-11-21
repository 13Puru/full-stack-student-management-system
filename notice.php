<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/full-stack-student-management-system/css/style.css">
    <style>
        .form-container {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin: 50px auto;
            max-width: 800px;
        }
        .notice-preview {
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-top: 20px;
        }
        .notice-list {
            margin-top: 30px;
        }
        .notice-list h4 {
            margin-bottom: 20px;
        }
    </style>
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
                <a class="nav-link" href="stdMgmt.html">Student Management</a>
              </li>
            </ul>
            <span class="navbar-text">
              Student-Management-System
            </span>
          </div>
        </div>
      </nav>

      <div class="container">
        <!-- Upload Notice Section -->
        <div class="form-container">
            <h2 class="text-center">Upload Notice</h2>
            <p class="text-center text-muted">Use this section to upload new notices for students and staff.</p>
            
            <form action="/upload-notice" method="POST" enctype="multipart/form-data">
                <!-- Notice Title -->
                <div class="mb-3">
                    <label for="noticeTitle" class="form-label">Notice Title</label>
                    <input type="text" class="form-control" id="noticeTitle" name="notice_title" placeholder="Enter notice title" required>
                </div>

                <!-- Notice Description -->
                <div class="mb-3">
                    <label for="noticeDescription" class="form-label">Notice Description</label>
                    <textarea class="form-control" id="noticeDescription" name="notice_description" rows="5" placeholder="Write the details of the notice..." required></textarea>
                </div>

                <!-- File Upload -->
                <div class="mb-3">
                    <label for="noticeFile" class="form-label">Attach File (Optional)</label>
                    <input type="file" class="form-control" id="noticeFile" name="notice_file" accept=".pdf,.docx,.jpg,.png">
                </div>

                <!-- Visibility Options -->
                <div class="mb-3">
                    <label class="form-label">Visibility</label>
                    <select class="form-select" id="noticeVisibility" name="visibility" required>
                        <option value="students" selected>Students Only</option>
                        <option value="staff">Staff Only</option>
                        <option value="all">Both Students and Staff</option>
                    </select>
                </div>

                <!-- Publish Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Upload Notice</button>
                </div>
            </form>
        </div>

        <!-- Notice Preview Section -->
        <div class="notice-preview">
            <h4>Preview of the Uploaded Notice</h4>
            <p><strong>Title:</strong> <span id="previewTitle">N/A</span></p>
            <p><strong>Description:</strong> <span id="previewDescription">N/A</span></p>
            <p><strong>Attached File:</strong> <span id="previewFile">No File Attached</span></p>
            <p><strong>Visibility:</strong> <span id="previewVisibility">N/A</span></p>
        </div>

        <!-- List of Previous Notices -->
        <div class="notice-list">
            <h4>Previous Notices</h4>
            <ul class="list-group">
                <li class="list-group-item">
                    <h5>Notice Title 1</h5>
                    <p>Description of the notice. <a href="#" class="text-primary">View File</a></p>
                    <p class="text-muted">Visibility: Students Only</p>
                </li>
                <li class="list-group-item">
                    <h5>Notice Title 2</h5>
                    <p>Description of the notice. <a href="#" class="text-primary">View File</a></p>
                    <p class="text-muted">Visibility: Staff Only</p>
                </li>
                <!-- More notices can be listed here -->
            </ul>
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
    // Script to dynamically update the preview section
    const titleInput = document.getElementById('noticeTitle');
    const descriptionInput = document.getElementById('noticeDescription');
    const fileInput = document.getElementById('noticeFile');
    const visibilitySelect = document.getElementById('noticeVisibility');

    const previewTitle = document.getElementById('previewTitle');
    const previewDescription = document.getElementById('previewDescription');
    const previewFile = document.getElementById('previewFile');
    const previewVisibility = document.getElementById('previewVisibility');

    titleInput.addEventListener('input', () => previewTitle.textContent = titleInput.value || 'N/A');
    descriptionInput.addEventListener('input', () => previewDescription.textContent = descriptionInput.value || 'N/A');
    fileInput.addEventListener('change', () => {
        const fileName = fileInput.files[0]?.name || 'No File Attached';
        previewFile.textContent = fileName;
    });
    visibilitySelect.addEventListener('change', () => previewVisibility.textContent = visibilitySelect.value || 'N/A');
</script> 
</body>
</html>
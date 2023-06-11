<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $title = $_POST['title'];
    $category = $_POST['category'];
    $summary = $_POST['summary'];
    $content = $_POST['content'];

    // Validate the form data (perform necessary validations)
    $errors = [];

    // Check if title is empty
    if (empty($title)) {
        $errors[] = "Title is required.";
    }

    // Check if category is selected
    if (empty($category)) {
        $errors[] = "Category is required.";
    }

    // Check if summary is empty
    if (empty($summary)) {
        $errors[] = "Summary is required.";
    }

    // Check if content is empty
    if (empty($content)) {
        $errors[] = "Content is required.";
    }

    // Check if file is uploaded
    if (!isset($_FILES['cover']) || $_FILES['cover']['error'] === UPLOAD_ERR_NO_FILE) {
        $errors[] = "Cover image is required.";
    } else {
        // Process the uploaded file
        $targetDirectory = '../../assets/images/covers/';
        $targetFile = $targetDirectory . basename($_FILES['cover']['name']);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if the file is an image
        $check = getimagesize($_FILES['cover']['tmp_name']);
        if (!$check) {
            $errors[] = "Invalid cover image format.";
        }

        // Check file size (adjust the size limit as needed)
        if ($_FILES['cover']['size'] > 5 * 1024 * 1024) {
            $errors[] = "Cover image file size exceeds the limit (5MB).";
        }

        // Check if the file already exists
        if (file_exists($targetFile)) {
            $errors[] = "Cover image file already exists.";
        }

        // Move the uploaded file to the target directory
        if (empty($errors)) {
            if (!move_uploaded_file($_FILES['cover']['tmp_name'], $targetFile)) {
                $errors[] = "Failed to upload cover image.";
            }
        }
    }

    // If there are no errors, insert the post into the database
    if (empty($errors)) {
        // Database insertion code here (adjust as per your database structure)

        // Redirect to index.php after successful insertion
        header('Location: index.php');
        exit;
    } else {
        echo $errors[0];
    }
}

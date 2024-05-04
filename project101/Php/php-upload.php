<?php
session_start();
include('../Php/db_connect.php');
include('../Php/authenticate.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];

    // Check if file is selected
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Get file details
        $file_name = $_FILES['image']['name'];
        $tempname = $_FILES['image']['tmp_name'];
        $folder = '../Assets/img/avatars/' . $file_name;

        // Check file type
        $allowed_types = array('image/jpeg', 'image/png');
        $file_type = $_FILES['image']['type'];
        if (!in_array($file_type, $allowed_types)) {
            $error = "Only PNG and JPG files are allowed.";
            header("Location: php-upload.php?error=$error");
            exit();
        }

        // Check file size (in bytes)
        $max_size = 5 * 1024 * 1024; // 5 MB
        if ($_FILES['image']['size'] > $max_size) {
            $error = "File size exceeds the limit of 5MB.";
            header("Location: php-upload.php?error=$error");
            exit();
        }

        // Update user profile in the database
        $sql = "UPDATE trainees SET profile = '$file_name' WHERE user_id = '$user_id'";
        $query = mysqli_query($connect, $sql);

        // Move uploaded file to destination folder
        if (move_uploaded_file($tempname, $folder)) {

            $_SESSION['success'] ="File uploaded successfully";
            header('location: ../Users/UserProfile.php');
        } else {
            $_SESSION['error'] = "File not uploaded";
        }
    } else {
        $_SESSION['error'] = "No file selected or an error occurred";
    }
}
?>

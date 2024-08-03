<?php
session_start();
include('../Php/db_connect.php');
$usertype = $_SESSION['usertype'];
include 'authenticate.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $user_id = $_POST['user_id'];
    $qoute = $_POST['qoute'];
    $author = $_POST['author'];
    
    // Check if file is selected
    if (!empty($_FILES['image']['name'])) {
        // Get file details
        $file_name = $_FILES['image']['name'];
        $tempname = $_FILES['image']['tmp_name'];
        $folder = '../Assets/img/avatars/' . $file_name;

        // Check file type
        $allowed_types = array('image/jpeg', 'image/png');
        $file_type = $_FILES['image']['type'];
        if (!in_array($file_type, $allowed_types)) {
            $_SESSION['error'] = "Only PNG and JPG files are allowed.";
            $redirect_url = ($usertype === 'Trainee') ? '../Users/UserProfile.php?trainee_profile=' .$user_id. '' : ($usertype === 'Admin' ? '../Admin/TraineeProfile.php?trainee_profile=' .$user_id. '': '../Manager/TraineeProfileManager.php?trainee_profile=' . $user_id. '');
            header("Location: $redirect_url");
            exit();
        }

        // Check file size (in bytes)
        $max_size = 5 * 1024 * 1024; // 5 MB
        if ($_FILES['image']['size'] > $max_size) {
            $_SESSION['error'] = "File size exceeds the limit of 5MB.";
            $redirect_url = ($usertype === 'Trainee') ? '../Users/UserProfile.php?trainee_profile=' .$user_id. '' : ($usertype === 'Admin' ? '../Admin/TraineeProfile.php?trainee_profile=' .$user_id. '': '../Manager/TraineeProfileManager.php?trainee_profile=' . $user_id. '');
            header("Location: $redirect_url");
            exit();
        }
    }

    // Prepare SQL query based on form data
    if (!empty($file_name) && !empty($qoute) && !empty($author)) {
        // Update both users and trainees tables
        $sql = "UPDATE users us, trainees ts
                SET us.profile = '$file_name',
                    ts.qoute = '$qoute',
                    ts.author = '$author'
                WHERE us.id = '$user_id' 
                AND ts.user_id = '$user_id'";
    } elseif (!empty($qoute) || !empty($author)) {
        // Update only trainees table
        $sql = "UPDATE trainees
                SET qoute = '$qoute',
                    author = '$author'
                WHERE user_id = '$user_id'";
    } elseif (!empty($file_name)) {
        // Update only users table
        $sql = "UPDATE users
                SET profile = '$file_name'
                WHERE id = '$user_id'";
    } else {
        $_SESSION['error'] = "Empty fields.";

    }

    // Execute SQL query
    $query = mysqli_query($connect, $sql);
    if ($query) {
        // Move uploaded file to destination folder
        if (!empty($file_name) && move_uploaded_file($tempname, $folder)) {
            $_SESSION['success'] = "Uploaded successfully";
        } 
    } else {
        $_SESSION['error'] = "Error executing query: " . mysqli_error($connect);
    }
}

$redirect_url = ($usertype === 'Trainee') ? '../Users/UserProfile.php?trainee_profile=' .$user_id. '' : ($usertype === 'Admin' ? '../Admin/TraineeProfile.php?trainee_profile=' .$user_id. '': '../Manager/TraineeProfileManager.php?trainee_profile=' . $user_id. '');
header("Location: $redirect_url");
exit();
?>

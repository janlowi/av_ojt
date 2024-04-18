<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_type = "";

    if (empty($email)) {
        // Email is invalid
        $_SESSION['error'] = 'Invalid email address';
        header("Location: ../Login/index.php");
        exit();
    } elseif (strlen($password) < 8) {
        // Password is too short
        $_SESSION['error'] = 'Password must be 8 characters long';
        header("Location: ../Login/index.php");
        exit();
    } else {
        $query = "SELECT * FROM trainees WHERE email = '$email' ";
        $result = mysqli_query($connect, $query);

        if ($row = mysqli_fetch_assoc($result)) {

            $hashed_password = $row['password'];

            // Verify the password -- not hashed temporarily
            if ($hashed_password === $password) {

                $user_type = $row['user_type'];

                // Redirect based on user type
                if ($user_type === 'Admin') {
                    header('location: ../Admin/AdminDashboard.php');
                    exit();
                } elseif ($user_type === 'user') {
                    header("Location: ../Users/index.php ");
                    exit();
                } else {
                    // Handle unknown user types or errors
                }
            } else {
                // Password does not match
                $_SESSION['error'] = 'Incorrect password';
                header("Location: ../Login/index.php");
                exit();
            }
        } else {
            // Email does not exist in the database
            $_SESSION['error'] = 'Email not found';
            header("Location: ../Login/index.php");
            exit();
        }
    }
}
?>

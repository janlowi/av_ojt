<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD']=='POST') {
$email = $_POST['email'];
$password = $_POST['password'];
$user_type = "";


if (empty($email)) {
    $_SESSION ['error']= 'Invalid Email Address';
    header("Location: ../Login/index.php");

} else {

    if (strlen($password) < 8) {
        // Password is too short
        $_SESSION ['error']= 'Password must be 8 characters long';
        header("Location: ../Login/index.php");
        // Handle the error accordingly
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
                $_SESSION ['error']= 'incorrect password';
        header("Location: ../Login/index.php");
              
            }
        } else {
            $_SESSION ['error']= 'Invalid Email Address';
            header("Location: ../Login/index.php");
          
        }
    }
}
}
?>
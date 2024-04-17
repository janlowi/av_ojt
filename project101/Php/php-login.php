<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD']=='POST') {
$email = $_POST['email'];
$password = $_POST['password'];
$user_type = "";


if (empty($email)) {
    // Email is invalid
    echo "Invalid email address";

} else {

    if (strlen($password) < 8) {
        // Password is too short
        echo "Password must be at least 8 characters long";
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
                // Password does not match
                echo "Incorrect password";
              
            }
        } else {
            // Email does not exist in the database
            echo "Email not found";
          
        }
    }
}
}
?>
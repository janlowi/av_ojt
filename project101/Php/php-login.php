<?php
session_start();
$_SESSION['user'] = $user_id;
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD']=='POST') {

$email = $_POST['email'];
$password = $_POST['password'];
$user_id='';
$user_type = "";


if (empty($email)) {
    // Email is invalid
    echo "Invalid email address";

} else {

    if (strlen($password) < 8) {
        // Password is too short
        $_SESSION ['error']= 'Password must be 8 characters long';
        header("Location: ../Login/index.php");
        // Handle the error accordingly
    } else {

        $query = "SELECT  us.*,
                          tr.email,
                          tr.first_name
                          
        FROM users us,
            trainees tr

        
         WHERE  us.id=tr.user_id AND tr.email='$email' ";


        $result =mysqli_query($connect, $query);
        

        if ($row = mysqli_fetch_assoc($result)) {
            // Store the user's email in a session variable
            $_SESSION['email'] = $row['email'];
            $_SESSION['firstname'] = $row['first_name'];
            $_SESSION['id'] = $row['tr.id'];

            $hashed_password = $row['password'];
            $_SESSION['user_id'] = $row['id'];
            

            // Verify the password -- not hashed temporarily
            if ($hashed_password = $password) {
            
                $_SESSION['usertype'] = $row['user_type'];

                // Redirect based on user type
                if ($_SESSION['usertype'] === 'Admin') {
                    header('location: ../Admin/AdminDashboard.php');   
                    exit();
                } elseif ($_SESSION['usertype'] === 'Trainee') {
                    header("Location: ../Users/UserDashboard.php ");
                    exit();
                } else {
                    // Handle unknown user types or errors
                }
            } else {
                // Password does not match
                echo "Incorrect password.";
              
            }
        } else {
            // Email does not exist in the database
            echo "Email not found";
          
        }
    }
}
}
?>
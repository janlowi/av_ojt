<?php
session_start();
include 'db_connect.php';
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
    header("location: ../index.php");
    exit;
}
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
        $pass_hashed= password_hash($password, PASSWORD_DEFAULT);
        $query = "SELECT  us.*,
                        tr.user_id,
                          tr.email,
                          tr.first_name,
                          tr.profile

                          
            	    FROM users us,
                        trainees tr

        
                    WHERE  us.id=tr.user_id 
                    AND tr.email='$email' ";


        $result =mysqli_query($connect, $query);
        

        if ($row = mysqli_fetch_assoc($result)) {

            $_SESSION['firstname'] = $row['first_name'];
            $_SESSION['profile'] = $row['profile'];
            $hashed_password = $row['password'];
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['usertype'] = $row['user_type'];

            // Verify the password -- not hashed temporarily
            if ($hashed_password = $pass_hashed) {
                $_SESSION['email'] = $row['email'];
                $_SESSION['user_id'] = $row['id'];
                        // Store the user's email in a session variable
                      
                // Redirect based on user type
                if ($_SESSION['usertype'] === 'Admin') {
                    $_SESSION['Admin'] = true;
                    // Redirect to the admin dashboard
                    header('location: ../Admin/AdminDashboard.php');  

                    exit();
                } elseif ($_SESSION['usertype'] === 'Trainee') {
                $_SESSION['Trainee'] = true;
                $_SESSION['user_id'] = $row['id'];
                    header("Location: ../Users/UserDashboard.php ");
                    $_SESSION['loggedin']=true;
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

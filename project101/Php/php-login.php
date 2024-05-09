<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD']=='POST') {
    
$email = $_POST['email'];
$password = $_POST['password'];
$user_id='';
$user_type = "";


if (empty($email) || empty($password)) {
    // Email is invalid
    $error_msg="Fill all required firlds";

} else {
    if (strlen($password) < 8) {
        // Password is too short
        $error_msg= 'Password must be 8 characters long';
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
            $row['status'];
            $_SESSION['firstname'] = $row['first_name'];
            $_SESSION['profile'] = $row['profile'];
            $hashed_password = $row['password'];
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['usertype'] = $row['user_type'];


            // Verify the password -- not hashed temporarily
            if ($hashed_password=$pass_hashed) {
                $_SESSION['email'] = $row['email'];
                $_SESSION['user_id'] = $row['id'];
                        // Store the user's email in a session variable
                        if($row['status']=="Deactivated"){

                            $error_msg = "Your account has been deactivated";
                
                    }elseif($row['status']=="Active")  {
                // Redirect based on user type
                if ($_SESSION['usertype'] === 'Admin') {
                    $_SESSION['Admin'] = true;

                } elseif ($_SESSION['usertype'] === 'Trainee') {
                $_SESSION['Trainee'] = true;

                } 
                $_SESSION['logged_in']=true;
                if($_SESSION['usertype'] === 'Admin'){
                    header('location: ../Admin/AdminDashboard.php');
                    exit();
                }elseif($_SESSION['usertype'] === 'Trainee') {
                    header('location: ../Users/UserDashboard.php');
                    exit();
                }
            } 
        } else {
            // Password does not match
            $error_msg="Incorrect password.";
          
        }
    }else {
        // Password does not match
        $error_msg="User does not exist.";
      
    }
}
}

}
$_SESSION['error']=$error_msg;
header('location: ../Login/index.php');
exit();
?>


<?php
session_start();
include 'db_connect.php';
include 'authenticate.php';



if ($_SERVER['REQUEST_METHOD']='POST') {


   
  $firstname = $_POST["Firstname"];
   $middlename = $_POST["Middlename"];
    $lastname = $_POST["Lastname"];
     $sex = $_POST["Sex"];
          $office = $_POST["Office"];
           $email = $_POST["Email"];
            $password = $_POST["Password"];
             $confirm_pass = $_POST["Confirm"];
             $user_type = $_POST["Usertype"];
             $status = $_POST["Status"];
             $department = $_POST["Department"];

  if(    
      !empty( $firstname)&&
      !empty( $middlename)&&
      !empty( $lastname)&&
      !empty( $sex)&&
      !empty( $office)&&
      !empty( $email)&&  
      !empty( $password)&&
      !empty( $confirm_pass)&& 
      !empty( $department)&& 
      !empty( $user_type)
        ) {


        if($password >=8) 
        {
                if($password == $confirm_pass) {
                  $pass_hashed= password_hash($password, PASSWORD_DEFAULT);

                  $sql = "INSERT INTO users (
                                             office_assigned, 
                                             email,
                                             password, 
                                             user_type,  
                                             department,
                                             status
                                            )

                          VALUES (       
                                         '$office',
                                         '$email',
                                         '$pass_hashed',
                                         '$user_type',
                                         '$department',
                                         '$status'
                                         )";

                  $query= mysqli_query($connect, $sql);
                  
                   if ($query==1) {

                    $user_id=mysqli_insert_id($connect);

                    $insert="INSERT INTO trainees(
                                                                              
                                                                                  user_id, 
                                                                                  first_name, 
                                                                                  middle_name, 
                                                                                  last_name, 
                                                                                  sex, 
                                                                                  email

                                                                                  )

                                                      VALUES (
                                                              '$user_id', 
                                                              '$firstname',
                                                              '$middlename',
                                                              '$lastname',                                                           
                                                              '$sex',
                                                              '$email'
                                                             
                                                            )";

                                                         $query =mysqli_query($connect,$insert);

                                                                                  $success_msg = "Trainee added successfully.";
                                                                                  $_SESSION['success'] = $success_msg;
                                                                            
                                                                                header("Location: ../Admin/AdminDashboard.php");
                                              //       }else{
                                              //         echo 'error';
                                              //       }
                                              // }

                                  

                                        } 
                  

                  }  else {
  
    $error_msg = "Password does not match";

  }

} else {
  
  $error_msg = "Password must be equal or greater than 8 charaacters.";

 }

}
else {
  
$error_msg = "Please fill all the fieds.";

}
}
else { 
$error_msg = "Failed to add trainee.";

}
$_SESSION['error'] = $error_msg;
header("Location: ../Admin/AdminDashboard.php");

?>
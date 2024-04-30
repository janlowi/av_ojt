
<?php
session_start();
include 'db_connect.php';


 if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $ojtid = $_POST["Ojtid"];
    $firstname = $_POST["Firstname"];
     $middlename = $_POST["Middlename"];
      $lastname = $_POST["Lastname"];
      $age = $_POST["Age"];
       $sex = $_POST["Sex"];
         $course = $_POST["Course"];
         $university = $_POST["University"];
          $hours_to_render = $_POST["Hours"];
           $dos = $_POST["Dos"];
            $office = $_POST["Office"];
             $email = $_POST["Email"];
              $password = $_POST["Password"];
               $confirm_pass = $_POST["Confirm"];
               $user_type = $_POST["Usertype"];
               $contact_num = $_POST["Contact"];
               $status = $_POST["Status"];
               $department = $_POST["Department"];




    if( !empty( $ojtid)&&     
        !empty( $firstname)&&
        !empty( $middlename)&&
        !empty( $lastname)&&
        !empty( $age)&&
        !empty( $sex)&&
        !empty( $course)&&
        !empty( $university)&&
        !empty( $hours_to_render)&&
        !empty( $dos)&&
        !empty( $office)&&
        !empty( $email)&&  
        !empty( $password)&&
        !empty( $confirm_pass)&& 
        !empty( $department)&& 

        !empty( $user_type)&&
        !empty( $contact_num)) {


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
                                                                                    ojt_id, 
                                                                                    user_id, 
                                                                                    first_name, 
                                                                                    middle_name, 
                                                                                    last_name, 
                                                                                    age, 
                                                                                    sex, 
                                                                                    contact_num, 
                                                                                    degree, 
                                                                                    university,
                                                                                    hours_to_render, 
                                                                                    email, 
                                                                                    dos
                                                                                    )

                                                        VALUES ( '$ojtid',
                                                                '$user_id', 
                                                                '$firstname',
                                                                '$middlename',
                                                                '$lastname',
                                                                '$age',
                                                                '$sex',
                                                                '$contact_num',
                                                                '$course',
                                                                '$university',
                                                                '$hours_to_render',
                                                                '$email',
                                                                '$dos'
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
      $_SESSION['error'] = $error_msg;
      header("Location: ../Admin/AdminDashboard.php");
    }
  
  } else {
    
    $error_msg = "Password must be equal or greater than 8 charaacters.";
    $_SESSION['error'] = $error_msg;
    header("Location: ../Admin/AdminDashboard.php");
   }
  
 }
 else {
    
  $error_msg = "Please fill all the fieds.";
  $_SESSION['error'] = $error_msg;
  header("Location: ../Admin/AdminDashboard.php");
 }
}
else {
    
  $error_msg = "Failed to add trainee.";
  $_SESSION['error'] = $error_msg;
  header("Location: ../Admin/AdminDashboard.php");
}

?>
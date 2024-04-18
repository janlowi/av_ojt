
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
        !empty( $user_type)&&
        !empty( $contact_num)) {
          if($password >=8) 
          {
                  if($password == $confirm_pass) {
                    $pass_hashed= password_hash($password, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO trainees (id, ojt_id, first_name, middle_name, last_name, age, sex, contact_num, degree, university, hours_to_render, dos, office_assigned, email, password, user_type, status)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?, ?)";
                    
                    $stmt = mysqli_stmt_init($connect);
                    
                    if ( ! mysqli_stmt_prepare($stmt, $sql)) {
                     
                        die(mysqli_error($connect));
                    } else {
                    
                    mysqli_stmt_bind_param($stmt, "isssssisssiisssss",
                                           $id,
                                           $ojtid,
                                           $firstname,
                                           $middlename,
                                           $lastname,
                                           $age,
                                           $sex,
                                           $contact_num,
                                           $course,
                                           $university,
                                           $hours_to_render,
                                           $dos,
                                           $office,
                                           $email,
                                           $pass_hashed,
                                           $user_type,
                                           $status

                                          
                                          );
                    
                    mysqli_stmt_execute($stmt);
                    
                    $success_msg = "Trainee added successfully.";
                    $_SESSION['success'] = $success_msg;
                    
                    header("Location: ../Admin/AdminDashboard.php");
                    }
                    
   }      else {
    
    $error_msg = "Password does not match";
    $_SESSION['error'] = $error_msg;
    header("Location: ../Admin/AdminDashboard.php");
   }

    }   else {
    
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


?>
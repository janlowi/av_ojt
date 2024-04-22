
<?php
session_start();
include 'db_connect.php';

 if ($_SERVER['REQUEST_METHOD']=='POST') {

    $id = $_POST["edit_id"];
    $ojtid = $_POST["Ojtid"];
    $firstname = $_POST["Firstname"];
     $middlename = $_POST["Middlename"];
      $lastname = $_POST["Lastname"];
      $age = $_POST["Age"];
       $sex = $_POST["Sex"];
         $course = $_POST["Course"];
         $university = $_POST["University"];
          $hours = $_POST["Hours"];
           $dos = $_POST["Dos"];
            $office = $_POST["Office"];
             $email = $_POST["Email"];
             $password = $_POST["Password"];
             $confirm_pass = $_POST["Confirm"];
             
               $usertype = $_POST["Usertype"];
               $contact = $_POST["Contact"];
               $status = $_POST["Status"];
               $department = $_POST["Department"];




    if( !empty( $ojtid)&&     
        !empty( $id)&&
        !empty( $firstname)&&
        !empty( $middlename)&&
        !empty( $lastname)&&
        !empty( $age)&&
        !empty( $sex)&&
        !empty( $course)&&
        !empty( $university)&&
        !empty( $hours)&&
        !empty( $dos)&&
        !empty( $office)&&
        !empty( $email)&&  
        !empty( $password)&&
        !empty( $confirm_pass)&& 
        !empty( $department)&& 
        !empty( $status)&&
        !empty( $usertype)&&
        !empty( $contact)) {

                  if($_POST["Password"] ===  $_POST["Confirm"]) {
                    $pass_hashed= password_hash($password, PASSWORD_DEFAULT);
                    $sql = "UPDATE  users SET ojt_id = '$ojtid', first_name = '$firstname', middle_name = '$middlename', last_name = '$lastname', age = '$age', sex = '$sex', contact_num = '$contact', degree = '$course', university = '$university', hours_to_render = '$hours', dos = '$dos', office_assigned = '$office', email = '$email', password = '$pass_hashed', user_type = '$usertype', status = '$status', department = '$department'
                            WHERE id = '$id'";
                    $result = mysqli_query($connect, $sql);

                    if($result==true){
                    
                    $success_msg = "Trainee Updated successfully.";
                    $_SESSION['success'] = $success_msg;
                    
                    header("Location: ../Admin/AdminDashboard.php");
                    }
                    else {
    
                      $error_msg = "Password does not match";
                      $_SESSION['error'] = $error_msg;
                      header("Location: ../Admin/AdminDashboard.php");
                    
                       }    
}
    }   else {
    
      $error_msg = "Please fill all the fieds.";
      $_SESSION['error'] = $error_msg;
      header("Location: ../Admin/AdminDashboard.php");
     
  }
}

?>

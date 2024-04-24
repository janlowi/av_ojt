
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
                    $sql = "UPDATE  
                                  users us, 
                                  trainees tr 
                                  
                                  SET 
                                      tr.ojt_id = '$ojtid', 
                                      tr.first_name = '$firstname', 
                                      tr.middle_name = '$middlename', 
                                      tr.last_name = '$lastname', 
                                      tr.age = '$age', 
                                      tr.sex = '$sex', 
                                      tr.contact_num = '$contact', 
                                      tr.degree = '$course', 
                                      tr.university = '$university', 
                                      tr.hours_to_render = '$hours', 
                                      tr.dos = '$dos', 
                                      us.office_assigned = '$office', 
                                      tr.email = '$email', 
                                      us.password = '$pass_hashed', 
                                      us.user_type = '$usertype', 
                                      us.status = '$status', 
                                      us.department = '$department'
                            WHERE tr.id = '$id' AND us.id=tr.user_id";
                    $result = mysqli_query($connect, $sql);

                    if($result==true){
                    
                    $success_msg = "Trainee Updated successfully.";
                    $_SESSION['success'] = $success_msg;
                    
                    header("Location: ../Admin/Users.php");
                    }
                    else {
    
                      $error_msg = "Password does not match";
                      $_SESSION['error'] = $error_msg;
                      header("Location: ../Admin/Users.php");
                    
                       }    
}
    }   else {
    
      $error_msg = "Please fill all the fieds.";
      $_SESSION['error'] = $error_msg;
      header("Location: ../Admin/Users.php");
     
  }
}

?>

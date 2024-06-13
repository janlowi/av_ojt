
<?php
session_start();
include 'db_connect.php';


 if ($_SERVER['REQUEST_METHOD']=='POST') {

    $id = $_POST["edit_id"];
    $firstname = $_POST["Firstname"];
    $middlename = $_POST["Middlename"];
    $lastname = $_POST["Lastname"];
    $dob = $_POST["Birthday"];
    $sex = $_POST["Sex"];
    $office = $_POST["Office"];
    $email = $_POST["Email"];
    $usertype = $_POST["Usertype"];
    $department = $_POST["Department"];

    if(    
        !empty( $firstname)&&
        !empty( $middlename)&&
        !empty( $lastname)&&
        !empty( $dob)&&
        !empty( $sex)&&
        !empty( $office)&&
        !empty( $email)&&  
        !empty( $department)&& 
        !empty( $usertype)) {


  $sql = "UPDATE  
                users
                
                SET 
                    first_name = '$firstname', 
                    middle_name = '$middlename', 
                    last_name = '$lastname', 
                    dob = '$dob', 
                    sex = '$sex', 
                    office_assigned = '$office', 
                    email = '$email',
                    user_type = '$usertype', 
                    department_id = '$department'
                    
          WHERE id = '$id'";
  $result = mysqli_query($connect, $sql);

  if($result==true){

  $success_msg = "Trainee Updated successfully.";
  $_SESSION['success'] = $success_msg;
  header("Location: ../Admin/AdminDashboard.php");

  }
  else {
    
    $error_msg = "Password does not match";
                 ;
                    
                       }    
} else {
    
  $error_msg = "Please fill all the fieds.";
  $_SESSION['error'] = $error_msg;
  header("Location: ../Admin/AdminDashboard.php");
    }  

if(isset($_POST['updateFirstname'])){
  $stmt = $this->mysqli->prepare("UPDATE trainees tr, users us  SET tr.first_name = ? , us. first_name = ? WHERE tr.user id ? AND us.id = ?");
  $user_id = $_POST['user_id'];

  $stmt->bind_param('ssii', $firstname, $firstname, $user_id, $user_id);

  $firstname = isset($_POST['Firstname']) ? $this->mysqli->real_escape_string($_POST['Firstname']) : '';
  $stmt-> execute();
  if($stmt == true ){
    $success_msg = "Trainee Updated successfully.";
    $_SESSION['success'] = $success_msg;
    header("Location: ../Admin/TraineeProfile.php?trainee_profile=  <?= $user_id ?>");
  }
} 

  }



?>




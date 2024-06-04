
<?php
session_start();
include 'db_connect.php';


 if ($_SERVER['REQUEST_METHOD']=='POST') {

    $id = $_POST["edit_id"];
    $ojtid = $_POST["Ojtid"];
    $firstname = $_POST["Firstname"];
    $middlename = $_POST["Middlename"];
    $lastname = $_POST["Lastname"];
    $dob = $_POST["Birthday"];
    $sex = $_POST["Sex"];
    $course = $_POST["Course"];
    $university = $_POST["University"];
    $hours = $_POST["Hours"];
    $dos = $_POST["Dos"];
    $office = $_POST["Office"];
    $email = $_POST["Email"];
    $usertype = $_POST["Usertype"];
    $contact = $_POST["Contact"];
    $status = $_POST["Status"];
    $department = $_POST["Department"];

    if( !empty( $ojtid)&&     
        !empty( $firstname)&&
        !empty( $middlename)&&
        !empty( $lastname)&&
        !empty( $dob)&&
        !empty( $sex)&&
        !empty( $course)&&
        !empty( $university)&&
        !empty( $hours)&&
        !empty( $dos)&&
        !empty( $office)&&
        !empty( $email)&&  
        !empty( $department)&& 
        !empty( $status)&&
        !empty( $usertype)&&
        !empty( $contact)) {


  $sql = "UPDATE  
                users us, 
                trainees tr 
                
                SET 
                    tr.ojt_id = '$ojtid', 
                    us.first_name = '$firstname', 
                    us.middle_name = '$middlename', 
                    us.last_name = '$lastname', 
                    us.dob = '$dob', 
                    us.sex = '$sex', 
                    tr.contact_num = '$contact', 
                    tr.degree = '$course', 
                    tr.university = '$university', 
                    tr.hours_to_render = '$hours', 
                    tr.dos = '$dos', 
                    us.office_assigned = '$office', 
                    tr.email = '$email',
                    us.email = '$email',
                    us.user_type = '$usertype', 
                    us.status = '$status', 
                    us.department_id = '$department'
                    
          WHERE us.id=tr.user_id 
          AND us.id = '$id'";
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


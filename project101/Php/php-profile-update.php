<?php
session_start();
include 'db_connect.php';
$usertype = $_SESSION['usertype'];
if(isset($_POST['updateBirthday'])) {
    $user_id=$_POST['user_id'];
    $dob=$_POST['updatedob']; 
    $usertype=$_POST['user_type']; 

    $updateBirthday="UPDATE users SET dob='$dob' WHERE id = '$user_id'";
    $updateBirthday_query=mysqli_query($connect, $updateBirthday);
      if($updateBirthday_query==true){
        if($usertype === 'Admin'){
          $_SESSION['success']="Date of Birth updated successfully.";
          header("Location: ../Admin/TraineeProfile.php?trainee_profile= $user_id ");
          exit();
        }else{
          $_SESSION['success']="Date of Birth updated successfully.";
          header("Location: ../Users/UserProfile.php");
          exit();
        }
      }else{
        if($usertype === 'Admin') {
        $_SESSION['error']="Date of Birth failed to update.";
        header("Location: ../Admin/TraineeProfile.php?trainee_profile= $user_id ");
        exit();
      }else{
        $error_msg = "Date of Birth failed to uodate.";
        $_SESSION['error'] = $error_msg;
        header("Location: ../Users/UserProfile.php");
    }
  }

}elseif(isset($_POST['updateContacts'])) {
    $user_id=$_POST['user_id'];
    $contact_num=$_POST['updateContact']; 

    $updateContact="UPDATE trainees SET contact_num='$contact_num' WHERE user_id = '$user_id'";
    $updateContact_query=mysqli_query($connect, $updateContact);
      if($updateContact_query==true){
        $_SESSION['success']="Contact number updated successfully.";
      }else {
        $error_msg = "Please fill all the fieds.";
        $_SESSION['error'] = $error_msg;
      }
      header("Location: ../Users/UserProfile.php");
      exit();
    }elseif(isset($_POST['updateFirstname'])){
      $firstname=$_POST['Firstname']; 
      $user_id=$_POST['user_id'];
      $stmt = $connect->prepare("UPDATE users SET first_name = ? WHERE id = ?");
      $stmt->bind_param('si', $firstname, $user_id );
      $stmt->execute();
      if($stmt==true){
        $_SESSION['success']="Firstname updated successfully.";

      }else {
        $_SESSION['success']="Firstname failed to update.";

      }
      header("Location: ../Admin/TraineeProfile.php?trainee_profile= $user_id ");
      exit();
    }elseif(isset($_POST['updateMiddlename'])){
      $middlename=$_POST['Middlename']; 
      $user_id=$_POST['user_id'];
      $stmt = $connect->prepare("UPDATE users SET middle_name = ? WHERE id = ?");
      $stmt->bind_param('si', $middlename, $user_id );
      $stmt->execute();
      if($stmt==true){
        $_SESSION['success']="Middlename updated successfully.";

      }else {
        $_SESSION['success']="Middlename failed to update.";

      }
      header("Location: ../Admin/TraineeProfile.php?trainee_profile= $user_id ");
      exit();
    }elseif(isset($_POST['updateLastname'])){
      $lastname=$_POST['Lastname']; 
      $user_id=$_POST['user_id'];
      $stmt = $connect->prepare("UPDATE users SET last_name = ? WHERE id = ?");
      $stmt->bind_param('si', $lastname, $user_id );
      $stmt->execute();
      if($stmt==true){
        $_SESSION['success']="Lastname updated successfully.";

      }else {
        $_SESSION['success']="Lastname failed to update.";

      }
      header("Location: ../Admin/TraineeProfile.php?trainee_profile= $user_id ");
      exit();
    }elseif(isset($_POST['updateSex'])){
      $sex=$_POST['Sex']; 
      $user_id=$_POST['user_id'];
      $stmt = $connect->prepare("UPDATE users SET sex = ? WHERE id = ?");
      $stmt->bind_param('si', $sex, $user_id );
      $stmt->execute();
      if($stmt==true){
        $_SESSION['success']="Sex updated successfully.";

      }else {
        $_SESSION['success']="Sex failed to update.";

      }
      header("Location: ../Admin/TraineeProfile.php?trainee_profile= $user_id ");
      exit();
    }elseif(isset($_POST['updateContact'])){
      $contact=$_POST['Contact']; 
      $user_id=$_POST['user_id'];
      $usertype=$_POST['usertype'];
      $stmt = $connect->prepare("UPDATE trainees SET contact_num = ? WHERE user_id = ?");
      $stmt->bind_param('si', $contact, $user_id );
      $stmt->execute();
      if($stmt==true){
          if($usertype === 'Admin'){
            $_SESSION['success']="Date of Birth updated successfully.";
            header("Location: ../Admin/TraineeProfile.php?trainee_profile= $user_id ");
            exit();
          }else{
            $_SESSION['success']="Date of Birth updated successfully.";
            header("Location: ../Users/UserProfile.php");
            exit();
          }
        }else{
          if($usertype === 'Admin') {
          $_SESSION['error']="Date of Birth failed to update.";
          header("Location: ../Admin/TraineeProfile.php?trainee_profile= $user_id ");
          exit();
        }else{
          $error_msg = "Date of Birth failed to uodate.";
          $_SESSION['error'] = $error_msg;
          header("Location: ../Users/UserProfile.php");
      }
    }
      header("Location: ../Admin/TraineeProfile.php?trainee_profile= $user_id ");
      exit();
    }elseif(isset($_POST['updateDegree'])){
      $course = $_POST['Degree']; 
      $user_id=$_POST['user_id'];
      $stmt = $connect->prepare("UPDATE trainees SET degree = ? WHERE user_id = ?");
      $stmt->bind_param('si', $course, $user_id );
      $stmt->execute();
      if($stmt==true){
        $_SESSION['success']="Course updated successfully.";

      }else {
        $_SESSION['success']="Course failed to update.";

      }
      header("Location: ../Admin/TraineeProfile.php?trainee_profile= $user_id ");
      exit();
    }elseif(isset($_POST['updateUniversity'])){
      $university = $_POST['University']; 
      $user_id=$_POST['user_id'];
      $stmt = $connect->prepare("UPDATE trainees SET university = ? WHERE user_id = ?");
      $stmt->bind_param('si', $university, $user_id );
      $stmt->execute();
      if($stmt==true){
        $_SESSION['success']="University updated successfully.";

      }else {
        $_SESSION['success']="University failed to update.";

      }
      header("Location: ../Admin/TraineeProfile.php?trainee_profile= $user_id ");
      exit();
    }elseif(isset($_POST['updateHours'])){
      $hours = $_POST['Hours']; 
      $user_id=$_POST['user_id'];
      $stmt = $connect->prepare("UPDATE trainees SET hours_to_render = ? WHERE user_id = ?");
      $stmt->bind_param('si', $hours, $user_id );
      $stmt->execute();
      if($stmt==true){
        $_SESSION['success']="Hours to render updated successfully.";

      }else {
        $_SESSION['success']="Hours to render failed to update.";

      }
      header("Location: ../Admin/TraineeProfile.php?trainee_profile= $user_id ");
      exit();
    }elseif(isset($_POST['updateEmail'])){
      $email = $_POST['Email']; 
      $user_id=$_POST['user_id'];
      $stmt = $connect->prepare("UPDATE trainees tr , users us SET tr.email = ?, us.email = ? WHERE tr.user_id = ? AND us.id = ? ");
      $stmt->bind_param('ssii', $email, $email, $user_id, $user_id );
      $stmt->execute();
      if($stmt==true){
        $_SESSION['success']="Email updated successfully.";

      }else {
        $_SESSION['success']="Email failed to update.";

      }
      header("Location: ../Admin/TraineeProfile.php?trainee_profile= $user_id ");
      exit();
    }elseif(isset($_POST['updateDos'])){
      $dos = $_POST['dateStart']; 
      var_dump($_POST);
      $user_id=$_POST['user_id'];
      $stmt = $connect->prepare("UPDATE trainees SET dos = ? WHERE user_id = ? ");
      $stmt->bind_param('si', $dos, $user_id );
      $stmt->execute();
      if($stmt==true){
        $_SESSION['success']="Date of start updated successfully.";

      }else {
        $_SESSION['success']="Date of start failed to update.";

      }
      header("Location: ../Admin/TraineeProfile.php?trainee_profile= $user_id ");
      exit();

    }elseif(isset($_POST['editDepartment'])){
      $department_id = $_POST['department_id'];
       $department_name= $_POST['department'];
    
      $sql_dept = "UPDATE departments SET departments = ? WHERE id = ?";
      $stmt_dept = $connect->prepare($sql_dept);
      $stmt_dept->bind_param('si', $department_name, $department_id);
      $stmt_dept->execute();
    
      if($stmt_dept->execute() === TRUE){
    
        $_SESSION['success'] = "Deparment updated successfully.";

      }else {
        $_SESSION['error'] = "Failed to update department.";
      }
      $redirect_url = ($usertype === 'Trainee') ? '../Functions/SettingsUser.php' : ($usertype === 'Admin' ? '../Functions/SettingsAdmin.php' : '../Functions/SettingsManager.php');
      header("Location: $redirect_url");
      header("Location: ../Admin/Departments.php");
      exit();
    }
    
?>
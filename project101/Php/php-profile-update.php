<?php
session_start();
include 'db_connect.php';
if(isset($_POST['updateBirthday'])) {
    $user_id=$_POST['user_id'];
    $dob=$_POST['updatedob']; 

    $updateBirthday="UPDATE users SET dob='$dob' WHERE id = '$user_id'";
    $updateBirthday_query=mysqli_query($connect, $updateBirthday);
      if($updateBirthday_query==true){
        $_SESSION['success']="Date of Birth updated successfully.";
        header("Location: ../Users/UserProfile.php");
        exit();
      }else {
        $error_msg = "Please fill all the fieds.";
        $_SESSION['error'] = $error_msg;
        header("Location: ../Users/UserProfile.php");
      }

}elseif(isset($_POST['updateContacts'])) {
    $user_id=$_POST['user_id'];
    $contact_num=$_POST['updateContact']; 

    $updateContact="UPDATE trainees SET contact_num='$contact_num' WHERE user_id = '$user_id'";
    $updateContact_query=mysqli_query($connect, $updateContact);
      if($updateContact_query==true){
        $_SESSION['success']="Contact number updated successfully.";
        header("Location: ../Users/UserProfile.php");
        exit();
      }else {
        $error_msg = "Please fill all the fieds.";
        $_SESSION['error'] = $error_msg;
        header("Location: ../Users/UserProfile.php");
      }
    }
?>
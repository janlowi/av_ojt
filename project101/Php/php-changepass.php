<?php 
session_start();

 include '../Php/db_connect.php';

            if($_SERVER['REQUEST_METHOD']=="POST"){

                $currentPass=$_POST['CurrentPassword'];
                $newPass=$_POST['NewPassword'];
                $confirmNewPass=$_POST['ConfirmNewPassword'];
                $user_id=$_POST['user_id'];
                $error_msg[]="";

                if(empty($currentPass) &&
                    empty($newPass) &&
                    empty($confirmNewPass)) {

                        $error_msg="Fill all the fields.";
                    } else {
                        
                        $currPass="SELECT password, user_type FROM users WHERE id= '$user_id'";
                        $currPass_query=mysqli_query($connect, $currPass);
                        $currPass_row=mysqli_fetch_assoc($currPass_query);
                        $usertype=$currPass_row['user_type'];
                        if(password_verify($currentPass, $currPass_row['password'])){

                                if($newPass===$confirmNewPass){
                                        $newPass_hashed= password_hash($newPass, PASSWORD_DEFAULT);

                                        $updatePass= "UPDATE users SET password= '$newPass_hashed' WHERE id = '$user_id'";
                                        $updatePass_query=mysqli_query($connect, $updatePass);
                                    if($updatePass_query==true ){
                                         if($usertype==='Trainee'){
                                        $_SESSION['success']="Password changes successfully.";
                                        header("Location: ../Functions/SettingsUser.php");
                                        exit();
                                    }elseif($usertype==='Admin'){
                                        $_SESSION['success']="Password changes successfully.";
                                        header("Location: ../Functions/SettingsAdmin.php");
                                        exit();
                                    }else {
                                        $error_msg="Failed to change password.";
                                    }
                        }

                    } else{
                        $error_msg="New password and confirm password does not match.";
                    }
            }else{
                $error_msg="Current password is incorrect.";
            }

          
        }
        $_SESSION['error']=$error_msg;
        header('location: ../Functions/SettingsUser.php');
        exit();
    }

 ?>
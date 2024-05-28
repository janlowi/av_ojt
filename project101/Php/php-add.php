<?php
session_start();

include 'db_connect.php';
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Function to generate a random password
function generateRandomPassword($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $password;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if(isset($_POST['traineeSubmit'])){

        // Retrieve form data
        $ojtid = $_POST["Ojtid"];
        $firstname = $_POST["Firstname"];
        $middlename = $_POST["Middlename"];
        $lastname = $_POST["Lastname"];
        $dob = $_POST["Birthday"];
        $sex = $_POST["Sex"];
        $course = $_POST["Course"];
        $university = $_POST["University"];
        $hours_to_render = $_POST["Hours"];
        $dos = $_POST["Dos"];
        $office = $_POST["Office"];
        $email = $_POST["Email"];
        $user_type = $_POST["Usertype"];
        $contact_num = $_POST["Contact"];
        $status = $_POST["Status"];
        $department = $_POST["Department"];
        $default_profile = '../Assets/img/avatars/av.png';

        // Extract initials from the user's full name
        $stmt=$connect->prepare("SELECT * FROM users WHERE email=?");
                $stmt->execute([$email]);
                $check_email=$stmt->fetch(); 
               if($check_email) {
                $error_msg="Email arlready in use.";
                $_SESSION['error'] = $error_msg;
                header("Location: ../Admin/AdminDashboard.php");
                exit();
               }else {

             
              

        $full_name = $firstname . ' ' . $lastname;
        $name_parts = explode(' ', $full_name);
        $initials = '';
        foreach ($name_parts as $part) {
            $initials .= strtoupper(substr($part, 0, 1)); // Get the first character of each part
        }

        // Generate a random password with initials
        $password_generated = 'AV-' . $initials . generateRandomPassword();

        // Use $password_generated for sending in email or displaying to the user
        // echo "Generated Password: " . $password_generated;

        // Construct email body
        $mail_body = 'This is your OJT account:<br><br>'
                    . 'Email: ' . $email . '<br>'
                    . 'Password:' . $password_generated;

        // Validate form fields
        if( !empty( $ojtid)&&     
            !empty( $firstname)&&
            !empty( $middlename)&&
            !empty( $lastname)&&
            !empty( $dob)&&
            !empty( $sex)&&
            !empty( $course)&&
            !empty( $university)&&
            !empty( $hours_to_render)&&
            !empty( $dos)&&
            !empty( $office)&&
            !empty( $email)&&  
            !empty( $department)&& 
            !empty( $user_type)&&
            !empty( $contact_num)) {

            // Hash the generated password
            $pass_hashed = password_hash($password_generated, PASSWORD_DEFAULT);
            
            // Send email
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'gastardo.johnlouie10@gmail.com';
                $mail->Password   = 'holb ctep kytm ualr';
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;
                
                //Recipients
                $mail->setFrom('gastardo.johnlouie10@gmail.com', 'John Louie Gastardo');
                $mail->addAddress($email, $firstname);
                $mail->addReplyTo('info@example.com', 'Information');
                
                // Content
                $mail->isHTML(true);
                $mail->Subject = 'OJT Account';
                $mail->Body = $mail_body;
                
                $mail->send();
                $success_msg ='Email has been sent!';
            } catch (Exception $e) {
                $error_msg= "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
  
            // Insert data into database
            $sql = "INSERT INTO users (
                        first_name,
                        middle_name,
                        last_name,
                        dob,
                        sex,
                        office_assigned, 
                        email,
                        password, 
                        user_type,  
                        department,
                        status,
                        profile
                    ) VALUES (         
                        '$firstname',
                        '$middlename',
                        '$lastname',
                        '$dob',
                        '$sex',
                        '$office',
                        '$email',
                        '$pass_hashed',
                        '$user_type',
                        '$department',
                        '$status',
                        '$default_profile'
                    )";
  
            $query = mysqli_query($connect, $sql);
  
            if ($query == 1) {
                $user_id = mysqli_insert_id($connect);
                $insert = "INSERT INTO trainees(
                            ojt_id, 
                            user_id,  
                            contact_num, 
                            degree, 
                            university,
                            hours_to_render, 
                            email, 
                            dos
                        ) VALUES (
                            '$ojtid',
                            '$user_id', 
                            '$contact_num',
                            '$course',
                            '$university',
                            '$hours_to_render',
                            '$email',
                            '$dos'
                        )";
  
                $query = mysqli_query($connect, $insert);
  
                if ($query == 1) {
                    $success_msg = "Trainee added successfully.";
                    $_SESSION['success'] = $success_msg;
                    header("Location: ../Admin/AdminDashboard.php");
                    exit();
                } else {
                    $error_msg = "Failed to add trainee.";
                }
            } else {
                $error_msg = "Failed to add user.";
            }
        } else {
            $error_msg = "Please fill all the fields.";
        }

     }    

    } elseif (isset($_POST['adminSubmit'])) {
        $firstname = $_POST["Firstname"];
        $middlename = $_POST["Middlename"];
        $lastname = $_POST["Lastname"];
        $sex = $_POST["Sex"];
        $office = $_POST["Office"];
        $email = $_POST["Email"];
        $user_type = $_POST["Usertype"];
        $status = $_POST["Status"];
        $department = $_POST["Department"];
        $dob = $_POST["Birthday"];
    

         $stmt=$connect->prepare("SELECT * FROM users WHERE email=?");
                $stmt->execute([$email]);
                $check_email=$stmt->fetch(); 
               if($check_email) {
                $error_msg="Email arlready in use.";
                $_SESSION['error'] = $error_msg;
                header("Location: ../Admin/AdminDashboard.php");
                exit();
               }else {
          // Extract initials from the user's full name
          $full_name = $firstname . ' ' . $lastname;
          $name_parts = explode(' ', $full_name);
          $initials = '';
          foreach ($name_parts as $part) {
              $initials .= strtoupper(substr($part, 0, 1)); // Get the first character of each part
          }
  
          // Generate a random password with initials
          $password_generated = 'AV-' . $initials . generateRandomPassword();
  
          // Use $password_generated for sending in email or displaying to the user
          // echo "Generated Password: " . $password_generated;
  
          // Construct email body
          $mail_body = 'This is your OJT account body:<br><br>'
                      . 'Email: ' . $email . '<br>'
                      . 'Password:' . $password_generated
                      . 'Link:' . 'http://localhost:8080/av_ojt/project101/Login/index.php';
        if (
            !empty($firstname) &&   
            !empty($middlename) &&
            !empty($lastname) &&
            !empty($dob) &&
            !empty($sex) &&
            !empty($office) &&
            !empty($email) &&
            !empty($department) &&
            !empty($user_type)
        ) {
                    $pass_hashed = password_hash($password_generated, PASSWORD_DEFAULT);
    
                    $sql = "INSERT INTO users (
                               
                                first_name,
                                middle_name,
                                last_name,
                                dob,
                                sex,
                                email,
                                password,
                                user_type,  
                                department,
                                office_assigned, 
                                profile,
                                status
                            )
                            VALUES (       
                                '$firstname',
                                '$middlename',
                                '$lastname',
                                '$dob',
                                '$sex',
                                '$email',
                                '$pass_hashed',
                                '$user_type',
                                '$department',
                                '$office',
                                '$default_profile',
                                '$status'
                            )";
    
                    $query = mysqli_query($connect, $sql);
    
                    if ($query == 1) {
  
                      $pass_hashed= password_hash($password_generated, PASSWORD_DEFAULT);
                        // Send email
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'gastardo.johnlouie10@gmail.com';
                $mail->Password   = 'holb ctep kytm ualr';
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;
                
                //Recipients
                $mail->setFrom('gastardo.johnlouie10@gmail.com', 'John Louie Gastardo');
                $mail->addAddress($email, $firstname);
                $mail->addReplyTo('info@example.com', 'Information');
                
                // Content
                $mail->isHTML(true);
                $mail->Subject = 'OJT Account';
                $mail->Body = $mail_body;
                
                $mail->send();
                $success_msg ='Email has been sent!';
            } catch (Exception $e) {
                $error_msg= "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

            $success_msg = "Admin added successfully.";
            $_SESSION['success'] = $success_msg;
            header("Location: ../Admin/AdminDashboard.php");
            exit();
    } else {
        $error_msg = "Invalid form submission.";
    }

    $_SESSION['error'] = $error_msg;
    header("Location: ../Admin/AdminDashboard.php");
    exit();
}
    }
}
}
?>

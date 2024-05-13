
<?php
session_start();

include 'db_connect.php';

require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

error_reporting(E_ALL); 
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if(isset($_POST['traineeSubmit'])){

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
  
  
            if(strlen($password) >=8) 
            {
              if($password === $confirm_pass) {
                      $pass_hashed= password_hash($password, PASSWORD_DEFAULT);
                      $mail = new PHPMailer(true); // Passing `true` enables exceptions

                      try {
                          //Server settings
                          $mail->isSMTP();                                           // Send using SMTP
                          $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                          $mail->SMTPAuth   = true;                                  // Enable SMTP authentication
                          $mail->Username   = 'gastardo.johnlouie10@gmail.com';                    // SMTP username
                          $mail->Password   = 'holb ctep kytm ualr';                       // SMTP password
                          $mail->SMTPSecure = 'tls';                                 // Enable TLS encryption; `ssl` also accepted
                          $mail->Port       = 587;                                   // TCP port to connect to
                      
                          //Recipients
                          $mail->setFrom('gastardo.johnlouie10@gmail.com', 'John Louie Gastardo');
                          $mail->addAddress($email, $firstname);    // Add a recipient
                          $mail->addReplyTo('info@example.com', 'Information');
                      
                         // Content
                            $mail->isHTML(true); // Set email format to HTML
                            $mail->Subject = 'OJT Account';
                            $mail->Body = 'This is your OJT account body:<br><br>'
                                        . 'Email: ' . $email . '<br>'
                                        . 'Password: AV_ojt101';
                            $mail->AltBody = 'This is your OJT account body:\n\n'
                                        . 'Email: ' . $email . '\n'
                                        . 'Password: AV_ojt101';

                      
                          $mail->send();
                          $success_msg ='Email has been sent!';
                      } catch (Exception $e) {
                          $error_msg= "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    

                      }
  
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
                                                                                    exit();
  
                                            } else {
      
                                              $error_msg = "Failed to add trainee.";
   
                                            }
                      
  
                      }  else {
      
        $error_msg = "Password does not match";
  
  
      }
    
    } else {
      
      $error_msg = "Password must be equal or greater than 8 charaacters.";
  
     }
    
   }
   else {
      
    $error_msg = "Please fill all the fieds.";
  
   }
  
    } elseif (isset($_POST['adminSubmit'])){


      $firstname = $_POST["Firstname"];
      $middlename = $_POST["Middlename"];
      $lastname = $_POST["Lastname"];
      $sex = $_POST["Sex"];
      $office = $_POST["Office"];
      $email = $_POST["Email"];
      $password = $_POST["Password"];
      $confirm_pass = $_POST["Confirm"];
      $user_type = $_POST["Usertype"];
      $status = $_POST["Status"];
      $department = $_POST["Department"];
  
      if (
          !empty($firstname) &&
          !empty($middlename) &&
          !empty($lastname) &&
          !empty($office) &&
          !empty($email) &&
          !empty($password) &&
          !empty($confirm_pass) &&
          !empty($department) &&
          !empty($user_type)
      ) {
          if (strlen($password) >= 8) {
              if ($password === $confirm_pass) {
                  $pass_hashed = password_hash($password, PASSWORD_DEFAULT);
  
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
  
                  $query = mysqli_query($connect, $sql);
  
                  if ($query == 1) {

                        
                                $to = $email;
                                $subject = "Test Email";
                                $message = "This is a test email.";
                                
                                // Additional headers
                                $headers = "From: gastardo.johnlouie10@gmail.com\r\n";
                                $headers .= "Reply-To: sender@example.com\r\n";
                                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                                
                                // Send email
                                $mailSent = mail($to, $subject, $message, $headers);
                                
                                if ($mailSent) {
                                    $success_msg= "Email sent successfully!";
                                } else {
                                    $error_msg = "Failed to send email.";
                                }

                    

                      $success_msg = "Admin added successfully.";
                      $_SESSION['success'] = $success_msg;
                      header("Location: ../Admin/AdminDashboard.php");
                      exit();
                  } else {
                      $error_msg = "Failed to add Admin.";
                  }
              } else {
                  $error_msg = "Password does not match";
              }
          } else {
              $error_msg = "Password must be equal or greater than 8 characters.";
          }
      } else {
          $error_msg = "Please fill all the fields.";
      }
  } else {
      $error_msg = "Error adding user.";
  }
  
  $_SESSION['error'] = $error_msg;
  header("Location: ../Admin/AdminDashboard.php");
  exit();

}

?>

<?php 
session_start();

include '../Php/db_connect.php';

date_default_timezone_set('Asia/Manila');

require '../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == "POST") {




    $currentPass = $_POST['CurrentPassword'];
    $newPass = $_POST['NewPassword'];
    $confirmNewPass = $_POST['ConfirmNewPassword'];
    $user_id = $_POST['user_id'];
    $error_msg = "";

    if (empty($currentPass) || empty($newPass) || empty($confirmNewPass)) {
        $error_msg = "Fill all the fields.";
    } else {
        $currPass = "SELECT password, user_type, email, first_name  FROM users WHERE id= '$user_id'";
        $currPass_query = mysqli_query($connect, $currPass);
        $currPass_row = mysqli_fetch_assoc($currPass_query);
        $usertype = $currPass_row['user_type'];
        $email = $currPass_row['email'];
        $firstname = $currPass_row['first_name'];

        if (password_verify($currentPass, $currPass_row['password'])) {
            if ($newPass === $confirmNewPass) {
                $newPass_hashed = password_hash($newPass, PASSWORD_DEFAULT);

                $updatePass = "UPDATE users SET password= '$newPass_hashed' WHERE id = '$user_id'";
                $updatePass_query = mysqli_query($connect, $updatePass);
                if ($updatePass_query) {
                    $mail_body = 'You changed your password today ' . date('Y-m-d H:i:s') . ' <br><br>
                                Ignore this mail if you made the changes.';

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
                        $_SESSION['success'] = 'Email has been sent!';
                    } catch (Exception $e) {
                        $_SESSION['error'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }

                    $_SESSION['success'] = "Password changed successfully.";
                    $redirect_url = ($usertype === 'Trainee') ? '../Functions/SettingsUser.php' : '../Functions/SettingsAdmin.php';
                    header("Location: $redirect_url");
                    exit();
                } else {
                    $error_msg = "Failed to change password.";
                }
            } else {
                $error_msg = "New password and confirm password do not match.";
            }
        } else {
            $error_msg = "Current password is incorrect.";
        }
    }
    $_SESSION['error'] = $error_msg;
    header('location: ../Functions/SettingsUser.php');
    exit();
}
?>

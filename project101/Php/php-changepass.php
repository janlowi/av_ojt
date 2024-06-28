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
                        $mail->Host       = 'smtp.avegabros.com';
                        $mail->SMTPAuth   = true;
                        $mail->Username   = 'noreply@avegabros.com';
                        $mail->Password   = '';
                        $mail->SMTPSecure = 'tls';
                        $mail->Port       = 587;
                        
                        //Recipients
                        $mail->setFrom('noreply@avegabros.com', 'AvegaIT');
                        $mail->addAddress($email, $firstname);
                        
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
                    $redirect_url = ($usertype === 'Trainee') ? '../Users/UserDashboard.php' : ($usertype === 'Admin' ? '../Admin/AdminDashboard.php' : '../Manager/ManagerDashboard.php');
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


 if(isset($_GET['reset_pass'])){

    // Function to generate a random password
function generateRandomPassword($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $password;
}

    $reset_id  = $_GET['reset_pass'];
    $sql_user = "SELECT first_name, email FROM users WHERE id= ?";{
    $stmt = $connect->prepare($sql_user);
    $stmt->bind_param('i', $reset_id);
    $stmt->execute();
    $sql_user_result=$stmt->get_result();

    
    if( $sql_user_result->num_rows > 0 ){
        while($user_row =$sql_user_result->fetch_assoc()){

            $user_email = $user_row['email'];
            $user_firstname = $user_row['first_name'];

    $new_pass =generateRandomPassword();
    $new_pass_hashed = password_hash($new_pass, PASSWORD_DEFAULT);


    $reset_sql = "UPDATE users  SET password = ? WHERE id = ? ";
    $stmt_reset = $connect->prepare($reset_sql);
    $stmt_reset->bind_param('si',$new_pass_hashed, $reset_id);
    $stmt_reset->execute();
    
    if($stmt_reset->execute()){

        $mail_body = 'You password has been reset today :  ' . date('Y-m-d H:i:s') . ' <br><br>'
                       . 'Here is your new password : '.$new_pass .' <br><br>'
                       . '<a href="http://tams.avegabros.local/Login/index.php" style="background-color: #4CAF50; color: white; padding: 15px 25px; text-align: center; text-decoration: none; display: inline-block; border-radius: 10px;">Login</a>';

     

// Send email
$mail = new PHPMailer(true);
try {
//Server settings
$mail->isSMTP();
$mail->Host       = 'smtp.avegabros.com';
$mail->SMTPAuth   = true;
$mail->Username   = 'noreply@avegabros.com';
$mail->Password   = '';
$mail->SMTPSecure = 'tls';
$mail->Port       = 587;

//Recipients
$mail->setFrom('noreply@avegabros.com', 'AvegaIT');
$mail->addAddress($user_email, $user_firstname);

// Content
$mail->isHTML(true);
$mail->Subject = 'OJT Account';
$mail->Body = $mail_body;

$mail->send();
$_SESSION['success'] = 'Email has been sent!';
} catch (Exception $e) {
$_SESSION['error'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

$_SESSION['success'] = "Password has been reset.";

} else{
    $_SESSION['error'] = "Faile to reset password.";

    
}

}

    }
}
header("Location: ../Admin/AdminDashboard.php");
exit();
}

?>

<?php
// User registration process...

// Assuming you have user details like email stored in variables
$user_email = "salgarinocharity@gmail.com";
$user_name = "John Doe";

// Email details
$to = $user_email;
$subject = "Welcome to our website!";
$message = "Dear $user_name,\n\nThank you for registering on our website. We are glad to have you with us!";
$headers = "From: bebelynrodrigo00@gmail.com";

// Send email
$mail_sent = mail($to, $subject, $message, $headers);

// Check if mail sent successfully
if ($mail_sent) {
    echo "Email sent successfully to $user_email";
} else {
    echo "Failed to send email";
}
?>
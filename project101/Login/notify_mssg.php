<?php

$subject = "Email Notification";
$message = "Thank you for your email";
$message = "Your Registering details are as follows:";
$message .= "<br><br>";
$message .= "<table border='1'>";
$message .= "<tr><td>Name</td><td>".$_POST['name']."</td></tr>";
$message .= "<tr><td>Email</td><td>".$_POST['email']."</td></tr>";
$message .= "</table>";

$from = $_POST['email'];
$to =  array('my_address@example.com', 'my_address2@example.com', $from);
$lp = "notification@example.com";

$headers = "MIME-Version: 1.0\r\n"; 

$headers .= "Content-type: text/html; charset=utf-8\r\n"; 

$headers .=  'from: '.$lp .'' . "\r\n" .

            'Reply-To: '.$lp.'' . "\r\n" .

            'X-Mailer: PHP/' . phpversion();

foreach($to as $row)
{
   mail($row,$subject,$message,$headers);
}

echo "Mail Sent.";
die;
?>
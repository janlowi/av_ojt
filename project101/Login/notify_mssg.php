<?php

// Settings



$mail = new PHPMailer;
$mail = isSMTP ();
$mail->Host       = "mail.example.com";    
$mail->SMTPDebug  = 0;                     
$mail->SMTPAuth   = true;                  
$mail->Port       = 25;                   
$mail->Username   = "username";            
$mail->Password   = "password";
$mail-> SMTPSecure = 'ssl';             

// Content
$mail->setFrom('domain@example.com');   
$mail->addAddress('receipt@domain.com');

$mail->isHTML(true);                       
$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

$mail->send();
?>
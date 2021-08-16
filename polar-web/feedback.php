<?php
include "class.phpmailer.php";
$msg = "";
//exit(var_dump($_POST));
if(isset($_POST['submit'])) { 
$mail = new PHPMailer();

$mail->FromName = $_POST['name'];
$mail->From = $_POST['email'];
$subject = $_POST['subject'];
$mail->AddAddress('info@polar-management.com','Administrator');
$mail->Subject = $subject;
$mail->Body =<<<EMAILBODY
{$_POST['name']} with email {$_POST['email']} sent the following message via web feedback:
Message: {$_POST['message']}

EMAILBODY;
//exit(var_dump($mail));
if(!$mail->Send()){
    $msg =  "Error: Message not sent: $mail->ErrorInfo ";
    
} else {
    $msg =  "The message was sent successfully. Thank You. ";
    
}
} else {
    $msg =  "Error: Page submit ";
    
}
$msg = base64_encode($msg);
header("Location:contact.php?msg=$msg");
?>
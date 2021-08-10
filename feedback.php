<?php
include "class.phpmailer.php";

require 'phpmailer/PHPMailerAutoload.php';


$mail = new PHPMailer(true); 
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$msg = "";
$mail->IsSMTP(); 
$mail->SMTPAuth = true; 
$mail->SMTPSecure = 'tls'; 
$mail->Host = "smtp.gmail.com";
        $mail->Port = 587; // or 587
        $mail->Username = "alatpres@gmail.com";
        $mail->Password = "publicsafety";
        $mail->setFrom($_POST['email'], 'Contact US');
        //$to =   $this->email ;
        $subject = $_POST['subject'];
        // $to =   $this->email ;
        $mail->addAddress('kwendobrian96@gmail.com');
        $mail->Subject = $subject;
        $message = "{$_POST['name']} with email {$_POST['email']} sent the following message via web feedback:
        Message: {$_POST['message']}";          
        $mail->msgHTML($message);

        if(!$mail->Send()){
            $msg =  "Error: Message not sent: $mail->ErrorInfo ";
            
        } else {
            $msg =  "The message was sent successfully. Thank You. ";
            
        }

        $msg = base64_encode($msg);
        header("Location:contact.php?msg=$msg");



// //exit(var_dump($_POST));
//         if(isset($_POST['submit'])) { 
//             $mail = new PHPMailer();

//             $mail->FromName = $_POST['name'];
//             $mail->From = $_POST['email'];
//             $mail->AddAddress('info@polar-management.com','Administrator');
//             $mail->Subject = $subject;

//             EMAILBODY;
// //exit(var_dump($mail));
//             if(!$mail->Send()){
//                 $msg =  "Error: Message not sent: $mail->ErrorInfo ";

//             } else {
//                 $msg =  "The message was sent successfully. Thank You. ";

//             }
//         } else {
//             $msg =  "Error: Page submit ";

//         }

    ?>
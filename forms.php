<?php

$postData = array();
$postData['applicant_name'] = $_POST['applicant_name'];
$postData['email_address'] = $_POST['email_address'];
$postData['id_no'] = "00";
$postData['personal_contact'] = $_POST['personal_contact'];
$postData['created_by'] = 'Web Applicant';

$payload = json_encode($postData);

echo $payload;

$remote_url = "https://www.peakbooks.biz:2005/applicant_add";

$ch = curl_init();
curl_setopt_array(
    $ch, array(
      CURLOPT_URL => $remote_url,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_SSL_VERIFYPEER => true,
      CURLOPT_RETURNTRANSFER => true,
      CURLINFO_HEADER_OUT => true,
      CURLOPT_POST => true,
      CURLOPT_POSTFIELDS => $payload,
      CURLOPT_HTTPHEADER => array(
        'Accept: application/json',
        'Content-Type: application/json',
        'Content-Length: ' . strlen($payload)
    )
  )
); 
$return = curl_exec($ch);

$result = json_decode(($return));
if($result->status){

    $msg =  "You have applied succesfully. Thank You. ";

} else {
   $msg =  "Error: Message not sent: $mail->ErrorInfo ";

}

$msg = base64_encode($msg);
header("Location:jobs.php?msg=$msg");


?>
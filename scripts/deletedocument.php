<?php
// required headers
header("Content-Type: application/json; charset=UTF-8");
//Define your host here.

if($_SERVER['REQUEST_METHOD']=='POST'){


 $con = mysqli_connect("157.230.229.119:10330","root","VF3ax6geGdfg32dufgf8","polarman_ats");

   if (!$con) {
    die('Could not connect: ' . mysqli_error());
    }

 $path_word = $_POST['profile_url'];
 $path="/var/www/html/scripts/applicant_documents/".$path_word;

 if(unlink($path)) {
  
   $user_id = $_POST['user_id'];
   
   $query = "DELETE FROM applicant_job_documents 
   WHERE id = '$user_id'";

   if(mysqli_query($con,$query)) {
     echo json_encode(array( "status" => "true","message" => "File Deleted successfully") );
   } 
   else {
     echo json_encode(array( "status" => "false","message" => "Failed!") );
   }

 } 
 else {
   echo json_encode(array( "status" => "false","message" => "Something went wrong contact administrators") );
 }
}

?>

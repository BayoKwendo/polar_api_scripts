<?php
// required headers
header("Content-Type: application/json; charset=UTF-8");
//Define your host here.

if($_SERVER['REQUEST_METHOD']=='POST'){



   $con = mysqli_connect("157.230.229.119:10330","root","VF3ax6geGdfg32dufgf8","polarman_ats");

   if (!$con) {
    die('Could not connect: ' . mysqli_error());
    }


   $document_name = $_FILES['filename']['name'];   

   $documentName= $_POST['document_name'];

   $document_code = $_POST['document_code'];

   $file_number= $_POST['file_number'];

   $created_by = $_POST['created_by'];

   $updated_by= $_POST['updated_by'];


   $originalImgName= time().'_'.$_FILES['filename']['name'];
   $tempName = $_FILES['filename']['tmp_name'];
   $folder="/var/www/html/scripts/applicant_documents/";

   $url = "https://polarmanpower.com/scripts/applicant_documents/".$originalImgName;
   
   $target_file = $folder . basename($originalImgName);  
   
   $urls = $folder.$originalImgName;
        //update path as per your directory structure 
   if(copy($tempName, $target_file)){

    $query = "INSERT INTO applicant_job_documents
    SET
    file_number = '$file_number',
    doc_code = '$document_code',
    doc_name = '$documentName', 
    doc_file = '$url',
    verified_by = '$created_by',
    created_by = '$created_by',
    last_updated_by= '$created_by'";

    if(mysqli_query($con,$query)) {
     echo json_encode(array( "status" => "true","message" => "Document uploaded successfully!") );
    } 
    else {
     echo json_encode(array( "status" => "false","message" => "Error description: " . mysqli_error($con)) );
    }

  }
   else {
   echo json_encode(array( "status" => "false","message" => $target_file) );
 }

}

?>


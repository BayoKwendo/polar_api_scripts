<?php

header("Content-Type: application/json; charset=UTF-8");
//Define your host here.

if($_SERVER['REQUEST_METHOD']=='POST')
{
   require("db.php"); 
   $path_word = $_POST['profile_url'];

   $path="/var/www/html/scripts/images/".$path_word ;

   if($path == "/var/www/html/scripts/images/null") {
     $user_id = $_POST['user_id'];
     $originalImgName= time().'_'.$_FILES['filename']['name'];
     $tempName = $_FILES['filename']['tmp_name'];
     $folder="/var/www/html/scripts/images/";
     $url = "https://polarmanpower.com/scripts/images/".$originalImgName;
     $target_file = $folder . basename($originalImgName);  
     $urls = $folder.$originalImgName;
        //update path as per your directory structure 
     if(copy($tempName, $target_file)){

        $query = "UPDATE bio_data
        SET
        profile_url = '$url'
        WHERE
        id = '$user_id'";

        if(mysqli_query($con,$query)) {
           echo json_encode(array( "status" => "true","message" => "Your logo was uploaded successfully!") );
       } 
       else {
           echo json_encode(array( "status" => "false","message" => "Failed!") );
       }

   } else {
     echo json_encode(array( "status" => "false","message" => $target_file) );
 }

}

else{

   if(unlink($path)) {

     $user_id = $_POST['user_id'];
     $originalImgName= time().'_'.$_FILES['filename']['name'];
     $tempName = $_FILES['filename']['tmp_name'];
     $folder="/var/www/html/scripts/images/";
     $url = "https://polarmanpower.com/scripts/images/".$originalImgName;
     $target_file = $folder . basename($originalImgName);  
     $urls = $folder.$originalImgName;
        //update path as per your directory structure 
     if(copy($tempName, $target_file)){

        $query = "UPDATE bio_data
        SET
        profile_url = '$url'
        WHERE
        id = '$user_id'";

        if(mysqli_query($con,$query)) {
           echo json_encode(array( "status" => "true","message" => "Your logo was uploaded successfully!") );
       } 
       else {
           echo json_encode(array( "status" => "false","message" => "Failed!") );
       }

   } else {
     echo json_encode(array( "status" => "false","message" => $target_file) );
 }
}
else{
     $user_id = $_POST['user_id'];
   $query = "UPDATE bio_data
   SET
   profile_url = 'null'
   WHERE
   id = '$user_id'";

   if(mysqli_query($con,$query)) {

      echo json_encode(array( "status" => "false","message" => "Error! Please Try Again") );
  } 
}

}


}

?>











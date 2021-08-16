<?php
if(isset($_GET['ats-get']) ){ 
    require_once('web-admin/functions.php');
    $sql = "SELECT * FROM job_application WHERE apply='1' ";
    if($ats = db_get_all($sql)){
         echo json_encode($ats);
    }
} elseif(isset($_GET['ats-put'])) {
    $id=intval($_GET['ats-put']);
    require_once('web-admin/functions.php');
    $sql = "UPDATE job_application SET apply='2' WHERE id='$id' ";
    if($ats = db_save($sql)){
         echo 1;
    }else{
        echo '0';
    }
}
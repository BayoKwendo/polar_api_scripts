<?php
if(isset($_GET['ats-get-web-bios']) ){ 
    require_once('functions.php');
    $data = [];
    $sql = "SELECT `id`, `file_number`, `applicant_name`, `id_no`, `applied_job`, `agent_no`, `application_date`, `application_time`, `dob`, `gender`, `marital_status`, `personal_contact`, `email_address`, `physical_address`, `skin_color`, `height`, `weight`, `eye_color`, `medical_status`, `fathers_name`, `mothers_name`, `fathers_contact`, `mothers_contact`, `fathers_address`, `mothers_address`, `next_of_kin`, `kin_relationship`, `kin_address`, `kin_contact` FROM `web_bio_data` WHERE `ats_registered`=0 ";
    if($ats = db_get_all($sql)){
        $data['request'] = 'successful';
        $data['bios'] = ($ats);
    } else {
        $data['request'] = 'Failed';
        $data['msg'] = 'No web applications available';
    }
    echo json_encode($data);
    exit;
} elseif(isset($_GET['ats-get-web-applicant']) ){ 
    $id=intval($_GET['ats-get-web-applicant']);
    require_once('functions.php');
    $data = [];
    $sql = "SELECT `id`, `file_number`, `applicant_name`, `id_no`, `applied_job`, `agent_no`, `application_date`, `application_time`, `dob`, `gender`, `marital_status`, `personal_contact`, `email_address`, `physical_address`, `skin_color`, `height`, `weight`, `eye_color`, `medical_status`, `fathers_name`, `mothers_name`, `fathers_contact`, `mothers_contact`, `fathers_address`, `mothers_address`, `next_of_kin`, `kin_relationship`, `kin_address`, `kin_contact` FROM `web_bio_data` WHERE `ats_registered`=0 ";
    if($ats = db_get_row($sql)){
        $data['request'] = 'successful';
        $data['bio'] = ($ats);
    } else {
        $data['request'] = 'Failed';
        $data['msg'] = 'No web applications available';
    }
    echo json_encode($data);
    exit;
} elseif(isset($_GET['ats-set-web-bios'])) {
    $id=intval($_GET['ats-set-web-bios']);
    require_once('functions.php');
    $sql = "UPDATE web_bio_data SET ats_registered='1' WHERE id='$id' ";
    if($ats = db_save($sql)){
         echo json_encode(['request'=>'successful']);
    }else{
        echo json_encode(['request'=>'failed','msg'=>'Web bio data updata status update failed, try again']);
    }
} else {
    echo json_encode(['request'=>'Failed', 'msg'=>'Access denied, Your request method is not allowed on the server']);
    exit;
}
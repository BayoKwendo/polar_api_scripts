<?php
require_once('web-admin/functions.php');
if(isset($_GET['uname']) && isset($_GET['code'])){
    $username = strval($_GET['uname']);
    $activation_code = strval($_GET['code']);
    $sql = "SELECT id FROM applicant_info WHERE username='$username' AND activation_code='$activation_code' ";
    //exit(var_dump($sql));
    if($activation = db_get_row($sql)){
        if(db_save("UPDATE applicant_info SET activation_code='0', activated='1' WHERE id='$activation->id' ")){
            log_message_A("Thank You for registering with POLAR Management Limited, your account is now active. Please login to get started",'success');
        } else {
            log_message_A("Thank You for registering with POLAR Management Limited, but your account could not be activated. Please retry or contact POLAR Management Limited for assistance",'warning');
        }        
    } else {
        log_message_A("Your account could not be found. Please register or contact POLAR Management Limited for assistance",'danger');
    }
} else {
    log_message_A("Access Denied, Page Access Error. Please retry or contact POLAR Management Limited for assistance",'danger');
}
redirect_page('login.php');
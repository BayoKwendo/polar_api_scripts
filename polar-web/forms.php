<?php
$ds = '/';//DIRECTORY_SEPARATOR;
require_once('web-admin/functions.php');
$return_url = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER']:"./";
$active_user = get_active_user_A();
$usernames = $active_user? "$active_user->full_names":'Anonymous';
$goto_url = $return_url;
if(isset($_POST['account-login'])){
    //exit(var_dump($_POST));
    $url = $return_url;
    $msg = array();
    $err_count = 0;
    $login_name = santize(trim($_POST['login_name']));
    $password = sha1(trim($_POST['login_password']));
    if(!isset($_POST['login_name']) || $_POST['login_name']==""){
        $err_count++;
        $msg[] = " Username or Email field is required ";
    }
    if(!isset($_POST['login_password']) || $_POST['login_password']==""){
        $err_count++;
        $msg[] = " Password field is required ";
    }
    if($err_count>0){
        $log_event='LOGIN: '.log_message_A('<b>Required Form Fields</b><br />'.implode(', ',  $msg),'danger');
        //redirect_page($return_url);
    } else {
        $sql0 = strpos($login_name,'@')? 'email="'.$login_name.'" ':' username="'.$login_name.'" ';
        $sql = 'SELECT * FROM applicant_info WHERE '.$sql0.' AND password="'.$password.'" ';
        if($user = db_get_row($sql)){
            if($user->activated==1){
                $active_user = $user;//get_active_user();
                db_save('UPDATE applicant_info SET last_visit="'.date("Y-m-d H:i:s").'" WHERE id='.$user->id);
                set_user_session_A($user);
                $msg = welcome("$user->first_name $user->last_name");
                log_message_A($msg,'success');
                $url = "./profile.php";
            } else {
                log_message_A("<b>Login Failed</b><br />The Your is not yet activated, click on the activation link in your email to activate your account",'warning');
                $url = "./login.php";
            }
        }else{
            log_message_A("<b>Login Failed</b><br />The Your email /username and login password combination is not correct, check them and tray again",'danger');
            $url = "./login.php";
        }
    }
    //redirect_page($url);
    $goto_url = $url;
} elseif(isset($_POST['applicant_entry'])){
    //exit(var_dump($_POST));
    $url = explode("?",$return_url)[0];
    $href = str_replace('login.php','activate.php',$url);
    //var_dump($url,$href);exit;
    $msg = array();
    $err_count = 0;
    $id=trim($_POST["id"]);
    $first_name=trim($_POST["first_name"]);
    $last_name=trim($_POST["last_name"]);
    $username=trim($_POST["username"]);
    $email_address=trim($_POST["email_address"]);    
    $contact=trim($_POST["contact"]);
    $pass=$id==-1? (trim($_POST["password"])):FALSE;
    $password = sha1($pass);
    $activation = sha1($now);
    if(!isset($_POST["first_name"]) || $_POST["first_name"]==""){
        $err_count++;
        $msg[] = " FIRST NAME field is required ";
    }
    if(!isset($_POST["last_name"]) || $_POST["last_name"]==""){
        $err_count++;
        $msg[] = " LAST NAME field is required ";
    }
    if(!isset($_POST["username"]) || $_POST["username"]==""){
        $err_count++;
        $msg[] = " USERNAME field is required ";
    }
    if(!isset($_POST["email_address"]) || $_POST["email_address"]==""){
        $err_count++;
        $msg[] = " EMAIL field is required ";
    }
    if(!isset($_POST["contact"]) || $_POST["contact"]==""){
        $err_count++;
        $msg[] = " CONTACT field is required ";
    }
    if($id==-1){
        if(!isset($_POST["password"]) || $_POST["password"]==""){
            $err_count++;
            $msg[] = " PASSWORD field is required ";
        }
    }
    if($err_count>0){
        $log_event='User submit validation error: '.log_message_A(implode(', ', $msg), 'danger');
        //redirect_page($return_url);
    } else {
       // exit(var_dump("OK"));
        $sql = "";
        $sql1 = "";
        if ($id > 0 ){
            $sql = "UPDATE applicant_info SET 
                        first_name='$first_name',
                        last_name='$last_name',
                        username='$username',
                        email_address='$email_address' 
                        contact='$contact',                      
                    WHERE id='$id' ";
        } else {
            $sql = "INSERT INTO applicant_info 
                (first_name, last_name, username, email_address, contact, password, activation_code ) 
            VALUES
                ('$first_name', '$last_name', '$username', '$email_address', '$contact', '$password', '$activation' )";
        }
        //exit(var_dump($sql,$sql1));
        if(db_save($sql)){
            if($id<1){
                $activate = 'Click <a href="'.$href.'?uname='.$username.'&code='.$activation.'" >HERE</a> to Activate your Acount';
                require('class.phpmailer.php');
                $mail = new PHPMailer();
                $mail->isHTML(true);  
                $mail->FromName = 'POLAR Webmaster';
                $mail->From = 'info@polar-management.com';
                $mail->AddAddress($email_address,"$first_name $last_name");
                $mail->Subject = 'Welcome to POLAR Management';
                $message = "<p>Thank you for registering with POLAR Management Limited, Optimized Potential.</p>
                            <p>Your account login details are as follows:<br>
                            <b>Username:</b> $username<br>
                            <b>Password:</b> $pass<br>
                            </p>
                            <p>Use the activation link below to activate your POLAR account.</br>
                            <p>$activate</p>";
                $mail->Body = $message;
                //exit(var_dump($mail));
                if(!$mail->Send()){
                    log_message_A("Applicant Info for <b>$username</b> has been created, but activation email could not be sent to your email address, contact POLAR Management to activate your account ",'info');
                } else {
                    log_message_A("Applicant Info for <b>$username</b> has been created, check your email for acount activation and login, You can login with ",'success');
                }
            } else {
                log_message_A("Applicant Info for <b>$username</b> has been Updated ",'success');
            }
        }else{
           log_message_A("Applicant Info for <b>$username</b> could not be saved ",'danger');
        }
    }
    //redirect_page($return_url); 
    $goto_url = $return_url;
} elseif(isset($_POST['profile_entry'])){
    //exit(var_dump($_POST));
    $url = explode("?",$return_url)[0];
    $msg = array();
    $err_count = 0;
    $id=trim($_POST["id"]);
    $first_name=trim($_POST["first_name"]);
    $last_name=trim($_POST["last_name"]);
    $about_me=trim($_POST["about_me"]);
    $email_address=trim($_POST["email_address"]);    
    $contact=trim($_POST["contact"]);
    if(!isset($_POST["first_name"]) || $_POST["first_name"]==""){
        $err_count++;
        $msg[] = " FIRST NAME field is required ";
    }
    if(!isset($_POST["last_name"]) || $_POST["last_name"]==""){
        $err_count++;
        $msg[] = " LAST NAME field is required ";
    }
    if(!isset($_POST["about_me"]) || $_POST["about_me"]==""){
        $err_count++;
        $msg[] = " ABOUT ME field is required ";
    }
    if(!isset($_POST["email_address"]) || $_POST["email_address"]==""){
        $err_count++;
        $msg[] = " EMAIL field is required ";
    }
    if(!isset($_POST["contact"]) || $_POST["contact"]==""){
        $err_count++;
        $msg[] = " CONTACT field is required ";
    }
    if($err_count>0){
        $log_event='Pforile submit validation error: '.log_message_A(implode(', ', $msg), 'danger');
        //redirect_page($return_url);
    } else {
       // exit(var_dump("OK"));
        $sql = "";
        $sql1 = "";
        if ($id > 0 ){
            $sql = "UPDATE applicant_info SET 
                        first_name='$first_name',
                        last_name='$last_name',
                        about_me='$about_me',
                        email_address='$email_address', 
                        contact='$contact'                      
                    WHERE id='$id' ";
        } 
        //exit(var_dump($sql,$sql1));
        if(db_save($sql)){
            log_message_A("Applicant Profile Updated ",'success');
        }else{
           log_message_A("Applicant Profile Update faled, try again ",'danger');
        }
    }
    //redirect_page($return_url); 
    $goto_url = $return_url;
} elseif(isset($_POST['photo_entry'])){    
    //exit(var_dump($_POST,$_FILES));
    //exit(var_dump($_POST,$_FILES));
    $url = explode("?",$return_url)[0];
    $msg = array();
    $err_count = 0;
    $id=trim($_POST["id"]);
    $file = ($_FILES['photo']);
    $old_pix = (trim($_POST['old_pix']));
    
    if(!isset($_FILES['photo']) || $_FILES['photo']["error"]!=0){
        $err_count++;
        $msg[] = " Photo file is required ";
    }
    if($err_count>0){
        log_message_A(implode(', ', $msg), 'danger');
        $goto_url = $return_url;
        //redirect_page($return_url);
    } else {
        // exit(var_dump("OK"));
        $path = 'images/applicants/';
        if(!is_dir($path)) mkdir($path,0777,true);
        $photo = time().'.'.pathinfo($file['name'],PATHINFO_EXTENSION);
        $sql = "";
        if ($id > 0 ){
            $sql = ' UPDATE applicant_info SET photo="'.$photo.'" WHERE id='.$id.'  ';
            if(!move_uploaded_file($file['tmp_name'],$path.$photo)){
                log_message_A("<b>Profile photo  Save Error</b><br />The uploaded photo could not be saved in to directory, try again.",'danger');
                $goto_url = $return_url;
            } else {
                if(db_save($sql)){
                    if($old_pix!='') unlink($path.$old_pix);
                    log_message_A("The uploaded  profile photo has been Saved",'success');
                    $goto_url = $url;
                }else{
                    unlink($path.$photo);
                    log_message_A("The uploaded profile photo could not be Saved DBA error",'danger');
                    $goto_url = $return_url;
                }
            }
        } else {log_message_A("Invalid process",'danger');}
    }
    $goto_url = $return_url; 
} elseif(isset($_POST['password-change'])){
    //exit(var_dump($_POST));
    $url = $return_url;
    $id = intval(santize(trim($_POST['id'])));
    $oldpass = (trim($_POST['oldpass']));
    $password = sha1(trim($_POST['password']));    
    $password2 = sha1(trim($_POST['password2']));
    $current_password = sha1(trim($_POST['current_password']));   
    $err_count=0;
    if(!isset($_POST["current_password"]) || $_POST["current_password"]==""){
        $err_count++;
        $msg[] = " Current Password field is required ";
    }
    if(!isset($_POST["password"]) || $_POST["password"]==""){
        $err_count++;
        $msg[] = " Password field is required ";
    }
    if(!isset($_POST["password2"]) || $_POST["password2"]==""){
        $err_count++;
        $msg[] = " Repeat Password field is required ";
    }    
    if($_POST["password2"] != $_POST["password2"]){
        $err_count++;
        $msg[] = " Repeat password doe not match new password ";
    }
    if($_POST["password2"] != $_POST["password"]){
        $err_count++;
        $msg[] = " Repeat password does not match new password ";
    }
    if($oldpass != $current_password){
        $err_count++;
        $msg[] = " Invalid Current password ";
    }
    if($err_count>0){
        log_message_A(implode(', ', $msg), 'danger');
        //$url = explode("?",$return_url)[0];
    } else {
       // exit(var_dump("OK"));
        $sql = "UPDATE applicant_info SET password='$password' WHERE id={$id}";
        //exit(var_dump($sql));
        if(db_save($sql)){
            log_message_A("<b>Thank You</b><br />Password change was successful.",'success');
        }else{
            log_message_A("<b>Error</b><br /> password Change could not be completed, Try again.",'warning');
        }
    }
    $goto_url = $return_url;
} elseif(isset($_POST['apply_entry'])){
    //exit(var_dump($_POST, $active_user));
    $url = $return_url;
    $msg = array();
    $err_count = 0;
    $id=trim($_POST["id"]);
    $applicant_info_id = $active_user->id;
    $agent= trim($_POST["agent"]);
    $first_name= trim($_POST["first_name"]);
    $last_name=trim($_POST["last_name"]);
    $other_names= trim($_POST["other_names"]);

    $position=explode("+",trim($_POST["position_applied"]));
    $job_ref = $position[0];
    $position_applied = $position[1];

    $applicant_contact=trim($_POST["applicant_contact"]);
    $other_contact=trim($_POST["other_contact"]);
    $address=trim($_POST["address"]);
    $father_name=trim($_POST["father_name"]);
    $father_contact=trim($_POST["father_contact"]);
    $mother_name=trim($_POST["mother_name"]);
    $mother_contact=trim($_POST["mother_contact"]);
    $next_of_kin=trim($_POST["next_of_kin"]);
    $next_of_kin_contact=trim($_POST["next_of_kin_contact"]);
    $county=trim($_POST["county"]);
    $date_of_birth=trim($_POST["date_of_birth"]);
    $id_no=trim($_POST["id_no"]);
    $passport_number=trim($_POST["passport_number"]);
    $passport_profession=trim($_POST["passport_profession"]);
    $date_of_issuance=trim($_POST["date_of_issuance"]);
    $date_of_expiry=trim($_POST["date_of_expiry"]);
    $religion=trim($_POST["religion"]);
    $nationality=trim($_POST["nationality"]);
    $gender=trim($_POST["gender"]);
    $marital_status=trim($_POST["marital_status"]);
    $date_of_application=trim($_POST["date_of_application"]);
    
    if(!isset($_POST["agent"]) || $_POST["agent"]==""){
        $err_count++;
        $msg[] = " AGENT field is required ";
    }
    if(!isset($_POST["first_name"]) || $_POST["first_name"]==""){
        $err_count++;
        $msg[] = " FIRST NAMES field is required ";
    }
    if(!isset($_POST["last_name"]) || $_POST["last_name"]==""){
        $err_count++;
        $msg[] = " LAST NAMES field is required ";
    }
      
    if(!isset($_POST["position_applied"]) || $_POST["position_applied"]==""){
        $err_count++;
        $msg[] = " position_applied field is required ";
    }
    if(!isset($_POST["applicant_contact"]) || $_POST["applicant_contact"]==""){
        $err_count++;
        $msg[] = " Applicant Contact field is required ";
    }
    if(!isset($_POST["address"]) || $_POST["address"]==""){
        $err_count++;
        $msg[] = " ADDRESS field is required ";
    }
    if(!isset($_POST["father_name"]) || $_POST["father_name"]==""){
        $err_count++;
        $msg[] = " father_name field is required ";
    }
    if(!isset($_POST["father_contact"]) || $_POST["father_contact"]==""){
        $err_count++;
        $msg[] = " father_contact field is required ";
    }
    if(!isset($_POST["mother_name"]) || $_POST["mother_name"]==""){
        $err_count++;
        $msg[] = " mother_name field is required ";
    }
    if(!isset($_POST["mother_contact"]) || $_POST["mother_contact"]==""){
        $err_count++;
        $msg[] = " mother_contact field is required ";
    }
    if(!isset($_POST["next_of_kin"]) || $_POST["next_of_kin"]==""){
        $err_count++;
        $msg[] = " next_of_kin field is required ";
    }
    if(!isset($_POST["next_of_kin_contact"]) || $_POST["next_of_kin_contact"]==""){
        $err_count++;
        $msg[] = " next_of_kin_CONTACT field is required ";
    }
    if(!isset($_POST["county"]) || $_POST["county"]==""){
        $err_count++;
        $msg[] = " COUNTY field is required ";
    }
    if(!isset($_POST["date_of_birth"]) || $_POST["date_of_birth"]==""){
        $err_count++;
        $msg[] = " date_of_birth field is required ";
    }
    /*
    if(!isset($_POST["id_no"]) || $_POST["id_no"]==""){
        $err_count++;
        $msg[] = " id_no field is required ";
    }
    /*
    if(!isset($_POST["passport_number"]) || $_POST["passport_number"]==""){
        $err_count++;
        $msg[] = " passport_number field is required ";
    }
    if(!isset($_POST["passport_professional"]) || $_POST["passport_professional"]==""){
        $err_count++;
        $msg[] = " passport_professional field is required ";
    }
    */
    if(!isset($_POST["date_of_issuance"]) || $_POST["date_of_issuance"]==""){
        $err_count++;
        $msg[] = " date_of_issuance field is required ";
    }
    if(!isset($_POST["date_of_expiry"]) || $_POST["date_of_expiry"]==""){
        $err_count++;
        $msg[] = " date_of_expiry field is required ";
    }
    if(!isset($_POST["religion"]) || $_POST["religion"]==""){
        $err_count++;
        $msg[] = " RELIGION field is required ";
    }
    if(!isset($_POST["nationality"]) || $_POST["nationality"]==""){
        $err_count++;
        $msg[] = " NATIONALITY field is required ";
    }
    if(!isset($_POST["gender"]) || $_POST["gender"]==""){
        $err_count++;
        $msg[] = " GENDER field is required ";
    }
    if(!isset($_POST["marital_status"]) || $_POST["marital_status"]==""){
        $err_count++;
        $msg[] = " marital_status field is required ";
    }
    if(!isset($_POST["date_of_application"]) || $_POST["date_of_application"]==""){
        $err_count++;
        $msg[] = " date_of_application field is required ";
    }

    if($err_count>0){
        log_message_A(implode(', ', $msg), 'danger');
        //redirect_page($return_url);
    } else {
       // exit(var_dump("OK"));
        $sql = "";
        $sql1 = "";
        $applicant_contact = str_replace(' ','',$applicant_contact);
        $other_contact = str_replace(' ','',$other_contact);
        if ($id > 0 ){            
            $sql = "UPDATE job_application SET 
                                 agent='$agent', 
                                 first_name='$first_name', 
                                 last_name='$last_name', 
                                 other_names='$other_names',
                                position_applied='$position_applied',                                
                                applicant_contact='$applicant_contact',
                                other_contact='$other_contact',
                                address='$address',
                                father_name='$father_name',
                                father_contact='$father_contact',
                                mother_name='$mother_name',
                                mother_contact='$mother_contact',
                                next_of_kin='$next_of_kin',
                                next_of_kin_contact='$next_of_kin_contact',
                                county='$county',
                                date_of_birth='$date_of_birth',
                                id_no='$id_no',
                                passport_number='$passport_number',
                                passport_profession='$passport_profession',
                                date_of_issuance='$date_of_issuance',
                                date_of_expiry='$date_of_expiry',
                                religion='$religion',
                                nationality='$nationality',
                                gender='$gender',
                                marital_status='$marital_status',
                                date_of_application='$date_of_application',
                                job_ref='$job_ref',
                                applicant_info_id='$applicant_info_id'
                            WHERE id='$id' ";
        } else {
            $sql = "INSERT INTO job_application (
                        agent,
                        position_applied,
                        first_name,
                        last_name,
                        other_names,
                        applicant_contact,
                        other_contact,
                        address,
                        father_name,
                        father_contact,
                        mother_name,
                        mother_contact,
                        next_of_kin,
                        next_of_kin_contact,
                        county,
                        date_of_birth,
                        id_no,
                        passport_number,
                        passport_profession,
                        date_of_issuance,
                        date_of_expiry,
                        religion,
                        nationality,
                        gender,
                        marital_status,
                        date_of_application,
                        job_ref,
                        applicant_info_id) 
                    VALUES (
                        '$agent',
                        '$position_applied',
                        '$first_name',
                        '$last_name',
                        '$other_names',
                        '$applicant_contact',
                        '$other_contact',
                        '$address',
                        '$father_name',
                        '$father_contact',
                        '$mother_name',
                        '$mother_contact',
                        '$next_of_kin',
                        '$next_of_kin_contact',
                        '$county',
                        '$date_of_birth',
                        '$id_no',
                        '$passport_number',
                        '$passport_profession',
                        '$date_of_issuance',
                        '$date_of_expiry',
                        '$religion',
                        '$nationality',
                        '$gender',
                        '$marital_status',
                        '$date_of_application',
                        '$job_ref',
                        '$applicant_info_id') ";
        }
        //exit(var_dump($sql,$sql1));
        if(db_save($sql)){
            log_message_A("Application Saved, You can proceed to submit for job placement",'success');
            $goto_url = explode('?',$return_url)[0];
        }else{
            log_message_A("Application not Saved, try again",'danger');
            $goto_url = $return_url;
        }
    }
    //; 

} elseif(isset($_POST['apply-submit-btn']) && $_POST['id']>0 && $_POST['tbl']!=""){
    //exit(var_dump($_POST));
    $url = $return_url;
    $id = intval(santize(trim($_POST['id'])));
    $table = (trim($_POST['tbl']));
    $msg = (trim($_POST['msg']));
    $sql = "UPDATE {$table} SET apply='1' WHERE id='{$id}'";
    //exit(var_dump($sql));
    if(db_save($sql)){
        log_message_A("<b>Thank You</b><br /><b>$msg </b> have been Submited.",'success');
    }else{
        log_message_A("<b>Submit Error</b><br /><b>$msg </b> could not be Submitted, Try again.",'danger');
    }
    //redirect_page($url); 
    $goto_url = $url; 
} elseif(isset($_POST['delete-btn']) && $_POST['id']>0 && $_POST['tbl']!=""){
    //exit(var_dump($_POST));
    $url = $return_url;
    $id = intval(santize(trim($_POST['id'])));
    $table = (trim($_POST['tbl']));
    $msg = (trim($_POST['msg']));
    $sql = "DELETE FROM {$table} WHERE id={$id}";
    //exit(var_dump($sql));
    if($table=="photos"){
        if($file = db_get_field_val("SELECT file FROM $table WHERE id='$id' ",'file')){
            if(unlink('media/photos/'.$file)){
                if(db_delete($sql)){
                    log_message_A("<b>Thank You</b><br /><b>$msg </b> have been deleted.",'success');
                } else {
                    log_mlog_message_Aessage("<b>DBA Error</b><br /><b>$msg </b> details not removed form DB, try again.",'warning');
                }
            } else {
                log_message_A("<b>Delete Error</b><br /><b>$msg </b> could not be deleted from directory.",'danger');
            }
        } else {
            log_message_A("<b>File Errro </b><br /><b>$msg </b> Could not be found for deletion.",'info');
        }
    }else {
        if(db_delete($sql)){
            log_message_A("<b>Thank You</b><br /><b>$msg </b> have been deleted.",'success');
        }else{
            log_message_A("<b>Delete Error</b><br /><b>$msg </b> could not be deleted, Try again.",'danger');
        }
    }
    //redirect_page($url); 
    $goto_url = $url; 
} elseif(isset($_POST['apply_entry_web'])){
    //(var_dump($_POST, $active_user));
    $url = $return_url;
    $msg = array();
    $err_count = 0;
    $id=trim($_POST["id"]);
    unset($_POST['id'], $_POST['apply_entry_web']);
    /*//$applicant_info_id = $active_user->id;
    $agent_no= trim($_POST["agent_no"]);
    $applicant_name= trim($_POST["applicant_name"]);
    $personal_contact=trim($_POST["personal_contact"]);   

    $applied_job=explode("+",trim($_POST["applied_job"]));
    $job_ref = $position[0];
    $applied_job = $position[1];

    $application_date=trim($_POST["application_date"]);
    $application_time=trim($_POST["application_time"]);
    $id_no=trim($_POST["id_no"]);
    $dob=trim($_POST["dob"]);
    $gender=trim($_POST["gender"]);
    $marital_status=trim($_POST["marital_status"]);
    $email_address=trim($_POST["email_address"]);
    $physical_address=trim($_POST["physical_address"]);
    $skin_color=trim($_POST["skin_color"]);
    $eye_color=trim($_POST["eye_color"]);
    $height=trim($_POST["height"]);
    $weight=trim($_POST["weight"]);
    $medical_status=trim($_POST["medical_status"]);
    $fathers_name=trim($_POST["fathers_name"]);
    $fathers_contact=trim($_POST["fathers_contact"]);
    $fathers_address=trim($_POST["fathers_address"]);
    $mothers_name=trim($_POST["mothers_name"]);
    $mother_contact=trim($_POST["mothers_contact"]);
    $mothers_address=trim($_POST["mothers_address"]);
    $next_of_kin=trim($_POST["next_of_kin"]);
    $kin_address=trim($_POST["kin_address"]);
    $kin_contact=trim($_POST["kin_contact"]);
    $info_source=trim($_POST["info_source"]);
    */
    
    if(!isset($_POST["agent_no"]) || $_POST["agent_no"]==""){
        $err_count++;
        $msg[] = " AGENT field is required ";
    }
    if(!isset($_POST["applicant_name"]) || $_POST["applicant_name"]==""){
        $err_count++;
        $msg[] = " APPLICANT NAMES field is required ";
    }
    if(!isset($_POST["personal_contact"]) || $_POST["personal_contact"]==""){
        $err_count++;
        $msg[] = " PERSONAL CONTACT field is required ";
    }
      
    if(!isset($_POST["applied_job"]) || $_POST["applied_job"]==""){
        $err_count++;
        $msg[] = "JOB APPLIED field is required ";
    }
    if(!isset($_POST["application_date"]) || $_POST["application_date"]==""){
        $err_count++;
        $msg[] = " APPLICATION DATE field is required ";
    }
    if(!isset($_POST["application_time"]) || $_POST["application_time"]==""){
        $err_count++;
        $msg[] = " APPLICATION TIME field is required ";
    }
    if(!isset($_POST["dob"]) || $_POST["dob"]==""){
        $err_count++;
        $msg[] = " D.O.B field is required ";
    }
    if(!isset($_POST["gender"]) || $_POST["gender"]==""){
        $err_count++;
        $msg[] = " GENDER field is required ";
    }
    if(!isset($_POST["marital_status"]) || $_POST["marital_status"]==""){
        $err_count++;
        $msg[] = " MARITAL STATUS field is required ";
    }
    if(!isset($_POST["email_address"]) || $_POST["email_address"]==""){
        $err_count++;
        $msg[] = " EMAIL ADDRESS field is required ";
    }
    if(!isset($_POST["physical_address"]) || $_POST["physical_address"]==""){
        $err_count++;
        $msg[] = "PHYSICAL ADDRESS field is required ";
    }
    if(!isset($_POST["skin_color"]) || $_POST["skin_color"]==""){
        $err_count++;
        $msg[] = "SKIN COLOR field is required ";
    }
    if(!isset($_POST["eye_color"]) || $_POST["eye_color"]==""){
        $err_count++;
        $msg[] = "EYE COLOR field is required ";
    }
    if(!isset($_POST["height"]) || $_POST["height"]==""){
        $err_count++;
        $msg[] = "HEIGHT field is required ";
    }
    if(!isset($_POST["weight"]) || $_POST["weight"]==""){
        $err_count++;
        $msg[] = "WEIGHT field is required ";
    }
    if(!isset($_POST["medical_status"]) || $_POST["medical_status"]==""){
        $err_count++;
        $msg[] = " MEDICAL STATUS field is required ";
    }
    if(!isset($_POST["fathers_name"]) || $_POST["fathers_name"]==""){
        $err_count++;
        $msg[] = " FATHER'S NAME field is required ";
    }
    if(!isset($_POST["fathers_contact"]) || $_POST["fathers_contact"]==""){
        $err_count++;
        $msg[] = " FATHER'S CONTACT field is required ";
    }
    if(!isset($_POST["fathers_address"]) || $_POST["fathers_address"]==""){
        $err_count++;
        $msg[] = " FATHER'S ADDRESS field is required ";
    }
    if(!isset($_POST["mothers_name"]) || $_POST["mothers_name"]==""){
        $err_count++;
        $msg[] = " MOTHERS NAME field is required ";
    }
    if(!isset($_POST["mothers_contact"]) || $_POST["mothers_contact"]==""){
        $err_count++;
        $msg[] = " MOTHER'S CONTACT field is required ";
    }
    if(!isset($_POST["mothers_address"]) || $_POST["mothers_address"]==""){
        $err_count++;
        $msg[] = " MOTHER'S ADDRESS field is required ";
    }
    if(!isset($_POST["next_of_kin"]) || $_POST["next_of_kin"]==""){
        $err_count++;
        $msg[] = " NEXT OF KIN field is required ";
    }
    if(!isset($_POST["kin_contact"]) || $_POST["kin_contact"]==""){
        $err_count++;
        $msg[] = " NEXT OF KIN CONTACT field is required ";
    }
    if(!isset($_POST["kin_address"]) || $_POST["kin_address"]==""){
        $err_count++;
        $msg[] = " NEXT OF KIN ADDRESS field is required ";
    }
   //exit(var_dump($_POST));

    if($err_count>0){
        exit(var_dump($msg));
        log_message_A(implode(', ', $msg), 'danger');
        //redirect_page($return_url);
    } else {
       // exit(var_dump("OK"));
        $sql = "";
        $_POST['personal_contact'] = str_replace(' ','',$_POST['personal_contact']);
        $_POST['file_number'] = generateFileNumber();
        $applicant_name = $_POST['applicant_name'];
        $file_number = $_POST['file_number'];
        $tbl_fields = array_keys($_POST);
        $tbl_vals = array_values($_POST);
        $cols = implode(',',$tbl_fields);
        $vals = implode("', '",$tbl_vals);
        $sql = "INSERT INTO web_bio_data ($cols) 
                    VALUES ('$vals') ";
        //exit(print_r($sql));
        if(db_save($sql)){
            log_message_A("Thank you $applicant_name, your application has been submitted successfully and your application reference number for follow up is <b>$file_number</b>. Please to proceed to the POLAR AGENCY Offices with the requierd job documents for verifications as soon as possible",'success');
            $goto_url = explode('?',$return_url)[0];
        }else{
            log_message_A("Application not submited, try again",'danger');
            $goto_url = $return_url;
        }
    }
    //; 

} else {
    //exit(var_dump($_POST));
    log_message_A("PAGE SUBMIT ERROR, try again",'danger');
    //redirect_page($return_url); 
    $goto_url = $return_url;  
}
redirect_page($goto_url);
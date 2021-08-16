<?php
$ds = '/';//DIRECTORY_SEPARATOR;
require_once('functions.php');
use Dompdf\Dompdf;
$return_url = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER']:"./";
$remark = santize('remote_address: '.$_SERVER['REMOTE_ADDR'].', user_agent: '.$_SERVER['HTTP_USER_AGENT'].', page_referer: '.$return_url);
$log_event = "Formsubmitted: ";
$active_user = get_active_user();
$user1 = isset($active_user->username)? $active_user->username:"SYS";
$created_by = $active_user? "$active_user->username":'WEBSYS_DBA';
$usernames = $active_user? "$active_user->full_names":'Anonymous';
$updated_by = $active_user? "$active_user->username":'WEBSYS_DBA';
$created_on = $now;
$updated_on = $now;
$goto_url = $return_url;
if(isset($_POST['staff-login'])){
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
        $log_event='LOGIN: '.log_message('<b>Required Form Fields</b><br />'.implode(', ',  $msg),'danger');
        //redirect_page($return_url);
    } else {
        $sql0 = strpos($login_name,'@')? 'email="'.$login_name.'" ':' username="'.$login_name.'" ';
        $sql = 'SELECT * FROM users WHERE '.$sql0.' AND password="'.$password.'" ';
        if($user = db_get_row($sql)){
            $active_user = $user;//get_active_user();
            //$gui = $active_user->user_rights? db_get_field_val("SELECT previlege_name AS gui FROM user_previleges WHERE previlege_code='$active_user->user_rights'",'gui'):'SYS';
           // if($user->activated==1){
            //    if($user->is_online==0 || $user->user_rights=='su'){
                    //$user->db_tab = 'users';
                    db_save('UPDATE users SET last_visit="'.date("Y-m-d H:i:s").'" WHERE id='.$user->id);
                    set_user_session($user);
                    $msg = welcome($user->full_names);
                    $log_event='LOGIN: '.log_message($msg,'success');
                    $url = "./index.php";
               // } else {
               //     $link = '<a class="btn btn-fill btn-xs btn-info" href="formSubmit.php?reset='.$user->id.'&tab=users" ><i class="fa fa-magic"> </i>&nbsp;RESET</a>';
               //     $log_event='LOGIN: '.log_message("<b>Ooops $user->full_names, Login Failed</b></br>Your AZAR App Account is already logged in and had another active session ongoing, First logout the other active session and try again. If you do not have any active session runing, use the RESET button herein to request the asminstrator to reset your session. $link ",'warning');
               //     $url = "./login.php?rst";
              //  }
           // } else{
          //      $log_event='LOGIN: '.log_message("<b>Ooops $user->full_names, Login Failed</b></br>Your AZAR App Account is not yet activated, contact system administrator for assistance.",'info');
          //      $url = "./login.php?rst";
         //   }
        }else{
            $log_event='LOGIN: '.log_message("<b>Login Failed</b><br />The Your email /username and login password combination is not correct, check them and tray again",'danger');
            $url = "./login.php";
        }
    }
    //redirect_page($url);
    $goto_url = $url;
} elseif(isset($_POST['applicant-login'])){
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
        $log_event='agent login: validation: '.log_message('<b>Required Form Fields</b><br />'.implode(', ',  $msg),'danger');
        //redirect_page($return_url);
    } else {
        $sql0 = strpos($login_name,'@')? 'email="'.$login_name.'" ':' username="'.$login_name.'" ';
        $sql = 'SELECT id, username, agent_names, activated, is_online FROM agents WHERE '.$sql0.' AND password="'.$password.'" ';
        //exit(var_dump($sql));
        if($agent = db_get_row($sql)){
            if($agent->activated==1){
                if($agent->is_online==0){
                    db_save('UPDATE agents SET last_visit="'.date("Y-m-d H:i:s").'", is_online=1 WHERE id='.$agent->id);
                    set_user_session($agent);
                    $msg = welcome($agent->agent_names);
                    //exit(var_dump($msg));
                    $log_event='agent login: '.log_message($msg,'success');
                    $url = "./azar_agents.php";
                } else {
                    $link = '<a class="btn btn-fill btn-xs btn-info" href="formSubmit.php?reset='.$agent->id.'&tab=agents" ><i class="fa fa-magic"> </i>&nbsp;RESET</a>';
                    $log_event='Agent Login: '.log_message("<b>Ooops $agent->agent_names, Login Failed</b></br>Your AZAR App Account is already logged in and had another active session ongoing, First logout the other active session and try again. If you do not have any active session runing, use the RESET button herein to request the asminstrator to reset your session. $link ",'warning');
                    $url = "./login.php?rst";
                }
            } else{
                $log_event='Agent Login: '.log_message("<b>Ooops $agent->agent_names, Login Failed</b></br>Your AZAR App Account is not yet activated, contact system administrator for assistance.",'info');
                $url = "./login.php?rst";
            }
        }else{
            $log_event='Agent Login: '.log_message("<b>Login Failed</b><br />The Your email /username and login password combination is not correct, check them and tray again",'danger');
            $url = "./login.php?rst";
        }
    }
    //redirect_page($url);
    $goto_url = $url;
} elseif(isset($_POST['user_entry'])){
    //exit(var_dump($_POST));
    $url = explode("?",$return_url)[0];
    $msg = array();
    $err_count = 0;
    $id=trim($_POST["id"]);
    $full_names=trim($_POST["full_names"]);
    $username=trim($_POST["username"]);
    $email=trim($_POST["email"]);
    $password=sha1(trim($_POST["password"]));
    
    $username1 = db_get_field_val("SELECT username FROM users WHERE username='$username' ", "username");
    $email1 = db_get_field_val("SELECT email FROM users WHERE email='$username' ", "email");
    if($id<0){
        if(isset($_POST["username"]) && $_POST["username"]==$username1){
            $err_count++;
            $msg[] = " Username Already Exist, try another ";
        }
        if(isset($_POST["email"]) && $_POST["email"]==$username1){
            $err_count++;
            $msg[] = " Email Already Exist, try another ";
        }
    }
    if(!isset($_POST["full_names"]) || $_POST["full_names"]==""){
        $err_count++;
        $msg[] = " FULL_NAMES field is required ";
    }
    if(!isset($_POST["username"]) || $_POST["username"]==""){
        $err_count++;
        $msg[] = " USERNAME field is required ";
    }
    if(!isset($_POST["email"]) || $_POST["email"]==""){
        $err_count++;
        $msg[] = " EMAIL field is required ";
    }
    
    if($err_count>0){
        $log_event='User submit validation error: '.log_message(implode(', ', $msg), 'danger');
        //redirect_page($return_url);
    } else {
       // exit(var_dump("OK"));
        $sql = "";
        $sql1 = "";
        if ($id > 0 ){
            $sql = "UPDATE users SET 
                        full_names='$full_names',
                        username='$username',
                        email='$email'                        
                    WHERE id='$id' ";
        } else {
            $sql = "INSERT INTO users 
                (full_names, username, email, password) 
            VALUES
                ('$full_names', '$username', '$email', '$password' )";
        }
        //exit(var_dump($sql,$sql1));
        if(db_save($sql)){
            $log_event='DBA users : '.log_message("User Info for <b>$full_names</b> Saved",'success');
        }else{
           $log_event='DBA users error ';
        }
    }
    //redirect_page($return_url); 
    $goto_url = $return_url;
} elseif(isset($_POST['page_entry'])){
    //exit(var_dump($_POST));
    $url = explode("?",$return_url)[0];
    $msg = array();
    $err_count = 0;
    $id=trim($_POST["id"]);
    $name=trim($_POST["name"]);
    $title=trim($_POST["title"]);
    $content=trim($_POST["content"]);
    $offline_text=trim($_POST["offline_text"]);
    $parent_page=trim($_POST["parent_page"]);
    $published=trim($_POST["published"]);
    if(!isset($_POST["name"]) || $_POST["name"]==""){
        $err_count++;
        $msg[] = " NAME field is required ";
    }
    if(!isset($_POST["title"]) || $_POST["title"]==""){
        $err_count++;
        $msg[] = " TITLE field is required ";
    }
    if(!isset($_POST["content"]) || $_POST["content"]==""){
        $err_count++;
        $msg[] = " CONTENT field is required ";
    }
    if(!isset($_POST["offline_text"]) || $_POST["offline_text"]==""){
        $err_count++;
        $msg[] = " OFFLINE TEXT field is required ";
    }
    if(!isset($_POST["parent_page"]) || $_POST["parent_page"]==""){
        $err_count++;
        $msg[] = " PARENT PAGE field is required ";
    }
    if(!isset($_POST["published"]) || $_POST["published"]==""){
        $err_count++;
        $msg[] = " PUBLISHED field is required ";
    }
    
    if($err_count>0){
        $log_event='Page submit validation error: '.log_message(implode(', ', $msg), 'danger');
        $goto_url = $return_url;
        //redirect_page($return_url);
    } else {
       // exit(var_dump("OK"));
        $sql = "";
        if ($id > 0 ){
            $sql = "UPDATE web_pages SET 
                        name='$name',
                        title='$title',
                        content='$content',
                        offline_text='$offline_text',
                        published='$published',
                        parent_page='$parent_page',
                        last_updated_by='$updated_by',
                        last_updated_on='$updated_on'
                    WHERE id='$id' ";
        } else {
            $sql = "INSERT INTO web_pages 
                (name, parent_page, title, content, offline_text, published, created_by, created_on) 
            VALUES
            ('$name', '$parent_page', '$title', '$content', '$offline_text', '$published', '$created_by', '$created_on')";
        }
        //exit(var_dump($sql));
        if(db_save($sql)){
            $log_event='DBA Pages : '.log_message("Page Info for <b>$title</b> Saved",'success');
            $goto_url = $url;
        }else{
           $log_event='DBA Pages error ';
           $goto_url = $return_url;
        }
    }
    //exit;
    //redirect_page($return_url); 
    //$goto_url = $return_url;
} elseif(isset($_POST['photo_entry'])){
    //exit(var_dump($_POST,$_FILES));
    $url = explode("?",$return_url)[0];
    $msg = array();
    $err_count = 0;
    $id=trim($_POST["id"]);
    $caption=trim($_POST["caption"]);
    $description=trim($_POST["description"]);
    $published=trim($_POST["published"]);
    $file = ($_FILES['file']);
    $old_pix = (trim($_POST['old_pix']));
    
    $change_pix = isset($_POST['change_pix'])? (trim($_POST['change_pix'])):FALSE;
    
    if($id==-1 || $change_pix==1){  
        if(!isset($_FILES['file']) || $_FILES['file']["error"]!=0){
            $err_count++;
            $msg[] = " Photo file is required ";
        }
    }
    if(!isset($_POST["caption"]) || $_POST["caption"]==""){
        $err_count++;
        $msg[] = " CAPTION field is required ";
    }
    if(!isset($_POST["description"]) || $_POST["description"]==""){
        $err_count++;
        $msg[] = " DESCRIPTION field is required ";
    }
    if(!isset($_POST["published"]) || $_POST["published"]==""){
        $err_count++;
        $msg[] = " PUBLISHED field is required ";
    }
    
    if($err_count>0){
        log_message(implode(', ', $msg), 'danger');
        $goto_url = $return_url;
        //redirect_page($return_url);
    } else {
        // exit(var_dump("OK"));
        $path = 'media/photos/';
        if(!is_dir($path)) mkdir($path,0777,true);
        $photo = time().'.'.pathinfo($file['name'],PATHINFO_EXTENSION);
        $sql = "";
        if ($id > 0 ){
            $pix = $change_pix==1? 'file="'.$photo.'", ':'';
            $sql = ' UPDATE photos SET 
                                caption="'.$caption.'", 
                                description="'.$description.'", 
                                '.$pix.'                                 
                                published="'.$published.'"
                            WHERE id='.$id.'  ';
            if($change_pix==1) {                
                if(!move_uploaded_file($file['tmp_name'],$path.$photo)){
                    log_message("<b>Photo File Save Error</b><br />The uploaded photo $caption could not be saved into media directory, try again.",'danger');
                    $goto_url = $return_url;
                } else {
                    if(db_save($sql)){
                        unlink('media/photos/'.$old_pix);
                        log_message("The uploaded photo has been Saved",'success');
                        $goto_url = $url;
                    }else{
                        unlink('media/photos/'.$photo);
                        log_message("The uploaded photo could not be Saved DBA error",'danger');
                        $goto_url = $return_url;
                    }
                }
            }else {
                if(db_save($sql)){
                    log_message("The photo details has been Saved",'success');
                    $goto_url = $url;
                }else{
                    log_message("The photo detials could not be Saved DBA error",'danger');
                    $goto_url = $return_url;
                }
            }
        } else {
            $sql = 'INSERT INTO photos (caption, description, file, published, date_created, created_by) 
                       VALUES ("'.$caption.'",  "'.$description.'",  "'.$photo.'",  "'.$published.'",  "'.$now.'",  "'.$created_by.'" )';
            if(!move_uploaded_file($file['tmp_name'],$path.$photo)){
                log_message("<b>Photo File Save Error</b><br />The uploaded photo for <b> $caption </b> could not be saved into directory, try again.",'danger');
                $goto_url = $return_url;
            } else {
                if(db_save($sql)){
                    log_message("The uploaded photo has been Saved",'success');
                    $goto_url = $url;
                }else{
                    log_message("The uploaded photo could not be Saved DBA error",'danger');
                    $goto_url = $return_url;
                }
            }            
        }
    }
} elseif(isset($_POST['slideshow_entry'])){
    //exit(var_dump($_POST,$_FILES));
    $url = explode("?",$return_url)[0];
    $msg = array();
    $err_count = 0;
    $id=trim($_POST["id"]);
    $caption=trim($_POST["caption"]);
    $description=trim($_POST["description"]);
    $published=trim($_POST["published"]);
    $file = ($_FILES['file']);
    $old_pix = (trim($_POST['old_pix']));
    
    $change_pix = isset($_POST['change_pix'])? (trim($_POST['change_pix'])):FALSE;
    
    if($id==-1 || $change_pix==1){  
        if(!isset($_FILES['file']) || $_FILES['file']["error"]!=0){
            $err_count++;
            $msg[] = " Slide Picture file is required ";
        }
    }
    if(!isset($_POST["caption"]) || $_POST["caption"]==""){
        $err_count++;
        $msg[] = " CAPTION field is required ";
    }
    if(!isset($_POST["description"]) || $_POST["description"]==""){
        $err_count++;
        $msg[] = " DESCRIPTION field is required ";
    }
    if(!isset($_POST["published"]) || $_POST["published"]==""){
        $err_count++;
        $msg[] = " PUBLISHED field is required ";
    }
    
    if($err_count>0){
        log_message(implode(', ', $msg), 'danger');
        $goto_url = $return_url;
        //redirect_page($return_url);
    } else {
        // exit(var_dump("OK"));
        $path = 'media/slideshow/';
        if(!is_dir($path)) mkdir($path,0777,true);
        $photo = time().'.'.pathinfo($file['name'],PATHINFO_EXTENSION);
        $sql = "";
        if ($id > 0 ){
            $pix = $change_pix==1? 'file="'.$photo.'", ':'';
            $sql = ' UPDATE slideshow SET 
                                caption="'.$caption.'", 
                                description="'.$description.'", 
                                '.$pix.'                                 
                                published="'.$published.'"
                            WHERE id='.$id.'  ';
            if($change_pix==1) {                
                if(!move_uploaded_file($file['tmp_name'],$path.$photo)){
                    log_message("<b>Photo File Save Error</b><br />The uploaded Slideshow picure $caption could not be saved into media directory, try again.",'danger');
                    $goto_url = $return_url;
                } else {
                    if(db_save($sql)){
                        unlink('media/photos/'.$old_pix);
                        log_message("The uploaded slideshow picture has been Saved",'success');
                        $goto_url = $url;
                    }else{
                        unlink('media/photos/'.$photo);
                        log_message("The uploaded slideshow picture could not be Saved DBA error",'danger');
                        $goto_url = $return_url;
                    }
                }
            }else {
                if(db_save($sql)){
                    log_message("The Slideshow details has been Saved",'success');
                    $goto_url = $url;
                }else{
                    log_message("The Slideshow detials could not be Saved DBA error",'danger');
                    $goto_url = $return_url;
                }
            }
        } else {
            $sql = 'INSERT INTO slideshow (caption, description, file, published, date_created, created_by) 
                       VALUES ("'.$caption.'",  "'.$description.'",  "'.$photo.'",  "'.$published.'",  "'.$now.'",  "'.$created_by.'" )';
            if(!move_uploaded_file($file['tmp_name'],$path.$photo)){
                log_message("<b>Slidesho picture File Save Error</b><br />The uploaded photo for <b> $caption </b> could not be saved into directory, try again.",'danger');
                $goto_url = $return_url;
            } else {
                if(db_save($sql)){
                    log_message("The uploaded slideshow picture has been Saved",'success');
                    $goto_url = $url;
                }else{
                    log_message("The uploaded slideshow picture could not be Saved DBA error",'danger');
                    $goto_url = $return_url;
                }
            }            
        }
    }
} elseif(isset($_POST['video_entry'])){
   //exit(var_dump($_POST));
    $url = explode("?",$return_url)[0];
    $msg = array();
    $err_count = 0;
    $id=trim($_POST["id"]);
    $caption=trim($_POST["caption"]);
    $description=trim($_POST["description"]);
    $published=trim($_POST["published"]);
    $youtube_link=trim($_POST["youtube_link"]);
    
    if(!isset($_POST["caption"]) || $_POST["caption"]==""){
        $err_count++;
        $msg[] = " CAPTION field is required ";
    }
    if(!isset($_POST["youtube_link"]) || $_POST["youtube_link"]==""){
        $err_count++;
        $msg[] = " Youtube Link is required ";
    }
    if(!isset($_POST["description"]) || $_POST["description"]==""){
        $err_count++;
        $msg[] = " DESCRIPTION field is required ";
    }
    if(!isset($_POST["published"]) || $_POST["published"]==""){
        $err_count++;
        $msg[] = " PUBLISHED field is required ";
    }
    
    if($err_count>0){
        log_message(implode(', ', $msg), 'danger');
        $goto_url = $return_url;
        //redirect_page($return_url);
    } else {
        $sql = "";
        if ($id > 0 ){
            $sql = ' UPDATE videos SET 
                                caption="'.$caption.'", 
                                description="'.$description.'", '. 
                                " youtube_link='".$youtube_link."', ".                                  
                                'published="'.$published.'"
                            WHERE id='.$id.'  ';                    
        } else {
            $sql = 'INSERT INTO videos (caption, description, youtube_link, published, date_created, created_by) 
                       VALUES ("'.$caption.'",  "'.$description.'",  '." '".$youtube_link."', ".'  "'.$published.'",  "'.$now.'",  "'.$created_by.'" )';           
        }
        //exit(var_dump($sql));
        if(db_save($sql)){
            log_message("The Youtube video link has been Saved",'success');
            $goto_url = $url;
        }else{
            log_message("The Youtube video link could not be Saved DBA error",'danger');
            $goto_url = $return_url;
        }
    }
} elseif(isset($_POST['news_entry'])){
    //exit(var_dump($_POST, $active_user));
     $url = explode("?",$return_url)[0];
     $msg = array();
     $err_count = 0;
     $id=trim($_POST["id"]);
     $topic=trim($_POST["topic"]);
     $author=$usernames;
     $news_date=$now;
     $published=trim($_POST["published"]);
     $article=trim($_POST["article"]);
     
     if(!isset($_POST["topic"]) || $_POST["topic"]==""){
         $err_count++;
         $msg[] = " TOPIC field is required ";
     }
     if(!isset($_POST["article"]) || $_POST["article"]==""){
         $err_count++;
         $msg[] = " Youtube Link is required ";
     }
     if(!isset($_POST["published"]) || $_POST["published"]==""){
         $err_count++;
         $msg[] = " PUBLISHED field is required ";
     }
     
     if($err_count>0){
         log_message(implode(', ', $msg), 'danger');
         $goto_url = $return_url;
         //redirect_page($return_url);
     } else {
         $sql = "";
         if ($id > 0 ){
             $sql = ' UPDATE news_feed SET 
                                 topic="'.$topic.'", 
                                 author="'.$author.'", '. 
                                 " article='".$article."', ".                                  
                                 'published="'.$published.'"
                             WHERE id='.$id.'  ';                    
         } else {
             $sql = 'INSERT INTO news_feed (topic, author, article, published, news_date) 
                        VALUES ("'.$topic.'",  "'.$author.'",  '." '".$article."', ".'  "'.$published.'",  "'.$news_date.'")';
         }
         //exit(var_dump($sql));
         if(db_save($sql)){
             log_message("The News article has been Saved",'success');
             $goto_url = $url;
         }else{
             log_message("The News article could not be Saved DBA error",'danger');
             $goto_url = $return_url;
         }
    }
} elseif(isset($_POST['jobs_entry'])){
    //exit(var_dump($_POST, $active_user));
    $url = explode("?",$return_url)[0];
    $msg = array();
    $err_count = 0;
    $id=trim($_POST["id"]);
    $job_title=trim($_POST["job_title"]);
    $created_by=$usernames;
    $date_posted=trim($_POST["date_posted"]);
    $published=trim($_POST["published"]);
    $organisation=trim($_POST["organisation"]);
    $country=trim($_POST["country"]);
    $duty_station=trim($_POST["duty_station"]);
    $reports_to=trim($_POST["reports_to"]);
    $about_us=trim($_POST["about_us"]);
    $job_summary=trim($_POST["job_summary"]);
    $kdr=trim($_POST["kdr"]);
    $qse=trim($_POST["qse"]);
    $compensations=trim($_POST["compensations"]);
    $howto_apply=trim($_POST["howto_apply"]);
    $deadline=trim($_POST["deadline"]);
    $job_ref=trim($_POST["job_ref"]);
    
    if(!isset($_POST["job_ref"]) || $_POST["job_ref"]==""){
        $err_count++;
        $msg[] = " JOB TITLE field is required ";
    }
    if(!isset($_POST["job_title"]) || $_POST["job_title"]==""){
        $err_count++;
        $msg[] = " JOB REF field is required ";
    }
    if(!isset($_POST["organisation"]) || $_POST["organisation"]==""){
        $err_count++;
        $msg[] = " ORGANISATION field is required ";
    }
    if(!isset($_POST["country"]) || $_POST["country"]==""){
        $err_count++;
        $msg[] = " COUNTRY field is required ";
    }
    if(!isset($_POST["duty_station"]) || $_POST["duty_station"]==""){
        $err_count++;
        $msg[] = " DUTY STATION field is required ";
    }
    if(!isset($_POST["reports_to"]) || $_POST["reports_to"]==""){
        $err_count++;
        $msg[] = " REPORTS TO field is required ";
    }
    if(!isset($_POST["about_us"]) || $_POST["about_us"]==""){
        $err_count++;
        $msg[] = " ABOUT US field is required ";
    }
    if(!isset($_POST["kdr"]) || $_POST["kdr"]==""){
        $err_count++;
        $msg[] = " KEY DUTIES & RESPONSIBILITIES field is required ";
    }
    if(!isset($_POST["qse"]) || $_POST["qse"]==""){
        $err_count++;
        $msg[] = " QUALIFICATION, SKILLS & EXPERIENCE field is required ";
    }
    if(!isset($_POST["compensations"]) || $_POST["compensations"]==""){
        $err_count++;
        $msg[] = " COMPENSATIONS field is required ";
    }
    if(!isset($_POST["howto_apply"]) || $_POST["howto_apply"]==""){
        $err_count++;
        $msg[] = " HOW TO APPLY field is required ";
    }
    if(!isset($_POST["deadline"]) || $_POST["deadline"]==""){
        $err_count++;
        $msg[] = " DEADLINE field is required ";
    }
    if(!isset($_POST["published"]) || $_POST["published"]==""){
        $err_count++;
        $msg[] = " PUBLISHED field is required ";
    }
    
    if($err_count>0){
        log_message(implode(', ', $msg), 'danger');
        $goto_url = $return_url;
        //redirect_page($return_url);
    } else {
        $sql = "";
        if ($id > 0 ){
            $sql = ' UPDATE jobs SET 
                                date_posted="'.$date_posted.'", 
                                job_title="'.$job_title.'", 
                                job_ref="'.$job_ref.'", 
                                organisation="'.$organisation.'", 
                                country="'.$country.'", 
                                duty_station="'.$duty_station.'",
                                reports_to="'.$reports_to.'", '. 
                                " about_us='".$about_us."', ".  
                                " job_summary='".$job_summary."', ". 
                                " kdr='".$kdr."', ". 
                                " qse='".$qse."', ". 
                                " compensations='".$compensations."', ". 
                                " howto_apply='".$howto_apply."', ". 
                                ' deadline="'.$deadline.'", '.                                 
                                ' published="'.$published.'"
                            WHERE id='.$id.'  ';                    
        } else {
            $sql = 'INSERT INTO jobs (date_posted, job_title, job_ref, organisation, country, duty_station, reports_to, about_us, job_summary, kdr, qse,compensations, howto_apply, deadline, published, created_by) 
                        VALUES ("'.$date_posted.'", "'.$job_title.'", "'.$job_ref.'", "'.$organisation.'", "'.$country.'", "'.$duty_station.'", "'.$reports_to.'", '." '".$about_us."', "." '".$job_summary."', "." '".$kdr."', "." '".$qse."', "." '".$compensations."', "." '".$howto_apply."', "." '".$deadline."', ".'  "'.$published.'",  "'.$created_by.'")';
        }
        //exit(var_dump($sql));
        if(db_save($sql)){
            log_message("The Job details has been Saved",'success');
            $goto_url = $url;
        }else{
            log_message("The Job details could not be Saved DBA error",'danger');
            $goto_url = $return_url;
        }
    } 
} elseif(isset($_POST['password-change'])){
    //exit(var_dump($_POST));
    $url = $return_url;
    $id = intval(santize(trim($_POST['id'])));
    $oldpass = (trim($_POST['oldpass']));
    $password = sha1(trim($_POST['password']));    
    $password2 = sha1(trim($_POST['password2']));
    $current_password = sha1(trim($_POST['current_password']));   
    $msg = array();
    $error_count = 0;//(trim($_POST['msg']));
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
        //exit(var_dump($msg));
        $log_event='Password change validation: '.log_message(implode(', ', $msg), 'danger');
    } else {
       // exit(var_dump("OK"));
        $sql = "UPDATE users SET password='$password' WHERE id={$id}";
        //exit(var_dump($sql));
        if(db_save($sql)){
            $log_event='Password change: '.log_message("<b>Thank You</b><br /><b>Your passwaord was successful changed.",'success');
        }else{
            $log_event='Password change: '.log_message("<b>Error</b><br /><b>Password change could not be completed, Try again.",'warning');
        }
    }
    //redirect_page($url);
    $goto_url = $url;  
} elseif(isset($_POST['password-btn']) && $_POST['id']>0 && $_POST['tbl']!="" && $_POST['tbl']!=""){
    //exit(var_dump($_POST));
    $url = $return_url;
    $id = intval(santize(trim($_POST['id'])));
    $table = (trim($_POST['tbl']));
    $msg = (trim($_POST['msg']));
    $password = sha1(trim($_POST['password']));
    $sql = "UPDATE {$table} SET password='$password' WHERE id={$id}";
    //exit(var_dump($sql));
    if(db_save($sql)){
        $log_event='Password change: '.log_message("<b>Thank You</b><br /><b>$msg </b> was successful.",'success');
    }else{
       $log_event='Password change: '.log_message("<b>Error</b><br /><b>$msg </b> could not be completed, Try again.",'warning');
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
                    log_message("<b>Thank You</b><br /><b>$msg </b> have been deleted.",'success');
                } else {
                    log_message("<b>DBA Error</b><br /><b>$msg </b> details not removed form DB, try again.",'warning');
                }
            } else {
                log_message("<b>Delete Error</b><br /><b>$msg </b> could not be deleted from directory.",'danger');
            }
        } else {
            log_message("<b>File Errro </b><br /><b>$msg </b> Could not be found for deletion.",'info');
        }
    }else {
        if(db_delete($sql)){
            log_message("<b>Thank You</b><br /><b>$msg </b> have been deleted.",'success');
        }else{
            log_message("<b>Delete Error</b><br /><b>$msg </b> could not be deleted, Try again.",'danger');
        }
    }
    //redirect_page($url); 
    $goto_url = $url; 
} elseif(isset($_POST['ajax-user-form'])){
    $id = intval($_POST['ajax-user-form']);
    $user = db_get_row("SELECT * FROM users WHERE id='$id' ");
    ?>
    <form method="post" action="formSubmit.php" >
                <div class="modal-body">        
                    
                        <input type="hidden" id="id" name="id" value="<?php echo isset($user->id)? $user->id:-1;?>" />
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="full_names" >Full Name</label>
                                    <input id="full_names" name="full_names" value="<?php echo isset($user->full_names)? $user->full_names:'';?>" type="text" class="form-control border-input" placeholder="Full Name" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" style="width:100%">Email <span class="pull-right" id="email_status"></span></label>
                                    <input onkeyup="checkemail();" id="email" name="email" type="email" value="<?php echo isset($user->email)? $user->email:'';?>" class="form-control border-input" placeholder="Email Address" required />
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username" style="width:100%">Username <span class="pull-right"id="name_status"></span></label>
                                    <input onkeyup="checkusername();" id="username" name="username" value="<?php echo isset($user->username)? $user->username:'';?>" type="text" class="form-control border-input" placeholder="Username" required />
                                    
                                </div>
                            </div>                        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="password" name="password" type="text" class="form-control border-input" placeholder="Password" value="" required <?php echo isset($user->password)? "disabled":'';?> />
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                
                </div>    
                <div class="modal-footer">
                    <div class="left-side">
                        <input type="submit" class="btn btn-info btn-sm " value="Save" name="user_entry" />
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
    <?php
    exit();
} elseif(isset($_POST['ajax-page-form'])){ exit();
    $id = intval($_POST['ajax-page-form']);
    $page = db_get_row("SELECT * FROM web_pages WHERE id='$id' ");
    ?>
    <form method="post" action="formSubmit.php" >
    <script src="ckeditor/ckeditor.js"></script>
    <script> CKEDITOR.replace( 'content'); CKEDITOR.replace( 'offline_text'); </script>
                <div class="modal-body">        
                    
                        <input type="hidden" id="id" name="id" value="<?php echo isset($page->id)? $page->id:-1;?>" />
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title" >Title</label>
                                    <input id="title" name="title" value="<?php echo isset($page->title)? $page->title:'';?>" type="text" class="form-control border-input" placeholder="Full Name" required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="content" >Content</label>
                                    <textarea id="content" rows="15" name="content" class="form-control border-input" placeholder="Page Content" required /><?php echo isset($page->content)? $page->content:'';?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="offline_text" >Offline Text</label>
                                    <textarea id="offline_text" rows="5" name="offline_text" class="form-control border-input" placeholder="Offline Text" required /><?php echo isset($page->offline_text)? $page->offline_text:'';?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">                       
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="published">Published</label>
                                    <select id="published" name="published" class="form-control border-input" placeholder="published" required >
                                        <option> Select Publish Mode</option>
                                        <option value="1" <?php echo isset($page->published)&&$page->published==1? 'selected':''; ?> > YES</option>
                                        <option value="0" <?php echo isset($page->published)&&$page->published==0? 'selected':''; ?> > NO</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                
                </div>    
                <div class="modal-footer">
                    <div class="left-side">
                        <input type="submit" class="btn btn-info btn-sm " value="Save" name="page_entry" />
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
    <?php
    exit();
} elseif(isset($_POST['ajax-page-view'])){
    $id = intval($_POST['ajax-page-view']);
    if($page = db_get_row("SELECT * FROM web_pages WHERE id='$id' ")){
        echo '<h5>Page Title: '.$page->title.'<hr></h5>';
        echo '<b>Page Content</b><br>'.$page->content;
        echo '<hr ><b>Page Offline Text</b><br>'.$page->offline_text;
        echo '<hr >Created By: '.$page->created_by.' Create Date: '.$page->created_on.', Last Upadated By: '.$page->last_updated_by.' Update Date: '.$page->last_updated_on;
    }
    exit();
} elseif(isset($_POST['ajax-photo-view'])){ //exit(dump($_POST));
    $id = intval($_POST['ajax-photo-view']);
    if($page = db_get_row("SELECT * FROM photos WHERE id='$id' ")){
        echo '<h5>Photo Caption: '.$page->caption.'<hr></h5>';
        echo '<b>Photo Description</b><br>'.$page->description;
        echo '<hr ><img class="img-responsive img-fluid img-thumbnail" src="media/photos/'.$page->file.'" />';
        echo '<hr >Created By: '.$page->created_by.' Create Date: '.$page->date_created;
    } else{
        echo '<div class="alert alert-info">No Records Available</div>';
    }
    exit();
} elseif(isset($_POST['ajax-picture-view'])){ //exit(dump($_POST));
    $id = intval($_POST['ajax-picture-view']);
    if($page = db_get_row("SELECT * FROM slideshow WHERE id='$id' ")){
        echo '<h5>Picture Caption: '.$page->caption.'<hr></h5>';
        echo '<b>Picture Description</b><br>'.$page->description;
        echo '<hr ><img class="img-responsive img-fluid img-thumbnail" src="media/slideshow/'.$page->file.'" />';
        echo '<hr >Created By: '.$page->created_by.' Create Date: '.$page->date_created;
    } else{
        echo '<div class="alert alert-info">No Records Available</div>';
    }
    exit();
} elseif(isset($_POST['ajax-video-view'])){ //exit(dump($_POST));
    $id = intval($_POST['ajax-video-view']);
    if($page = db_get_row("SELECT * FROM videos WHERE id='$id' ")){
        echo '<h5>Video Caption: '.$page->caption.'<hr></h5>';
        echo '<b>Video Description</b><br>'.$page->description;
        echo '<hr >';
        echo '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="'.str_replace('watch?v=','embed/',$page->youtube_link).'?controls=1"> </iframe></div>';
        echo '<hr >Created By: '.$page->created_by.' Create Date: '.$page->date_created;
    } else{
        echo '<div class="alert alert-info">No Records Available</div>';
    }
    exit();
} elseif(isset($_POST['ajax-news-view'])){
    $id = intval($_POST['ajax-news-view']);
    if($page = db_get_row("SELECT * FROM news_feed WHERE id='$id' ")){
        echo '<h5>Topic: '.$page->topic.'<hr></h5>';
        echo '<b>Article</b><br>'.$page->article;
        echo '<hr >Created By: '.$page->author.' Create Date: '.$page->news_date;
    }
    exit();
} elseif(isset($_POST['ajax-job-view'])){
    $id = intval($_POST['ajax-job-view']);
    if($page = db_get_row("SELECT * FROM jobs WHERE id='$id' ")){
        echo    '<table class="table table-responsive table-condensed">
                    <tr><td colspan="2"><b>Job Title: </b>'.$page->job_title.'</td></tr>
                    <tr><td colspan="2"><b>Reports to: </b>'.$page->reports_to.'</td></tr>
                    <tr><td ><b>Organisation: </b>'.$page->organisation.'</td><td><b>Duty Station: </b>'.$page->duty_station.', '.$page->country.'</td></tr>
                    <tr><td ><b>Date Posted: </b>'.$page->date_posted.'</td><td><b>Deadline: </b>'.$page->deadline.'</td></tr>
                    <tr><td colspan="2"><b>About Us: </b><br />'.$page->about_us.'</td></tr>
                    <tr><td colspan="2"><b>Job Summary: </b><br />'.$page->job_summary.'</td></tr>
                    <tr><td colspan="2"><b>Key Duties and Responsibilities: </b><br />'.$page->kdr.'</td></tr>
                    <tr><td colspan="2"><b>Qualifications, Skills and Experience: </b><br />'.$page->qse.'</td></tr>
                    <tr><td colspan="2"><b>Compensations: </b><br />'.$page->compensations.'</td></tr>
                    <tr><td colspan="2"><b>How to Apply: </b><br />'.$page->howto_apply.'</td></tr>
                    </table>';
        echo '<hr >Created By: '.$page->created_by;
    }
    exit();
} elseif(isset($_POST['ajax-page'])){
    $id = intval($_POST['ajax-page']);
    if($page = db_get_row("SELECT * FROM web_pages WHERE id='$id' ")){
        echo $page->content;
    } else {
        echo '<div class="alert alert-info">No data available</div>';
    }
    exit();
} elseif(isset($_POST['ajax-xload'])){
    $page = intval($_POST['page']);
    $tbl = strval($_POST['ajax-xload']);
    $offset = 12;
    $start = ($page - 1) * $offset;
    $sql = "SELECT * FROM $tbl WHERE published='1' ORDER BY date_created DESC LIMIT $start, $offset";
    if($xload = db_get_all($sql)){
        foreach($xload AS $row){ //var_dump($vidz);
            $thumbnail = $tbl=='videos'? explode('=',$row->youtube_link)[1]:null;
            $href = $tbl=='videos'? $row->youtube_link:'web-admin/media/photos/'.$row->file;
            $src = $tbl=='videos'? 'https://img.youtube.com/vi/'.$thumbnail.'/mqdefault.jpg':$href;
            $gallery = $tbl=='videos'? 'youtubevideos':'example-gallery';
            echo '<a href="'.$href.'" data-toggle="lightbox" data-gallery="'.$gallery.'" class="col-sm-4" data-title="'.$row->caption.'" data-footer="'.$row->description.'">
                        <img src="'.$src.'" align="left" class="img-fluid img-responsive img-thumbnail">
                        <br>&nbsp;'.$row->caption.'&nbsp;</a>';
        }
    }
    exit();
} elseif(isset($_POST['ajax-log-view'])){
    $id = intval($_POST['ajax-log-view']);
    if($log = db_get_row("SELECT * FROM access_logs WHERE id='$id' ")){
        echo '<table width="100%" class="table table-responsive table-condensed table-bordered">';
        echo '<tr><td>ID</td><td class="text-center1 " >'.$log->id.'</td></tr>';
        echo '<tr><td>Access Date</td><td class="text-center1 " >'.$log->log_date.'</td></tr>';
        echo '<tr><td>User</td><td class="text-center1 " >'.$log->user.'</td></tr>';
        echo '<tr><td>Page Accessed</td><td class="text-center1 " >'.$log->page_accessed.'</td></tr>';
        echo '<tr><td>Event</td><td class="text-center1 " >'.$log->events.'</td></tr>';
        echo '<tr><td colspan="2">More Information</td></tr>';
        echo '<tr><td  colspan="2" class="text-center1 " >';
        echo $log->remarks;
        echo '</td></tr>';
        echo '</table>';
    } else {
        echo '<div class="alert alert-info" >Not available</div>';
    }
    exit;
} elseif(isset($_GET['log'])){ 
    if($_GET['log']=='clear'){
        $sql = "TRUNCATE TABLE access_logs ";
        $del=$conn->exec($sql);
        if($del<0){  
            $log_event = 'Access Log Clear: '.log_message("Access logs could not be cleared, try again", 'info');
        }else {
            $log_event = 'Access Logs Cleared: '.log_message("All Log entries cleared", 'success');
        }      
    }
    //redirect_page($return_url);
    $goto_url = $return_url;
} else {
    //exit(var_dump($_POST));
    $log_event=log_message("PAGE SUBMIT ERROR, try again",'danger');
    //redirect_page($return_url); 
    $goto_url = $return_url;  
}
$l = array('user'=>"'$user1'",'page_accessed'=>"'azariFormSubmit.php'",'events'=>"'$log_event'",'remarks'=>"'$remark'");
trail($l);
//exit(var_dump($goto_url));
redirect_page($goto_url);
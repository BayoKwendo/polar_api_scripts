<?php
$online=FALSE;
date_default_timezone_set("Africa/Kampala");
$now = date('Y-m-d H:i:s');
/* Start user conection session */
if ((session_status() == PHP_SESSION_NONE) || (session_id() == '')) {
    session_start();
}
/* Database COnneciton */
try {
    $db_user = $online==TRUE? "polar_admin":'root';
    $db_pass = $online==TRUE? "admin@2018":'root';
    $db_name = $online==TRUE? 'polar_db':'polar_db';
    $connection_string = "mysql:host=localhost;dbname=$db_name"; 
    $conn = new PDO($connection_string, $db_user, $db_pass, 
                    array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ));
} catch (Exception $e) {
    $dbError = 'Caught exception: ' . $e->getMessage();
    exit($dbError);
}
/* DBA get all table row values */
function db_get_all($sql = NULL){
    global $conn;
    if(is_null($sql)) return FALSE;
    try{
        $r = $conn->query($sql);
        return $r ? $r->fetchAll(PDO::FETCH_OBJ) : FALSE;  
    } catch (Exception $e) {
        $dbError = 'Caught exception: ' . $e->getMessage();
        log_message($dbError, 'danger');
    }
}
/* DBA get table row value */
function db_get_row($sql){ // exit(var_dump(1,$sql));
    global $conn;
    if($sql==NULL) return FALSE;
    try{
        $r = $conn->query($sql);
        return $r ? $r->fetch(PDO::FETCH_OBJ) : FALSE;  
    } catch (Exception $e) {
        $dbError = 'Caught exception: ' . $e->getMessage();
        log_message($dbError, 'danger');
    }
}
/* DBA get table field value */
function db_get_field_val($sql=NULL, $field=NULL){
    global $conn;//(var_dump($sql));
    if($sql==NULL || $field==NULL) return FALSE;
    try{
        $r = $conn->query($sql);
        $r = $r->fetch(PDO::FETCH_OBJ);//var_dump($r);
        return isset($r->$field)? $r->$field : FALSE;  
    } catch (Exception $e) {
        $dbError = 'Caught exception: ' . $e->getMessage();
        log_message($dbError, 'danger');
    }
}
/* DBA save records into database*/
function db_save($sql=NULL) {
    global $conn;
    if($sql==NULL) return FALSE;
    try {
        return $conn->prepare($sql)->execute()? TRUE:FALSE; 
    } catch (Exception $e) {
        $dbError = 'Caught exception: ' . $e->getMessage();
        log_message($dbError, 'danger');
    }
}
/* DBA delete record */
function db_delete($sql=NULL) {
    global $conn;
    if($sql==NULL) return FALSE;
    try {
        return $conn->exec($sql)? TRUE:FALSE; 
    } catch (Exception $e) {
        $dbError = 'Caught exception: ' . $e->getMessage();
        log_message($dbError, 'danger');
    }
}
/* DBA get last inserted id */
function db_last_intert_id($table, $id) {
    $sql = "SELECT MAX(" . $id . ") as id FROM " . $table;
    return db_get_field_val($sql, 'id');
}
/* HELPER Url Redirection */
function redirect_page($url) {
    header("Location: {$url}");
    exit;
}
/* Welcome Message */
function welcome($name) { 
   if($name==NULL) return FALSE;
   $h = date("H");
   $greeting = "";
   if($h<12){
    $greeting = "Good Morning ";
   }elseif($h<18){
    $greeting = "Good Afternoon ";
   } else {
    $greeting = "Good Evening ";
   }
  return '<b><u>'.$greeting.' <b>'.strtoupper($name).'</b></u></b><br />Welcome to POLAR MANAGEMENT Services Ltd';
}
/* Check Login Status */
function logged_in() {
    //exit(var_dump($_SESSION));
    return isset($_SESSION['polar_db']->id);
}
function confirm_logged_in() {
    if (!logged_in()) {
        log_message("<b>LOGIN REQUIRED!!!</b></br>Please Login to have access to the system.",'danger');
        redirect_page("login.php");
    } 
}
/* HELPER feedback notification set  */
function log_message($msg = NULL, $alert = NULL) {
    if ($msg!=NULL && $alert!=NULL) {
        $icon = array(
                    'success'=>'<i class="fa fa-smile-o fa-2x"></i>',
                    'info'=>'<i class="pe-7s-info"></i>',
                    'warning'=>'<i class="fa fa-warning fa-2x"></i>',
                    'danger'=>'<i class="fa fa-times-circle fa-2x"></i>'
                );
        $icon_info = strtoupper($alert).":";
        $_SESSION['polar_db']->message = '<div class="alert alert-' . strtolower($alert) . ' text-left alert-dismissible1" role="alert">
                                    <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">×</button>
                                    <span><b>'.strtoupper(strtolower($alert)).' - </b> ' . $msg . '</span>
                                </div>';
        return $msg;
    }
}
/* HELPER feedback notification retrieve */
function view_message() {
    $val = isset($_SESSION['polar_db']->message) ? $_SESSION['polar_db']->message : NULL;
    unset($_SESSION['polar_db']->message);
    return is_null($val)? FALSE:$val;
}
/* USER SESSION */
function set_user_session($data = NULL) {
   // var_dump($data);
    if($data==NULL) return FALSE;
    $_SESSION['polar_db'] = $data;
    $_SESSION['polar_db']->db_tab = isset($data->applicant_names)? 'applicant':'users';
    //exit(var_dump($_SESSION));
    return TRUE;
}
/* GET LOGGED IN USER SESSION */
function get_active_user() {
   if(!isset($_SESSION['polar_db']->id)) return FALSE;
   $id = $_SESSION['polar_db']->id;
   $sql='';
   if(isset($_SESSION['polar_db']->applicant_names)){
       $sql = "SELECT id, CONCAT_WS(' ', first_name, last_name) AS full_names, username, FROM applicant_info WHERE id='$id' ";
   }else{
       $sql = "SELECT id,  full_names, username, password FROM users WHERE id='$id' ";
   }
   $user = db_get_row($sql);
   //   $user->db_tab = $_SESSION['polar_db']->db_tab;
   return $user;
}
//FOR APPLICANTS
/* Check Login Status */
function logged_in_A() {
    //exit(var_dump($_SESSION));
    return isset($_SESSION['polar_db_A']->id);
}
function confirm_logged_in_A() {
    if (!logged_in_A()) {
        log_message("<b>LOGIN REQUIRED!!!</b></br>Please Login to have access to the system.",'danger');
        redirect_page("login.php");
    } 
}
/* HELPER feedback notification set  */
function log_message_A($msg = NULL, $alert = NULL) {
    if ($msg!=NULL && $alert!=NULL) {
        $icon = array(
                    'success'=>'<i class="fa fa-smile-o fa-2x"></i>',
                    'info'=>'<i class="pe-7s-info"></i>',
                    'warning'=>'<i class="fa fa-warning fa-2x"></i>',
                    'danger'=>'<i class="fa fa-times-circle fa-2x"></i>'
                );
        $icon_info = strtoupper($alert).":";
        $_SESSION['polar_db_A']->message = '<div class="alert alert-' . strtolower($alert) . ' text-left alert-dismissible1" role="alert">
                                    <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">×</button>
                                    <span><b>'.strtoupper(strtolower($alert)).' - </b> ' . $msg . '</span>
                                </div>';
        return $msg;
    }
}
/* HELPER feedback notification retrieve */
function view_message_A() {
    $val = isset($_SESSION['polar_db_A']->message) ? $_SESSION['polar_db_A']->message : NULL;
    unset($_SESSION['polar_db_A']->message);
    return is_null($val)? FALSE:$val;
}
/* USER SESSION */
function set_user_session_A($data = NULL) {
   // var_dump($data);
    if($data==NULL) return FALSE;
    $_SESSION['polar_db_A'] = $data;
    //$_SESSION['polar_db_A']->db_tab = isset($data->applicant_names)? 'applicant':'users';
    //exit(var_dump($_SESSION));
    return TRUE;
}
/* GET LOGGED IN USER SESSION */
function get_active_user_A() { //
   if(!isset($_SESSION['polar_db_A']->id)) return FALSE;
   $id = $_SESSION['polar_db_A']->id;
   $sql = "SELECT id, CONCAT_WS(' ', first_name, last_name) AS full_names, first_name, last_name, contact, username FROM applicant_info WHERE id='$id' ";
  // exit(var_dump($sql));
   $user = db_get_row($sql);
   //   $user->db_tab = $_SESSION['polar_db']->db_tab;
   return $user;
}
/* HELPER  */
function requirement_check($str=FALSE){
    if($str==FALSE) return null;
    $str = ($str==0 || $str==1)? $str:'x';
    $check = array('0'=>'Not provided','1'=>'Provided','x'=>'Not Available');
    return $check[$str];
}
/* HELPER form inputs types */
function html5_forms($str=FALSE){
    $types = array(
        'int'=>'number',
        'bigint'=>'number',
        'tinyint'=>'number',
        'enum'=>'text',
        'varchar'=>'text',
        'text'=>'text',
        'date'=>'date',
        'datetime'=>'datetime',
        'time'=>'time'
    );
    return $str? $types[$str]:FALSE;
}
/* HELPER sanitize inputs */
function santize($str){
    return str_replace("'","`",$str);
}
/* SEARCH helper */
function searched($term, $result, $type="primary"){
    return str_replace("$term","<b class='text-$type'>$term</b>",$result);
}

function logged(){
    return $log = array(
        'access_date'=>'"'.date("Y-m-d H:i:s").'"',
        'user'=>'"'.$active_user->username.' ['.$active_user->full_names.']'.'"',
        'gui'=>'"'.$active_user->user_rights.' ['.$gui.']'.'"',
        'accessed'=>'"'.base64_encode(json_encode(array(
            'page'=>$page->uri,
            'remote_address'=>$_SERVER['REMOTE_ADDR'],
            'user_agent'=>$_SERVER['HTTP_USER_AGENT'],
            'request_uri'=>$_SERVER['REQUEST_URI'].'?'.$_SERVER['QUERY_STRING'],
            'http_referer'=>$_SERVER['HTTP_REFERER'],
            'url'=>$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']
        ))).'"',
        'actions'=>'"'.base64_encode(json_encode(array(
            'type'=>'Page Access',
            'cmd'=>'Page Accessed',
            'callback'=>'Page Rendered'
        ))).'"'
    );
}
/* AuditTrails Logs */
function trail($log=FALSE){ return true;
    if($log==FALSE) return FALSE;
    if(!is_array($log)) return FALSE;
    if(count($log)==0) return FALSE;
    $table = 'access_logs';
    $fields = implode(',',array_keys($log));
    $values = implode(',',array_values($log));
    $sql = "INSERT INTO $table ($fields) VALUES ($values) ";
    //exit(var_dump($sql));
    return (db_save($sql))? TRUE:FALSE;
}

# Generate Applicant File Number
 function generateFileNumber()
{
    #
    $seq = 'PAL/WEB/';
    $last = db_get_row("SELECT MAX(file_number) AS ref FROM web_bio_data LIMIT 1");
    if (isset($last->ref)) {
      //return $last;
        $pts = explode('/', $last->ref);
        $yr = $pts[2];
        $sn = $pts[3];
        if ($yr == date('Y')) {
            $current = $sn + 1;
            $new = $current;
            for ($i = 0; $i < (4 - strlen($current)); $i++) {
                $new = '0' . $new;
            }
            $seq .= $yr . '/' . $new;
        } else {
            $seq .= date('Y') . '/0001';
        }
    } else {
        $seq .= date('Y') . '/0001';
    }
    return $seq;
}
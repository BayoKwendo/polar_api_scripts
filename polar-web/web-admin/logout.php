<?php
	require_once('functions.php');
	$active_user = get_active_user();
	$id = isset($active_user)? "$active_user->id":'0';
	$db_table = isset($_SESSION['polar_db']->db_tab)? $_SESSION['polar_db']->db_tab:'';
	//$sql = "UPDATE $db_table SET is_online='0' WHERE id='$id' ";
	//exit(var_dump($_SESSION,$active_user,$sql));
	//if($online = db_save($sql)){
		//session_start();
		//$_SESSION = array();
		unset ($_SESSION['polar_db']);
		//if(isset($_COOKIE[session_name()])) {setcookie(session_name(), '', time()-42000, '/');}
		//session_destroy();
		redirect_page("login.php?logout");
	//} else {
	//	log_message("<b>Logout Error:</b></br>Your Session Logout Failed due toa DBA or SYS error. Try again or Seek assistance from the system administrator to resolve is issue if it persists.",'danger');
	//	redirect_page("logout.php");
	//}
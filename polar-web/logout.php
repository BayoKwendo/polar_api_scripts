<?php
	require_once('web-admin/functions.php');
		unset ($_SESSION['polar_db_A']);
		redirect_page("login.php?logout=Thank you for using POLAR Management Web Services");
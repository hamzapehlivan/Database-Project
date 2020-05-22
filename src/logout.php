<?php
	session_start();	
	// If user sign out, direct her/him to homepage
	if( isset($_SESSION['admin_logged_in']) ){
		$isAdminSession = true;
	}
	session_unset();
	session_destroy();
	if( $isAdminSession == true){
		header("Location: admin-login.php");		
	} else {
		header("Location: index.php");		
	}
?> 
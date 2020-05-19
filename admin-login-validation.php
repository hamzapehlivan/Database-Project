<?php

require_once ('connect.php');
session_start();


$email = $_POST['email'];
$password = $_POST['password'];

// Check if the account has already been taken
$s = " select * from user where email = '$email' and password = '$password'";
$result = mysqli_query($conn, $s);
$num = mysqli_num_rows($result);

if($num == 1){
	// Get user_id and fullname
	$result_user = mysqli_query($conn, " select user_id, fullname from user where email = '$email' " );
	$row = mysqli_fetch_assoc($result_user);
    $userid = $row["user_id"];
    $fullname = $row["fullname"]; 
	
	// Get admin
	$result_admin = mysqli_query($conn, " select * from admin where admin_id = '$userid' " );
	$num_of_admin = mysqli_num_rows($result_admin);
	if( $num_of_admin == 1){
				
		$_SESSION['admin_id'] = $userid;
		$_SESSION['email'] = $email;
		$_SESSION['fullname'] = $fullname;
		
		// Set developer as logged in
		$_SESSION['admin_logged_in'] = true;
				  
		header('location:admin.php');
	} else {
		$_SESSION['error'] = 'This is not admin account. Please, try a valid account!';
		header('location:admin-login.php');
	}
} else {
	$_SESSION['error'] = 'This account cannot be found! You may enter wrong email or password.';
	header('location:admin-login.php');
}

?>
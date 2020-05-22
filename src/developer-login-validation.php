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
	
	// Get profile_id
	$result_profile = mysqli_query($conn, " select profile_id from developer where developer_id = '$userid' " );
	$num_of_developer = mysqli_num_rows($result_profile);
	if( $num_of_developer == 1){
		$row = mysqli_fetch_assoc($result_profile);
		$profile_id = $row["profile_id"];
		
		$_SESSION['developer_id'] = $userid;
		$_SESSION['profile_id'] = $profile_id;
		$_SESSION['email'] = $email;
		$_SESSION['fullname'] = $fullname;
		
		// Set developer as logged in
		$_SESSION['developer_logged_in'] = true;
				  
		header('location:developer.php');
	} else {
		$_SESSION['error'] = 'This is not developer account. Please, try a valid account!';
		header('location:developer-login.php');
	}
} else {
	$_SESSION['error'] = 'This account cannot be found! You may enter wrong email or password.';
	header('location:developer-login.php');
}

?>
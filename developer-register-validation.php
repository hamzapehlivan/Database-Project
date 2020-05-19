<?php

require_once ('connect.php');
session_start();


$fullname = $_POST['fullname'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmpassword = $_POST['confirmpassword'];
$phone = $_POST['phone'];

// Check if the account has already been taken
$s = " select * from user where email = '$email' ";
$result = mysqli_query($conn, $s);
$num = mysqli_num_rows($result);

if($num == 1){
	$_SESSION['error'] = 'This account already exists!';
	header('location:developer-register.php');
} else if( $password != $confirmpassword ) {
	$_SESSION['error'] = 'Password and confirm password do NOT match!';
	header('location:developer-register.php');
} else {
	// Insert informations to user table
	if( $phone == ""){
		$insert_user = " insert into user(email, password, fullname, phone) values ('$email', '$password', '$fullname', null)";
	}
	else{
		$insert_user = " insert into user(email, password, fullname, phone) values ('$email', '$password', '$fullname', '$phone')";
	}
	mysqli_query($conn, $insert_user);
	
	// Create profile for developer
	$create_profile = "insert into profile( linkedin_link, experienced_years, status, cv_link, github_link) values (null, null, 1, null, null)";
	mysqli_query($conn, $create_profile);
	
	// Get user_id and fullname
	$result_user = mysqli_query($conn, " select user_id, fullname from user where email = '$email' " );
	$row = mysqli_fetch_assoc($result_user);
    $userid = $row["user_id"];
    $fullname = $row["fullname"]; 
	
	// Get profile_id
	$result_profileid = mysqli_query($conn, "SELECT LAST_INSERT_ID()") or die(mysqli_error($conn));
	$row =  mysqli_fetch_array ($result_profileid);
	$profileid = $row ['LAST_INSERT_ID()'];
		
	// Insert profile_id and user_id to developer table
	$insert_developer = mysqli_query($conn, " insert into developer(developer_id, profile_id) values ('$userid', '$profileid')");
	$_SESSION['developerid'] = $userid;
	$_SESSION['profileid'] = $profileid;
	$_SESSION['email'] = $email;
	$_SESSION['fullname'] = $fullname;
	
	// Set developer as logged in
	$_SESSION['developer_logged_in'] = true;
	
	header('location:developer.php');
}

?>
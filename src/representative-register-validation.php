<?php

require_once ('connect.php');
session_start();


$fullname = $_POST['fullname'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmpassword = $_POST['confirmpassword'];
$phone = $_POST['phone'];
$subscription_type = $_POST['subscription_type'];
$title = $_POST['title'];
$company_name = $_POST['company_name'];

// Check if the account has already been taken
$s = " select * from user where email = '$email' ";
$result = mysqli_query($conn, $s);
$num = mysqli_num_rows($result);

if($num == 1){
	$_SESSION['error'] = 'This account already exists!';
	header('location:representative-register.php');
} else if( $password != $confirmpassword ) {
	$_SESSION['error'] = 'Password and confirm password do NOT match!';
	header('location:representative-register.php');
} else {
	// Insert informations to user table
	if( $phone == ""){
		$insert_user = " insert into user(email, password, fullname, phone) values ('$email', '$password', '$fullname', null)";
	}
	else{
		$insert_user = " insert into user(email, password, fullname, phone) values ('$email', '$password', '$fullname', '$phone')";
	}
	mysqli_query($conn, $insert_user);
	
	// Get representative_id
	$result_representativeid = mysqli_query($conn, " select user_id from user where email = '$email' " );
	$representativeid = mysqli_fetch_row($result_representativeid);
	
	// Get company_id
	$result_companyid = mysqli_query($conn, " select company_id from company where company_name = '$company_name' " );
	$companyid = mysqli_fetch_row($result_companyid);
		
	// Insert informations to representative table
	mysqli_query($conn, " insert into representative( representative_id, subscription_type, title, company_id) values ( '$representativeid[0]', '$subscription_type', '$title', '$companyid[0]')");
	
	$_SESSION['representative_id'] = $representativeid[0];
	$_SESSION['fullname'] = $fullname;
	$_SESSION['email'] = $email;
	$_SESSION['company_name'] = $company_name;
	
	// Set representative as logged in
	$_SESSION['representative_logged_in'] = true;
	
	header('location:representative-register.php');
}

?>
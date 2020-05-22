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
	
	// Get representative
	$result_representative = mysqli_query($conn, " select * from representative where representative_id = '$userid' " );
	$num_of_representative = mysqli_num_rows($result_representative);

	if( $num_of_representative == 1){
		
		$_SESSION['representative_id'] = $userid;
		$_SESSION['fullname'] = $fullname;
		$_SESSION['email'] = $email;
		
		// Get company name
		$representative_info = mysqli_fetch_array($result_representative, MYSQLI_ASSOC);
		$company_id = $representative_info['company_id'];
		$result_company_name = mysqli_query($conn, " select company_name from company where company_id = '$company_id' " );
		$company_name = mysqli_fetch_row($result_company_name);
		$_SESSION['company_name'] = $company_name[0];

		// Set representative as logged in
		$_SESSION['representative_logged_in'] = true;
				  
		header('location:representative.php');
	} else {
		$_SESSION['error'] = 'This is not representative account. Please, try a valid account!';
		header('location:representative-login.php');
	}
} else {
	$_SESSION['error'] = 'This account cannot be found! You may enter wrong email or password.';
	header('location:representative-login.php');
}

?>
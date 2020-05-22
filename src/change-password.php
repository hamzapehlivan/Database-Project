<?php

require_once ('connect.php');
session_start();

$email = $_SESSION['email'];
$oldpassword = $_POST['oldPassword'];
$newPassword = $_POST['newPassword'];
$confirmPassword = $_POST['confirmPassword'];

if( $newPassword != $confirmPassword ){
	$_SESSION["change_password_message"] = 'New password and confirm password do NOT match!';
} else {
	
	// Check if old password is true
	$s = " select * from user where email = '$email' and password = '$oldpassword' ";
	$result = mysqli_query($conn, $s);
	$num = mysqli_num_rows($result);

	if($num == 1){
		$update_password = " update user set password = '$newPassword' where email = '$email' ";
		mysqli_query($conn, $update_password);
		$_SESSION["change_password_message"] = "Your password has been changed successfully.";
	} else {
		$_SESSION["change_password_message"] = 'You entered wrong password!';
	}

}
if( isset($_SESSION['developer_logged_in'])){
	header('location:developer-profile.php');
} else if( isset($_SESSION['representative_logged_in'])){
	header('location:representative-profile.php');
} else if( isset($_SESSION['admin_logged_in'])){
	header('location:admin-profile.php');
}

?>
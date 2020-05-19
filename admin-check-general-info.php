<?php

require_once ('connect.php');
session_start();

$email = $_SESSION['email'];
$phoneNumber = $_POST['phoneNumber'];

// Update phone from user table
$update_phone = " update user set phone = '$phoneNumber' where email = '$email' "; 
mysqli_query($conn, $update_phone);

$_SESSION["general_info_message"] = 'Your information has been changed successfully!';
header('location:admin-profile.php');

?>
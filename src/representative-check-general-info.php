<?php

require_once ('connect.php');
session_start();

$email = $_SESSION['email'];
$representative_id = $_SESSION['representative_id'];
$profileid = $_SESSION['profileid'];

$phoneNumber = $_POST['phoneNumber'] ? $_POST['phoneNumber'] : "";
$title = $_POST['title'];
$subscription_type = $_POST['subscription_type'];

// Update phone from user table
$update_phone = " update user set phone = '$phoneNumber' where email = '$email' "; 
mysqli_query($conn, $update_phone);

// Update profile informations
$update_profile = " update representative set subscription_type = '$subscription_type', title = '$title' where representative_id = $representative_id ";
mysqli_query($conn, $update_profile);

$_SESSION["general_info_message"] = 'Your information has been changed successfully!';
header('location:representative-profile.php');

?>
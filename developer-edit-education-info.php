<?php

require_once ('connect.php');
session_start();

$profileid = $_SESSION['profileid'];

$institution_name = $_POST['institution_name'];
$start_date = ($_POST['start_date'] != "") ? $_POST['start_date'] : null;
$end_date = ($_POST['end_date'] != "") ? $_POST['end_date'] : null;
$isGraduated = $_POST['isGraduated'] ? 1 : 0;
$cgpa = $_POST['cgpa'];
$description = ($_POST['description'] != "")  ? $_POST['description'] : null;

if( $_POST["action"] == "update"){
	$update_education = " update educationinfo set end_date='$end_date', isGraduated='$isGraduated', cgpa='$cgpa', description='$description' where profile_id='$profileid' and institution_name='$institution_name' and start_date='$start_date' ";
	mysqli_query($conn, $update_education);
	$_SESSION["edit_education_message"] = 'Your information has been updated successfully!';
} else {
	$delete_education = " delete from educationinfo where profile_id='$profileid' and institution_name='$institution_name' and start_date='$start_date' ";
	mysqli_query($conn, $delete_education);
	$_SESSION["edit_education_message"] = 'Your information has been removed successfully!';
}

/*
echo $profileid;
echo " ";
echo $institution_name;
echo " ";
echo $start_date;
echo " ";
echo $end_date;
echo " ";
echo $isGraduated;
echo " ";
echo $cgpa;
echo " ";
echo $description;
*/
header('location:developer-profile.php');

?>
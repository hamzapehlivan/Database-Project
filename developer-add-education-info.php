<?php

require_once ('connect.php');
session_start();

$profileid = $_SESSION['profileid'];

$institution_name = $_POST['institution_name'];
$start_date = ($_POST['start_date'] != "") ? $_POST['start_date'] : null;
$end_date = ($_POST['end_date'] != "") ? $_POST['end_date'] : null;
$isGraduted = $_POST['isGraduted'] ? 1 : 0;
$cgpa = $_POST['cgpa'];
$description = ($_POST['description'] != "")  ? $_POST['description'] : null;


// Insert new education info
if( $end_date == null ){
	$insert_education_info = " insert into educationinfo values( '$profileid', '$institution_name', '$start_date', null, '$isGraduted', '$cgpa', '$description' ) "; 	
} else {
	$insert_education_info = " insert into educationinfo values( '$profileid', '$institution_name', '$start_date', '$end_date', '$isGraduted', '$cgpa', '$description' ) "; 	
}
mysqli_query($conn, $insert_education_info);


$_SESSION["add_education_message"] = 'Your information has been added successfully!';
header('location:developer-profile.php');

?>
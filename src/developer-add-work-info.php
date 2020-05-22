<?php

require_once ('connect.php');
session_start();

$profile_id = $_SESSION['profile_id'];

$company_name = $_POST['company_name'];
$start_date = ($_POST['start_date'] != "") ? $_POST['start_date'] : null;
$end_date = ($_POST['end_date'] != "") ? $_POST['end_date'] : null;
$title = $_POST['title'] ? $_POST['title'] : null;
$description = ($_POST['description'] != "")  ? $_POST['description'] : null;


// Insert new education info
if( $end_date == null ){
	$insert_work_info = " insert into workinfo values( '$profile_id', '$company_name', '$start_date', null, '$title', '$description' ) "; 	
} else {
	$insert_work_info = " insert into workinfo values( '$profile_id', '$company_name', '$start_date', '$end_date', '$title', '$description' ) "; 	
}
mysqli_query($conn, $insert_work_info);


$_SESSION["add_work_message"] = 'Your information has been added successfully!';
header('location:developer-profile.php');

?>
<?php

require_once ('connect.php');
session_start();

$profile_id = $_SESSION['profile_id'];

$project_title = $_POST['project_title'];
$start_date = ($_POST['start_date'] != "") ? $_POST['start_date'] : null;
$end_date = ($_POST['end_date'] != "") ? $_POST['end_date'] : null;
$project_type = $_POST['project_type'] ? $_POST['project_type'] : null;
$description = ($_POST['description'] != "")  ? $_POST['description'] : null;
$project_link = $_POST['project_link'] ? $_POST['project_link'] : null;

// Insert new education info
if( $end_date == null ){
	$insert_project_info = " insert into projectinfo values( '$profile_id', '$project_title', '$start_date', null, '$project_type', '$description', '$project_link' ) ";
} else {
	$insert_project_info = " insert into projectinfo values( '$profile_id', '$project_title', '$start_date', '$end_date', '$project_type', '$description', '$project_link' ) "; 	
}
mysqli_query($conn, $insert_project_info);



$_SESSION["add_project_message"] = 'Your information has been added successfully!';
header('location:developer-profile.php');

?>
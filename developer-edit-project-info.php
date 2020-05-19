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

if( $_POST["action"] == "update"){
	$update_project = " update projectinfo set end_date='$end_date', project_type='$project_type', description='$description', $project_link='$$project_link' where profile_id='$profile_id' and project_title='$project_title' and start_date='$start_date' ";
	mysqli_query($conn, $update_project);
	$_SESSION["edit_project_message"] = 'Your information has been updated successfully!';
} else {
	$delete_project = " delete from projectinfo where profile_id='$profile_id' and project_title='$project_title' and start_date='$start_date' ";
	mysqli_query($conn, $delete_project);
	$_SESSION["edit_project_message"] = 'Your information has been removed successfully!';
}

header('location:developer-profile.php');

?>
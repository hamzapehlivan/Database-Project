<?php

require_once ('connect.php');
session_start();

$profileid = $_SESSION['profileid'];

$company_name = $_POST['company_name'];
$start_date = ($_POST['start_date'] != "") ? $_POST['start_date'] : null;
$end_date = ($_POST['end_date'] != "") ? $_POST['end_date'] : null;
$title = $_POST['title'] ? $_POST['title'] : null;
$description = ($_POST['description'] != "")  ? $_POST['description'] : null;

if( $_POST["action"] == "update"){
	$update_work = " update workinfo set end_date='$end_date', title='$title', description='$description' where profile_id='$profileid' and company_name='$company_name' and start_date='$start_date' ";
	mysqli_query($conn, $update_work);
	$_SESSION["edit_work_message"] = 'Your information has been updated successfully!';
} else {
	$delete_work = " delete from workinfo where profile_id='$profileid' and company_name='$company_name' and start_date='$start_date' ";
	mysqli_query($conn, $delete_work);
	$_SESSION["edit_work_message"] = 'Your information has been removed successfully!';
}

header('location:developer-profile.php');

?>
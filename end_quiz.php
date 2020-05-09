<?php
	require_once ('connect.php');
	session_start();
	$attempt_id = $_REQUEST['attempt_id'];
	// Calculate total score
	$sql = "SELECT COUNT(*) AS total_score FROM answer WHERE isCorrect = 1 and attempt_id = {$attempt_id}";
	$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
	$row = mysqli_fetch_array ($result);
	$total_score = $row['total_score'];
	$succes_threshold = 0;
	
	if ($total_score > $succes_threshold ) {
		$succesful = 1;
	}
	else {
		$succesful = 0;
	}
		
	$sql = "UPDATE quiztrial SET isSuccessful = {$succesful}, total_score = {$total_score} WHERE attempt_id = {$attempt_id}";
	$result = mysqli_query ($conn, $sql);
	header("location:developer_main.php");
?>
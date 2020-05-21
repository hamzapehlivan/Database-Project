<?php
	require_once ('connect.php');
	session_start();
	$admin_id = $_SESSION['admin_id'];
	//$_SESSION['admin_id'] = $admin_id;

	$quiz_title = $_POST['quiz_title_get'];
	$sql = "select quiz_id from quiz where quiz_title = '{$quiz_title}' and admin_id = '{$admin_id}'";
	$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
	if ( $row = mysqli_fetch_array ($result)) {
			$quiz_id = $row['quiz_id'];
	}
	echo "$quiz_id";
	$sql2 = "select question_id from quiz_questions where quiz_id = '{$quiz_id}'";
	$result2 = mysqli_query ($conn, $sql2) or die(mysqli_error($conn));
	while ($row2 = mysqli_fetch_array ($result2))
	{
		$sql = "delete from categorized_as where question_id = '{$row2['question_id']}'";
		$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
		
		$sql = "delete from choice where question_id = '{$row2['question_id']}'";
		$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
		
		$sql = "delete from quiz_questions where question_id = '{$row2['question_id']}'";
		$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
		
		$sql = "delete from question where question_id = '{$row2['question_id']}'";
		$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
	}
	$sql = "delete from quiz where quiz_id = '{$quiz_id}'";
	$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
	
	
	
	header('location:edit-quiz.php');
		
?>
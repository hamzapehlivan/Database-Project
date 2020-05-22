<?php
	require_once ('connect.php');
	session_start();
	$quiz_id = $_SESSION['addQuiz_id'];
	$quiz_title = $_POST['quiz_title'];
	$category_name = $_POST['category_name'];
	$time = $_POST['new_time'];
	$new_category_name = $_POST['new_category_name'];
	
	if ($new_category_name != null)
	{
		$sql = "insert into category (category_name)
				values ('{$new_category_name}')";
		$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
		
		$sql = "update quiz
				set category_name = '{$new_category_name}'
				where quiz_id = {$quiz_id}";
		$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));	
		
	}
	else
	{
		$sql = "update quiz
				set category_name = '{$category_name}'
				where quiz_id = {$quiz_id}";
		$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));	
	}
	if ($quiz_title != null)
	{
		$sql = "update quiz
				set quiz_title = '{$quiz_title}'
				where quiz_id = {$quiz_id}";
		$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));	
	}
	if ($time != null)
	{
		$sql = "update quiz
				set time = '{$time}'
				where quiz_id = {$quiz_id}";
		$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));	
	}			
	header('location:displayQuiz.php');
		
?>
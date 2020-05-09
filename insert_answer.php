<?php

	require_once ('connect.php');
	session_start();
	
	$choice_id = $_REQUEST['choice'];
	$question_id = $_REQUEST['question_id'];
	$attempt_id = $_REQUEST ['attempt_id'];
	$quiz_id = $_REQUEST['quiz_id'];
	
	// Determine if the question is correct
	$sql = "SELECT isCorrectAnswer FROM choice WHERE question_id = {$question_id} and choice_id = {$choice_id}";
	$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
	$row = mysqli_fetch_array ($result);
	$isCorrect = $row['isCorrectAnswer'];
	
	// Insert into answers
	$sql = "INSERT INTO answer VALUES ( {$attempt_id}, {$question_id}, {$choice_id}, {$isCorrect})";
	$result = mysqli_query($conn, $sql);
	
	$_SESSION['question_pointer'] = $_SESSION['question_pointer'] +1;
	
	header("location:solve_question.php?&quiz_id={$quiz_id}&attempt_id={$attempt_id}");

?>
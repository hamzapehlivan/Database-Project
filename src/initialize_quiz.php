<?php
	require_once ('connect.php');
	session_start();
	$quiz_id = $_REQUEST['quiz_id'];
	$developer_id = $_SESSION['developer_id'];
	
	// Create a new attempt
	date_default_timezone_set('Europe/Istanbul');
	$date = date("Y-m-d");
	
	$sql = "INSERT INTO quiztrial (attempt_id, developer_id, quiz_id, date) VALUES (null, {$developer_id}, {$quiz_id}, '{$date}')";
	$result = mysqli_query ($conn, $sql);
	
	$sql = "SELECT LAST_INSERT_ID()";
	$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
	$row =  mysqli_fetch_array ($result);
	$attempt_id = $row ['LAST_INSERT_ID()'];
	
	// Decrease Remainig Attempts by One
	
	$sql = "update tries set remaining_attempts = remaining_attempts - 1 where developer_id = {$developer_id} and quiz_id = {$quiz_id}";
	$result = mysqli_query ($conn, $sql); 
	
	// Fetch the questions
	
	$sql = "SELECT question_id, description FROM quiz_questions NATURAL JOIN question WHERE quiz_id = {$quiz_id} ORDER BY question_id ASC";
	$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));

	// Put questions into an array
	
	$questions = array();
	while ($row = mysqli_fetch_array ($result)) {
		$questions [] = $row['question_id'];
	}
	$_SESSION['initializedQuestions'] = $questions;
	
	// Get the timer for quiz.
	
	$sql = "SELECT time FROM quiz WHERE quiz_id = {$quiz_id}";
	$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
	$row =  mysqli_fetch_array ($result);
	$quiz_duration = $row['time'];
	$quiz_start_time = date("H:i:s");
	$secs = strtotime($quiz_duration)-strtotime("00:00:00");
	$quiz_end_time = date("H:i:s",strtotime($quiz_start_time)+$secs);	// end = duration + start
	
	$_SESSION ['quiz_end_time'] = $quiz_end_time;
	
	
	$_SESSION['question_pointer'] = 0;
	header("location:solve_question.php?&quiz_id={$quiz_id}&attempt_id={$attempt_id}");
?>

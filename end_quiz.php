<?php
	require_once ('connect.php');
	session_start();
	$developer_id = $_SESSION ['developer_id'];
	$attempt_id = $_REQUEST['attempt_id'];
	$isForced = $_REQUEST['isForced'];
	
	$sql = "SELECT quiz_id FROM quiztrial WHERE attempt_id = {$attempt_id}";
	$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
	$row = mysqli_fetch_array ($result);
	$quiz_id = $row ['quiz_id'];
	// Mark all skipped questions.
	if ($isForced) {
		
		$sql = "SELECT question_id FROM quiz_questions WHERE quiz_id = {$quiz_id}";
		$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
		while ($row = mysqli_fetch_array ($result) ) {
			$sql = "SELECT EXISTS(SELECT * FROM answer WHERE attempt_id = {$attempt_id} and question_id = {$row['question_id']}) as test";
			$result2 = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
			$row2 = mysqli_fetch_array ($result2);
			
			if ($row2['test'] == 0) {
				$sql = "INSERT INTO answer VALUES ({$attempt_id},{$row['question_id']}, -1, 0 ) ";
				$result3 = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
			}
		}
		
		
	}
	// Calculate total score
	$sql = "SELECT COUNT(*) AS total_score FROM answer WHERE isCorrect = 1 and attempt_id = {$attempt_id}";
	$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
	$row = mysqli_fetch_array ($result);
	$total_score = $row['total_score'];
	
	// Calculate succes_threshold
	$sql = "SELECT total_questions FROM quiz WHERE quiz_id = {$quiz_id} ";
	$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
	$row = mysqli_fetch_array ($result);
	$total_questions = $row ['total_questions'];
	$succes_threshold = floor ($total_questions/2);
	
	if ($total_score > $succes_threshold ) {
		$succesful = 1;
	}
	else {
		$succesful = 0;
	}
	
	$total_score = floor ((100 * $total_score) / $total_questions);
	$sql = "UPDATE quiztrial SET isSuccessful = {$succesful}, total_score = {$total_score} WHERE attempt_id = {$attempt_id}";
	$result = mysqli_query ($conn, $sql);

	header("location:developer_result.php");
?>
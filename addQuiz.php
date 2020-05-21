<?php
	require_once ('connect.php');
	session_start();
	$admin_id = $_SESSION['admin_id'];
	//$_SESSION['admin_id'] = $admin_id;

	$quiz_title = $_POST['quiz_title'];
	$category_name = $_POST['category_name'];
	$time = $_POST['new_time'];
	$new_category_name = $_POST['new_category_name'];

	if ($new_category_name != null)
	{
		$sql = "insert into category (category_name)
				values ('{$new_category_name}')";
		$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
		
		$sql = "insert into quiz (quiz_id, admin_id, category_name, total_questions, quiz_title, time)
			values (null, '{$admin_id}', '{$new_category_name}', '0', '{$quiz_title}', '{$time}')";
		$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
		

		$sql = "SELECT LAST_INSERT_ID()";
		$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
		$row =  mysqli_fetch_array ($result);
		$quiz_id = $row ['LAST_INSERT_ID()'];
		
		$_SESSION['addQuiz_id'] = $quiz_id;
		
	}
	else
	{
		$sql = "insert into quiz (quiz_id, admin_id, category_name, total_questions, quiz_title, time)
			values (null, '{$admin_id}', '{$category_name}', '0', '{$quiz_title}', '{$time}')";
		$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
		
		$sql = "SELECT LAST_INSERT_ID()";
		$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
		$row =  mysqli_fetch_array ($result);
		$quiz_id = $row ['LAST_INSERT_ID()'];
		
		$_SESSION['addQuiz_id'] = $quiz_id;
	}

	header('location:complete.php');
		
?>
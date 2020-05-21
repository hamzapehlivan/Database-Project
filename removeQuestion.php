<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	
    <title>CSCAREER</title>
  </head>
  <body>
	<body style="background-color:#D6EAF8;">
	<div class="container">
		<h2>CSCAREER</h2>
		<p class="bg-info text-white">Admin Account</p>
		
	<?php
		require_once ('connect.php');
		session_start();
		
		$questionNumberToDelete = $_POST['remove_question_id'];
		$quiz_id = $_SESSION['addQuiz_id'];
		
		$sql = "delete from choice where question_id = '$questionNumberToDelete'";
		$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));	
		
		$sql = "delete from categorized_as where question_id = '$questionNumberToDelete'";
		$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
		
		$sql = "delete from quiz_questions where question_id = '$questionNumberToDelete'";
		$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
		
		$sql = "delete from question where question_id = '$questionNumberToDelete'";
		$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
		
		$sql = "update quiz
				set total_questions = total_questions - 1
				where quiz_id = {$quiz_id}";
		$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
			
		header('location:displayQuiz.php');
	?>
	
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>
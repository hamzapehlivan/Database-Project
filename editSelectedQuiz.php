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
  <body style="background: linear-gradient(rgba(0, 0, 50, 0.5), rgba(0, 0, 50, 0.5)), url('image/background.jpg');
					background-size: cover; background-position: center;">
	<div class="container">
		<h2>CSCAREER</h2>
		<p class="bg-info text-white">Admin Account</p>
	</div>
	<div class= "container"	 style = "background: rgba(211, 211, 211, 0.3);">	
		
	<?php
		require_once ('connect.php');
		session_start();
		$quiz_title = $_POST['quiz_title_get'];
		$admin_id = $_SESSION['admin_id'];
		//$_SESSION['admin_id'] = $admin_id;
		$sql = "select quiz_id from quiz where quiz_title = '{$quiz_title}' and admin_id = '{$admin_id}'";
		$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
		if ( $row = mysqli_fetch_array ($result)) {
				$quiz_id = $row['quiz_id'];
		}
		$_SESSION['addQuiz_id'] = $quiz_id;
		
		echo "<br><div class= 'container'	 style = '  padding: 10px;
    					border: 2px solid #ffffff;  width: 40%;'> ";
		echo "<center><p style = 'color: #CDE550; font-size: 30px;'><b>Quiz Properties</b></p></center>";
		echo "<hr style='border: 1px solid white; width:100%' />";
		
		$sql = "select category_name, quiz_title, time, total_questions from quiz
				where quiz_id = {$quiz_id}";
		$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
		while ( $row = mysqli_fetch_array ($result) )
		{
			echo "<div  class= 'container' style = 'color:#FFFFFF; font-size: 20px;'>Quiz Title: {$row['quiz_title']}</div>";
			echo "<br>";
			echo "<div class= 'container' style = 'color:#FFFFFF; font-size: 20px;'>Category name: {$row['category_name']}</div>";
			echo "<br>";
			echo "<div class= 'container' style = 'color:#FFFFFF; font-size: 20px;'>Max time: {$row['time']}</div>";
			echo "<br>";
			echo "<div class= 'container' style = 'color:#FFFFFF; font-size: 20px;'>Number of Questions: {$row['total_questions']}</div>";
			echo "<br>";
		}
		echo "<a href = 'editQuizProperty.php'><center><button type = 'button' class='btn-warning btn-md'>Edit Quiz Properties</button></center></a><br>";
		echo "</div><br>";
		echo "<hr style='border: 1.5px solid white;' />";
		$sql = "select question_id from quiz_questions
				where quiz_id = {$quiz_id}";
		$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
		$question_number = 1;
		while ( $row = mysqli_fetch_array ($result) )
		{
			//echo "{$row['question_id']}";
			$sql2 = "select description, difficulty
					from question
					where question_id = {$row['question_id']}";
			$result2 = mysqli_query ($conn, $sql2) or die(mysqli_error($conn));
			
			$sql3 = "select choice_text from choice natural join quiz_questions
					where question_id = {$row['question_id']}";
			$result3 = mysqli_query ($conn, $sql3) or die(mysqli_error($conn));
			
			$sql4 = "select choice_text from choice
					where question_id = {$row['question_id']} and isCorrectAnswer = 1";
			$result4 = mysqli_query ($conn, $sql4) or die(mysqli_error($conn));
			
			$sql5 = "select category_name from categorized_as
					where question_id = {$row['question_id']}";
			$result5 = mysqli_query ($conn, $sql5) or die(mysqli_error($conn));
			
			while ( $row2 = mysqli_fetch_array ($result2) )
			{
				echo "<div align='center' style = 'color:#CDE550; font-size: 23px;'><b>QUESTION {$question_number}</b></div>";
				echo "<br>";
				echo "<div align='center' style = 'color:#000000; font-size: 18px;'>Description: {$row2['description']}</div>";
				echo "<br>";
				echo "<div align='center' style = 'color:#000000; font-size: 18px;'>Difficulty: {$row2['difficulty']}</div>";
				echo "<br>";
				$counter = 1;
				while ( $row3 = mysqli_fetch_array ($result3) )
				{
					echo "<div align='center' style = 'color:#000000; font-size: 18px;'>Choice {$counter}: {$row3['choice_text']}</div>";
					echo "<br>";
					$counter = $counter+ 1;
				}
				while( $row4 = mysqli_fetch_array ($result4) )
				{
					echo "<div align='center' style = 'color:#000000; font-size: 18px;'>Correct Answer: {$row4['choice_text']}</div>";
					echo "<br>";
				}
				while( $row5 = mysqli_fetch_array ($result5) )
				{
					echo "<div align='center'<div align='center' style = 'color:#000000; font-size: 18px;'>Its subject: {$row5['category_name']}</div>";
					echo "<br>";
				}
				echo "<br>";
			}
			echo "<form action='editQuestion.php' method='post'><div class='form-group'><center><button type='submit' class='btn-warning btn-md' name = 'edit_question_id' value = '{$row['question_id']}'>Edit Question {$question_number}</center></button></div></form>";
			echo "<br>";
			echo "<form action='removeQuestion.php' method='post'><div class='form-group'><center><button type='submit' class='btn-danger btn-md' name = 'remove_question_id' value = '{$row['question_id']}'>Remove Question {$question_number}</center></button></div></form>";
			$question_number = $question_number + 1;
			echo "<br>";
			echo "<hr style='border: 1px solid white; width:70%' />";
		}
		
		echo "<a href = 'complete.php'><div class = 'container'> <button type='submit' class='btn-warning btn-lg'style='float: right;'>Add New Question</button></div></a>";
		echo "<br><br><br>";
		echo "<a href = 'edit-quiz.php'><div class = 'container'> <button type='submit' class='btn-success btn-lg'style='float: right;'>Done</button></div></a>";			
	?>
		<br><br><br><br>
	 </div>
	  <br><br><br><br>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>
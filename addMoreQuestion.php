<?php
	require_once ('connect.php');
	session_start();
	$admin_id = $_SESSION['admin_id'];

	$description = $_POST['description'];
	$difficulty = $_POST['difficulty'];
	$choicetext_a =$_POST['choicetext_a'];
	$choicetext_b =$_POST['choicetext_b'];
	$choicetext_c =$_POST['choicetext_c'];
	$choicetext_d =$_POST['choicetext_d'];
	$isCorrectAnswer = $_POST['isCorrectAnswer'];
	

	$sql = "insert into question (question_id, admin_id, description, difficulty)
				values (null, '{$admin_id}', '{$description}', '{$difficulty}')";
	$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));

	$sql = "SELECT LAST_INSERT_ID()";
	$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
	$row =  mysqli_fetch_array ($result);
	$question_id = $row ['LAST_INSERT_ID()'];
	$_SESSION['addQuestion_id'] = $question_id;

	if(isset($_POST["subjects"]))  
    { 
        // Retrieving each selected option 
        foreach ($_POST['subjects'] as $subject)
		{
			$sql = "insert into categorized_as (category_name, question_id)
						values ('{$subject}', '{$question_id}')";
			$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
			echo "You selected $subject<br/>";
		}
           
     } 

	$flag = false;
	if ( $isCorrectAnswer == "a")
		$flag = true;
	$sql = "insert into choice (choice_id, question_id, choice_text, isCorrectAnswer)
				values ('1', '{$question_id}', '{$choicetext_a}', '{$flag}')";
	$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));

	$flag = false;
	if ( $isCorrectAnswer == "b")
		$flag = true;
	$sql = "insert into choice (choice_id,question_id, choice_text, isCorrectAnswer)
				values ('2', '{$question_id}', '{$choicetext_b}', '{$flag}')";
	$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));

	$flag = false;
	if ( $isCorrectAnswer == "c")
		$flag = true;
	$sql = "insert into choice (choice_id,question_id, choice_text, isCorrectAnswer)
				values ('3', '{$question_id}', '{$choicetext_c}', '{$flag}')";
	$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));

	$flag = false;
	if ( $isCorrectAnswer == "d")
		$flag = true;
	$sql = "insert into choice (choice_id,question_id, choice_text, isCorrectAnswer)
				values ('4', '{$question_id}', '{$choicetext_d}', '{$flag}')";
	$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));

	$quiz_id = $_SESSION['addQuiz_id'];
	
	$sql = "insert into quiz_questions  (quiz_id, question_id)
			values ('{$quiz_id}', '{$question_id}')";
	$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
	
	$sql = "update quiz
			set total_questions = total_questions + 1
			where quiz_id = {$quiz_id} and admin_id = '{$admin_id}'";
	$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));

	header('location:complete.php');
		
?>
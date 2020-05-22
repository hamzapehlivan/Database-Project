<?php
	require_once ('connect.php');
	session_start();
	
	$description = $_POST['description'];
	$difficulty = $_POST['difficulty'];
	$choicetext_a =$_POST['choicetext_A'];
	$choicetext_b =$_POST['choicetext_B'];
	$choicetext_c =$_POST['choicetext_C'];
	$choicetext_d =$_POST['choicetext_D'];
	$isCorrectAnswer = $_POST['isCorrectAnswer'];
	
	$questionNumberToEdit = $_SESSION['edit_question_id'];
	
	$sql = "select description 
				from question
				where question_id = '{$questionNumberToEdit}'";

	$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
	$old_description = mysqli_fetch_array ($result);

	if($description != $old_description)  
    {
		$sql = "update question 
				set description = '{$description}'
				where question_id = '{$questionNumberToEdit}'";

		$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
	}
	if(!empty($_POST['difficulty']))
    {
		$sql = "update question 
				set difficulty = '{$difficulty}'
				where question_id = '{$questionNumberToEdit}'";

		$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
	}
	$sql = "select * from question 
			where question_id = '{$questionNumberToEdit}'";
	
	$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
	while ( $row = mysqli_fetch_array ($result) )
	{
		echo $row['difficulty'];
	}
	echo "$isCorrectAnswer";
	$flag = false;
	if ( $isCorrectAnswer == "a")
		$flag = true;

	echo "{$_POST['choicetext_A']}";

	
	if(!empty($_POST['choicetext_A']))  
    {
			$sql = "update choice
					set choice_text = '{$choicetext_a}', isCorrectAnswer = '{$flag}'
					where choice_id = '1' and question_id = '{$questionNumberToEdit}'";
			//echo "{$sql}";
			$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
	}

	$flag = false;
	if ( $isCorrectAnswer == "b")
		$flag = true;
	if(!empty($_POST['choicetext_B']))  
    {
		$sql = "update choice
				set choice_text = '{$choicetext_b}', isCorrectAnswer = '{$flag}'
				where choice_id = '2' and question_id = '{$questionNumberToEdit}'";
		$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
	}

	$flag = false;
	if ( $isCorrectAnswer == "c")
		$flag = true;
	if(!empty($_POST['choicetext_C']))  
    {
		$sql = "update choice
				set choice_text = '{$choicetext_c}', isCorrectAnswer = '{$flag}'
				where choice_id = '3' and question_id = '{$questionNumberToEdit}'";
		$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
	}
	$flag = false;
	if ( $isCorrectAnswer == "d")
		$flag = true;
	if(!empty($_POST['choicetext_D']))  
    {
		$sql = "update choice
				set choice_text = '{$choicetext_d}', isCorrectAnswer = '{$flag}'
				where choice_id = '4' and question_id = '{$questionNumberToEdit}'";
		$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
	}
	if(isset($_POST["subjects"]))  
    { 
	 // Retrieving each selected option 
		$sql = "delete from categorized_as 
					where question_id = '{$questionNumberToEdit}'";
		$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
		
        foreach ($_POST['subjects'] as $subject)
		{
			$sql = "insert into categorized_as (category_name, question_id)
					values ('{$subject}', '{$questionNumberToEdit}')";
			$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
		}
	}        
    
	header('location:displayQuiz.php');
		
?>
<html>
	<head> 
		<title> CSCareer</title>
		<link rel="stylesheet" href="css/styles.css">
	</head>
	
	<body>
		<?php
			require_once ('connect.php');
			session_start();
			$quiz_id = $_REQUEST['quiz_id'];
			$attempt_id = $_REQUEST['attempt_id'];
			$questions = $_SESSION['initializedQuestions'];
			$question_pointer = $_SESSION['question_pointer'];
			$question_number = $question_pointer + 1;
			if ($question_pointer < count($questions)) {
				$question_id = $questions [ $question_pointer];
				
				// Get the choices for the question.
				$sql = "SELECT description FROM question WHERE question_id = {$question_id}";
				$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
				$row = mysqli_fetch_array ($result);
				echo "<div> <h3> Question Number {$question_number} </h3>";
				echo "{$row['description']} </div>";
					
				// Fetch choices for the question
				
				$sql = "SELECT choice_id, choice_text FROM choice WHERE question_id = {$question_id} ORDER BY choice_id DESC";
				$choiceResult = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
				
				echo "<div> <form action = 'insert_answer.php?question_id={$question_id}&attempt_id={$attempt_id}&quiz_id={$quiz_id}' method = 'post'> ";
				while ( $choiceRow = mysqli_fetch_array ($choiceResult)) {
					echo "<input type = 'radio' name = 'choice' value = '{$choiceRow['choice_id']}'>";
					echo "<label for = '{$choiceRow['choice_id']}'>{$choiceRow['choice_text']}</label> <br>";
				}
				
				echo "<div> <button type = 'submit'>Submit Answer </button> ";
				echo "<a href = 'end_quiz.php?attempt_id={$attempt_id}'><button>End Quiz</button> </a> </div>";
				
				echo "</form> </div>";
			}
			else {
				header("location:end_quiz.php?attempt_id={$attempt_id}");
			}
			
		
		?>
	
	
	</body>

</html>
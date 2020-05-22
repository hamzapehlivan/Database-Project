<html lang="en">
	<head> 
		<title> CSCareer</title>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<link rel="stylesheet" href="css/solve-question-style.css">
	</head>
	
	<body>
	
	<div class = 'container'>
	
	<div class = "row">
	
		<div class = "cl-lg"> <h4 class ="clockTimer" id = "timer"></h4> </div>
	
	</div>
	<script type = "text/javascript">
		var display = true;
		setInterval(function () {
				
			var xhr = new XMLHttpRequest();
			
			xhr.open ("GET", "countdown.php", false);
			xhr.send(null);
			var response = xhr.responseText
			document.getElementById("timer").innerHTML = response;
			
			if (response == "00:00:00") {
				if (display == true) {
					display = false;
					alert ("Time is Up");
				}
				document.getElementById("endbtn").click();
			}
			
		}, 1000);
	</script>
	
	
	
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
				echo "<div class = 'row'> <div class = 'col-lg'><h3 class = 'q-no'>Question Number {$question_number}</h3> </div> </div>";
				echo "<div class = 'row'> <div class = 'col-lg'><h5 class = 'q-description'>{$row['description']}</h5></div> </div>";
					
				// Fetch choices for the question
				
				$sql = "SELECT choice_id, choice_text FROM choice WHERE question_id = {$question_id} ORDER BY choice_id DESC";
				$choiceResult = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
				
				echo "<form action = 'insert_answer.php?question_id={$question_id}&attempt_id={$attempt_id}&quiz_id={$quiz_id}' method = 'post'> ";
				$radioNo = 1;
				while ( $choiceRow = mysqli_fetch_array ($choiceResult)) {
					echo "<div class='custom-control custom-radio'>";
					echo "<input type ='radio' id = 'customRadio{$radioNo}' name = 'choice' class = 'custom-control-input' value = '{$choiceRow['choice_id']}'>";
					echo "<label class = 'custom-control-label' for = 'customRadio{$radioNo}'>{$choiceRow['choice_text']}</label> <br>";
					echo "</div>";
					$radioNo = $radioNo + 1;
				}
				// Leave empty option
				echo "<div class='custom-control custom-radio empty'>";
				echo "<input type ='radio' id = 'empty' name = 'choice' class = 'custom-control-input' value = -1 checked= 'checked'>";
				echo "<label class = 'custom-control-label' for = 'empty'>Leave empty</label><br>";
				
				
				echo "<div class = 'row buttons'> ";
				echo "<div class = 'col-lg-2'><button type = 'submit' class='btn btn-primary'>Submit Answer </button></div>";
				echo "<div class = 'col-lg-2'><a href = 'end_quiz.php?attempt_id={$attempt_id}&isForced=1'  onclick=\"return confirm('Are You Sure?')\"><button class='btn btn-danger' type = 'button'>End Quiz</button> </a></div>";
				echo "<a href = 'end_quiz.php?attempt_id={$attempt_id}&isForced=1' id = 'endbtn' hidden> </a>";
				echo "</div>";
				
				echo "</form>";
				
			}
			else {
				header("location:end_quiz.php?attempt_id={$attempt_id}&isForced=0");
			}
			
		
		?>
		</div>
	
		
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	</body>

</html>
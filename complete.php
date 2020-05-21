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
		<form  method="post">
			<div class="form-group">
				<br><br>
				<div class="input-group">
						<label for="description" style = "color:#FFFFFF; font-size: 19px;">Enter Your Question:</label> 
						<input type="description" name="description" size="40" class="form-control" required>	
				</div>
				<br>
				<label for="choices" style = "color:#FFFFFF; font-size: 19px;">Choices:</label><br><br>
				<div class="input-group">
						<label for="choicetext_a" style = "color:#FFFFFF; font-size: 19px;">a:</label><br> 
						<input type="choicetext_a" name="choicetext_a" size="40" class="form-control" required>	
				</div>
				<br>
				<div class="input-group">
						<label for="choicetext_b" style = "color:#FFFFFF; font-size: 19px;">b:</label><br> 
						<input type="choicetext_b" name="choicetext_b" size="40" class="form-control" required>	
				</div>
				<br>
				<div class="input-group">
						<label for="choicetext_c" style = "color:#FFFFFF; font-size: 19px;">c:</label><br> 
						<input type="choicetext_c" name="choicetext_c" size="40" class="form-control" required>	
				</div>
				<br>
				<div class="input-group">
						<label for="choicetext_d" style = "color:#FFFFFF; font-size: 19px;">d:</label><br> 
						<input type="choicetext_d" name="choicetext_d" size="40" class="form-control" required>	
				</div>
				<br>
				<div class="input-group">
					<label for="isCorrectAnswer" style = "color:#FFFFFF; font-size: 19px;">Select the Correct Answer:</label>
						<select name = isCorrectAnswer>
							<option value="a">a</option>
							<option value="b">b</option>
							<option value="c">c</option>
							<option value="d">d</option>
						</select>
				</div>
				<br>
				<div class="input-group">
					<label for="difficulty" style = "color:#FFFFFF; font-size: 19px;">Select its Difficulty:</label>
						<select name = difficulty>
							<option value="easy">easy</option>
							<option value="medium">medium</option>
							<option value="hard">hard</option>
						</select>
				</div>
				<br>
				<div class="input-group">
					<label for="subjects" style = "color:#FFFFFF; font-size: 19px;">Select its Subjects:</label>
							<?php
									require_once ('connect.php');
									//session_start();
									$sql = "select category_name from category";
									$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
									//echo "<br>";
									while ( $row = mysqli_fetch_array ($result)) {
										echo "<input type='checkbox' name='subjects[]' value='{$row['category_name']}' style = 'margin-right: 5px;'>{$row['category_name']}</input>";
										echo "<br>";
									}
							?>
					
				</div>
				
				<br><br>
				<button type="submit" class="btn-warning btn-lg" formaction="addMoreQuestion.php">Add More Question</button>
				<button type="submit" class="btn-success btn-lg" formaction="addQuestion.php" style="float: right;">Done</button>
				<br><br>
			</div>
		</form>
	</div>
			 
	
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>
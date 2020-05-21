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
	
	<nav class="navbar navbar-expand-lg bg-light navbar-dark bg-dark">
			<a class="navbar-brand" >CSCareer</a>					
	</nav>
	<br><br>
	<div class= "container"	 style = "background: rgba(211, 211, 211, 0.3);">
		<form action="updateQuiz.php" method="post">
			<div class="form-group">
					<?php
					require_once ('connect.php');
					session_start();
					
						$edit_quiz_id = $_SESSION['addQuiz_id'];
						$sql = "select quiz_title from quiz where quiz_id = '{$edit_quiz_id}'";
						$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
						while ( $row = mysqli_fetch_array ($result)) {
							echo "<br><br><div class='input-group' style = 'color:#FFFFFF; font-size: 20px;'>
									<label for='quiz_title'>Name the Quiz:</label> 
									<input type='quiz_title' name='quiz_title' size='40' class='form-control input-sm' 		value = '{$row['quiz_title']}'required>	
								</div>";
						}
					
					?>	
					
					<br>
			
					<div class="input-group">
						<label for="category_name" style = "color:#FFFFFF; font-size: 20px;">Select its Category:  </label>
							<select name="category_name">
								<?php
									require_once ('connect.php');
									//session_start();
									$edit_quiz_id = $_SESSION['addQuiz_id'];
									$sql = "select distinct category_name from quiz where quiz_id != '{$edit_quiz_id}'";
									$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
									$sql2 = "select category_name from quiz where quiz_id = '{$edit_quiz_id}'";
									$result2 = mysqli_query ($conn, $sql2) or die(mysqli_error($conn));
									if ($row2 = mysqli_fetch_array ($result2))
									{
										echo "<option value='{$row2['category_name']}'>{$row2['category_name']}</option>";
									}
									while ( $row = mysqli_fetch_array ($result)) {
										echo "<option value='{$row['category_name']}'>{$row['category_name']}</option>";
									}
								?>
							</select>
					</div>
					
					<br>
					<div class="input-group">
						<label for="new_category_name" style = "color:#FFFFFF; font-size: 20px;">Create New Category:</label>
						<input type="new_category_name" name="new_category_name" size="40" class="form-control input-sm">
					</div>	
					<br>
					<?php
					require_once ('connect.php');
					//session_start();
					
						$edit_quiz_id = $_SESSION['addQuiz_id'];
						$sql = "select time from quiz where quiz_id = '{$edit_quiz_id}'";
						$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
						while ( $row = mysqli_fetch_array ($result)) {
							echo "<div class='input-group' style = 'color:#FFFFFF; font-size: 20px;'>
									<label for='new_time'>Select the maximum time given to the quiz:</label> 
									<input type='new_time' name='new_time' size='40' class='form-control input-sm' 		
									value = '{$row['time']}'required>	
								</div>";
						}
					?>			
				
					<br>
					<center><button type="submit" class="btn-success btn-lg" style = "float:right">Save Changes</center></button>
					<br><br><br><br>
			</div>
		</form>
	</div>

  </body>
</html>
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
		<form action="addQuiz.php" method="post">
			<div class="form-group">
					<br><br>
					<div class="input-group">
						<label for="quiz_title" style = 'color:#FFFFFF; font-size: 19px;'>Name the Quiz:</label> 
						<input type="quiz_title" name="quiz_title" size="40" class="form-control input-sm" required>	
					</div>
					<br>
				
					
					<div class="input-group">
						<label for="category_name" style = 'color:#FFFFFF; font-size: 19px;'>Select its Category:  </label>
							<select name="category_name">
								<?php
									require_once ('connect.php');
									session_start();
									$admin_id = $_SESSION['admin_id'];
									$sql = "select category_name from category";
									$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
									
									//echo "<option value=''></option>";
									while ( $row = mysqli_fetch_array ($result)) {
										echo "<option value='{$row['category_name']}'>{$row['category_name']}</option>";
									}
								?>
							</select>
					</div>
					
					<br>
					<div class="input-group">
						<label for="new_category_name" style = 'color:#FFFFFF; font-size: 19px;'>Create New Category:</label>
						<input type="new_category_name" name="new_category_name" size="40" class="form-control input-sm">
					</div>	
					<br>
					<div class="input-group">
						<label for="new_time" style = 'color:#FFFFFF; font-size: 19px;'>Write the maximum time given to the quiz:</label>
						<input type="new_time" name="new_time" size="40" class="form-control input-sm" required>
					</div>	
					<br>	
					<center><button type="submit" class="btn-success btn-lg" style = "float: right">Next</center></button>
					<br><br>
			</div><br>
		</form>
	</div>
		

  </body>
</html>
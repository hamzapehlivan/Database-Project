<html lang="en">
	<head> 
		<title> CSCareer</title>
		
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="css/developer-main-style.css">
		<link rel="stylesheet" href="css/navbar-style.css">
	</head>
	
	<body>
		
		<nav class="navbar navbar-expand-lg bg-light navbar-dark bg-dark">
			<a class="navbar-brand" href="#">Home</a>

				<ul class="navbar-nav mr-auto d-print leftm">
					<li class="nav-item">
						<a class="nav-link" href="#">Profile</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="#">Attempt Quiz <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="developer_result.php">Quiz Results</a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link" href="#">Interview Requests</a>
					</li>
				</ul>
				
				<ul class = "navbar-nav navbar-right d-print rightm">
					<li>
					<a class="nav-link" href = "#"><svg class="bi bi-box-arrow-in-left" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" d="M7.854 11.354a.5.5 0 000-.708L5.207 8l2.647-2.646a.5.5 0 10-.708-.708l-3 3a.5.5 0 000 .708l3 3a.5.5 0 00.708 0z" clip-rule="evenodd"/>
					<path fill-rule="evenodd" d="M15 8a.5.5 0 00-.5-.5h-9a.5.5 0 000 1h9A.5.5 0 0015 8z" clip-rule="evenodd"/>
					<path fill-rule="evenodd" d="M2.5 14.5A1.5 1.5 0 011 13V3a1.5 1.5 0 011.5-1.5h8A1.5 1.5 0 0112 3v1.5a.5.5 0 01-1 0V3a.5.5 0 00-.5-.5h-8A.5.5 0 002 3v10a.5.5 0 00.5.5h8a.5.5 0 00.5-.5v-1.5a.5.5 0 011 0V13a1.5 1.5 0 01-1.5 1.5h-8z" clip-rule="evenodd"/>
					</svg>Log Out</a>
					 </li>
				</ul>
		</nav>
	
		<div class = 'container'> 
		<div class = 'row justify-content-lg-center'>
			<div class = 'col-lg-4'>
				<h1 class = 'quiz'>Take Quiz Now!</h1>
			</div>
		</div>
		
		
		  
			<?php
			
				require_once ('connect.php');
				session_start();
				$_SESSION['developer_id'] = 1;
				$developer_id = $_SESSION['developer_id'];
				// Find the quizzes corresponding to current developer.
				$sql = "select remaining_attempts, quiz_id, category_name from tries natural join quiz where developer_id = {$developer_id} order by category_name";
				$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
				
				echo "<div class = 'row'>";
				while ( $row = mysqli_fetch_array ($result)) {
					
					echo "<div class = 'col-lg'>";  //col-lg-offset-2
					if ($row['remaining_attempts'] > 0) {
						echo "<a href = 'initialize_quiz.php?quiz_id={$row['quiz_id']}'><button class='btn btn-secondary'>{$row['category_name']}</button></a>";
					}
					else {
						echo "<button class='btn btn-danger' disabled>{$row['category_name']}</button></a>";
					}
					echo "<h6>{$row['remaining_attempts']} attempts left</h6>";
					echo "</div>";
				}
					
				echo "</div>";				
			?>
			
			<div class = "row justify-content-lg-center text">
				<div class = "cl-lg"><h4>Pick a quiz to show your skills </h4>  </div>
			</div>
		
		</div>
		
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	</body>
	

</html>
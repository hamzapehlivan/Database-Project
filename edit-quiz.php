<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
	 <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	 <link rel="stylesheet" href="css/navbar-style.css">
	  
	 
    <title>Admin >> Edit Quiz</title>
  </head>
	
	<!-- If admin sign out, direct her/him to admin login page -->
	<?php
		session_start();
      	if(!isset($_SESSION['admin_logged_in']))
			header("Location: admin-login.php");  
	?>
	
	<body style="background: linear-gradient(rgba(0, 0, 50, 0.5), rgba(0, 0, 50, 0.5)), url('image/background.jpg');
					background-size: cover; background-position: center;">
	
		<nav class="navbar navbar-expand-lg bg-light navbar-dark bg-dark">
			<a class="navbar-brand" href="#">CSCareer</a>

				<ul class="navbar-nav mr-auto d-print leftm">
					<li class="nav-item">
						<a class="nav-link" href="admin.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="admin-profile.php">Profile</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="#">Create / Edit Quizzes<span class="sr-only">(current)</span></a>
					</li>
				</ul>
				
				<ul class = "navbar-nav navbar-right d-print rightm">
					<li>
					<a class="nav-link" href = "logout.php"><svg class="bi bi-box-arrow-in-left" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" d="M7.854 11.354a.5.5 0 000-.708L5.207 8l2.647-2.646a.5.5 0 10-.708-.708l-3 3a.5.5 0 000 .708l3 3a.5.5 0 00.708 0z" clip-rule="evenodd"/>
					<path fill-rule="evenodd" d="M15 8a.5.5 0 00-.5-.5h-9a.5.5 0 000 1h9A.5.5 0 0015 8z" clip-rule="evenodd"/>
					<path fill-rule="evenodd" d="M2.5 14.5A1.5 1.5 0 011 13V3a1.5 1.5 0 011.5-1.5h8A1.5 1.5 0 0112 3v1.5a.5.5 0 01-1 0V3a.5.5 0 00-.5-.5h-8A.5.5 0 002 3v10a.5.5 0 00.5.5h8a.5.5 0 00.5-.5v-1.5a.5.5 0 011 0V13a1.5 1.5 0 01-1.5 1.5h-8z" clip-rule="evenodd"/>
					</svg>Log Out</a>
					 </li>
				</ul>
		</nav>
		
		
	<div class="container">
		<h2>CSCAREER</h2>
		<div class= "container"	 style = "background: rgba(211, 211, 211, 0.3);">
				<br><center><p><font size="6" color="#061465"><b>Edit a Quiz or Create a New One</b></font></p></center>
			
			<div class = "container">
				<br>
				<form action="displayQuiz.php" method="post">
					<div class="form-group">  
						<div class="input-group">
									<label for="quiz_title_get" style = "color:#FFFFFF; font-size: 20px;">Select the Quiz You Want to Edit:  </label>
										<select name="quiz_title_get">
											<?php
												require_once ('connect.php');
												$admin_id = $_SESSION['admin_id'];
												$sql = "select quiz_title from quiz where admin_id = '{$admin_id}'";
												$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));

												while ( $row = mysqli_fetch_array ($result) )
												{
													echo "<option value='{$row['quiz_title']}'>{$row['quiz_title']}</option>";
												}
											
											?>
										</select>
						</div>
						<br><br><br><br><br>
						<div class = "container" style="">
								<button type="submit" class="btn-warning btn-lg" formaction="editSelectedQuiz.php">Edit Selected Quiz</button>
						</div>
				  </div>
				</form>
			</div>
	
			<div class = "container" style="padding-left:50em; top:-10px;">
				<a href="quizProperty.php"><button type="button" class="btn-success btn-lg">Create New Quiz</button> </a>
			</div>	<br><br>
	 	</div>
					
	</div>		
			
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>
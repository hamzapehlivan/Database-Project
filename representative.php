<html lang="en">
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/login-register-style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	
	<style>
		body{
			margin: 0;
			padding: 0;
			background-image: linear-gradient(rgba(94,109,140,0.8), rgba(125,125,152,0.9)), url("css/images/background_login_register.jpg");
/*			background-image: linear-gradient(rgba(0, 0, 50, 0.5), rgba(0, 0, 50, 0.5)), url("css/images/background.png");*/
			background-size: cover;
			background-position: center;

		}
		.container{
			width: 90vw;
			height: 90vh;
		}
		h1{
			color: white;
			text-shadow: 1.5px 1.5px gray;
			font-size: 5vw;
			margin-top: 15vh;
			font-family: Berkshire Swash;
		}
		h3{
			color: white;
			padding-left: 1vw;
			top: 0; right: 0; bottom: 0; left: 0;
			font-family: Berkshire Swash;
			font-size: 2vw;
			font-style: italic;
			letter-spacing: 2px;
		}
		p{
			color: white;
			padding-left: 2vw;
			top: 0; right: 0; bottom: 0; left: 0;
			font-family: Berkshire Swash;
			font-size: 2vw;
			font-style: italic;
			letter-spacing: 2px;
		}
	</style>
	
	<title>Representative</title>
</head>
<body>
	<!-- If representative sign out, direct her/him to homepage -->
	<?php
		session_start();
      	if(!isset($_SESSION['representative_logged_in']))
			header("Location: index.php");
	?>
	<nav class="navbar navbar-inverse">
  		<div class="container-fluid">
    		<div class="navbar-header">
      			<a class="navbar-brand" href="index.php">CSCareer</a>
    		</div>
    		<ul class="nav navbar-nav">
      			<li class="active"><a href="">Home</a></li>
				<li><a href="representative-profile.php">Profile</a></li>
				<li><a href="view_quiz_category.php">View Quizzes</a></li>
      			<li><a href="sent_interview_request.php">Check Interview Requests</a></li>
    		</ul>
			<ul class="nav navbar-nav navbar-right">
      			<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
		    </ul>
  		</div>
	</nav>
	
	<div class="container">
 		<h1>Welcome to CSCareer!</h1>
		<div class="row">
			<p>CSCareer is a quiz-based hiring system for computer-science related departments. It will be implemented as the term project of CS353 Database Systems course. For further information and detailed user manual, you can look at the <a href="https://hamzapehlivan.github.io/Database-Project/" style='color:white; text-decoration: underline'>report page</a>.</p>
		</div>
		<h3>To start, you can view quiz results or check your interview requests!</h3>
	</div>
	
</body>
</html>
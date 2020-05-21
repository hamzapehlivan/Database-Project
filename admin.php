<html lang="en">
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/login-register-style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<title>Admin</title>
</head>
<body>
	<!-- If admin sign out, direct her/him to admin login page -->
	<?php
		session_start();
      	if(!isset($_SESSION['admin_logged_in']))
			header("Location: admin-login.php");  
	?>
	<nav class="navbar navbar-inverse">
  		<div class="container-fluid">
    		<div class="navbar-header">
      			<a class="navbar-brand">CSCareer</a>
    		</div>
    		<ul class="nav navbar-nav">
      			<li class="active"><a href="">Home</a></li>
				<li><a href="admin-profile.php">Profile</a></li>
				<li><a href="edit-quiz.php">Create / Edit Quizzes</a></li>
    		</ul>
			<ul class="nav navbar-nav navbar-right">
      			<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
		    </ul>
  		</div>
	</nav>
	
	<div class="container">

	</div>
	
</body>
</html>
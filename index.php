<html lang="en">
<head>
	<title>CSCareer</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	
	<style>
		body{
			margin: 0;
			padding: 0;
			background-image: linear-gradient(rgba(0, 0, 50, 0.5), rgba(0, 0, 50, 0.5)), url("css/images/background_login_register.jpg");
			background-size: cover;
			background-position: center;

		}
		.container{
			width: 90vw;
			height: 90vh;
		}
		h1{
			color: lightgray;
			text-shadow: 3.5px 3.5px gray;
			font-size: 10vw;
			margin-top: 25vh;
			padding-left: 17vw;
			font-family: Berkshire Swash;
		}
		p{
			color: lightgray;
			text-shadow: 1.5px 1.5px gray;
			padding-left: 20vw;
			top: 0; right: 0; bottom: 0; left: 0;
			font-family: Berkshire Swash;
			font-size: 2.5vw;
			font-style: italic;
			letter-spacing: 2px;
		}
	</style>

</head>
<body>
	<?php
	session_start();	
	session_unset();
	session_destroy();
	?>
	<nav class="navbar navbar-inverse">
  		<div class="container-fluid">
    		<div class="navbar-header">
      			<a class="navbar-brand">CSCareer</a>
    		</div>
    		<ul class="nav navbar-nav">
      			<li class="active"><a href="">Home</a></li>
      			<li class="dropdown">
        			<a class="dropdown-toggle" data-toggle="dropdown" href="#">Developer
        			<span class="caret"></span>
					</a>
        			<ul class="dropdown-menu">
          				<li><a href="developer-login.php">Sign In</a></li>
          				<li><a href="developer-register.php">Sign Up</a></li>
        			</ul>
      			</li>
      			<li class="dropdown">
        			<a class="dropdown-toggle" data-toggle="dropdown" href="#">Representative
        			<span class="caret"></span>
					</a>
        			<ul class="dropdown-menu">
          				<li><a href="representative-login.php">Sign In</a></li>
          				<li><a href="representative-register.php">Sign Up</a></li>
        			</ul>
      			</li>
      			<li><a href="about.php">About</a></li>
    		</ul>
  		</div>
	</nav>
  
	<div class="container">
 		<h1>CSCareer</h1>
		<div class="row">
			<p>For a new career beginning...</p>
		</div>
	</div>

</body>
</html>

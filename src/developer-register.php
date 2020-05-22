<html lang="en">
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/login-register-style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<title>Developer >> Register</title>
</head>
<body>
	<!-- If developer didn't sign out, direct her/him to developer homepage -->
	<?php
		session_start();
      	if(isset($_SESSION['developer_logged_in']))
			header("Location: developer.php");  
	?>
	<!-- Navigation Bar -->
	<nav class="navbar navbar-inverse">
  		<div class="container-fluid">
    		<div class="navbar-header">
      			<a class="navbar-brand">CSCareer</a>
    		</div>
    		<ul class="nav navbar-nav">
      			<li><a href="index.php">Home</a></li>
      			<li class="active" class="dropdown">
        			<a class="dropdown-toggle" data-toggle="dropdown" href="#">Developer
        			<span class="caret"></span>
					</a>
        			<ul class="dropdown-menu">
          				<li><a href="developer-login.php">Sign In</a></li>
          				<li class="active"><a href="">Sign Up</a></li>
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
				<li><a href="companies.php">Companies</a></li>
      			<li><a href="about.php">About</a></li>
    		</ul>
  		</div>
	</nav>
	
	<!-- Display error messages if there is any -->
	<?php
	if(isset($_SESSION['error']))
	{
	?>
	<div class="alert alert-danger fade in">
	    <a href="#" class="close" data-dismiss="alert">&times;</a>
	    <strong>Error!</strong> <?php echo $_SESSION['error']; ?>
	</div>
	<?php
	}
	unset($_SESSION['error']);
	?>
	
	<!-- Container which includes the form -->
	<div class="container">
		<div class="login-box">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-10 login-center">
				<h1 class="text-center">Developer Register Form</h1>
				<form action="developer-register-validation.php" method="post">
					<div class="form-group">
						<label class="label control-label">Full Name</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
							<input type="text" name="fullname" class="form-control" required>
						</div>
						<label class="label control-label">E-mail</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
							<input type="email" name="email" class="form-control" required>
						</div>
						<label class="label control-label">Password</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
							<input type="password" name="password" class="form-control" required>
						</div>
						<label class="label control-label">Confirm Password</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
						  <input type="password" name="confirmpassword" class="form-control" required>
						</div>
						<label class="label control-label">Phone</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span></span>
							<input name="phone" type="tel" class="form-control" placeholder="555-123-4567" size="10">
						</div>
						<button type="submit" class="btn btn-default">Register</button>
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>	
</body>
</html>
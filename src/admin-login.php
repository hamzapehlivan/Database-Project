<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/login-register-style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<title> Admin >> Login </title>
</head>
<body>
	
	<!-- If admin sign out, direct her/him to admin homepage -->
	<?php
		session_start();
      	if(isset($_SESSION['admin_logged_in']))
			header("Location: admin.php");  
	?>
	
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
	
	<div class="container">
		<div class="login-box">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8 login-center">
				<h1 class="text-center">Admin Login Form</h1>
				<form action="admin-login-validation.php" method="post">
					<div class="form-group">
						<label class="label control-label">E-mail</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
							<input name="email" type="email" class="form-control" placeholder="_______@_____" required>
						</div>
						<label class="label control-label">Password</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
							<input type="password" name="password" class="form-control" placeholder="**********" required>
						</div>					
						<button type="submit" class="btn btn-default">LOGIN</button>
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>	
</body>
</html>
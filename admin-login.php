<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/login-register-style.css">
	<title> Admin >> Login </title>
</head>
<body>
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
						<a href="#"><div class="btn btn-default">LOGIN</div></a>
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>	
</body>
</html>
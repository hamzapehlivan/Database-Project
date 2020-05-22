<html lang="en">
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/developer-profile-style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<title>Admin >> Profile</title>

	
</head>
<body>
	<!-- If admin sign out, direct her/him to admin login page -->
	<?php
		session_start();
      	if(!isset($_SESSION['admin_logged_in']))
			header("Location: admin-login.php");  
	?>	
	<!-- Take admin's info -->
	<?php
	require_once ('connect.php');
	
	$fullname = $_SESSION['fullname'];
	$email = $_SESSION['email'];
	$admin_id = $_SESSION['admin_id'];
	
	/********************************* 
	* Take informations from database
	**********************************/
	
	// Take phone number
	$phone_query = " select phone from user where user_id = '$admin_id' ";
	$phone_query_result = mysqli_query($conn, $phone_query);
	$phone = mysqli_fetch_array($phone_query_result); 
	
	if( !is_null(  $phone ) ){
		$phone = $phone[0];
	} else {
		$phone = "";
	}

		
	?>
	
	<nav class="navbar navbar-inverse">
  		<div class="container-fluid">
    		<div class="navbar-header">
      			<a class="navbar-brand">CSCareer</a>
    		</div>
    		<ul class="nav navbar-nav">
      			<li><a href="admin.php">Home</a></li>
				<li class="active"><a href="">Profile</a></li>
				<li><a href="edit-quiz.php">Create / Edit Quizzes</a></li>
    		</ul>
			<ul class="nav navbar-nav navbar-right">
      			<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
		    </ul>
  		</div>
	</nav>
	
	<div class="container">
    	<h1>Profile</h1>
  		<hr>
      		<!-- Admin Icon / Name / Mail -->
      		<div class="col-md-10">
        		<div class="text-center">
					<img src="css/images/admin-icon.png" class="avatar" alt="avatar" style="width:150px">
					<html><h6><?php echo $fullname;?></h6></html>
					<html><h6><?php echo $email;?></h6></html>
        		</div>
      		</div>
      
      		<!-- Change Password -->
      		<div class="col-md-10 change-password">
				<h3>Change Password</h3>
        
        	  	<form class="form-horizontal" role="form" action="change-password.php" method="post">
					<div class="form-group">
						<label class="col-lg-3 control-label">Old password:</label>
						<div class="col-lg-8">
							<input name="oldPassword" type="password" required="required" class="form-control">
						</div>
					</div>

					<div class="form-group">
					  <label class="col-lg-3 control-label">New Password:</label>
						<div class="col-lg-8">
							<input name="newPassword" type="password" required="required" class="form-control">
						</div>
					</div>

					<div class="form-group">
						<label class="col-lg-3 control-label">Confirm Password:</label>
						<div class="col-lg-8">
							<input name="confirmPassword" type="password" required="required" class="form-control">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-8">
							<button type="submit" class="btn btn-primary">Save Changes</button>
							<span></span>
							<input type="reset" class="btn btn-default" value="Cancel">
						</div>
					</div>
        		</form>
				
				<!-- Display error messages for changing password process if there is any -->
				<?php
				if(isset($_SESSION['change_password_message']))
				{
				?>
				<div class="alert alert-info alert-dismissable">
        			<a class="panel-close close" data-dismiss="alert">×</a> 
          			<i class="fa fa-coffee"></i>
          			<strong><?php echo $_SESSION['change_password_message']; ?></strong>
        		</div>
				<?php
				}
				unset($_SESSION['change_password_message']);
				?>
							
      		</div>
		
			<!-- General Information -->
      		<div class="col-md-10 general-info">
       			
				<h3>Change Phone Number</h3>
        
        	  	<form class="form-horizontal" role="form" action="admin-check-general-info.php" method="post">
					<div class="form-group">
						<label class="col-lg-3 control-label">Phone Number:</label>
						<div class="col-lg-8">
							<input name="phoneNumber" type="text" class="form-control" value="<?php echo $phone; ?>">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-8">
							<button type="submit" class="btn btn-primary">Save Changes</button>
							<span></span>
							<input type="reset" class="btn btn-default" value="Cancel">
						</div>
					</div>
        		</form>
				
				<!-- Display messages for changing general info process if there is any -->
				<?php
				if(isset($_SESSION['general_info_message']))
				{
				?>
				<div class="alert alert-info alert-dismissable">
        			<a class="panel-close close" data-dismiss="alert">×</a> 
          			<i class="fa fa-coffee"></i>
          			<strong><?php echo $_SESSION['general_info_message']; ?></strong>
        		</div>
				<?php
				}
				unset($_SESSION['general_info_message']);
				?>
      		</div>
		
		<hr>
	</div>
	
</body>
</html>
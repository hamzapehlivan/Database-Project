<html lang="en">
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/developer-profile-style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<title>Representative >> Profile</title>

	
</head>
<body>
	<!-- If representative sign out, direct her/him to homepage -->
	<?php
		session_start();
      	if(!isset($_SESSION['representative_logged_in']))
			header("Location: index.php");  
	?>	
	<!-- Take developer's info -->
	<?php
	require_once ('connect.php');
	
	$fullname = $_SESSION['fullname'];
	$email = $_SESSION['email'];
	$representative_id = $_SESSION['representative_id'];
	$company_name = $_SESSION['company_name'];
	
	/********************************* 
	* Take informations from database
	**********************************/
	
	// Take phone number
	$phone_query = " select phone from user where user_id = '$representative_id' ";
	$phone_query_result = mysqli_query($conn, $phone_query);
	$phone = mysqli_fetch_array($phone_query_result); 
	$phone = $phone[0];
	if( $phone == "null" )
		$phone = "";
	
	// Take info from profile table
	$profile_query = " select * from representative where representative_id = '$representative_id' ";
	$profile_query_result = mysqli_query($conn, $profile_query);
	$profile_info = mysqli_fetch_array($profile_query_result, MYSQLI_ASSOC);
	
	// Take subscription ype
	$subscription_type = $profile_info['subscription_type'];
	
	// Take title link
	$title = $profile_info['title'];
	
	?>
	
	<nav class="navbar navbar-inverse">
  		<div class="container-fluid">
    		<div class="navbar-header">
      			<a class="navbar-brand">CSCareer</a>
    		</div>
    		<ul class="nav navbar-nav">
      			<li><a href="representative.php">Home</a></li>
				<li class="active"><a href="">Profile</a></li>
				<li><a href="">Attempt Quiz</a></li>
      			<li><a href="">Quiz Results</a></li>
      			<li><a href="">Interview Requests</a></li>
    		</ul>
			<ul class="nav navbar-nav navbar-right">
      			<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
		    </ul>
  		</div>
	</nav>
	
	<div class="container">
    	<h1>Profile</h1>
  		<hr>
      		<!-- Developer Icon / Name / Mail -->
      		<div class="col-md-10">
        		<div class="text-center">
					<img src="css/images/company-icon.png" class="avatar" alt="avatar" style="width:150px">
					<html><h6><em>The representative of <?php echo $company_name;?></em></h6></html>
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
       			
				<h3>General Information</h3>
        
        	  	<form class="form-horizontal" role="form" action="representative-check-general-info.php" method="post">
					<div class="form-group">
						<label class="col-lg-3 control-label">Phone Number:</label>
						<div class="col-lg-8">
							<input name="phoneNumber" type="text" class="form-control" value="<?php echo $phone; ?>">
						</div>
					</div>

					<div class="form-group">
						<label class="col-lg-3 control-label">Title:</label>
						<div class="col-lg-8">
							<input name="title" type="text" required="required" class="form-control" value="<?php echo $title; ?>" >
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-lg-3 control-label">Subscription Type:</label>
						<div class="col-lg-8">
						  	<select name="subscription_type" class="form-control" required>
								<?php
									if( $subscription_type == 'MONTH' ){
										echo "<option selected>MONTH</option>";
										echo "<option>YEAR</option>";
									} else {
										echo "<option>MONTH</option>";
										echo "<option selected>YEAR</option>";
									} 
								?>
							</select>
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
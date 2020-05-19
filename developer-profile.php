<html lang="en">
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/developer-profile-style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<title>Developer >> Profile</title>

	
</head>
<body>
	<!-- If developer sign out, direct her/him to homepage -->
	<?php
		session_start();
      	if(!isset($_SESSION['developer_logged_in']))
			header("Location: index.php");  
	?>	
	<!-- Take developer's info -->
	<?php
	require_once ('connect.php');
	
	$fullname = $_SESSION['fullname'];
	$email = $_SESSION['email'];
	$developer_id = $_SESSION['developer_id'];
	$profile_id = $_SESSION['profile_id'];
	
	/********************************* 
	* Take informations from database
	**********************************/
	
	// Take phone number
	$phone_query = " select phone from user where user_id = '$developer_id' ";
	$phone_query_result = mysqli_query($conn, $phone_query);
	$phone = mysqli_fetch_array($phone_query_result); 
	$phone = $phone[0];
	if( $phone == "null" )
		$phone = "";
	
	// Take info from profile table
	$profile_query = " select * from profile where profile_id = '$profile_id' ";
	$profile_query_result = mysqli_query($conn, $profile_query);
	$profile_info = mysqli_fetch_array($profile_query_result, MYSQLI_ASSOC);
	
	// Take linkedin link
	$linkedin_link = $profile_info['linkedin_link'];
	if( $linkedin_link == "null" )
		$linkedin_link = "";
	
	// Take github link
	$github_link = $profile_info['github_link'];
	if( $github_link == "null" )
		$github_link = "";
	
	// Take cv link
	$cv_link = $profile_info['cv_link'];
	if( $cv_link == "null" )
		$cv_link = "";
	
	// Take experienced years
	$experienced_years = $profile_info['experienced_years'];
	if( $experienced_years == "null" )
		$experienced_years = 0;
	
	// Take status
	$status = $profile_info['status'];
	
	// Take role preferences
	$role_preferences = $profile_info['role_preferences'];
	if( $role_preferences == "null" )
		$role_preferences = "";
	
	// Take prefered working locations
	$select_current_cities = " select city from preferredworkinglocations where profile_id = '$profile_id' ";
	$city_result = mysqli_query($conn, $select_current_cities);
	$current_cities = Array();
	while ($row = mysqli_fetch_array($city_result, MYSQLI_ASSOC)) {
		array_push( $current_cities, $row['city'] );
	}

	// Take education info
	$education_query = " select * from educationinfo where profile_id = '$profile_id' ";
	$education_query_result = mysqli_query($conn, $education_query);
	
	$institution_name = Array();
	$start_date = Array();
	$end_date = Array();
	$isGraduated = Array();
	$cgpa = Array();
	$description = Array();
	while ($row = mysqli_fetch_array($education_query_result, MYSQLI_ASSOC)) {
		array_push( $institution_name, $row['institution_name'] );
		array_push( $start_date, $row['start_date'] );
		array_push( $end_date, $row['end_date'] );
		array_push( $isGraduated, $row['isGraduated'] );
		array_push( $cgpa, $row['cgpa'] );
		array_push( $description, $row['description'] );
	}
	
	// Take work info
	$work_query = " select * from workinfo where profile_id = '$profile_id' ";
	$work_query_result = mysqli_query($conn, $work_query);
	
	$company_name = Array();
	$start_date_work = Array();
	$end_date_work = Array();
	$title = Array();
	$description_work = Array();
	while ($row = mysqli_fetch_array($work_query_result, MYSQLI_ASSOC)) {
		array_push( $company_name, $row['company_name'] );
		array_push( $start_date_work, $row['start_date'] );
		array_push( $end_date_work, $row['end_date'] );
		array_push( $title, $row['title'] );
		array_push( $description_work, $row['description'] );
	}
	
	// Take project info
	$project_query = " select * from projectinfo where profile_id = '$profile_id' ";
	$project_query_result = mysqli_query($conn, $project_query);
	
	$project_title = Array();
	$start_date_project = Array();
	$end_date_project = Array();
	$project_type = Array();
	$description_project = Array();
	$project_link = Array();
	while ($row = mysqli_fetch_array($project_query_result, MYSQLI_ASSOC)) {
		array_push( $project_title, $row['project_title'] );
		array_push( $start_date_project, $row['start_date'] );
		array_push( $end_date_project, $row['end_date'] );
		array_push( $project_type, $row['project_type'] );
		array_push( $description_project, $row['description'] );
		array_push( $project_link, $row['project_link'] );
	}
	
	?>
	
	<nav class="navbar navbar-inverse">
  		<div class="container-fluid">
    		<div class="navbar-header">
      			<a class="navbar-brand">CSCareer</a>
    		</div>
    		<ul class="nav navbar-nav">
      			<li><a href="developer.php">Home</a></li>
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
					<img src="css/images/developer_icon.png" class="avatar" alt="avatar" style="width:150px">
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
        
        	  	<form class="form-horizontal" role="form" action="developer-check-general-info.php" method="post">
					<div class="form-group">
						<label class="col-lg-3 control-label">Phone Number:</label>
						<div class="col-lg-8">
							<input name="phoneNumber" type="text" class="form-control" value="<?php echo $phone; ?>">
						</div>
					</div>

					<div class="form-group">
						<label class="col-lg-3 control-label">LinkedIn Link:</label>
						<div class="col-lg-8">
							<input name="linkedinLink" class="form-control" type="text" value="<?php echo $linkedin_link; ?>" >
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-lg-3 control-label">Github Link:</label>
						<div class="col-lg-8">
							<input name="githubLink" class="form-control" type="text" value="<?php echo $github_link; ?>" >
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-lg-3 control-label">CV Link:</label>
						<div class="col-lg-8">
							<input name="cvLink" class="form-control" type="text" value="<?php echo $cv_link; ?>">
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-lg-3 control-label">Experienced Years:</label>
						<div class="col-lg-8">
							<input name="experiencedYears" class="form-control" type="number" value="<?php echo $experienced_years; ?>">
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-lg-3 control-label">Preferred Working Locations:</label>
						<div class="col-lg-8">
						  	<select name="preferredWorkingLocations[]" multiple="MULTIPLE" class="form-control">
							    <?php
								$cities = Array( "Adana", "Adıyaman", "Afyonkarahisar", "Ağrı", "Aksaray", "Amasya", "Ankara", "Antalya", "Ardahan", "Artvin", "Aydın", "Balıkesir", "Bartın", "Batman", "Bayburt", "Bilecik", "Bingöl", "Bitlis", "Bolu", "Burdur", "Bursa", "Çanakkale", "Çankırı", "Çorum", "Denizli", "Diyarbakır", "Düzce", "Edirne", "Elazığ", "Erzincan", "Erzurum", "Eskişehir", "Gaziantep", "Giresun", "Gümüşhane", "Hakkâri", "Hatay", "Iğdır", "Isparta", "İstanbul", "İzmir", "Kahramanmaraş", "Karabük", "Karaman", "Kars", "Kastamonu", "Kayseri", "Kilis", "Kırıkkale", "Kırklareli", "Kırşehir", "Kocaeli", "Konya", "Kütahya", "Malatya", "Manisa", "Mardin", "Mersin", "Muğla", "Muş", "Nevşehir", "Niğde", "Ordu", "Osmaniye", "Rize", "Sakarya", "Samsun", "Şanlıurfa", "Siirt", "Sinop", "Sivas", "Şırnak", "Tekirdağ", "Tokat", "Trabzon", "Tunceli", "Uşak", "Van", "Yalova", "Yozgat", "Zonguldak");
								foreach( $cities as $city){
									if( in_array($city, $current_cities ) ){
										echo "<option selected>" .$city. "</option>";
									} else {
										echo "<option>" .$city. "</option>";										
									}
								}
								?>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-lg-3 control-label">Role Preferences:</label>
						<div class="col-lg-8">
							<input name="rolePreferences" class="form-control" type="text" value="<?php echo $role_preferences; ?>">
						</div>
					</div>
										
					<div class="form-group">
					  <label class="col-lg-3 control-label">I am open to job opportunities:</label>
						<div class="col-lg-1">
							<?php
							if( $status == 1){
								echo "<input name=\"status\" type=\"checkbox\" class=\"form-control\" checked=\"CHECKED\">";
							} else {
								echo "<input name=\"status\" type=\"checkbox\" class=\"form-control\">";
							}
							?>
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
		
			<!-- Education Information -->
      		<div class="col-md-10 education-info">
				
				<h3>Education Information</h3>
				
				<!-- Display messages for updating education info process if there is any -->
				<?php
				if(isset($_SESSION['edit_education_message']))
				{
				?>
				<div class="alert alert-info alert-dismissable">
        			<a class="panel-close close" data-dismiss="alert">×</a> 
          			<i class="fa fa-coffee"></i>
          			<strong><?php echo $_SESSION['edit_education_message']; ?></strong>
        		</div>
				<?php
				}
				unset($_SESSION['edit_education_message']);
				?>
				
				<!-- Display messages for adding education info process if there is any -->
				<?php
				if(isset($_SESSION['add_education_message']))
				{
				?>
				<div class="alert alert-info alert-dismissable">
        			<a class="panel-close close" data-dismiss="alert">×</a> 
          			<i class="fa fa-coffee"></i>
          			<strong><?php echo $_SESSION['add_education_message']; ?></strong>
        		</div>
				<?php
				}
				unset($_SESSION['add_education_message']);
				?>
				
				<?php
					$i = 0;
					foreach( $institution_name as $institution ){
						//action=\"\" class=\"form-group\" method=\"post\"
						echo "<div class=\"col-md-10\">";
						
						echo "<h3></h3>";
						echo "<form id=\"additional-data\" class=\"form-horizontal\" role=\"form\" action=\"developer-edit-education-info.php\" method=\"post\">";
						
						echo "<div class=\"form-group\">";
						echo "<label class=\"col-lg-3 control-label\" id=\"mini-info\">Institution:</label>";
						echo "<div class=\"col-lg-8\">";
						echo "<input name=\"institution_name\" id=\"mini-info-readonly\" type=\"text\" readonly class=\"form-control\" value=\"$institution\">";
						echo "</div>";
						echo "</div>";
						
						echo "<div class=\"form-group\">";
						echo "<label class=\"col-lg-3 control-label\" id=\"mini-info\">Start Date:</label>";
						echo "<div class=\"col-lg-8\">";
						echo "<input name=\"start_date\" id=\"mini-info-readonly\" type=\"date\" readonly class=\"form-control\" value=\"$start_date[$i]\">";
						echo "</div>";
						echo "</div>";
						
						echo "<div class=\"form-group\">";
						echo "<label class=\"col-lg-3 control-label\" id=\"mini-info\">End Date:</label>";
						echo "<div class=\"col-lg-8\">";
						echo "<input name=\"end_date\" id=\"mini-info\" type=\"date\" class=\"form-control\" value=\"$end_date[$i]\">";
						echo "</div>";
						echo "</div>";
						
						echo "<div class=\"form-group\">";
						echo "<label class=\"col-lg-3 control-label\" id=\"mini-info\">Graduation Status:</label>";
						echo "<div class=\"col-lg-1\">";
						if( $isGraduated[$i] == 1){
							echo "<input name=\"isGraduated\" id=\"mini-info\" type=\"checkbox\" class=\"form-control\" checked=\"CHECKED\">";	
						} else {
							echo "<input name=\"isGraduated\" id=\"mini-info\" type=\"checkbox\" class=\"form-control\">";
						}
						echo "</div>";
						echo "</div>";
						
						echo "<div class=\"form-group\">";
						echo "<label class=\"col-lg-3 control-label\" id=\"mini-info\">CGPA:</label>";
						echo "<div class=\"col-lg-8\">";
						echo "<input name=\"cgpa\" type=\"text\" id=\"mini-info\" class=\"form-control\" value=\"$cgpa[$i]\">";
						echo "</div>";
						echo "</div>";
						
						echo "<div class=\"form-group\">";
						echo "<label class=\"col-lg-3 control-label\" id=\"mini-info\">Description:</label>";
						echo "<div class=\"col-lg-8\">";
						echo "<input name=\"description\" id=\"mini-info\" type=\"text\" class=\"form-control\" value=\"$description[$i]\">";
						echo "</div>";
						echo "</div>";
						
						
						echo "<button name=\"action\" value=\"delete\" class=\"btn btn-danger\" style=\"margin-right: 46vh\">Remove <span class=\"glyphicon glyphicon-remove\"></span>";
						echo "<span></span>";
						echo "<button name=\"action\" value=\"update\" class=\"btn btn-primary\">Save Changes <span class=\"glyphicon glyphicon-edit\"></span></button>";
						
						echo "</form>";
						
						echo "<h3></h3>";
						echo "</div>";
						echo "<br /><br />";
						
						
						$i ++;
						
					}
				?>
				
				
				<div class="form-group">
					<label class="col-md-3 control-label"></label>
					<div class="col-md-8">
						<button class="btn btn-primary" data-modal="addEducationModal">Add Education Info</button>
					</div>
				</div>
				
				<br /><br />
				
				
				<div id="addEducationModal" class="modal">
					<div class=modal-content>
						<div class="contact-form">
          					<a class="close">&times;</a>
							<h3>Add New Education Information</h3>
							<form class="form-horizontal" role="form" action="developer-add-education-info.php" method="post">
								<div class="form-group">
									<label class="col-lg-3 control-label">Institution Name:</label>
									<div class="col-lg-8">
										<input name="institution_name" type="text" required="required" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-3 control-label">Start Date:</label>
									<div class="col-lg-8">
										<input name="start_date" type="date" required="required" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-3 control-label">End Date:</label>
									<div class="col-lg-8">
										<input name="end_date" type="date" class="form-control">
									</div>
								</div>

								<div class="form-group">
								  <label class="col-lg-3 control-label">Graduated:</label>
									<div class="col-lg-1">
										<input name="isGraduted" type="checkbox" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-3 control-label">CGPA:</label>
									<div class="col-lg-8">
										<input name="cgpa" type="text" required="required" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-3 control-label">Description:</label>
									<div class="col-lg-8">
										<input name="description" type="text" class="form-control">
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
						</div>
					</div>
				</div>
				
      		</div>
			
			<!-- Work Information -->
      		<div class="col-md-10 education-info">
				
				<h3>Work Information</h3>
				
				<!-- Display messages for updating work info process if there is any -->
				<?php
				if(isset($_SESSION['edit_work_message']))
				{
				?>
				<div class="alert alert-info alert-dismissable">
        			<a class="panel-close close" data-dismiss="alert">×</a> 
          			<i class="fa fa-coffee"></i>
          			<strong><?php echo $_SESSION['edit_work_message']; ?></strong>
        		</div>
				<?php
				}
				unset($_SESSION['edit_work_message']);
				?>
				
				<!-- Display messages for adding work info process if there is any -->
				<?php
				if(isset($_SESSION['edit_work_message']))
				{
				?>
				<div class="alert alert-info alert-dismissable">
        			<a class="panel-close close" data-dismiss="alert">×</a> 
          			<i class="fa fa-coffee"></i>
          			<strong><?php echo $_SESSION['add_work_message']; ?></strong>
        		</div>
				<?php
				}
				unset($_SESSION['add_work_message']);
				?>
				
				<?php
					$i = 0;
					foreach( $company_name as $company ){
						//action=\"\" class=\"form-group\" method=\"post\"
						echo "<div class=\"col-md-10\">";
						
						echo "<h3></h3>";
						echo "<form id=\"additional-data\" class=\"form-horizontal\" role=\"form\" action=\"developer-edit-work-info.php\" method=\"post\">";
						
						echo "<div class=\"form-group\">";
						echo "<label class=\"col-lg-3 control-label\" id=\"mini-info\">Company:</label>";
						echo "<div class=\"col-lg-8\">";
						echo "<input name=\"company_name\" id=\"mini-info-readonly\" type=\"text\" readonly class=\"form-control\" value=\"$company\">";
						echo "</div>";
						echo "</div>";
						
						echo "<div class=\"form-group\">";
						echo "<label class=\"col-lg-3 control-label\" id=\"mini-info\">Start Date:</label>";
						echo "<div class=\"col-lg-8\">";
						echo "<input name=\"start_date\" id=\"mini-info-readonly\" type=\"date\" readonly class=\"form-control\" value=\"$start_date_work[$i]\">";
						echo "</div>";
						echo "</div>";
						
						echo "<div class=\"form-group\">";
						echo "<label class=\"col-lg-3 control-label\" id=\"mini-info\">End Date:</label>";
						echo "<div class=\"col-lg-8\">";
						echo "<input name=\"end_date\" id=\"mini-info\" type=\"date\" class=\"form-control\" value=\"$end_date_work[$i]\">";
						echo "</div>";
						echo "</div>";
						
						echo "<div class=\"form-group\">";
						echo "<label class=\"col-lg-3 control-label\" id=\"mini-info\">Title:</label>";
						echo "<div class=\"col-lg-8\">";
						echo "<input name=\"title\" id=\"mini-info\" type=\"text\" class=\"form-control\" value=\"$title[$i]\">";
						echo "</div>";
						echo "</div>";
						
						echo "<div class=\"form-group\">";
						echo "<label class=\"col-lg-3 control-label\" id=\"mini-info\">Description:</label>";
						echo "<div class=\"col-lg-8\">";
						echo "<input name=\"description\" id=\"mini-info\" type=\"text\" class=\"form-control\" value=\"$description_work[$i]\">";
						echo "</div>";
						echo "</div>";
						
						
						echo "<button name=\"action\" value=\"delete\" class=\"btn btn-danger\" style=\"margin-right: 46vh\">Remove <span class=\"glyphicon glyphicon-remove\"></span>";
						echo "<span></span>";
						echo "<button name=\"action\" value=\"update\" class=\"btn btn-primary\">Save Changes <span class=\"glyphicon glyphicon-edit\"></span></button>";
						
						echo "</form>";
						
						echo "<h3></h3>";
						echo "</div>";
						echo "<br /><br />";
						
						
						$i ++;
						
					}
				?>
				
				
				<div class="form-group">
					<label class="col-md-3 control-label"></label>
					<div class="col-md-8">
						<button class="btn btn-primary" data-modal="addWorkModal">Add Work Info</button>
					</div>
				</div>
				
				<br /><br />
				
				
				<div id="addWorkModal" class="modal">
					<div class=modal-content>
						<div class="contact-form">
          					<a class="close">&times;</a>
							<h3>Add New Work Information</h3>
							<form class="form-horizontal" role="form" action="developer-add-work-info.php" method="post">
								<div class="form-group">
									<label class="col-lg-3 control-label">Company Name:</label>
									<div class="col-lg-8">
										<input name="company_name" type="text" required="required" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-3 control-label">Start Date:</label>
									<div class="col-lg-8">
										<input name="start_date" type="date" required="required" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-3 control-label">End Date:</label>
									<div class="col-lg-8">
										<input name="end_date" type="date" class="form-control">
									</div>
								</div>

								<div class="form-group">
								  <label class="col-lg-3 control-label">Title:</label>
									<div class="col-lg-8">
										<input name="title" type="text" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-3 control-label">Description:</label>
									<div class="col-lg-8">
										<input name="description" type="text" class="form-control">
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
						</div>
					</div>
				</div>
				
      		</div>
			
			<!-- Project Information -->
      		<div class="col-md-10 education-info">
				
				<h3>Project Information</h3>
				
				<!-- Display messages for updating project info process if there is any -->
				<?php
				if(isset($_SESSION['edit_project_message']))
				{
				?>
				<div class="alert alert-info alert-dismissable">
        			<a class="panel-close close" data-dismiss="alert">×</a> 
          			<i class="fa fa-coffee"></i>
          			<strong><?php echo $_SESSION['edit_project_message']; ?></strong>
        		</div>
				<?php
				}
				unset($_SESSION['edit_project_message']);
				?>
				
				<!-- Display messages for adding project info process if there is any -->
				<?php
				if(isset($_SESSION['edit_project_message']))
				{
				?>
				<div class="alert alert-info alert-dismissable">
        			<a class="panel-close close" data-dismiss="alert">×</a> 
          			<i class="fa fa-coffee"></i>
          			<strong><?php echo $_SESSION['edit_project_message']; ?></strong>
        		</div>
				<?php
				}
				unset($_SESSION['edit_project_message']);
				?>
				
				<?php
					$i = 0;
					foreach( $project_title as $project ){
						//action=\"\" class=\"form-group\" method=\"post\"
						echo "<div class=\"col-md-10\">";
						
						echo "<h3></h3>";
						echo "<form id=\"additional-data\" class=\"form-horizontal\" role=\"form\" action=\"developer-edit-project-info.php\" method=\"post\">";
						
						echo "<div class=\"form-group\">";
						echo "<label class=\"col-lg-3 control-label\" id=\"mini-info\">Project Title:</label>";
						echo "<div class=\"col-lg-8\">";
						echo "<input name=\"project_title\" id=\"mini-info-readonly\" type=\"text\" readonly class=\"form-control\" value=\"$project\">";
						echo "</div>";
						echo "</div>";
						
						echo "<div class=\"form-group\">";
						echo "<label class=\"col-lg-3 control-label\" id=\"mini-info\">Start Date:</label>";
						echo "<div class=\"col-lg-8\">";
						echo "<input name=\"start_date\" id=\"mini-info-readonly\" type=\"date\" readonly class=\"form-control\" value=\"$start_date_project[$i]\">";
						echo "</div>";
						echo "</div>";
						
						echo "<div class=\"form-group\">";
						echo "<label class=\"col-lg-3 control-label\" id=\"mini-info\">End Date:</label>";
						echo "<div class=\"col-lg-8\">";
						echo "<input name=\"end_date\" id=\"mini-info\" type=\"date\" class=\"form-control\" value=\"$end_date_project[$i]\">";
						echo "</div>";
						echo "</div>";
						
						echo "<div class=\"form-group\">";
						echo "<label class=\"col-lg-3 control-label\" id=\"mini-info\">Project Type:</label>";
						echo "<div class=\"col-lg-8\">";
						echo "<input name=\"project_type\" id=\"mini-info\" type=\"text\" class=\"form-control\" value=\"$project_type[$i]\">";
						echo "</div>";
						echo "</div>";
						
						echo "<div class=\"form-group\">";
						echo "<label class=\"col-lg-3 control-label\" id=\"mini-info\">Description:</label>";
						echo "<div class=\"col-lg-8\">";
						echo "<input name=\"description\" id=\"mini-info\" type=\"text\" class=\"form-control\" value=\"$description_project[$i]\">";
						echo "</div>";
						echo "</div>";
						
						echo "<div class=\"form-group\">";
						echo "<label class=\"col-lg-3 control-label\" id=\"mini-info\">Project Link:</label>";
						echo "<div class=\"col-lg-8\">";
						echo "<input name=\"project_link\" id=\"mini-info\" type=\"text\" class=\"form-control\" value=\"$project_link[$i]\">";
						echo "</div>";
						echo "</div>";
						
						
						echo "<button name=\"action\" value=\"delete\" class=\"btn btn-danger\" style=\"margin-right: 46vh\">Remove <span class=\"glyphicon glyphicon-remove\"></span>";
						echo "<span></span>";
						echo "<button name=\"action\" value=\"update\" class=\"btn btn-primary\">Save Changes <span class=\"glyphicon glyphicon-edit\"></span></button>";
						
						echo "</form>";
						
						echo "<h3></h3>";
						echo "</div>";
						echo "<br /><br />";
						
						
						$i ++;
						
					}
				?>
				
				
				<div class="form-group">
					<label class="col-md-3 control-label"></label>
					<div class="col-md-8">
						<button class="btn btn-primary" data-modal="addProjectModal">Add Project Info</button>
					</div>
				</div>
				
				<br /><br />
				
				
				<div id="addProjectModal" class="modal">
					<div class=modal-content>
						<div class="contact-form">
          					<a class="close">&times;</a>
							<h3>Add New Project Information</h3>
							<form class="form-horizontal" role="form" action="developer-add-project-info.php" method="post">
								<div class="form-group">
									<label class="col-lg-3 control-label">Project Title:</label>
									<div class="col-lg-8">
										<input name="project_title" type="text" required="required" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-3 control-label">Start Date:</label>
									<div class="col-lg-8">
										<input name="start_date" type="date" required="required" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-3 control-label">End Date:</label>
									<div class="col-lg-8">
										<input name="end_date" type="date" class="form-control">
									</div>
								</div>

								<div class="form-group">
								  <label class="col-lg-3 control-label">Project Type:</label>
									<div class="col-lg-8">
										<input name="project_type" type="text" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-3 control-label">Description:</label>
									<div class="col-lg-8">
										<input name="description" type="text" class="form-control">
									</div>
								</div>
								
								<div class="form-group">
								  <label class="col-lg-3 control-label">Project Link:</label>
									<div class="col-lg-8">
										<input name="project_link" type="text" class="form-control">
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
						</div>
					</div>
				</div>
			
      		</div>
		
		
		<hr>
	</div>
	
	<script>
		
    	var modalBtns = [...document.querySelectorAll(".btn-primary")];
      	modalBtns.forEach(function(btn){
        	btn.onclick = function() {
        		var modal = btn.getAttribute('data-modal');
        	  	document.getElementById(modal).style.display = "block";
        	}
      	});
      
      	var closeBtns = [...document.querySelectorAll(".close")];
      	closeBtns.forEach(function(btn){
        	btn.onclick = function() {
          		var modal = btn.closest('.modal');
          		modal.style.display = "none";
        	}
      	});
      
      	window.onclick = function(event) {
        	if (event.target.className === "modal") {
          		event.target.style.display = "none";
        	}
      	}
		
    </script>
	
</body>
</html>
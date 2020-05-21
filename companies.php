<html lang="en">
<head>
	<title>Companies</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	
	
	<style>
		body{
			margin: 0;
			padding: 0;
			background-image: linear-gradient(rgba(94,109,140,0.8), rgba(125,125,152,0.9)), url("css/images/background_login_register.jpg");
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
			font-size: 3vw;
			margin-top: 3vh;
			font-family: Berkshire Swash;
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

		/* Style the search field */
		form.example input[type=text] {
			padding: 10px;
		  	font-size: 17px;
		  	border: 1px solid grey;
		  	float: left;
		  	width: 75%;
			height: 40px;
		  	background: #f1f1f1;
		}

		/* Style the submit button */
		form.example button {
  			float: left;
		  	width: 25%;
			height: 40px;
		  	padding: 10px;
		  	background: #2196F3;
		  	color: white;
		  	font-size: 13px;
		  	border: 1px solid grey;
		  	border-left: none; /* Prevent double borders */
		  	cursor: pointer;
		}

		form.example button:hover {
  			background: #0b7dda;
		}

		/* Clear floats */
		form.example::after {
  			content: "";
  			clear: both;
  			display: table;
		}
		
		.input-group{
			float: right;
		}
		
	</style>

</head>
<body>
	<?php
		require_once ('connect.php');
		session_start();

		// return all companies from database
		$query = "select company_name, website from company ";
		$result = mysqli_query($conn, $query);
		$companies = Array();
		$websites = Array();
		while ($rows = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        	array_push( $companies, $rows['company_name'] );
			array_push( $websites, $rows['website'] );
		}

		// take searched companies
		$isSearched = $_SESSION['isSearched'];
		$possible_companies = $_SESSION['possible_companies'];
		$companies_website = $_SESSION['companies_website'];
	?>
	
	<nav class="navbar navbar-inverse">
  		<div class="container-fluid">
    		<div class="navbar-header">
      			<a class="navbar-brand">CSCareer</a>
    		</div>
    		<ul class="nav navbar-nav">
      			<li><a href="index.php">Home</a></li>
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
				<li class="active"><a href="">Companies</a></li>
      			<li><a href="about.php">About</a></li>
    		</ul>
  		</div>
	</nav>
  
	<div class="container">
		<div class="input-group">
			<form class="example" method="post" action="search-companies.php">
  				<input type="text" placeholder="Search for companies" name="search">
				<button type="submit">SEARCH</button>
			</form>				
		</div>
		
		<h1>Contracted Companies</h1>
  		<hr>
    	<div class="row">
			<?php
			if( ($isSearched == true) && empty( $possible_companies ) ){
				echo "<p>Searched Company Not Found</p>";
			} else if( $isSearched == false ){
				$i = 0;
				foreach( $companies as $company){
					echo "<p><a href='$websites[$i]' style='color:white'> $company </a></p>";
					$i ++;
				}				
			} else {
				$i = 0;
				foreach( $possible_companies as $company){
					echo "<p><a href='$companies_website[$i]' style='color:white'> $company </a></p>";
					$i ++;
				}
			}
			?>
		</div>
	</div>

</body>
</html>

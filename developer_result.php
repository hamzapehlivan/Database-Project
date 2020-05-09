<html >
	<head> 
		<title> CSCareer</title>
		<link rel="stylesheet" href="css/styles.css">
		<script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
		<script>
			//Ajax
			$(document).ready(function () {
				$('#btnid').click( function () {
					$('#id').load('change_result_content.php', {data1 : x, data2: y});
				});	
			});
		
		</script>
	</head>
	
	<body>
		
		<header> 
			<nav>
				<ul>
					<li> <a href = "developer_main.php">Main Menu</a> </li>
					<li> <button>Profile</button></li>
				</ul>
				
			</nav>
		</header>
		
		<section> 
			
		
		
		</section> 
		
		
		
	</body>
	

</html>
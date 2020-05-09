<html >
	<head> 
		<title> CSCareer</title>
		<link rel="stylesheet" href="css/styles.css">
	</head>
	
	<body>
		
		<header> 
			<nav>
				<ul>
					<li> <a href = "developer_result.php"><button>View Results</button></a> </li>
					<li> <button>Profile</button></li>
				</ul>
				
			</nav>
			<h2>Take Quiz Now!</h2>
			
		</header>
		
			<?php
			
				require_once ('connect.php');
				session_start();
				$_SESSION['developer_id'] = 1;
				$developer_id = $_SESSION['developer_id'] ;
				
				// Find the quizzes corresponding to current developer.
				$sql = "select remaining_attempts, quiz_id, category_name from tries natural join quiz where developer_id = {$developer_id} order by category_name";
				$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
				
				while ( $row = mysqli_fetch_array ($result)) {
					
					
					echo "<div class = 'categories'>" ;
					if ($row['remaining_attempts'] > 0) {
						echo "<a href = 'initialize_quiz.php?quiz_id={$row['quiz_id']}'><button>{$row['category_name']}</button></a>";
					}
					else {
						echo "<button disabled>{$row['category_name']}</button></a>";
					}
					echo "\t{$row['remaining_attempts']} attempts left";
					echo "</div>";
				}
			?>
		
		
		
	</body>
	

</html>
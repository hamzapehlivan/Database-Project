
<?php
	require_once ('connect.php');
	session_start();
	$attempt_id = $_POST['attempt'];
	$quiz_id = $_POST['quiz'];
	
	// Find categories 
	$sql = "SELECT category_name, COUNT(*) as categ_no FROM quiz_questions NATURAL JOIN categorized_as WHERE quiz_id = {$quiz_id} GROUP BY category_name";
	$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
	$goodAtThresholds = [];
	while ($row = mysqli_fetch_array ($result)) {
		$goodAtThresholds[$row['category_name']] = $row['categ_no'];
		$goodAtThresholds [$row['category_name']] = floor ($goodAtThresholds[$row['category_name']] /2) ;
	
	}		
	
	$sql = "SELECT category_name, SUM(CASE WHEN isCorrect = 1 THEN 1 ELSE -1 END) AS score FROM answer NATURAL JOIN categorized_as "; 
	$sql .= "WHERE attempt_id = {$attempt_id} GROUP BY category_name";
	$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
	$goodAt = array();
	$badAt = array();
	//$goodAtThreshold = 0;
	while ($row = mysqli_fetch_array ($result)) {
		if ( $row['score'] >= $goodAtThresholds[$row['category_name']]) {
			$goodAt[] = $row['category_name'];
		}
		else {
			$badAt[] = $row['category_name'];
		}
	}
	$sql = "SELECT total_score FROM quiztrial WHERE attempt_id = {$attempt_id}";
	$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
	$row = mysqli_fetch_array ($result);
	$totalScore = $row ['total_score'];
	
	$sql = "SELECT total_questions FROM quiz WHERE quiz_id = {$quiz_id} ";
	$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
	$row = mysqli_fetch_array ($result);
	$totalQuestions= $row ['total_questions'];
	
	$totalScore = floor (($totalScore * $totalQuestions / 100));
	$rate = floor ((5*$totalScore)/$totalQuestions );
		
	echo "<div class = 'row' style = 'color:red;'> <div class = 'col-lg'><h2>Overall Performance </h2></div> </div>";

	
	echo "<div class = 'row' style = 'height:50px;'>";
	for ($x = 0; $x < $rate; $x++) {
		echo "<div class = 'cl-lg' > ";
		echo '<svg class="bi bi-star-fill" width="25px" height="25px" viewBox="0 0 16 16" fill="orange" xmlns="http://www.w3.org/2000/svg">
		<path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
		</svg>';
		echo "</div>";
	}
	for (; $x < 5; $x++) {
		echo "<div class = 'cl-lg'> ";
		echo '<svg class="bi bi-star" width="25px" height="25px" viewBox="0 0 16 16" fill="black" xmlns="http://www.w3.org/2000/svg">
		<path fill-rule="evenodd" d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 00-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 00-.163-.505L1.71 6.745l4.052-.576a.525.525 0 00.393-.288l1.847-3.658 1.846 3.658a.525.525 0 00.393.288l4.052.575-2.906 2.77a.564.564 0 00-.163.506l.694 3.957-3.686-1.894a.503.503 0 00-.461 0z" clip-rule="evenodd"/>
		</svg>';
		echo "</div>";
	}
	echo "</div>";
	
	
	
	echo "<div class = 'row' style = 'color:red;margin-top'><div class = 'cl-lg'><h3>You are Good at</h3></div></div>";
	
	echo "<div class = 'row' style = 'margin-top:15px;'>";
	foreach($goodAt as $item) {
		echo "<div class = 'col-lg-12'><h5>{$item}</h5></div>";
	}
	echo "</div>";
	
	echo "<div class = 'row' style = 'margin-top:15px;color:red;'><div class = 'cl-lg'><h3>You can Improve</h3></div></div>";
	
	echo "<div ><div class = 'row'>";
	foreach($badAt as $item2) {
		echo "<div class = 'col-lg-12'><h5>{$item2}</h5></div>";
	}
	echo "</div>";


?>
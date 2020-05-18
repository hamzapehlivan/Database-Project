<?php
	session_start();
	
	date_default_timezone_set('Europe/Istanbul');
	
	$start = date ("H:i:s");
	$end = $_SESSION ['quiz_end_time'];
	
	$startTime = strtotime($start);
	$endTime = strtotime($end);
	
	$diff = $endTime - $startTime;
	
	if ($diff < 0) {
		$diff = 0;
	}
	echo gmdate ("H:i:s", $diff);


?>
<!doctype html>
<html lang="en">
  <head>
</head>
  <body>
	<?php
			require_once ('connect.php');
            session_start();
            $developer_id = $_REQUEST['developer_id'];
            $quiz_id = $_REQUEST['quiz_id'];
            $initialClick = 1;

            $date = $_POST['date'];
            $jobD = $_POST['jd'];
			
            $rep_id = $_SESSION['representative_id'];
            $status = 'sent';
            $request = $_SESSION['request'];
            $number = 1;
            $sql = " SELECT developer_id, acceptedStatus, representative_id FROM request";
            $alert = 0;
            $result = mysqli_query ($conn, $sql);

            while ($row = mysqli_fetch_array ($result)) {
                
				if( $row['developer_id'] == $developer_id){
                    if( $row['representative_id'] == $rep_id){
                            $number = 0;
                            break;
                    }
                }
                
                
            }
            
            if( $number == 1){
                $sql = " insert into request(	request_id , acceptedStatus, due_date, job_description,	developer_id,representative_id) values ('$request', '$status', '$date', '$jobD', '$developer_id', '$rep_id')";
                $result = mysqli_query($conn, $sql);
                $_SESSION["request"] = $_SESSION["request"] + 1;
            }
			
            
			// Show the selected attempt
			header("Location: view_quiz_results.php?quiz_id={$quiz_id}");

			

        ?>
        </body>
</html>
    
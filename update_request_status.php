<?php
			require_once ('connect.php');
            session_start();
            $request_id = $_REQUEST['request_id'];
            $initialClick = 1;

            $status = $_POST['subject'];

            $sql = " UPDATE request SET acceptedStatus= '$status' WHERE request_id = {$request_id}";
            $result = mysqli_query($conn, $sql);
            

			header("Location:developer_requests.php");

			

        ?>
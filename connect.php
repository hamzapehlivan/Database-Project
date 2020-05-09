<?php
   define('SERVER', 'localhost');
   define('USERNAME', 'root');
   define('PASSWORD', '');
   define('DATABASE', 'cscareer');
   $conn = mysqli_connect(SERVER,USERNAME,PASSWORD,DATABASE);
   
   if (!$conn) {
	   echo "Connection failed";
   }
   
?> 
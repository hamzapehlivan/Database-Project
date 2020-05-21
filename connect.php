<?php
   define('SERVER', 'localhost:3308');
   define('USERNAME', 'root');
   define('PASSWORD', '');
   define('DATABASE', 'cscareer');
   $conn = mysqli_connect(SERVER,USERNAME,PASSWORD,DATABASE);
   
   if (!$conn) {
	   echo "Connection failed";
   }
   
?> 
<?php
  define('DB_NAME', 'iap5');
	define('DB_USER', 'iap5');
	define('DB_PASSWORD', 'onerous56');
	define('DB_HOST', 'sql2.njit.edu');
	
	
	// Connect to database server
	$link= mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}

	// Select database
	$db_selected= mysqli_select_db($link, DB_NAME); 
	
	if(!$db_selected){
		die('Can\'t use ' . DB_NAME . ':' . mysql_error());
	}

  $username = $_POST['username'];
  $password = $_POST['password'];
  
  // Build query
  $query = "SELECT * from users
  		  where username = '$username' and password = '$password'";
  
  $rs = mysqli_query($link, $query);
  
  $row_cnt = $rs ->num_rows;
 	//echo $row_cnt;
  // Check if we found that user
  if ($row_cnt > 0){
    //	echo "got here";
   	// SQL query
    
  }
  

  else{
    echo '<br> <br> <br> <center>';
  	echo "Username/password pair not found!!";
    echo '<h3> <a href = "login.php" title ="addquestion"><u> GO Back </u> </a> </h3> ';
    echo '</center>';
  }
  
  // Close the database connection
 	mysqli_close($link);
?>

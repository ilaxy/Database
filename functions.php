<?php 
    //Requried files
    require_once('path.inc');
    require_once('get_host_info.inc');
    require_once('rabbitMQLib.inc');
    //require_once('testRabbitMQClient.php');
    require_once('functions.php');
    require_once('connection.php');
    require_once('connection2.php');
	
    //Functions for different cases
    $connection = connection();
	
    function doLogin($username, $password){
        
        $connection = connection();
        
        $query = "SELECT * FROM users WHERE username = '$username' and  password = '$password'";
	$result = $connection->query($query);
print_r($result);

	//if statement for validation
        if($result){
            if($result->num_rows == 0){
		echo "Login Failed ! Try again!";
                return "False";
            }
	    else
		{
		   echo "Login Successful.";
		   return "True";	
		}
	}	
     }
		
    function doRegister($username, $firstname, $lastname, $email, $password){
        
        //Makes connection to database
        $connection = connection();
            
        
        //Query to check if the username exists
        $check_uname = "SELECT username FROM users WHERE upper(username) = upper('$username')";
        $check_rs = $connection->query($check_uname);
        /*
        while ($row = $check_result->fetch_assoc()){
            if ($row['username'] == $username){
                return "Username already exists";
            }
        }
        */

	if($check_rs){
            if($check_rs->num_rows == 0){
                
		
        	echo "<br>Registration Completed! ";
       		echo $result;
        	$registered = "INSERT INTO users(username, password, email) VALUES ('$username', '$password', '$email')";
		
		$regis = $connection->query($registered);

		$newuser = "INSERT INTO registered VALUES ('$username', '$firstname', '$lastname', '$email', '$password')";
		$r = "commit";
       		$result = $connection->query($newuser);
		$regis1 = $connection->query($r);
		return 1;
            }
	    else
		{
		   echo "Login Failed ! Try again!";
		   return 0;	
		}
	}
        //Query for a new user
/*
        $newuser = "INSERT INTO registered VALUES ('$username', '$firstname', '$lastname', '$email', '$password')";
        
        $result = $connection->query($newuser);
        echo "<br>Registration Completed! ";
        echo $result;
        $registered = "INSERT INTO users VALUES ('$username', '$password', '$email')";
        return "True";
    }
*/	
	function doLogout($username, $password) 
	{
	   session_start();
	   session_destroy();
	}
	
	
	function doWish($username, $bookname) 
	{
	   $connection = connection();
           
	   //Query to grab and return whatever is in the wishlist under the user's name
	   $wishlist = "SELECT bookname FROM wishlist WHERE username = '$username'";
	   $list = $connection->query($wishlist);
	   //echo $list;

		if($list){
            		if($list->num_rows == 0)
			{
                	   return 1;
            		}	
	    	  	else
			{
		   	   echo "User has not established  proper wishlist";
			   return 0;
			
			}
		}	

           
	   //Query to add new entry to wishlsit
           $newwish = "INSERT INTO wishlist VALUES ($username, $bookname)";
           $bookwish = $connection->query($newwish);
	   //echo "<br>Entry added";
	   return true;

	}
	
	function WriteReview ($bookname, $userID, $text) 
	{
	    $connection = connection();

	    //Query to list all reviews from users for a certain book
	    $review = "SELECT user_ID, text FROM review WHERE book_id = '$bookname'";
	    $listrev = $connection->query($review);
	    //echo $listrev;
	   	

	   //Query to insert reviews  for certain books
	   $reviewtext = "INSERT INTO review VALUES ($bookname, $userID, $text)";
	   $insertrev = $connection->query($reviewtext);
	   echo "<br>Review added";
	   //return true;
	}
	
	function HaveRead ($username, $bookname)
	{
	   $connection = connection();
	
	   //Query to list every book the user has read
	   $mark = "SELECT bookname FROM red WHERE username = '$username'";
	   $marked = $connection->query($mark);
		if($marked){
            		if($marked->num_rows == 0)
			{
                	   return 1;
            		}	
	    	  	else
			{
		   	   echo "User has not read book";
			   return 0;
			
			}
		}	

	   //Query to mark new books as 'have read'
	   $marking = "INSERT INTO red VALUES ($username, $bookname)";
	   $marked2 = $connection->query($marking);
	}
	
	function Owned ($username, $bookname) 
	{
	   $connection = connection();

	   //Query to list all owned books
	   $owned = "SELECT bookname FROM own WHERE username = '$username'";
	   $listown = $connection->query($owned);
	        if($listown){
            		if($marked->num_rows == 0)
			{
                	   return 1;
            		}	
	    	  	else
			{
		   	   echo "User does not own this book";
			   return 0;
			}
		}	


	   //Query to mark books that are now owned
	  $own = "INSERT INTO own VALUES($username, $bookname)";
	  $owning = $connection->query($own);

	}	
	
	function BookSale ($title, $author, $genre, $price, $isbn)
	{
	  $connection2 = connection2();

	  $salelist = "SELECT * FROM SearchBooksForSale";
	  $sales = $connection2->query($saleslist);
	}
	
	function AddBook ($title, $author, $genre, $price, $isbn)
	{
	  $connection2 = connection2();
	 

	  $addition = "INSERT INTO ADDBooksForSale VALUES ($title, $author, $genre, $price, $isbn)";
	  $adds = $connection2->query($addition);

	  $search = "INSERT INTO SearchBooksForSale VALUES ($title, $author, $genre, $price, $isbn)";
	  $searchable = $connection2->query($search);

	  if ($adds && $searchable) 
	  {
	     echo "Books information has been uploaded and is now for sale";
	     $delete = "DELETE FROM ADDBooksForSale WHERE title = '$title'";
	     $deletion = $connection2->query($delete);
	     return 1;
	  }
	  else
	  {
	      return 0;
	  }
	}
	

	
	?>



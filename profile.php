<?php
    session_start();
   /* 
    if (!$_SESSION["logged"]){
        header("Location: login.html");
    }
    */
    
    require_once('path.inc');
    require_once('get_host_info.inc');
    require_once('rabbitMQLib.inc');
    require_once('testRabbitMQClient.php');
	
	  $client = new rabbitMQClient("testRabbitMQ.ini","testServer");
	
    $request = array();
    $request['type'] = "UserProfile";
    $request['username'] = $_SESSION["username"];
  	$request['firstname'] = $_SESSION["firstname"];
  	$request['lastname'] = $_SESSION["lastname"];
  	$request['email'] = $_SESSION["email"];
  	$request['wishlist'] = $_SESSION["wishlist"];
    
  	$response = $client->send_request($request);
?>

<html>

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  	<title>My Profile</title>     
  	<link rel="stylesheet" href="main.css">
  	<link href='https://fonts.googleapis.com/css?family=Barlow Condensed' rel='stylesheet'>
  </head>
   
  <body>
   
    <h1><?php echo "Username  :". $_SESSION["username"]; ?></h1>
		<?php echo "First Name  :". $_SESSION["firstname"]; ?>
		<?php echo "Last Name  :". $_SESSION["lastname"]; ?>
		<?php echo "Email address  :". $_SESSION["email"]; ?>
		
	
    <h2> My Wishlist:</h2>
    <?php for($i = 0; $i < count($data["favorites"]); $i++){ ?>
    <b>Book Name: </b>
    <a href = "readBuster.html?restId=" <?php echo $data["favorites"][$i]["book_id"]; ?>>
      <?php echo $data["favorites"][$i]["book_title"]; ?>
    </a>
    <br>
    <?php } ?>
        
  </body> 
</html>

   

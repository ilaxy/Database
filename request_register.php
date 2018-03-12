
<?php
	require_once('path.inc');
	require_once('get_host_info.inc');
	require_once('rabbitMQLib.inc');
	require_once('testRabbitMQClient.php');

	$request = array();

	$request['type'] = "register";
	$request['username'] = $_POST["username"];
	$request['firstname'] = $_POST["firstname"];
	$request['lastname'] = $_POST["lastname"];
	$request['email'] = $_POST["email"];
	$request['password'] = $_POST["password"];

	$returnResponse = dbClient($request);

	if ($returnResponse == "True")
	{
		header("Location: login.html");
	}

	else
	{
		echo "Registration failed ! Please try again!";
		header("Location: register.html");
		 
	}


?>



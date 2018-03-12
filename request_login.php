<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);	

	session_start();

	require_once('path.inc');
	require_once('get_host_info.inc');
	require_once('rabbitMQLib.inc');  
	require_once('testRabbitMQClient.php');

	$request = array();

	$request['type'] = "login";
	$request['username'] = $_POST['username'];
	$request['password'] = $_POST['password'];

	//echo $request['username'] + " " + $request['password'];

	$returnResponse = dbClient($request);

	if ($returnResponse == "True")
	{
		echo "hello";
		$_SESSION["username"] = $_POST["username"];
		$_SESSION["logged"] = true;

		header("Location: readBuster.html");
	}

	else
	{
		header("Location: login.html");
		 
	}

?>




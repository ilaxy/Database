<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');  

$username = $_POST['username'];
$password = $_POST['password'];

echo $username + " " + $password;

$client = new rabbitMQClient("testRabbitMQ.ini", "testServer");

$request = array();

$request['type'] = "login";
$request['username'] = $username;
$request['password'] = $password;

$response = $client->send_request($request);

if ($response['returnCode'] == "True")
{
	$_SESSION["username"] = $_POST["username"];
	$_SESSION["logged"] = true;

	header("Location: readBuster.html");
}

else
{
	header("Location: login.html");
	 
}

?>




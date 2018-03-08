
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$firstname = ($_POST['firstname']);
$lastname= ($_POST['lastname']);
$email= ($_POST['email']);
$password= ($_POST['password']);

$client = new rabbitMQClient("testRabbitMQ.ini","testServer");

$request = array();

$request['type'] = "register";
$request['firstname'] = "$firstname";
$request['lastname'] = "$lastname";
$request['username'] = "$username";
$request['password'] = "$password";
$request['email'] = "$email";

$response = $client->send_request($request);

if ($response['returnCode'] == 1)
{
	header('Location: login.html');
}

else
{
	print_r($response);
}


?>



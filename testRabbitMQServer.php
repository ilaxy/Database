#!/usr/bin/php
<?php

echo "ServerStarted!".PHP_EOL;
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
//routes requests from client
function requestProcessor($request)
{
  echo "Received Request!";	
  switch ($request["data"])
  {
	case "login":
		$client = new rabbitMQClient("rabbitMQ_DB.ini","testServer");
		//send data to database and store response
		$response = $client->send_request($request);
	break;
	case "register":
		$client = new rabbitMQClient("rabbitMQ_DB.ini","testServer");
		//send data to database and store response
		$response = $client->send_request($request);
	break;
 }
  
  return $response;
}
//create new rabbitmq server instance
$server = new rabbitMQServer("rabbitMQ.ini","testServer");
//handle all incoming requests
$server->process_requests('requestProcessor');
exit();
?>

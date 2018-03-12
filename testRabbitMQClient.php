#!/usr/bin/php
<?php
	require_once('path.inc');
	require_once('get_host_info.inc');
	require_once('rabbitMQLib.inc');



	function dbClient($request){

		$client = new rabbitMQClient("dbtestRabbitMQ.ini","testServer");
		if (isset($argv[1]))
		{
		  $msg = $argv[1];
		}
		else
		{
		  $msg = "client message";
		}
	
		$response = $client->send_request($request);

	//	$response = $client->publish($request);

		echo "client received response: ".PHP_EOL;
		return ($response);
		echo "\n\n";

		echo $argv[0]." END".PHP_EOL;
	}

?>


<?php 
    //required files
    require_once('path.inc');
    require_once('get_host_info.inc');
    require_once('rabbitMQLib.inc');
    require_once('functions.php');
	
    //to send the request from server to function
	
    function requestProcessor($request){
        echo "Request received ".PHP_EOL;
        echo $request['type'];
        var_dump($request);
        
        if(!isset($request['type'])){
            return array('message'=>"ERROR: Message type is not supported");
        }
        switch($request['type']){
                
            //Login & Authentication request    
            case "login":
                $response_msg = doLogin($request['username'],$request['password']);
                break;
                
            //New User registration
            case "register":
                echo "<br>in register";
                $response_msg = doRegister($request['username'], $request['firstname'], $request['lastname'], $request['email'], $request['password']);
                break;
				
		}	 
        return $response_msg;
    }


	//creating a new server
    $server = new rabbitMQServer('dbtestRabbitMQ.ini', 'testServer');
    
    //processes the request sent by client
    $server->process_requests('requestProcessor');


?>
	

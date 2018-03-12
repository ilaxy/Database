<?php
    //Establishes connection to MySQL database
    function connection(){
        
        $hostname = '192.168.1.151';
        $username = 'root';
        $password = 'emile814';
        $dbname = 'database_1';
        
        $connection = mysqli_connect($hostname, $username, $password, $dbname);
        
        if (!$connection){
            echo "Error connecting to database: ".$connection->connect_errno.PHP_EOL;
            exit(1);
        }
        echo "Connection established to database".PHP_EOL;
        return $connection;
    }
    
?>

<?php
  
    session_start();
    
    if (!$_SESSION["logged"]){
        header("Location: login.html");
    }
?> 

<html>
 <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="main.css">
	  <link href='https://fonts.googleapis.com/css?family=Barlow Condensed' rel='stylesheet'>  
</head>

<body>
</body>

</html>
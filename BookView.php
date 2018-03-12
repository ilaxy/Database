
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
    $request['type'] = "login";
    $request['username'] = $_SESSION["username"];
    
    $response = $client->send_request($request);
?> 

<!DOCTYPE html>
<html>
 <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<script>

/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function dropFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}


/*When 'Add to Wishlist button is clicked, whislist heart icon animates
Bounce function used, try others, animate
*/
function AddToWishList() {
    document.getElementById("addWish").classList.toggle("bounce", { times: 3 }, "slow");
}

</script>

<body> 
  <div class="tab">
  <button class="tablinks" onclick="location.href='BookForSell.php'" id="defaultOpen">Sell Books</button>
  <button class="tablinks" onclick="openElement(event, 'ContactUs')">Contact Us</button>
  </div>
  <div class="dropdown">
  <button onclick="dropFunction()" class="dropbtn"><?php echo $_SESSION["username"] ?></button>
  <div id="myDropdown" class="dropdown-content">
    <a href="profile.php">
      <button class="dropdown-item" type="button">My Profile</button>My Profile</button>
    </a>
    <a href = "logout.php?logout=true">
      <button class="dropdown-item" type="button">Logout</button>
    </a>
    
    </div>
  </div>
/*
	<h1><?php echo $_SESSION["username"]; ?></h1>
        <?php for($i = 0; $i < count($data["Books"]); $i++){ ?>
            <b>Book Name: </b> <?php echo $data["suggestions"][$i]["book_title"]; ?>
            <br>    
        <?php } ?>
		
*/		
	  <h2>Reviews <?php echo $_SESSION["username"]; ?>:</h2>
    <?php for($i = 0; $i < count($data["reviews"]); $i++){ ?>
        <b>Book Name: </b> <?php echo $data["reviews"][$i]["book_title"]; ?>
        <br>       
        <b>Review: </b> <?php echo  $data["reviews"][$i]["review_text"]; ?>
        <br><br>
    <?php } ?><br>
    
    <div class="wrapper">
      <button onclick="AddToWishList()" class="dropbtn" id="addWish" type="button">Add to Wishlist</button>
      <div>
          <img src="http://icons.iconarchive.com/icons/iconsmind/outline/512/Heart-2-icon.png" alt="Heart" width="30" height="30" id="wishlist" >
      </div>   
    </div>
    
    <label class="container">Owned
      <input type="checkbox" checked="checked">
      <span class="checkmark"></span>
    </label>
    <label class="container">Read
      <input type="checkbox">
      <span class="checkmark"></span>
    </label>
        
</body>
</html>

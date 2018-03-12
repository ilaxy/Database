
<html>
 <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href='https://fonts.googleapis.com/css?family=Barlow Condensed' rel='stylesheet'>  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<style>

/* Home Section */
.intro {
	display: table;
	width: 100%;
	height: 100%;
	padding: 222px 0;
	text-align: center;
	font-size: 40px; 
	color: orange;
	background: url('bg.jpg') no-repeat center top;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	background-size: cover;
	-o-background-size: cover;
}

body {
   font-family: 'Barlow Condensed';
   font-size: 22px; 
}
.center {
    margin: auto;
    width: 50%; 
    padding: 10px;
}

h2 {
	line-height: 20px;
	margin: 0;
	color: #121d1f;
	font-weight: 400;
	margin-bottom: 30px;
	font-size: 34px;
  text-align: center;
}

h3, h4 {
	color: #121d1f;
	font-size: 20px;
	font-weight: 600;
}

ul, ol {
	padding: 0;
	webkit-padding: 0;
	moz-padding: 0;
  list-style: none;
}
.sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #111;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
}

.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: orange;
    display: block;
    transition: 0.3s;
}

.sidenav a:hover {
    color: #0b7dda;
}

.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}

#main {
    color: orange;
    transition: margin-left .5s;
    padding: 30px;
}

@media screen and (max-height: 300px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}


#BookForSell {
	padding: 40px 0;
	background: white;
}
#BookForSell .BookForSell-text {
	margin-left: 10px;
}
#BookForSell img {
	border-radius: 50%;
	width: 200px;
	height: 200px;
	color: orange;
	display: inline-block;
}
#BookForSell p {
	margin-top: 20px;
	margin-bottom: 30px;
  	margin-left: 150px;
  	margin-right: 150px;
}

* {
    box-sizing: border-box;
}

form.example input[type=text] {
    padding: 10px;
    font-size: 20px;
    font-family: 'Barlow Condensed';
    border: 1px solid grey;
    float: left;
    width: 80%;
    background: #f1f1f1;
}

form.example button {
    float: left;
    width: 20%;
    padding: 10px;
    background: orange;
    color: white;
    font-size: 24px;
    border: 1px solid grey;
    border-left: none;
    cursor: pointer;
}

form.example button:hover {
    background: #0b7dda;
}

form.example::after {
    content: "";
    clear: both;
    display: table;
}

button[type=button] {
    float: center;
    margin-left: 130px; 
    margin-top: 10px;
    width: 80px;
    height: 30px;
    font-size: 14px;
    font-weight: bold;
    color: #fff;
    background-color: #acd6ef; /*IE fallback*/
    background-image: -webkit-gradient(linear, left top, left bottom, from(orange), to(#6ec2e8));
    background-image: -moz-linear-gradient(top left 90deg, orange 0%, orange 100%);
    background-image: linear-gradient(top left 90deg, #acd6ef 0%, #6ec2e8 100%);
    border-radius: 30px;
    border: 1px solid #66add6;
    box-shadow: 0 1px 2px rgba(0, 0, 0, .3), inset 0 1px 0 rgba(255, 255, 255, .5);
    cursor: pointer;
}


button:hover {
    opacity:1;
    background: #0b7dda;
}

</style>

<body>
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <b>
  <a class="btn btn-default btn-lg page-scroll" href="readBuster.html">Home</a> 
  <a class="btn btn-default btn-lg page-scroll" href="profile.php">Profile</a> 
  <a class="btn btn-default btn-lg page-scroll" href="logout.php">Log Out</a> 
  
  </b>
</div>

<div id="main">
  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; 
  <form class="example" action="BuyBook.php" style="margin:auto;max-width:700px">
        <input type="text" placeholder="Search book for Sale" name="search2">
        <button type="submit"><i class="fa fa-search"></i></button>
  </form></span>
</div>

<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
}

</script>


<!-- Header -->
<header id="header">
  <div class="intro">
    <div class="container">
      <div class="row">
        <div class="intro-text"> <center>
           <a href="#BookForSell" class="btn btn-default btn-lg page-scroll" id="defaultOpen">Start Selling</a> </center>
      </div>
    </div>
  </div>
</header>


<!-- Book For Sell Section -->
<div id="BookForSell">
  <div id="main">
  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;  </span>
  </div>
  <div class="container">
    <div class="section-title text-center center">
      <h2>Sell Your Book</h2>
      <hr width="15%"><br><br><br><br>
	<center>
	<label for="ISBN"> ISBN :</label>
    	<input id="ISBN" name="ISBN" type="text" placeholder="Enter book's ISBN number here..">
	<button id="GetPrice" type="button" formaction="PriceResult.html">Get Price</button><br> </center><br>
	<br><br><br><br><br>
    </div>
    </div>
  </div>
</div>

</body>

</html>



<?php
header('Content-Type: text/html; charset=utf-8');
    
session_start();

require_once ("config.php");
// header("Content-Type: text/html; Charset=UTF-8");
    
if(isset($_GET['lg']) == 1) {
  unset($_SESSION['username']);
  unset($_SESSION['id']);
  session_destroy();
}
    
$conn;
    
$userid = isset($_SESSION['id']);
    
$sesusername;
if(isset($_SESSION['username'])){
    $sesusername = $_SESSION['username'];
}

$region = mysqli_query($conn,"SELECT region FROM Users where
                       id = '$userid' ");

$_GET['mypoints'] = 'STAR';

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if (empty($_POST['region']) or 
	$_POST['region'] != "sverdlov" and $_POST['region'] != "oktyabr"
	and $_POST['region'] != "lenin" and $_POST['region'] != "pervomay") {
	    
  if ($_GET['mypoints'] == 1) {
  $result = mysqli_query($conn,"SELECT id, lat, lng,comments,level,name,region FROM markers where
        userID = '$userid' ");
  }
  else {
  $result = mysqli_query($conn,"SELECT id, lat, lng,comments,level,name,region FROM markers");   
  }

} else {

  $region = $_POST['region'];

  if ($_GET['mypoints'] == 1) {
    $result = mysqli_query($conn,"SELECT id, lat, lng,comments,level,name,region FROM markers where region = 
    '$region' and userID = '$userid' "); 
  }
  else {
    $result = mysqli_query($conn,"SELECT id, lat, lng,comments,level,name,region FROM markers where region = 
    '$region'");
  }
}

$json = [];

while($row = mysqli_fetch_assoc($result)){
  $json[] = $row;
}
                           
$json_encoded = json_encode($json,JSON_NUMERIC_CHECK );


if (empty($_SESSION)) {
  $showreg = isset($_POST['region']);
  if (strlen($showreg) == 0) {
    $showreg = "All Regions";
  }
}
?>

<html>
<head>	<meta charset="utf-8">
	<meta http-equiv="X-UA-Comaptible" content="IE=edge">
	<title>About Us</title>
	<meta name="desciption" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="script.js"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
	<script>
		$(window).on('scroll', function(){
  			if($(window).scrollTop()){
  			  $('nav').addClass('black');
 			 }else {
 		   $('nav').removeClass('black');
 		 }
		})
	</script>
</head>
<body>
    
<!-- Navigation Bar -->
	<header id="header">
		<nav>
			<ul>
				<li><a class="active" href="">Home</a></li>
				<li><a href="login.php">login</a></li>
				<li><a href="regist.php">register</a></li>
				<li><a href="AboutUs.php">aboutUs</a></li>
			</ul>
			<div class="srch"><input type="text" class="search" placeholder="Search here..."><img src="images/icon/search.png" alt="search" onclick=slide()></div>
			<a class="get-started" href="login.html">Get Started</a>
			<img src="images/icon/menu.png" class="menu" onclick="sideMenu(0)" alt="menu">
		</nav>
		<div class="head-container">
			<div class="quote">
				<p>What does this site do ?</p>
				<h5>This site helps people to keep Bishkek clean.
This site shows all the locations of collected and unnoticed trash in Bishkek city and helps people 
to easily find it. It helps the government to see the specific location to efficiently clean areas.
Whenever people see uncollected trash on subways or in the corners of the building or broken
trees, with the help of this site people can easily set the location of the trash. After, all the people 
of Bishkek who are using this site can see the location of this trash.<br>		</h5>
			</div>
			<div class="svg-image">
				<img src="images/extra/animated.gif" alt="svg">
			</div>
		</div>
		<div class="side-menu" id="side-menu">
			<div class="close" onclick="sideMenu(1)"><img src="images/icon/close.png" alt=""></div>
			
	</header>



<!-- ABOUT -->
	<div class="diffSection" id="about_section">
		<center><p style="font-size: 50px; padding: 100px">About</p></center>
		<div class="about-content">
				<div class="side-image">
					<img class="sideImage" src="images/extra/cute.jpg">
				</div>
				<div class="side-text">
					<h2>How to use tazakoomkg site ?</h2>
						<p> How to set a location? In order to use this site a citizen has to to go through several steps.First: Register on the site.
						Second: Login using your credentials.*Unauthorized users can only view the points.Third: Set a point using markers on the map
						Level indicates degree of pollution, from 1 point up to 5.Reporting points as cleaned After the trash was found and cleaned,
						two or more users have to prove and only after that the trash location will be deleted from the map</p>
				</div>
		</div>
	</div>
	 


<!-- CONTACT US -->
	<div class="diffSection" id="contactus_section">
		<center><p style="font-size: 50px; padding: 100px">Contact Us</p></center>
		<div class="csec"></div>
		<div class="back-contact">
			<div class="cc">
			<form action="mailto:roshank9419@gmail.com" method="post" enctype="text/plain">
				<label>First Name <span class="imp">*</span></label><label style="margin-left: 185px">Last Name <span class="imp">*</span></label><br>
				<center>
				<input type="text" name="" style="margin-right: 10px; width: 175px" required="required"><input type="text" name="lname" style="width: 175px" required="required"><br>
				</center>
				<label>Email <span class="imp">*</span></label><br>
				<input type="email" name="mail" style="width: 100%" required="required"><br>
				<label>Message <span class="imp">*</span></label><br>
				<input type="text" name="message" style="width: 100%" required="required"><br>
				<label>Additional Details</label><br>
				<textarea name="addtional"></textarea><br>
				<button type="submit" id="csubmit">Send Message</button>
			</form>
			</div>
		</div>
	</div>


<!-- FEEDBACK -->
	<div class="title2" id="feedBACK">
		<span>Give Feedback</span>
		<div class="shortdesc2">
			<p>Please share your valuable feedback to us</p>
		</div>
	</div>

	<div class="feedbox">
		<div class="feed">
			<form action="mailto:jafari_z@auca.kg.com" method="post" enctype="text/plain">
				<label>Your Name</label><br>
				<input type="text" name="" class="fname" required="required"><br>
				<label>Email</label><br>
				<input type="email" name="mail" required="required"><br>
				<label>Additional Details</label><br>
				<textarea name="addtional"></textarea><br>
				<button type="submit" id="csubmit">Send Message</button>
			</form>
		</div>
	</div>

<!-- Sliding Information -->
	<marquee style="background: linear-gradient(to right, #FA4B37, #DF2771); margin-top: 50px;" direction="left" onmouseover="this.stop()" onmouseout="this.start()" scrollamount="20"><div class="marqu"> our city;                                  our home                                      , let's keep it clean</div></marquee>

<!-- FOOTER -->
	<footer>
		<div class="footer-container">
			<div class="left-col">
				<div class="logo"></div>
				<div class="social-media">
					<a href="#"><img src="images/icon\fb.png"></a>
					<a href="#"><img src="images/icon\insta.png"></a>
					<a href="#"><img src="images/icon\tt.png"></a>
					<a href="#"><img src="images/icon\ytube.png"></a>
					<a href="#"><img src="images/icon\linkedin.png"></a>
				</div><br><br>
				<p class="rights-text">Copyright © 2020 Created By Amalbekov Kushtarbek and Zahra Jafari</p>
				<br><p><img src="images/icon/location.png">Bishkek, Kyrgyzstan</p><br>
			</div>
			<div class="right-col">
				<h1 style="color: #fff">Our Newsletter</h1>
				<div class="border"></div><br>
				<p>Enter Your Email to get our News and updates.</p>
				<form class="newsletter-form">
					<input class="txtb" type="email" placeholder="Enter Your Email">
					<input class="btn" type="submit" value="Submit">
				</form>
			</div>
		</div>
	</footer>

</body>
</html>

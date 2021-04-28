<?php  
session_start();
require_once("config.php");
$ip = $_SERVER['REMOTE_ADDR'];

if (empty($_SESSION)) {
htmlGetBack("Anouthorized users cannot view this page","index.php" ,"Go back" );
logError("$ip tried to access this page without authorizing");
exit;
}

$conn;
$username = $_SESSION['username'];
$user_arr = mysqli_query($conn, "SELECT * from Users where uname = '$username'");

$row=mysqli_fetch_array($user_arr,(MYSQLI_ASSOC));

 $last = DateTime::createFromFormat ( "Y-m-d H:i:s", $row["lastSubmission"]);
        $available = date_add($last, date_interval_create_from_date_string('30 minutes'));
        $nextsubmission =  date_format($available, 'Y-m-d H:i:s');

$region = $row["region"];
$email = $row["email"];

// if (!$available) {
//     printf("Error: %s\n", mysqli_error($conn));
//     exit();
// } 




if (isset($_POST['change'])) {
	$email = $_POST['email'];
	$user_arr2 = mysqli_query($conn, "SELECT * from Users where email = '$email'");
	$row2=mysqli_fetch_array($user_arr2,MYSQLI_ASSOC);
	if ($row2['id'] != 0) {
		htmlGetBack("Username with this email already exists", "userOffice.php", "Go back");
		exit;
	}
	else {
		mysqli_query($conn, "UPDATE Users SET email = '$email' WHERE uname = '$username';");
		htmlGetBack("Email Added Successfully $email", "userOffice.php", "Go Back");
		exit;
	} 
}
if (isset($_POST['submit'])) {
	print("<html>
	<form action = '' method= 'POST'>
		Your email: <input type='email' name='email'style='margin-right:7px'> 
		<input type='submit' name='change' value = 'Submit' class='btn btn-success'>
	</form>
</html>");
}


print(" 
<html>
<head>

<center>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
  <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
   <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
	<body style='background:linear-gradient(#FA4B37, #b71b5a);' >

</head>
<style>
a:link, a:visited {
  background-color: orange;
  color: black;
  border: 2px solid yellow;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  	<body style='background:linear-gradient(#FA4B37, #b71b5a);' >

  margin: 5px;
}

a:hover, a:active {
  background-color: blue;
  color: white;
}
</style>
<body style='margin:0.07'>
	<p> Username: '$username' Region: '$region' </p>
	<body style='background:linear-gradient(#FA4B37, #b71b5a);' >
Next Submission available at: $nextsubmission
<p>
<img src='images/icon/password.png'><a href='pswd_ch.php'class='btn btn-info' style='margin-top:5' position:'center'> Change Password </a> <br>
<img src='images/icon/user.png'><a href='username_ch.php'class='btn btn-info' style='margin-top:5'>Change Username </a> <br>
<img src='images/icon/location.png'><a href='region_ch.php'class='btn btn-info' style='margin-top:5'> Change User Region </a> <br>
");
if ($row['email'] == "") {
	print ("<form action='' method='POST'>
<img src='images/icon/q1.png'>
	<button type='submit' class='btn btn-primary' style='margin-top:5' name='submit'  > <i class='glyphicon glyphicon-envelope' style='margin-right:5px'></i> Add email</button>
	
	");
}
print("</p>
</body>
</html>

</center>
");

htmlGetBack("", "index.php", "Go back")
;
?>

<?php
    session_start();
    require_once("config.php");
    $ip = $_SERVER['REMOTE_ADDR'];
    unset($_SESSION['username']);
    unset($_SESSION['id']);
   	if (isset($_POST['submit'])) {
		$conn;
		$username = $_POST['username'];
		$password = $_POST['password'];
		$user_arr = mysqli_query($conn, "SELECT * from Users where uname = '$username' and pswd = '$password'");

		$row=mysqli_fetch_array($user_arr,MYSQLI_ASSOC);

		if (strlen($username) == 0 or strlen($password) == 0) {
		htmlGetBack("You have not authorized with username / password", "index.php", "Go Back");
		// logAction($conn, "empty", "empty");
		exit;
		}
		else {

		if ($row['id'] == 0) {
		htmlGetBack("Incorrect credentials", "index.php", "Go Back");
		// logAction($conn, $username, "fail");
		exit;
		}
		else {	
		$_SESSION['username'] = $username;
		$_SESSION['id'] = $row['id'];
		
		// logAction($conn, $username, "login");
		echo "<script>window.location = 'index.php';</script>";
		}
	}   		
  }

print("
<html>
<head>
	<title>Welcome to clean city</title>
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' integrity='sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u' crossorigin='anonymous'>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
  <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
</head>
<body>
      
<style>
  body {
 
    background-image: url('Login_imag.jpg');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: 150px -50px;
    background-position: cover;
    justify-content: center;
    top: 30px;
    left:400px;
	position: absolute;
	width: 280px;
	transition: .5s;
	font-size: 13px;
	color: #010101;
	background: linear-gradient(to right, #FA4B37, #DF2771);
	display: block;
	margin: auto;

  
}
    
  
</style>
<div class='container'>
<h2>Login</h2>
<form action = '' method='POST'>
<div class='form-group'>
	
			<img src='images/icon/user.png'><label>Username:</label>
    		<input type='text' class='form-control' placeholder='Enter username' name='username' required style='width: 50%; margin: 30px; display: inline-block>
			</div>
		<div class='form-group'>
        <img src='images/icon/password.png'><label>Password:</label>
        <input type='password' class='form-control' id='pwd' placeholder='Enter password' name='password' required style='width: 50%; margin: 30px;display: inline-block>
        </div>
        <div class='form-group'>

		<img src='images/icon/q1.png'><input type='submit' name='submit' class='btn btn-warning' value = 'Login'>
		</div>



<style>
a:link, a:visited {
  background-color: orange;
  color: black;
  border: 2px solid yellow;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin: 5px;
}

a:hover, a:active {
  background-color: blue;
  color: white;
}
</style>
</head>
<body>


</body>
</html>

 </div>

</form>
<hr>
	<a href='index.php?lg=0'>Proceed as Guest</a> <a href='forgotPass.php'>Reset Password </a> <a href = 'regist.php'>Sign up</a><a href= 'AboutUs.php'>About us</a><a href= 'index.php'>Go back</a>
</p>
</body>
</html>
");

<?php
session_start();
require_once("config.php");

$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
$path = 'uploads/'; // upload directory

if(!empty($_POST['name']) || !empty($_POST['email']) || !empty($_FILES['image']))
{



		$eventName = $_POST['eventName'];
		$eventDetails = $_POST['eventDetails'];
		$eventAddress = $_POST['eventAddress'];
		$startDate = $_POST['startDate'];
		$endDate = $_POST['endDate'];
		$volunteerNumber = $_POST['volunteerNumber'];
		$oName = $_POST['oName'];
		$oNumber = $_POST['oNumber'];


		$img = $_FILES['image']['name'];
		$tmp = $_FILES['image']['tmp_name'];


		$errorimg = $_FILES["image"]["error"]; //stores any error code resulting from the transfer



		// get uploaded file's extension
	$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
	// can upload same image using rand function
	$final_image = rand(1000,1000000).$img;
	// check's valid format
	if(in_array($ext, $valid_extensions)) 
	{ 
		$path = $path.strtolower($final_image); 
		if(move_uploaded_file($tmp,$path)) 
		{
		

			if (!mysqli_query($conn, "INSERT into uploading (eventName, eventDetails, eventAddress, startDate, endDate, createdDate, volunteerNumber, oName, oNumber, imagePath) values ('$eventName', '$eventDetails', '$eventAddress','$startDate', '$endDate',  DATE_SUB(NOW(), INTERVAL 6 HOUR), '$volunteerNumber', '$oName', '$oNumber', '$path');"))
			{
			  echo("Error description: " . mysqli_error($conn));
			}
			

		} else {
			echo 'invalid';
		}
	}
}

  
?>

"<!DOCTYPE html>
		<html>
		<head>
		<meta charset='utf-8'>
		<meta name='viewport' content='width=device-width, intial-scale=1.0'/>
		<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
		<title>Show Image in PHP - Campuslife</title>
		<style>
		    body{background-color: #fff; color: #333;}
		    .main{box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important; margin-top: 10px;}
		    h3{background-color: green; color: black; padding: 15px; border-radius: 4px; box-shadow: 0 1px 6px rgba(57,73,76,0.35);}
		    .img-box{margin-top: 20px;}
		    .img-block{float: left; margin-right: 5px; text-align: center;}
		    p{margin-top: 0;}
		    img{width: 375px; min-height: 250px; margin-bottom: 10px; box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important; border:6px solid black;}
		    .nav_button {
			    display: inline;
			}
		</style>
		</head>
		    <body>
		    <!-------------------Main Content------------------------------>
		    <div class='container main'>
		        <h3>Upcoming Ashaars</h3>
		        <div class='img-box'>

		    <?php
		        $host ='localhost';
		        $uname = 'tazakoom_Kushtar';
		        $pwd = 'adventure2020';
		        $db_name = 'tazakoom_ComfortCity';

		        $file_path = 'uploads/';
		        $result = mysqli_connect($host,$uname,$pwd) or die('Could not connect to database.' .mysqli_error());
		        mysqli_select_db($result,$db_name) or die('Could not select the databse.' .mysqli_error());
		        $image_query = mysqli_query($result,'select * from uploading');
		        while($rows = mysqli_fetch_array($image_query))
		        {
		      //   $img_name = $rows['imagePath'];
		    ?>
		        <div class='img-block'>
		        <p>
		        <img src='<?php echo $rows['imagePath']; ?>' width='300' height='200' class='img-responsive' />
		        <strong><?php echo 'Name :' .$rows['eventName']; ?></strong>
		        <br><strong><?php echo 'Address :' . $rows['eventAddress']; ?></strong>
		        <br><strong><?php echo 'Details :' . $rows['eventDetails']; ?></strong>
		        <br><strong><?php echo 'Start date :' . $rows['startDate']; ?></strong>
		        <br><strong><?php echo 'End date :' . $rows['endDate']; ?></strong>
		        <br><strong><?php echo 'Created date :' . $rows['createdDate']; ?></strong>
		        <br><strong><?php echo 'Required volunteer number :' . $rows['volunteerNumber']; ?></strong>
		        <br><strong><?php echo 'Organizator name :' . $rows['oName']; ?></strong>
		        <br><strong><?php echo 'Organizator contacts :' . $rows['oNumber']; ?></strong>

		    	</p>
		        </div>

		    <?php
		        }
		    ?>
		        </div>
		    </div>
		    	<br><a href='createEvent.php' class='btn btn-success'>Create Ashaar</a>
			    <br><br><a href='index.php' class='btn btn-success'>Go Back</a>
		    </body>
		</body>
		</html>


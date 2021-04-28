
<?php
// 	session_start();
	require_once("config.php");
?>

<!doctype html>
<html>
	<head lang="en">

		<title>Upcoming events </title>

		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css" type="text/css" />
		<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<Style>

.upload-btn-wrapper {
  position: relative;
  overflow: hidden;
  display: inline-block;
}

.btn {
  border: 2px solid black;
  color: green;
  background-color: white;
  padding: 8px 20px;
  border-radius: 8px;
  font-size: 20px;
  font-weight: bold;
}

.upload-btn-wrapper input[type=file] {
  font-size: 100px;
  position: absolute;
  left: 0;
  top: 0;
  opacity: 0;
}

/*-----------------------------------------*/

.upload-btn-wrapper {
  position: relative;
  overflow: hidden;
  display: inline-block;
}
.fa {
  margin-left: 10px;
  padding: 10px;
  background: white;
  color : #0e5a33;
  border-radius: 50%;
    display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
.btn {
  border: 2px solid #0e5a33;
  background-color: #0e5a33;
  box-shadow: 8px 8px 18px 0px rgba(84, 181, 119, 0.3) !important;
  font-size: 18px;
  padding: 5px 5px 5px 28px;
  border-radius: 25px;
  color: white;
}
.btn:before{
  content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 0;
    -webkit-transition: all 0.5s;
    -moz-transition: all 0.5s;
    -o-transition: all 0.5s;
    transition: all 0.5s;
    opacity: 1;
    -webkit-transform: translate(-105%, 0);
    transform: translate(-105%, 0);
    background-color: rgba(255, 255, 255, 0.8);
}
.btn:hover:before{
    opacity: 0;
    -webkit-transform: translate(0, 0);
    transform: translate(0, 0);
}
.upload-btn-wrapper input[type=file] {
  font-size: 100px;
  position: absolute;
  left: 0;
  top: 0;
  opacity: 0;
}


</Style>
	</head>

	<body>

		

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
			
			$(document).ready(function (e) {
			 $("#form").on('submit',(function(e) {
				  e.preventDefault();
				  $.ajax({
				         url: "ajaxupload.php",
					   type: "POST",
					   data:  new FormData(this),
					   contentType: false,
					         cache: false,
					   processData:false,
					   beforeSend : function()
					   {
					    //$("#preview").fadeOut();
					    $("#err").fadeOut();
					   },
					   success: function(data)
					      {
					    if(data=='invalid')
					    {
					     // invalid file format.
					     $("#err").html("Invalid File !").fadeIn();
					    }
					    else
					    {
					     // view uploaded file.
					     $("#preview").html(data).fadeIn();
					     $("#form")[0].reset(); 
					    }
					      },
					     error: function(e) 
					      {
					    $("#err").html(e).fadeIn();
					      }          
				    });
			 	}));
			});
		</script>

		<div class="container">
		<div class="row">
		<div class="col-md-8">
<!-- 		<h1><a href="#" target="_blank"><img src="logo.png" width="80px"/>Ajax File Uploading with Database MySql</a></h1> -->
		<hr> 

		<h1>Event Creation</h1>


		<form id="form" action="Events.php" method="post" enctype="multipart/form-data">
		<div class="form-group">
		<label for="name">EVENT NAME</label>
		<input type="text" class="form-control" id="eventName" name="eventName" placeholder="Enter event name" required/>

		<div class="form-group">
		<label for="name">EVENT DETAILS</label>
		<input type="text" class="form-control" id="eventDetails" name="eventDetails" placeholder="Enter event detailes" required />
		</div>

		
		<div class="form-group">
		<label for="name">ADDRESS OF EVENT</label>
		<input type="text" class="form-control" id="eventAddress" name="eventAddress" placeholder="Enter address of event" required />
		</div>		

		<div class="form-group">
		<label for="name">START DATE AND TIME</label>
		<input type="text" class="form-control" id="startDate" name="startDate" placeholder="year-dd-mm hh:mm:ss" required />
		</div>

		<div class="form-group">
		<label for="name">END DATE AND TIME</label>
		<input type="text" class="form-control" id="endDate" name="endDate" placeholder="year-dd-mm hh:mm:ss" required />
		</div>

		<div class="form-group">
		<label for="name">REQUIRED NUMBER OF VOLUNTEERS</label>
		<input type="number" class="form-control" id="volunteerNumber" name="volunteerNumber" placeholder="Enter number of volunteers" required />
		</div>

		<div class="form-group">
		<label for="name">ORGANIZATOR NAME</label>
		<input type="text" class="form-control" id="oName" name="oName" placeholder="Enter organizator's name" required />
		</div>


		<div class="form-group">
		<label for="name">ORGANIZATOR NUMBER</label>
		<input type="text" class="form-control" id="oNumber" name="oNumber" placeholder="Enter organizator's number" required />
		</div>



		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<div class="upload-btn-wrapper">
		  <button class="btn">Upload a file<i style="font-size:18px" class="fa">&#xf093;</i></button>
		  <input type="file"  id="image" name="image" />
		</div>

		<br>


		<br>
		<input class="btn btn-success" type="submit" value="CREATE AN EVENT">
		</form>
		<div id="err"></div>
		<hr>

		</div>
		</div>
		</div>

        <br><a href='index.php' class='btn btn-info'>Go Back</a>
        
	</body>
</html>


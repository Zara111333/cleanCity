<?php
header('Content-Type: text/html; charset=utf-8');

session_start();
    
require_once ("config.php");
header("Content-Type: text/html; Charset=UTF-8");

    
if(isset($_POST['submit'])){

    $Ename = $_POST['Ename'];
    $Oname = $_POST['Oname'];
    $Date = $_POST['Date'];
    $Duration = $_POST['Duration'];
    $Address = $_POST['Address'];
    $numVolunteers = $_POST['numVolunteers'];
    

    
    $sql = "INSERT INTO Events (Event_name, Organizer_name, Date, Duration, Address, Volunteer_number)
    VALUES ('$Ename', '$Oname', '$Date', '$Duration', '$Address', '$numVolunteers')";

    if ($conn->query($sql) === TRUE) {
      echo "                      Successfully Saved         ";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
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
 <div class='container'>
 <h2>Create an Ashaar</h2>

  
 <form action = '' method='POST' enctype='multipart/form-data'>

      <div class='form-group'>
            <label>Event Name:</label>
            <input type='text' class='form-control' id='Ename' placeholder='Event Name' name='Ename' >
        </div>
 
      <div class='form-group'>
          <label>Orgonizer Name:</label>
          <input type='text' class='form-control' placeholder='Orgonizer Name' name='Oname' >
      </div>
 
        <div class='form-group'>
            <label>Date:</label>
            <input type='text' class='form-control' id='Date' placeholder='Enter Date' name='Date' >
        </div>
 
        <div class='form-group'>
            <label>Duration:</label>
            <input type='text' class='form-control' id='Duration' placeholder='Duration time' name='Duration' >
        </div>
 
        <div class='form-group'>
            <label>Address:</label>
            <input type='text' class='form-control' id='Address' placeholder='Address' name='Address' >
        </div>
 
        <div class='form-group'>
            <label>Number of volunteers needed:</label>
            <input type='text' class='form-control' id='Address' placeholder='Number of votunteers needed' name='numVolunteers' >
        </div>
 
     <input type='submit' name='submit' class='btn btn-default' value = 'Create'>

 </form>
 </body>
 </html>
 ");
       
       
//       <div class='form-group'>
//              <label>Images:</label>
//              <input type='file' class='form-control' id='images' name='images' multiple>
//       </div>
       

?>

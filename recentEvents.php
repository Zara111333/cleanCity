<?php
session_start();
include("config.php");

$result = mysqli_query($conn,"SELECT * FROM Events");

 
    
while($row = $result->fetch_assoc()) {
//        print("
//        <html>
//        <head>
//            <title>Welcome to clean city</title>
//            <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' integrity='sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u' crossorigin='anonymous'>
//            <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
//          <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
//        </head>
//        <body>
//        <div class='container'>
    
    $row['Event_name'];

    
//        </form>
//        </body>
//        </html>
//        ");
//    <h3> $row['Organizer_name']  </h3><br>
//    <h3> $row['Date']  </h3><br>
//    <h3> $row['Duration']  </h3><br>
//    <h3> $row['Event_name']  </h3><br>
//    <h3> $row['Address']  </h3><br>
//    <h3> $row['Volunteer_number']  </h3><br>
}
?>

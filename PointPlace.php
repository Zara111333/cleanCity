<?php
session_start();
require_once ("config.php");
date_default_timezone_set('Asia/Almaty');
header("Content-Type: text/html; Charset=UTF-8");

function toFile($mes)
{
    $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
    fwrite($myfile, $mes);
    fclose($myfile);
}


$ip = $_SERVER['REMOTE_ADDR'];
if (empty($_SESSION)) {
htmlGetBack("Anouthorized users cannot view this page","index.php" ,"Go back" );
logError("$ip tried to access this page without authorizing");

exit;
}

if (!empty($_GET)) {
    if (!$conn) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    
    
toFile("GEt mthod ");

    
     $id = $_SESSION['id'];
     $lat = number_format((float)$_GET['lat'], 6, '.', '');// need to sanitize any USER INPUT
     $lon = number_format((float)$_GET['lng'], 6, '.', ''); // need to sanitize any USER INPUT

     $level = $_GET['level'];
     $trash_com = $_GET['comment'];
     $username = $_SESSION['username'];


    $pointLocation = new pointLocation();
    $user_arr = mysqli_query($conn, "SELECT * from Users where id = '$id'");
    $row=mysqli_fetch_array($user_arr,MYSQLI_ASSOC);
    $points = array("$lat $lon");
    $bishkek;
    $inBish = "inside";
    foreach($points as $key => $point) {
        $inBish = $pointLocation->pointInPolygon($point, $bishkek);
    }
    
    if($inBish == "outside") {
        $message = "Your point placed does not belong to Bishkek";
        http_response_code(201); //201
    logError("$username ($id) tried to submit a point outside of Bishkek: $lat $lon");
        $link = "index.php";
        $message2 = "Try again";
        toFile("outside ");
        htmlGetBack($message, $link, $message2);
    }
    else {
        toFile("inside ");
        $sverdlov; $oktyabr; $lenin; $pervomay;
        foreach($points as $key => $point) {
        $region = $pointLocation->pointInPolygon($point, $sverdlov);
        }
        if($region == "inside") {
            $region = "sverdlov";
        }
        else {
            foreach($points as $key => $point) {
            $region = $pointLocation->pointInPolygon($point, $lenin);
        }
            if ($region == "inside") {
                $region = "lenin";
            }
            else {
                foreach($points as $key => $point) {
                $region = $pointLocation->pointInPolygon($point, $oktyabr);
            }
                if ($region == "inside") {
                $region = "oktyabr";
                }
                else {
                    foreach($points as $key => $point) {
                    $region = $pointLocation->pointInPolygon($point, $pervomay);
                    }
                    if ($region == "inside") {
                    $region = "pervomay";
                    }
                    else {
                        $region = "undefined";
                        $today;
                        logError("Point belongs to bishkek, but not to any region: $lat $lon");
                    }
                }
            }
        }

        $last = DateTime::createFromFormat ( "Y-m-d H:i:s", $row["lastSubmission"]);
        $available = date_add($last, date_interval_create_from_date_string('30 minutes'));
        $now = new Datetime();

        // if ($available < $now) { // > was so
        //     toFile("not available ");
        // $link = 'index.php';
        // $message = "Go back";
        // print("You cannot submit now, your next submission is available on ");
        // http_response_code(202);
        // exit;
        
        // echo date_format($available, 'Y-m-d H:i:s');
        // logError("$username($id) tried to submit before his allowance");
        // htmlGetBack("", $link, $message);
        // }
        // else {
            
           

           $sql = "INSERT INTO markers (lat, lng, level, user_id , comments, region, name) VALUES ('$lat', '$lon','$level' , '$id', '$trash_com', '$region', '$username')";
            mysqli_query($conn, "UPDATE Users set lastSubmission = now() where id = '$id'");
           
            if (mysqli_query($conn, $sql)) {
            
            echo "Latitude " . $lat . ", Longitude " . $lon . " , level of pollution " . $level . " and comment about trash " . $trash_com . " were successfully saved";
            echo '<h4><a href="index.php"> Return back </a></h4>';

            http_response_code(200);
            
            } 
            else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            logError(mysqli_error($conn));
            }
        
       // }


        function filterInput($input)
        {
            $text = strip_tags($text);
            $text = trim($text);
            $text = htmlspecialchars($text);
            return $text;
        }
    }

}
else if (isset($_POST['submit']))
{

    $lat = number_format((float)$_POST['xCoord'], 6, '.', '');// need to sanitize any USER INPUT xCoord
    $lon = number_format((float)$_POST['yCoord'], 6, '.', ''); // need to sanitize any USER INPUT yCoord

    $level = $_POST['lev']; 
    $trash_com = $_POST['comment'];


    $db_host = "localhost";
    $db_name = "ComfortCity";
    $db_user = "CleanP";
    $db_pass = "Clean312";
    $conn = mysqli_connect($db_host, $db_user,  $db_pass,$db_name);


    if (!$conn) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    $id = $_SESSION['id'];
    $user_arr = mysqli_query($conn, "SELECT * from Users where id = '$id'");
    $row=mysqli_fetch_array($user_arr,MYSQLI_ASSOC);
    $username = $row['uname'];
    $pointLocation = new pointLocation();
    $points = array("$lat $lon");
    $bishkek;
    $inBish = "inside";
    foreach($points as $key => $point) {
        $inBish = $pointLocation->pointInPolygon($point, $bishkek);
    }
    if($inBish == "outside") {
        $message = "Your point placed does not belong to Bishkek";
    logError("$username ($id) tried to submit a point outside of Bishkek: $lat $lon");
    http_response_code(201);
        $link = "index.php";
        $message2 = "Try again";
        htmlGetBack($message, $link, $message2);
    }
    else {
        $sverdlov; $oktyabr; $lenin; $pervomay;
        foreach($points as $key => $point) {
        $region = $pointLocation->pointInPolygon($point, $sverdlov);
        }
        if($region == "inside") {
            $region = "sverdlov";
        }
        else {
            foreach($points as $key => $point) {
            $region = $pointLocation->pointInPolygon($point, $lenin);
        }
            if ($region == "inside") {
                $region = "lenin";
            }
            else {
                foreach($points as $key => $point) {
                $region = $pointLocation->pointInPolygon($point, $oktyabr);
            }
                if ($region == "inside") {
                $region = "oktyabr";
                }
                else {
                    foreach($points as $key => $point) {
                    $region = $pointLocation->pointInPolygon($point, $pervomay);
                    }
                    if ($region == "inside") {
                    $region = "pervomay";
                    }
                    else {
                        $region = "undefined";
                        $today;
                        logError("Point belongs to bishkek, but not to any region: $lat $lon");
                    }
                }
            }
        }
        $last = DateTime::createFromFormat ( "Y-m-d H:i:s", $row["lastSubmission"]);
        $available = date_add($last, date_interval_create_from_date_string('1 day'));
    $now = new Datetime();
        if ($available > $now) {
        $link = 'index.php';
        $message = "Go back";
        print("You cannot submit now, your next submission is available on ");
    echo date_format($available, 'Y-m-d H:i:s');
	echo \n;
	echo date_format($now, 'Y-m-d H:i:s');
    logError("$username($id) tried to submit before his allowance");
        htmlGetBack("", $link, $message);
        }
        else {
                http_response_code(205);
            $sql = "INSERT INTO markers (lat, lng, level, userID , comments, region) VALUES ('$lat', '$lon','$level' , '$id', '$trash_com', '$region')";
            mysqli_query($conn, "UPDATE users set lastSubmission = now() where id = '$id'");
            if (mysqli_query($conn, $sql)) {
            echo "Latitude " . $lat . ", Longitude " . $lon . " , level of pollution " . $level . " and comment about trash " . $trash_com . " were successfully saved";
            echo '<h4><a href="index.php"> Return back </a></h4>';
            } 
            else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            logError(mysqli_error($conn));
            }
        }


        function filterInput($input)
        {
            $text = strip_tags($text);
            $text = trim($text);
            $text = htmlspecialchars($text);
            return $text;
        }
    }
}

else
{


        $html = "

        <html>

        <title> Location of Pollution </title>

        <meta charset='utf-8'>
                <center>



        <h4> Insert the location of Pollution </h4>

        <form action='' method='POST'>

        <table border='1px' cellpadding='5' cellspacing='0'>

        <tr><td>Latitude </td><td> <input type='number' step=any name='xCoord' required></td> </tr>

        <tr><td>Longitude </td><td> <input type='number' step=any name='yCoord' required> </td></tr>



        <tr><td> Level </td>
        

        <td>
        
        
        <input type='radio' name='lev' value='1'> 1 &nbsp; &nbsp;
        <input type='radio' name='lev' value='2'> 2 &nbsp; &nbsp;
        <input type='radio' name='lev' value='3'> 3 &nbsp; &nbsp;
        <input type='radio' name='lev' value='4'> 4 &nbsp; &nbsp;
        <input type='radio' name='lev' value='5'> 5 &nbsp; &nbsp;

        <br>    
        </td></tr>

        <tr><td> Comment </td><td> <textarea id='comment' name='comment' rows='10' cols='40'> </textarea> </td></tr>
    
        <tr><td colspan='2' align='center'> <input type='submit' name='submit' size = '40' value='Submit'> </td></tr>
	</table>
	</center>
        </html>
        ";

        print $html;
	htmlGetBack("Enter the values", "index.php", "Go Back");
}
?> 
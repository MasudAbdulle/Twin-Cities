<html>
    <body>
    
    </body>
</html>

<?php


define('DB_SERVER', 'localhost');
define('DB_SERVER_USERNAME', 'root');
define('DB_SERVER_PASSWORD', 'root');
define('DB_DATABASE', 'twin_cities');
$conn = mysqli_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD) or die("Database connection failed.");
mysqli_select_db($conn, DB_DATABASE) or die("Could not load " . DB_DATABASE . " database.");


$comment = $_POST['comment'] ;

$sql = "INSERT INTO comments(comment) VALUES   ('$comment')" ;

if(!$conn){
    echo "connection Error";
}
if(mysqli_query($conn ,$sql)){
 echo   '';

}else{
    echo mysqli_error($conn. "not working");
}

// twitter api keys
$comsumer_key = "24z16XrOPoXTSdufBRDPj757p";
$consumer_secret = "RbVgbrNoGtUBwViZjtTG4vT14BQUQhT7sGnzmDVAMLVNT3SDdm";
$access_token = "1488945105176346645-g93ycMmgVbo2qAlP7uHa6Noc4VRBmc";
 $access_token_secret = "1BSsvKG8YSLDCZeIinGBZeOOX2zybHHE4uHb3fblXGbot";


// waeather api keys 
// london weather api key
$APIURL = "http://api.openweathermap.org/data/2.5/forecast?lat=51.5072&lon=0.1276&appid=f2b44167daf69bf3115bae366876bf6f";

// new york Api weather key
$APIURL = "http://api.openweathermap.org/data/2.5/forecast?lat=40.7128&lon=-74.0060&appid=f2b44167daf69bf3115bae366876bf6f";


$tags = 'London,landmark';
$tags1 = 'NewYork,landmark';

// flikr api london 
$url ='https://www.flickr.com/services/feeds/photos_public.gne?format=php_serial&tags='.$tags;


// flir Api new york
$url ='https://www.flickr.com/services/feeds/photos_public.gne?format=php_serial&tags='.$tags1;





?>

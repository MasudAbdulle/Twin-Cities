<!-- ---------------------------------------- Search Tweets   ----------------------------------------  -->
<?php
error_reporting(0);
// twitter api 
require "vendor/autoload.php";
require "maps.php";
include "dbh.inc.php";


use Abraham\TwitterOAuth\TwitterOAuth;


// making api requests 
$connection = new TwitterOAuth($comsumer_key, $consumer_secret, $access_token, $access_token_secret);

$content  = $connection->get("account/verify_credentials");

$query = array(
    "q" => "#london",
    
   
    
);

$query2 = array(
    "q" => "#NYC",
    
    
    );
    
    
  if  (file_exists('twitter_result.data')) {
        $data = unserialize(file_get_contents('twitter_result.data'));
        if ($data['timestamp'] > time() - 10 * 60) {
            $twitter_result = $data['twitter_result'];
 }
   }
    
  if (!$twitter_result) { // cache doesn't exist or is older than 10 mins
        $twitter_result = file_get_contents('http://twitter.com/search/tweets/"#london","#londoneye","arsenal","londonevents"'); // or whatever your API call is
        $twitter_result1 = file_get_contents('http://twitter.com/search/tweets/"#newyork", "newyorksports"'); // or whatever your API call is
        $data = array ('twitter_result' => $twitter_result,$twitter_result1, 'timestamp' => time());
        file_put_contents('twitter_result.data', serialize($data));
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" 
    crossorigin="anonymous">

 <link href="style.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg ">
        <H1 style="">Twin Cities</H1>
        <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      
     
    <a href="http://localhost/testsite/cw/RssFeed.php">
    
    <img alt="Rss" src="RssPic.png"
    width="150" height="70">
 </a>

      </li>
    </nav><div class =  "row no-gutters">
        <div class = "col"><H1>Map of London</H1>
    <div id="map" class = "leftside" style="height: 550px; overflow: hidden;"></div>
    <table>
<div class =  "row no-gutters">
<div class = "col-md-6 no-gutters">

    <table class='table table-hover'>
    <div class = "leftside">
    <th>Weather in London</th>
       
<?php
//$apiKey =  "f2b44167daf69bf3115bae366876bf6f";

//$APIURL = "http://api.openweathermap.org/data/2.5/forecast?lat=51.5072&lon=0.1276&appid=f2b44167daf69bf3115bae366876bf6f";
date_default_timezone_set("Europe/London");
$contents = file_get_contents($APIURL);
$clima = json_decode($contents, true);

  foreach($clima['list'] as $data){
    // $dt =  $data['dt_txt'];
    // echo($dt);
    $dt =$data['dt'];
    $temp = $data['main']['temp'];
    $dtf= date('d/m/y  h:i:sa', $dt);
    $tempf = $temp - 273.15;?>
      
      <?php
    if(substr($dtf,10)== "09:00:00pm"){
      

     echo"<tr>";
  echo  "<td>$dtf $tempf ⁰C</td>";
 echo   "</tr>";
    }
 if(substr($dtf,10)== "10:00:00pm"){
      

    echo"<tr>";
  echo  "<td>$dtf $tempf ⁰C</td>";
  echo   "</tr>";
    }
    }
    ?>

</div>
</div>
</table>
    </div>

    <div class = "col-md-6 no-gutters">
    <H1>Map of New York</H1>
    <div id="map2" class  = "rightside" style="height: 550px;  overflow: hidden; colour: white;"></div>
    </table>
<table>
<div class =  "row no-gutters">
<div class = "col">

    <table class='table table-hover'>
    <div class = "rightside">
      <th>Weather in New York</th>
      <?php


//$apiKey =  "f2b44167daf69bf3115bae366876bf6f";

//$APIURL = "http://api.openweathermap.org/data/2.5/forecast?lat=40.7128&lon=-74.0060&appid=f2b44167daf69bf3115bae366876bf6f";
date_default_timezone_set("Europe/London");
$contents = file_get_contents($APIURL);
$clima = json_decode($contents, true);

  foreach($clima['list'] as $data){
   //  $dt =  $data['dt_txt'];
     //echo($dt);
    $dt =$data['dt'];
    $temp = $data['main']['temp'];
    
    $dtf= date('d/m/y  h:i:sa', $dt);
   
    $tempf = $temp - 273.15;

  //  round($tempf,1);  
    ?>
     <?php
    if(substr($dtf,10)== "09:00:00pm"){
      
       
     echo"<tr>";
  echo  "<td>$dtf $tempf ⁰C</td>";
 echo   "</tr>";
    }

if(substr($dtf,10)== "10:00:00pm"){
     

   echo"<tr>";
 echo  "<td> $dtf $tempf ⁰C </td>";
 echo   "</tr>";
}   
    }
    ?>
    </div>
    </div>
</div>
</div>

</table>

    
    </div>
    </div>
    </div>
    
</body>

</html>



<div class =  "row no-gutters">
    
    <div class = "col-md-6 no-gutters">
    <div id="div2" style="height: 600px;overflow:scroll;">
        <div class ="leftside"> 

      <H1>London Tweets</H1>  
        <?php
    $results = $connection->get('search/tweets', $query);?>
   
        <?php
    foreach ($results->statuses as $result){
        $SN = $result->user->screen_name;
        $tweet = $result->text;
        
        
        
        echo "Time and Date of Tweet: ".$result->created_at."<br />";
        echo ($SN . ": " . $tweet.
        '<br>
        <form action= "dbh.inc.php" method="post" >
    
        
        <input type="text" name = "comment"> 
        <button type = "submit" name ="submit">submit</button>
        </form>
        <br>');
       if(isset($_POST['submit'])){
        $comment = $_POST['comment'];
        $sql ="INSERT INTO tweets(screenName,tweet) VALUES ('$SN','$tweet')";
       
        }
        
        }
    ?>
        </div>
    </div>
    </div>  
    
    <div class = "col-md-6 no-gutters">
        <div id="div2" style="height: 600px;overflow:scroll;">
            <div class = "rightside">
              <H1>  New York Tweets</H1>
               <?php
        $results2 = $connection->get('search/tweets', $query2);?>
        
            <?php
        foreach ($results2->statuses as $result2){
        
            
            echo "Time and Date of Tweet: " .$result2->created_at."<br />";
            echo ($result2->user->screen_name . ": " . $result2->text.
            '<br>
            <form action= "dbh.inc.php" method="post" >
        
            <input type="text" name = "comment"> 
            <button type = "submit" name ="submit">submit</button>
            </form>
            <br>');
           
        
            }
            if(isset($_POST['submit'])){
                $comment = $_POST['comment'];
                }
           
                $sql1 = "INSERT INTO tweets(comment) VALUES   ('$comment')" ;
        ?>
        <br>
        <br>

            </div>
        </div>
    </div>
    
    <div class = "col-md-6 no-gutters">
        <div id="div2" style="height: 600px;overflow:scroll;">
            <div class = "rightside"><h1>London flikr Photos</h1>
            <?php

$tags = 'London,landmark';
$url ='https://www.flickr.com/services/feeds/photos_public.gne?format=php_serial&tags='.$tags;

$data = unserialize(file_get_contents($url));

$imgs = $data['items'];


//$url = 'https://farm'.$farm_id.'.staticflickr.com/'.$server_id.'/'.$photo_id.'_'.$secret_id.'.'.'jpg';//

foreach ($imgs as $img)
{
	echo '<img src ="'.$img['photo_url'].'">';
	//print_r($img);//
	//echo '<h1>' .$img -> title. '</h1>';

}
?>
            </div>
        </div>
    </div>
    <div class = "col-md-6 no-gutters">
        <div id="div2" style="height: 600px;overflow:scroll;">
            <div class = "rightside">
              <H1>  New York flikr photos</H1>
               
              <?php

$tags1 = 'NewYork,landmark';
$url ='https://www.flickr.com/services/feeds/photos_public.gne?format=php_serial&tags='.$tags1;

$data = unserialize(file_get_contents($url));

$imgs = $data['items'];


//$url = 'https://farm'.$farm_id.'.staticflickr.com/'.$server_id.'/'.$photo_id.'_'.$secret_id.'.'.'jpg';//

foreach ($imgs as $img)
{
	echo '<img src ="'.$img['photo_url'].'">';
	//print_r($img);//
	//echo '<h1>' .$img -> title. '</h1>';

}
?>
            </div>
        </div>
    </div>

</body>
</html>

        </div>
        
        
        </div>
        </div>
 
       


    </div>

  
</html>









<?php     

require "vendor/autoload.php";
include ('dbh.inc.php');

 use Abraham\TwitterOAuth\TwitterOAuth;


$comsumer_key = "nywKNwy61oupRuNoYX19VaSHX";
$consumer_secret = "P8ncoiKbQ1m0n86qW0AoFCutUVGBpJvYxuGrNCZt51wwT4KziT";
$access_token ="1488945105176346645-wb9kw3cOLOtB2ndPJtB7Ft0ywAo7Mh";
$access_token_secret="11V4oi42wDudB70qVcPRwtulFBd96EVZdA1hy0kbyjpNm";

// making api requests 
$connection = new TwitterOAuth($comsumer_key,$consumer_secret , $access_token, $access_token_secret);

$content  = $connection->get("account/verify_credentials");
$count = "&count=5";

$query = array(
    "q" => "#bristol",
   
  );

  
  

?>

   <html>
   <body>
       <?php
   $results = $connection->get('search/tweets', $query);
  
   foreach ($results->statuses as $result){
    echo "Time and Date of Tweet: ".$result->created_at."<br />";
echo ($result->user->screen_name . ": " . $result->text.
'<br>
<form action= "dbh.inc.php" method="post" >

<input type="text" name = "comment"> 
<button type = "submit" name ="submit">submit</button>
</form>
<br>');
if(isset($_POST['submit'])){
    $comment = $_POST['comment'];
}

}


?>





  

   </body>
   </html>

  

      
 
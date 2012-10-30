<?php
include_once('config.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Halloween Hotline</title>
    
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script src="http://js.pusher.com/1.12/pusher.min.js" type="text/javascript"></script>
    <script src="tools.js" type="text/javascript"></script>
    <link href="css/style.css" type="text/css" rel="stylesheet" />
  </head>
  <body>
  
    <h1>Halloween Hotline</h1>
    <?php
    $apikey = $config['quova']['key'];
    $secret = $config['quova']['secret'];
    $ipin = $_SERVER['REMOTE_ADDR'];
    $ch = curl_init();
    $ver = 'v1/';
    $method = 'ipinfo/'; 
    $timestamp = gmdate('U'); // 1200603038
    // echo $timestamp;   
    $sig = md5($apikey . $secret . $timestamp);
    $service = 'http://api.quova.com/';
    curl_setopt($ch, CURLOPT_URL, $service . $ver. $method. $ipin . '?apikey=' .
                 $apikey . '&sig='.$sig . '&format=json');
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($ch);
    $headers = curl_getinfo($ch);
    
    // close curl
    curl_close($ch);

    $number = "+1 646-480-1031";

    // return XML data
    if ($headers['http_code'] != '200') {

    } else {
      $data = json_decode($data);
      if ($data->ipinfo->Location->CountryData->country_code === "gb") {
        $number = "020 3322 4793";
      }
    }
    
    ?> 
    
    <h2>Call or SMS<br/><?php echo $number; ?></h2>
    <div id="credits">
      <a href='http://sydlawrence.com'>Handcrafted by Syd</a> |
      <a href='http://twilio.com'>Powered by Twilio</a> |
      <a href='http://klowner.deviantart.com/art/Halloween-Kitties-180167192'>Background by ~Klowner</a>
      
    </div>
  </body>
</html>

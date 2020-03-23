<?php 
include("config.php");

if(isset($_GET['code'])){
  $access_token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $_SESSION['gl_access_token'] = $access_token;
}
if(isset($_SESSION['gl_access_token'])){
  $client->setAccessToken($_SESSION['gl_access_token']);
}

$oauth = new Google_Service_Oauth2($client);
$user = $oauth->userinfo->get();
$picture_link = $user->picture;

$_SESSION["gl_email"]=$user->email;
$duration = time()+ 3600 * 24 * 60;
setcookie('gl_email', $_SESSION["gl_email"], $duration, "/");
setcookie('gl_access_token', $_SESSION['gl_access_token'], $duration, "/");

header("Location:".URL);


?>
<?php
header('Access-Control-Allow-Origin: *');
error_reporting(0);
session_start();
date_default_timezone_set('Asia/kolkata');

define("SITENAME","Viveka Essence Mart");

//define("URL","https://vivekaessencemart.com/");
define("URL","http://localhost/viveka/");

define("SERVER","localhost");
/*
define("DBUSER","airavlks_user");
define("DBPWD","Viveka12!@");
define("DATABASE","airavlks_viveka");*/

define("DBUSER","root");
define("DBPWD","");
define("DATABASE","viveka");

/**** instamojo api *****/
//live apis
define("APIKEY","013992a6c3e6a06118c21ac0e14f9082");
define("AUTHTOKEN","796bc43c4e05e068c1792f161cabb311");
define("SALT","101d3ce8e2ab4571869cf56678121b3f");

/**** facebook login api  *****/
require 'vendor/autoload.php';
$fb = new Facebook\Facebook([
  'app_id' => '287237605559854',
  'app_secret' => '2a268bf57480e119ca8f8cc1587e649f',
  'default_graph_version' => 'v2.10',
]);  
$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl(URL.'fbcallback.php', $permissions);
/**** facebook login api  *****/

$conn = mysqli_connect(SERVER,DBUSER,DBPWD,DATABASE);
if(!$conn){
    die("<h1>Connection could not established...</h1>");
}

$filename=basename($_SERVER['PHP_SELF']);
?>
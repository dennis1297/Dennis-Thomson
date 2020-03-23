<?php 
session_start();
include("config.php"); 
require 'vendor/autoload.php';

$fb = new Facebook\Facebook([
    'app_id' => '287237605559854',
    'app_secret' => '2a268bf57480e119ca8f8cc1587e649f',
    'default_graph_version' => 'v2.10',
    ]);
  
  $helper = $fb->getRedirectLoginHelper();

?>
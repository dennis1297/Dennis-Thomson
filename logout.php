<?php 
include("config.php"); 
include("functions.php");

unset($_SESSION["cus_id"]);
unset($_SESSION["cus_group_id"]);
unset($_SESSION["fname"]);
unset($_SESSION["lname"]);
unset($_SESSION["reg_type"]);
unset($_SESSION['fb_access_token']);


setcookie('cus_id', '', time()-3600, "/");
setcookie('cus_group_id', '', time()-3600, "/");
setcookie('fname', '', time()-3600, "/");
setcookie('lname', '', time()-3600, "/");
setcookie('reg_type', '', time()-3600, "/");
setcookie('fb_access_token', '', time()-3600, "/");
setcookie('page', '', time()-3600, "/");
setcookie('user_id', '', time()-3600, "/");

header("Location:".URL);
exit();
?>
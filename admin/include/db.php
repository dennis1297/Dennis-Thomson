<?php
header('Access-Control-Allow-Origin: *');
error_reporting(0);
session_start();

define("SITEURL","http://localhost/viveka/");
define("ADMINURL","http://localhost/viveka/admin/");

define("NAME","Vivekaessencemart");

define("SERVER","localhost");

/*define("DBUSER","airavlks_user");
define("DBPWD","Viveka12!@");
define("DATABASE","airavlks_viveka");*/

define("DBUSER","root");
define("DBPWD","");
define("DATABASE","viveka");

date_default_timezone_set('Asia/Kolkata');

$conn=mysqli_connect(SERVER,DBUSER,DBPWD); 
mysqli_select_db($conn , DATABASE);

function dispdateonly($date){
    if($date!=''){
        $d=strtotime($date);
        $fdate=date("d-m-Y",$d);
    }
    else{
        $fdate = '';
    }    
    return $fdate;
}
?>
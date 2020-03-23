<?php 
error_reporting(0);

$cusname=$_POST["cusname"];
$cusemail=$_POST["cusemail"];
$cusphone=$_POST["cusphone"];
$cusmsg=$_POST["cusmsg"];

$message="<table border='2px' style='border-collapse:collapse;'>";
$message.='<tr><td>Name :</td><td>'.$cusname.'</td></tr>';
$message.='<tr><td>Email :</td><td>'.$cusemail.'</td></tr>';
$message.='<tr><td>Phone :</td><td>'.$cusphone.'</td></tr>';
$message.='<tr><td>Message :</td><td>'.$cusmsg.'</td></tr>';
$message.='</table>';

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= 'From: <admin@vivekaessencemart.com>' . "\r\n" .'Reply-To: <admin@vivekaessencemart.com>';
$from = "admin@vivekaessencemart.com";

$n=mail("admin@vivekaessencemart.com", 'Enquiry regarding', $message, $headers);

echo $_POST["cusname"];

if($n)
	echo "1";
else
	echo "0";
?>
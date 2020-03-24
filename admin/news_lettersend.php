<?php
session_start();
include "include/db.php";
 
$id=$_POST["nsid"];

$news=mysqli_fetch_assoc(mysqli_query($conn,"select *from tbl_newsletter where nl_id='$id'")); 
$sel=mysqli_query($conn, "select *from tbl_newslettersubs where status='Y'");

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= 'From: do-not-reply@qbrainstorm.com'. "\r\n" .
'Reply-To: do-not-reply@qbrainstorm.com' . "\r\n" .
'X-Mailer: PHP/' . phpversion();
$from = "do-not-reply@qbrainstorm.com";
while($rs=mysqli_fetch_assoc($sel))
{
	mail($rs["email"], $news["nl_title"] ,$news["nl_content"], $headers );
}
echo json_encode("success");
?>
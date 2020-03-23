<?php
//session id
function generateRandomString($length = 15) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
//session id

/**** generate session ******/
if(isset($_SESSION["sessionid"])){
    $_SESSION["sessionid"]=$_SESSION["sessionid"];
}
else{
    $_SESSION["sessionid"]=generateRandomString();
}
/**** generate session ******/

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
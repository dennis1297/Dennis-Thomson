<?php 
include("config.php"); 
include("functions.php"); 

require 'vendor/autoload.php';

/*** customer detail ****/
$cust = mysqli_fetch_assoc(mysqli_query($conn,"select email,mobileno from tbl_customer where customer_id='".$_COOKIE["cus_id"]."'"));
/*** customer detail ****/

/*** orderid no *****/
mysqli_query($conn,"insert into tbl_order_inv (customer_id,date_added) values ('".$_COOKIE["cus_id"]."','".date("Y-m-d H:i:s")."')");
$invid = mysqli_insert_id($conn);
/*** orderid no *****/

$invoice_no = "ORD".sprintf('%04d',$invid);
$total = $_POST["totalamount"];
$paymode = $_POST["payment_method"];

$paymentaddress = $_POST["payment_address"];
$paymentaddrssid = $_POST["payment_addressid"];

/*** billing address ****/
if($paymentaddress!='existing'){ /*** new address */
    $payfname = $_POST["payment_firstname"];
    $paylname = $_POST["payment_lastname"];
    $payemail = $_POST["payment_email"];
    $paymobile = $_POST["payment_mobile"];
    $paycompany = $_POST["payment_company"];
    $payaddrs1 = $_POST["payment_address_1"];
    $payaddrs2 = $_POST["payment_address_2"];
    $paycity = $_POST["payment_city"];
    $paypincode = $_POST["payment_postcode"];
    $paystate = $_POST["payment_state"];
    $paycountry = $_POST["payment_country"];

    mysqli_query($conn,"insert into tbl_address (customer_id,firstname,lastname,company,address_1,address_2,city,postcode,country,state) values ('".$_COOKIE["cus_id"]."','$payfname','$paylname','$paycompany','$payaddrs1','$payaddrs2','$paycity','$paypincode','$paycountry','$paystate')");
} /*** new address */
else{ /*** existing address */
    $paydets = mysqli_fetch_assoc(mysqli_query($conn,"select *from tbl_address where customer_id='".$_COOKIE["cus_id"]."' and address_id='$paymentaddrssid'"));

    $payfname = $paydets["firstname"];
    $paylname = $paydets["lastname"];
    $payemail = $cust["email"];
    $paymobile = $cust["mobileno"];
    $paycompany = $paydets["company"];
    $payaddrs1 = $paydets["address_1"];
    $payaddrs2 = $paydets["address_2"];
    $paycity = $paydets["city"];
    $paypincode = $paydets["postcode"];
    $paystate = $paydets["state"];
    $paycountry = $paydets["country"];
}/*** existing address */
/*** billing address ****/

/*** billing & delivery not same *****/
$shiptrue = $_POST["shipping_enable"];
$deliveryaddrssid = $_POST["delivery_address_id"];
if($shiptrue==1){//if billing same as delivery
    $shipfname = $payfname;
    $shiplname = $paylname;
    $shipemail = $payemail;
    $shipmobile = $paymobile;
    $shipcompany = $paycompany;
    $shipaddrs1 = $payaddrs1;
    $shipaddrs2 = $payaddrs2;
    $shipcity = $paycity;
    $shippincode = $paypincode;
    $shipstate = $paystate;
    $shipcountry = $paycountry;
}//if billing same as delivery
else{
    if($paymentaddress!='existing'){ /*** new address */
        $shipfname = $_POST["shipping_firstname"];
        $shiplname = $_POST["shipping_lastname"];
        $shipemail = $_POST["shipping_email"];
        $shipmobile = $_POST["shipping_mobile"];
        $shipcompany = $_POST["shipping_company"];
        $shipaddrs1 = $_POST["shipping_address_1"];
        $shipaddrs2 = $_POST["shipping_address_2"];
        $shipcity = $_POST["shipping_city"];
        $shippincode = $_POST["shipping_postcode"];
        $shipstate = $_POST["shipping_state"];
        $shipcountry = $_POST["shipping_country"];

        mysqli_query($conn,"insert into tbl_address (customer_id,firstname,lastname,company,address_1,address_2,city,postcode,country,state) values ('".$_COOKIE["cus_id"]."','$shipfname','$shiplname','$shipcompany','$shipaddrs1','$shipaddrs2','$shipcity','$shippincode','$shipcountry','$shipstate')");

    }/*** new address */
    else{/*** existing address */
        $shipdets = mysqli_fetch_assoc(mysqli_query($conn,"select *from tbl_address where customer_id='".$_COOKIE["cus_id"]."' and address_id='$deliveryaddrssid'"));

        $shipfname = $shipdets["firstname"];
        $shiplname = $shipdets["lastname"];
        $shipemail = $cust["email"];
        $shipmobile = $cust["mobileno"];
        $shipcompany = $shipdets["company"];
        $shipaddrs1 = $shipdets["address_1"];
        $shipaddrs2 = $shipdets["address_2"];
        $shipcity = $shipdets["city"];
        $shippincode = $shipdets["postcode"];
        $shipstate = $shipdets["state"];
        $shipcountry = $shipdets["country"];
    }/*** existing address */
}
/*** billing & delivery not same *****/

/**** inert order datail *****/
mysqli_query($conn,"insert into tbl_order (invoice_no,customer_id,payment_firstname,payment_lastname,payment_email,payment_mobile,payment_company,payment_address_1,payment_address_2,payment_city,payment_postcode,payment_state,payment_country,shipping_firstname,shipping_lastname,shipping_email,shipping_mobile,shipping_company,shipping_address_1,shipping_address_2,shipping_city,shipping_postcode,shipping_state,shipping_country,total,paymode,order_status_id,payment_status,date_added,date_modified) values('$invoice_no','".$_COOKIE["cus_id"]."','$payfname','$paylname','$payemail','$paymobile','$paycompany','$payaddrs1','$payaddrs2','$paycity','$paypincode','$paystate','$paycountry','$shipfname','$shiplname','$shipemail','$shipmobile','$shipcompany','$shipaddrs1','$shipaddrs2','$shipcity','$shippincode','$shipstate','$shipcountry','$total','$paymode','7','Pending','".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."')");
$order_id = mysqli_insert_id($conn);
/**** inert order datail *****/

/*** insert order history ****/
mysqli_query($conn,"insert into tbl_order_history(order_id,order_status_id,date_added) values ('$order_id','7','".date("Y-m-d H:i:s")."')");
/*** insert order history ****/

/*** insert order product  *****/
$selcart = mysqli_query($conn,"select *from tbl_cart where customer_id='".$_COOKIE["cus_id"]."'");
while($rescart = mysqli_fetch_assoc($selcart)){	
    $prodname = mysqli_fetch_assoc(mysqli_query($conn,"select prod_name from tbl_product where prod_id='".$rescart["product_id"]."' limit 1"));
    mysqli_query($conn,"insert into tbl_order_product (order_id,product_id,name,prod_option,prod_option_desc,quantity,price,total) values ('$order_id','".$rescart["product_id"]."','".$prodname["prod_name"]."','".$rescart["pro_option_desc"]."','".$rescart["pro_option"]."','".$rescart["pro_qty"]."','".$rescart["pro_unitprice"]."','".$rescart["pro_totprice"]."')");
}
/*** insert order product  *****/

/**** delete cart *****/
mysqli_query($conn,"delete from tbl_cart where customer_id='".$_COOKIE["cus_id"]."'");
/**** delete cart *****/


$api = new Instamojo\Instamojo(APIKEY, AUTHTOKEN);

try {
    $response = $api->paymentRequestCreate(array(
        "buyer_name" => $payfname." ".$paylname,
        "phone" => "+91".$paymobile,
        "purpose" => $invoice_no,
        "amount" => $total,
        "send_email" => true,
        "email" => $payemail,
        "redirect_url" => URL."order"
        ));
    //print_r($response);

    $pay_url = $response['longurl'];
    header("Location: $pay_url");
    exit();
}
catch (Exception $e) {
    print('Error: ' . $e->getMessage());
}
?>
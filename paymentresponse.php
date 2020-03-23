<?php 
include("config.php"); 
include("functions.php"); 

require 'vendor/autoload.php';

$api = new Instamojo\Instamojo(APIKEY, AUTHTOKEN);
$payid = $_GET["payment_request_id"];
if($payid==''){
    echo '<script>window.location.href="'.URL.'";</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Viveka Essence Mart | Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php include "css.php";?>  
</head>
<body>

<?php include "header.php";?>
<!-- wrapper-->
<div class="wrapper">
    <?php include "category-carousel.php";?>

    <div class="category-products mt-80 mb-40">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    if(isset($_SESSION["rescount"])){
                        $_SESSION["rescount"]=$_SESSION["rescount"];
                    }
                    else{
                        $_SESSION["rescount"] = 1;
                    }

                    if($_SESSION["rescount"]==1){
                        $_SESSION["rescount"]++;                                      

                        try {
                            $response = $api->paymentRequestStatus($payid);

                            /*** get order id by invoice no. ***/
                            $orderid = mysqli_fetch_assoc(mysqli_query($conn,"select order_id from tbl_order where invoice_no='".$response["purpose"]."'")); 
                            /*** get order id by invoice no. ***/  

                            /***** if payment success ****/
                            if($_GET["payment_status"]=='Credit'){
                                $order_status = 7;
                                $payment_status = 'Success';
                                $txt = "Your order ".$response["purpose"]." has been successfully placed.Thank you for shopping at ".SITENAME.".";

                                /*** subtract product stock ****/
                                $selordpro = mysqli_query($conn,"select product_id,prod_option_desc,quantity from tbl_order_product where order_id='".$orderid["order_id"]."'");
                                while($resordpro = mysqli_fetch_assoc($selordpro)){
                                    $proop = json_decode($resordpro["prod_option_desc"]);
                                    foreach($proop as $key=>$value){
                                        $stock = mysqli_fetch_assoc(mysqli_query($conn,"select quantity from tbl_product_option_value where product_id='".$resordpro["product_id"]."' and product_option_id='$key' and product_option_value_id='$value'"));

                                        $opqty = (int)$stock["quantity"]-(int)$resordpro["quantity"];
                                        mysqli_query($conn,"update tbl_product_option_value set quantity='$opqty' where product_id='".$resordpro["product_id"]."' and product_option_id='$key' and product_option_value_id='$value'");
                                    }
                                    $prod = mysqli_fetch_assoc(mysqli_query($conn,"select prod_qty from tbl_product where prod_id='".$resordpro["product_id"]."'"));
                                    $prqty = (int)$prod["prod_qty"]-(int)$resordpro["quantity"];
                                    mysqli_query($conn,"update tbl_product set prod_qty='$prqty' where prod_id='".$resordpro["product_id"]."'");
                                }
                                /*** subtract product stock ****/

                            }/***** if payment success ****/
                            else{/***** if payment failed ****/
                                $order_status = 5;
                                $payment_status = 'Failed';
                                $txt = "Your order ".$response["purpose"]." has not been placed. Due to payment ".$_GET["payment_status"].".";

                            }/***** if payment failed ****/

                            /*** update order history ****/                                               
                            mysqli_query($conn,"update tbl_order_history set order_status_id='$order_status' where order_id='".$orderid["order_id"]."'");
                            /*** update order history ****/

                            /*** update order status *****/
                            mysqli_query($conn,"update tbl_order set order_status_id='$order_status',payment_status='$payment_status',payment_no='".$_GET["payment_id"]."',date_modified='".date("Y-m-d H:i:s")."' where invoice_no='".$response["purpose"]."'");
                            /*** update order status *****/
        
                            echo "<h3>".$txt."</h3>";
                            echo "<a class='btn btn-viewall' href=".URL.">Continue Shopping</a>";
        
                            //print_r($response);
                        }
                        catch (Exception $e) {
                            //print('Error: ' . $e->getMessage());
                            echo "<h3>Error contact support.</h3>";
                        }
                    }
                    else{
                        unset($_SESSION["rescount"]);
                        echo '<script>window.location.href="'.URL.'";</script>';
                    }     
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php include "footer.php";?>
</div>
<!-- wrapper-->
<?php include "js.php";?>

</body>
</html>
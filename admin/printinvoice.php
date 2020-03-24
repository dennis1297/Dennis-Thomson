<?php
include "include/db.php";
$res=mysqli_fetch_assoc(mysqli_query($conn,"select *from tbl_order where order_id='".$_GET["ordid"]."'"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $res["invoice_no"]?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

  
<div class="container">
  <div style="page-break-after: always;">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th colspan="2">Order Details</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="width: 50%;">
            <address style="margin-bottom:0;">
              <strong><?php echo NAME?></strong><br>
              285/128, walltax road,Parktown Chennai, India 600003. 
            </address>
            <b>Telephone</b> 044-25350771, 044-25354240, 044-42153572, 919566243091, 919789801374<br>
            <b>E-Mail</b> vivekaess@gmail.com, vivekaessencemart@yahoo.co.in<br>
          </td>
          <td style="width: 50%;">
            <b>Order Date</b> <?php echo dispdateonly($res["date_added"])?><br>
            <b>Order ID:</b> <?php echo $res["invoice_no"]?><br>
            <b>Payment Method</b> <?php echo $res["paymode"]?><br>
            </td>
        </tr>
      </tbody>
    </table>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Payment Address</th>
          <th>Shipping Address</th>
        </tr>
      </thead>
      <tbody>
        <tr>
        <td><?php echo $res["payment_firstname"]." ".$res["payment_lastname"]?><?php if($res["payment_company"]!='') echo "<br>".$res["payment_company"]?><br><?php echo $res["payment_address_1"]?><?php if($res["payment_address_2"]!='') echo "<br>".$res["payment_address_2"]?><br><?php echo $res["payment_city"]." - ".$res["payment_postcode"]."<br>".$res["payment_state"]."<br>".$res["payment_mobile"]?></td>
        <td><?php echo $res["shipping_firstname"]." ".$res["shipping_lastname"]?><?php if($res["shipping_company"]!='') echo "<br>".$res["shipping_company"]?><br><?php echo $res["shipping_address_1"]?><?php if($res["shipping_address_2"]!='') echo "<br>".$res["shipping_address_2"]?><br><?php echo $res["shipping_city"]." - ".$res["shipping_postcode"]."<br>".$res["shipping_state"]."<br>".$res["shipping_mobile"]?></td>
        </tr>
      </tbody>
    </table>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th style="width:50%;">Product</th>
          <th>Quantity</th>
          <th>Unit Price</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
      <?php 
      $pdt=mysqli_query($conn,"select *from tbl_order_product where order_id='".$_GET["ordid"]."'");
      while($rpdts=mysqli_fetch_assoc($pdt)) {
        $propt = json_decode($rpdts["prod_option"]);
      ?>
        <tr>
          <td>
            <?php echo $rpdts["name"]?><br>
            <?php 
            foreach($propt as $key=>$value){
              echo "<small>- ".$key." : ".$value."</small><br>";
            }
            ?>
          </td>
          <td><?php echo $rpdts["quantity"]?></td>
          <td>Rs. <?php echo $rpdts["price"]?></td>
          <td>Rs. <?php echo $rpdts["total"]?></td>
        </tr>
      <?php
      }
      ?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="3" align="right">Total</td><td>Rs. <?php echo $res["total"]?></td>
        </tr>
      </tfoot>
    </table>
  </div>
</div>

<script>
  window.print();
</script>

</body>
</html>
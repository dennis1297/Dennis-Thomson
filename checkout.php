<?php 
include("config.php"); 
include("functions.php"); 
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

<div class="wrapper">
  
  <?php include "category-carousel.php";?>

  <!-- single product starts -->
  <div class="category-products mt-80 mb-40">
    <div class="container">
      
      <div id="checkrestxt"></div>

      <div class="row">

        <?php if(isset($_COOKIE["cus_id"])) {//if loggedin ?>
          <form id="checkoutForm" action="<?php echo URL?>paymentrequest.php" method="post">
          <!--- col 8 --->
          <div class="col-md-8">
            <!-- payment address ---->         
            <div id="payment-address">
              <div class="quickcheckout-heading"><i class="fa fa-user"></i> Account & Billing Details</div>
              <div class="quickcheckout-content">
                <div class="col-sm-12">
                  <?php $seladr = mysqli_query($conn,"select *from tbl_address where customer_id='".$_COOKIE["cus_id"]."'"); 
                  if(mysqli_num_rows($seladr)>0) {
                  $payexistchk = 'checked';                    
                  ?>
                  <div class="radio">
                    <label>
                      <input type="radio" name="payment_address" value="existing" <?php echo $payexistchk?>>
                      I want to use an existing address</label>
                  </div>
                  <div id="payment-existing">
                    <select name="payment_addressid" class="form-control">
                      <?php                      
                      while($resadr = mysqli_fetch_assoc($seladr)){
                        $address = $resadr["firstname"]." ".$resadr["lastname"].", ".$resadr["address_1"].", ";
                        if($resadr["address_2"]!=''){ $address .= $resadr["address_2"].", "; }
                        $address .= $resadr["city"]."-".$resadr["postcode"].", ".$resadr["country"].", ".$resadr["state"];
                        
                        echo '<option value="'.$resadr["address_id"].'">'.$address.'</option>';
                      }
                      ?>
                    </select>
                  </div>
                  <?php } else { $paynewchk = 'checked';}?>
                </div>
                <div class="col-sm-12">
                  <div class="radio">
                    <label>
                      <input type="radio" name="payment_address" value="new" <?php echo $paynewchk?>>
                      I want to use a new address</label>
                  </div>
                </div>
                <div id="payment-new">
                  <div class="col-sm-6">
                    <label>First Name<span class="mandatory">*</span></label>
                    <input type="text" name="payment_firstname" class="form-control" id="bill-firstname">
                  </div>            
                  <div class="col-sm-6">
                    <label>Last Name<span class="mandatory">*</span></label>
                    <input type="text" name="payment_lastname" class="form-control" id="bill-lastname">
                  </div>
                  <div class="col-sm-6">
                    <label>E-Mail<span class="mandatory">*</span></label>
                    <input type="text" name="payment_email" class="form-control" id="bill-email">
                  </div>
                  <div class="col-sm-6">
                    <label>Mobile no.<span class="mandatory">*</span></label>
                    <input type="tel" name="payment_mobile" class="form-control" id="bill-telephone" onKeyPress="return enterNumerics(event);" maxlength="10">
                  </div>
                  <div class="col-sm-6">
                    <label>Company</label>
                    <input type="text" name="payment_company" class="form-control" id="bill-company">
                  </div>
                  <div class="col-sm-6">
                    <label>Address 1<span class="mandatory">*</span></label>
                    <input type="text" name="payment_address_1" class="form-control" id="bill-address1">
                  </div>
                  <div class="col-sm-6">
                    <label>Address 2</label>
                    <input type="text" name="payment_address_2" class="form-control" id="bill-address2">
                  </div>
                  <div class="col-sm-6">
                    <label>City<span class="mandatory">*</span></label>
                    <input type="text" name="payment_city" class="form-control" id="bill-city">
                  </div>
                  <div class="col-sm-6">
                    <label>Post Code<span class="mandatory">*</span></label>
                    <input type="tel" name="payment_postcode" class="form-control" id="bill-postcode" onKeyPress="return enterNumerics(event);" maxlength="6">
                  </div>
                  <div class="col-sm-6">
                    <label class="control-label">Country<span class="mandatory">*</span></label>
                    <select name="payment_country" class="form-control" id="bill-country">			  				
                      <option value="India" selected>India</option>
                    </select>
                  </div>
                  <div class="col-sm-6">
                    <label>State<span class="mandatory">*</span></label>
                    <select name="payment_state" class="form-control" id="bill-state">
                      <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                      <option value="Andhra Pradesh">Andhra Pradesh</option>
                      <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                      <option value="Assam">Assam</option>
                      <option value="Bihar">Bihar</option>
                      <option value="Chandigarh">Chandigarh</option>
                      <option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
                      <option value="Daman and Diu">Daman and Diu</option>
                      <option value="Delhi">Delhi</option>
                      <option value="Goa">Goa</option>
                      <option value="Gujarat">Gujarat</option>
                      <option value="Haryana">Haryana</option>
                      <option value="Himachal Pradesh">Himachal Pradesh</option>
                      <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                      <option value="Karnataka">Karnataka</option>
                      <option value="Kerala">Kerala</option>
                      <option value="Lakshadweep Islands">Lakshadweep Islands</option>
                      <option value="Madhya Pradesh">Madhya Pradesh</option>
                      <option value="Maharashtra">Maharashtra</option>
                      <option value="Manipur">Manipur</option>
                      <option value="Meghalaya">Meghalaya</option>
                      <option value="Mizoram">Mizoram</option>
                      <option value="Nagaland">Nagaland</option>
                      <option value="Orissa">Orissa</option>
                      <option value="Puducherry">Puducherry</option>
                      <option value="Punjab">Punjab</option>
                      <option value="Rajasthan">Rajasthan</option>
                      <option value="Sikkim">Sikkim</option>
                      <option value="Tamil Nadu" selected>Tamil Nadu</option>
                      <option value="Telangana">Telangana</option>
                      <option value="Tripura">Tripura</option>
                      <option value="Uttar Pradesh">Uttar Pradesh</option>
                      <option value="West Bengal">West Bengal</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div style="margin-top:20px;">
                    <input type="checkbox" name="shipping_enable" value="1" id="shipping" checked="checked">
                    <label for="shipping">My delivery and billing addresses are the same.</label>
                  </div>
                </div>
              </div>
            </div>
            <!-- payment address ---->
            <!-- shipping address ---->
            <div id="shipping-address">
              <div class="quickcheckout-heading"><i class="fa fa-user"></i> Delivery Details</div>
              <div class="quickcheckout-content">
                <div class="col-sm-12">
                  <?php $seladr = mysqli_query($conn,"select *from tbl_address where customer_id='".$_COOKIE["cus_id"]."'");
                  if(mysqli_num_rows($seladr)>0){
                    $shipexistchk = 'checked';
                  ?>
                  <div class="radio">
                    <label>
                      <input type="radio" name="delivery_address" value="existing" <?php echo $shipexistchk?>>
                      I want to use an existing address</label>
                  </div>
                  <div id="delivery-existing">
                    <select name="delivery_address_id" class="form-control">
                      <?php                      
                      while($resadr = mysqli_fetch_assoc($seladr)){
                        $address = $resadr["firstname"]." ".$resadr["lastname"].", ".$resadr["address_1"].", ";
                        if($resadr["address_2"]!=''){ $address .= $resadr["address_2"].", "; }
                        $address .= $resadr["city"]."-".$resadr["postcode"].", ".$resadr["country"].", ".$resadr["state"];

                        echo '<option value="'.$resadr["address_id"].'">'.$address.'</option>';
                      }
                      ?>
                    </select>
                  </div>
                  <?php } else { $shipnewchk = 'checked';}?>
                </div>
                <div class="col-sm-12">
                  <div class="radio">
                    <label>
                      <input type="radio" name="delivery_address" value="new" <?php echo $shipnewchk?>>
                      I want to use a new address</label>
                  </div>
                </div>
                <!-- delivery new-->
                <div id="delivery-new">
                  <div class="col-sm-6">
                    <label>First Name<span class="mandatory">*</span></label>
                    <input type="text" name="shipping_firstname" class="form-control" id="deli-firstname">
                  </div>            
                  <div class="col-sm-6">
                    <label>Last Name<span class="mandatory">*</span></label>
                    <input type="text" name="shipping_lastname" class="form-control" id="deli-lastname">
                  </div>
                  <div class="col-sm-6">
                    <label>E-Mail<span class="mandatory">*</span></label>
                    <input type="text" name="shipping_email" class="form-control" id="deli-email">
                  </div>
                  <div class="col-sm-6">
                    <label>Mobile<span class="mandatory">*</span></label>
                    <input type="tel" name="shipping_mobile" class="form-control" id="deli-telephone" onKeyPress="return enterNumerics(event);" maxlength="10">
                  </div>
                  <div class="col-sm-6">
                    <label>Company</label>
                    <input type="text" name="shipping_company" class="form-control" id="deli-company">
                  </div>
                  <div class="col-sm-6">
                    <label>Address 1<span class="mandatory">*</span></label>
                    <input type="text" name="shipping_address_1" class="form-control" id="deli-address1">
                  </div>
                  <div class="col-sm-6">
                    <label>Address 1</label>
                    <input type="text" name="shipping_address_2" class="form-control" id="deli-address2">
                  </div>
                  <div class="col-sm-6">
                    <label>City<span class="mandatory">*</span></label>
                    <input type="text" name="shipping_city" class="form-control" id="deli-city">
                  </div>
                  <div class="col-sm-6">
                    <label>Post Code<span class="mandatory">*</span></label>
                    <input type="tel" name="shipping_postcode" class="form-control" id="deli-postcode" onKeyPress="return enterNumerics(event);" maxlength="6">
                  </div>
                  <div class="col-sm-6">
                    <label class="control-label">Country<span class="mandatory">*</span></label>
                    <select name="shipping_country" class="form-control" id="deli-country">			  				
                      <option value="India" selected>India</option>
                    </select>
                  </div>
                  <div class="col-sm-6">
                    <label>State<span class="mandatory">*</span></label>
                    <select name="shipping_state" class="form-control" id="deli-state">
                      <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                      <option value="Andhra Pradesh">Andhra Pradesh</option>
                      <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                      <option value="Assam">Assam</option>
                      <option value="Bihar">Bihar</option>
                      <option value="Chandigarh">Chandigarh</option>
                      <option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
                      <option value="Daman and Diu">Daman and Diu</option>
                      <option value="Delhi">Delhi</option>
                      <option value="Goa">Goa</option>
                      <option value="Gujarat">Gujarat</option>
                      <option value="Haryana">Haryana</option>
                      <option value="Himachal Pradesh">Himachal Pradesh</option>
                      <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                      <option value="Karnataka">Karnataka</option>
                      <option value="Kerala">Kerala</option>
                      <option value="Lakshadweep Islands">Lakshadweep Islands</option>
                      <option value="Madhya Pradesh">Madhya Pradesh</option>
                      <option value="Maharashtra">Maharashtra</option>
                      <option value="Manipur">Manipur</option>
                      <option value="Meghalaya">Meghalaya</option>
                      <option value="Mizoram">Mizoram</option>
                      <option value="Nagaland">Nagaland</option>
                      <option value="Orissa">Orissa</option>
                      <option value="Puducherry">Puducherry</option>
                      <option value="Punjab">Punjab</option>
                      <option value="Rajasthan">Rajasthan</option>
                      <option value="Sikkim">Sikkim</option>
                      <option value="Tamil Nadu" selected>Tamil Nadu</option>
                      <option value="Telangana">Telangana</option>
                      <option value="Tripura">Tripura</option>
                      <option value="Uttar Pradesh">Uttar Pradesh</option>
                      <option value="West Bengal">West Bengal</option>
                    </select>
                  </div>                
                </div>
                <!-- delivery new-->
              </div>
            </div>
            <!-- shipping address ---->
          </div>
          <!--- col 8 --->
          <!--- col 4 --->
          <div class="col-md-4">
            <!--- order summary --->
            <div id="cart1" style="">
              <div class="quickcheckout-content" style="padding: 0px;">
                <table class="quickcheckout-cart">              
                  <thead>
                    <tr>
                      <td class="name">Product</td>
                      <td class="quantity">Qty</td>
                      <td class="price1">Unit Price</td>
                      <td class="total">Total</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $total = 0;
                    $getcrt = mysqli_query($conn,"select cartid,customer_id,sessionid,product_id,pro_option,pro_option_desc,pro_qty,pro_unitprice,pro_totprice,prod_name,prod_slug,prod_image from tbl_cart tc inner join tbl_product tp on tc.product_id=tp.prod_id inner join tbl_product_images tpi on tc.product_id=tpi.prod_id where customer_id='".$_COOKIE["cus_id"]."'");
                    while($rescrt = mysqli_fetch_assoc($getcrt)) { 
                    ?>
                    <tr>
                      <td class="name">
                        <a style="font-size:14px;font-weight:500;" class="prodname" href="<?php echo URL.$rescrt["prod_slug"]?>"><?php echo $rescrt["prod_name"]?></a>
                        <?php 
                        $propt = json_decode($rescrt["pro_option_desc"]);
                        foreach($propt as $key=>$value){
                          echo "<span class='proops' style='display:block;font-size:12px;'>".$key." : ".$value."</span>";
                        }
                        $total = $total+$rescrt["pro_totprice"];
                        ?>
                      </td>
                      <td class="quantity"><?php echo $rescrt["pro_qty"]?></td>
                      <td class="price1">Rs. <?php echo $rescrt["pro_unitprice"]?></td>
                      <td class="total">Rs. <?php echo $rescrt["pro_totprice"]?></td>
                    </tr>
                    
                    <?php } ?>
                    <tr class="totaltr">  
                      <td class="text-right" colspan="3"><b>Total:</b></td>
                      <td class="total">Rs. <?php echo $total?></td>
                    </tr>
                  </tbody>
                </table>
                
                <input type="hidden" value="<?php echo $total?>" name="totalamount">
              </div>
            </div>
            <!--- order summary --->
            <!-- payment ---->
            <div id="payment-method">
              <div class="quickcheckout-heading"><i class="fa fa-credit-card"></i> Payment Method</div>
              <div class="quickcheckout-content"><p>Please select the preferred payment method to use on this order.</p>
                <table class="table table-hover table-striped">
                  <tbody>
                    <tr>
                      <td>
                        <div class="radio">
                          <label><input type="radio" name="payment_method" value="Instamojo" id="instamojo" checked>Instamojo</label>
                        </div>
                      </td>
                      <td><img style="width:100px;" src="<?php echo URL?>img/instamojo.png" alt="Cash On Delivery"></td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td><button class="btn btn-viewall" type="submit">Proceed to payment</button></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
            <!--- payment --->
          </div>
          <!--- col 4 --->
          </form>

        <?php } else {//if not loggedin ?>
          <div class="col-md-12">
            <div id="checkout">
              <div class="quickcheckout-heading"><i class="fa fa-sign-in"></i> Login</div>
              <div class="quickcheckout-content">
                <div id="login">
                  <h4>You need to login/signup to purchase products.</h4>
                  <h4>Click here for <a href="javascript:void(0)" onclick="opensidenavmenu()">login/signip</a>.</h4>
                </div>
              </div>
            </div>
          </div>
        <?php }//if not loggedin ?>

        

        



      </div>
    </div>
  </div>
  <!--  ends -->  

  <?php include "footer.php";?>
  
</div>

<?php include "js.php";?>

</body>
</html>
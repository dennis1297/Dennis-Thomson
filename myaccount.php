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

      <div id="myaccrestxt"></div>

      <div class="row">

        <!-- account details ---->
        <?php if($_GET["page"] == 'edit') { ?>
          <?php $account = mysqli_fetch_assoc(mysqli_query($conn,"select *from tbl_customer where customer_id='".$_COOKIE["cus_id"]."'"));?>
          <div class="col-sm-9">
            <h3>My Account Information</h3>
            <form id="myaccountForm" method="post" enctype="multipart/form-data" class="form-horizontal">
              <fieldset>
                <legend>Your Personal Details</legend>
                <div class="form-group required">
                  <label class="col-sm-2 control-label">First Name </label>
                  <div class="col-sm-10">
                    <input type="text" name="firstname" value="<?php echo $account["firstname"]?>" placeholder="First Name" id="input-firstname" class="form-control">
                  </div>
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label">Last Name</label>
                  <div class="col-sm-10">
                    <input type="text" name="lastname" value="<?php echo $account["lastname"]?>" placeholder="Last Name" id="input-lastname" class="form-control">
                  </div>
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label">E-Mail</label>
                  <div class="col-sm-10">
                    <input type="text" name="email" value="<?php echo $account["email"]?>" placeholder="E-Mail" id="input-email" class="form-control">
                  </div>
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label">Mobile no.</label>
                  <div class="col-sm-10">
                    <input type="tel" name="telephone" value="<?php echo $account["mobileno"]?>" placeholder="Mobile no." id="input-telephone" class="form-control" onkeypress="return enterNumerics(event);" maxlength="10">
                  </div>
                </div>
              </fieldset>
              <div class="buttons clearfix">
                <div class="pull-right">
                  <button type="submit" id="editaccount" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </form>
          </div>
        <?php } ?>
        <!-- account details ---->

        <!--- password ----->
        <?php if($_GET["page"] === 'password') { ?>
          <div class="col-sm-9">
            <h3>Change Password</h3>
            <form id="passwdForm" method="post" enctype="multipart/form-data" class="form-horizontal">
              <fieldset>
                <legend>Your Password</legend>
                <div class="form-group required">
                  <label class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-10">
                    <input type="password" name="password" placeholder="Password" id="input-password" class="form-control">
                  </div>
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label">Password Confirm</label>
                  <div class="col-sm-10">
                    <input type="password" name="confirmpwd" placeholder="Password Confirm" id="input-confirm" class="form-control">
                  </div>
                </div>
              </fieldset>
              <div class="buttons clearfix">
                <div class="pull-right">
                  <button type="submit" id="passwdbtn" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </form>
          </div>
        <?php } ?>
        <!--- password ----->   

        <!---- order list ----->
        <?php if($_GET["page"] === 'orders') { ?>
          <div class="col-sm-9">
            <h3>Order History</h3>
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <td class="text-right"><b>Order ID</b></td>
                    <td class="text-right"><b>Payment Status</b></td>
                    <td class="text-left"><b>Order Status</b></td>
                    <td class="text-right"><b>Total</b></td>
                    <td class="text-left"><b>Date Added</b></td>
                    <td></td>
                  </tr>
                </thead>
                <tbody>
                <?php 
                $ordercus = mysqli_query($conn,"select order_id,invoice_no,tod.order_status_id,payment_status,total,date_added,name from tbl_order tod inner join tbl_order_status ods on tod.order_status_id=ods.order_status_id where customer_id='".$_COOKIE["cus_id"]."' order by order_id desc");
                while($ordlist = mysqli_fetch_assoc($ordercus)) {
                ?>
                  <tr>
                    <td class="text-right"><?php echo $ordlist["invoice_no"]?></td>
                    <td class="text-right"><?php echo $ordlist["payment_status"]?></td>
                    <td class="text-left"><?php echo $ordlist["name"]?></td>
                    <td class="text-right">Rs. <?php echo $ordlist["total"]?></td>
                    <td class="text-left"><?php echo dispdateonly($ordlist["date_added"])?></td>
                    <td class="text-right">
                      <a href="<?php echo URL?>account/order/<?php echo $ordlist["order_id"]?>" data-toggle="tooltip" class="btn btn-info" data-original-title="View"><i class="fa fa-eye"></i></a>
                    </td>
                  </tr>
                <?php 
                }
                ?>
                </tbody>
              </table>
            </div>
          </div>
        <?php } ?>
        <!---- order list ----->   

        <!-- order details --->
        <?php if($_GET["page"]=='order' && $_GET["ordid"]!='') {
          $orddet = mysqli_fetch_assoc(mysqli_query($conn,"select *from tbl_order where order_id='".$_GET["ordid"]."'"));
          ?>
          <div class="col-sm-9">
          <h3>Order History</h3>
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <td class="text-left" colspan="2">Order Details</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-left" style="width: 50%;"> <b>Order ID:</b> <?php echo $orddet["invoice_no"]?><br>
                  <b>Date Added:</b> <?php echo dispdateonly($orddet["date_added"])?></td>
                <td class="text-left" style="width: 50%;"> <b>Payment Method:</b> <?php echo $orddet["paymode"]?><br>
                  <b>Payment Status:</b> <?php echo $orddet["payment_status"]?></td>
              </tr>
            </tbody>
          </table>
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <td class="text-left" style="width: 50%; vertical-align: top;"><b>Payment Address</b></td>
                <td class="text-left" style="width: 50%; vertical-align: top;"><b>Shipping Address</b></td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-left"><?php echo $orddet["payment_firstname"]." ".$orddet["payment_lastname"]?><br><?php echo $orddet["payment_address_1"]?><br><?php echo $orddet["payment_address_2"]?><br><?php echo $orddet["payment_city"]." - ".$orddet["payment_postcode"]?><br><?php echo $orddet["payment_state"]?><br><?php echo $orddet["payment_country"]?></td>
                <td class="text-left"><?php echo $orddet["shipping_firstname"]." ".$orddet["shipping_lastname"]?><br><?php echo $orddet["shipping_address_1"]?><br><?php echo $orddet["shipping_address_2"]?><br><?php echo $orddet["shipping_city"]." - ".$orddet["shipping_postcode"]?><br><?php echo $orddet["shipping_state"]?><br><?php echo $orddet["shipping_country"]?></td>
              </tr>
            </tbody>
          </table>
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td class="text-left"><b>Product Name</b></td>
                  <td class="text-right"><b>Quantity</b></td>
                  <td class="text-right"><b>Price</b></td>
                  <td class="text-right"><b>Total</b></td>
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
                    <td class="text-right"><?php echo $rpdts["quantity"]?></td>
                    <td class="text-right">Rs. <?php echo $rpdts["price"]?></td>
                    <td class="text-right">Rs. <?php echo $rpdts["total"]?></td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
              
              <tfoot>
                <tr>
                  <td colspan="3" align="right">Total</td><td class="text-right">Rs. <?php echo $orddet["total"]?></td>
                </tr>
              </tfoot>
              
            </table>
          </div>
          <h3>Order History</h3>
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <td class="text-left"><b>Date Added</b></td>
                <td class="text-left"><b>Order Status</b></td>
                <td class="text-left"><b>Comment</b></td>
              </tr>
            </thead>
            <tbody>
              <?php
              $odhis=mysqli_query($conn,"select toh.order_status_id,comment,date_added,name from tbl_order_history toh inner join tbl_order_status ods on toh.order_status_id=ods.order_status_id where order_id=".$_GET["ordid"]." order by order_history_id asc");
              while($rodhis=mysqli_fetch_assoc($odhis)){
                echo '<tr>
                  <td>'.dispdateonly($rodhis["date_added"]).'</td>
                  <td>'.$rodhis["name"].'</td>
                  <td>'.$rodhis["comment"].'</td>
                </tr>';
              }
              ?>
            </tbody>
          </table>
            <div class="buttons clearfix">
              <div class="pull-right"><a href="<?php echo URL?>account/orders" class="btn btn-primary">Back</a>
            </div>
          </div>
          </div>
        <?php } ?>
        <!-- order details --->

        <!-- manage address ------>
        <?php if($_GET["page"]=='addresses') { ?>
          <div class="col-sm-9">
            <h3>Manage Addresses <a href="<?php echo URL?>account/address/add" class="btn btn-primary">New Address</a></h3>
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <tbody> 
                  <?php 
                  $seladdr = mysqli_query($conn,"select *from tbl_address where customer_id='".$_COOKIE["cus_id"]."'");
                  while($resaddr = mysqli_fetch_assoc($seladdr)) { ?>
                  <tr>
                    <td class="text-left"><?php echo $resaddr["firstname"]." ".$resaddr["lastname"]?><?php if($resaddr["company"]!='') echo '<br>'.$resaddr["company"];?><br><?php echo $resaddr["address_1"]?><?php if($resaddr["address_2"]!='') echo '<br>'.$resaddr["address_2"];?><br><?php echo $resaddr["city"]."-".$resaddr["postcode"]?><br><?php echo $resaddr["state"]?><br><?php echo $resaddr["country"]?></td>
                    <td class="text-right"><a href="<?php echo URL?>account/address/edit/<?php echo base64_encode($resaddr["address_id"])?>" class="btn btn-info"><i class="far fa-edit"></i></a> <a onclick="removeaddres(<?php echo $resaddr['address_id']?>)" class="btn btn-danger"><i class="far fa-trash-alt"></i></a></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        <?php } ?>
        <!-- manage address ------>

        <!-- address edit ---->
        <?php if($_GET["page"]=='address' && $_GET["addtype"]=='edit') {
        $resuqadd = mysqli_fetch_assoc(mysqli_query($conn,"select *from tbl_address where address_id='".base64_decode($_GET["addid"])."'"));
        ?>
          <div class="col-sm-9">
            <h3>Edit Address</h3>
            <form id="addressForm" method="post" enctype="multipart/form-data" class="form-horizontal">
              <fieldset>
                <div class="form-group required">
                  <label class="col-sm-2 control-label"><span class="mandatory">*</span>First Name</label>
                  <div class="col-sm-10">
                    <input type="text" name="addr_fname" value="<?php echo $resuqadd["firstname"]?>" placeholder="First Name" id="addr_fname" class="form-control">
                  </div>
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label"><span class="mandatory">*</span>Last Name</label>
                  <div class="col-sm-10">
                    <input type="text" name="addr_lname" value="<?php echo $resuqadd["lastname"]?>" placeholder="Last Name" id="addr_lname" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Company</label>
                  <div class="col-sm-10">
                    <input type="text" name="addr_company" value="<?php echo $resuqadd["company"]?>" placeholder="Company" id="addr_company" class="form-control">
                  </div>
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label"><span class="mandatory">*</span>Address 1</label>
                  <div class="col-sm-10">
                    <input type="text" name="addr_address1" value="<?php echo $resuqadd["address_1"]?>" placeholder="Address 1" id="addr_address1" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Address 2</label>
                  <div class="col-sm-10">
                    <input type="text" name="addr_address2" value="<?php echo $resuqadd["address_2"]?>" placeholder="Address 2" id="addr_address2" class="form-control">
                  </div>
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label"><span class="mandatory">*</span>City</label>
                  <div class="col-sm-10">
                    <input type="text" name="addr_city" value="<?php echo $resuqadd["city"]?>" placeholder="City" id="addr_city" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label"><span class="mandatory">*</span>Post Code</label>
                  <div class="col-sm-10">
                    <input type="tel" name="addr_postcode" value="<?php echo $resuqadd["postcode"]?>" placeholder="Post Code" id="addr_postcode" class="form-control" onkeypress="return enterNumerics(event);" maxlength="6">
                  </div>
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label"><span class="mandatory">*</span>Country</label>
                  <div class="col-sm-10">
                    <select name="addr_country" id="addr_country" class="form-control">
                      <option value="India" selected>India</option>               
                    </select>
                  </div>
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label"><span class="mandatory">*</span>State</label>
                  <div class="col-sm-10">
                    <select name="addr_state" id="addr_state" class="form-control">
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
                      <option value="Tamil Nadu" >Tamil Nadu</option>
                      <option value="Telangana">Telangana</option>
                      <option value="Tripura">Tripura</option>
                      <option value="Uttar Pradesh">Uttar Pradesh</option>
                      <option value="West Bengal">West Bengal</option>
                    </select>
                    <script>$("#addr_state").val('<?php echo $resuqadd["state"]?>');</script>
                  </div>
                </div>
                <input type="hidden" value="edit" name="addtype">
                <input type="hidden" value="<?php echo base64_decode($_GET["addid"])?>" name="addressid">
              </fieldset>              
              <div class="buttons clearfix">
                <div class="pull-left"><a href="<?php echo URL?>account/addresses" class="btn btn-default">Back</a></div>
                <div class="pull-right">
                  <button type="submit" id="addrsbtn" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </form>
          </div>
        <?php } ?>
        <!-- address edit ---->  

        <!-- address add ---->
        <?php if($_GET["page"]=='address' && $_GET["ordid"]=='add') {
        ?>
          <div class="col-sm-9">
            <h3>Add Address</h3>
            <form id="addressForm" method="post" enctype="multipart/form-data" class="form-horizontal">
              <fieldset>
                <div class="form-group required">
                  <label class="col-sm-2 control-label"><span class="mandatory">*</span>First Name</label>
                  <div class="col-sm-10">
                    <input type="text" name="addr_fname" placeholder="First Name" id="addr_fname" class="form-control">
                  </div>
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label"><span class="mandatory">*</span>Last Name</label>
                  <div class="col-sm-10">
                    <input type="text" name="addr_lname" placeholder="Last Name" id="addr_lname" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Company</label>
                  <div class="col-sm-10">
                    <input type="text" name="addr_company" placeholder="Company" id="addr_company" class="form-control">
                  </div>
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label"><span class="mandatory">*</span>Address 1</label>
                  <div class="col-sm-10">
                    <input type="text" name="addr_address1" placeholder="Address 1" id="addr_address1" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Address 2</label>
                  <div class="col-sm-10">
                    <input type="text" name="addr_address2" placeholder="Address 2" id="addr_address2" class="form-control">
                  </div>
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label"><span class="mandatory">*</span>City</label>
                  <div class="col-sm-10">
                    <input type="text" name="addr_city" placeholder="City" id="addr_city" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label"><span class="mandatory">*</span>Post Code</label>
                  <div class="col-sm-10">
                    <input type="tel" name="addr_postcode" placeholder="Post Code" id="addr_postcode" class="form-control" onkeypress="return enterNumerics(event);" maxlength="6">
                  </div>
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label"><span class="mandatory">*</span>Country</label>
                  <div class="col-sm-10">
                    <select name="addr_country" id="addr_country" class="form-control">
                      <option value="India" selected>India</option>               
                    </select>
                  </div>
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label"><span class="mandatory">*</span>State</label>
                  <div class="col-sm-10">
                    <select name="addr_state" id="addr_state" class="form-control">
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
                <input type="hidden" value="add" name="addtype">
              </fieldset>              
              <div class="buttons clearfix">
                <div class="pull-left"><a href="<?php echo URL?>account/addresses" class="btn btn-default">Back</a></div>
                <div class="pull-right">
                  <button type="submit" id="addrsbtn" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </form>
          </div>
        <?php } ?>
        <!-- address add ---->     

        <div class="col-sm-3">
          <div class="list-group">
            <a href="<?php echo URL?>account/edit" class="list-group-item">My Account</a>
            <a href="<?php echo URL?>account/password" class="list-group-item">Change Password</a>
            <a href="<?php echo URL?>account/addresses" class="list-group-item">Manage Addresses</a>
            <a href="<?php echo URL?>account/orders" class="list-group-item">Order History</a>
            <a href="<?php echo URL?>logout" class="list-group-item">Logout</a>
          </div>
        </div>

      </div>
    </div>
  </div>
  <!-- single product ends -->
  

  <?php include "footer.php";?>
  
</div>

<?php include "js.php";?>

</body>
</html>
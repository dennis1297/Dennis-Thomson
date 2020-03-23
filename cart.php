<?php 
include("config.php"); 
include("functions.php"); 
$custdet=mysqli_fetch_assoc(mysqli_query($conn,"select *from tbl_customer where customer_id='".$_COOKIE["cus_id"]."'"));
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
      <div class="row">
        <div class="col-md-12">
          
          <div class="table-responsive">
            <table class="table table-bordered cart_summary">
              <thead>
                <tr>
                  <th>Image</th>
                  <th>Product</th> 
                  <th>Qty</th> 
                  <th>Unit Price</th> 
                  <th>Total</th>
                </tr>
              </thead>
              <tbody id="tblcartbody">
              <?php 
              $total = 0;
              $getcrt = mysqli_query($conn,"select cartid,customer_id,sessionid,product_id,pro_option,pro_option_desc,pro_qty,pro_unitprice,pro_totprice,prod_name,prod_slug,prod_image from tbl_cart tc inner join tbl_product tp on tc.product_id=tp.prod_id inner join tbl_product_images tpi on tc.product_id=tpi.prod_id where customer_id='".$_COOKIE["cus_id"]."'");
              while($rescrt = mysqli_fetch_assoc($getcrt)) { 
              $propt = json_decode($rescrt["pro_option_desc"]);
              ?>
                <tr>
                  <td>
                    <div class="primg">
                      <a href="<?php echo URL.$rescrt["prod_slug"]?>" class="prinnrimg"><img src="<?php echo URL.substr($rescrt["prod_image"],3)?>" class="img-responsive"></a>        
                    </div>
                  </td>
                  <td>
                    <a class="prodname" href="<?php echo URL.$rescrt["prod_slug"]?>"><?php echo $rescrt["prod_name"]?></a>
                    <div id="cartpdopsvl<?php echo $rescrt["cartid"]?>">
                    <?php 
                    foreach($propt as $key=>$value){
                      echo "<span class='proops'> ".$key." : ".$value."</span>";
                    }
                    $total = $total+$rescrt["pro_totprice"];
                    ?>
                    </div>
                  </td>
                  <td>
                    <div id="updcartinput<?php echo $rescrt['cartid']?>" class="input-group" style="max-width:200px;">
                      <input onkeypress="return enterNumerics(event);" type="tel" id="pro_qty<?php echo $rescrt['cartid']?>" class="form-control" value="<?php echo $rescrt["pro_qty"]?>">
                      <span class="input-group-btn">
                        <button onclick="updatecart(<?php echo $rescrt['cartid']?>,'qtyupd','<?php echo $rescrt['pro_unitprice']?>')" type="button" class="btn btn-primary"><i class="fas fa-sync-alt"></i></button>
                        <button onclick="updatecart(<?php echo $rescrt['cartid']?>,'remcart','')" type="button" class="btn btn-danger"><i class="fas fa-times"></i></button>
                      </span>
                    </div>
                  </td>
                  <td>Rs. <?php echo $rescrt["pro_unitprice"]?></td>
                  <td>Rs. <?php echo $rescrt["pro_totprice"]?></td>
                </tr>
              <?php } ?>
                  
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="4" align="right"><h4>Total</h4></td>
                  <td id="cartjstot"><h4>Rs. <?php echo $total?></h4></td>
                </tr>
              </tfoot>
            </table>
          </div>
          <button class="btn btn-viewall" id="submitproenq">Submit Enquiry</button>
          <!--a href="<?php echo URL?>checkout" class="btn btn-viewall">Checkout</a-->
        </div>
      </div>
    </div>
  </div>
  <!-- single product ends -->
  

  <?php include "brands.php";?>

  <?php include "footer.php";?>
  
</div>

<?php include "js.php";?>

<!-- Modal -->
<div id="prodenqModal" class="modal fade" role="dialog">
  <div class="modal-dialog">    
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Product Enquiry</h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label>Name<span class="mandatory">*</span></label>
            <input type="text" class="form-control" id="enqname" name="enqname" value="<?php echo $custdet["firstname"]?>">
          </div>
          <div class="form-group">
            <label>Contact no.<span class="mandatory">*</span></label>
            <input type="text" class="form-control" id="enqconno" name="enqconno" value="<?php echo $custdet["mobileno"]?>" onKeyPress="return enterNumerics(event);">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" id="enqmail" name="enqmail" value="<?php echo $custdet["email"]?>">
          </div>
          <div class="form-group">
            <label>Message</label>
            <textarea class="form-control" rows="3" id="enqmsg" name="enqmsg"></textarea>
          </div>
          <div id="enq_res"></div>
          <button type="button" id="prodenqbtn" class="btn btn-primary">Submit</button>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->

<script>
$(document).ready(function(){
  $("#submitproenq").click(function(){
    $("#prodenqModal").modal();
  });

  $("#prodenqbtn").click(function(){
    err=0;
    var enqname= $("#enqname").val();
    var enqconno = $("#enqconno").val();
    var enqmail = $("#enqmail").val();
    var enqmsg = $("#enqmsg").val();

    if(enqname=='' || enqconno==''){
      err=1;
      $("#enq_res").html("<span class='err'>Fill mandatory fields</span>");
    }
    else if(!isValidEmailAddress(enqmail)){
      err=1;
      $("#enq_res").html("<span class='err'>Enter valid email</span>");
    }
    else{
      err=0;
    }

    if(err==0){
      $.ajax({
        url: siteURL+"scripts.php",
        type: "POST",
        data: { action:"prodenquiry", enqname:enqname, enqconno:enqconno, enqmail:enqmail, enqmsg:enqmsg },
        cache: false,
        beforeSend: function() {
          $("#enq_res").show();
          $("#enq_res").html("<span class='process'><i class='fa fa-spinner fa-pulse fa-fw'></i>&nbsp;&nbsp;Please wait...</span>");
        },
        success: function(response) {
          console.log(response);
          if(response==1){
            $("#enq_res").html("<span class='succ'>Enquiry submitted</span>");
            setTimeout(function(){ 
              window.location.href= siteURL;
            }, 2000);
          }
          else{
            $("#enq_res").html("<span class='err'>Error try again...</span>");
          }			
        },
        error: function(e) {
          $("#enq_res").html("<span class='err'>Error...</span>");
        },
        complete: function() {
          $("#enqname").val('');$("#enqconno").val('');$("#enqmail").val('');$("#enqmsg").val('');
          $("#enq_res").fadeOut(3000);
        }
      });
    }
  });

}); 
</script>

</body>
</html>
<?php
include "include/header.php";
include "include/menu.php";
?>

<style>
@media print {
	body{margin:0;}
	.page-header,#orderdetails,#customerdetails,#orderaddress,#orderstatushistory,footer{display:none;}
	#invoiceorderdetails{display:block!important;margin-top:-30px;}
}
#invoiceorderdetails{display:none;}
</style>

  <!-- Page -->
  <div class="page animsition">
    <div class="page-header">
		<div class="pull-right">			 
			<button class="btn btn-info" onclick="window.history.go(-1);" data-toggle="tooltip" data-original-title="Back"><i class="fa fa-reply"></i></button>
		</div>
		<h1 class="page-title">Orders </h1>
		<ol class="breadcrumb">
			<li><a href="dashboard.php">Home</a></li>
			<li><a href="javascript:void(0)">Orders</a></li>
		</ol>
    </div> 
    <div class="page-content container-fluid">
		
		<?php            
			$res=mysqli_fetch_assoc(mysqli_query($conn,"select *from tbl_order where order_id='".$_GET["orderid"]."'"));
			$cus=mysqli_fetch_assoc(mysqli_query($conn,"select *from tbl_customer where customer_id='".$res["customer_id"]."'"));
			$ordstatus = mysqli_fetch_assoc(mysqli_query($conn,"select name from tbl_order_status where order_status_id='".$res["order_status_id"]."'"));
		?>	
			
      <div class="row">
		<div class="col-md-6">
			<div class="panel panel-bordered" id="orderdetails">
				<div class="panel-heading">
				  <h3 class="panel-title"><i class="wb-shopping-cart"></i> Order Details</h3>
				</div>
				<table class="table">
					<tbody>
						<tr>
							<td  style="width: 1%;"><button data-toggle="tooltip" class="btn btn-info btn-xs" data-original-title="Payment Status"><i class="fa fa-inr fa-fw"></i></button></td>
							<td><?php echo $res["payment_status"]?></td>
					  </tr>
					  <tr>
						<td  style="width: 1%;"><button data-toggle="tooltip" class="btn btn-info btn-xs" data-original-title="Order ID"><i class="fa fa-info fa-fw"></i></button></td>
						<td><?php echo $res["invoice_no"]?></td>
					  </tr>
					  <tr>
						<td><button data-toggle="tooltip" class="btn btn-info btn-xs" data-original-title="Date Added"><i class="fa fa-calendar fa-fw"></i></button></td>
						<td><?php echo dispdateonly($res["date_added"])?></td>
					  </tr>					   
					  <tr>
						<td><button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Order status"><i class="fa fa-check fa-fw"></i></button></td>
						<td><?php echo $ordstatus["name"]?></td>
					  </tr>
					</tbody>
				</table>
			</div>
		</div>
		 <div class="col-md-6">
			<div class="panel panel-bordered" id="customerdetails">
				<div class="panel-heading">
				  <h3 class="panel-title"><i class="wb-user"></i> Customer  Details</h3>
				</div>
				<table class="table">
					<tbody>
					  <tr>
						<td  style="width: 1%;"><button data-toggle="tooltip" class="btn btn-info btn-xs" data-original-title="Customer"><i class="fa fa-user fa-fw"></i></button></td>
						<td><?php echo $cus["firstname"]." ".$cus["lastname"]?></td>
					  </tr>
					  <tr>
						<td><button data-toggle="tooltip" class="btn btn-info btn-xs" data-original-title="Phone"><i class="fa fa-phone fa-fw"></i></button></td>
						<td><?php echo $cus["mobileno"]?></td>
					  </tr>
					  <tr>
						<td><button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="E-mail"><i class="fa fa-envelope fa-fw"></i></button></td>
						<td><?php echo $cus["email"]?></td>
					  </tr>
					   
					</tbody>
				</table>
			</div>
		</div>
		
		
		<div class="col-md-12">
		  <div class="panel panel-bordered" id="orderaddress">
			<div class="panel-heading">
				<h3 class="panel-title">Order (<?php echo $res["invoice_no"]?>) <a href="<?php echo ADMINURL.'print-invoice/'.$_GET["orderid"]?>" target="_blank" class="btn btn-success" data-toggle="tooltip" data-original-title="Print Invoice" style="color:#fff;"><i class="fa fa-print"></i></a></h3>
			</div>
			<div class="panel-body">
				
				<table class="table table-bordered">
					<thead>
						<tr>
							<th><b>Payment Address</b></th>
							<th><b>Shipping Address</b></th>
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
							<th><b>Product</b></th>
							<th><b>Quantity</b></th>
							<th><b>Unit Price</b></th>
							<th><b>Total</b></th>
						</tr>
					</thead>
					<tbody>
					<?php 
					$pdt=mysqli_query($conn,"select *from tbl_order_product where order_id='".$_GET["orderid"]."'");
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
		</div> 


		<!-- product history ---->
		<div class="col-md-12">
		  <div class="panel panel-bordered" id="orderhistory">
			<div class="panel-heading">
				<h3 class="panel-title">Order History</h3>
			</div>
			<div class="panel-body">
				
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Date Added</th>
							<th>Comment</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$odhis=mysqli_query($conn,"select toh.order_status_id,comment,date_added,name from tbl_order_history toh inner join tbl_order_status ods on toh.order_status_id=ods.order_status_id where order_id=".$_GET["orderid"]." order by order_history_id asc");
						while($rodhis=mysqli_fetch_assoc($odhis)){
							echo '<tr>
								<td>'.dispdateonly($rodhis["date_added"]).'</td>
								<td>'.$rodhis["comment"].'</td>
								<td>'.$rodhis["name"].'</td>
							</tr>';
						}
						?>
					</tbody>
				</table>

				<fieldset>
					<legend>Add Order History</legend>
					<form class="form-horizontal" method="post" enctype="multipart/form-data" autocomplete="off">
						<div class="form-group">
							<label class="col-sm-2 control-label">Order Status</label>
							<div class="col-sm-10">
								<select name="ordstaid" class="form-control">
									<?php 
									$odsta=mysqli_query($conn,"select *from tbl_order_status");
									while($rsodsta=mysqli_fetch_assoc($odsta)){
										echo '<option value="'.$rsodsta["order_status_id"].'">'.$rsodsta["name"].'</option>';
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Comment</label>
							<div class="col-sm-10">
								<textarea name="comment" rows="8" class="form-control"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"></label>
							<div class="col-sm-10">
								<button type="submit" name="addhis" class="btn btn-primary btn-md">Add history</button>
							</div>
						</div>
					</form>
				</fieldset>
				<?php 
				if(isset($_REQUEST["addhis"])){
					$comment=str_replace("'","`",$_POST["comment"]);
					$ordstaid=$_POST["ordstaid"];

					$ins = mysqli_query($conn,"insert into tbl_order_history (order_id,order_status_id,comment,date_added) values ('".$_GET["orderid"]."','$ordstaid','$comment','".date("Y-m-d H:i:s")."')");
					$ins = mysqli_query($conn,"update tbl_order set order_status_id='$ordstaid' where order_id='".$_GET["orderid"]."'");

					if($ins)
						echo '<script>alert("Updated successfully");window.location.href="'.ADMINURL.'orders/'.$_GET["orderid"].'";</script>';
					else
						echo '<script>alert("Error...");window.location.href="'.ADMINURL.'orders/'.$_GET["orderid"].'";</script>';
				}
				?>

			</div>
		  </div>
		</div>
		<!-- product history ---->
  
      </div>

    </div>
  </div>
  <!-- End Page -->

<?php include "include/footer.php";?>
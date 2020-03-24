<?php
include "include/header.php";
include "include/menu.php";

$noofcat=mysqli_num_rows(mysqli_query($conn,"select *from tbl_cat"));
$noofpro=mysqli_num_rows(mysqli_query($conn,"select *from tbl_product"));
$noofcus=mysqli_num_rows(mysqli_query($conn,"select *from tbl_customer"));
$noodord=mysqli_num_rows(mysqli_query($conn,"select *from tbl_order"));
?>


  <!-- Page -->
  <div class="page">
		<div class="page-header">
		  <h1 class="page-title font-size-26 font-weight-100">Viveka Essence Mart</h1>
		</div>
		<div class="page-content container-fluid">
		  <div class="row">
			<div class="col-md-3 info-panel">
			  <div class="card card-shadow">
				<div class="card-block bg-white p-20" style="padding:20px;">
				  <button type="button" class="btn btn-floating btn-sm btn-primary">
					<i class="icon wb-shopping-cart"></i>
				  </button>
				  <span class="ml-15 font-weight-400">ORDERS</span>
				  <div class="content-text text-center mb-0">
					<i class="text-danger icon wb-triangle-up font-size-20">
				  </i>
					<span class="font-size-40 font-weight-100"><?php echo $noodord;?></span>
					<p class="blue-grey-400 font-weight-100 m-0"><a href="<?php echo ADMINURL?>orders-list">View more</a></p>
				  </div>
				</div>
			  </div>
			</div>
			<div class="col-md-3 info-panel">
			  <div class="card card-shadow">
				<div class="card-block bg-white p-20" style="padding:20px;">
				  <button type="button" class="btn btn-floating btn-sm btn-warning">
					<i class="icon wb-tag"></i>
				  </button>
				  <span class="ml-15 font-weight-400">CATEGORY</span>
				  <div class="content-text text-center mb-0">
					<i class="text-danger icon wb-triangle-up font-size-20">
				  </i>
					<span class="font-size-40 font-weight-100"><?php echo $noofcat;?></span>
					<p class="blue-grey-400 font-weight-100 m-0"><a href="<?php echo ADMINURL?>category-list">View more</a></p>
				  </div>
				</div>
			  </div>
			</div>
			<div class="col-md-3 info-panel">
			  <div class="card card-shadow">
				<div class="card-block bg-white p-20" style="padding:20px;">
				  <button type="button" class="btn btn-floating btn-sm btn-success">
					<i class="icon wb-eye"></i>
				  </button>
				  <span class="ml-15 font-weight-400">PRODUCTS</span>
				  <div class="content-text text-center mb-0">
					<i class="text-danger icon wb-triangle-up font-size-20">
				  </i>
					<span class="font-size-40 font-weight-100"><?php echo $noofpro;?></span>
					<p class="blue-grey-400 font-weight-100 m-0"><a href="<?php echo ADMINURL?>product-list">View more</a></p>
				  </div>
				</div>
			  </div>
			</div>
			<div class="col-md-3 info-panel">
			  <div class="card card-shadow">
				<div class="card-block bg-white p-20" style="padding:20px;">
				  <button type="button" class="btn btn-floating btn-sm btn-danger">
					<i class="icon wb-user"></i>
				  </button>
				  <span class="ml-15 font-weight-400">Customer</span>
				  <div class="content-text text-center mb-0">
					<i class="text-danger icon wb-triangle-up font-size-20">
				  </i>
					<span class="font-size-40 font-weight-100"><?php echo $noofcus;?></span>
					<p class="blue-grey-400 font-weight-100 m-0"><a href="<?php echo ADMINURL?>view_customer">View more</a></p>
				  </div>
				</div>
			  </div>
			</div>

		  </div>
		</div>	  
	</div>
  <!-- End Page -->

<?php include "include/footer.php";?>
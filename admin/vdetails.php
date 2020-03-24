<?php
include "include/header.php";
include "include/menu.php";
?>


  <!-- Page -->
  <div class="page animsition">
    <div class="page-header">
      <h1 class="page-title">Vendor</h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php">Home</a></li>
        <li><a href="javascript:void(0)">Vendor Details</a></li>
      </ol>
    </div>
    <div class="page-content container-fluid">

      <div class="row">
        <div class="col-md-12">
          <!-- Panel Standard Mode -->
          <div class="panel">
             
            <?php				
				$ven=mysqli_fetch_assoc(mysqli_query($conn, "select *from tbl_vendors where vendor_id='".$_GET["vid"]."'"));
				$vinfo=mysqli_fetch_assoc(mysqli_query($conn, "select *from tbl_vendors_info where vendor_id='".$_GET["vid"]."'"));
				
				if($vinfo["cmpny_name"]=='')
					$compnayname=$ven["vendor_company_name"];
				else
					$compnayname=$vinfo["cmpny_name"];
				
				if($vinfo["commn_person"]=='')
					$vname=$ven["vendor_name"];
				else
					$vname=$vinfo["commn_person"];
				
				if($vinfo["commn_email"]=='')
					$email=$ven["vendor_email"];
				else
					$email=$vinfo["commn_email"];
				if($vinfo["commn_mob"]=='')
					$mobile=$ven["vendor_mobile"];
				else
					$mobile=$vinfo["commn_mob"];
				
				if($vinfo["commn_city"]=='')
					$city=$ven["vendor_city"];
				else
					$city=$vinfo["commn_city"];
				
			?>
           
			 
            <div class="panel-body">
              <form class="form-horizontal" name="cat_add" method="post" enctype="multipart/form-data" autocomplete="off">
				<div class="col-md-6">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Company Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="cmpny_name" id="cmpny_name" value="<?php echo $compnayname; ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Contact Person</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="commn_person" value="<?php echo $vname; ?>"  />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Designation</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="comm_designation" id="comm_designation"  value="<?php echo $vinfo["comm_designation"]; ?>"  />
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="commn_email"  value="<?php echo $email; ?>"  />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Mobile</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="commn_mob"  value="<?php echo $mobile; ?>"  />
                  </div>
                </div> 
                <div class="form-group">
                  <label class="col-sm-2 control-label">Address</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="commn_address"  value="<?php echo $vinfo["commn_address"]; ?>"  />
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Pincode</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="commn_pin"  value="<?php echo $vinfo["commn_pin"]; ?>"  />
                  </div>
                </div>
				
                <div class="form-group">
                  <label class="col-sm-2 control-label">City</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="commn_city"  value="<?php echo $city; ?>"  />
                  </div>
                </div>
                
                
				
				 
				
				</div>
                
				<div class="col-md-6">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Account name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="bank_Bene_name" value="<?php echo  $vinfo["bank_Bene_name"]; ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Account No</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="bank_acno" value="<?php echo  $vinfo["bank_acno"]; ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Bank Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="bank_name" id="bank_name"  value="<?php echo  $vinfo["bank_name"]; ?>" />
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Bank City</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="bank_city"  value="<?php echo  $vinfo["bank_city"]; ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Account Type</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="bank_acc_type"  value="<?php echo  $vinfo["bank_acc_type"]; ?>" />
                  </div>
                </div> 
                <div class="form-group">
                  <label class="col-sm-2 control-label">Address</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="bank_address"   value="<?php echo  $vinfo["bank_address"]; ?>" />
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">IFSC</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="bank_rtgs_ifcs"   value="<?php echo  $vinfo["bank_rtgs_ifcs"]; ?>" />
                  </div>
                </div>
				  
				
				</div>
                <div class="clearfix"></div>
				<div class="text-right">
                  <button type="submit" class="btn btn-primary" name="addcat">Submit</button>
                </div>
              </form>
            </div>
			
			<?php 
			if(isset($_REQUEST['addcat']))
			{ 

				$cmpny_name=str_replace("'","",$_POST["cmpny_name"]); 
				$commn_person=str_replace("'","",$_POST["commn_person"]); 
				$comm_designation=str_replace("'","",$_POST["comm_designation"]); 
				$commn_mob=str_replace("'","",$_POST["commn_mob"]);  
				$commn_email=str_replace("'","",$_POST["commn_email"]); 
				$commn_address=str_replace("'","",$_POST["commn_address"]); 
				$commn_city=str_replace("'","",$_POST["commn_city"]); 
				$commn_pin=str_replace("'","",$_POST["commn_pin"]); 
				$bank_Bene_name=str_replace("'","",$_POST["bank_Bene_name"]); 
				$bank_acno=str_replace("'","",$_POST["bank_acno"]); 
				$bank_name=str_replace("'","",$_POST["bank_name"]); 
				$bank_city=str_replace("'","",$_POST["bank_city"]); 
				$bank_acc_type=str_replace("'","",$_POST["bank_acc_type"]); 
				$bank_address=str_replace("'","",$_POST["bank_address"]); 
				$bank_rtgs_ifcs=str_replace("'","",$_POST["bank_rtgs_ifcs"]);  
				
				$n=mysqli_num_rows(mysqli_query($conn, "select id from tbl_vendors_info where vendor_id='".$_GET["vid"]."'"));
				
				if($n!=0)
				{
					$sql="update tbl_vendors_info set cmpny_name='$cmpny_name', commn_person='$commn_person',  comm_designation='$comm_designation', commn_mob='$commn_mob', commn_email='$commn_email', commn_address='$commn_address', commn_city='$commn_city' , commn_pin='$commn_pin' , bank_Bene_name='$bank_Bene_name' , bank_acno='$bank_acno' , bank_name='$bank_name' , bank_city='$bank_city' , bank_acc_type='$bank_acc_type' , bank_address='$bank_address' , bank_rtgs_ifcs='$bank_rtgs_ifcs' where vendor_id='".$_GET["vid"]."'";
					$ins=mysqli_query($conn, $sql);
				}
				else
				{
					$ins=mysqli_query($conn,"INSERT INTO tbl_vendors_info(cmpny_name,commn_person,comm_designation,commn_email,commn_mob,commn_address,commn_pin,commn_city,bank_Bene_name,bank_acno,bank_name,bank_city,bank_acc_type,bank_address,bank_rtgs_ifcs,vendor_id) VALUES ('$cmpny_name','$commn_person','$comm_designation','$commn_email', '$commn_mob','$commn_address','$commn_pin','$commn_city','$bank_Bene_name','$bank_acno','$bank_name','$bank_city','$bank_acc_type','$bank_address','$bank_rtgs_ifcs','".$_GET["vid"]."')");
				}
				if($ins)
					echo '<script>alert("Updated successfully"); window.location.href="vendorlist.php";</script>';
				else 
				    echo '<script>alert("Error.."); </script>';
			}
			?>

        			
          </div>
          <!-- End Panel Standard Mode -->
        </div>
      </div>

    </div>
  </div>
  <!-- End Page -->

<?php include "include/footer.php";?>
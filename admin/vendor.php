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
            <div class="panel-heading">
              <?php
				if(isset($_GET["edit"]))
					echo '<h3 class="panel-title">Edit Vendor</h3>';
				else	
					echo '<h3 class="panel-title">Add Vendor</h3>';
			  ?>
            </div>
            <?php
            
				$res=mysqli_fetch_assoc(mysqli_query($conn, "select *from tbl_vendors where vendor_id='".$_GET["edit"]."'"));
				$sel=mysqli_fetch_assoc(mysqli_query($conn, "select vendor_id from tbl_vendors order by vendor_id desc limit 1 "));
				if($sel["vendor_id"]=='')
					$vendor_id="V000001";
				else
					$vendor_id="V".sprintf("%05d", ($sel["vendor_id"]+1));
				 
				 $text=substr(str_shuffle(str_repeat('abcdefghijklmnopqrstuvwxyz', mt_rand(1,10))),1,3);
				 $no=substr(str_shuffle(str_repeat('123456789', mt_rand(1,10))),1,3);
				 $pwd=$text.$no;
			?>
           
			 
            <div class="panel-body">
              <form class="form-horizontal" name="cat_add" method="post" enctype="multipart/form-data" autocomplete="off">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Vendor Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="vendor_name" value="<?php echo $res["vendor_name"]; ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="vendor_email" value="<?php echo $res["vendor_email"]; ?>"  />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Vendor Code</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="vendor_code" id="vendor_code"  />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="vendor_pass"  id="vendor_pass"  />
                  </div>
                </div>
				
                <div class="form-group">
                  <label class="col-sm-2 control-label">Mobile</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="vendor_mobile"  value="<?php echo $res["vendor_mobile"]; ?>"  />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">City</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="vendor_city"  value="<?php echo $res["vendor_city"]; ?>"  />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Company Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="vendor_company_name"  value="<?php echo $res["vendor_company_name"]; ?>"  />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Status</label>
                  <div class="col-sm-10">
                    <select name="vendor_status" id="vendor_status" class="form-control">
                    	<option value="">--Select--</option>
                        <option value="Y">Active</option>
                        <option value="N">In Active</option>
                    </select>
                  </div>
                </div> 
				<script>
				<?php 
				if(isset($_GET["edit"]))
				{
					?>
					document.getElementById("vendor_code").value="<?php echo $res["vendor_code"];  ?>"; 
					document.getElementById("vendor_pass").value="<?php echo $res["vendor_pass"];  ?>"; 
					document.getElementById("vendor_status").value="<?php echo $res["vendor_status"];  ?>"; 
					<?php
				}
				else
				{
					?>
					document.getElementById("vendor_code").value="<?php echo $vendor_id?>"; 
					document.getElementById("vendor_pass").value="<?php echo $pwd;  ?>"; 
					<?php
				}
				?>
				</script>
                <div class="text-right">
                  <button type="submit" class="btn btn-primary" name="addcat">Submit</button>
                </div>
              </form>
            </div>
			
			<?php 
			if(isset($_REQUEST['addcat']))
			{
				$vendor_name=str_replace("'","",$_POST["vendor_name"]); 
				$vendor_email=str_replace("'","",$_POST["vendor_email"]); 
				$vendor_code=str_replace("'","",$_POST["vendor_code"]); 
				$vendor_pass=str_replace("'","",$_POST["vendor_pass"]); 
				$vendor_mobile=str_replace("'","",$_POST["vendor_mobile"]); 
				$vendor_city=str_replace("'","",$_POST["vendor_city"]); 
				$vendor_company_name=str_replace("'","",$_POST["vendor_company_name"]); 
				$vendor_status=str_replace("'","",$_POST["vendor_status"]); 
				
				if(isset($_GET["edit"]))
				{
					echo $sql="update tbl_vendors set vendor_name='$vendor_name', vendor_email='$vendor_email',  vendor_pass='$vendor_pass', vendor_mobile='$vendor_mobile', vendor_city='$vendor_city', vendor_company_name='$vendor_company_name', vendor_status='$vendor_status'  where vendor_id='".$_GET["edit"]."'";
					$ins=mysqli_query($conn, $sql);
				}
				else
				{
					$ins=mysqli_query($conn,"INSERT INTO tbl_vendors(vendor_name, vendor_email,  vendor_code, vendor_pass, vendor_mobile, vendor_city, vendor_company_name,vendor_dt, vendor_status) VALUES ('$vendor_name','$vendor_email','$vendor_code','$vendor_pass','$vendor_mobile','$vendor_city','$vendor_company_name','".date("Y-m-d")."','$vendor_status')");
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
<?php
include "include/header.php";
include "include/menu.php";
?>


  <!-- Page -->
  <div class="page animsition">
    <div class="page-header">
      <h1 class="page-title">Customer</h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php">Home</a></li>
        <li><a href="javascript:void(0)">Customer</a></li>
      </ol>
    </div>
    <div class="page-content container-fluid">

      <div class="row">
        <div class="col-md-12">
          <!-- Panel Standard Mode -->
          <div class="panel">
            <div class="panel-heading">
			  <div class="row">
				<div class="col-md-6">
					<h3 class="panel-title">Edit Customer</h3>
				</div>
				<div class="col-md-6">
					<div class="pull-right pad1230">
						<button class="btn btn-info" onclick="window.history.go(-1);" data-toggle="tooltip" data-original-title="Back"><i class="fa fa-reply"></i></a>
					</div>
				</div>
			  </div>	
            </div>
			
						
			<?php $sql=mysqli_fetch_assoc(mysqli_query($conn,"select *from tbl_customer where customer_id=".$_GET["id"].""));?>
			
            <div class="panel-body">
              <form class="form-horizontal" method="post">
                <div class="form-group">
                  <label class="col-sm-2 control-label">First name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?php echo $sql["firstname"]?>" name="user_fname">
                  </div>
                </div>
				        <div class="form-group">
                  <label class="col-sm-2 control-label">Last name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?php echo $sql["lastname"]?>" name="user_lname">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">E-mail</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?php echo $sql["email"]?>" readonly>
                  </div>
                </div>
				
				        <div class="form-group">
                  <label class="col-sm-2 control-label">Mobile no.</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?php echo $sql["mobileno"]?>" name="user_mobile">
                  </div>
                </div>				
				        
				        <div class="form-group">
                  <label class="col-sm-2 control-label">Date added</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?php echo dispdateonly($sql["date_added"])?>" readonly>
                  </div>
                </div>
				        <div class="form-group">
                  <label class="col-sm-2 control-label">Status</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="user_status" id="custatus">
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                    <script>
                      $("#custatus").val("<?php echo $sql["status"]?>");
                    </script>
                  </div>
                </div>
				
				        <div class="form-group">
                  <label class="col-sm-2 control-label"></label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" name="addcus">Save</button>
                  </div>
                </div>
				
              </form>
            </div>
			
			<?php 
			if(isset($_REQUEST['addcus']))
			{
				$user_fname=str_replace("'","`",$_POST["user_fname"]);
				$user_lname=str_replace("'","`",$_POST["user_lname"]);
				$user_mobile=str_replace("'","`",$_POST["user_mobile"]);
				$user_status=$_POST["user_status"];
				
				
				$ins=mysqli_query($conn,"update tbl_customer set firstname='$user_fname',lastname='$user_lname',mobileno='$user_mobile',status='$user_status' where customer_id=".$_GET["id"]."");
												
				if($ins)
					echo '<script>alert("Updated successfully"); window.location.href="'.ADMINURL.'view_customer";</script>';
				else
					echo '<script>alert("Error..."); window.location.href="'.ADMINURL.'view_customer";</script>';
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
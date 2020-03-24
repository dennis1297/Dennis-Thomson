<?php
include "include/header.php";
include "include/menu.php";
?>


  <!-- Page -->
  <div class="page animsition">
    <div class="page-header">
      <h1 class="page-title">Attribute Groups</h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php">Home</a></li>
        <li><a href="javascript:void(0)">Attribute Groups</a></li>
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
				<?php 
				if(isset($_GET["atgpid"]))
					echo '<h3 class="panel-title">Edit Attribute Group</h3>';
				else
					echo '<h3 class="panel-title">Add Attribute Group</h3>';
				?>
					
				</div>
				<div class="col-md-6">
					<div class="pull-right pad1230">
						<button class="btn btn-info" onclick="window.history.go(-1);" data-toggle="tooltip" data-original-title="Back"><i class="fa fa-reply"></i></a>
					</div>
				</div>
			  </div>	
            </div>
			
						
			<?php $sql=mysqli_fetch_assoc(mysqli_query($conn,"select *from tbl_attribute_group where attr_group_id=".$_GET["atgpid"].""));?>
			
            <div class="panel-body">
              <form class="form-horizontal" method="post">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Attribute Group name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?php echo $sql["attr_group_name"]?>" name="attr_group_name">
                  </div>
                </div>
				
				<div class="form-group">
                  <label class="col-sm-2 control-label"></label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" name="addattrgp">Save</button>
                  </div>
                </div>
				
              </form>
            </div>
			
			<?php 
			if(isset($_REQUEST['addattrgp']))
			{
				$attr_group_name=str_replace("'","`",$_POST["attr_group_name"]);
				
				if(isset($_GET["atgpid"]))
					$ins=mysqli_query($conn,"update tbl_attribute_group set attr_group_name='$attr_group_name' where attr_group_id='".$_GET["atgpid"]."'");
				else
					$ins=mysqli_query($conn,"insert into tbl_attribute_group (attr_group_name) values('$attr_group_name')");
				
				if($ins)
					echo '<script>alert("Updated successfully"); window.location.href="view_attribute_group.php";</script>';
				else
					echo '<script>alert("Error..."); window.location.href="view_attribute_group.php";</script>';
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
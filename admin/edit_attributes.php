<?php
include "include/header.php";
include "include/menu.php";
?>


  <!-- Page -->
  <div class="page animsition">
    <div class="page-header">
      <h1 class="page-title">Attributes</h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php">Home</a></li>
        <li><a href="javascript:void(0)">Attributes</a></li>
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
				if(isset($_GET["attr"]))
					echo '<h3 class="panel-title">Edit Attribute</h3>';
				else
					echo '<h3 class="panel-title">Add Attribute</h3>';
				?>
					
				</div>
				<div class="col-md-6">
					<div class="pull-right pad1230">
						<button class="btn btn-info" onclick="window.history.go(-1);" data-toggle="tooltip" data-original-title="Back"><i class="fa fa-reply"></i></a>
					</div>
				</div>
			  </div>	
            </div>
			
						
			<?php $sql=mysqli_fetch_assoc(mysqli_query($conn,"select *from tbl_attributes where attr_id=".$_GET["attr"].""));?>
			
            <div class="panel-body">
              <form class="form-horizontal" method="post">
				<div class="form-group">
                  <label class="col-sm-2 control-label">Attribute name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?php echo $sql["attr_name"]?>" name="attr_name">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Attribute Group name</label>
                  <div class="col-sm-10">
					<select id="attr_group_id" class="form-control" name="attr_group_id">
						<option value=""></option>
						<?php $attrgp=mysqli_query($conn,"select *from tbl_attribute_group");
						while($atgp=mysqli_fetch_assoc($attrgp)){
							echo '<option value="'.$atgp["attr_group_id"].'">'.$atgp["attr_group_name"].'</option>';	
						}?>
					</select>
					<script>
						$("#attr_group_id").val('<?php echo $sql["attr_group_id"]?>');
					</script>
                  </div>
                </div>
				
				<div class="form-group">
                  <label class="col-sm-2 control-label"></label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" name="addattr">Save</button>
                  </div>
                </div>
				
              </form>
            </div>
			
			<?php 
			if(isset($_REQUEST['addattr']))
			{
				$attr_name=str_replace("'","`",$_POST["attr_name"]);
				$attr_group_id=$_POST["attr_group_id"];
				
				if(isset($_GET["attr"]))
					$ins=mysqli_query($conn,"update tbl_attributes set attr_group_id='$attr_group_id',attr_name='$attr_name' where attr_id=".$_GET["attr"]."");
				else
					$ins=mysqli_query($conn,"insert into tbl_attributes (attr_group_id,attr_name) values('$attr_group_id','$attr_name')");
				
				if($ins)
					echo '<script>alert("Updated successfully"); window.location.href="view_attributes.php";</script>';
				else
					echo '<script>alert("Error..."); window.location.href="view_attributes.php";</script>';
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
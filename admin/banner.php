<?php
include "include/header.php";
include "include/menu.php";
?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> 

  
  <!-- Page -->
  <div class="page animsition">
    <div class="page-header">
      <h1 class="page-title">Banners</h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php">Home</a></li>
        <li><a href="javascript:void(0)">Banners</a></li>
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
				if(isset($_GET["ctid"]))
					echo '<h3 class="panel-title">Edit Banner</h3>';
				else 
					echo '<h3 class="panel-title">Add Banner</h3>';
				?>
				</div>
				<div class="col-md-6">
					<div class="pull-right pad1230">
						<button class="btn btn-info" onclick="window.history.go(-1);" data-toggle="tooltip" data-original-title="Back"><i class="fa fa-reply"></i></a>
					</div>
				</div>
			  </div>	
            </div>
			
			 
			<?php $sql=mysqli_fetch_assoc(mysqli_query($conn,"select *from  tbl_banner where ban_id=".$_GET["id"].""));?>
			
            <div class="panel-body">
              <form class="form-horizontal" name="cat_add" method="post" enctype="multipart/form-data" autocomplete="off">	  
				<div class="form-group">
                  <label class="col-sm-2 control-label">Banner Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="ban_title" value="<?php echo $sql["ban_title"]?>">					 
					<span id="err"></span>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Banner Content</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="ban_content" value="<?php echo $sql["ban_content"]?>">					 
					<span id="err"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Image</label>
                  <div class="col-sm-10">
					<div class="widht100"><input type="file" id="input-file-now" name="ban_image" data-plugin="dropify"
					data-default-file="<?php if($_GET["id"]) echo SITEURL.substr($sql["ban_image"],3); else echo '';?>" accept=".jpg,.jpeg,.gif,.png"></div>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Position</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" maxlength="2" onkeypress="return enterNumerics(event);" name="ban_pos" value="<?php echo $sql["ban_pos"]?>">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Status</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="ban_status" id="ban_status">
						<option value="Y" selected>Active</option>
						<option value="N">Inactive</option>
					</select>
					<script>
						$("#ban_status").val("<?php echo $sql["ban_status"]?>");
					</script>
                  </div>
                </div>
                <div class="text-right">
                  <button type="submit" class="btn btn-primary" name="addcat">Save</button>
                </div>
              </form>
            </div>
			
			<?php 
			if(isset($_REQUEST['addcat']))
			{ 
				$ban_title=str_replace("'","`",$_POST["ban_title"]);
				$ban_content=str_replace("'","`",$_POST["ban_content"]);
				$ban_pos=str_replace("'","`",$_POST["ban_pos"]);
				 
				$ban_status=$_POST["ban_status"];
				
				if(isset($_GET["id"])){
					
					if($_FILES["ban_image"]["name"])
					{
						unlink($sql["ban_image"]);
						$fileextention1 = explode('.',$_FILES["ban_image"]["name"]);     
						move_uploaded_file($_FILES["ban_image"]["tmp_name"], $cov = "../images/slider/".time().".".$fileextention1[1]);
					}
					else
					{
						$cov=$sql["ban_image"];
					}
					
					$ins=mysqli_query($conn,"update tbl_banner set ban_title='$ban_title',ban_content='$ban_content',ban_image='$cov',ban_pos='$ban_pos',ban_status='$ban_status' where ban_id=".$_GET["id"]."");
				}
				else
				{
					if($_FILES["ban_image"]["name"])
					{
						$fileextention1 = explode('.',$_FILES["ban_image"]["name"]);     
						move_uploaded_file($_FILES["ban_image"]["tmp_name"], $cov = "../images/slider/".time().".".$fileextention1[1]);
					}
					echo $sql="insert into tbl_banner (ban_title,ban_content,ban_image,ban_pos,ban_status) value('$ban_title','$ban_content','$cov','$ban_pos','$ban_status')";
					$ins=mysqli_query($conn, $sql);
				}
				
				if($ins)
					echo '<script>alert("Updated successfully");window.location.href="'.ADMINURL.'banner-list";</script>';
				else 
					echo '<script>alert("Error..");window.location.href="'.ADMINURL.'banner-list";</script>';
			}
			?>

        			
          </div>
          <!-- End Panel Standard Mode -->
        </div>
      </div>

    </div>
  </div>
  <!-- End Page -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
function enterNumerics(e)
{
	if (!e) var e = window.event;
	if(!e.which) key = e.keyCode; 
	else key = e.which; 
	if((key>=46)&&(key<=57)||key==8||key==9) 
	{
		key=key;
		return true;
	}
	else
	{
		key=0;
		return false;
	}
}
$(function() {
	$( "#datepicker" ).datepicker();
	$( "#datepicker1" ).datepicker();
});
</script>
<?php include "include/footer.php";?>
<?php
include "include/header.php";
include "include/menu.php";
?>


  <!-- Page -->
  <div class="page animsition">
    <div class="page-header">
      <h1 class="page-title">Newsletter</h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php">Home</a></li>
        <li><a href="javascript:void(0)">Newsletter</a></li>
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
				if(isset($_GET["id"]))
					echo '<h3 class="panel-title">Edit Newsletter</h3>';
				else
					echo '<h3 class="panel-title">Add Newsletter</h3>';
				?>
				</div>
				<div class="col-md-6">
					<div class="pull-right pad1230">
						<button class="btn btn-info" onclick="window.history.go(-1);" data-toggle="tooltip" data-original-title="Back"><i class="fa fa-reply"></i></a>
					</div>
				</div>
			  </div>	
            </div>

						
			<?php $sql=mysqli_fetch_assoc(mysqli_query($conn,"select *from tbl_newsletter where nl_id=".$_GET["id"].""));?>
			
            <div class="panel-body">
              <form class="form-horizontal" method="post" name="cms_add" enctype="multipart/form-data" autocomplete="off">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nl_title" value="<?php echo $sql["nl_title"];?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Content</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" id="summernote" name="nl_content"><?php echo $sql["nl_content"];?></textarea>
                  </div>
                </div>
				
				<div class="form-group">
                  <label class="col-sm-2 control-label"></label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" name="addnews">Save</button>
                  </div>
                </div>
              </form>
            </div>
			
			
			
			<?php 
			if(isset($_REQUEST['addnews']))
			{
				$nl_title=str_replace("'","`",$_POST["nl_title"]);
				$nl_content=str_replace("'","`",$_POST["nl_content"]);
				
				if(isset($_GET["id"]))
					$ins=mysqli_query($conn,"update tbl_newsletter set nl_title='$nl_title',nl_content='$nl_content',nl_dateadded='".date('Y-m-d')."'
					where nl_id='".$_GET["id"]."' ");
				else
					$ins=mysqli_query($conn,"insert into tbl_newsletter (nl_title,nl_content,nl_dateadded) value('$nl_title','$nl_content',
					'".date('Y-m-d')."')");
								
				if($ins)
					echo '<script>alert("Updated successfully"); window.location.href="view_newsletter.php";</script>';
				else
					echo '<script>alert("Error..."); window.location.href="view_newsletter.php";</script>';
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
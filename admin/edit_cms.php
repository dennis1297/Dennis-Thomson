<?php
include "include/header.php";
include "include/menu.php";
?>


  <!-- Page -->
  <div class="page animsition">
    <div class="page-header">
      <h1 class="page-title">CMS</h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php">Home</a></li>
        <li><a href="javascript:void(0)">CMS</a></li>
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
					<h3 class="panel-title">Edit CMS</h3>
				</div>
				<div class="col-md-6">
					<div class="pull-right pad1230">
						<button class="btn btn-info" onclick="window.history.go(-1);" data-toggle="tooltip" data-original-title="Back"><i class="fa fa-reply"></i></a>
					</div>
				</div>
			  </div>	
            </div>

						
			<?php $sql=mysqli_fetch_assoc(mysqli_query($conn,"select *from tbl_tlink where tl_id=".$_GET["id"].""));?>
			
            <div class="panel-body">
              <form class="form-horizontal" method="post" name="cms_add">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="tl_name" id="tl_name" value="<?php echo $sql["tl_name"]?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Content</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" id="summernote" name="tl_content"><?php echo $sql["tl_content"]?></textarea>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Seo title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?php echo $sql["tl_seo_title"]?>" name="tl_seo_title">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Seo description</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" rows="4" name="tl_seo_description"><?php echo $sql["tl_seo_description"]?></textarea>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Seo keywords</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" rows="4" name="tl_seo_keywords"><?php echo $sql["tl_seo_keywords"]?></textarea>
                  </div>
                </div>
				
                <div class="text-right">
                  <button type="submit" class="btn btn-primary" name="addcms">Save</button>
                </div>
              </form>
            </div>
			
			
			
			<?php 
			if(isset($_REQUEST['addcms']))
			{
				$tl_name=str_replace("'","`",$_POST["tl_name"]);
				$tl_content=str_replace("'","`",$_POST["tl_content"]);
				$tl_seo_title=str_replace("'","`",$_POST["tl_seo_title"]);
				$tl_seo_description=str_replace("'","`",$_POST["tl_seo_description"]);
				$tl_seo_keywords=str_replace("'","`",$_POST["tl_seo_keywords"]);
				
				$ins=mysqli_query($conn,"update tbl_tlink set tl_name='$tl_name',tl_content='$tl_content',tl_seo_title='$tl_seo_title',
				tl_seo_description='$tl_seo_description',tl_seo_keywords='$tl_seo_keywords' where tl_id=".$_GET["id"]."");
								
				if($ins)
					echo '<script>alert("Updated successfully"); window.location.href="view_cms.php";</script>';
				else
					echo '<script>alert("Error..."); window.location.href="view_cms.php";</script>';
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
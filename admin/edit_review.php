<?php
include "include/header.php";
include "include/menu.php";
?>


  <!-- Page -->
  <div class="page animsition">
    <div class="page-header">
      <h1 class="page-title">Reviews </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php">Home</a></li>
        <li><a href="javascript:void(0)">Reviews </a></li>
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
					<h3 class="panel-title">Edit Review</h3>
				</div>
				<div class="col-md-6">
					<div class="pull-right pad1230">
						<button class="btn btn-info" onclick="window.history.go(-1);" data-toggle="tooltip" data-original-title="Back"><i class="fa fa-reply"></i></a>
					</div>
				</div>
			  </div>	
            </div>
			
						
			<?php $sql=mysqli_fetch_assoc(mysqli_query($conn,"select *from tbl_prod_comments pc inner join tbl_product pr on pc.prod_id=pr.prod_id where pcomment_id=".$_GET["reid"].""));?>
			
            <div class="panel-body">
              <form class="form-horizontal" method="post">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?php echo $sql["pcomment_name"]?>" name="pname">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Product</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?php echo $sql["prod_name"]?>" readonly>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Review title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?php echo $sql["pcomment_title"]?>" name="ptitle">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Review</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" rows="4" name="pcomnt"><?php echo $sql["pcomment_comments"]?></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Rating</label>
                  <div class="col-sm-10">
					<select class="form-control" id="rating" name="prating">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select>
					<script>
						$('#rating').val('<?php echo $sql["pcomment_ratings"]?>');
					</script>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Date added</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?php echo $sql["pcomment_createdate"]?>" readonly>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Status</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="pstatus" id="status">
						<option value="Y" selected>Active</option>
						<option value="N">Inactive</option>
					</select>
					<script>
						$("#status").val("<?php echo $sql["pcomment_status"]?>");
					</script>
                  </div>
                </div>
                <div class="text-right">
                  <button type="submit" class="btn btn-primary" name="addrev">Save</button>
                </div>
              </form>
            </div>
			
			<?php 
			if(isset($_REQUEST['addrev']))
			{
				$pname=str_replace("'","`",$_POST["pname"]);
				$ptitle=str_replace("'","`",$_POST["ptitle"]);
				$pcomnt=str_replace("'","`",$_POST["pcomnt"]);
				$prating=$_POST["prating"];
				$pstatus=$_POST["pstatus"];
				
				$ins=mysqli_query($conn,"update tbl_prod_comments set pcomment_name='$pname',pcomment_ratings='$prating',pcomment_title='$ptitle', pcomment_comments='$pcomnt',pcomment_status='$pstatus' where pcomment_id=".$_GET["reid"]."");
								
				if($ins)
					echo '<script>alert("Updated successfully"); window.location.href="view_review.php";</script>';
				else
					echo '<script>alert("Error..."); window.location.href="view_review.php";</script>';
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
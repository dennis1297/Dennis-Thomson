<?php
include "include/header.php";
include "include/menu.php";
?>


  <!-- Page -->
  <div class="page animsition">
    <div class="page-header">
      <h1 class="page-title">Options</h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php">Home</a></li>
        <li><a href="javascript:void(0)">Options</a></li>
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
				if(isset($_GET["opid"]))
					echo '<h3 class="panel-title">Edit Option</h3>';
				else 
					echo '<h3 class="panel-title">Add Option</h3>';
				?>
				</div>
				<div class="col-md-6">
					<div class="pull-right pad1230">
						<button class="btn btn-info" onclick="window.history.go(-1);" data-toggle="tooltip" data-original-title="Back"><i class="fa fa-reply"></i></a>
					</div>
				</div>
			  </div>	
            </div>
			
			<?php $sql=mysqli_fetch_assoc(mysqli_query($conn,"select *from  tbl_options where op_id=".$_GET["opid"].""));?>
			
            <div class="panel-body">
              <form class="form-horizontal" method="post" enctype="multipart/form-data" autocomplete="off">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Option name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="optname" id="optname" value="<?php echo $sql["op_name"]?>">
					<span id="err"></span>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Status</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="optstatus" id="optstatus">
						<option value="Y" selected>Active</option>
						<option value="N">Inactive</option>
					</select>
					<script>
						$("#optstatus").val("<?php echo $sql["op_status"]?>");
					</script>
                  </div>
                </div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label"></label>
					<div class="col-md-10">
						<table class="tableborder table table-bordered table-hover">
							<thead>
								<tr>
								  <th></th>
								  <th>Option Value Name</th>
								  <!--th>Image</th-->
								</tr>
							</thead>
							<tbody id="bodytbl">
								
								<?php
								$opvallt=mysqli_query($conn ,"select *from tbl_options_value where op_id=".$sql["op_id"]."");
								while($opval=mysqli_fetch_assoc($opvallt)){
									echo '
									<tr>
										<td><button type="button" onclick="delopval('.$opval["op_val_id"].')" id="del-optval" class="btn btn-danger btn-sm"><i class="fa fa-minus"></i></button></td>
										<td><input type="hidden" name="optval_id[]" value="'.$opval["op_val_id"].'"><input class="form-control" type="text" name="optval_name[]" value="'.$opval["op_val_name"].'"></td>
										<td><div class="widht100"><input type="file" id="input-file-now" name="optval_img[]" data-plugin="dropify" data-default-file='.$opval["op_val_img"].'></div> <input type="text" name="optval_img1[]" style="width:100%" value="'.$opval["op_val_img"].'"></td>
									</tr> 
									';
								}
								?>
								
								<?php 
									for($i=0;$i<25;$i++)
									{
								?>
								<tr style="display:none" id="row_<?php echo $i; ?>">
									<td><button type='button' id='del-optval' class='btn btn-danger btn-sm'><i class='fa fa-minus'></i></button></td>
									<td><input type="hidden" name="optval_id[]"><input class='form-control' type='text' name="optval_name[]"></td>
									<td><div class='widht100'><input type='file' id='input-file-now' name='optval_img[]' data-plugin='dropify' data-default-file=''></div></td>
								</tr> 
								<?php 
									} 
								?>
							</tbody>
							<tfoot>
								<tr>
									<td>
										<button type="button" id="add-optval" class="btn btn-primary btn-sm">
										<i class="fa fa-plus"></i></button>
									</td>
									<td colspan="2">
									</td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
				
																
                <div class="text-left">
					<div class="col-sm-2"></div>
					<div class="col-sm-10"><button type="submit" class="btn btn-primary" name="addopt">Save</button></div>
                </div>
              </form>
            </div>
			
			<script>
				$(document).ready(function(){
					var i=0;
					$("#add-optval").click(function(){
						
						$("#row_"+i).show();
						i++;
					});
				});
				$(document).on('click', 'button#del-optval', function () {
					$(this).closest('tr').remove();
				});
				function delopval(id)
				{
					var n=window.confirm("Are you sure want to Delete");
					if(n)
						$.get("actions/script.php?action=deleopval&table=tbl_options_value&columnname=op_val_id&id="+id,  resopval);				
				}
				function resopval(msg)
				{
					if(msg=1){
						alert("Delete successfully");
					}
					else{
						alert("Error deleting...");
					}
				}
			</script>
			
			<?php 
			if(isset($_REQUEST['addopt']))
			{
				$optname=str_replace("'","`",$_POST["optname"]);
				$optstatus=$_POST["optstatus"];
				
				if(isset($_GET["opid"])){
					
					$ins=mysqli_query($conn,"update tbl_options set op_name='$optname',op_status='$optstatus' where op_id=".$_GET["opid"]."");
					
					 if($_POST['optval_id']!=''){
						foreach ($_POST['optval_name'] as $key => $value) 
						{							
							$optval_name= $_POST["optval_name"][$key];
							
							if($_FILES["optval_img"]["name"][$key])
							{
								unlink($opval["op_val_img"]);
								$fileextention1 = explode('.',$_FILES["optval_img"]["name"][$key]);     
								move_uploaded_file($_FILES["optval_img"]["tmp_name"][$key], $cov = "../img/options/".time().$key.".".$fileextention1[1]);
							}
							else
							{
								//unlink($opval["op_val_img"]);
							}
							if($optval_name!='')
							{
								$optval_id= $_POST["optval_id"][$key];
								if($optval_id=='')
								$ins = mysqli_query($conn,"insert into tbl_options_value (op_id,op_val_name,op_val_img) values('".$_GET["opid"]."',
							'$optval_name','$cov')");   
							}
						}	
						
					} 
					foreach ($_POST['optval_name'] as $key => $value) 
					{
						$optval_id= $_POST["optval_id"][$key];
						$optval_name= $_POST["optval_name"][$key];
						$cov='';
						if($_FILES["optval_img"]["name"][$key])
						{
							unlink($_POST["optval_img1"][$key]);
							$fileextention1 = explode('.',$_FILES["optval_img"]["name"][$key]);     
							move_uploaded_file($_FILES["optval_img"]["tmp_name"][$key], $cov = "../img/options/".time().$key.".".$fileextention1[1]);
						}
						else
						{
							//$cov=$_POST["optval_img1"][$key];
							unlink($_POST["optval_img1"][$key]);
							/*$fileextention1 = explode('.',$_FILES["optval_img"]["name"][$key]);     
							move_uploaded_file($_FILES["optval_img"]["tmp_name"][$key], $cov = "../img/options/".time().$key.".".$fileextention1[1]);*/
							
						}
						
						if($optval_name!='')
							$ins = mysqli_query($conn,"update tbl_options_value set op_id='".$_GET["opid"]."',op_val_name='$optval_name',op_val_img='$cov' where op_val_id='$optval_id'");   
					}
					
					
				}
				else{
					
					$ins=mysqli_query($conn,"insert into tbl_options (op_name,op_status) value('$optname','$optstatus')");
					$opt_id = mysqli_insert_id($conn);
					
					foreach ($_POST['optval_name'] as $key => $value) 
					{
						$optval_name= $_POST["optval_name"][$key];
						
						if($_FILES["optval_img"]["name"][$key])
						{
							$fileextention1 = explode('.',$_FILES["optval_img"]["name"][$key]);     
							move_uploaded_file($_FILES["optval_img"]["tmp_name"][$key], $cov = "../img/options/".time().$key.".".$fileextention1[1]);
						}
						
						if($optval_name!='')
							$ins = mysqli_query($conn,"insert into tbl_options_value (op_id, op_val_name, op_val_img) values ('$opt_id','$optval_name','$cov')");   
					}
					
				}
				
				
							
				if($ins)
						echo '<script>alert("Updated successfully"); window.location.href="view_options.php";</script>';
					else 
					   echo '<script>alert("Error..");window.location.href="view_options.php";</script>';
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
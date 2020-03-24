<?php
include "include/header.php";
include "include/menu.php";
?>


  <!-- Page -->
  <div class="page animsition">
    <div class="page-header">
      <h1 class="page-title">Categories</h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php">Home</a></li>
        <li><a href="javascript:void(0)">Categories</a></li>
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
					echo '<h3 class="panel-title">Edit Category</h3>';
				else 
					echo '<h3 class="panel-title">Add Category</h3>';
				?>
				</div>
				<div class="col-md-6">
					<div class="pull-right pad1230">
						<button class="btn btn-info" onclick="window.history.go(-1);" data-toggle="tooltip" data-original-title="Back"><i class="fa fa-reply"></i></a>
					</div>
				</div>
			  </div>	
            </div>
			
			<script>
			
			</script>
			
			
			<?php $sql=mysqli_fetch_assoc(mysqli_query($conn,"select *from  tbl_cat where cat_id=".$_GET["ctid"].""));?>
			
            <div class="panel-body">
              <form class="form-horizontal" name="cat_add" method="post" onSubmit="return val()" enctype="multipart/form-data" autocomplete="off">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Category name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="catname" id="catname" value="<?php echo $sql["cat_name"]?>" required>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Category slug</label>
                  <div class="col-sm-10">
					<input type="text" class="form-control" name="catslug" id="catslug" onKeyUp="slug(this.value);checkslug()" onChange="slug(this.value);checkslug()" onBlur="slug(this.value);checkslug()" required value="<?php echo $sql["cat_slug"]?>">
					<span id="err"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Image</label>
                  <div class="col-sm-10">
                  	<input type="file" id="catimg" data-id="catimg_preview" class="form-control" name="catimg" accept=".jpg,.jpeg,.gif,.png">
                  	<div class="img-thumbnail imgpriv"><img id="catimg_preview" class="imgpreview" <?php if($sql["cat_img"]!='') echo 'src="'.SITEURL.substr($sql["cat_img"],3).'" style="width:100%;"';?>></div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Description</label>
                  <div class="col-sm-10">
                    <textarea id="summernote" name="catdesc"><?php echo $sql["cat_desc"]?></textarea>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Parent Category</label>
                  <div class="col-sm-10">
                    <select class="form-control select2" name="pcatid" id="pcatid">
						<option></option>
						<?php $cat=mysqli_query($conn,"select *from tbl_cat where cat_status='Y' order by cat_id asc");
						while($ctnam=mysqli_fetch_assoc($cat))
						{
							
							$res=mysqli_fetch_assoc(mysqli_query($conn, "select pid, cat_id, cat_name from tbl_cat where  cat_id='".$ctnam["pid"]."'"));
							echo '
							<option value="'.$ctnam["cat_id"].'">'.$ctnam["cat_name"].'('.$res["cat_name"].')</option>
							';
						}?>
					</select>
					<script>
						$("#pcatid").val("<?php echo $sql["pid"]?>");
					</script>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Position</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="catpos" onKeyPress="return enterNumerics(event);" maxlength="2" value="<?php echo $sql["cat_pos"]?>" required>
                  </div>
                </div>
				
				<div class="panel-heading">
				  <h3 class="panel-title">Seo details</h3>
				</div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="cattitle" value="<?php echo $sql["cat_seo_title"]?>" />
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Description</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" rows="5" name="catmetdesc" /><?php echo $sql["cat_seo_description"]?></textarea>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Keywords</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" rows="5" name="catmetkey" /><?php echo $sql["cat_seo_keywords"]?></textarea>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Status</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="catstatus" id="catstatus" required>
						<option value="Y" selected>Active</option>
						<option value="N">Inactive</option>
					</select>
					<script>
						$("#catstatus").val("<?php echo $sql["cat_status"]?>");
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
				$catname=str_replace("'","`",$_POST["catname"]);
				$catslug=$_POST["catslug"];
				$catdesc=str_replace("'","`",$_POST["catdesc"]);
				$pcatid=$_POST["pcatid"];
				$catpos=$_POST["catpos"];
				$cattitle=str_replace("'","`",$_POST["cattitle"]);
				$catmetdesc=str_replace("'","`",$_POST["catmetdesc"]);
				$catmetkey=str_replace("'","`",$_POST["catmetkey"]);
				$catstatus=$_POST["catstatus"];
				
				if(isset($_GET["ctid"])){
					
					if($_FILES["catimg"]["name"])
					{
						unlink($sql["cat_img"]);
						$fileextention1 = explode('.',$_FILES["catimg"]["name"]);     
						move_uploaded_file($_FILES["catimg"]["tmp_name"], $imgname = "../images/category/".time().".".$fileextention1[1]);
					}
					else
						$imgname = $sql["cat_img"];
					
					$ins=mysqli_query($conn,"update tbl_cat set pid='$pcatid',cat_name='$catname',cat_slug='$catslug',cat_desc='$catdesc',cat_pos='$catpos',cat_img='$imgname', cat_seo_title='$cattitle',cat_seo_description='$catmetdesc', cat_seo_keywords='$catmetkey',cat_status='$catstatus'
					where cat_id=".$_GET["ctid"]."");
				}
				else{
					if($_FILES["catimg"]["name"])
					{
						$fileextention1 = explode('.',$_FILES["catimg"]["name"]);     
						move_uploaded_file($_FILES["catimg"]["tmp_name"], $imgname = "../images/category/".time().".".$fileextention1[1]);
					}
					
					$ins=mysqli_query($conn,"insert into tbl_cat (pid,cat_name,cat_desc,cat_slug,cat_pos,cat_img,cat_seo_title,cat_seo_description, cat_seo_keywords,cat_status) value('$pcatid','$catname','$catdesc','$catslug','$catpos','$imgname','$cattitle','$catmetdesc','$catmetkey',
					'$catstatus')");
				}
				
				if($ins)
						echo '<script>alert("Updated successfully"); window.location.href="'.ADMINURL.'category-list";</script>';
					else 
					   echo '<script>alert("Error..");window.location.href="'.ADMINURL.'category-list";</script>';
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
<script>
$(document).ready(function(){
	checkslug();
});
function val(){
	var slug_state=$("#err").text();
	if((slug_state)=="OK"){
		return true;
	}
	else{
		$("#catslug").focus();
		return false;
	}
}
function checkslug(){
	var cslug=$("#catslug").val();
	if(cslug){
		$.ajax({
			type:'post',
			url:'<?php echo ADMINURL.'actions/script.php';?>',
			<?php 
			if(isset($_GET["ctid"]))
				echo 'data:{action:"chkcat_slug",cat_slug:cslug,cat_id:'.$_GET["ctid"].'},';
			else	
				echo 'data:{action:"chkcat_slug",cat_slug:cslug},';
			?>
			success:function (response){
				$("#err").html(response);	
				if(response=="OK"){
					return true;
				}
				else{
					return false;
				}
			}
		});
	}
}

function trim(stringToTrim) {
	return stringToTrim.replace(/^\s+|\s+$/g,"");
}
function string_to_slug(str) {
  str = str.replace(/^\s+|\s+$/g, ''); // trim
  str = str.toLowerCase();
  
  // remove accents, swap Ã± for n, etc
  var from = "Ã Ã¡Ã¤Ã¢Ã¨Ã©Ã«ÃªÃ¬Ã­Ã¯Ã®Ã²Ã³Ã¶Ã´Ã¹ÃºÃ¼Ã»Ã±Ã§Â·/_,:;";
  var to   = "aaaaeeeeiiiioooouuuunc------";
  for (var i=0, l=from.length ; i<l ; i++) {
	str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
  }
  str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
	.replace(/\s+/g, '-') // collapse whitespace and replace by -
	.replace(/-+/g, '-'); // collapse dashes
  return str;
}
function slug(valstr)
{
	var str=trim(valstr);
	document.getElementById('catslug').value = string_to_slug(str);
}
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
</script>
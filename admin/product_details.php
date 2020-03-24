<?php
include "include/header.php";
include "include/menu.php";
?>

  <!-- Page -->
  <div class="page animsition">
    <div class="page-header">
      <h1 class="page-title">Products</h1>
    
    </div>
    <div class="page-content container-fluid">
      <!-- Panel Tabs -->
      <div class="panel">
		<div class="panel-heading">
		  <div class="row">
			<div class="col-md-6"><h3 class="panel-title">Product Details</h3></div>
			<div class="col-md-6">
				<div class="pull-right pad1230">
					<button class="btn btn-info" onclick="window.history.go(-1);" data-toggle="tooltip" data-original-title="Back"><i class="fa fa-reply"></i>
				</button></div>
			</div>
		  </div>	
		</div>
        <div class="panel-body container-fluid">
          <div class="row row-lg">
            <div class="col-lg-12">
              <!-- Example Tabs -->
              <div class="example-wrap">
                <div class="nav-tabs-horizontal">
                  <ul class="nav nav-tabs product-tab" data-plugin="nav-tabs" role="tablist">
                    <li id="tabs1" onclick="checkpage('1')" role="presentation"><a>General</a></li>
                    <li id="tabs2" onclick="checkpage('2')" role="presentation"><a>Description</a></li>
                    <li id="tabs3" onclick="checkpage('3')" role="presentation"><a>Option</a></li>
                    <li id="tabs4" onclick="checkpage('4')" role="presentation"><a>Image</a></li>
                  </ul>
				  
					
			
                  <div class="tab-content padding-top-20">

		<!------------ Product general ------------------------>		  
		<?php $progen=mysqli_fetch_assoc(mysqli_query($conn,"select *from tbl_product where prod_id='".$_GET["id"]."'"));?>
		
        <div class="tab-pane" id="tab_1">
          <form class="form-horizontal" name="pro_add" method="post" onsubmit="return prod_val()" enctype="multipart/form-data" autocomplete="off">
						<div class="form-group">
						  <label class="col-sm-2 control-label">Product Type</label>
						  <div class="col-sm-10">
							<select class="form-control" id="product_type" name="prod_type">
								<option value="1">Simple Product</option>
								<option value="2">Variable Product</option>
							</select>
							<script>$("#product_type").val('<?php echo $progen["prod_type"]?>')</script>
						  </div>
						</div>
						<div class="form-group">
						  <label class="col-sm-2 control-label">Product name</label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" name="pdtname" id="pdtname" value="<?php echo $progen["prod_name"];?>">
						  </div>
						</div>
						<div class="form-group">
						  <label class="col-sm-2 control-label">Product slug</label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" name="pdtslug" id="pdtslug" onkeyup="slug(this.value);checkpslug()" onchange="slug(this.value);checkpslug()" onblur="slug(this.value);checkpslug()" value="<?php echo $progen["prod_slug"];?>">
							<span id="err"></span>
						  </div>
						</div>
						<div class="form-group">
						  <label class="col-sm-2 control-label">Product Code</label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" name="pdtcode" value="<?php echo $progen["prod_code"];?>">
						  </div>
						</div>
						<div class="form-group prodtypfmgrp">
						  <label class="col-sm-2 control-label">Selling Price</label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" name="prod_selprice" value="<?php echo $progen["prod_selprice"];?>">
						  </div>
						</div>
						<div class="form-group prodtypfmgrp">
						  <label class="col-sm-2 control-label">MRP</label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" name="prod_mrp" value="<?php echo $progen["prod_mrp"];?>">
						  </div>
						</div>	
						<div class="form-group prodtypfmgrp">
						  <label class="col-sm-2 control-label">Quantity</label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" name="prod_qty" value="<?php echo $progen["prod_qty"];?>">
						  </div>
						</div>						
						<div class="form-group">
						  <label class="col-sm-2 control-label">Status</label>
						  <div class="col-sm-10">
							<select class="form-control" name="status" id="status">
								<option value="Y">Enabled</option>
								<option value="N">Disabled</option>
							</select>
							<script>
								$("#status").val("<?php echo $progen["status"];?>");
							</script>
						  </div>
						</div>
						<div class="form-group">
						  <label class="col-sm-2 control-label">Sort order</label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" name="sortorder" value="<?php echo $progen["sort_order"];?>">
						  </div>
						</div>
						<div class="form-group">
						  <label class="col-sm-2 control-label"></label>
						  <div class="col-sm-10">
							<input type="submit" class="btn btn-success" name="pro_gen" value="Submit">
						  </div>
						</div>
					  </form>
					  
					<script>
					/*$("#product_type").val('<?php echo $progen["prod_type"]?>');
					function prodtype(){
						var protyp = $("#product_type").val();
						if(protyp==1){
							$(".prodtypfmgrp").show();
						}
						else{
							$(".prodtypfmgrp").hide();
							$(".prodtypfmgrp input").val('');
						}
					}*/
					$(document).ready(function(){
						//prodtype();
					});
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
						document.getElementById('pdtslug').value = string_to_slug(str);
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
					$(document).ready(function(){
						checkpslug();
					});
					function checkpslug(){
						var pslug=$("#pdtslug").val();
						if(pslug){
							$.ajax({
								type:'post',
								url:'<?php echo ADMINURL.'actions/script.php';?>',
								<?php 
								if(isset($_GET["id"]))
									echo 'data:{action:"chkpdt_slug",prod_slug:pslug,prod_id:'.$_GET["id"].'},';
								else	
									echo 'data:{action:"chkpdt_slug",prod_slug:pslug},';
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
					function prod_val(){
						var slug_state=$("#err").text();
						if((slug_state)=="OK"){
							return true;
						}
						else{
							$("#pdtslug").focus();
							return false;
						}
					}
					</script>
					
                    </div>
					<?php 
					if(isset($_REQUEST['pro_gen']))
					{
						$prod_type=$_POST["prod_type"];
						$pdtname=str_replace("'","`",$_POST["pdtname"]);
						$pdtslug=$_POST["pdtslug"];
						$pdtcode=str_replace("'","`",$_POST["pdtcode"]);
						$pdtmrp=str_replace("'","`",$_POST["prod_mrp"]);
						$pdtselprice=str_replace("'","`",$_POST["prod_selprice"]);
						$taxtype=$_POST["taxtype"];
						$pdtqty=str_replace("'","`",$_POST["prod_qty"]);
						$pdtminqty=str_replace("'","`",$_POST["pdtminqty"]);
						$substock=str_replace("'","`",$_POST["substock"]);
						$outstockstatus=$_POST["outstockstatus"];
						$status=$_POST["status"];
						$sortorder=str_replace("'","`",$_POST["sortorder"]);
						
						if(isset($_GET["id"])){
							$ins=mysqli_query($conn,"update tbl_product set prod_type='$prod_type',prod_name='$pdtname',prod_code='$pdtcode',prod_mrp='$pdtmrp',prod_selprice='$pdtselprice',tax_type='$taxtype',prod_qty='$pdtqty',prod_min_qty='$pdtminqty',sub_stock='$substock', out_stock_status='$outstockstatus',status='$status',sort_order='$sortorder' where prod_id='".$_GET["id"]."'");
							
							if($ins)
								echo '<script>alert("Updated successfully"); window.location.href="'.ADMINURL.'product_details/2/'.$_GET["id"].'";</script>';
						}
						else{
							$ins=mysqli_query($conn,"insert into tbl_product (prod_type,prod_name,prod_slug,prod_code,prod_mrp,prod_selprice,tax_type,prod_qty,prod_min_qty,sub_stock,out_stock_status,status,sort_order) value('$prod_type','$pdtname','$pdtslug','$pdtcode','$pdtmrp','$pdtselprice','$taxtype','$pdtqty','$pdtminqty','$substock','$outstockstatus','$status','$sortorder')");
							
							$n=mysqli_insert_id($conn);
							
							if($ins)
								echo '<script>alert("Updated successfully"); window.location.href="'.ADMINURL.'product_details/2/'.$n.'";</script>';
						}
						
					}	
					?>
	<!------------ Product general ------------------------>
					
	
	<!------------------ Product description ------------------------>
			<?php $prodesc=mysqli_fetch_assoc(mysqli_query($conn,"select *from tbl_product_description where prod_id='".$_GET["id"]."'"));?>
                    <div class="tab-pane" id="tab_2">
					  <form class="form-horizontal" method="post" enctype="multipart/form-data" autocomplete="off">	
						<div class="form-group">
						  <label class="col-sm-2 control-label">Select Category</label>
						  <div class="col-sm-10">
							<select class="form-control select2" multiple="multiple" name="pdtcats[]">
								<?php
								$cat=mysqli_query($conn,"select *from tbl_cat where cat_status='Y' order by cat_id asc");
								while($ctlst=mysqli_fetch_assoc($cat)){
									
									$slprct=mysqli_fetch_assoc(mysqli_query($conn,"select *from tbl_product_category where prod_id='".$_GET["id"]."' and cat_id='".$ctlst["cat_id"]."'"));
									$select='';
									if($slprct["cat_id"]==$ctlst["cat_id"])
										$select='selected';
									
									
									if($ctlst["pid"]==0)
										echo '<option value="'.$ctlst["cat_id"].'" '.$select.'>'.$ctlst["cat_name"].'</option>';
									else
									{
										echo '<option value="'.$ctlst["cat_id"].'" '.$select.'>';
										$i=1;
										$cat_id=$ctlst["pid"];$cat_names='';
										while($i!=0)
										{						
											$res=mysqli_fetch_assoc(mysqli_query($conn,"select pid,cat_id,cat_name from tbl_cat where cat_status='Y' and cat_id='".$cat_id."' order by cat_id asc"));
											$cat_id=$res["pid"];
											
											$cat_names=" > ".$res["cat_name"].$cat_names;
											$i=$cat_id;
										}
										$cat_names=substr($cat_names,2);
										echo  $cat_names." > ".$ctlst["cat_name"].'</option>';
									}
								}
								?>
							</select>
						  </div>
						</div>
						<div class="form-group">
						  <label class="col-sm-2 control-label">Description</label>
						  <div class="col-sm-10">
							<textarea id="summernote" name="pdtdesc"><?php echo $prodesc["prod_desc"];?></textarea>
						  </div>
						</div>
						<div class="form-group">
						  <label class="col-sm-2 control-label">Meta Title</label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" name="pdtmettitle" value="<?php echo $prodesc["prod_mettitle"];?>">
						  </div>
						</div>
						<div class="form-group">
						  <label class="col-sm-2 control-label">Meta Description</label>
						  <div class="col-sm-10">
							<textarea class="form-control" rows="5" name="pdtmetdesc"><?php echo $prodesc["prod_metdesc"];?></textarea>
						  </div>
						</div>
						<div class="form-group">
						  <label class="col-sm-2 control-label">Meta Keywords</label>
						  <div class="col-sm-10">
							<textarea class="form-control" rows="5" name="pdtmetkeywd"><?php echo $prodesc["prod_metkeywd"];?></textarea>
						  </div>
						</div>
						<!--div class="form-group">
						  <label class="col-sm-2 control-label">Options</label>
						  <div class="col-sm-10">
							<input type="hidden" name="deloptxt" id="deloptxt" class="form-control">
							<select class="form-control select2" multiple="multiple" name="pdtopts[]" id="pdtopts">
								<?php
								/*$opt=mysqli_query($conn,"select op_id,op_name from tbl_options order by op_name asc");
								while($rsopt=mysqli_fetch_assoc($opt)){
									$slprop=mysqli_fetch_assoc(mysqli_query($conn,"select *from tbl_product_option where prod_id='".$_GET["id"]."' and op_id='".$rsopt["op_id"]."'"));
									$select='';
									if($slprop["op_id"]==$rsopt["op_id"])
										$select='selected';
									
									echo '<option value="'.$rsopt["op_id"].'" '.$select.'>'.$rsopt["op_name"].'</option>';
								}*/
								?>
							</select>
						  </div>
						</div-->
						<!--div class="form-group">
						  <label class="col-sm-2 control-label">Product tags</label>
						  <div class="col-sm-10">
							<input type="text"  class="form-control" data-role="tagsinput" name="pdttags" value="<?php echo $prodesc["prod_tags"];?>">
						  </div>
						</div-->
						<div class="form-group">
						  <label class="col-sm-2 control-label"></label>
						  <div class="col-sm-10">
							<input type="submit" class="btn btn-success" name="pro_desc" value="Submit">
						  </div>
						</div>
					  </form>	
                    </div>
					<?php 
					if(isset($_REQUEST['pro_desc']))
					{
						$pdtdesc=str_replace("'","`",$_POST["pdtdesc"]);
						$pdtmettitle=str_replace("'","`",$_POST["pdtmettitle"]);
						$pdtmetdesc=str_replace("'","`",$_POST["pdtmetdesc"]);
						$pdtmetkeywd=str_replace("'","`",$_POST["pdtmetkeywd"]);
						$pdttags=str_replace("'","`",$_POST["pdttags"]);
						$deloptxt = explode(",",$_POST["deloptxt"]);

						foreach($deloptxt as $delopid) {
							$ins = mysqli_query($conn,"delete from tbl_product_options where op_id='$delopid' and prod_id='".$_GET["id"]."'");
							$ins = mysqli_query($conn,"delete from tbl_product_option where op_id='$delopid' and prod_id='".$_GET["id"]."'");
						}
						
						if(isset($_GET["id"])){
							$del=mysqli_query($conn,"delete from tbl_product_category where prod_id='".$_GET["id"]."'");
							foreach ($_POST['pdtcats'] as $key => $value) 
							{
								$pdtcats= $_POST["pdtcats"][$key];
								$ins=mysqli_query($conn,"insert into tbl_product_category (prod_id,cat_id) values('".$_GET["id"]."','$pdtcats')");
							}
							
							$n=mysqli_num_rows(mysqli_query($conn, "select id from tbl_product_description where prod_id='".$_GET["id"]."'"));
							
							if($n==0){							
								$ins=mysqli_query($conn,"insert into tbl_product_description (prod_id,prod_desc,prod_mettitle,prod_metdesc,prod_metkeywd,prod_tags) values('".$_GET["id"]."','$pdtdesc','$pdtmettitle','$pdtmetdesc','$pdtmetkeywd','$pdttags')");
							}
							else{
								$ins=mysqli_query($conn,"update tbl_product_description set prod_desc='$pdtdesc',prod_mettitle='$pdtmettitle',prod_metdesc='$pdtmetdesc',prod_metkeywd='$pdtmetkeywd',prod_tags='$pdttags' where prod_id='".$_GET["id"]."'");
							}
							
							$del=mysqli_query($conn,"delete from tbl_product_option where prod_id='".$_GET["id"]."'");
							foreach ($_POST['pdtopts'] as $key => $value) 
							{
								$pdtopts= $_POST["pdtopts"][$key];
								$ins=mysqli_query($conn,"insert into tbl_product_option(prod_id,op_id) values('".$_GET["id"]."','$pdtopts')");
							}
							
							if($ins)
								echo '<script>alert("Updated successfully");window.location.href="'.ADMINURL.'product_details/3/'.$_GET["id"].'";</script>';
						}
						 					
					}
					?>
	<!------------------ Product description ------------------------>
					
	<!------------------ Product options ---------------------------->
                    <div class="tab-pane" id="tab_3">
						<form class="form-horizontal" method="post" enctype="multipart/form-data" autocomplete="off">
							<input type="hidden" name="del_prod_opt_id" id="del_prod_opt_id" class="form-control">
							<input type="hidden" name="del_prod_opt_val_id" id="del_prod_opt_val_id" class="form-control">
							<div class="col-sm-2">
								<ul class="nav nav-pills nav-stacked" id="option">
									<!--- option retrieval --->
									<?php 
									$propi=0;
									$selprop = mysqli_query($conn,"select product_option_id,product_id,option_id,op_id,op_name from tbl_product_option pos inner join tbl_options tos on pos.option_id=tos.op_id where product_id='".$_GET["id"]."'");
									//no option for a product
									$opprcount=mysqli_num_rows($selprop);

									while($resprop = mysqli_fetch_assoc($selprop)) { 
									$activ = ($propi==0) ? 'active': '';	
									?>
									
									<li class="<?php echo $activ?>"><a href="#tab-option<?php echo $propi?>" data-toggle="tab" aria-expanded="false"><i class="fa fa-minus-circle" onclick=" $('#option a:first').tab('show');$('a[href=\'#tab-option<?php echo $propi?>\']').parent().remove(); $('#tab-option<?php echo $propi?>').remove();rempoid(<?php echo $resprop['product_option_id']?>);"></i> <?php echo $resprop["op_name"]?></a></li>

									<?php $propi++; } ?>
									<!--- option retrieval --->

									<li>
										<select id="input-option" class="form-control select2">
											<option></option>
											<?php 
											$opt=mysqli_query($conn,"select op_id,op_name from tbl_options order by op_name asc");
											while($rsopt=mysqli_fetch_assoc($opt)){
												echo '<option value="'.$rsopt["op_id"].'">'.$rsopt["op_name"].'</option>';
											}
											?>
										</select>
									</li>
								</ul>
							</div>
							<div class="col-sm-10">
								<!-- tab content --->
								<div class="tab-content">

											
								<?php 
								//no option value for a product
								$optionvaluerow = mysqli_num_rows(mysqli_query($conn,"select product_id from tbl_product_option_value where product_id='".$_GET["id"]."'"));

								$proopvali=0;
								$trowopval=0;
								$proopval = mysqli_query($conn,"select product_option_id,product_id,option_id,op_id,op_name from tbl_product_option pos inner join tbl_options tos on pos.option_id=tos.op_id where product_id='".$_GET["id"]."'");								
								while($rsproopval = mysqli_fetch_assoc($proopval)) { 
								$activopvl = 	($proopvali==0) ? 'active': '';
								?>

								<div class="tab-pane <?php echo $activopvl?>" id="tab-option<?php echo $proopvali?>">	
									<input type="hidden" name="product_option[<?php echo $proopvali?>][product_option_id]" value="<?php echo $rsproopval["product_option_id"]?>">	
									<input type="hidden" name="product_option[<?php echo $proopvali?>][name]" value="<?php echo $rsproopval["op_name"]?>">	
									<input type="hidden" name="product_option[<?php echo $proopvali?>][option_id]" value="<?php echo $rsproopval["op_id"]?>">
									
									<div class="table-responsive">  
										<table id="option-value<?php echo $proopvali?>" class="table table-striped table-bordered table-hover">  	 
											<thead>      
												<tr>        
													<td class="text-left">Option Value</td>        
													<td class="text-right">Quantity</td>        
													<td class="text-right">Selling Price</td>        
													<td class="text-right">MRP</td>        
													<td></td>      
												</tr>  	 
											</thead>  	 
											<tbody>	

												<?php 												
												$selalloption = mysqli_query($conn,"select *from tbl_product_option_value where product_id='".$_GET["id"]."' and option_id='".$rsproopval["op_id"]."' and product_option_id='".$rsproopval["product_option_id"]."'");
												while($reselalloption = mysqli_fetch_assoc($selalloption)) {
												?>
												<tr id="option-value-row<?php echo $trowopval?>">  
													<td class="text-left">
														<select name="product_option[<?php echo $proopvali?>][product_option_value][<?php echo $trowopval?>][option_value_id]" class="form-control">  
															<?php 
															$getoptval=mysqli_query($conn,"select *from tbl_options_value where op_id='".$reselalloption["option_id"]."'");
															
															while($resgetoptval=mysqli_fetch_assoc($getoptval)){
																$se='';
																if($resgetoptval["op_val_id"]==$reselalloption["option_value_id"])
																	$se='selected';

																echo '<option value="'.$resgetoptval["op_val_id"].'" '.$se.'>'.$resgetoptval["op_val_name"].'</option>';
															}
															?>  
														</select>
														<input type="hidden" name="product_option[<?php echo $proopvali?>][product_option_value][<?php echo $trowopval?>][product_option_value_id]" value="<?php echo $reselalloption["product_option_value_id"]?>">
													</td>  
													<td class="text-right">
														<input type="text" name="product_option[<?php echo $proopvali?>][product_option_value][<?php echo $trowopval?>][quantity]" value="<?php echo $reselalloption["quantity"]?>" class="form-control">
													</td>  
													<td class="text-right">  
														<select name="product_option[<?php echo $proopvali?>][product_option_value][<?php echo $trowopval?>][sellprice_prefix]" class="form-control">
															<option value="+" <?php if($reselalloption["sellprice_prefix"]=='+') echo 'selected'?>>+</option>
															<option value="-" <?php if($reselalloption["sellprice_prefix"]=='-') echo 'selected'?>>-</option>
														</select>
														<input type="text" name="product_option[<?php echo $proopvali?>][product_option_value][<?php echo $trowopval?>][sellprice]" value="<?php echo $reselalloption["sellprice"]?>" class="form-control">
													</td>  
													<td class="text-right">  
														<select name="product_option[<?php echo $proopvali?>][product_option_value][<?php echo $trowopval?>][mrp_prefix]" class="form-control">
															<option value="+" <?php if($reselalloption["mrp_prefix"]=='+') echo 'selected'?>>+</option>
															<option value="-" <?php if($reselalloption["mrp_prefix"]=='-') echo 'selected'?>>-</option>
														</select>
														<input type="text" name="product_option[<?php echo $proopvali?>][product_option_value][<?php echo $trowopval?>][mrp]" value="<?php echo $reselalloption["mrp"]?>" class="form-control">
													</td>  
													<td class="text-left">
														<button type="button" onclick="$(this).tooltip('destroy');$('#option-value-row<?php echo $trowopval?>').remove();rempovalid(<?php echo $reselalloption['product_option_value_id']?>);" data-toggle="tooltip" rel="tooltip" title="" class="btn btn-danger" data-original-title="Remove"><i class="fa fa-minus-circle"></i></button>
													</td>
												</tr>
												<?php $trowopval++; } ?>		

											</tbody>    
											<tfoot>      
												<tr>        
													<td colspan="4"></td>        
													<td class="text-left">
														<button type="button" onclick="addOptionValue(<?php echo $proopvali?>);" data-toggle="tooltip" title="Add Option Value" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button>
													</td>      
												</tr>    
											</tfoot>  
										</table>
									</div> 
									<!-------- hidden select option ------>
									<select id="option-values<?php echo $proopvali?>" style="display: none;">
										<?php 
										$getoptval=mysqli_query($conn,"select *from tbl_options_value where op_id='".$rsproopval["op_id"]."'");										
										while($resgetoptval=mysqli_fetch_assoc($getoptval)){
											echo '<option value="'.$resgetoptval["op_val_id"].'" '.$se.'>'.$resgetoptval["op_val_name"].'</option>';
										}
										?>
									</select>
									<!-------- hidden select option ------>

								</div>

								<?php $proopvali++; } ?>


								

									
								</div>
								<!-- tab content --->
							</div>
						
						<div class="clearfix"></div>
						<br><br>
						<div class="form-group">
							<div class="col-sm-12">
								<div class="col-sm-12">
									<input type="submit" class="btn btn-success" name="pro_option" value="Submit">
								</div>
							</div>
						</div>
					  </form>	
						<script>
						$(document).ready(function(){

							var option_row = <?php echo $opprcount?>;
							$('#input-option').on('select2:select', function (e) {									
								var id = $(this).val();
								$.get("<?php echo ADMINURL?>script.php", {action: "alloption", optionid : id}, function(data) {

									for (x in data) {  
										label = data[x].name;
										value = data[x].option_id;										
										option_value = data[x].option_value;
									}

									html = '<div class="tab-pane" id="tab-option' + option_row + '">';

									html += '	<input type="hidden" name="product_option[' + option_row + '][product_option_id]" value="" />';
									html += '	<input type="hidden" name="product_option[' + option_row + '][name]" value="' + label + '" />';
									html += '	<input type="hidden" name="product_option[' + option_row + '][option_id]" value="' + value + '" />';

									html += '<div class="table-responsive">';
									html += '  <table id="option-value' + option_row + '" class="table table-striped table-bordered table-hover">';
									html += '  	 <thead>';
									html += '      <tr>';
									html += '        <td class="text-left">Option Value</td>';
									html += '        <td class="text-right">Quantity</td>';
									html += '        <td class="text-right">Selling Price</td>';
									html += '        <td class="text-right">MRP</td>';
									html += '        <td></td>';
									html += '      </tr>';
									html += '  	 </thead>';
									html += '  	 <tbody>';
									html += '    </tbody>';
									html += '    <tfoot>';
									html += '      <tr>';
									html += '        <td colspan="4"></td>';
									html += '        <td class="text-left"><button type="button" onclick="addOptionValue(' + option_row + ');" data-toggle="tooltip" title="Add Option Value" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>';
									html += '      </tr>';
									html += '    </tfoot>';
									html += '  </table>';
									html += '</div>';

									html += '  <select id="option-values' + option_row + '" style="display: none;">';

									for (i = 0; i < option_value.length; i++) {
										html += '  <option value="' + option_value[i]['option_value_id'] + '">' + option_value[i]['name'] + '</option>';
									}

									html += '  </select>';

									html += '</div>';

									$('#tab_3 .tab-content').append(html);

									$('#option > li:last-child').before('<li><a href="#tab-option' + option_row + '" data-toggle="tab"><i class="fa fa-minus-circle" onclick=" $(\'#option a:first\').tab(\'show\');$(\'a[href=\\\'#tab-option' + option_row + '\\\']\').parent().remove(); $(\'#tab-option' + option_row + '\').remove();"></i> ' + label + '</li>');

									$('#option a[href=\'#tab-option' + option_row + '\']').tab('show');

									option_row++;

								}, "json");						
								
								$(this).val('').trigger('change');
							});

						});

						var option_value_row = <?php echo $optionvaluerow?>;
						function addOptionValue(option_row) {
							html = '<tr id="option-value-row' + option_value_row + '">';
							html += '  <td class="text-left"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][option_value_id]" class="form-control">';
							html += $('#option-values' + option_row).html();
							html += '  </select><input type="hidden" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][product_option_value_id]" value="" /></td>';
							html += '  <td class="text-right"><input type="text" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][quantity]" value="" placeholder="Quantity" class="form-control" /></td>';	
														
							html += '  <td class="text-right"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][sellprice_prefix]" class="form-control">';
							html += '    <option value="+">+</option>';
							html += '    <option value="-">-</option>';
							html += '  </select>';
							html += '  <input type="text" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][sellprice]" value="" placeholder="Price" class="form-control" /></td>';
							
							html += '  <td class="text-right"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][mrp_prefix]" class="form-control">';
							html += '    <option value="+">+</option>';
							html += '    <option value="-">-</option>';
							html += '  </select>';
							html += '  <input type="text" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][mrp]" value="" placeholder="Price" class="form-control" /></td>';

							html += '  <td class="text-left"><button type="button" onclick="$(this).tooltip(\'destroy\');$(\'#option-value-row' + option_value_row + '\').remove();" data-toggle="tooltip" rel="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
							html += '</tr>';

							$('#option-value' + option_row + ' tbody').append(html);
							$('[rel=tooltip]').tooltip();

							option_value_row++;
						}

						function rempoid(id){
							var delprodoptid = $("#del_prod_opt_id").val();
							$("#del_prod_opt_id").val(id+','+delprodoptid);
						}
						function rempovalid(id){
							var delprodoptvalid = $("#del_prod_opt_val_id").val();
							$("#del_prod_opt_val_id").val(id+','+delprodoptvalid);
						}
												
						</script>
                    </div>
					<?php 
					if(isset($_REQUEST['pro_option']))
					{
						if($_POST["del_prod_opt_id"]!=''){
							$delid=explode(",",$_POST["del_prod_opt_id"]);
							foreach($delid as $delids){
								mysqli_query($conn,"delete from tbl_product_option where product_option_id='$delids' and product_id='".$_GET["id"]."'");
								mysqli_query($conn,"delete from tbl_product_option_value where product_option_id='$delids' and product_id='".$_GET["id"]."'");
							}
						}

						if($_POST["del_prod_opt_val_id"]!=''){
							$delid=explode(",",$_POST["del_prod_opt_val_id"]);
							foreach($delid as $delids){
								mysqli_query($conn,"delete from tbl_product_option_value where product_option_value_id='$delids' and product_id='".$_GET["id"]."'");
							}
						}						

						foreach($_POST['product_option'] as $key => $value){
							$product_option_id = $value["product_option_id"];
							$option_id = $value["option_id"];

							if($product_option_id!=''){
								$prodopid = $product_option_id;
							}
							else{
								$ins = mysqli_query($conn,"insert into tbl_product_option (product_id,option_id) values ('".$_GET["id"]."','$option_id')");
								$prodopid = mysqli_insert_id($conn);
							}
							

							foreach($value as $tkey => $tvalue){
								foreach($tvalue as $hkey => $hvalue){
									$product_option_value_id = $hvalue["product_option_value_id"];
									$option_value_id = $hvalue["option_value_id"];
									$quantity = $hvalue["quantity"];
									$sellprice_prefix = $hvalue["sellprice_prefix"];
									$sellprice = $hvalue["sellprice"];
									$mrp_prefix = $hvalue["mrp_prefix"];
									$mrp = $hvalue["mrp"];

									if($product_option_value_id!=''){
										$ins = mysqli_query($conn,"update tbl_product_option_value set option_value_id='$option_value_id',quantity='$quantity',sellprice='$sellprice',sellprice_prefix='$sellprice_prefix',mrp_prefix='$mrp_prefix',mrp='$mrp' where product_id='".$_GET["id"]."' and product_option_id='$prodopid' and product_option_value_id='$product_option_value_id'");
									}
									else{
										$ins = mysqli_query($conn,"insert into tbl_product_option_value (product_option_id,product_id,option_id,option_value_id,quantity,sellprice_prefix,sellprice,mrp_prefix,mrp) values ('$prodopid','".$_GET["id"]."','$option_id','$option_value_id','$quantity','$sellprice_prefix','$sellprice','$mrp_prefix','$mrp')");
									}									
								}								
							}
						}				
					
						if($ins)
							echo '<script>alert("Updated successfully");window.location.href="'.ADMINURL.'product_details/4/'.$_GET["id"].'";</script>';
					}
					?>
	<!------------------ Product options ---------------------------->
					
					
					<?php
					$edpdfimg=mysqli_fetch_assoc(mysqli_query($conn,"select *from tbl_product_images where prod_id='".$_GET["id"]."' and img_default='Y'"));
					?>
					<div class="tab-pane" id="tab_4">
					  <form class="form-horizontal" method="post" enctype="multipart/form-data" autocomplete="off">	
						<div class="form-group">
						  <label class="col-sm-2 control-label">Default Image</label>
						  <div class="col-sm-10">
							<input type="file" id="uploadimg" class="form-control" name="proimgdflt">
							<img id="imgpreview" src="<?php echo SITEURL.substr($edpdfimg["prod_image"],3);?>" <?php if(isset($edpdfimg["prod_image"])){echo 'style="display:block;"';}?>>
							<script>
								document.getElementById("uploadimg").onchange = function () {
								var reader = new FileReader();
								reader.onload = function (e) {
									// get loaded data and render thumbnail.
									document.getElementById("imgpreview").src = e.target.result;
									document.getElementById("imgpreview").style.display = "inherit";
								};
								// read the image file as a data URL.
								reader.readAsDataURL(this.files[0]);
							};
							</script>
						  </div>
						</div>
						<div class="form-group">
						  <label class="col-sm-2 control-label">Additional Images</label>
						  <div class="col-sm-10">
							<input type="file" id="file" class="form-control" name="proimgmulti[]" multiple>
							<div id="showdiv">
							<?php
								$edpadimg=mysqli_query($conn , "select *from tbl_product_images where prod_id='".$_GET["id"]."' and img_default='N'");
								while($resadimg=mysqli_fetch_assoc($edpadimg))
								{
									echo '<div id="gal_'.$resadimg["id"].'" class="muldivimg"><img src="'.SITEURL.substr($resadimg["prod_image"],3).'" class="mulimgstyl"><a class="btn btn-danger btn-xs" onclick="deladimg('.$resadimg["id"].')" style="position:absolute;top:0;right:0;"><i class="fa fa-close"></i></a></div>';
								}
							?>
						    </div>
						  </div>
						  <script>
							var filesInput = document.getElementById("file");        
							filesInput.addEventListener("change", function(e){    
								$('.mulrem').remove();			
								var files = e.target.files; //FileList object
								var output = document.getElementById("showdiv");									
								for(var i = 0; i< files.length; i++)
								{
									var file = files[i];                               
									var picReader = new FileReader();                
									picReader.addEventListener("load",function(e){								
										var div = document.createElement("div");
										div.className = "muldivimg mulrem";
										div.innerHTML = "<img class='mulimgstyl' src='" + e.target.result + "'>";      
										output.insertBefore(div,null);									
									});                
									 //Read the image
									picReader.readAsDataURL(file);
								}   
							});
						  </script>
						</div>
						<div class="form-group">
						  <label class="col-sm-2 control-label"></label>
						  <div class="col-sm-10">
							<input type="submit" class="btn btn-success" name="pro_img" value="Submit">
						  </div>
						</div>
					  </form>
					  <script>
						function deladimg(imgid)
						{
							var n=window.confirm("Are you sure want to Delete");
							if(n)
							{
								$("#gal_"+imgid).fadeOut();
								$.get("<?php echo ADMINURL?>actions/script.php?action=deladproimgs&id="+imgid, resdeladimgs);
							}						
						}
						function resdeladimgs(msg)
						{
							if(msg==1){
								alert("Deleted successfully");								
							}
							else
								alert("Error deleting..");
						}
					</script>
					</div>
					<?php 
					if(isset($_REQUEST['pro_img']))
					{
						foreach($_FILES["proimgmulti"]["tmp_name"] as $key=>$tmp_name) 
						{
							$imgname='';
							if($_FILES["proimgmulti"]["name"][$key])
							{
								/*$fileextention1 = explode('.',$_FILES["proimgmulti"]["name"][$key]);     
								move_uploaded_file($_FILES["proimgmulti"]["tmp_name"][$key], $imgname = "../images/products/".time().$key.".".$fileextention1[1]);*/
								
								$folder="../images/products/";
								move_uploaded_file($_FILES["proimgmulti"]["tmp_name"][$key], "$folder".$_FILES["proimgmulti"]["name"][$key]);
								$uploadimage=$folder.$_FILES["proimgmulti"]["name"][$key];
								$newname=$_FILES["proimgmulti"]["name"][$key];
								$thumbnail = $folder.time().$key.".jpg";					  
								$imgname = $folder.time().$key.".jpg";
								$source = imagecreatefromjpeg($uploadimage);
								$watermark = imagecreatefrompng('watermark.png');
								$water_width = imagesx($watermark);
								$water_height = imagesy($watermark);
								$main_width = imagesx($source);
								$main_height = imagesy($source);
								$dime_x = 200;
								$dime_y = 150;
								imagecopy($source, $watermark, $dime_x, $dime_y, 0, 0, $water_width, $water_height);
								imagejpeg($source, $thumbnail, 100);					  
								unlink($folder.$newname);
							}
							if($imgname!='')
								$ins=mysqli_query($conn,"insert into tbl_product_images (prod_id,prod_image,img_default) value('".$_GET["id"]."','$imgname','N')");
						}
						
						if(isset($edpdfimg["prod_image"])){							
							if($_FILES["proimgdflt"]["name"])
							{
								unlink($edpdfimg["prod_image"]);
								
								$folder="../images/products/";
								move_uploaded_file($_FILES["proimgdflt"]["tmp_name"], "$folder".$_FILES["proimgdflt"]["name"]);
								$uploadimage=$folder.$_FILES["proimgdflt"]["name"];
								$newname=$_FILES["proimgdflt"]["name"];
								$thumbnail = $folder.time().".jpg";					  
								$imgname = $folder.time().".jpg";
								$source = imagecreatefromjpeg($uploadimage);
								$watermark = imagecreatefrompng('watermark.png');
								$water_width = imagesx($watermark);
								$water_height = imagesy($watermark);
								$main_width = imagesx($source);
								$main_height = imagesy($source);
								$dime_x = 200;
								$dime_y = 150;
								imagecopy($source, $watermark, $dime_x, $dime_y, 0, 0, $water_width, $water_height);
								imagejpeg($source, $thumbnail, 100);					  
								unlink($folder.$newname);
							}
							else
								$imgname=$edpdfimg["prod_image"];
							
							$ins=mysqli_query($conn,"update tbl_product_images set prod_image='$imgname' where id='".$edpdfimg["id"]."'");
						}
						else{
							if($_FILES["proimgdflt"]["name"])
							{								
								$folder="../images/products/";
								move_uploaded_file($_FILES["proimgdflt"]["tmp_name"], "$folder".$_FILES["proimgdflt"]["name"]);
								$uploadimage=$folder.$_FILES["proimgdflt"]["name"];
								$newname=$_FILES["proimgdflt"]["name"];
								$thumbnail = $folder.time().".jpg";					  
								$imgname = $folder.time().".jpg";
								$source = imagecreatefromjpeg($uploadimage);
								$watermark = imagecreatefrompng('watermark.png');
								$water_width = imagesx($watermark);
								$water_height = imagesy($watermark);
								$main_width = imagesx($source);
								$main_height = imagesy($source);
								$dime_x = 200;
								$dime_y = 150;
								imagecopy($source, $watermark, $dime_x, $dime_y, 0, 0, $water_width, $water_height);
								imagejpeg($source, $thumbnail, 100);					  
								unlink($folder.$newname);
							}
							
							$ins=mysqli_query($conn,"insert into tbl_product_images (prod_id,prod_image,img_default) value('".$_GET["id"]."','$imgname','Y')");
						}
						
						if($ins)
							echo '<script>alert("Updated successfully"); window.location.href="'.ADMINURL.'product-list";</script>';
					}
					?>					
										
                  </div>
                </div>
              </div>
              <!-- End Example Tabs -->
            </div>

            
          </div>

        <script>
				$('#pdtopts').on('select2:unselecting', function (e) {
					var id = e.params.args.data.id;
					var delopid= $("#deloptxt").val()+','+id;
					$("#deloptxt").val(delopid);
				});

			var page="<?php echo $_GET["page"]?>";
			if(page=='')
				window.location.href="<?php echo ADMINURL?>product_details/1";
			
			var proid="<?php echo $_GET["id"]?>";
			$("#tabs"+page).addClass("active");
			$("#tab_"+page).addClass("active");
			function checkpage(id)
			{
				
				var page="<?php echo $_GET["page"]?>";
				 
				page=Number(page);
				id=Number(id); 
				if(proid=='')
				{ 
					if(page>id)
					{
						if(proid!='')
							window.location.href="<?php echo ADMINURL?>product_details/"+id+"/"+proid;
						else
							window.location.href="<?php echo ADMINURL?>product_details/"+id;	
					}
					else
					{ 
						$("#tabs"+page).addClass("active");
						$("#tabs"+id).removeClass("active");  
					}
				}
				else
				{
					window.location.href="<?php echo ADMINURL?>product_details/"+id+"/"+proid;
				}
			}
			
		</script>
                   
        </div>
      </div>
   
      

      

          
    </div>
  </div>
  <!-- End Page -->

<?php include "include/footer.php";?>
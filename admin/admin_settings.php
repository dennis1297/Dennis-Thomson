<?php
include "include/header.php";
include "include/menu.php";
?>


  <!-- Page -->
  <div class="page animsition">
    <div class="page-header">
      <h1 class="page-title">Settings</h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php">Home</a></li>
        <li><a href="javascript:void(0)">Settings</a></li>
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
					<h3 class="panel-title">Edit Settings</h3>
				</div>
				<div class="col-md-6">
					<div class="pull-right pad1230">
						<button class="btn btn-info" onclick="window.history.go(-1);" data-toggle="tooltip" data-original-title="Back"><i class="fa fa-reply"></i></a>
					</div>
				</div>
			  </div>	
            </div>
			
						
			<?php $sql=mysqli_fetch_assoc(mysqli_query($conn,"select *from tbl_settings where set_id='1'"));
			$extrafields = @unserialize($sql['extra_fields']);
			?>
			
            <div class="panel-body">
              <form class="form-horizontal" method="post">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Site url</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?php echo $sql["set_url"]?>" name="set_url">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Customercare number</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?php echo $extrafields['headermobnumber']?>" name="extraarg[headermobnumber]">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Support email</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?php echo $sql["support_email"]?>" name="support_email">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Service tax %</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?php echo $sql["serv_tax"]?>" name="serv_tax">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">VAT %</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?php echo $sql["vat_tax"]?>" name="vat_tax">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">COD charges in %</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?php echo $sql["cod_percentage"]?>" name="cod_percentage">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Products per page</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?php echo $sql["set_bpsize"]?>" name="set_bpsize">
                  </div>
                </div>
				<div class="form-group">
				  <h4 class="col-sm-12">SMS Gateway</h4>
                  <label class="col-sm-2 control-label">Username</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?php echo $sql["sms_uname"]?>" name="sms_uname">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?php echo $sql["sms_pass"]?>" name="sms_pass">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Sender ID</label>
                  <div class="col-sm-10">
					<input type="text" class="form-control" value="<?php echo $sql["sms_send_id"]?>" name="sms_send_id">
                  </div>
                </div>
				<div class="form-group">
				  <h4 class="col-sm-12">Payment settings</h4>
                  <label class="col-sm-2 control-label">Payment options</label>
                  <div class="col-sm-10">
					<?php $pay = explode(",", $sql['payment_mode']); ?>
                    <ul class="list-unstyled list-inline">
                      <li>
						<div class="checkbox-custom checkbox-primary">
						  <input type="checkbox" id="inputccav" name="payment_mode_1" <?php if($pay[0] != "") { ?>checked="checked"<?php } ?>>
						  <label for="inputccav">CCAvenue</label>
						</div>
					  </li>
					  <li>
						<div class="checkbox-custom checkbox-primary">
						  <input type="checkbox" id="inputebs" name="payment_mode_2" <?php if($pay[1] != "") { ?>checked="checked"<?php } ?>>
						  <label for="inputebs">EBS</label>
						</div>
					  </li>
					  <li>
						<div class="checkbox-custom checkbox-primary">
						  <input type="checkbox" id="inputcod" name="payment_mode_3" <?php if($pay[2] != "") { ?>checked="checked"<?php } ?>>
						  <label for="inputcod">Cash on Delivery</label>
						</div>
					  </li>
					</ul>
				  </div>
                </div>
				
				<div class="form-group">
				  <h4 class="col-sm-12">EBS Settings</h4>
				  <label class="col-sm-2 control-label">Account Id</label>
				  <div class="col-sm-10">
					<input type="text" class="form-control col-md-4 inline" value="<?php echo $sql["ebs_acc_id"]?>" name="ebs_acc_id">
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label">Secret key</label>
				  <div class="col-sm-10">
					<input type="text" class="form-control col-md-4 inline" value="<?php echo $sql["ebs_sec_key"]?>" name="ebs_sec_key">
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label">Mode</label>
				  <div class="col-sm-10">
					<input type="text" class="form-control col-md-4 inline" value="<?php echo $sql["ebs_mode"]?>" name="ebs_mode">
				  </div>
				</div>
				<div class="form-group">
				  <h4 class="col-sm-12">CCAvenue Settings</h4>
				  <label class="col-sm-2 control-label">Access code</label>
				  <div class="col-sm-10">
					<input type="text" class="form-control col-md-4 inline" value="<?php echo $sql["ccav_acc_code"]?>" name="ccav_acc_code">
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label">Working key</label>
				  <div class="col-sm-10">
					<input type="text" class="form-control col-md-4 inline" value="<?php echo $sql["ccav_work_key"]?>" name="ccav_work_key">
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label">Merchant data</label>
				  <div class="col-sm-10">
					<input type="text" class="form-control col-md-4 inline" value="<?php echo $sql["ccav_merch_data"]?>" name="ccav_merch_data">
				  </div>
				</div>               
				
				<div class="form-group">
				  <h4 class="col-sm-12">Customer Settings</h4>
                  <label class="col-sm-2 control-label">Non Effective</label>
                  <div class="col-sm-10">
					<div class="row">
						<label class="col-md-1 control-label">Below</label>
						<div class="col-md-2"><input type="text" class="form-control col-md-4 inline" value="<?php echo $extrafields["noneffective"]?>"
						name="extraarg[noneffective]"></div>
						<label class="text-left col-md-9 control-label">Orders</label>
					</div>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Effective</label>
                  <div class="col-sm-10">
					<div class="row">
						<label class="col-md-1 control-label">From</label>
						<div class="col-md-2"><input type="text" class="form-control col-md-4 inline" value="<?php echo $extrafields["effective_from"]?>"
						name="extraarg[effective_from]"></div>
						<label class="text-left col-md-1 control-label">Orders to</label>
						<div class="col-md-2"><input type="text" class="form-control col-md-4 inline" value="<?php echo $extrafields["effective_to"]?>"
						name="extraarg[effective_to]"></div>
						<label class="text-left col-md-6 control-label">Orders</label>
					</div>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Privileged</label>
                  <div class="col-sm-10">
					<div class="row">
						<label class="col-md-1 control-label">From</label>
						<div class="col-md-2"><input type="text" class="form-control col-md-4 inline" value="<?php echo $extrafields["previleged_from"]?>"
						name="extraarg[previleged_from]"></div>
						<label class="text-left col-md-1 control-label">Orders to</label>
						<div class="col-md-2"><input type="text" class="form-control col-md-4 inline" value="<?php echo $extrafields["previleged_to"]?>"
						name="extraarg[previleged_to]"></div>
						<label class="text-left col-md-6 control-label">Orders</label>
					</div>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Most Privileged</label>
                  <div class="col-sm-10">
					<div class="row">
						<label class="col-md-1 control-label">Above</label>
						<div class="col-md-2"><input type="text" class="form-control col-md-4 inline" value="<?php echo $extrafields["mprevileged"]?>"
						name="extraarg[mprevileged]"></div>
						<label class="text-left col-md-9 control-label">Orders</label>
					</div>
                  </div>
                </div>
				<div class="form-group">
				  <h4 class="col-sm-12">General SEO Settings</h4>
                  <label class="col-sm-2 control-label">Title</label>
                  <div class="col-sm-10">
					<input type="text" class="form-control col-md-4 inline" value="<?php echo $sql["seo_title"]?>" name="seo_title">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Description</label>
                  <div class="col-sm-10">
					<textarea class="form-control" rows="4" name="seo_description"><?php echo $sql["seo_description"]?></textarea>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Keywords</label>
                  <div class="col-sm-10">
					<textarea class="form-control" rows="4" name="seo_keywords"><?php echo $sql["seo_keywords"]?></textarea>
                  </div>
                </div>
				<div class="form-group">
				  <h4 class="col-sm-12">General SEO settings for Cart</h4>
                  <label class="col-sm-2 control-label">Title</label>
                  <div class="col-sm-10">
					<input type="text" class="form-control col-md-4 inline" value="<?php echo $sql["seo_cart_title"]?>" name="seo_cart_title">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Description</label>
                  <div class="col-sm-10">
					<textarea class="form-control" rows="4" name="seo_cart_description"><?php echo $sql["seo_cart_description"]?></textarea>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Keywords</label>
                  <div class="col-sm-10">
					<textarea class="form-control" rows="4" name="seo_cart_keywords"><?php echo $sql["seo_cart_keywords"]?></textarea>
                  </div>
                </div>
				<div class="form-group">
				  <h4 class="col-sm-12">General SEO settings for Checkout</h4>
                  <label class="col-sm-2 control-label">Title</label>
                  <div class="col-sm-10">
					<input type="text" class="form-control col-md-4 inline" value="<?php echo $sql["seo_check_title"]?>" name="seo_check_title">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Description</label>
                  <div class="col-sm-10">
					<textarea class="form-control" rows="4" name="seo_check_description"><?php echo $sql["seo_check_description"]?></textarea>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Keywords</label>
                  <div class="col-sm-10">
					<textarea class="form-control" rows="4" name="seo_check_keywords"><?php echo $sql["seo_check_keywords"]?></textarea>
                  </div>
                </div>
				<div class="form-group">
				  <h4 class="col-sm-12">General SEO settings for Login</h4>
                  <label class="col-sm-2 control-label">Title</label>
                  <div class="col-sm-10">
					<input type="text" class="form-control col-md-4 inline" value="<?php echo $sql["seo_log_title"]?>" name="seo_log_title">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Description</label>
                  <div class="col-sm-10">
					<textarea class="form-control" rows="4" name="seo_log_description"><?php echo $sql["seo_log_description"]?></textarea>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Keywords</label>
                  <div class="col-sm-10">
					<textarea class="form-control" rows="4" name="seo_log_keywords"><?php echo $sql["seo_log_keywords"]?></textarea>
                  </div>
                </div>
				
                <div class="text-left">
				  <label class="col-sm-2 control-label"></label>
				  <div class="col-sm-10">
					<button type="submit" class="btn btn-success" name="addset">Submit</button>
				  </div>
                </div>
              </form>
            </div>
			
			<?php 
			if(isset($_REQUEST['addset']))
			{
				$set_url=str_replace("'","`",$_POST["set_url"]);
				$cod_percentage=str_replace("'","`",$_POST["cod_percentage"]);
				$serv_tax=str_replace("'","`",$_POST["serv_tax"]);
				$vat_tax=str_replace("'","`",$_POST["vat_tax"]);
				$set_bpsize=str_replace("'","`",$_POST["set_bpsize"]);
				$sms_uname=str_replace("'","`",$_POST["sms_uname"]);
				$sms_pass=str_replace("'","`",$_POST["sms_pass"]);
				$sms_send_id=str_replace("'","`",$_POST["sms_send_id"]);
				$support_email=str_replace("'","`",$_POST["support_email"]);
				
				$i=1;
				while($i<=3)
				{
				$pay_mode[]=$_REQUEST['payment_mode_'.$i];
				$i++;
				}
				$payment_mode = implode(",", $pay_mode);
				
				$ebs_acc_id=str_replace("'","`",$_POST["ebs_acc_id"]);
				$ebs_sec_key=str_replace("'","`",$_POST["ebs_sec_key"]);
				$ebs_mode=str_replace("'","`",$_POST["ebs_mode"]);
				$ccav_acc_code=str_replace("'","`",$_POST["ccav_acc_code"]);
				$ccav_work_key=str_replace("'","`",$_POST["ccav_work_key"]);
				$ccav_merch_data=str_replace("'","`",$_POST["ccav_merch_data"]);
				
				$extraarg = mysql_real_escape_string(serialize($_REQUEST['extraarg']));
				
				$seo_title=str_replace("'","`",$_POST["seo_title"]);
				$seo_description=str_replace("'","`",$_POST["seo_description"]);
				$seo_keywords=str_replace("'","`",$_POST["seo_keywords"]);
				
				$seo_cart_title=str_replace("'","`",$_POST["seo_cart_title"]);
				$seo_cart_description=str_replace("'","`",$_POST["seo_cart_description"]);
				$seo_cart_keywords=str_replace("'","`",$_POST["seo_cart_keywords"]);
				
				$seo_check_title=str_replace("'","`",$_POST["seo_check_title"]);
				$seo_check_description=str_replace("'","`",$_POST["seo_check_description"]);
				$seo_check_keywords=str_replace("'","`",$_POST["seo_check_keywords"]);
				
				$seo_log_title=str_replace("'","`",$_POST["seo_log_title"]);
				$seo_log_description=str_replace("'","`",$_POST["seo_log_description"]);
				$seo_log_keywords=str_replace("'","`",$_POST["seo_log_keywords"]);
				
				$ins=mysqli_query($conn,"update tbl_settings set set_url='$set_url',cod_percentage='$cod_percentage',serv_tax='$serv_tax',
				vat_tax='$vat_tax',set_bpsize='$set_bpsize',sms_uname='$sms_uname',sms_pass='$sms_pass',sms_send_id='$sms_send_id',
				ebs_acc_id='$ebs_acc_id',ebs_sec_key='$ebs_sec_key',ebs_mode='$ebs_mode',ccav_acc_code='$ccav_acc_code',ccav_work_key='$ccav_work_key', ccav_merch_data='$ccav_merch_data',support_email='$support_email',payment_mode='$payment_mode',extra_fields='".$extraarg ."',seo_title='$seo_title',seo_description='$seo_description',seo_keywords='$seo_keywords',seo_cart_title='$seo_cart_title',seo_cart_description='$seo_cart_description',seo_cart_keywords='$seo_cart_keywords',seo_check_title='$seo_check_title',seo_check_description='$seo_check_description',seo_check_keywords='$seo_check_keywords',seo_log_title='$seo_log_title',seo_log_description='$seo_log_description',seo_log_keywords='$seo_log_keywords'	where set_id=1");
								
				if($ins)
					echo '<script>alert("Updated successfully"); window.location.href="admin_settings.php";</script>';
				else
					echo '<script>alert("Error..."); window.location.href="admin_settings.php";</script>';
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
<?php
include "include/header.php";
include "include/menu.php";
?>

<div class="page animsition">
    <div class="page-header">
      <h1 class="page-title">Products</h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php">Home</a></li>
        <li><a href="javascript:void(0)">Products</a></li>
      </ol>
    </div>
	 
	<div class="page-content">
	  <div class="panel">
        <header class="panel-heading">
		  <div class="row">
			  <div class="col-md-6"><h3 class="panel-title">Product List</h3></div>
			  <div class="col-md-6">
			    <div class="pull-right pad1230">
					<a href="<?php echo ADMINURL?>product_details/1" class="btn btn-primary">Add Product</a>
				</div>
			  </div>
		  </div>
        </header>
        <div class="panel-body">
          <table class="table table-hover table-bordered dataTable table-striped width-full" id="datatable">
            <thead>
              <tr>
                <th>Product Name</th>
				<th>Image</th>
                <!--th>Code</-->
				<th>Status</th>
				<th>Sort order</th>
				<th>Action</th>
              </tr>
            </thead>
            <tbody>
			<?php $prolist=mysqli_query($conn,"select pr.prod_id,prod_name,prod_code,status,sort_order,prod_image,img_default from tbl_product pr inner join tbl_product_images pimg on pr.prod_id=pimg.prod_id where pimg.img_default='Y' group by prod_id");
			while($prlst=mysqli_fetch_assoc($prolist)){
			echo '<tr>
				<td>'.$prlst["prod_name"].'</td>
				<td><div style="width:50px;height:50px;padding:2px;border:1px solid #ddd;border-radius:2px;"><img src="'.SITEURL.substr($prlst["prod_image"],3).'"  style="width:100%;height:100%;object-fit:contain;"></div></td>';
				
				//<td>'.$prlst["prod_code"].'</td>
	
				if($prlst["status"]=='Y')
					echo '<td><span class="statusactive">Active</span></td>';
				else
					echo '<td><span class="statusinactive">Inactive</span</td>';
				
				echo '<td>'.$prlst["sort_order"].'</td>
				<td><a href="'.ADMINURL.'product_details/1/'.$prlst["prod_id"].'" class="btn btn-primary btn-sm" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a>
				<button onclick="del('.$prlst["prod_id"].')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash-o"></i></button>
				</td>
			</tr>	
			';
			}?>
             
            </tbody>
          </table>
        </div>
      </div>
	</div>
	  
</div>
<script>
		function del(id){
			var n=window.confirm("Are you sure want to Delete");
			if(n)
				$.get("<?php echo ADMINURL?>actions/script.php?action=deleteprod&id="+id, resattr);
		}
		function resattr(msg)
		{
			if(msg==1){
				alert("Deleted successfully");
				window.location.href = '<?php echo ADMINURL?>product-list';
			}
			else
				alert("Error...");
				window.location.href = '<?php echo ADMINURL?>product-list';
		}
		</script>
		
	
<?php include "include/footer.php";?>
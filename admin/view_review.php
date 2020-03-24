<?php
include "include/header.php";
include "include/menu.php";
?>

<div class="page animsition">
    <div class="page-header">
      <h1 class="page-title">Reviews</h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php">Home</a></li>
        <li><a href="javascript:void(0)">Reviews</a></li>
      </ol>
    </div>
	 
	<div class="page-content">
	  <div class="panel">
        <header class="panel-heading">
		  <div class="row">
			  <div class="col-md-6"><h3 class="panel-title">Review List</h3></div>
			  <div class="col-md-6">
			    <!--div class="pull-right pad1230">
					<a href="add_category.php" class="btn btn-primary">Add Review</a>
				</div-->
			  </div>
		  </div>
        </header>
        <div class="panel-body">
          <table class="table table-hover datatable table-striped width-full" id="reviewdatatable">
            <thead>
              <tr>
				<th style="display:none">Id</th>
                <th>Product</th>
                <th>Name</th>
				<th>Rating</th>
                <th>Status</th>
				<th>Action</th>
              </tr>
            </thead>
            <tbody>
			<?php $revlist=mysqli_query($conn,"select *from tbl_prod_comments pc inner join tbl_product pr on pc.prod_id=pr.prod_id group by pc.prod_id");
			while($rvlst=mysqli_fetch_assoc($revlist)){
			echo '<tr>
				<td style="display:none">'.$rvlst["pcomment_id"].'</td>
				<td>'.$rvlst["prod_name"].'</td>
				<td>'.$rvlst["pcomment_name"].'</td>
				<td>'.$rvlst["pcomment_ratings"].'</td>';
				if($rvlst["pcomment_status"]=='Y')
					echo '<td><span class="statusactive">Active</span></td>';
				else
					echo '<td><span class="statusinactive">Inactive</span</td>';
				
				echo '<td><a href="edit_review.php?reid='.$rvlst["pcomment_id"].'" class="btn btn-primary btn-sm" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a></td>
			</tr>	
			';
			}?>
             
            </tbody>
          </table>
        </div>
      </div>
	</div>
	  
</div>
	
<?php include "include/footer.php";?>
<script>
$(document).ready(function() {
    $('#reviewdatatable').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
} );
</script>
<?php
include "include/header.php";
include "include/menu.php";
?>

<div class="page animsition">
    <div class="page-header">
      <h1 class="page-title">CMS</h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php">Home</a></li>
        <li><a href="javascript:void(0)">CMS</a></li>
      </ol>
    </div>
	 
	<div class="page-content">
	  <div class="panel">
        <header class="panel-heading">
		  <div class="row">
			  <div class="col-md-6"><h3 class="panel-title">Page List</h3></div>
			  <div class="col-md-6">
			    <!--div class="pull-right pad1230">
					<a href="add_category.php" class="btn btn-primary">Add Review</a>
				</div-->
			  </div>
		  </div>
        </header>
        <div class="panel-body">
          <table class="table table-hover datatable table-striped width-full">
            <thead>
              <tr>
                <th>Page name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
			<?php $cmslist=mysqli_query($conn,"select tl_id,tl_name from tbl_tlink");
			while($cmslst=mysqli_fetch_assoc($cmslist)){
			echo '<tr>
				<td>'.$cmslst["tl_name"].'</td>
				<td><a href="edit_cms.php?id='.$cmslst["tl_id"].'" class="btn btn-primary btn-sm" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a></td>
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
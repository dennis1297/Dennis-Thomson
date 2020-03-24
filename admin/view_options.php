<?php
include "include/header.php";
include "include/menu.php";
?>

<div class="page animsition">
    <div class="page-header">
      <h1 class="page-title">Options</h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php">Home</a></li>
        <li><a href="javascript:void(0)">Options</a></li>
      </ol>
    </div>
	 
	<div class="page-content">
	  <div class="panel">
        <header class="panel-heading">
		  <div class="row">
			  <div class="col-md-6"><h3 class="panel-title">Option List</h3></div>
			  <div class="col-md-6">
			    <div class="pull-right pad1230">
					<a href="<?php echo ADMINURL.'add-options'?>" class="btn btn-primary">Add Option</a>
				</div>
			  </div>
		  </div>
        </header>
        <div class="panel-body">
          <table class="table table-bordered table-hover dataTable table-striped width-full" id="datatable">
            <thead>
              <tr>
                <th>Option Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
			<?php $optlist=mysqli_query($conn,"select *from tbl_options");
			while($oplst=mysqli_fetch_assoc($optlist)){
			echo '<tr>
				<td>'.$oplst["op_name"].'</td>';
					
				echo '<td><a href="'.ADMINURL.'edit-options/'.$oplst["op_id"].'" class="btn btn-primary btn-sm" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a></td>
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
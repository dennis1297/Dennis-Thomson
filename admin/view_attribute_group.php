<?php
include "include/header.php";
include "include/menu.php";
?>

<div class="page animsition">
    <div class="page-header">
      <h1 class="page-title">Attribute Groups</h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php">Home</a></li>
        <li><a href="javascript:void(0)">Attribute Groups</a></li>
      </ol>
    </div>
	 
	<div class="page-content">
	  <div class="panel">
        <header class="panel-heading">
		  <div class="row">
			  <div class="col-md-6"><h3 class="panel-title">Attribute Group List</h3></div>
			  <div class="col-md-6">
			    <div class="pull-right pad1230">
					<a href="edit_attribute_group.php" class="btn btn-primary">Add Attribute Group</a>
				</div>
			  </div>
		  </div>
        </header>
        <div class="panel-body">
          <table class="table table-hover datatable table-striped width-full" id="datatable">
            <thead>
              <tr>
                <th>Attribute Group Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
			<?php
			$attrgplist=mysqli_query($conn,"select *from tbl_attribute_group");
			while($atgplst=mysqli_fetch_assoc($attrgplist)){
			echo '<tr>
				<td>'.$atgplst["attr_group_name"].'</td>
				<td><a href="edit_attribute_group.php?atgpid='.$atgplst["attr_group_id"].'" class="btn btn-primary btn-sm" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a>
				<button onclick="del('.$atgplst["attr_group_id"].')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash-o"></i></button>
				</td>
			</tr>';
			}
			?>
             
            </tbody>
          </table>
        </div>
		
		<script>
		function del(id){
			var n=window.confirm("Are you sure want to Delete");
			if(n)
				$.get("actions/script.php?action=delattrgp&id="+id,  resattrgp);
		}
		function resattrgp(msg)
		{
			if(msg==1){
				alert("Deleted successfully");
				window.location.href = 'view_attribute_group.php';
			}
			else
				alert("Error...");
				window.location.href = 'view_attribute_group.php';
		}
		</script>
		
      </div>
	</div>
	  
</div>
	
<?php include "include/footer.php";?>
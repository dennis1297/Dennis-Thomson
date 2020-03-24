<?php
include "include/header.php";
include "include/menu.php";
?>

<div class="page animsition">
    <div class="page-header">
      <h1 class="page-title">Attributes</h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php">Home</a></li>
        <li><a href="javascript:void(0)">Attributes</a></li>
      </ol>
    </div>
	 
	<div class="page-content">
	  <div class="panel">
        <header class="panel-heading">
		  <div class="row">
			  <div class="col-md-6"><h3 class="panel-title">Attribute List</h3></div>
			  <div class="col-md-6">
			    <div class="pull-right pad1230">
					<a href="edit_attributes.php" class="btn btn-primary">Add Attribute</a>
				</div>
			  </div>
		  </div>
        </header>
        <div class="panel-body">
          <table class="table table-hover datatable table-striped width-full" id="datatable">
            <thead>
              <tr>
                <th>Attribute Name</th>
				<th>Attribute Group</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
			<?php
			$attrlist=mysqli_query($conn,"select attr_id,at.attr_group_id,attr_name,ag.attr_group_name from tbl_attributes at inner join tbl_attribute_group ag on at.attr_group_id=ag.attr_group_id");
			while($atlst=mysqli_fetch_assoc($attrlist)){
			echo '<tr>
				<td>'.$atlst["attr_name"].'</td>
				<td>'.$atlst["attr_group_name"].'</td>
				<td><a href="edit_attributes.php?attr='.$atlst["attr_id"].'" class="btn btn-primary btn-sm" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a>
				<button onclick="del('.$atlst["attr_id"].')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash-o"></i></button>
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
				$.get("actions/script.php?action=delattr&id="+id,  resattr);
		}
		function resattr(msg)
		{
			if(msg==1){
				alert("Deleted successfully");
				window.location.href = 'view_attributes.php';
			}
			else
				alert("Error...");
				window.location.href = 'view_attributes.php';
		}
		</script>
		
      </div>
	</div>
	  
</div>
	
<?php include "include/footer.php";?>
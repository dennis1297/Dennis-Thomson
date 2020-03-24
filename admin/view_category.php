<?php
include "include/header.php";
include "include/menu.php";
?>

<div class="page animsition">
    <div class="page-header">
      <h1 class="page-title">Categories</h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php">Home</a></li>
        <li><a href="javascript:void(0)">Categories</a></li>
      </ol>
    </div>
	 
	<div class="page-content">
	  <div class="panel">
        <header class="panel-heading">
		  <div class="row">
			  <div class="col-md-6"><h3 class="panel-title">Category List</h3></div>
			  <div class="col-md-6">
			    <div class="pull-right pad1230">
					<a href="<?php echo ADMINURL?>add-category" class="btn btn-primary">Add Category</a>
				</div>
			  </div>
		  </div>
        </header>
        <div class="panel-body">
          <table class="table table-hover table-bordered dataTable table-striped width-full" id="datatable">
            <thead>
              <tr>
                <!--th>SI No.</th-->
                <th>Name</th>
                <th>Position</th>
				<th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
			<?php $catlist=mysqli_query($conn,"select *from tbl_cat");
			$j=1;
			while($ctlst=mysqli_fetch_assoc($catlist)){
			echo '
			<tr>';
				
			
				if($ctlst["pid"]==0)
					echo '<td>'.$ctlst["cat_name"].'</td>';
				else
				{
					echo '<td>';
					$i=1;
					$cat_id=$ctlst["pid"];$cat_names='';
					while($i!=0)
					{						
						$res=mysqli_fetch_assoc(mysqli_query($conn, "select pid, cat_id, cat_name from tbl_cat where  cat_id='".$cat_id."'"));
						$cat_id=$res["pid"];
						
						$cat_names=" > ".$res["cat_name"].$cat_names;
						$i=$cat_id;
					}
					$cat_names=substr($cat_names,2);
					echo  $cat_names." > ".$ctlst["cat_name"].'</td>';
				}
			 
				echo '<td>'.$ctlst["cat_pos"].'</td>';
				if($ctlst["cat_status"]=='Y')
					echo '<td><span class="statusactive">Active</span></td>';
				else
					echo '<td><span class="statusinactive">Inactive</span</td>';
				
				echo '<td><a href="'.ADMINURL.'edit-category/'.$ctlst["cat_id"].'" class="btn btn-primary btn-sm" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a></td>
			</tr>	
			';
			$j++;
			}
			?>
             
            </tbody>
          </table>
        </div>
      </div>
	</div>
	  
</div>
	
<?php include "include/footer.php";?>
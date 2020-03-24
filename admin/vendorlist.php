<?php
include "include/header.php";
include "include/menu.php";
?>

<div class="page animsition">
    <div class="page-header">
      <h1 class="page-title">Vendors</h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php">Home</a></li>
        <li><a href="javascript:void(0)">Vendors</a></li>
      </ol>
      
    </div>
	 
	<div class="page-content">
	  <div class="panel">
        <header class="panel-heading">
          <div class="panel-actions"></div>
          <h3 class="panel-title"  style="float:left">Vendors List</h3>
          <h3 class="panel-title" style="float:right"><a href="vendor.php" class="btn btn-primary" style="color:#fff">Add Vendor</a></h3>
          <div class="clearfix"></div>
        </header>
        <div class="panel-body">
          <table class="table table-hover dataTable table-striped width-full" id="datatable">
            <thead>
              <tr>
              	<th>Code</th>
                <th>Name</th>
                <th>Email</th>                
				<th>Mobile</th>
				<th>Company Name</th>
                <th>City</th>
                <th>Status</th>
				<th>Action</th>
              </tr>
            </thead>
            <tbody>
			 <?php
             	$sel=mysqli_query($conn, "select *from tbl_vendors");
				while($res=mysqli_fetch_assoc($sel))
				{
					?>
                    <tr>
                        <td><?php echo $res["vendor_code"]; ?></td>
                        <td><?php echo $res["vendor_name"]; ?></td>
                        <td><?php echo $res["vendor_email"]; ?></td>
                        <td><?php echo $res["vendor_mobile"]; ?></td>
                        <td><?php echo $res["vendor_company_name"]; ?></td>
                        <td><?php echo $res["vendor_city"]; ?></td>
                        <td><?php 
							if($res["vendor_status"]=='Y')
								echo '<span class="statusactive">Active</span>';
							else
								echo '<span class="statusinactive">Inactive</span>';?></td>
                        <td>
                          
                        	<button type="button" onclick="vdetails(<?php echo $res["vendor_id"]?>)" class="btn btn-success btn-sm" data-toggle="tooltip" data-original-title="Vendor Details"><i class="icon wb-file" aria-hidden="true"></i></button>
                            <button type="button" onclick="edit(<?php echo $res["vendor_id"]?>)" class="btn btn-primary btn-sm" data-toggle="tooltip" data-original-title="Edit"><i class="icon wb-pencil" aria-hidden="true"></i></button>
                             
                            </td>
                      </tr>
					<?php
				}
			 ?>
             <script>
			 	function edit(id)
				{
					window.location.href="vendor.php?edit="+id;
				}
				function vdetails(id)
				{
					window.location.href="vdetails.php?vid="+id;
				}
			 </script>
              
              
            </tbody>
          </table>
        </div>
      </div>
	</div>
	  
</div>
	
<?php include "include/footer.php";?>
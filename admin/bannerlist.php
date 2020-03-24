<?php
include "include/header.php";
include "include/menu.php";
?>

<div class="page animsition">
    <div class="page-header">
      <h1 class="page-title">Banners</h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php">Home</a></li>
        <li><a href="javascript:void(0)">Banners</a></li>
      </ol>
      
    </div>
	 
	<div class="page-content">
	  <div class="panel">
        <header class="panel-heading">
          <div class="panel-actions"></div>
          <h3 class="panel-title"  style="float:left">Banner List</h3>
          <h3 class="panel-title" style="float:right"><a href="<?php echo ADMINURL?>add-banner" class="btn btn-primary" style="color:#fff">Add Banner</a></h3>
          <div class="clearfix"></div>
        </header>
        <div class="panel-body">
          <table class="table table-hover table-bordered dataTable table-striped width-full" id="datatable">
            <thead>
              <tr>
              	<th>SI No.</th>
                <th>Banner Title</th>
                <th>Banner Content</th>                
                <th>Status</th>                
				<th>Action</th>
              </tr>
            </thead>
            <tbody>
			 <?php
             	$sel=mysqli_query($conn, "select *from tbl_banner");
				$i=1;
				while($res=mysqli_fetch_assoc($sel))
				{
					?>
                    <tr>
                        <td><?php echo $i?></td>
                        <td><?php echo $res["ban_title"]?></td>
                        <td><?php echo $res["ban_content"]?></td> 
						<td><?php 
							if($res["ban_status"]=='Y')
								echo '<span class="statusactive">Active</span>';
							else
								echo '<span class="statusinactive">Inactive</span>';?></td> 
						<td>
						
						<a href="<?php echo ADMINURL."edit-banner/".$res["ban_id"]?>" class="btn btn-warning btn-sm"><i class="icon wb-pencil" aria-hidden="true"></i></a>
						<button  onclick="del(<?php echo $res["ban_id"]?>)"  type="button" class="btn btn-danger btn-sm"><i class="icon wb-close" aria-hidden="true"></i></button>
						</td>
                      </tr>
					<?php
					$i++;
				}
			 ?>
             <script>
				function del(id)
				{
					var c=window.confirm("Are you sure to delete");
					if(c)
						$.get("<?php echo ADMINURL?>actions/script.php?action=delete&imagecolumn=ban_image&table=tbl_banner&columnname=ban_id&id="+id , disp);					
				}
				function disp(msg)
				{
					if(msg=='1'){
						alert("Deleted successfully");
						window.location.reload();
					}
					else{
						alert("Error");
						window.location.reload();
					}
				}
			 </script>
            </tbody>
          </table>
        </div>
      </div>
	</div>
	  
</div>
	
<?php include "include/footer.php";?>
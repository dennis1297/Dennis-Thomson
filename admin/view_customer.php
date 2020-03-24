<?php
include "include/header.php";
include "include/menu.php";
?>

<div class="page animsition">
    <div class="page-header">
      <h1 class="page-title">Customer</h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php">Home</a></li>
        <li><a href="javascript:void(0)">Customer</a></li>
      </ol>
    </div>
	 
	<div class="page-content">
	  <div class="panel">
        <header class="panel-heading">
		  <div class="row">
			  <h3 class="panel-title">Customer List</h3>
		  </div>
        </header>
        <div class="panel-body">
          <table class="table table-hover datatable table-striped width-full" id="datatable">
            <thead>
              <tr>				
                <th>Customer name</th>
                <th>E-mail</th>
				        <th>Status</th>
                <th>Date added</th>
				        <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php $cuslist=mysqli_query($conn,"select *from tbl_customer");
            while($cuslst=mysqli_fetch_assoc($cuslist)){
              echo 
              '<tr>
                <td>'.$cuslst["firstname"].' '.$cuslst["lastname"].'</td>
                <td>'.$cuslst["email"].'</td>';
                if($cuslst["status"]=='1')
                  echo '<td><span class="statusactive">Active</span></td>';
                else
                  echo '<td><span class="statusinactive">Inactive</span</td>';
                
                echo '<td>'.dispdateonly($cuslst["date_added"]).'</td>
                <td><a href="'.ADMINURL.'edit_customer/'.$cuslst["customer_id"].'" class="btn btn-primary btn-sm" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a></td>
              </tr>	
              ';
            }
            ?>
            </tbody>
          </table>
        </div>
      </div>
	</div>
	  
</div>
	
<?php include "include/footer.php";?>
<?php
include "include/header.php";
include "include/menu.php";
?>

<div class="page animsition">
    <div class="page-header">
      <h1 class="page-title">Cancel List</h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php">Home</a></li>
        <li><a href="javascript:void(0)">CAncel List</a></li>
      </ol> 
    </div>
	 
	<div class="page-content">
	  <div class="panel">
        <header class="panel-heading">
          <div class="panel-actions"></div>
          <h3 class="panel-title"  style="float:left">Cancel List</h3>
          <h3 class="panel-title" style="float:right"> </h3>
          <div class="clearfix"></div>
        </header>
        <div class="panel-body">
          <table class="table table-hover dataTable table-striped width-full" id="orderdatatable">
			<tfoot>
			  <tr>
				<th>Cancel ID</th>
				<th>Product Name</th>
				<th>Customer</th>
				<th>Order ID</th>
				<th>Total</th>
				<th>Cancel Date</th>
				<th></th>
			  </tr>
			</tfoot>
			<thead>
              <tr>
              	<th>Cancel ID</th>
				<th>Product Name</th>
                <th>Customer</th>
                <th>Order ID</th>                
				<th>Total</th>
				<th>Cancel Date</th> 
				<th>Action</th>
              </tr>
            </thead>
            <tbody>
			 <?php
             	$sel=mysqli_query($conn, "select *from tbl_cancel order by cancel_id desc");
				while($res=mysqli_fetch_assoc($sel))
				{
					$sel2=mysqli_query($conn, "select *from tbl_product where prod_id='".$res["prod_id"]."'");
					$res2=mysqli_fetch_assoc($sel2);
					$sel4=mysqli_query($conn, "select *from tbl_order where ord_id='".$res["ord_id"]."'");
					$res4=mysqli_fetch_assoc($sel4);
					$date = date('Y/m/d H:i:s');
					?>
                    <tr>
                        <td><?php echo $res["cancel_id"]; ?></td>
                        <td><?php echo $res2["prod_name"]; ?></td>
						<td><?php echo $res4["user_fname"]; ?></td>
                        <td><?php echo $res4["ord_id"]; ?></td>
                        <td><?php echo $res4["sub_total"]; ?></td>
						<td><?php echo $date; ?></td>
                        <td>
                          
                        	<button type="button" onclick="order(<?php echo $res4["id"]?>)" class="btn btn-success btn-sm" data-toggle="tooltip" data-original-title="View Order"><i class="icon wb-eye" aria-hidden="true"></i></button>
                            
                             
                            </td>
                      </tr>
					<?php
				}
			 ?>
             <script>
			 	function editorderdet(id)
				{
					window.location.href="editorderdet.php?edit="+id;
				}
				function order(id)
				{
					window.location.href="order.php?id="+id;
				}
			 </script>
              
              
            </tbody>
          </table>
        </div>
      </div>
	</div>
	  
</div>
	
<?php include "include/footer.php";?>
<style>
tfoot {
    display: table-header-group;
}
tfoot tr th:last-child input {
       visibility: hidden;
}
</style>
<script>
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#orderdatatable tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" style="width:100%;" class="form-control" placeholder="Search '+title+'" />' );
    } );
 
    // DataTable
    var table = $('#orderdatatable').DataTable({"order": [[ 0, "desc" ]] });
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
} );
</script>
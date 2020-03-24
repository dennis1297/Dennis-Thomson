<?php
include "include/header.php";
include "include/menu.php";
?>

<div class="page animsition">
    <div class="page-header">
      <h1 class="page-title">Subscription</h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php">Home</a></li>
        <li><a href="javascript:void(0)">Subscription List</a></li>
      </ol> 
    </div>
	 
	<div class="page-content">
	  <div class="panel">
        <header class="panel-heading">
          <div class="panel-actions"></div>
          <h3 class="panel-title"  style="float:left">Subscription List</h3>
          <h3 class="panel-title" style="float:right"> </h3>
          <div class="clearfix"></div>
        </header>
        <div class="panel-body">
          <table class="table table-hover dataTable table-striped width-full" id="orderdatatable">
			 
			<thead>
              <tr>
              	<th>Email ID</th>
				<th>Ordered Date</th>  
              </tr>
            </thead>
            <tbody>
			 <?php
             	$sel=mysqli_query($conn, "select *from tbl_subscription");
				while($res=mysqli_fetch_assoc($sel))
				{
					?>
                    <tr>
                        <td><?php echo $res["email"]; ?></td>
                        <td><?php echo datechange($res["dates"])." ".$res["times"]; ?></td> 
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
					window.location.href="<?php echo ADMINURL ?>orders/"+id;
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
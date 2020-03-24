<?php
include "include/header.php";
include "include/menu.php";
?>

<div class="page animsition">
    <div class="page-header">
      <h1 class="page-title">Orders</h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php">Home</a></li>
        <li><a href="javascript:void(0)">Orders</a></li>
      </ol> 
    </div>
	 
	<div class="page-content">
	  <div class="panel">
        <header class="panel-heading">
          <div class="panel-actions"></div>
          <h3 class="panel-title"  style="float:left">Orders List</h3>
          <h3 class="panel-title" style="float:right"> </h3>
          <div class="clearfix"></div>
        </header>
        <div class="panel-body">
          <table class="table table-hover dataTable table-striped width-full" id="datatable">
			 
			      <thead>
              <tr>
              	<th>Order ID</th>
                <th>Customer</th>
                <th>Order Status</th>
                <th>Total</th>
                <th>Payment Status</th> 
                <th>Ordered Date</th> 
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php 
            $order = mysqli_query($conn,"select order_id,invoice_no,ods.name as ordstatus,tod.order_status_id,tod.customer_id,firstname,lastname,total,payment_status,tod.date_added from tbl_order tod inner join tbl_customer tc on tod.customer_id=tc.customer_id inner join tbl_order_status ods on tod.order_status_id=ods.order_status_id");
            while($list = mysqli_fetch_assoc($order)){
              echo '
              <tr>
                <td>'.$list["invoice_no"].'</td>
                <td>'.$list["firstname"]." ".$list["lastname"].'</td>
                <td>'.$list["ordstatus"].'</td>
                <td>'.$list["total"].'</td>';
                if($list["payment_status"]=='Credit'){
                  echo '<td><span class="statusactive">'.$list["payment_status"].'</span></td>';
                }
                else{
                  echo '<td><span class="statusinactive">'.$list["payment_status"].'</span></td>';
                }
            echo '<td>'.dispdateonly($list["date_added"]).'</td>
                <td>
                  <a href="'.ADMINURL.'orders/'.$list["order_id"].'" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                </td>
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
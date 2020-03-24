<?php
include "include/header.php";
include "include/menu.php";
?>

<div class="page animsition">
    <div class="page-header">
      <h1 class="page-title">Newsletter</h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php">Home</a></li>
        <li><a href="javascript:void(0)">Newsletter</a></li>
      </ol>
    </div>
	 
	<div class="page-content">
	  <div class="panel">
        <header class="panel-heading">
		  <div class="row">
			  <div class="col-md-6"><h3 class="panel-title">Newsletter List</h3></div>
			  <div class="col-md-6">
			    <div class="pull-right pad1230">
					<a href="add_newsletter.php" class="btn btn-primary">Add Newsletter</a>
				</div>
			  </div>
		  </div>
        </header>
        <div class="panel-body">
          <table class="table table-hover datatable table-striped width-full" id="datatable">
            <thead>
              <tr>
                <th>Newsletter</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
			<?php
			$newslist=mysqli_query($conn,"select *from tbl_newsletter");
			while($nslst=mysqli_fetch_assoc($newslist)){
			echo '<tr>
				<td>'.$nslst["nl_title"].'</td>
				<td><a href="add_newsletter.php?id='.$nslst["nl_id"].'" class="btn btn-primary btn-sm" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a>
				<button type="submit" class="btn btn-success btn-sm" id="sendnews'.$nslst["nl_id"].'" onclick="send('.$nslst["nl_id"].')" data-toggle="tooltip" data-original-title="Send"><i class="fa fa-send"></i></button>
				</td>
			</tr>	
			';
			}?>
             
            </tbody>
          </table>
        </div>
		
		<script>
		function send(id){
			$.ajax({
				url: "http://localhost/cartdemo/admin/news_lettersend.php",
				type: "POST", 
				dataType: 'json',
				data: {nsid:id},
				beforeSend: function() {
					$('#sendnews'+id).html('Loading...<i class="fa fa-circle-o-notch fa-spin fa-fw"></i>');
				},
				complete: function() {
					$('#delete-image').html('<i class="fa fa-send"></i>');
				},
				success: function(json){
					if(json=="success"){
						alert("Successfully sent");
						window.location.href="view_newsletter.php";
					}
					else{
						alert("Error sending");
						window.location.href="view_newsletter.php";
					}
				},
				error: function(xhr, ajaxOptions, thrownError){ 
					alert("Error...");
					window.location.href="view_newsletter.php";
				}
			}); 
		}
		</script>
		
      </div>
	</div>
	  
</div>
	
<?php include "include/footer.php";?>
<?php 
include("config.php"); 
include("functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Viveka Essence Mart | Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php include "css.php";?> 
</head>
<body>

<?php include "header.php";?>

<div class="wrapper">

  <?php include "category-carousel.php";?>    
  
  <!-- contact us starts --->
  <div class="contact-us">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d971.551977593782!2d80.27523342919397!3d13.086005899423796!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a5265ff6e4d51d9%3A0xa0dd65e0203197b4!2s285%2F128%2C%20Wall%20Tax%20Rd%2C%20Edapalaiyam%2C%20George%20Town%2C%20Chennai%2C%20Tamil%20Nadu%20600003!5e0!3m2!1sen!2sin!4v1584972583141!5m2!1sen!2sin" width="1135" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe></div>
        <div class="col-md-6">
          <h3 class="page-subheading">Contact info</h3>
          <ul class="store_info">
            <li><i class="fa fa-home"></i>285/128, walltax road,Parktown Chennai, India 600003.</li>
            <li><i class="fa fa-phone"></i><span>044-25350771, 044-25354240, 044-42153572, 919566243091, 919789801374</span></li>
            <li><i class="fa fa-envelope"></i><span>vivekaess@gmail.com, vivekaessencemart@yahoo.co.in</span></li>                
          </ul>
        </div>
        <div class="col-md-6">
          <h3 class="page-subheading">Make an enquiry</h3>
          <form method="post" id="contactform" enctype='multipart/form-data'>
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" id="cusname" name="cusname">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="text" class="form-control" id="cusemail" name="cusemail">
            </div>
            <div class="form-group">
              <label>Phone</label>
              <input type="tel" class="form-control" id="cusphone" name="cusphone" onKeyPress="return enterNumerics(event);">
            </div>
            <div class="form-group">
              <label>Message</label>
              <textarea rows="5" class="form-control" id="cusmsg" name="cusmsg"></textarea>
            </div>
            <div id="contact_res"></div>
            <button type="submit" class="btn btn-viewall">Send Message</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- contact us ends --->

  <?php include "brands.php";?>

  <?php include "footer.php";?>
  
</div>

<?php include "js.php";?>
<script>
$(document).ready(function(){
  //form submit
  $("#contactform").on('submit',function(e){
    e.preventDefault();
    err=0;

    var cusname=$("#cusname").val();
    var cusemail=$("#cusemail").val();
    var cusphone=$("#cusphone").val();
    var cusmsg=$("#cusmsg").val();

    $("#contact_res").show();

		if(cusname=='' || cusemail=='' || cusphone=='' || cusmsg==''){
      err=1;
      $("#contact_res").html("<span class='err'>Fill all fields</span>");
    }
    else if(!isValidEmailAddress(cusemail)){
      err=1;
      $("#contact_res").html("<span class='err'>Enter valid email</span>");
    }
    else{
      err=0;
    }

    if(err==0){
      $.ajax({
        url: "mail.php",
        type: "POST",
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        beforeSend: function() {
          $("#contact_res").show();
          $("#contact_res").html("<span class='process'><i class='fa fa-spinner fa-pulse fa-fw'></i>&nbsp;&nbsp;Please wait...</span>");
        },
        success: function(response) {
            console.log(response);
          if(response==1){
            $("#contact_res").show();
            $("#contact_res").html("<span class='succ'>Enquiry submitted</span>");
          }
          else{
            $("#contact_res").show();
            $("#contact_res").html("<span class='err'>Error try again...</span>");
          }			
        },
        error: function(e) {
          $("#contact_res").show();
          $("#contact_res").html("<span class='err'>Error...</span>");
        },
        complete: function() {
          $('#contactform')[0].reset();
          $("#contact_res").fadeOut(3000);
        } 
      });
    }
  });
});
</script>


</body>
</html>
<?php include "include/db.php"; 
if($_SESSION["login_id"]!=''){
	echo '<script>window.location.href="'.ADMINURL.'dashboard";</script>';
}
?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo NAME?> - Login </title>

  <link rel="shortcut icon" href="<?php echo SITEURL?>images/favicon.jpg">

  <!-- Stylesheets -->
  <link rel="stylesheet" href="<?php echo ADMINURL?>global/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo ADMINURL?>global/css/bootstrap-extend.min.css">
  <link rel="stylesheet" href="<?php echo ADMINURL?>assets/css/site.min.css">



  <!-- Plugins -->
  <link rel="stylesheet" href="<?php echo ADMINURL?>global/vendor/animsition/animsition.min.css">
  <link rel="stylesheet" href="<?php echo ADMINURL?>global/vendor/asscrollable/asScrollable.min.css">
  <link rel="stylesheet" href="<?php echo ADMINURL?>global/vendor/switchery/switchery.min.css">
  <link rel="stylesheet" href="<?php echo ADMINURL?>global/vendor/intro-js/introjs.min.css">
  <link rel="stylesheet" href="<?php echo ADMINURL?>global/vendor/slidepanel/slidePanel.min.css">
  <link rel="stylesheet" href="<?php echo ADMINURL?>global/vendor/flag-icon-css/flag-icon.min.css">

  <!-- Page -->
  <link rel="stylesheet" href="<?php echo ADMINURL?>global/css/login-v3.min.css">

  <!-- Fonts -->
  <link rel="stylesheet" href="<?php echo ADMINURL?>global/fonts/web-icons/web-icons.min.css">
  <link rel="stylesheet" href="<?php echo ADMINURL?>global/fonts/brand-icons/brand-icons.min.css">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>


  <!--[if lt IE 9]>
    <script src="<?php echo ADMINURL?>global/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->

  <!--[if lt IE 10]>
    <script src="<?php echo ADMINURL?>global/vendor/media-match/media.match.min.js"></script>
    <script src="<?php echo ADMINURL?>global/vendor/respond/respond.min.js"></script>
    <![endif]-->

  <!-- Scripts -->
  <script src="<?php echo ADMINURL?>global/vendor/modernizr/modernizr.min.js"></script>
  <script src="<?php echo ADMINURL?>global/vendor/breakpoints/breakpoints.min.js"></script>
  <script>
    Breakpoints();
  </script>
  
  <script src="<?php echo ADMINURL?>global/vendor/jquery/jquery.min.js"></script>
</head>
<body class="page-login-v3 layout-full">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->


  <!-- Page -->
  <div class="page animsition vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">
    <div class="page-content vertical-align-middle">
      <div class="panel">
        <div class="panel-body">
          <div class="brand">
            <img class="brand-img" src="<?php echo SITEURL?>img/adminlogo.png" alt="<?php echo NAME?>">
          </div>
          <form id="loginform" autocomplete="off">
			<div id="result"></div>
            <div class="form-group form-material floating">
              <input type="text" class="form-control" id="username" />
              <label class="floating-label">Username</label>
            </div>
            <div class="form-group form-material floating">
              <input type="password" class="form-control" id="password" />
              <label class="floating-label">Password</label>
            </div>
       
            <button type="button" onclick="login()" id="loginbtn" class="btn btn-primary btn-block btn-lg margin-top-40">Log in</button>
          </form>
        </div>
      </div>
	  
		<script>
		function login()
		{
			var uname=$("#username").val();
			var password=$("#password").val();
			$("#loginbtn").html("Loading...");
			
			$.get("<?php echo ADMINURL?>actions/script.php?action=login&username="+uname+"&password="+password , loginresult);					
		}
		function loginresult(msg)
		{
			if(msg==1)
			{
				$("#result").html("<div class='alert alert-success alert-dismissible' role='alert'>Login Success.</div>");
				window.location.href="<?php echo ADMINURL?>dashboard";
			}
			else
			{	
				$("#result").html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span><span class='sr-only'>Close</span></button>Username or Password wrong.</div>");
				$("#loginform")[0].reset();
				$("#loginbtn").html("Log in");
			}
		}
		</script>

   
    </div>
  </div>
  <!-- End Page -->


  <!-- Core  -->
  <script src="<?php echo ADMINURL?>global/vendor/bootstrap/bootstrap.min.js"></script>
  <script src="<?php echo ADMINURL?>global/vendor/animsition/animsition.min.js"></script>
  <script src="<?php echo ADMINURL?>global/vendor/asscroll/jquery-asScroll.min.js"></script>
  <script src="<?php echo ADMINURL?>global/vendor/mousewheel/jquery.mousewheel.min.js"></script>
  <script src="<?php echo ADMINURL?>global/vendor/asscrollable/jquery.asScrollable.all.min.js"></script>
  <script src="<?php echo ADMINURL?>global/vendor/ashoverscroll/jquery-asHoverScroll.min.js"></script>

  <!-- Plugins -->
  <script src="<?php echo ADMINURL?>global/vendor/switchery/switchery.min.js"></script>
  <script src="<?php echo ADMINURL?>global/vendor/intro-js/intro.min.js"></script>
  <script src="<?php echo ADMINURL?>global/vendor/screenfull/screenfull.min.js"></script>
  <script src="<?php echo ADMINURL?>global/vendor/slidepanel/jquery-slidePanel.min.js"></script>

  <!-- Plugins For This Page -->
  <script src="<?php echo ADMINURL?>global/vendor/jquery-placeholder/jquery.placeholder.min.js"></script>

  <!-- Scripts -->
  <script src="<?php echo ADMINURL?>global/js/core.min.js"></script>
  <script src="<?php echo ADMINURL?>assets/js/site.min.js"></script>

  <script src="<?php echo ADMINURL?>assets/js/sections/menu.min.js"></script>
  <script src="<?php echo ADMINURL?>assets/js/sections/menubar.min.js"></script>
  <script src="<?php echo ADMINURL?>assets/js/sections/gridmenu.min.js"></script>
  <script src="<?php echo ADMINURL?>assets/js/sections/sidebar.min.js"></script>

  <script src="<?php echo ADMINURL?>global/js/configs/config-colors.min.js"></script>
  <script src="<?php echo ADMINURL?>assets/js/configs/config-tour.min.js"></script>

  <script src="<?php echo ADMINURL?>global/js/components/asscrollable.min.js"></script>
  <script src="<?php echo ADMINURL?>global/js/components/animsition.min.js"></script>
  <script src="<?php echo ADMINURL?>global/js/components/slidepanel.min.js"></script>
  <script src="<?php echo ADMINURL?>global/js/components/switchery.min.js"></script>

  <script src="<?php echo ADMINURL?>global/js/components/jquery-placeholder.min.js"></script>
  <script src="<?php echo ADMINURL?>global/js/components/material.min.js"></script>


  <script>
    (function(document, window, $) {
      'use strict';

      var Site = window.Site;
      $(document).ready(function() {
        Site.run();
      });
    })(document, window, jQuery);
  </script>

</body>


</html>
<?php
include "include/db.php";
$log=isset($_GET["log"]);
if($log=="out")
{
	session_destroy();
	echo '<script>window.location.href="'.ADMINURL.'";</script>';
}
if($_SESSION["login_id"]=='')
{
	echo '<script>window.location.href="'.ADMINURL.'";</script>';
}
function datechange($date)
{
	$date=explode("-", $date);
	return ($date[2]."-".$date[1]."-".$date[0]);
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

  <title id="titletag"><?php echo NAME?> - Dashboard</title>

  <link rel="shortcut icon" href="<?php echo SITEURL?>images/favicon.jpg">

  <!-- Stylesheets -->
  <link rel="stylesheet" href="<?php echo ADMINURL?>global/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo ADMINURL?>global/css/bootstrap-extend.min.css">
  <link rel="stylesheet" href="<?php echo ADMINURL?>assets/css/site.min.css">

 
  <link rel="stylesheet" href="https://uxsolutions.github.io/bootstrap-datepicker/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
  <!-- Plugins -->
  <link rel="stylesheet" href="<?php echo ADMINURL?>global/vendor/animsition/animsition.min.css">
  <link rel="stylesheet" href="<?php echo ADMINURL?>global/vendor/asscrollable/asScrollable.min.css">
  <link rel="stylesheet" href="<?php echo ADMINURL?>global/vendor/switchery/switchery.min.css">
  <link rel="stylesheet" href="<?php echo ADMINURL?>global/vendor/intro-js/introjs.min.css">
  <link rel="stylesheet" href="<?php echo ADMINURL?>global/vendor/slidepanel/slidePanel.min.css">
  <link rel="stylesheet" href="<?php echo ADMINURL?>global/vendor/flag-icon-css/flag-icon.min.css">

  <!-- Plugins For This Page -->
  <!--link rel="stylesheet" href="<?php echo ADMINURL?>global/vendor/chartist-js/chartist.min.css"-->
  <link rel="stylesheet" href="<?php echo ADMINURL?>global/vendor/jvectormap/jquery-jvectormap.min.css">
  <!--link rel="stylesheet" href="<?php echo ADMINURL?>global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.min.css"-->
  
   <!-- form validation -->
  <link rel="stylesheet" href="<?php echo ADMINURL?>global/vendor/formvalidation/formValidation.min.css">
  <!-- form validation - -->
  <link rel="stylesheet" href="<?php echo ADMINURL?>assets/examples/css/forms/validation.min.css">

  <!-- Page -->
  <!--link rel="stylesheet" href="assets/examples/css/dashboard/v1.min.css"-->
  <link rel="stylesheet" href="<?php echo ADMINURL?>global/vendor/dropify/dropify.min.css">
  
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo ADMINURL?>global/vendor/summernote/summernote.css">
  
  <!--select2-->
  <link rel="stylesheet" href="<?php echo ADMINURL?>global/vendor/select2/select2.min.css">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <!-- datatable -->
  <link rel="stylesheet" href="<?php echo ADMINURL?>global/vendor/datatables/dataTables.bootstrap.min.css">

  <!-- Fonts -->
  <link rel="stylesheet" href="<?php echo ADMINURL?>global/fonts/web-icons/web-icons.min.css">
  <link rel="stylesheet" href="<?php echo ADMINURL?>global/fonts/brand-icons/brand-icons.min.css">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

  <link rel="stylesheet" href="<?php echo ADMINURL?>global/fonts/weather-icons/weather-icons.min.css">
  <link rel="stylesheet" href="<?php echo ADMINURL?>global/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css">
  <link rel="stylesheet" href="<?php echo ADMINURL?>global/vendor/bootstrap-datepicker/bootstrap-datepicker3.css">
  <link rel="stylesheet" href="<?php echo ADMINURL?>custom.css">

  <!--[if lt IE 9]>
    <script src="<?php echo ADMINURL?>global/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->

  <!--[if lt IE 10]>
    <script src="<?php echo ADMINURL?>global/vendor/media-match/media.match.min.js"></script>
    <script src="<?php echo ADMINURL?>global/vendor/respond/respond.min.js"></script>
    <![endif]-->
  <script src="<?php echo ADMINURL?>global/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo ADMINURL?>global/vendor/bootstrap/bootstrap.min.js"></script>
  <!-- Scripts -->
  <script src="<?php echo ADMINURL?>global/vendor/modernizr/modernizr.min.js"></script>
  <script src="<?php echo ADMINURL?>global/vendor/breakpoints/breakpoints.min.js"></script>
  
   <script src="<?php echo ADMINURL?>global/vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script>
    Breakpoints();
  </script>
</head>
<body class="">


  

  <nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">

    <div class="navbar-header">
      <button type="button" class="navbar-toggle hamburger hamburger-close navbar-toggle-left hided"
      data-toggle="menubar">
        <span class="sr-only">Toggle navigation</span>
        <span class="hamburger-bar"></span>
      </button>
      <button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-collapse"
      data-toggle="collapse">
        <i class="icon wb-more-horizontal" aria-hidden="true"></i>
      </button>
      <div class="navbar-brand navbar-brand-center site-gridmenu-toggle">
        <img class="navbar-brand-logo" src="<?php echo SITEURL?>img/logo.png" style="height:66px;margin-top:-22px;" title="">
      </div>
    
    </div>

    <div class="navbar-container container-fluid">
      <!-- Navbar Collapse -->
      <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
        <!-- Navbar Toolbar -->
        <ul class="nav navbar-toolbar">
          <li class="hidden-float" id="toggleMenubar">
            <a data-toggle="menubar" href="#" role="button">
              <i class="icon hamburger hamburger-arrow-left">
                  <span class="sr-only">Toggle menubar</span>
                  <span class="hamburger-bar"></span>
                </i>
            </a>
          </li>
        </ul>
        <!-- End Navbar Toolbar -->

        <!-- Navbar Toolbar Right -->
        <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
		  <li><a>Welcome <?php echo $_SESSION["login_name"];?></a></li>	
          <li class="dropdown">
            <a class="navbar-avatar dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false"
            data-animation="scale-up" role="button">
              <span class="avatar avatar-online">
                <img src="<?php echo ADMINURL?>img/user.png">
                <i></i>
              </span>
            </a>
            <ul class="dropdown-menu" role="menu">
			<?php if($_SESSION["login_type"]=="vendor"){?>
              <li role="presentation">
                <a href="vendor.php?edit=<?php echo $_SESSION["login_id"];?>" role="menuitem"><i class="icon wb-user" aria-hidden="true"></i> Profile</a>
              </li>
			<?php }?> 
              <li role="presentation">
                <a href="javascript:void(0)" role="menuitem"><i class="icon wb-payment" aria-hidden="true"></i> Change Password</a>
              </li>
            </ul>
          </li>      
          <li>
            <a href="?log=out" data-placement="bottom" data-toggle="tooltip" data-original-title="Logout">
				<span class="icon wb-power" aria-hidden="true"></span>
			</a>
          </li>
        </ul>
        <!-- End Navbar Toolbar Right -->
      </div>
      <!-- End Navbar Collapse -->


    </div>
  </nav>
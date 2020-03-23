<?php 
$cartcount = mysqli_num_rows(mysqli_query($conn,"select sessionid from tbl_cart where customer_id='".$_COOKIE["cus_id"]."'"));
$cookie_value = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
setcookie("page", $cookie_value, time()+ 3600 * 24 * 1, "/");

if($_COOKIE['fb_access_token']!=''){
  $fblogoutUrl = 'https://www.facebook.com/logout.php?next='.URL.'logout.php&access_token=' . $_COOKIE['fb_access_token'];  
}
else{
  $fblogoutUrl = URL."logout";
}

$googlelogoutUrl = 'https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue='.URL.'logout.php';
/*** logout url ****/
switch($_COOKIE["reg_type"]) {
  case "facebook":
    $logouturl = '<a href="'.$fblogoutUrl.'">Logout</a>';
    break;
  case "google":
    $logouturl = '<a href="'.$googlelogoutUrl.'">Logout</a>';
    break;
  default:
    $logouturl = '<a href="'.URL.'logout">Logout</a>';
}
/*** logout url ****/

//echo $_SESSION["sessionid"];
?>

<!-- header -->
<div class="header">
  <!--- topbar ---->
  <div class="topbar">
    <div class="container">
      <div class="row">
        <div class="col-md-6 hidden-xs">
          <p class="contact-info"><span><i class="fas fa-phone" style="transform: rotate(100deg);"></i>+91 9789801374<span><span><i class="fas fa-clock"></i>10.00 AM - 8.00 PM</span></p>
        </div>
        <div class="col-md-6">
          <?php if(isset($_COOKIE["cus_id"])){?>
            <ul class="list-inline my-accountsul">
              <li class="dropdown"><a href="#" title="My Account" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-user"></i> <span><?php echo $_COOKIE["fname"]." ".$_COOKIE["lname"]?></span> <span class="caret"></span></a>
                  <ul class="dropdown-menu dropdown-menu-left">
                      <li><a href="<?php echo URL?>account/edit">My Account</a></li>
                      <li><a href="<?php echo URL?>account/password">Change Password</a></li>
                      <li><a href="<?php echo URL?>account/orders">Order History</a></li>
                      <li><?php echo $logouturl?></li>
                  </ul>
              </li>
            </ul>
          <?php } else {?>
            <ul class="list-inline my-accountsul">
              <li><a class="cursrpointr" onclick="opensidenavmenu()"><i class="fa fa-user"></i> Login/Sign Up</a></li>
            </ul>            
          <?php } ?>

            <?php
            if(isset($_COOKIE["cus_id"])){
              if($filename=='cart.php' || $filename=='checkout.php'){
                $cartfn = 'redirecturl()';
              }
              else{
                $cartfn = 'opencartmenu()';
              }              
            }
            else{
              $cartfn = 'opensidenavmenu()';
            }
            ?>

           <a class="mb-cart" onclick="<?php echo $cartfn?>" href="javascript:void(0)">
                <span class="cart">
                  <i class="fas fa-shopping-bag" style="font-size:20px;"></i>
                  <p class="basket_count"><span class="count"><?php echo $cartcount?></span></p>
                </span>      
              </a>

        </div>        
      </div>
    </div>
  </div>
  <!--- topbar ---->  
  <!--- menu --->
	<nav class="navbar navbar-inverse">
	  <div class="container">
	    <div class="navbar-header-outer">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                        
          </button>
          <a class="navbar-brand" href="<?php echo URL?>"><img src="<?php echo URL?>img/logo2.png" class="img-responsive"></a>
        </div>        
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav navbar-right">
            <li>
              <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Category, Product" class="form-control" id="searchinput">
                <ul class="search-list" id="searchlist"></ul>            
              </div>
            </li>
            <li><a href="<?php echo URL?>">Home</a></li>
            <li><a href="<?php echo URL?>about_us">About Us</a></li>
            <li><a href="<?php echo URL?>#">Our Services</a></li>
            <li><a href="<?php echo URL?>contact_us">Contact Us</a></li>    
            
            <?php
            if(isset($_COOKIE["cus_id"])){
              if($filename=='cart.php' || $filename=='checkout.php'){
                $cartfn = 'redirecturl()';
              }
              else{
                $cartfn = 'opencartmenu()';
              }              
            }
            else{
              $cartfn = 'opensidenavmenu()';
            }
            ?>
            <li>
              <a class="mb-cart1" onclick="<?php echo $cartfn?>" href="javascript:void(0)">
                <span class="cart">
                  <i class="fas fa-shopping-bag" style="font-size:20px;"></i>
                  <p class="basket_count"><span class="count"><?php echo $cartcount?></span></p>
                </span>      
              </a>
            </li>	

          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!--- menu --->  
</div>
<!-- header -->

<!-- sidemenu --->
<div id="overlaybg" class="overlaybg" onclick="closesidenavmenu()"></div>
<div id="sidenavmenu" class="sidenavmenu">
  <div class="side-outer">
    <div class="sidemenu-logo">
      <div class="col-close"><button type="button" class="btn btn-dafault menu-closebtn" onclick="closesidenavmenu()"><i class="fa fa-times"></i></button></div>
      <div class="col-logo"><img src="<?php echo URL?>logo.jpg" class="img-responsive logo_dark"></div>      
    </div>
    <ul class="nav nav-pills sidemenu-navpills">
      <li class="active"><a data-toggle="pill" href="#login">Login</a></li>
      <li><a data-toggle="pill" href="#register">Register</a></li>
    </ul>
    <div class="tab-content">
      <div id="login" class="tab-pane fade in active">
        <form id="custloginform" method="post" autocomplete="off">
          <div class="form-group">
            <input type="text" class="form-control" name="loginemail" placeholder="Email">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="loginpasswd" placeholder="Password">
          </div>
          <div id="login_restxt" class="resultdiv"></div>
          <button type="submit" class="btn btn-viewall btn-block">Submit</button>
        </form>
        <div class="social-login">          
          <div id="gSignInWrapper" class="btn btn-block btn-gl">
            <div id="customgoogleBtn" class="customGPlusSignIn"><i class="fab fa-google-plus-g"></i>Login with google</div>
          </div>
          <script>startApp();</script>
          <button type="button" onclick="window.location = '<?php echo $loginUrl?>'" class="btn btn-block btn-fb"><i class="fab fa-facebook-square"></i>Login with facebook</button>
        </div>
      </div>
      <div id="register" class="tab-pane fade">
        <form id="registerform" method="post" autocomplete="off" >
          <div class="form-group">
            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="email" id="email" placeholder="Email">
          </div>
          <div class="form-group">
            <input type="tel" class="form-control" name="mobileno" id="mobileno" placeholder="Mobile" onKeyPress="return enterNumerics(event);" maxlength="10">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="repassword" id="repassword" placeholder="Re-type Password">
          </div>
          <div id="reg_restxt" class="resultdiv"></div>
          <button type="submit" class="btn btn-viewall btn-block">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- sidemenu --->

<!--- cart menu --->
<div id="cartoverlaybg" class="cartoverlaybg" onclick="closesidecartmenu()"></div>
<div id="sidecartmenu" class="sidecartmenu">
  <div class="side-outer">            
    <?php
    $total = 0;
    $getcrt = mysqli_query($conn,"select cartid,customer_id,sessionid,product_id,pro_option,pro_option_desc,pro_qty,pro_unitprice,pro_totprice,prod_name,prod_slug,prod_image from tbl_cart tc inner join tbl_product tp on tc.product_id=tp.prod_id inner join tbl_product_images tpi on tc.product_id=tpi.prod_id where customer_id='".$_COOKIE["cus_id"]."'");
    while($rescrt = mysqli_fetch_assoc($getcrt)) { 
    ?>
    <div class="cartproduct">
      <div class="primg">
        <a href="<?php echo URL.$rescrt["prod_slug"]?>" class="prinnrimg"><img src="<?php echo URL.substr($rescrt["prod_image"],3)?>" class="img-responsive"></a>        
      </div>
      <div class="prdets">
        <a href="<?php echo URL.$rescrt["prod_slug"]?>"><?php echo $rescrt["prod_name"]?></a>
        <div id="carpdops<?php echo $rescrt["cartid"]?>">
        <?php 
        $propt = json_decode($rescrt["pro_option_desc"]);
        foreach($propt as $key=>$value){
          echo "<span class='proops'>- ".$key." : ".$value."</span>";
        }
        $total = $total+$rescrt["pro_totprice"];
        ?>
        </div>
      </div>
      <div class="prqty">x <?php echo $rescrt["pro_qty"]?></div>
      <div class="prcrprice">Rs. <?php echo $rescrt["pro_totprice"]?></div>
      <div class="prremov<?php echo $rescrt['cartid']?>"><button onclick="removecart(<?php echo $rescrt['cartid']?>)" class="btn btn-danger btn-xs"><i class="fas fa-times"></i></button></div>
    </div>
    <?php } ?>
    <div class="total">
        <div>Total</div>
        <div>Rs. <?php echo $total?></div>
    </div>
  </div>
  <div class="cart-links">
    <div>
      <a href="<?php echo URL?>cart" class="btn btn-viewall">Cart</a>
    </div>
    <div>
      <!--a href="<?php echo URL?>checkout" class="btn btn-viewall">Checkout</a-->
    </div>
  </div>
</div>
<!--- cart menu --->

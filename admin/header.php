 <style> 
 .cutline
 {	 
    width: 100%;
    height:20px;
    overflow:hidden;    
    word-wrap: break-word
 }
 </style>
 

  <!-- Header section -->
  <header class="header header--sticky">
    <div class="header-line hidden-xs">
      <div class="container">
        <div class="pull-left">
          <div class="social-links social-links--colorize">
            <ul>
              <li class="social-links__item"><a class="icon icon-facebook" href="#"></a></li>
              <li class="social-links__item"><a class="icon icon-twitter" href="#"></a></li>
              <li class="social-links__item"><a class="icon icon-google" href="#"></a></li>
              <li class="social-links__item"><a class="icon icon-pinterest" href="#"></a></li>
              <li class="social-links__item"><a class="icon icon-mail" href="#"></a></li>
            </ul>
          </div>
        </div>
        <div class="pull-right">
          <div class="user-links">
            <ul>
			<?php
                        	if($_SESSION["ses_log_id"]!='')
							{
								
                              echo'<li class="user-links__item"><a href="'.URL.'/login/1">Log Out</a></li>';
                                 
								
							}
							else
							{
								 echo'<li class="user-links__item"><a href="'.URL.'/checkout/1">Log In/Register</a></li>';
							}
						?>
			
			
            </ul>
          </div>
        </div>
      </div>
    </div>
		   
    <nav class="navbar navbar-wd" id="navbar">
      <div class="container">
	 
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" id="slide-nav"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button> 
          <!--  Logo  --> 
          <a class="logo" href="index.php"> <img src="<?php echo URL ;?>images/saravana/logo.jpg" style="height:60px;width:100px"><img class="logo-transparent" src="<?php echo URL ;?>images/saravana/logo.jpg" alt=""/> </a> 
          <!-- End Logo --> 
        </div>
        <div class="pull-left search-focus-fade" id="slidemenu" style="width:88%;padding:0px">
          <div class="slidemenu-close visible-xs">✕</div>
          <ul class="nav navbar-nav" style="width:100%">     
            </li>
			<?php
			 
			 $prod=mysqli_query($conn,"select *from tbl_cat where pid='0' ");
			 
			while($resprod=mysqli_fetch_assoc($prod))
			{
				
				$sql=mysqli_query($conn, "select *from tbl_cat where pid='".$resprod["cat_id"]."'");
				$n=mysqli_num_rows($sql);
				if($n<=3)
				{	
					echo'<li> <a href="'.URL.'/category/'.$resprod["cat_id"].'" ><span class="link-name">'.$resprod["cat_name"].'</span><span class="caret caret--dots"></span></a>';
					echo ' <ul class="dropdown-menu animated fadeIn" role="menu">';
							while($res=mysqli_fetch_assoc($sql))
							{
								echo '<li class="title"><a href="'.URL.'/productlist/'.$res["cat_id"].'">'.$res["cat_name"].'</a></li>';
							}
							echo '</ul></li>';
				}
				else
				{
					echo '<li class="menu-large"><a href="'.URL.'/category/'.$resprod["cat_id"].'" class="dropdown-toggle"><span class="link-name">'.$resprod["cat_name"].'</span><span class="caret caret--dots"></span></a>
              <div class="dropdown-menu megamenu animated fadeIn">
                <div class="container">
                  <ul class="megamenu__columns" style="padding-right: 0px !important;">';
				    
                    while($res=mysqli_fetch_assoc($sql))
					{
						
						echo '<li class="level-menu level1" style="width: 23.5%;">
							  <ul>
							  
								<li class="title cutline"><a href="'.URL.'/category/'.$res["cat_id"].'">'.$res["cat_name"].'</a></li>';

								$sel1=mysqli_query($conn, "select *from tbl_cat where pid='".$res["cat_id"]."' limit 5");
								while($res1=mysqli_fetch_assoc($sel1))									
								{
									echo '<li class="level2 cutline"><a  href="'.URL.'/productlist/'.$res1["cat_id"].'">'.$res1["cat_name"].'</a></li>';
								}
									
								
								
								
								
							  echo '</ul>
							</li>';
					}
                    
                    
                  echo '</ul>
                </div>
              </div>
            </li>';
				}
				 
			}
			?>
           
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <!-- End Header section -->
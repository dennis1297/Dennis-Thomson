<?php 

include("config.php"); 

include("functions.php"); 



session_start();



if(!(isset($_SESSION['sessionid'])))

{

  $string=stringgenerator(20);

  $_SESSION['sessionid']=$string;

}

/*$filename=basename($_SERVER['PHP_SELF']);

echo $filename;*/

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

  <!-- slider starts -->

  <div class="main-slider">

    <div class="owl-carousel owl-theme main-carousel">

      <div class="owl-slide" style="background-image: url('<?php echo URL?>images/slider/dennis.jpg');"></div>

      <!--div class="owl-slide" style="background-image: url('<?php echo URL?>images/slider/slider-img2.jpg');"></div>

      <div class="owl-slide" style="background-image: url('<?php echo URL?>images/slider/slider-img3.jpg');"></div>

      <div class="owl-slide" style="background-image: url('<?php echo URL?>images/slider/slider-img4.jpg');"></div>

      <div class="owl-slide" style="background-image: url('<?php echo URL?>images/slider/slider-img5.jpg');"></div>

      <div class="owl-slide" style="background-image: url('<?php echo URL?>images/slider/slider-img6.jpg');"></div-->

    </div>

  </div>

  <!-- slider ends -->



  <!-- info bar starts -->

  <div class="info-bar">

    <div class="container">

      <div class="row">

        <div class="col-md-12">

          <div class="info-bar-outer">

            <div class="info-bar-inner">

              <img src="img/healthy.svg" class="img-responsive">

              <span>Hygienic & Healthy</span>

            </div>            

            <div class="info-bar-inner">

              <img src="img/no-chemical.svg" class="img-responsive">

              <span>No Chemicals or Preservatives</span>

            </div>

            <div class="info-bar-inner">

              <img src="img/halal-sign.svg" class="img-responsive">

              <span>100% Halal</span>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>

  <!-- info bar ends -->



  <!-- category slider starts  --->

  <div class="category-bar">

    <div class="category-slider">

      <div class="container">

        <div class="row">

          <div class="col-md-12">

            <div class="owl-carousel category-carousel">

              <?php

              $selc=mysqli_query($conn, "select *from tbl_cat where cat_status='Y' order by cat_pos desc");

              while($resc=mysqli_fetch_array($selc))

              {

                $active = $resc['cat_id']==1 ? 'active' : '';

                echo '

                <div onclick="showcatdiv('.$resc['cat_id'].')" class="slider-content '.$active.'"><img src="'.URL.substr($resc['cat_img'],3).'" class="img-responsive"><span>'.$resc['cat_name'].'</span></div>

                ';

              }

              ?>

            </div>

          </div>

        </div>

      </div>

    </div>

    <div class="category-content">

      <div class="container">

        <div class="row">

          <div class="col-md-12">

            <?php 

            $selc=mysqli_query($conn, "select *from tbl_cat where cat_status='Y' order by cat_id desc");

            while($resc=mysqli_fetch_array($selc))

            {

              $block = $resc['cat_id']==1 ? 'block' : 'none';

            ?>

            <div id="catshowdiv_<?php echo $resc['cat_id']?>" class="carouseldiv" style="display:<?php echo $block?>">

              <div class="owl-carousel categorycontent-carousel">

                <?php 

                $selcad = mysqli_query ($conn,"select pr.prod_id,prod_name,prod_slug,sort_order,status,cat_id,prod_image,img_default from tbl_product as pr inner join tbl_product_images as prig on pr.prod_id=prig.prod_id inner join tbl_product_category as prct on pr.prod_id=prct.prod_id where cat_id=".$resc['cat_id']." and pr.status='Y' and prig.img_default='Y' ORDER BY sort_order DESC limit 6");

                if(mysqli_num_rows($selcad)>0){

                  while($rscad=mysqli_fetch_assoc($selcad)){

                    echo'

                    <a class="slider-product" href="'.URL.$rscad["prod_slug"].'">

                      <div class="img" style="background:url('.URL.substr($rscad["prod_image"],3).')"></div>

                      <div class="name"><span>'.$rscad["prod_name"].'</span></div>

                    </a>

                    ';

                  }

                }

                else{

                  echo '<div class=""><h2>No products found</h2></div>'; 

                }

                ?>

                

              </div>

              <div class="text-center mb-20"><a href="<?php echo URL.$resc['cat_slug'].'/1' ?>" class="btn btn-viewall">View all</a></div>

            </div>

            <?php } ?>



          </div>

        </div>

      </div>

    </div>

  </div>

  <!-- category slider ends  --->



  <?php include "brands.php";?>



  <?php include "footer.php";?>

  

</div>



<?php include "js.php";?>

</body>

</html>
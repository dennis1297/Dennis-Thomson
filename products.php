<?php 
include("config.php"); 
include("functions.php"); 

$product=mysqli_fetch_assoc(mysqli_query($conn, 'select *from tbl_product where prod_slug="'.$_GET["pslug"].'"'));
$description=mysqli_fetch_assoc(mysqli_query($conn, 'select *from tbl_product_description where prod_id="'.$product['prod_id'].'"'));

$prcat = mysqli_query($conn,"select *from tbl_product_category where prod_id=".$product["prod_id"]."");
$prcatid = array();
while($reprcat = mysqli_fetch_array($prcat)){
  $prcatid[] = $reprcat["cat_id"];
}
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
  <!-- category slider starts  --->
  <div class="category-bar">
    <div class="category-slider">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="owl-carousel category-carousel">
              <?php
              $selc=mysqli_query($conn, "select *from tbl_cat order by cat_pos desc");
              while($resc=mysqli_fetch_array($selc))
              {
                $active = in_array($resc['cat_id'], $prcatid) ? 'active' : '';
                echo '
                <a class="slider-content '.$active.'" href="'.URL.$resc['cat_slug'].'/1"><img src="'.URL.substr($resc['cat_img'],3).'" class="img-responsive"><span>'.$resc['cat_name'].'</span></a>
                ';
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- category slider ends  --->
  </div>

  <!-- single product starts -->
  <div class="single-product-area mt-80">
    <div class="container">
      <div class="row">
        <div class="col-md-5">
          <!--Tab Content Start-->
          <div class="tab-content product-details-large">
            <?php
            $i=1;
            $spimg=mysqli_query($conn,"select *from tbl_product_images where prod_id='".$product['prod_id']."'");
            while($rpimg=mysqli_fetch_assoc($spimg))
            {
              $active = $rpimg['img_default']=='Y' ? 'in active' : '';
              echo '
              <div id="single-slide-'.$i.'" class="tab-pane fade '.$active.'">
                <div class="single-product-img img-full">                    
                  <a href="javascript:void(0)">
                    <img src="'.URL.substr($rpimg["prod_image"],3).'" alt="">
                  </a>
                </div>
              </div>
              ';
              $i++;
            }
            ?>

          </div>
          <!--Tab Content End-->

          <!--Tab Menu Start-->
          <div class="single-product-menu">
            <div class="nav single-slide-menu owl-carousel">
              <?php
              $i=1;
              $spimg=mysqli_query($conn,"select *from tbl_product_images where prod_id='".$product['prod_id']."'");
              while($rpimg=mysqli_fetch_assoc($spimg))
              {
                $active = $rpimg['img_default']=='Y' ? 'active' : '';
                echo '<div class="'.$active.'"><a data-toggle="tab" href="#single-slide-'.$i.'"><img src="'.URL.substr($rpimg["prod_image"],3).'" alt=""></a></div>';
                $i++;
              }
              ?>
            </div>
          </div>
          <!--Tab Menu End-->
        </div>

        <div class="col-md-7">
          <form id="addtocart" method="post">
            <div class="single-product-content">
              <h1 class="product-name"><?php echo $product['prod_name'];?></h1>
              <input type="hidden" name="prod_type" value="<?php echo $product["prod_type"]?>">
              <input type="hidden" name="product_id" value="<?php echo $product['prod_id']?>">


              <?php 
              //varaiable product
              if($product["prod_type"]==2) {
                include "producttype/variableproduct.php";
              }//varaiable product
              //simple product
              else{
                include "producttype/simpleproduct.php";
              }//simple product
              ?>
              
              <div class="divider"></div>
              <div class="description">
                <h3>Description</h3>
                <div><?php echo $description['prod_desc']?></div>
              </div>
            </div>
          <form>
        </div>
      </div>
    </div>
  </div>
  <!-- single product ends --> 
  

  <?php include "brands.php";?>

  <?php include "footer.php";?>
  
</div>

<script>
var prod_type = '<?php echo $product["prod_type"]?>';
var prod_qty = '<?php echo $product["prod_qty"]?>';
</script>
<?php include "js.php";?>

</body>
</html>
<?php 
include("config.php"); 
include("functions.php");
$selcatid=mysqli_fetch_assoc(mysqli_query($conn,"select *from tbl_cat where cat_slug='".$_GET["cslug"]."'"));
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

  <!-- single product starts -->
  <div class="category-products mt-80">
    <div class="container">
      <div class="row">
        <div id="prod-disp-grid">
          <?php include "productgrid.php";?>
        </div>
      </div>
    </div>
  </div>
  <!-- single product ends -->
  

  <?php include "brands.php";?>

  <?php include "footer.php";?>
  
</div>

<?php include "js.php";?>
</body>
</html>
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
              $active = $resc['cat_id']==$selcatid["cat_id"] ? 'active' : '';
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
</div>
<!-- category slider ends  --->
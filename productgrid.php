<?php 
if (isset($_GET["page"])) {
	$page  = $_GET["page"]; 
} 
else { 
	$page=1; 
}  

$page = $_GET['page'];
$cur_page = $page;
$page -= 1;
$per_page = 12;
$previous_btn = true;
$next_btn = true;
$first_btn = true;
$last_btn = true;
$start = $page * $per_page;

$selcatid=mysqli_fetch_assoc(mysqli_query($conn,"select *from tbl_cat where cat_slug='".$_GET["cslug"]."'"));


$selcad = mysqli_query ($conn,"select pr.prod_id,prod_name,prod_slug,sort_order,status,cat_id,prod_image,img_default from tbl_product as pr inner join tbl_product_images as prig on pr.prod_id=prig.prod_id inner join tbl_product_category as prct on pr.prod_id=prct.prod_id where cat_id=".$selcatid["cat_id"]." and pr.status='Y' and prig.img_default='Y' ORDER BY sort_order ASC limit $start, $per_page");


if(mysqli_num_rows($selcad)>0){
	while($rscad=mysqli_fetch_assoc($selcad)){
		echo'
		<div class="col-md-3">
          <a href="'.URL.$rscad['prod_slug'].'" class="single-product">
            <div class="img" style="background:url('.URL.substr($rscad["prod_image"],3).')"></div>
            <div class="name"><span>'.$rscad["prod_name"].'</span></div>
          </a>
        </div>
		';
	}
}
else{
	echo '<div class="col-md-12 text-center"><h2>No products found</h2></div>'; 
}

$total_records = mysqli_num_rows(mysqli_query ($conn,"select pr.prod_id,prod_name,prod_slug,sort_order,status,cat_id,prod_image,img_default from tbl_product as pr inner join tbl_product_images as prig on pr.prod_id=prig.prod_id inner join tbl_product_category as prct on pr.prod_id=prct.prod_id where cat_id=".$selcatid["cat_id"]." and pr.status='Y' and prig.img_default='Y'"));

$no_of_paginations = ceil($total_records / $per_page);

/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
if ($cur_page >= 7) {
    $start_loop = $cur_page - 3;
    if ($no_of_paginations > $cur_page + 3)
        $end_loop = $cur_page + 3;
    else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
        $start_loop = $no_of_paginations - 6;
        $end_loop = $no_of_paginations;
    } else {
        $end_loop = $no_of_paginations;
    }
} else {
    $start_loop = 1;
    if ($no_of_paginations > 7)
        $end_loop = 7;
    else
        $end_loop = $no_of_paginations;
}
/* ----------------------------------------------------------------------------------------------------------- */

echo '<div class="clearfix"></div>';

if($total_records>0){
	$pagLink = "<div class='col-md-12 text-center'><ul class='pagination'>";
	
	// FOR ENABLING THE FIRST BUTTON
	if ($first_btn && $cur_page > 1) {		
		$pagLink .= '<li><a href="'.URL.$_GET["cslug"].'/1"><i class="fa fa-angle-double-left"></i></a></li>';
	} else if ($first_btn) {
		$pagLink .= '<li><a><i class="fa fa-angle-double-left"></i></a></li>';
	}

	// FOR ENABLING THE PREVIOUS BUTTON
	if ($previous_btn && $cur_page > 1) {
		$pre = $cur_page - 1;		
		$pagLink .= '<li><a href="'.URL.$_GET["cslug"].'/'.$pre.'"><i class="fa fa-angle-left"></i></a></li>';
	} else if ($previous_btn) {
		$pagLink .= '<li><a><i class="fa fa-angle-left"></i></a></li>';
	}
	for ($i = $start_loop; $i <= $end_loop; $i++) {
		if ($cur_page == $i)
			$pagLink .= '<li class="active"><a>'.$i.'</a></li>';
		else
			$pagLink .= '<li><a href="'.URL.$_GET["cslug"].'/'.$i.'">'.$i.'</a></li>';
	}

	// TO ENABLE THE NEXT BUTTON
	if ($next_btn && $cur_page < $no_of_paginations) {
		$nex = $cur_page + 1;		
		$pagLink .= '<li><a href="'.URL.$_GET["cslug"].'/'.$nex.'"><i class="fa fa-angle-right"></i></a></li>';
	} else if ($next_btn) {
		$pagLink .= '<li><a><i class="fa fa-angle-right"></i></a></li>';
	}

	// TO ENABLE THE END BUTTON
    if ($last_btn && $cur_page < $no_of_paginations) {
    	$pagLink .= '<li><a href="'.URL.$_GET["cslug"].'/'.$no_of_paginations.'"><i class="fa fa-angle-double-right"></i></a></li>';
    } else if ($last_btn) {
    	$pagLink .= '<li><a><i class="fa fa-angle-double-right"></i></a></li>';
    }
	
	echo $pagLink . "</ul></div>";
}
?>
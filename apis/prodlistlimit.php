<?php 
include "../config.php";

$products = array();

$page = $_GET["page"];

$sel = mysqli_query($conn,"select tpr.prod_id,prod_name,prod_image from tbl_product tpr inner join tbl_product_images tpi on tpr.prod_id=tpi.prod_id where img_default='Y' and prod_image!='' order by prod_id asc limit $page,10");
while($res = mysqli_fetch_assoc($sel)){
    $prods = array(
        "id"        => $res["prod_id"],
        "prodname"  => $res["prod_name"],
        "prodimage" => URL.substr($res["prod_image"],3)
    );
    array_push($products, $prods);
}

$data = array(
    "products" => $products
);
echo json_encode($data);
?>
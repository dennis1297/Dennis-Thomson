<?php 
$stock ='';
$stocktxt='';
if($product["prod_qty"]==0){
    $stocktxt="Out of stock";
    $stock = 'disabled';
}
?>

<input type="hidden" value="<?php echo $product["prod_selprice"]?>" name="prod_unitprice">

<div class="divider"></div>
<div class="product-price">
    <div class="sellprice">Rs. <span id="sellprice"><?php echo $product["prod_selprice"]?></span></div> <div class="mrp">Rs. <span id="mrp"><?php echo $product["prod_mrp"]?></span></div>
</div>
<div class="divider"></div>              
<div class="product-variation">
    <div class="cart-plus-minus">
        <label for="qty">Quantity:</label>
        <div class="numbers-row">
        <div class="dec qtybutton">-</div>
        <input type="tel" class="qty" value="1" maxlength="4" id="qty" name="qty" onkeypress="return enterNumerics(event);">
        <div class="inc qtybutton">+</div>
        </div>
    </div>
    <div id="loaderdiv"><?php echo $stocktxt?></div>
    <button <?php echo $stock?> id="btn-addcart" class="button pro-add-to-cart btn-addcart" title="Add to Cart" type="submit"><span><i class="fa fa-shopping-cart"></i> Add to Cart</span></button>
    <!--button class="button btn-addcart">Submit Enquiry</button-->
</div>
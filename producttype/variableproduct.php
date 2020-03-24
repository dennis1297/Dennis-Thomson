<?php 
$stock ='';
$stocktxt='';
$sellprice=0;
$mrp=0;


$opt = mysqli_query($conn,"select *from tbl_product_option pop inner join tbl_options ops on pop.option_id=ops.op_id where product_id='".$product['prod_id']."' order by product_option_id asc");
while($rpopt=mysqli_fetch_assoc($opt)) { ?>
    <div class="product-options">
        <label class="control-label"><?php echo $rpopt["op_name"]?></label>
        <div id="input-option<?php echo $rpopt["product_option_id"]?>">
            <!-- product options value--->
            <?php $optval = mysqli_query($conn,"select *from tbl_product_option_value pov inner join tbl_options_value opv on pov.option_value_id=opv.op_val_id where product_id='".$product['prod_id']."' and option_id='".$rpopt["op_id"]."' and product_option_id='".$rpopt["product_option_id"]."' order by product_option_value_id asc");
            $i=1;
            while($rpopvl=mysqli_fetch_assoc($optval)) { 
                $ck='';$radiostock='';
                if($i==1) { 
                    $ck='checked';
                    /*$sellprice=$sellprice+$rpopvl["sellprice"];
                    $mrp=$mrp+$rpopvl["mrp"];*/
                    $sellprice=$sellprice.$rpopvl["sellprice_prefix"].$rpopvl["sellprice"];
                    $mrp=$mrp.$rpopvl["mrp_prefix"].$rpopvl["mrp"];
                }

                if($product["prod_qty"]==0){
                    $stock = 'disabled';$stocktxt="Out of stock"; $radiostock='disabled';
                }
                else{
                    if($rpopvl["quantity"]==0) { $stock = 'disabled';$stocktxt="Out of stock"; $radiostock='disabled'; }
                }                
                ?>
                <label class="radio-inline"><input type="radio" class="inputradio" name="option[<?php echo $rpopt["product_option_id"]?>]" value="<?php echo $rpopvl["product_option_value_id"]?>" <?php echo $ck?>><div <?php echo $radiostock?> class="radioprooption"><?php echo $rpopvl["op_val_name"]?></div></label>
            <?php 
                $i++;
            } 
            ?>
            <!-- product options value--->
        </div>
    </div>
<?php } ?>

<!--input type="hidden" value="<?php echo $product["prod_selprice"]+$sellprice?>" name="prod_unitprice" id="prod_unitprice"-->
<input type="hidden" value="<?php echo eval('return '.$sellprice.';')+$product["prod_selprice"]?>" name="prod_unitprice" id="prod_unitprice">

<div class="divider"></div>
<div class="product-price">
    <div class="sellprice">Rs. <span id="sellprice"><?php echo eval('return '.$sellprice.';')+$product["prod_selprice"]?></span></div> <div class="mrp">Rs. <span id="mrp"><?php echo eval('return '.$mrp.';')+$product["prod_mrp"]?></span></div>

    <!--div class="sellprice">Rs. <span id="sellprice"><?php echo $product["prod_selprice"]+$sellprice?></span></div> <div class="mrp">Rs. <span id="mrp"><?php echo $product["prod_mrp"]+$mrp?></span></div-->
</div>
<div class="divider"></div>              
<div class="product-variation">
    <div class="cart-plus-minus">
        <label for="qty">Quantity:</label>
        <div class="numbers-row">
        <div class="dec qtybutton">-</div>
        <input type="tel" class="qty" value="1" maxlength="12" id="qty" name="qty" onkeypress="return enterNumerics(event);">
        <div class="inc qtybutton">+</div>
        </div>
    </div>
    <div id="loaderdiv"><?php echo $stocktxt?></div>
    <button <?php echo $stock?> id="btn-addcart" class="button pro-add-to-cart btn-addcart" title="Add to Cart" type="submit"><span><i class="fa fa-shopping-cart"></i> Add to Cart</span></button>
    <!--button class="button btn-addcart">Submit Enquiry</button-->
</div>
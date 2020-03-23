<?php
include('config.php');

$action = $_POST["action"];
$gaction = $_GET["gaction"];

/****** customer registration ******/
if($action=='custregister'){
	$fname = $_POST["firstname"];
	$lname = $_POST["lastname"];
	$email = $_POST["email"];
	$mobileno = $_POST["mobileno"];
	$password = $_POST["password"];

	$res=mysqli_query($conn,"select email from tbl_customer where email='$email' limit 1");

	if(mysqli_num_rows($res) > 0){		
		$response = "2";
	}
	else{
		$ins = mysqli_query($conn,"insert into tbl_customer(customer_group_id,firstname,lastname,email,mobileno,password,status,date_added,reg_type) values ('1','$fname','$lname','$email','$mobileno','".md5($password)."','1','".date("Y-m-d H:i:s")."','website')");
		$cus_id = mysqli_insert_id($conn);

		if($ins){
			$cus=mysqli_fetch_assoc(mysqli_query($conn,"select *from tbl_customer where customer_id='$cus_id'"));
			$_SESSION["cus_id"]=$cus["customer_id"];
			$_SESSION["cus_group_id"]=$cus["customer_group_id"];
			$_SESSION["fname"]=$cus["firstname"];
			$_SESSION["lname"]=$cus["lastname"];
			$_SESSION["reg_type"]=$cus["reg_type"];

			$duration = time()+ 3600 * 24 * 60;
			setcookie('cus_id', $cus["customer_id"], $duration, "/");
			setcookie('cus_group_id', $cus["customer_group_id"], $duration, "/");
			setcookie('fname', $cus["firstname"], $duration, "/");
			setcookie('lname', $cus["lastname"], $duration, "/");
			setcookie('reg_type', $cus["reg_type"], $duration, "/");
						
			$response = "1";
		}
		else{
			$response = "0";
		}
	}
	echo $response;	
}
/****** customer registration ******/

/****** customer login  ******/
if($action=='custlogin'){
	$email = $_POST["loginemail"];
	$password = $_POST["loginpasswd"];

	$res=mysqli_query($conn,"select customer_id,customer_group_id,mobileno,firstname,lastname,email,password,status from tbl_customer where email='".$email."' and password='".md5($password)."' and status='1' limit 1");

	if(mysqli_num_rows($res) > 0){
		$cus=mysqli_fetch_assoc($res);
		$_SESSION["cus_id"]=$cus["customer_id"];
		$_SESSION["cus_group_id"]=$cus["customer_group_id"];
		$_SESSION["fname"]=$cus["firstname"];
		$_SESSION["lname"]=$cus["lastname"];
		$_SESSION["reg_type"]=$cus["reg_type"];

		$duration = time()+ 3600 * 24 * 60;
		setcookie('cus_id', $cus["customer_id"], $duration, "/");
		setcookie('cus_group_id', $cus["customer_group_id"], $duration, "/");
		setcookie('fname', $cus["firstname"], $duration, "/");
		setcookie('lname', $cus["lastname"], $duration, "/");
		setcookie('reg_type', $cus["reg_type"], $duration, "/");
		
		$response = "1";
	}
	else{
		$response = "0";
	}
	echo $response;
}
/****** customer login  ******/

/****** addto cart *******/
if($action=='addtocart'){
	$prodid = $_POST["product_id"];
	$qty = round($_POST["qty"]);

	if($qty<0){
		$qty = 1;
	}
	else{
		$qty = round($_POST["qty"]);
	}
	
	$prodtyp = $_POST["prod_type"];
	$pro_unitprice = $_POST["prod_unitprice"];
	$pro_totprice = $pro_unitprice*$qty;

	/***** if product has option *****/
	if($_POST["prod_type"]==2){
		foreach ($_POST["option"] as $key=>$value){
			$response[$key] = $value;

			$selop=mysqli_fetch_assoc(mysqli_query($conn,"select op_name,op_val_name from tbl_product_option_value tpv inner join tbl_options ops on tpv.option_id=ops.op_id inner join tbl_options_value tov on tpv.option_value_id=tov.op_val_id where product_id='$prodid' and product_option_value_id='$value' and product_option_id='$key'"));
			$option_desc[$selop["op_name"]] = $selop["op_val_name"];
		}
		$pro_option = json_encode($response);
		$pro_option_desc = json_encode($option_desc);
	}
	/***** if product has option *****/

	/**** insert & update cart *****/
	$sel = mysqli_query($conn,"select *from tbl_cart where customer_id='".$_COOKIE["cus_id"]."' and product_id='$prodid' and pro_option='$pro_option'");	

	if(mysqli_num_rows($sel)>0) {
		$res=mysqli_fetch_assoc($sel);
		$nqty = (int)$res["pro_qty"]+(int)$qty;
		$npro_totprice = $pro_unitprice*$nqty;
		$ins = mysqli_query($conn,"update tbl_cart set pro_qty='$nqty',pro_totprice='$npro_totprice' where cartid='".$res["cartid"]."'");
	}
	else{
		$ins = mysqli_query($conn,"insert into tbl_cart (customer_id,sessionid,product_id,pro_option,pro_option_desc,pro_qty,pro_unitprice,pro_totprice,date_added) values ('".$_COOKIE["cus_id"]."','".$_COOKIE["sessionid"]."','$prodid','$pro_option','$pro_option_desc','$qty','$pro_unitprice','$pro_totprice','".date("Y-m-d H:i:s")."')");
	}	

	if($ins)
		$status = 1;
	else
		$status = 0;
	/**** insert & update cart *****/

	/***** get cart data of customer *****/
	$products = array();
	$total = 0;
	$getcrt = mysqli_query($conn,"select cartid,customer_id,sessionid,product_id,pro_option,pro_option_desc,pro_qty,pro_unitprice,pro_totprice,prod_name,prod_slug,prod_image from tbl_cart tc inner join tbl_product tp on tc.product_id=tp.prod_id inner join tbl_product_images tpi on tc.product_id=tpi.prod_id where customer_id='".$_COOKIE["cus_id"]."'");
	while($rescrt = mysqli_fetch_assoc($getcrt)) { 
		$propt = json_decode($rescrt["pro_option_desc"]);
		$options = array();
		foreach($propt as $key=>$value){
			$opval = array(
				"option"	=>	$key,
				"optval"	=>	$value
			);
			array_push($options, $opval);
		}

        $total = $total+$rescrt["pro_totprice"];

		$prods = array(
			"prodname"	=>	$rescrt["prod_name"],
			"slug"	=>	$rescrt["prod_slug"],
			"image"	=>	substr($rescrt["prod_image"],3),
			"qty"	=>	$rescrt["pro_qty"],
			"unitprodprice"	=>	$rescrt["pro_unitprice"],
			"totprodprice"	=>	$rescrt["pro_totprice"],
			"cartid"	=>	$rescrt["cartid"],
			"options"	=>	$options
		);
		array_push($products, $prods);
	}

	$cartcount = mysqli_num_rows($getcrt);
	/***** get cart data of customer *****/

	$data = array(
		"status"	=>	$status,
		"cartcount"	=>	$cartcount,
		"total"		=>	$total,
		"products"	=>	$products
	);
	echo json_encode($data);
}
/****** addto cart *******/

/****** remove product from cart ********/
if($action=='removecart'){

	/**** delete product from cart *****/
	$ins = mysqli_query($conn,"delete from tbl_cart where cartid='".$_POST["cartid"]."'");
	if($ins)
		$status = 1;
	else
		$status = 0;
	/**** delete product from cart *****/

	/***** get cart data of customer *****/
	$products = array();
	$total = 0;
	$getcrt = mysqli_query($conn,"select cartid,customer_id,sessionid,product_id,pro_option,pro_option_desc,pro_qty,pro_unitprice,pro_totprice,prod_name,prod_slug,prod_image from tbl_cart tc inner join tbl_product tp on tc.product_id=tp.prod_id inner join tbl_product_images tpi on tc.product_id=tpi.prod_id where customer_id='".$_COOKIE["cus_id"]."'");
	while($rescrt = mysqli_fetch_assoc($getcrt)) { 
		$propt = json_decode($rescrt["pro_option_desc"]);
		$options = array();
		foreach($propt as $key=>$value){
			$opval = array(
				"option"	=>	$key,
				"optval"	=>	$value
			);
			array_push($options, $opval);
		}

        $total = $total+$rescrt["pro_totprice"];

		$prods = array(
			"prodname"	=>	$rescrt["prod_name"],
			"slug"	=>	$rescrt["prod_slug"],
			"image"	=>	substr($rescrt["prod_image"],3),
			"qty"	=>	$rescrt["pro_qty"],
			"unitprodprice"	=>	$rescrt["pro_unitprice"],
			"totprodprice"	=>	$rescrt["pro_totprice"],
			"cartid"	=>	$rescrt["cartid"],
			"options"	=>	$options
		);
		array_push($products, $prods);
	}

	$cartcount = mysqli_num_rows($getcrt);
	/***** get cart data of customer *****/

	$data = array(
		"status"	=>	$status,
		"cartcount"	=>	$cartcount,
		"total"		=>	$total,
		"products"	=>	$products
	);
	echo json_encode($data);
}
/****** remove product from cart ********/

/****** product option *******/
if($action=='productoption'){
	$sellprice=0;
	$mrp=0;
	$stock=1;
	$prodid = $_POST["product_id"];

	$prod = mysqli_fetch_assoc(mysqli_query($conn,"select prod_mrp,prod_selprice from tbl_product where prod_id='$prodid'"));
	foreach ($_POST["option"] as $key=>$value){
		$sel = mysqli_fetch_assoc(mysqli_query($conn,"select *from tbl_product_option_value where product_id='$prodid' and product_option_id='".$key."' and product_option_value_id='$value'"));

		if($sel["quantity"]==0){ $stock=0; }
		//$sellprice=$sellprice+$sel["sellprice"];
		//$mrp=$mrp+$sel["mrp"];
		$sellprice=$sellprice.$sel["sellprice_prefix"].$sel["sellprice"];
		$mrp=$mrp.$sel["mrp_prefix"].$sel["mrp"];
	}

	$data = array(
		"sellprice"	=>	eval('return '.$sellprice.';')+$prod["prod_selprice"],
		"mrp"	=>	eval('return '.$mrp.';')+$prod["prod_mrp"],
		/*"sellprice"	=>	$sellprice+$prod["prod_selprice"],
		"mrp"	=>	$mrp+$prod["prod_mrp"],*/
		"stock"	=>	$stock
	);
	echo json_encode($data);
}
/****** product option *******/

/****** update cart *******/
if($action=="updateqtycart"){
	$qty = round($_POST["qty"]);

	if($qty<0){
		$qty = 1;
	}
	else{
		$qty = round($_POST["qty"]);
	}

	$cartid = $_POST["cartid"];
	$subaction = $_POST["subaction"];
	$pro_unitprice = $_POST["prod_unitprice"];
	$pro_totprice = $pro_unitprice*$qty;

	/**** update & deleta cart *****/
	if($subaction=='qtyupd'){
		$ins = mysqli_query($conn,"update tbl_cart set pro_qty='$qty',pro_totprice='$pro_totprice' where cartid='$cartid' and customer_id='".$_COOKIE["cus_id"]."'");
	}
	else{
		$ins = mysqli_query($conn,"delete from tbl_cart where cartid='$cartid' and customer_id='".$_COOKIE["cus_id"]."'");
	}

	if($ins)
		$status = 1;
	else
		$status = 0;
	/**** update & deleta cart *****/
	
	/***** get cart data of customer *****/
	$products = array();
	$total = 0;
	$getcrt = mysqli_query($conn,"select cartid,customer_id,sessionid,product_id,pro_option,pro_option_desc,pro_qty,pro_unitprice,pro_totprice,prod_name,prod_slug,prod_image from tbl_cart tc inner join tbl_product tp on tc.product_id=tp.prod_id inner join tbl_product_images tpi on tc.product_id=tpi.prod_id where customer_id='".$_COOKIE["cus_id"]."'");
	while($rescrt = mysqli_fetch_assoc($getcrt)) { 
		$propt = json_decode($rescrt["pro_option_desc"]);
		$options = array();
		foreach($propt as $key=>$value){
			$opval = array(
				"option"	=>	$key,
				"optval"	=>	$value
			);
			array_push($options, $opval);
		}

        $total = $total+$rescrt["pro_totprice"];

		$prods = array(
			"prodname"	=>	$rescrt["prod_name"],
			"slug"	=>	$rescrt["prod_slug"],
			"image"	=>	substr($rescrt["prod_image"],3),
			"qty"	=>	$rescrt["pro_qty"],
			"unitprodprice"	=>	$rescrt["pro_unitprice"],
			"totprodprice"	=>	$rescrt["pro_totprice"],
			"cartid"	=>	$rescrt["cartid"],
			"options"	=>	$options
		);
		array_push($products, $prods);
	}

	$cartcount = mysqli_num_rows($getcrt);
	/***** get cart data of customer *****/

	$data = array(
		"status"	=>	$status,
		"cartcount"	=>	$cartcount,
		"total"		=>	$total,
		"products"	=>	$products
	);
	echo json_encode($data);
}
/****** update cart *******/

/****** update myaccount ******/
if($action=="myaccount") {
	$firstname = str_replace("'","`",$_POST["firstname"]);
	$lastname = str_replace("'","`",$_POST["lastname"]);
	$email = str_replace("'","`",$_POST["email"]);
	$telephone = str_replace("'","`",$_POST["telephone"]);

	$ins = mysqli_query($conn,"update tbl_customer set firstname='$firstname',lastname='$lastname',email='$email',mobileno='$telephone' where customer_id='".$_COOKIE["cus_id"]."'");

	if($ins)
		echo "1";
	else
		echo "0";
}
/****** update myaccount ******/

/****** update password *****/
if($action=="accountpwd") {
	$confirmpwd = $_POST["confirmpwd"];

	$ins = mysqli_query($conn,"update tbl_customer set password='".md5($confirmpwd)."' where customer_id='".$_COOKIE["cus_id"]."'");

	if($ins)
		echo "1";
	else
		echo "0";
}
/****** update password *****/

/****** myaccount add & update address *****/
if($action=="accountaddress") {
	$fname = $_POST["addr_fname"];
	$lname = $_POST["addr_lname"];
	$company = $_POST["addr_company"];
	$addr1 = $_POST["addr_address1"];
	$addr2 = $_POST["addr_address2"];
	$city = $_POST["addr_city"];
	$postcode = $_POST["addr_postcode"];
	$country = $_POST["addr_country"];
	$state = $_POST["addr_state"];
	$addtype = $_POST["addtype"];
	$addressid = $_POST["addressid"];

	if($addtype=='edit'){
		$ins = mysqli_query($conn,"update tbl_address set firstname='$fname',lastname='$lname',company='$company',address_1='$addr1',address_2='$addr2',city='$city',postcode='$postcode',country='$country',state='$state' where address_id='$addressid' and customer_id='".$_COOKIE["cus_id"]."'");
	}
	else{
		$ins = mysqli_query($conn,"insert into tbl_address (customer_id,firstname,lastname,company,address_1,address_2,city,postcode,country,state) values('".$_COOKIE["cus_id"]."','$fname','$lname','$company','$addr1','$addr2','$city','$postcode','$country','$state')");
	}

	if($ins)
		echo "1";
	else
		echo "0";
}
/****** myaccount add & update address *****/

/****** myaccount remove address *****/
if($action=="removeaddress") {
	$ins = mysqli_query($conn,"delete from tbl_address where address_id='".$_POST["addrid"]."' and customer_id='".$_COOKIE["cus_id"]."'");

	if($ins)
		echo "1";
	else
		echo "0";
}
/****** myaccount remove address *****/

/***** seacrhbar search *******/
if($action=="search") {
	$catarr = array();
	$proarr = array();

	$selcat = mysqli_query($conn,"select cat_name,cat_slug,cat_img from tbl_cat where cat_name like '%".$_POST["keyword"]."%' and cat_status='Y'");
	while($rescat = mysqli_fetch_assoc($selcat)){
		$cats = array(
			"name" => $rescat["cat_name"],
			"url"  => URL.$rescat["cat_slug"].'/1',
			"image" => URL.substr($rescat["cat_img"],3)
		);
		array_push($catarr, $cats);
	}
	$selpro = mysqli_query($conn,"select tp.prod_id,prod_name,prod_slug,prod_image from tbl_product tp inner join tbl_product_images tpi on tp.prod_id=tpi.prod_id where prod_name like '%".$_POST["keyword"]."%' and status='Y' and img_default='Y'");
	while($respro = mysqli_fetch_assoc($selpro)){
		$pros = array(
			"name" => $respro["prod_name"],
			"url"  => URL.$respro["prod_slug"],
			"image" => URL.substr($respro["prod_image"],3)
		);
		array_push($proarr, $pros);
	}
	echo json_encode(array_merge($catarr,$proarr));
}	
/***** seacrhbar search *******/

/***** google login ******/
if($action=="googlelogin"){
	$email = $_POST["email"];
	$fname = $_POST["fname"];
	$lname = $_POST["lname"];

	$res=mysqli_query($conn,"select email from tbl_customer where email='$email' limit 1");
	if(mysqli_num_rows($res) > 0){		
		$cus=mysqli_fetch_assoc(mysqli_query($conn,"select *from tbl_customer where email='$email' limit 1"));
  
		$_SESSION["cus_id"]=$cus["customer_id"];
		$_SESSION["cus_group_id"]=$cus["customer_group_id"];
		$_SESSION["fname"]=$cus["firstname"];
		$_SESSION["lname"]=$cus["lastname"];
		$_SESSION["reg_type"]=$cus["reg_type"];
  
		$duration = time()+ 3600 * 24 * 60;
		setcookie('cus_id', $cus["customer_id"], $duration, "/");
		setcookie('cus_group_id', $cus["customer_group_id"], $duration, "/");
		setcookie('fname', $cus["firstname"], $duration, "/");
		setcookie('lname', $cus["lastname"], $duration, "/");
		setcookie('reg_type', $cus["reg_type"], $duration, "/");

		echo "1";
	}
	else{
		$ins = mysqli_query($conn,"insert into tbl_customer(customer_group_id,firstname,lastname,email,mobileno,password,status,date_added,reg_type) values ('1','$fname','$lname','$email','','','1','".date("Y-m-d H:i:s")."','google')");
		$cus_id = mysqli_insert_id($conn);
		if($ins){
			$cus=mysqli_fetch_assoc(mysqli_query($conn,"select *from tbl_customer where customer_id='$cus_id'"));
			$_SESSION["cus_id"]=$cus["customer_id"];
			$_SESSION["cus_group_id"]=$cus["customer_group_id"];
			$_SESSION["fname"]=$cus["firstname"];
			$_SESSION["lname"]=$cus["lastname"];
			$_SESSION["reg_type"]=$cus["reg_type"];
		
			$duration = time()+ 3600 * 24 * 60;
			setcookie('cus_id', $cus["customer_id"], $duration, "/");
			setcookie('cus_group_id', $cus["customer_group_id"], $duration, "/");
			setcookie('fname', $cus["firstname"], $duration, "/");
			setcookie('lname', $cus["lastname"], $duration, "/");
			setcookie('reg_type', $cus["reg_type"], $duration, "/");
		}
		echo "1";
	}
}
/***** google login ******/

/****** product enquiry *****/
if($action=="prodenquiry"){
	$enqname = $_POST["enqname"];
	$enqconno = $_POST["enqconno"];
	$enqmail = $_POST["enqmail"];
	$enqmsg = $_POST["enqmsg"];

	/***** mail code  ******/
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .= 'From: Vivekaessencemart.<purchase@vivekaessencemart.com>'. "\r\n" .'Reply-To: purchase@vivekaessencemart.com' . "\r\n" .'X-Mailer: PHP/' . phpversion();
	$from     = "purchase@vivekaessencemart.com";
	$subject  = "Enquiry Regarding";
	$table  = "<table border='2px' style='width:50%'>";   
	$table .= '<tr><td>Name :</td><td>' . $enqname . '</td></tr>';
	$table .= '<tr><td>Conatct no. :</td><td>' . $enqconno . '</td></tr>';
	$table .= '<tr><td>Email :</td><td>' . $enqmail . '</td></tr>';
	$table .= '<tr><td>Message :</td><td>' . $enqmsg . '</td></tr>'; 
	$table .= '</table>';

	$table .= "<table border='2px' style='width:50%'>";
	$table .= '<tr><td>Product</td><td>Qty</td></tr>';
	$getcrt = mysqli_query($conn,"select cartid,customer_id,sessionid,product_id,pro_option,pro_option_desc,pro_qty,pro_unitprice,pro_totprice,prod_name,prod_slug,prod_image from tbl_cart tc inner join tbl_product tp on tc.product_id=tp.prod_id inner join tbl_product_images tpi on tc.product_id=tpi.prod_id where customer_id='".$_COOKIE["cus_id"]."'");
	while($rescrt = mysqli_fetch_assoc($getcrt)) { 
		$propt = json_decode($rescrt["pro_option_desc"]);
		$table .= '<tr>
			<td>
			'.$rescrt["prod_name"];
			foreach($propt as $key=>$value){
				$table .= "<span class='proops'> ".$key." : ".$value."</span>";
			}
		$table .= '</td>';
		$table .= '<td>'.$rescrt["pro_qty"].'</td>';
		$table .= '</tr>';		
	} 
	$table .= '</table>';
	$n=@mail("purchase@vivekaessencemart.com", $subject, $table, $headers);
	/***** mail code  ******/

	/**** delete cart *****/
	mysqli_query($conn,"delete from tbl_cart where customer_id='".$_COOKIE["cus_id"]."'");
	/**** delete cart *****/

	if($n){
		echo "1";
	} else{
		echo "0";
	}
}
/****** product enquiry *****/
?>
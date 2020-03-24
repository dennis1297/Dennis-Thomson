<?php
session_start();
include "include/db.php";

$action=$_GET["action"];
$paction = $_POST["paction"];

if($action=="login")
{
	$pwd=md5($_GET["password"]);
	$sql=mysqli_query($conn,"select *from tbl_admin where admin_uname='".$_GET["username"]."' and admin_pass='".$pwd."' ");
	if(mysqli_num_rows($sql)==0)
	{
		echo "0";
	}
	else
	{
		while($res=mysqli_fetch_assoc($sql))
		{
			$_SESSION["login_id"]=$res["admin_id"];
			$_SESSION["login_name"]=$res["admin_uname"];
			echo '1';
		}
		
	}
}

/*attribute */
if($action=="delattrgp"){
	$del=mysqli_query($conn,"delete from tbl_attributes where attr_group_id='".$_GET["id"]."'");
	$delatgp=mysqli_query($conn,"delete from tbl_attribute_group where attr_group_id='".$_GET["id"]."'");
	echo '1';
}

if($action=="delattr"){
	$del=mysqli_query($conn,"delete from tbl_attributes where attr_id='".$_GET["id"]."'");
	echo '1';
}
/*attribute */


/*products edit*/
if($action=="deleopval"){
	$sel=mysqli_fetch_assoc(mysqli_query($conn ,'select *from '.$_GET["table"].' where '.$_GET["columnname"].'="'.$_GET["id"].'" '));
	unlink("../".$sel["op_val_img"]);
	mysqli_query($conn, 'delete from '.$_GET["table"].' where '.$_GET["columnname"].'="'.$_GET["id"].'"');
	echo '1';
}
if($action=="getoptions")
{
	$sel=mysqli_query($conn, "select *from tbl_options_value where op_id='".$_GET["id"]."'");
	$val='<select class="form-control"   name="optionvalid[]" id="optionval_'.$_GET["rid"].'"><option>---select---</option>';
	while($res=mysqli_fetch_assoc($sel))
	{
		$val.='<option value="'.$res['op_val_id'].'">'.$res["op_val_name"].'</option>';
	}
	$val.='</select>';
	echo $_GET["rid"].'!@!'.$val;
}
if($action=="delesplof")
{
	mysqli_query($conn,"delete from tbl_product_specialoffer where id='".$_GET["id"]."'");
	echo '1';
}
if($action=="deladproimgs"){
	$sel=mysqli_fetch_assoc(mysqli_query($conn,"select *from tbl_product_images where id='".$_GET["id"]."'"));
	unlink("../".$sel["prod_image"]);
	mysqli_query($conn,"delete from tbl_product_images where id='".$_GET["id"]."'");
	echo '1';
}
if($action=="deleattrpro"){
	mysqli_query($conn,"delete from tbl_product_attributes where id='".$_GET["id"]."'");
	echo '1';
}
/*products edit*/

if($action=="pwdupdate"){
	$oldpass=md5($_GET["oldpass"]);
	$newpass=md5($_GET["newpass"]);
	
	$sql=mysqli_fetch_assoc(mysqli_query($conn,"select *from dc_admin where id='".$_SESSION["login_id"]."'"));
	
	if($oldpass!=$sql["password"]){
		echo 1;
	}
	else{
		$ins=mysqli_query($conn,"update dc_admin set password='$newpass' where id='".$_SESSION["login_id"]."'");
		if($ins)
			echo 2;
		else
			echo 0;
	}
}

if($action=="delete")
{
	if(isset($_GET["imagecolumn"]))
	{
	 $res=mysqli_fetch_assoc(mysqli_query($conn, "select *from ".$_GET["table"]." where ".$_GET["columnname"]."='".$_GET["id"]."'"));
	 unlink("../".$res[$_GET["imagecolumn"]]);
	}
	$del=mysqli_query($conn,"delete from ".$_GET["table"]." where ".$_GET["columnname"]."='".$_GET["id"]."'");
	if($del)
		echo '1';
	else
		echo '0';
}


if($action=='alloption'){
	$option=mysqli_fetch_assoc(mysqli_query($conn,"select op_id,op_name from tbl_options where op_id='".$_GET["optionid"]."'"));

	$optval = array();
	$optionval = mysqli_query($conn,"select op_val_id,op_id,op_val_name from tbl_options_value where op_id='".$_GET["optionid"]."'");
	while($resopval = mysqli_fetch_assoc($optionval)){
		$opval = array(
			"option_value_id" => $resopval["op_val_id"],
			"name" => $resopval["op_val_name"] 	
		);
		array_push($optval, $opval);
	}

	$data[] = array(
		"option_id"			=>	$option["op_id"],
		"name"				=>	$option["op_name"],
		"option_value"		=>	$optval
	);

	echo json_encode($data);
}
?>
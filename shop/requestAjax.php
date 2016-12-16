<?php
require_once "config.php";

if(!isset($_POST["request"]))
	die("no request");

if(
	$_POST["request"]==="update_quantity"&&
	!empty($_POST["product_id"])&&
	is_numeric($_POST["quantity"])&&
	$_POST["quantity"]>0
){

	$query=$db->query("
				SELECT price
				 FROM products 
				 WHERE product_id =".(int)$_POST["product_id"]."
				 ");
	if($query->num_rows){
		$result=$query->fetch_assoc();
		$_SESSION["cart"][(int)$_POST["product_id"]]["quantity"]=(int)$_POST["quantity"];


		$result["total"]=$result["price"]*$_POST["quantity"];
		echo json_encode($result);
	}

	
}

?>
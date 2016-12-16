<?php
//checkout.php

require_once "config.php";


if(!isset($_SESSION["user_id"])){
	header("Location:login.php");
	exit;

}

//webservice serve para instruir para multibanco paypal etc 
if(isset($_SESSION["cart"])){
	$db->query("
		INSERT INTO orders
		(user_id,order_date,paid)
		VALUES(".$_SESSION["user_id"].",NOW(),0)
	");

	$order_id=$db->insert_id; //obter o ultimo id inserido

	foreach ($_SESSION["cart"] as $product_id => $item) {
		$db->query("
			INSERT INTO orders_products
			(order_id,product_id,quantity,price)
			VALUES(
				".$order_id.",
				".$product_id.",
				".$item["quantity"].",
				".$item["price"]."
			)
		");
		$db->query("
			UPDATE products
			SET stock = stock - ".(int)$item["quantity"]."
			WHERE product_id = ".$product_id."
			");


	}
	unset($_SESSION["cart"]);
	die("Obrigado por gastar dinheiro comigo");
}else{
	header("Location:index.php");
}

?>
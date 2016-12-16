<?php
	require_once "config.php";

	$query = $db->query("
		SELECT
			p.product_id, p.name, p.price, c.name AS category
		FROM
			products AS p
		INNER JOIN
			categories AS c USING(category_id)
		WHERE
			p.category_id = " .(int)$_GET["category_id"]. "
	");

	$products = array();

	while($result = $query->fetch_assoc()) {
		$products[] = $result;
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo $products[0]["category"]; ?></title>
	</head>
	<body>
		<h1><?php echo $products[0]["category"]; ?></h1>
		<ul>
<?php
	foreach($products as $product) {
?>
			<li>
				<a href="item.php?product_id=<?php echo $product["product_id"]; ?>"><?php echo $product["name"]; ?></a>
				<span><?php echo $product["price"]; ?>€</span>
			</li>
<?php
	}
?>
		</ul>
	</body>
</html>
<?php
	require_once "config.php";

	$query = $db->query("
		SELECT category_id, name
		FROM categories
		ORDER BY name
	");

	$categories = array();

	while($result = $query->fetch_assoc()) {
		$categories[] = $result;
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Categorias de Artigos</title>
	</head>
	<body>
		<ul>
<?php
	foreach($categories as $category) {
?>
			<li>
				<a href="products.php?category_id=<?php echo $category["category_id"]; ?>"><?php echo $category["name"]; ?></a>
			</li>
<?php
	}
?>
		</ul>
		<p><a href="cart.php">Ver o carrinho</a></p>
	</body>
</html>
<?php
	require_once "config.php";

	$query = $db->query("
		SELECT
			product_id, name, description, price, stock, photo, category_id
		FROM
			products
		WHERE
			product_id = " .(int)$_GET["product_id"]. "
	");

	if( $query->num_rows > 0 ) {
		$product = $query->fetch_assoc();
	}
	else
		die("Erro, não existe");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo $product["name"]; ?></title>
	</head>
	<body>
		<article>
			<h1><?php echo $product["name"]; ?></h1>
			<figure>
				<img src="photos/<?php echo $product["photo"]; ?>" alt="" style="width: 200px;">
			</figure>
			<div><?php echo $product["description"]; ?></div>
			<p>Preço: <?php echo $product["price"]; ?>€</p>
		</article>
		<form method="post" action="cart.php">
			<p>
                <input type="hidden" name="product_id" value="<?php echo $product["product_id"]; ?>">
				<input type="number" name="quantity" value="1" min="1" max="<?php echo $product["stock"]; ?>"></p>
			<input type="submit" name="submit" value="comprar">
		</form>
		<p><a href="products.php?category_id=<?php echo $product["category_id"]; ?>">Voltar</a></p>
	</body>
</html>






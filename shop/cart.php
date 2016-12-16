<?php
require_once "config.php";

if(isset ($_POST["submit"])){
	$query = $db->query("
		SELECT
			product_id, stock, name, price
		FROM
			products
		WHERE
			product_id = " .(int)$_POST["product_id"]."
        AND 
            stock >= ".(int)$_POST["quantity"]. "
	");


	if($query->num_rows >0){
		$result=$query->fetch_assoc();
		$_SESSION["cart"][$result["product_id"]]["name"]= $result["name"];
		$_SESSION["cart"][$result["product_id"]]["quantity"]=(int)$_POST["quantity"];
		$_SESSION["cart"][$result["product_id"]]["price"]=$result["price"];
			
			
	}
	else{

		die("erro");
	}	

}

?>
<!DOCTYPE html>
<html>
     <head>
     <meta charset="utf-8">
     <title>Carrinho de compras</title>
     <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
     <script>
     	$(document).ready(function(){
     		$('input[name=quantity]').on("change",function(){

     			var quantity=this.value;
     			var product_id=this.dataset.product_id;
     			var parent=$(this).parent();

     			$.ajax({
     				type:"post",
     				data:{
     					request:"update_quantity",
     					quantity:quantity,
     					product_id:product_id
     				},
     				dataType:"json",
     				url:"requestAjax.php",
     				success:function(response){
     					parent.next().html(response.total +"$");
     				}
     			});

     		});
		});
     </script>
     </head>
           <body>
               <table border="1">
               <tr>
                  <th>Nome</th>
                  <th>Preço</th>
                  <th>Quantidade</th>
                  <th>Preço Total</th>
               </tr>
<?php
if(isset($_SESSION["cart"])){
$total=0;
	foreach ($_SESSION["cart"] as $product_id=> $item) {
	
?>

               <tr>
                  <td><?php echo $item["name"]; ?></td>
                  <td><?php echo $item["price"]; ?></td>
                  <!--<td><?php echo $item["quantity"]; ?></td>-->
                  <td>
                  	<input type="number" name="quantity" value="<?php echo $item["quantity"]; ?>" data-product_id="<?php echo $product_id; ?>">
                  </td>
                  <td><?php echo round($item["quantity"]*$item["price"],2); ?></td>
               </tr>
<?php
$total =$total +($item["quantity"]*$item["price"]);
}
?>
	<tr>
		<td colspan="3"></td>
		<td><?php echo $total; ?></td>
	</tr>
<?php
}
?>

              </table>
              <p><a href="categories.php">Voltar ao inicio</a>
              	 <a href="checkout.php">Efectuar pagamento</a>
              </p>
           </body>
</html>


<?php
require_once "config.php";
if(isset($_POST["submit"])){

	if(!empty($_POST["username"])&&!empty($_POST["password"])){
		foreach ($_POST as $key => $value) {
				$_POST[$key]= $db->real_escape_string( iconv("utf-8", "utf-8", strip_tags(trim($value) )));
		}
		$query=$db->query("
			SELECT
				user_id,password
			FROM
				users
			WHERE
				username='".$_POST["username"]."'
			");
		if($query->num_rows>0){
			//verificar se password esta correcta
			$user=$query->fetch_assoc();
			if(password_verify($_POST["password"],$user["password"])){
				$_SESSION["user_id"]=$user["user_id"]; //guardar na sessao id do user e redireccionar de volta ao checkout
				header("Location:checkout.php");
				exit;
			}else{
				die("password incorrecta");
			}

		}else{
			$error_msg="Utilizador não existente";
		}
	}
 }
//DRY Dont Repeat Yourself



?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
	</head>
		<body>

			<p>Se não estiver resgistado,<a href="register.php">Crie uma conta</a></p>
			<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
			<p>
				<label>
					Username
					<input type="text" name="username" required>
				</label>
			</p>
			<p>
				<label>
					Password
					<input type="password" name="password" required>
				</label>
			</p>
			<p>
				<input type="submit" name="submit" value="Enviar">
			</p>
			</form>
		</body>
</html>

<?php
	require_once "config.php";

	$query = $db->query("
		SELECT
			country_id,name
		FROM
			countries
	");
	$countries =array();
	while($result = $query->fetch_assoc()) {
		$countries[]=$result;
	}

	if(isset($_POST["submit"])){
		if(!empty($_POST["name"])&&
			!empty($_POST["email"])&&
			!empty($_POST["username"])&&
			!empty($_POST["password"])&&
			!empty($_POST["rep_password"])&&
			!empty($_POST["address"])&&
			!empty($_POST["city"])&&
			!empty($_POST["postal_code"])&&
			!empty($_POST["country_id"])&&
			strlen($_POST["username"])<=64 &&
			strlen($_POST["name"])<=128 &&
			strlen($_POST["address"])<=255 &&
			strlen($_POST["city"])<=128 &&
			strlen($_POST["postal_code"])<=128 &&
			$_POST["country_id"] <= count($countries)&&
			filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)
			){

			//sanitização classica
			foreach ($POST as $key => $value) {
				$_POST[$key]= $db->real_escape_string( iconv("utf-8", "utf-8", strip_tags(trim($value) )));
			}

			$query=$db->query("
				INSERT INTO users
				(username,password,name,email,address,city,postal_code,country_id)
				VALUES(
					'".$_POST["username"]."',
					'".password_hash($_POST["password"], PASSWORD_DEFAULT)."',
					'".$_POST["name"]."',
					'".$_POST["email"]."',
					'".$_POST["address"]."',
					'".$_POST["city"]."',
					'".$_POST["postal_code"]."',
					".(int)$_POST["username"].")");
			if($query !== false){
				header("Location:login.php");
				exit;
			}


		}
	}


?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Criar Conta</title>
		<script>
			window.onload=function() {
				var Form=document.getElementById("Form");
				Form.onsubmit=function() {
					if(Form.password.value!= Form.rep_password.value){
						alert("As passwors nao estão iguais");
						return false;
					}
				}

			}
		</script>
	</head>
		<body>


			<form id="Form" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
				<p>
				<label>
					Nome Completo
					<input type="text" name="name" required>
				</label>
			</p>
			<p>
				<label>
					Email
					<input type="email" name="email" required>
				</label>
			</p>
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
				<label>
					 Repeat Password
					<input type="password" name="rep_password" required>
				</label>
			</p>
			<p>
				<label>
					Address
					<input type="text" name="address" required>
				</label>
			</p>
			<p>
				<label>
					City
					<input type="text" name="city" required>
				</label>
			</p>
			<p>
				<label>
					Postal code
					<input type="text" name="postal_code" required>
				</label>
			</p>
			<p>
				<label>
					Country

					<select name="country_id">
<?php
foreach ($countries as $country) {



?>
						<option value="<?php echo $country["country_id"] ?>"><?php echo $country["name"]; ?></option>
<?php
}?>
					</select>

				</label>
			</p>
			<p>
				<input type="submit" name="submit" value="Enviar">
			</p>
			</form>
		</body>
</html>

<?php
require_once "/config.php";
if(!isset($_SESSION["colaborador_id"])){
	header("Location:login.php");
	exit;

}

if(isset($_POST["submit"])){
		$query=$conn->query("
		INSERT INTO noticias
		(titulo,texto,foto,data,categoria_id)
		VALUES(
		'".$_POST["titulo"]."',
		'".$_POST["texto"]."',
		'".$_POST["foto"]."',
		'".$_POST["data"]."',
		'".$_POST["categoria_id"]."'
		)
");

if($query === true){
		header("Location:news.php");
		exit;
}else {
    echo "Error: " . $conn . "<br>" . $conn->error;
}

}


 ?>
<!DOCTYPE html>

<html>
	<head>
	<meta charset="utf-8">
	<title>Manutenção de noticias</title>
	<link rel="stylesheet" href="style.css" media="screen"  >
	</head>
		<body>
				<div id="header">
					<h1>Jornal do dia</h1>
				</div>
				<div id="menu">
					<ul>
						<li>
							<a href="news.php">NOTICIAS</a>
						</li>
						<li id="logout1" >
							<a href="logout.php">Logout</a>
						</li>
						</ul>
					</div>
					<div id="placar">
					</div>
				<div id="form">
					<h1>Adicionar Noticia</h1>
						<form  action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
							<li>Titulo</li>
							<li><input type="text" name="titulo" ></li>
							<li>Descrição</li>
							<li><textarea cols="100" rows="4" name="texto" placeholder="descrição">
									</textarea></li>
							<li>Foto</li>
							<li><input type="file" name="foto" value="Foto"></li>
							<li>Data</li>
							<li><input type="datetime-local" name="data" value="Data"></li>
							<li>Categoria</li>
							<li><select name="categoria_id" value="Categorias">
							    <option value="1">Politica</option>
							    <option value="2">Economia</option>
							    <option value="3">Desporto</option>
							    <option value="4">Ciencia</option>
							    <option value="5">Cultura</option>
				  				</select>
							</li>
							<li><input type="submit" name="submit" value="submit"></li>
						</form>
				</div>
	</body>
</html>

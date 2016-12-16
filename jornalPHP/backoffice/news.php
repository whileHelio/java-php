<?php
require_once "config.php";

if(!isset($_SESSION["colaborador_id"])){
	header("Location:login.php");
	exit;
}

header('Content-Type: text/html; charset=ISO-8859-1');

$query=$conn->query("
		SELECT
		  colaborador_id,nome
		FROM
		  colaboradores
		WHERE
		  colaborador_id= " .(int)$_SESSION["colaborador_id"]. "
");

$colaboradores=array();

	  while($result = $query->fetch_assoc()) {
	    $colaboradores[] = $result;
	  }

$query=$conn->query("
		SELECT
		  noticia_id, titulo, texto, foto, data, categoria_id
		FROM
		  noticias
		WHERE
		  noticia_id
		ORDER BY
		  data
		DESC
");

$noticias=array();

	  while($result = $query->fetch_assoc()) {
	    $noticias[] = $result;
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
							<a href="add.php">ADICIONAR NOTICIA</a>
						</li>
						<li id="logout">
							<a href="logout.php">Logout</a>
						</li>
						</ul>
					</div>
					<div id="placar">
						<?php
						foreach ($colaboradores as $colaborador) {
						?>
						<p> Ola <?php echo $colaborador["nome"];  ?></p>
						<?php
						}
						 ?>
		      </div>


		 <?php
		 foreach ($noticias as $noticia) {
		  ?>
		 <div id="noticias">
			<img src="/jornalPHP/fotos/<?php echo $noticia["foto"]; ?>" alt="" style="height: 300px;">
		   <h1><?php echo $noticia["titulo"] ?></h1>
		  	<p id="text"><?php
		     $blah=explode(".",$noticia["texto"]);
		     $string= $blah[0];
		     echo $string;
		   ?></p>
		   <li><a href="delete.php?noticia_id=<?php echo $noticia["noticia_id"]; ?>">Eliminar</a></li>
		   <li><a href="update.php?noticia_id=<?php echo $noticia["noticia_id"]; ?>">Actualizar</a></li>
		 </div>
		 <?php
		 }
		  ?>
		</body>
</html>

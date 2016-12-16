<?php
require_once "/config.php";

header('Content-Type: text/html; charset=ISO-8859-1');

if(!isset($_SESSION["colaborador_id"])){
	header("Location:login.php");
	exit;

}


if(isset($_GET["noticia_id"])){
$query=$conn->query("
	SELECT
	  *
	FROM
	  noticias
	WHERE
	  noticia_id= " .(int)$_GET["noticia_id"]. "
");

$noticias=array();

  while($result = $query->fetch_assoc()) {
    $noticias[] = $result;
  }
}

if(isset($_POST["submit"])){

$query=$conn->query("
		UPDATE
		  noticias
		SET
		  titulo='".$_POST["titulo"]."',
		  texto='".$_POST["texto"]."',
		  foto='".$_POST["foto"]."',
		  data='".$_POST["data"]."',
		  categoria_id='".$_POST["categoria_id"]."'
		WHERE
		  noticia_id='".$_POST["noticia_id"]."'
");
	if($conn ===true){
			header("Location:news.php");
	  	exit;
	}else{
	    echo "Error updating record: " . $conn->error;
	}
}
 ?>

<!DOCTYPE html>

<html>
<head>
	<head>
	<meta charset="utf-8">
	<title>Actualizar noticia</title>
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
			<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
      	<?php foreach ($noticias as $noticia){ ?>
					<li>Titulo</li>
    			<li><input type="text" name="titulo" value="<?php echo $noticia["titulo"] ?>" ></li>
					<li>Descricao</li>
					<li><textarea  cols="50" rows="4" name="texto" >
      			<?php echo $noticia["texto"] ?>
    					</textarea></li>
					<li>Foto</li>
			    <li><input type="file" name="foto" value="<?php echo $noticia["foto"] ?>"></li>
					<li>Data</li>
					<li><input type="datetime-local" name="data"></li>
					<li>Categoria</li>
					<li><select name="categoria_id" >
			        <option value="1" <?php if ($noticia["categoria_id"]=='1'){echo ("selected");} ?>>Politica</option>
			        <option value="2" <?php if ($noticia["categoria_id"]=='2'){echo ("selected");} ?>>Economia</option>
			        <option value="3" <?php if ($noticia["categoria_id"]=='3'){echo ("selected");} ?>>Desporto</option>
			        <option value="4" <?php if ($noticia["categoria_id"]=='4'){echo ("selected");} ?>>Ciencia</option>
			        <option value="5" <?php if ($noticia["categoria_id"]=='5'){echo ("selected");} ?>>Cultura</option>
			      </select></li>
			        <li><input type="hidden" name="noticia_id" value="<?php echo $_GET["noticia_id"] ?>"></li>
			        <li><input type="submit" name="submit" value="submit"></li>
			      <?php } ?>
					</form>
			</div>
  </body>
</html>

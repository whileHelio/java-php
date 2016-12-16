<?php
require_once "config.php";

include"categoria.php";
header('Content-Type: text/html; charset=ISO-8859-1');

$query = $conn->query("
  SELECT
    noticia_id, titulo, texto, foto, data, categoria_id
  FROM
    noticias
  WHERE
    noticia_id
  ORDER BY
    data
  DESC LIMIT 0, 10
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
  <title>Inicio</title>
  <link rel="stylesheet" href="style.css" media="screen"  >
  </head>
    <body>
      <div id="header">
        <h1>Jornal do dia</h1>
      </div>
      <div id="menu">
        <ul>
          <?php
            foreach ($categorias as $categoria) {
           ?>
          <li>
            <a href="categorias.php?categoria_id=<?php echo $categoria["categoria_id"]; ?>"><?php echo strtoupper($categoria["nome"]); ?></a>
          </li>
          <?php
            }
           ?>
           <li id="colaborar">
             <a href="backoffice/index.php">Colaboradores</a>
           </li>
        </ul>
      </div>
       <div id="placar">
          </div>
      <?php
      foreach ($noticias as $noticia) {
       ?>
      <div id="noticias">
        <img src="fotos/<?php echo $noticia["foto"]; ?>" >
        <h1 ><a href="noticias.php?noticia_id=<?php echo $noticia["noticia_id"]; ?>"><?php echo $noticia["titulo"] ?></a></h1>
        <p id="text"><?php
          $blah=explode(".",$noticia["texto"]);
          $string= $blah[0];
          echo $string;
        ?></p>
      </div>

      <?php
      }
       ?>

      </body>
</html>

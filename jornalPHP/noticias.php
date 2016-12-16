<?php
require_once "config.php";

    include"categoria.php";
    header('Content-Type: text/html; charset=ISO-8859-1');

    $query = $conn->query("
      SELECT
        noticia_id, titulo, texto, foto, data
      FROM
        noticias
      WHERE
        noticia_id = " .(int)$_GET["noticia_id"]. "
    ");

    if( $query->num_rows > 0 ) {
      $noticia = $query->fetch_assoc();
    }
    else
      die("Erro, não existe");
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
        <h1><a href="index.php">Jornal do dia</a></h1>
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
      <div id=noticia>
        <h1><?php echo $noticia["titulo"] ?></h1>
        <img src="fotos/<?php echo $noticia["foto"]; ?>" alt="" >
        <p id="text"><?php echo $noticia["texto"];  ?></p>
      </div>

    </body>
</html>

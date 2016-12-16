<?php
require_once "config.php";

  include"categoria.php";

  header('Content-Type: text/html; charset=ISO-8859-1');

  $query = $conn->query("
    SELECT
      n.noticia_id, n.titulo, n.texto, n.foto, n.data, c.nome AS categoria
    FROM
      noticias AS n
    INNER JOIN
      categorias AS c USING(categoria_id)
    WHERE
      n.categoria_id = " .(int)$_GET["categoria_id"]. "
    ORDER BY
      n.data
    DESC LIMIT 0, 30
  ");

  $noticias = array();

    while($result = $query->fetch_assoc()) {
      $noticias[] = $result;
    }
?>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo $noticias[0]["categoria"]; ?></title>
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

  		<ul>
        <h1><?php echo strtoupper ($noticias[0]["categoria"]); ?></h1>
        <?php
  	     foreach($noticias as $noticia) {
           ?>
           <div id="noticias">
  			      <li>
                    <img src="fotos/<?php echo $noticia["foto"]; ?>" alt="" >
  				          <h1><a href="noticias.php?noticia_id=<?php echo $noticia["noticia_id"]; ?>"><?php echo $noticia["titulo"]; ?></a></h1>
                    <p><?php $blah1=explode(".",$noticia["texto"]); $string=$blah1[0]; echo $string; ?></p>
  			      </li>
            </div>
          <?php
          	}
          ?>
  		</ul>
  	</body>
</html>

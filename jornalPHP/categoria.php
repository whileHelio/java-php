<?php


$query = $conn->query("
  SELECT
    categoria_id, nome
  FROM
    categorias
  
");

$categorias = array();

while($result = $query->fetch_assoc()) {
  $categorias[] = $result;
}


 ?>

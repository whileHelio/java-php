<?php
    require_once "/config.php";

$query=$conn->query("
    DELETE FROM noticias WHERE noticia_id=" .(int)$_GET["noticia_id"]. "
");

if($conn ==true){
  header("Location:news.php");
  exit;
}else{
    echo "Error deleting record: " . $conn->error;
}

 ?>

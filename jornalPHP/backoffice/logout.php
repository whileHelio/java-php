<?php
session_start();
unset($_SESSION["colaborador_id"]);
header("Location:/jornalPHP/index.php");
 ?>

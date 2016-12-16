<?php
require_once "config.php";

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
if(isset($_POST["submit"])){


    foreach ($_POST as $key => $value) {
        $_POST[$key]= $conn->real_escape_string( iconv("utf-8", "utf-8", strip_tags(trim($value) )));
    }
		$query=$conn->query("
			SELECT
				colaborador_id,password,username
			FROM
				colaboradores
			WHERE
				username='".$_POST["username"]."'
				and
				password='".$_POST["password"]."'
			");

		if($query->num_rows>0){
			//verificar se password esta correcta
			$colaborador=$query->fetch_assoc();
			if($_POST["password"]==$colaborador["password"]&&$_POST["username"]==$colaborador["username"]){
				$_SESSION["colaborador_id"]=$colaborador["colaborador_id"];
				header("location:news.php");
			}else{
				die("password incorrecta");
			}

		}else{
			$error_msg="Utilizador não existente";
		}

 }
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="/jornalPHP/style.css" media="screen"  >
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
          <a href="/jornalPHP/categorias.php?categoria_id=<?php echo $categoria["categoria_id"]; ?>"><?php echo strtoupper($categoria["nome"]); ?></a>
        </li>
        <?php
          }
         ?>
       </div>
       <div id="placar">
         <h1>Pagina restrita a colaboradores do jornal</h1>
          </div>
      <form id="formulario" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <p>Username</p>
        <input type="text" name="username" ></br>
        <p>Password</p>
        <input type="password" name="password" ></br>
        <input id="submit" type="submit" name="submit" value="submit">
      </form>
    </body>
</html>

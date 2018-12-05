<?php 
require_once('funciones/funciones.php');

$id = null;
$nombre = null;
$apellidos = null;
$logged = true;


session_start();

$logged = false;

if(isset($_SESSION['usuario'])){

	//obtener datos de ese usuario de la base de datos
	$id = $_SESSION['usuario']['id'];

	$sql = "SELECT * FROM usuarios WHERE id =".$id."";
	$r = basedatos::ejecutarSQL($sql);

	if($r){
		$id = $res->id;
		$nombre = $res->nombre;
		$apellidos = $res->apellidos;
		$logged = true;
	}	
}
?>
<!DOCTYPE html>
<html>

	<head>
		<title>Prueba</title>
	</head>

	<body>
		<h1>Página principal</h1>
		<div>

			<p>Bienvenido, <?php echo ($logged== false)?'Invitado':$nombre." ".$apellidos ?></p>

			<a href="login.php">Iniciar sesión</a>
			<a href="registro.php">Registro</a>
			
		</div>

	</body>

</html>
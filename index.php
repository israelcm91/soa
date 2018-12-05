<?php 
require_once('funciones/funciones.php');

$id = null;
$nombre = null;
$apellidos = null;
$nivel = null;
$rol = null;
$logged = true;


session_start();

$logged = false;

if(isset($_SESSION['usuario'])){

	//obtener datos de ese usuario de la base de datos
	//aqui se podrian obtener datos tales como la puntuación con otra consulta...
	//de momento obtenemos el nivel para mostrarlo en el index de prueba...

	$id = $_SESSION['usuario']['id'];
	$conn = new mysqli($sn,$usr,$pw,$db);
	$sql = "SELECT * FROM usuarios WHERE id =".$id."";
	$r = $conn->query($sql);
	$row = $r->fetch_array(MYSQLI_ASSOC);
	mysqli_close($conn);

	if($r->num_rows == 1){
		$id = $row['id'];
		$nombre = $row['nombre'];
		$apellidos = $row['apellidos'];
		$nivel = $row['nivel'];
		$rol = $_SESSION['usuario']['rol'];
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

		<!-- Caja que contiene el mensaje de bienvenida, los botones de login, registro y logout !-->
		<div>

			<p>Bienvenido, <?php echo ($logged== false)?'Invitado':'['.$nivel.'] '.$nombre." ".$apellidos ?></p>
			<?php 
			if(!$logged){ ?>

					<a href="login.php">Iniciar sesión</a>
					<a href="registro.php">Registro</a>
			<?php }else{ ?>

					<a href="procesar/logout.php">Cerrar Sesión</a>

			<?php }
			?>
			
			
			
		</div>


		<div>
			<!-- Caja que contiene el mensaje de bienvenida, los botones de login, registro y logout !-->
			<div><a href="preguntas.php?nivel_p=1"><h1>Nivel 1</h1></a></div>
			<div><h1>Nivel 2</h1></div>
			<div><h1>Nivel 3</h1></div>
			<div><h1>Nivel 4</h1></div>
			<div><h1>Nivel 5</h1></div>
			<div><h1>Nivel 6</h1></div>
			<div><h1>Nivel 7</h1></div>
			<div><h1>Nivel 8</h1></div>
			<div><h1>Nivel 9</h1></div>
			<div><h1>Nivel 10</h1></div>
			
			
			
		</div>

	</body>

</html>
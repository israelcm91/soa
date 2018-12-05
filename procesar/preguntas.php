<?php 
require_once('funciones/funciones.php');

$id = null;
$nombre = null;
$apellidos = null;
$nivel = null;
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
		$rol = $rol = $_SESSION['usuario']['rol'];
		$logged = true;
	}	
}


if($logged){

			//si viene por get, el nivel de preguntas que hay que mostrar, lo almacenamos en una variable para su comodo uso
			if( isset($_GET['nivel_p']) && ( ($_GET['nivel_p']!="") || ($_GET['nivel_p']!=null) )){

				$nivel_p = $_GET['nivel_p'];

			//si llegamos a esta página sin el parametro de nivel, mandamos al index.
			}else{
				header("Location:index.php");
			}		



?>

<!DOCTYPE html>
<html>

	<head>
		<title>Preguntas</title>
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

			<?php
			//obtener preguntas del nivel elegido.

			$conn = mysqli_connect($sn,$usr,$pw,$db);
			$sql ="SELECT * FROM preguntas WHERE nivel =".$nivel_p;
			$r=$conn->query($sql);

			$num_preguntas = $r->num_rows;
			while($row = $r->fetch_assoc(MYSQLI_ASSOC)){
				$i = 1;
				$id_p = $row['id'];
				$pregunta_p = $row['pregunta'];
				$correcta_p = $row['correcta'];


				//mostramos la pregunta
				echo "<div>";

				echo "<p>";
				echo $pregunta;
				echo "</p>";

				//mostramos sus respuestas
				//limpiamos las variables de obtencion de resultados
				$row = null;
				$r = null;
				//hacemos una nueva consulta para obtener las respuestas asociadas a la pregunta
				$sql ="SELECT * FROM respuestas WHERE id_preg =".$id_p;
				$r=$conn->query($sql);

				$num_respuestas = $r->num_rows;
					while($row = $r->fetch_assoc(MYSQLI_ASSOC)){

						$id_r = $row['id'];						
						$respuesta_r = $row['respuesta'];
						echo "<p>";
						echo $i.") ";
						echo $respuesta_r;
						echo "</p>";

					}


				echo "</div>";

			}

		
			
		?>
			
		</div>

	</body>

</html>

<?php


}else{

	header("Location:index.php");
}

?>
<?php 
require_once('funciones/funciones.php');

session_start();

$logged = false;

if(isset($_SESSION['usuario'])){

	header('Location: index.php');

}else{


?>
<!DOCTYPE html>
<html>

	<head>
		<title>Prueba</title>
	</head>

	<body>

		<div>
			<h1>Formulario de inicio de sesión</h1>

			<?php if(isset($_GET['error'])){ ?>

				<div>
					<?php echo $_GET['error']?>

				</div>
				<br/>
			<?php
				}
			?>
			<div>
			</div>
			<form action="procesar/conectar.php" method="POST">

				<input type="email" name="email" placeholder="email@ejemplo.es"></input>
				<br/>
				<input type="password" name="password" placeholder="password"></input>
				<br/>
				<input type="submit" name="enviar" value="enviar"/>

			</form>
			
		</div>

	</body>

</html>


<?php

 }

?>
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
		<title>Registro</title>
	</head>

	<body>

		<div>
			<h1>Formulario de Registro</h1>

			<?php if(isset($_GET['error'])){ 
				$error = unserialize($_GET['error']);
				?>

				<div>
					<?php print_r($error)?>

				</div>
				<br/>
			<?php
				}
			?>
			<div>
			</div>
			<form action="procesar/registrar.php" method="POST">

				<input type="nombre" name="nombre" placeholder="Nombre"></input>
				<br/>
				<input type="apellidos" name="apellidos" placeholder="Apellidos"></input>
				<br/>
				<input type="email" name="email1" placeholder="Email (email@ejemplo.es)"></input>
				<br/>
				<input type="email" name="email2" placeholder="Repite email (email@ejemplo.es)"></input>
				<br/>
				<input type="password" name="password1" placeholder="Password"></input>
				<br/>
				<input type="password" name="password2" placeholder="Repite Password"></input>
				<br/>
				<input type="submit" name="enviar" value="Registrarse"/>

			</form>
			
		</div>

	</body>

</html>


<?php

 }

?>
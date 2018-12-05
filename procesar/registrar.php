<?php
require_once('../funciones/funciones.php');
session_start();

$error = array();

if(isset($_SESSION['usuario'])){
	header('Location:../index.php');

}else{

	if(isset($_POST['nombre']) && $_POST['nombre']!="") $nombre = $_POST['nombre'];
	else array_push($error,"El campo nombre no puede ser vacio");

	if(isset($_POST['apellidos']) && $_POST['apellidos']!="") $apellidos = $_POST['apellidos'];
	else array_push($error,"El campo apellidos no puede ser vacio");

	if(isset($_POST['email1']) && $_POST['email1']!="") $email1 = $_POST['email1'];
	else array_push($error,"El email1 no puede ser vacio");

	if(isset($_POST['email2']) && $_POST['email2']!="") $email2 = $_POST['email2'];
	else array_push($error,"El email2 no puede ser vacio");

	if(isset($_POST['password1']) && $_POST['password1']!="") $password1 = $_POST['password1'];
	else array_push($error,"El password1 no puede ser vacio");

	if(isset($_POST['password2']) && $_POST['password2']!="") $password2 = $_POST['password2'];
	else array_push($error,"El password2 no puede ser vacio");


	//si vino todo....
	if(empty($error)){

		//comprobamos que los emails coincicen...
		if($email1 == $email2) $email = $email1;

		else{
			array_push($error,'Los emails no coinciden');
			//print_r($error);
			header("Location: ../registro.php?error=".serialize($error));
		}

		//comprobamos que las contraseñas coinciden...
		if($password1 == $password2) $password = md5($password1);
		else{
			array_push($error,'Las passwords no coinciden');
			//print_r($error);
			header("Location: ../registro.php?error=".serialize($error));
		}
		
		
		//comprobamos que el email no existe en la base de datos
		$conn = new mysqli($sn,$usr,$pw,$db);
		$sql ="SELECT * FROM usuarios where email ='".$email."'";
		$r = $conn->query($sql);
		

		if($r->num_rows == 0){
			//debug
			echo "Se introduciran los siguientes datos";
			echo $nombre;
			echo $apellidos;
			echo $email;
			echo $password;
			//registramos el usuario en la base de datos;
			$sql = "INSERT INTO usuarios (nombre,apellidos,email,password) VALUES('".$nombre."','".$apellidos."','".$email."','".$password."')";
				if($conn->query($sql)){
					echo "Exito";
				}else{
					array_push($error,'Error al registrar al usuario en la base de datos.');
					//print_r($error);
					header("Location: ../registro.php?error=".serialize($error));
				}

				header("Location: ../index.php");

		}else{
			array_push($error,'El email ya está registrado en la base de datos.');
			//print_r($error);
			header("Location: ../registro.php?error=".serialize($error));

		}


	}else{
		//print_r($error);
		header("Location: ../registro.php?error=".serialize($error));
	}



}
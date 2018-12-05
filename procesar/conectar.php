<?php
require_once('../funciones/funciones.php');
session_start();

$error = null;

if(isset($_SESSION['usuario'])){
	header('Location:../index.php');

}else{

	if(isset($_POST['email']) && ($_POST['email']!= "")){

		if(isset($_POST['password']) && ($_POST['password']!= "")){


			//si viene email y contraseña, lo comprobamos contra la BD
			$email = $_POST['email'];
			$password = md5($_POST['password']);
			$conn = new mysqli($sn,$usr,$pw,$db);
			$sql = "SELECT * from usuarios WHERE email='".$email."' AND password ='".$password."'";

			$r = $conn->query($sql);
			$row = $r->fetch_array(MYSQLI_ASSOC);
			mysqli_close($conn);

			if($row->num_rows == 1){

				//registrar al usuario en sesion.
				$_SESSION["usuario"]["id"] = $r["id"];
				$_SESSION["usuario"]["nombre"] = $r["nombre"];
				$_SESSION["usuario"]["apellidos"] = $r["apellidos"];

				if($r->id==1)	$_SESSION["usuario"]["rol"] = "admin";
				else $_SESSION["usuario"]["rol"] = "user";




			}else{
				$error= "Combinación email/password incorrecta";
				header('Location:../login.php?error='.$error);
			}


		}else{

			$error="Password vacio";
			header('Location:../login.php?error='.$error);
		}

	}else{

		$error="Email vacio";
		header('Location:../login.php?error='.$error);
	}



}
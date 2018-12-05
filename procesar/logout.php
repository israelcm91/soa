<?php 

require_once('../funciones/funciones.php');

session_start();

	if(!isset($_SESSION['usuario'])){

			header("Location:../index.php");


	}else{
		session_unset();
		session_destroy();
		header("Location:../index.php");
	}

?>
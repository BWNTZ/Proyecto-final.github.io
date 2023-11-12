<?php
session_start();
	
	// ORIGINAL
	if(!isset($_SESSION['id_usuario'])){
		header("Location: index.php");
	}

	/* No necesario al estar al principio de cada codigo de cada pestaña
	if(isset($_SESSION['id_usuario'])) {
		header("Location: index.php");
		echo "<h3>Bienvenido ".$_SESSION['username'].". Has iniciado sesión con éxito!</h3><br/>";
		controlSesionUser();
	} else {
		echo "<h3>Ninguna sesión iniciada.</h3><br/>";
	}*/
	
	function controlSesionAdmin(){
		if($_SESSION['tipo_usuario'] != 0){
			header("Location: index.php");
		}
	}
	
	function controlSesionUser(){
		if($_SESSION['tipo_usuario'] != 1){
			header("Location: index.php");
		}
	}
?>

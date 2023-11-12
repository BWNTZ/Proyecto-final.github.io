<?php
require_once("control_sesion.php");
require_once("database.php");
	
	controlSesionAdmin();
	//si no se utiliza request en admin.php se cambia linea 7 por esta: <form method='post' action='".$_SERVER['PHP_SELF']."'>
	echo "<div'><form method='post' action='admin.php?accion=crear_usuario'>
		<strong>Nombre del usuario: </strong><input type='text' name='username'><br/><br/>
		<strong>Contraseña: </strong><input type='password' name='password'><br/><br/>
		<strong>Tipo de usuario: </strong><select name='tipo_usuario'>
			<option value='0'>Admin</option>
			<option value='1'>User</option>
		</select>
		<br/><br/><input type='submit' name='crear' value='Crear' class='boton-entrar'>
		</form><br/>
		</div>";
	
	if(isset($_POST['crear'])){
		if(empty($_POST['username']) || empty($_POST['password'])){
			echo "<p style='text-align:center; color:red;'><strong> Debes rellenar todos los campos</strong></p>";
		}
		else{
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
			insertarUsuario($_POST['username'], $password, $_POST['tipo_usuario']);
			header("Location: admin.php");
		}
	}

	//si no se utiliza request en admin.php hay que activar estas lineas: 
	//echo "<br/><a href='admin.php'>Volver</a>";
	//cerrarConexion();
?>

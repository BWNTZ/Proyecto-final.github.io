<?php
	require_once("control_sesion.php");
	require_once("database.php");
		
	controlSesionAdmin();
		
	$usuario = obtenerUsuario($_GET['edit']);
			
	if($usuario == 0){
		header("Location: admin.php");
		
	} 
	else{
				
		$_SESSION['id_usuario_update'] = $usuario['id_usuario'];
		
		echo "<br/><form class='letraUsual' method='post' action='#'>
			<strong>Nombre del usuario: </strong><input type='text' name='username' value='".$usuario['nombre']."'><br/>
			<strong>Nombre y Apellidos: </strong><input type='text' name='nombre_r' value='".$usuario['nombre_r']."'><br/>
			<strong>Nueva Contraseña: </strong><input type='password' name='password'><br/>
			<strong>Teléfono: </strong><input type='text' name='telefono' value='".$usuario['telefono']."'><br/>
			<strong>Email: </strong><input type='text' name='email' value='".$usuario['email']."'><br/>
			<strong>Dirección: </strong><input type='text' name='direccion' value='".$usuario['direccion']."'><br/>
			<strong>Tipo de usuario: </strong><select name='tipo_usuario'>";

			if($usuario['tipo_usuario']==0){
				echo "<option value='0' selected>Admin</option>
					<option value='1'>User</option>";

			}else{
				echo "<option value='0'>Admin</option>
					<option value='1' selected>User</option>";
			}

		echo "</select></br><strong>Usuario comprador/vendedor: </strong><select name='comprador_vendedor'>";

			if($usuario['comprador_vendedor']==0){
				echo "<option value='0' selected>Comprador</option>
					<option value='1'>Vendedor</option>";

			}else{
				echo "<option value='0'>Comprador</option>
					<option value='1' selected>Vendedor</option>";
			}
		echo "</select>
		</br></br><input type='submit' name='editar' value='Editar' class='boton-entrar'>
		</form>";
			
		if(isset($_POST['editar'])){
			if(/*empty($_POST['username']) ||*/ empty($_POST['password']) /*|| empty($_POST['nombre_r']) || empty($_POST['telefono']) || !validarTelefono($_POST['telefono']) || empty($_POST['direccion'])*/){
				echo "</br><p class='negritaRojo'>La contraseña no puede quedar vacía</p>";
			}
			else if(!empty($_POST['telefono']) && !validarTelefono($_POST['telefono'])){
						echo "</br><p class='negritaRojo'>El teléfono ingresado no es válido</p>";
			}
			else if(!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
					echo "</br><p class='negritaRojo'>El email ingresado no es válido</p>";
			}
			else if(!empty($_POST['nombre_r']) && !validarNombreApellido($_POST['nombre_r'])){
					echo "</br><p class='negritaRojo'>Nombre y Apellido no pueden contener números o simbolos extraños</p>";
			}
			else{ 
			$pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
			modificarUsuario($_SESSION['id_usuario_update'], $_POST['username'], $_POST['nombre_r'], $pass, $_POST['tipo_usuario'], $_POST['telefono'], $_POST['email'], $_POST['direccion'], $_POST['comprador_vendedor']);
			unset($_SESSION['id_usuario_update']);
			header("Location: admin.php");
			}
		}
	}
	//cerrarConexion($con);
?>

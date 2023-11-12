<?php
	$server = "localhost";
	$user = "root";
	$pass = "";
	$db = "ProyectoFinal";

	$con = mysqli_connect($server, $user, $pass, $db) or die ("Error al conectar con la base de datos");
	
	function login($username, $password){
		$result = mysqli_query($GLOBALS["con"], "SELECT * FROM usuario WHERE nombre='$username';");
		if (mysqli_num_rows($result)==1) {
            $usuario = mysqli_fetch_array($result);
            if (password_verify($password, $usuario['pass'])) {
                return $usuario;
            }else{
                return 0;
            }
        }else{
            return 0;
        }
	}
	
	function cerrarConexion(){
		mysqli_close($GLOBALS["con"]);
	}
	
	///////////////////////////////////////////////////////////
	////////////////// FUNCIONES DE USUARIOS //////////////////
	///////////////////////////////////////////////////////////
	
	//Devuelvo un array con los datos de todos los usuarios
	function listarUsuarios(){
		$result = mysqli_query($GLOBALS["con"], "SELECT * FROM usuario;");
		$usuarios = array();
		while($fila = mysqli_fetch_array($result)){
			$usuarios[] = $fila;
		}
		return $usuarios;
	}
	
	function insertarUsuario($nombre, $pass, $tipo_usuario){
		mysqli_query($GLOBALS["con"], "INSERT INTO usuario(nombre, pass, tipo_usuario) VALUES('$nombre', '$pass', $tipo_usuario);");
	}
	
	function obtenerUsuario($id_usuario){
		$resultado = mysqli_query($GLOBALS["con"], "SELECT * FROM usuario WHERE id_usuario=$id_usuario;");
		if(mysqli_num_rows($resultado)==0){
			return 0; //Si no existe el usuario devuelvo 0
			//return array();
		}
		else{
			$usuario = mysqli_fetch_array($resultado);
			return $usuario;//Si existe el usuario devuelvo un array con sus datos
		}
	}
	
	function modificarUsuario($id_usuario, $nombre, $nombre_r, $pass, $tipo_usuario, $telefono, $email, $direccion, $comprador_vendedor){
		mysqli_query($GLOBALS["con"], "UPDATE usuario SET nombre='$nombre', nombre_r='$nombre_r', pass='$pass', tipo_usuario=$tipo_usuario, telefono='$telefono', email='$email', direccion='$direccion', comprador_vendedor=$comprador_vendedor WHERE id_usuario=$id_usuario;");
	}

	function modificarUsuarioCliente($id_usuario, $nombre, $nombre_r, $pass, $telefono, $email, $direccion, $tarjeta, $cuenta_banco){
		mysqli_query($GLOBALS["con"], "UPDATE Usuario SET nombre='$nombre', nombre_r='$nombre_r', pass='$pass', telefono='$telefono', email='$email', direccion='$direccion', tarjeta='$tarjeta', cuenta_banco='$cuenta_banco' WHERE id_usuario=$id_usuario;");
	}
	
	function borrarUsuario($id_usuario){
		mysqli_query($GLOBALS["con"], "DELETE FROM usuario WHERE id_usuario=$id_usuario;");
	}
	
	///////////////////////////////////////////////////////////
	////////////////// FUNCIONES DE DATOS PERSONALES //////////
	///////////////////////////////////////////////////////////

	function validarTelefono($telefono) {
		$patron = "/^[6|7|8|9][0-9]{8}$/"; 
		return preg_match($patron, $telefono);
	  }
	  
	function validarNombreApellido($nombre_r) {
		$NombreApellidoCorrecto = "/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/"; 
		return preg_match($NombreApellidoCorrecto, $nombre_r);
	}

	function validarCuentaBancaria($cuenta_banco) {
		$patron = "/^(es|ES)\d{2}\s?\d{4}\s?\d{4}\s?\d{2}\s?\d{10}$/i";
		return preg_match($patron, $cuenta_banco);
	}

	function validarTarjeta($tarjeta) {
		$patron = "/^\d{4}\s?\d{4}\s?\d{4}\s?\d{4}$/";
		return preg_match($patron, $tarjeta);
	}
	

	///////////////////////////////////////////////////////////
	////////////////// FUNCIONES DE PRODUCTOS /////////////////
	///////////////////////////////////////////////////////////
	
	function insertaProducto($nombre, $categoria, $precio, $descripcion, $resenia, $vendedor){
		$con = mysqli_connect("localhost", "root", "", "ProyectoFinal");
		$query = "INSERT INTO producto (nombre, id_categoria, precio, descripcion, resenia, vendedor) VALUES ('$nombre', '$categoria', '$precio', '$descripcion', '$resenia', '$vendedor')";
		mysqli_query($con, $query);
		mysqli_close($con);
		return "Todo OK!";
	}

	function listaCategorias(){
		$misCategorias = array();	
		$con = mysqli_connect("localhost", "root", "", "ProyectoFinal");
		$query = "SELECT id_categoria, nombre FROM categoria";
		$categorias = mysqli_query($con, $query);
		while($categoria = mysqli_fetch_assoc($categorias)){
			$misCategorias[] = $categoria;
		}
		mysqli_close($con);
		return $misCategorias;
	}

	function listaProductos($categoria){
		$misProductos = array();
		$con = mysqli_connect("localhost", "root", "", "ProyectoFinal");
		$query = "SELECT id_producto, nombre FROM producto WHERE id_categoria = $categoria";
		$productos = mysqli_query($con, $query);
		while($producto = mysqli_fetch_assoc($productos)){
			$misProductos[] = $producto;
		}
		mysqli_close($con);
		return $misProductos;
	}

	function listaDeProductos($categoria,$precio){
		$misProductos = array();
		$con = mysqli_connect("localhost", "root", "", "ProyectoFinal");
		$query = "";
		if($precio == "menor5"){
			$query = "SELECT producto.id_producto, producto.nombre, producto.precio, producto.descripcion, producto.resenia, producto.vendedor, categoria.nombre as categoria 
					  FROM producto 
					  INNER JOIN categoria ON producto.id_categoria=categoria.id_categoria 
					  WHERE categoria.id_categoria = $categoria AND producto.precio < 5";
		}
		else if($precio == "5a10"){
			$query = "SELECT producto.id_producto, producto.nombre, producto.precio, producto.descripcion, producto.resenia, producto.vendedor, categoria.nombre as categoria 
					  FROM producto 
					  INNER JOIN categoria ON producto.id_categoria=categoria.id_categoria 
					  WHERE categoria.id_categoria = $categoria AND producto.precio >= 5 AND producto.precio <= 10";
		}
		else if($precio == "mayor10"){
			$query = "SELECT producto.id_producto, producto.nombre, producto.precio, producto.descripcion, producto.resenia, producto.vendedor, categoria.nombre as categoria 
					  FROM producto 
					  INNER JOIN categoria ON producto.id_categoria=categoria.id_categoria 
					  WHERE categoria.id_categoria = $categoria AND producto.precio > 10";
		}
		if ($query == "") {// si ninguna de las condiciones son asignadas el query queda vacío
			return $misProductos; 
		}
		$productos = mysqli_query($con, $query);
		while($producto = mysqli_fetch_assoc($productos)){
			$misProductos[] = $producto;
		}
		mysqli_close($con);
		return $misProductos;
	}
	
	//Devuelvo un array con los datos de todos los productos
	function listarProductos(){
		$result = mysqli_query($GLOBALS["con"], "SELECT producto.id_producto, producto.nombre, categoria.nombre as categoria FROM producto INNER JOIN categoria ON producto.id_categoria=categoria.id_categoria;");
		$productos = array();
		while($fila = mysqli_fetch_array($result)){
			$productos[] = $fila;
		}
		return $productos;
	}

	function borrarProducto($codigos){
		global $con;
		$query = "DELETE FROM producto WHERE id_producto in (";
		foreach($codigos as $codigo){
			$query = $query.$codigo.", ";
		}
		$query = $query."0)";
		$con->query($query);
	}

	function verProductos(){
		$result = mysqli_query($GLOBALS["con"], "SELECT producto.id_producto, producto.nombre, producto.precio, producto.descripcion, producto.vendedor, producto.resenia, categoria.nombre as categoria FROM producto INNER JOIN categoria ON producto.id_categoria = categoria.id_categoria;");
		$productos = array();
		while($producto = mysqli_fetch_array($result)){ 
			$productos[] = $producto;
		}
		return $productos;
	}

	function buscaProductosporID($id_producto){
		$result = mysqli_query($GLOBALS["con"], "SELECT id_producto, precio, vendedor FROM producto WHERE id_producto=$id_producto;");
		$productos = array();
		while($producto = mysqli_fetch_array($result)){ 
			$productos[] = $producto;
		}
		return $productos;
	}

	function obtenerProducto($id_producto){
		$resultado = mysqli_query($GLOBALS["con"], "SELECT * FROM producto WHERE id_producto=$id_producto");
		if(mysqli_num_rows($resultado)==0){
			return 0; 
			//return array();
		}
		else{
			$producto = mysqli_fetch_array($resultado);
			return $producto;
		}
	}

	function modificarProducto($id_producto, $nombre, $id_categoria, $precio, $descripcion, $resenia, $vendedor){
		mysqli_query($GLOBALS["con"], "UPDATE producto SET nombre='$nombre', id_categoria='$id_categoria', precio='$precio', descripcion='$descripcion', resenia='$resenia', vendedor='$vendedor' WHERE id_producto=$id_producto");
	}
	

	/*
	function modificarProducto($id_producto, $nombre, $categoria, $precio, $descripcion, $resenia, $vendedor){
		mysqli_query($GLOBALS["con"], "UPDATE producto SET nombre='$nombre' WHERE id_producto=$id_producto");
	}// , categoria='$categoria', precio='$precio', descripcion='$descripcion', resenia='$resenia', vendedor='$vendedor'
*/

	///////////////////////////////////////////////////////////
	////////////////// FUNCIONES DE COMPRAS////////////////////
	///////////////////////////////////////////////////////////

	function insertaCompra($id_usuario,$hora_actual){
		
		$query = "INSERT INTO compras (id_usuario,hora) VALUES ('$id_usuario','$hora_actual');";
		mysqli_query($GLOBALS["con"], $query);
		
		return "Todo OK!";
	}

	function obtenerIdCompra($id_usuario,$hora_actual){
		$query = "SELECT id_compra FROM compras WHERE id_usuario=$id_usuario and hora='$hora_actual';";
		$result = mysqli_query($GLOBALS["con"], $query);
		$row = mysqli_fetch_assoc($result);
		return $row['id_compra'];
	
	}

	function insertaProductosComprados($id_compra, $id_producto, $precio_cantidad, $cantidad, $vendedor){
		
		$query = "INSERT INTO productos_comprados (id_compra, id_producto, precio_cantidad, cantidad, vendedor) VALUES ('$id_compra','$id_producto','$precio_cantidad','$cantidad','$vendedor');";
		mysqli_query($GLOBALS["con"], $query);
		
		return "Todo OK!";
	}

	function aniadeProductoEnCompra($id_compra, $productos_comprados) {
		foreach ($productos_comprados as $producto) {
			$id_producto = $producto['id_producto'];
			$cantidad = $producto['cantidad'];
			$precio_cantidad = $producto['precio_cantidad'];
			$vendedor = $producto['vendedor'];
			insertaProductosComprados($id_compra, $id_producto, $precio_cantidad, $cantidad, $vendedor);
		}
	}


	////////////////////////////////////////////////////////
	///////////////////// HISTORIAL ////////////////////////
	////////////////////////////////////////////////////////

	function mostrarProductosComprados($id_usuario,$id_compra) {
		$query = "SELECT c.id_compra, c.id_usuario, c.fecha, c.hora, prod_comp.id_producto, prod_comp.precio_cantidad, prod_comp.cantidad, producto.nombre
				FROM compras c 
					INNER JOIN productos_comprados prod_comp ON c.id_compra = prod_comp.id_compra
					INNER JOIN producto ON prod_comp.id_producto = producto.id_producto
						WHERE c.id_usuario = $id_usuario AND prod_comp.id_compra = $id_compra;";
		$resultado = mysqli_query($GLOBALS["con"], $query);
		$productos = array();
		while ($fila = mysqli_fetch_assoc($resultado)) {
			$productos[] = $fila;
		}
		return $productos;
	}
	
	function obtenerResenia($id_usuario,$id_compra){
		$query = "SELECT resenia FROM resenia WHERE id_usuario=$id_usuario AND id_compra=$id_compra;";
		$resultado = mysqli_query($GLOBALS['con'],$query);
		$resenia = mysqli_fetch_array($resultado);
		return $resenia;
	}

	function insertarResenia($id_usuario,$id_compra,$resenia){

		$query = "INSERT INTO resenia(id_compra, id_usuario, resenia) VALUES ('$id_compra','$id_usuario','$resenia');";
		$resultado = mysqli_query($GLOBALS['con'],$query);
	}

	function obtieneComprasDelusuario($id_usuario){

		$query = "SELECT * FROM compras WHERE id_usuario=$id_usuario;";
		$resultado = mysqli_query($GLOBALS["con"],$query);

		$compras = array();
		$i=1;

		while ($fila = mysqli_fetch_array($resultado)) {
			$compras[] = $fila;

			foreach($compras as $compra){
				$id_compra = $compra['id_compra'];
				$fecha = $compra['fecha'];
				$hora = $compra['hora'];
			}

			echo $i."º Compra ---- Fecha: $fecha Hora: $hora</br></br>";
			echo "<table border='1'>
					<tr><th>PRODUCTO</th><th>CANTIDAD</th><th>PRECIO/CANTIDAD</th></tr>";

			$productos = mostrarProductosComprados($id_usuario,$id_compra);
			
			$total=0;

			foreach($productos as $producto){

				$id_producto = $producto['id_producto'];
				$cantidad = $producto['cantidad'];
				$precio_cantidad = $producto['precio_cantidad'];
				$nombre = $producto['nombre'];
				$total += $precio_cantidad;
				echo "<tr><td>$nombre</td><td>$cantidad</td><td>$precio_cantidad €</td></tr>";
			}

			echo "<tr><td colspan='3'>PRECIO TOTAL: $total €</td></table></br>";
			$i++;

			if(obtenerResenia($id_usuario,$id_compra)){

				$resenia = obtenerResenia($id_usuario,$id_compra);
				$resenia = $resenia['resenia'];
				echo "<div>
					<p>Tu reseña de la compra: $resenia</p>
				</div>";

			}else{
				
				echo "<div><form method='POST' action='#'>
							<label for='mensaje' >Añade una reseña de los productos: </label>
							<textarea name='mensaje".$id_compra."' id='mensaje' cols='30' rows='5'></textarea></br>
							<input type='submit' name='enviar".$id_compra."' value='Enviar'>
						</form>
				</div></br>";
					
				if(isset($_POST['enviar'.$id_compra])){
					$resenia = $_POST['mensaje'.$id_compra];
							
					insertarResenia($id_usuario,$id_compra,$resenia);
					header("Location: historial.php");
				}
			}
		}
		return $compras;
	}

	function obtieneProductosDeLaVenta($id_venta,$vendedor){
		
		$query = "SELECT producto.nombre, compras.fecha, compras.hora, productos_comprados.precio_cantidad, productos_comprados.cantidad, usuario.nombre as nombre_usu, resenia.resenia
			FROM compras 
				JOIN productos_comprados ON compras.id_compra = productos_comprados.id_compra
				JOIN producto ON productos_comprados.id_producto = producto.id_producto
				JOIN usuario ON compras.id_usuario = usuario.id_usuario
				LEFT JOIN resenia ON compras.id_compra = resenia.id_compra
					WHERE compras.id_compra = '$id_venta'AND productos_comprados.vendedor='$vendedor';";
		
		$resultado = mysqli_query($GLOBALS['con'],$query);
		
		$productos_venta = array();

		while($fila = mysqli_fetch_array($resultado)){
			$productos_venta[]= $fila;
		}
		
		return $productos_venta;

	}

	function obtieneVentasDelUsuario($id_usuario){
		$query = "SELECT id_compra, vendedor FROM productos_comprados WHERE vendedor='$id_usuario' GROUP BY id_compra;";
		$resultado = mysqli_query($GLOBALS['con'],$query);
		
		if (!$resultado) {
			die('Error en la consulta SQL: ' . mysqli_error($GLOBALS['con']));
		}
		
		$ventas = array();
		$i=1;

		while($fila= mysqli_fetch_array($resultado)){
			 
			$ventas[] = $fila;

			foreach($ventas as $venta){
				$id_venta = $venta['id_compra'];
				$vendedor = $venta['vendedor'];
			}

			$productos_venta = obtieneProductosDeLaVenta($id_venta,$vendedor);

			foreach($productos_venta as $producto_venta){
				$fecha = $producto_venta['fecha'];
				$hora = $producto_venta['hora'];
				$nombre_usu = $producto_venta['nombre_usu'];
			}

			echo $i."º Venta </br> Nombre del comprador: $nombre_usu ---- Fecha: $fecha ---- Hora: $hora </br></br>";

			echo "<table 'border='1' id='tablacompra$i'>
				<tr><th>PRODUCTO</th><th>CANTIDAD</th><th>PRECIO/CANTIDAD</th></tr>";

			
			$total = 0;
			foreach($productos_venta as $producto_venta){

				$nombre = $producto_venta['nombre'];
				$precio_cantidad = $producto_venta['precio_cantidad'];
				$cantidad = $producto_venta['cantidad'];
				$nombre_usu = $producto_venta['nombre_usu'];
				$resenia = $producto_venta['resenia'];
				$total += $precio_cantidad;

				if(!$resenia){
					$resenia = 'No hay reseñas.';
				}
				
				echo "<tr><td>$nombre</td><td>$cantidad</td><td>$precio_cantidad €</td></tr>";
				
			}
			
			echo "<tr><td colspan='3'>PRECIO TOTAL: $total €</td></tr></table></br>";
			
			// if(!$resenia){
			// 	//$resenia = 'No hay reseñas.';
			// }else{
			// 	echo "<div><p>Reseña del usuario: $resenia</p></div></br></br>";
			// }
			if($resenia){
				echo "<div><p>Reseña del usuario: $resenia</p></div></br></br>";
			}

			/*
			echo "<script>
				// Obtener la tabla y la celda de la columna 'RESEÑA'
				var tabla = document.getElementById('tablacompra$i');
				var celdaResenia = tabla.rows[1].cells[3];
	
				// Crear la nueva celda
				var nuevaCelda = document.createElement('td');
				nuevaCelda.setAttribute('rowspan', '2');
				nuevaCelda.innerHTML = 'Hola';
	
				// Agregar la nueva celda a la celda de la columna 'RESEÑA'
				celdaResenia.appendChild(nuevaCelda);
			  </script>";
			*/

			$i++;
		}
		return $ventas;
	}



	// function obtenerIdCompra(){	
	// 	$query =  mysqli_query($GLOBALS["con"], "SELECT * FROM compras WHERE nombre='$username'");
	// 	mysqli_query($GLOBALS["con"], $query);
	// 	mysqli_close($GLOBALS["con"]);
	// 	return "Todo OK!";
	// }
	
?>


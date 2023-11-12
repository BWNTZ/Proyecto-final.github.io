<html>
  <head>
        <title>Nature's Food LTD. Productos y Transacciones.</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<!--<link href="style.css" rel="stylesheet" type="text/css" />-->
  </head>
  <body>
	<nav>
	<div class="izqda"><img src="images/logo-grand-naturefood-copy.png" width="450px" class="logo">
            <?php
                session_start();
                require_once("database.php");

                if(isset($_SESSION['id_usuario'])) {
                    if ($_SESSION['tipo_usuario'] == 0){
                         echo "
                        <h3 style='text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);'><img src='images/avatar.png'> Bienvenido ".$_SESSION['username'].". Has iniciado sesión con éxito como administrador!</h3>";
                    } else{
                        echo "<h3 style='text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);'><img src='images/avatar.png'> Bienvenido ".$_SESSION['username'].". Has iniciado sesión con éxito!</h3>";
                    }	
                    /*--------------- Logout --------------->*/
                    echo "</br><a href='logout.php' class='boton-cerrar-sesion'>Cerrar sesión</a></br>";	
                } else {
                    echo "<h3 style='text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);'>Ninguna sesión iniciada.</h3><br/>";
                }
            ?> 
		</div>	
        <ul class="drcha">
            <div class="nav1">
                <li><a href="index.php">Inicio</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="nosotros.php">Acerca de nosotros</a></li>
                <li><a href="faq.php">F.A.Q.</a></li>
                <li><a href="contacto.php">Contacto</a></li>
            </div>
            <div class="nav2">
            <?php
                if(isset($_SESSION['id_usuario']) && $_SESSION['tipo_usuario'] == 0) {
                     echo '<li><a href="admin.php">Configuración Administrador</a></li>';
                } else if (isset($_SESSION['id_usuario']) && $_SESSION['tipo_usuario'] == 1){
                    echo '<li><a href="transacciones.php">Transacciones</a></li>
                        <li><a href="historial.php">Historial</a></li>
                        <li><a href="perfil.php">Perfil</a></li>';
                    }
                ?> 
            </div> 
        </ul>
    </nav>	
	<main>
		<section class="centrar">
			<h3 class="amarillo">Organic is The Future</h3></br>
			<h2 class="verde">Nature´s Food</h2></br></br>
			</br><p class="letraUsual colorDegradiant" style="font-size: 30px;"><strong>Busca productos por categoria y precio en nuestro stock:</strong></p></br>
			<div class="busqueda">
				<?php
					////este codigo esta duplicado en gestion de productos
					$listaCategorias = listaCategorias($_SESSION['id_usuario']);


					echo "<form class='formBusqueda' method='POST' action='".$_SERVER['PHP_SELF'] . "'>
							<div class='labelInput'>Selecciona la categoría:</div><select name='categoria' cass='Inputs'>";

					foreach($listaCategorias as $categoria) {
						$array = json_decode(json_encode($categoria), true);
						echo "<option value='".$array['id_categoria']."'>".$array['nombre']."</option>";
					}

					echo "<select><br/>Selecciona el rango de precios:</br>
					<input type='radio' name='precio' value='menor5' ><label class='labelInput-A'>Menor de 5€</label>
					<input type='radio' name='precio' value='5a10' ><label class='labelInput-A'>5€ a 10€</label>
					<input type='radio' name='precio' value='mayor10' ><label class='labelInput-A'>Mayor de 10€</label><br/>
					</select>";

					echo "</select><br/>
							<input type='submit' class='boton-entrar' name='buscar' value='Buscar'/>
						</form><br/>";


					if(isset($_POST['buscar'])){
						$categoria = $_POST['categoria'];
						$precio = isset($_POST['precio']) ? $_POST['precio'] : '';
						//$precio = $_POST['precio'];
						$listaProductos = listaDeProductos($categoria, $precio); 
						if ($precio == ''){
							echo "<p class='negritaRojo'>Selecciona un rango de precios.</p>";
						}
						else if(count($listaProductos)==0){
							echo "<p class='negritaRojo'>No hay productos disponibles con las características seleccionadas.</p>";
						}
						else{
							echo "<form class='estiloTabla' method='POST' action='".$_SERVER['PHP_SELF']."'>
							<table border='1'>
									<tr>
										<td>ID</td>
										<td>NOMBRE DEL PRODUCTO</td>
										<td>CATEGORÍA</td><td>PRECIO</td>
										<td>DESCRIPCIÓN</td>
										<td>RESEÑA MÁS DESTACADA</td>
										<td>VENDEDOR</td>
										<td>CANTIDAD DESEADA</td></tr>";
							foreach($listaProductos as $producto){
								$array = json_decode(json_encode($producto), true);
								echo "<tr><td>".$array['id_producto']."</td><td>".$array['nombre']."</td><td>".$array['categoria']."</td><td>".$array['precio']."</td><td>".$array['descripcion']."</td><td>".$array['resenia']."</td><td>".$array['vendedor']."</td>
								<td><input type='number' name='cantidad[".$array['id_producto']."]' min='0' value='0'></td></tr>";
							};
							echo "</table></br><input type='submit' class='boton-entrar' name='compra' value='Comprar'><br/><br/></form>";       
						}
					} 
				?>
			</div>
		</section>

		<div><img src="images/10.jpeg" alt="" /></div>

		<section class="centrar">
			</br><p class="letraUsual colorDegradiant" style="font-size: 30px;"><strong>Mira la lista completa de todos nuestros productos:</strong></p></br>
			<?php  // Mostrar la tabla de productos completa
			echo "<form class='estiloTabla' method='POST' action='".$_SERVER['PHP_SELF'] . "'>
			<input type='submit' class='boton-entrar' name='mostrar' value='Mostrar'/><br/>";

			if(isset($_POST['mostrar'])){
				$verProducto = verProductos();
				
				if(count($verProducto) == 0) {
					echo "<p class='negritaRojo'>No hay productos disponibles en la base de datos.</p>";
				} else {
					echo "<table border='1'>
							<tr><td>ID</td><td>NOMBRE DEL PRODUCTO</td><td>CATEGORÍA</td><td>PRECIO</td><td>DESCRIPCIÓN</td><td>RESEÑA MÁS DESTACADA</td><td>VENDEDOR</td><td>CANTIDAD DESEADA</td></tr>";
					foreach($verProducto as $producto){
						echo "<tr><td>".$producto['id_producto']."</td><td>".$producto['nombre']."</td><td>".$producto['categoria']."</td><td>".$producto['precio']."</td><td>".$producto['descripcion']."</td><td>".$producto['resenia']."</td><td>".$producto['vendedor']."</td>
						<td><input type='number' name='cantidad[".$producto['id_producto']."]' min='0' value='0'></td></tr>";
					};		
					echo "</table></br><input type='submit' class='boton-entrar' name='compra' value='Comprar'>";
				}
			}
			echo "<br/><br/></form>";
			
			// Procesar la compra
			if(isset($_POST['compra'])) {						
				$cantidad = $_POST['cantidad'];
				$subtotal = 0;
				$productos_comprados = array();
				$i=0;
				
				foreach ($cantidad as $id_producto => $cantidad_deseada) {
					if($cantidad_deseada > 0) {					
						$producto = buscaProductosporID($id_producto);
						$precio = $producto[0]['precio'];
						$subtotal = $cantidad_deseada * $precio;
						$vendedor = $producto[0]['vendedor'];
						$productos_comprados[] = array(
							'id_producto' => $id_producto,
							'cantidad' => $cantidad_deseada,
							'precio_cantidad' => $subtotal,
							'vendedor' => $vendedor,
						);
						$i++;
					}	
				}
				
				if($i == 0){
					echo "<p class='negritaRojo'>Debes indicar la cantidad que deseas comprar.</p>";
				}else{
					$_SESSION['productos_comprados'] = $productos_comprados;			
					header("Location: compra.php");
				}
			}

			//MUESTRA FORMULARIO INGRESAR PRODUCTO SI ES VENDEDOR
			$usuario = obtenerUsuario($_SESSION['id_usuario']);
			if($usuario['comprador_vendedor'] == 1){

				require_once("vendedor.php");
				
			}

			cerrarConexion();
			?>					
		</section>
	</main>



	<!--------------- Codigo original abajo, el de arriba es para seguir mejorando --------------->


<!--        <div id="content">
			<div><img src="images/10.jpeg" alt="" /></div>
			<div id="colTwo">
-->
				<!--------------- Buscar productos --------------->
<!--						
				<h2></br></br>Busca productos por categoria y precio en nuestro stock:</h2></br>	
-->				<?php

					////este codigo esta duplicado en gestion de productos
/*				$listaCategorias = listaCategorias($_SESSION['id_usuario']);


					echo "<form method='POST' action='".$_SERVER['PHP_SELF'] . "'>
							Selecciona la categoría:<select name='categoria'>";

					foreach($listaCategorias as $categoria) {
						$array = json_decode(json_encode($categoria), true);
						echo "<option value='".$array['id_categoria']."'>".$array['nombre']."</option>";
					}

					echo "<select><br/>Selecciona el rango de precios:
					<input type='radio' name='precio' value='menor5'> Menor de 5€
					<input type='radio' name='precio' value='5a10'> 5€ a 10€
					<input type='radio' name='precio' value='mayor10'> Mayor de 10€<br/><br/>
					</select>";
					
					echo "</select><br/><br/>
							<input type='submit' class='boton-entrar' name='buscar' value='Buscar'/><br/>
						</form>";
				

					if(isset($_POST['buscar'])){
						$categoria = $_POST['categoria'];
						$precio = isset($_POST['precio']) ? $_POST['precio'] : '';
						//$precio = $_POST['precio'];
						$listaProductos = listaDeProductos($categoria, $precio); 
						if ($precio == ''){
							echo "Selecciona un rango de precios.";
						}
						else if(count($listaProductos)==0){
							echo "No hay productos disponibles con las características seleccionadas.";
						}
						else{
							echo "<form method='POST' action='".$_SERVER['PHP_SELF']."'>
							<table border='1'>
									<tr>
										<td>ID</td>
										<td>NOMBRE DEL PRODUCTO</td>
										<td>CATEGORÍA</td><td>PRECIO</td>
										<td>DESCRIPCIÓN</td>
										<td>RESEÑA MÁS DESTACADA</td>
										<td>VENDEDOR</td>
										<td>CANTIDAD DESEADA</td></tr>";
							foreach($listaProductos as $producto){
								$array = json_decode(json_encode($producto), true);
								echo "<tr><td>".$array['id_producto']."</td><td>".$array['nombre']."</td><td>".$array['categoria']."</td><td>".$array['precio']."</td><td>".$array['descripcion']."</td><td>".$array['resenia']."</td><td>".$array['vendedor']."</td>
								<td><input type='number' name='cantidad[".$array['id_producto']."]' min='0' value='0'></td></tr>";
							};
							echo "</table></br><input type='submit' class='boton-entrar' name='compra' value='Comprar'><br/><br/></form>";       
						}
					}
*/
					// Mostrar la tabla de productos completa
/*					echo "<h2></br></br>O mira la lista completa de todos nuestros productos e ingresa la cantidad deseada:</h2>
					<form method='POST' action='".$_SERVER['PHP_SELF'] . "'>
					<input type='submit' class='boton-entrar' name='mostrar' value='Mostrar'/><br/>";
					
					if(isset($_POST['mostrar'])){
						$verProducto = verProductos();
						
						if(count($verProducto) == 0) {
							echo "<p class='negritaRojo'>No hay productos disponibles en la base de datos.</p>";
						} else {
							echo "<table border='1'>
									<tr><td>ID</td><td>NOMBRE DEL PRODUCTO</td><td>CATEGORÍA</td><td>PRECIO</td><td>DESCRIPCIÓN</td><td>RESEÑA MÁS DESTACADA</td><td>VENDEDOR</td><td>CANTIDAD DESEADA</td></tr>";
							foreach($verProducto as $producto){
								echo "<tr><td>".$producto['id_producto']."</td><td>".$producto['nombre']."</td><td>".$producto['categoria']."</td><td>".$producto['precio']."</td><td>".$producto['descripcion']."</td><td>".$producto['resenia']."</td><td>".$producto['vendedor']."</td>
								<td><input type='number' name='cantidad[".$producto['id_producto']."]' min='0' value='0'></td></tr>";
							};		
							echo "</table></br><input type='submit' class='boton-entrar' name='compra' value='Comprar'>";
						}
					}
					echo "<br/><br/></form>";
					
					// Procesar la compra
					if(isset($_POST['compra'])) {
						
						$cantidad = $_POST['cantidad'];
						$subtotal = 0;
						$productos_comprados = array();
						$i=0;
						
						foreach ($cantidad as $id_producto => $cantidad_deseada) {
							if($cantidad_deseada > 0) {
								
								$producto = buscaProductosporID($id_producto);
								$precio = $producto[0]['precio'];
								$subtotal = $cantidad_deseada * $precio;
								$vendedor = $producto[0]['vendedor'];
								$productos_comprados[] = array(
									'id_producto' => $id_producto,
									'cantidad' => $cantidad_deseada,
									'precio_cantidad' => $subtotal,
									'vendedor' => $vendedor,
								);
								$i++;
							}	
						}
						
						if($i == 0){
							echo "<p class='negritaRojo'>Debes indicar la cantidad que deseas comprar.</p>";
						}else{

							$_SESSION['productos_comprados'] = $productos_comprados;
							
							header("Location: compra.php");

						}
					}
					
					//MUESTRA FORMULARIO INGRESAR PRODUCTO SI ES VENDEDOR
					$usuario = obtenerUsuario($_SESSION['id_usuario']);

					if($usuario['comprador_vendedor'] == 1){

						require_once("vendedor.php");
						
					}

					cerrarConexion();
*/				?> 	
				
<!--        </div>
        </div>
-->
        <footer>
			<p>Copyright &copy; 2023 Designed by <strong>Bruno Wouters</strong>,<strong> Gaston Wouters</strong> and <strong>Rukaya Masmoudi Messaoud</strong></p>
        </footer>
    </body>
</html>

<style>
*{
    padding: 0%;
    margin: 0%;
}

body {
	background: white;
	text-align: center;
	font-family: "Comic Neue";
}

/*NAV, logo y sesión*/ 

.logo {
    padding-left:2%;
}

.izqda{
    width:40%;
    text-align: left;
    padding-left:5%;
    margin:0;
    display: inline-block;
}

.drcha{
    /*position: relative;
    top: -150px; */
    width:49%;
    text-align: right;
    display: inline-block;
}

.nav1{
    text-align: center;
    /*position: relative;
    top: -150px;*/
    padding-bottom:20px;
}

.nav2{
    text-align: center;
}
/* rgb(167, 217, 184) 118, 251, 127, 0.8 rgb(109, 212, 119)*/
nav{
    background-color: rgb(167, 217, 184);
    text-align: center;
    width: 100%;
}
 
nav ul {                          
    list-style: none;
    text-align: right;
    margin-right: 5%;
    vertical-align: top;
    padding-top:5%;
}    

nav ul li + li {
    margin-left: 2%;
}
 
nav ul li {
    /*background-color: rgb(16, 16, 191);*/
    background-color: green;
    border-radius: 20px;
    padding: 10px; 
    margin-bottom: 10px;
    display: inline-block; 
}

nav ul li a{
    text-decoration: none;
    /*text-transform: capitalize;*/
    color: white;
    font-family: Georgia, serif;
    font-size: 130%;
}

nav ul li:hover {
    text-decoration: underline;
    transform: scale(1.3);
    transition: 0.5s;
    cursor:pointer;
    color: gold;
    border: 3px solid rgb(173, 168, 0);
}

nav ul li:hover a{
    color:rgb(180, 186, 0);
}

.centrar {
    text-align: center;
    width: 50%;
    margin:0 auto;
    margin-top: 40px;
    margin-bottom: 50px;
}

.amarillo{
    font-family: "Comic Neue",serif;
    font-style: italic;
    color: gold;
    font-size: 35px; 
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

.verde{
    font-family: Georgia, serif;
    color: green;
    font-size: 70px; 
    background: radial-gradient(yellow, green); 
}


/* Texto y fuente */

.letraUsual{
    font-family: "Comic Neue";
    font-size: 20px; 
}

.colorDegradiant{
    background: linear-gradient(90deg, yellow, green);
    background-repeat: no-repeat;
    background-size: cover;
}

/* Formulario busqueda*/

.busqueda{
    /*width:100%;*/
    border-radius: 20px;
    border-color: green;
}
.formBusqueda {
    border: 4px solid green;
    text-align: left;
    width: 500px; 
    margin: 0 auto; 
    padding: 20px;
} 
.formVentaProd{
	margin-top: 40px;
}
.inputs{
	margin-left: 0%;
}
.labelInput{
	display: inline-block;
	width: 230px;
}
.labelInput-A{
	display: inline-block;
	width: 150px; 
	
}
.negritaRojo{
	color: red;
	font-weight: bold;
}

/* Tablas */

.estiloTabla {
    border-collapse: collapse;
    width: 100%;
}

.estiloTabla td,
.estiloTabla th {
    border: 1px solid #00ff73;
    padding: 8px;
}

.estiloTabla tr:first-child {
    background-color: green;
    color: white;
}

.estiloTabla tr:nth-child(even) {
    background-color: #f2f2f2;
}


/*Botones y errores*/

.boton-entrar:hover {
	background-color: #076500;
	color: white;
	padding: 5px 0px; 
	border: none; 
	border-radius: 4px; 
	cursor: pointer; 
}

.boton-cerrar-sesion{
	display: block;
	width: 190px;
	padding: 5px 0px;
	border: none; 
	border-radius: 4px;
	background-color: #D9D9D9;
	text-align: center;
	text-decoration: none;
	text-transform: uppercase;
	font-weight: bold;
	color: #808080 ;
	margin-left:10%;
}

.boton-entrar {
    display: block;
	width: 190px;
	padding: 5px 0px;
	border: none; 
	border-radius: 4px;
	background-color: #D9D9D9;
	text-align: center;
	text-decoration: none;
	text-transform: uppercase;
	font-weight: bold;
	color: #808080 ;
	margin:auto; 
}


/*Footer*/

footer {
    background-color:grey;
	width: 100%;
    padding-bottom: 10px;
    padding-top: 10px;
}

</style>
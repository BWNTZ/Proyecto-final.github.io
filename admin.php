<html>
	<head>
		<title>Nature's Food LTD. Sección Administrador.</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<!--<link href="style.css" rel="stylesheet" type="text/css" />-->
	</head>
	<body>
		<nav> <!-- CUIDADO el NAV del admin es diferente al del resto --> 
            <div class="izqda"><img src="images/logo-grand-naturefood-copy.png" width="450px" class="logo">
                <?php
					require_once("control_sesion.php");

					if(isset($_SESSION['id_usuario'])) {
						if ($_SESSION['tipo_usuario'] == 0){
							echo "<h3 style='text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);'><img src='images/avatar.png'> Bienvenido ".$_SESSION['username'].". Has iniciado sesión con éxito como administrador!</h3>";
						} else{
							echo "<h3 style='text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);'><img src='images/avatar.png'> Bienvenido ".$_SESSION['username'].". Has iniciado sesión con éxito!</h3>";
						}
						/*--------------- Logout --------------->*/
						echo "</br><a href='logout.php' class='boton-entrar'>Cerrar sesión</a></br>";		
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

		<main class="centrar">
            <div class="">
                <h3 class="amarillo">Organic is The Future</h3></br>
                <h2 class="verde">Nature´s Food</h2></br></br>
				<p class="letraUsual" style="font-size: 50px;"><strong>Página del administrador:</strong></p></br> 
            </div>
			
			<section class="CambiosUsuarios">
				<div> <!--------------- GESTION USUARIOS --------------->
					<p class="letraUsual colorDegradiant" style="font-size: 30px;"><strong>Gestión de usuarios: </strong></p></br>
					<?php
						//require_once("control_sesion.php");
						require_once("database.php");
						controlSesionAdmin();

						if (isset($_GET['accion']) && $_GET['accion'] == 'crear_usuario') {
							echo "<div id='menu1'><div id='formulario_usuario'>";
							require_once("crear_usuario.php");
							echo "<a href='admin.php' class='boton-entrar'>Ocultar creacion de usuario.</a>";
							echo "</div></div>";
						} else {
							echo "<a href='admin.php?accion=crear_usuario' class='boton-entrar'>Crear usuario</a>";
						}
					?>
				</div>

				
				<div> <!--------------- TABLA DE USUARIOS ACTIVOS --------------->
					</br><p class="letraUsual" ><strong>Tabla de usuarios activos:</strong></p></br>
					<div><!--id="menu1"-->
						<?php 
							$usuarios = listarUsuarios();
							echo "<table class='estiloTabla' border='1'>
									<tr><td>ID</td><td>USERNAME</td><td>TIPO USUARIO</td><td>ACCIONES</td></tr>";
							foreach($usuarios as $usuario){
								echo "<tr>
										<td>".$usuario['id_usuario']."</td>
										<td>".$usuario['nombre']."</td>";
										if($usuario['tipo_usuario'] == 0){
											echo "<td>Admin</td>";
										}
										else{
											echo "<td>User</td>";
										}
										echo "<td>
												<a class='boton-entrar' style='width:40%;' href='admin.php?edit=".$usuario['id_usuario']."'>Editar</a></br>
												<a class='boton-entrar' style='width:40%;' href='borrar_usuario.php?user=".$usuario['id_usuario']."'>Borrar</a>
											</td>
									</tr>";
							}									
							//<a href='editar_usuario.php?user=".$usuario['id_usuario']."'>Editar</a>
							//<a href='borrar_usuario.php?user=".$usuario['id_usuario']."'>Borrar</a>   style='width:40%; display: inline;'							
							echo "</table>";
						?>			
					</div>

					<?php  
						if (isset($_GET['edit'])) {
							echo "<div id='menu1'><div id='formulario_editar_usuario'>";
							require_once("editar_usuario.php");
							echo "</br><a href='admin.php' class='boton-entrar'>Ocultar edición de usuario.</a>";
							echo "</div></div>";
						}	
					?>
				</div>
			</section>
			
			<section  class="CambiosProductos">
				<div class="letraUsual"> <!--------------- GESTION DE PRODUCTOS --------------->
					<p class="letraUsual colorDegradiant" style="font-size: 30px;"><strong>Inserta un nuevo producto al stock:</strong></p></br>
					<?php
						$listaCategorias = listaCategorias($_SESSION['id_usuario']);

						echo "<div class=''><form style='text-align:left;' method='POST' action='".$_SERVER['PHP_SELF']."'>
							<strong>Nombre del Producto: </strong><input type='text' name='nombre'/><br/><br/>
							<strong>Precio del Producto: </strong><input type='text' name='precio'/><br/><br/>
							<strong>Descripción del Producto: </strong><input type='text' name='descripcion'/><br/><br/>
							<strong>Reseña del Producto: </strong><input type='text' name='resenia'/><br/><br/>
							<strong>Vendedor del Producto: </strong><input type='text' name='vendedor'/><br/><br/>
							<strong>Categoría: </strong><select name='categoria'>";

						foreach ($listaCategorias as $categoria) {
							$array = json_decode(json_encode($categoria), true);
							echo "<option value='".$array['id_categoria']."'>".$array['nombre']."</option>";
						}
						
						echo "</select><br/><br/>
								<input type='submit' class='boton-entrar' name='crear' value='Añadir'/>
							</form></div>";
						
						if(isset($_POST['crear'])){
							if(empty($_POST['nombre'])){
								echo "<br/><p class='negritaRojo'>Debes indicar el nombre del producto.</p>";
							}
							elseif(empty($_POST['precio'])){
								echo "<br/><p class='negritaRojo'>Debes indicar el precio del producto.</p>";
							}
							elseif(empty($_POST['descripcion'])){
								echo "<br/><p class='negritaRojo'>Debes darle una descripcion al producto.</p>";
							}
							elseif(empty($_POST['resenia'])){
								echo "<br/><p class='negritaRojo'>Debes escribir una reseña del producto.</p>";
							}
							elseif(empty($_POST['vendedor'])){
								echo "<br/><p class='negritaRojo'>Debes indicar el nombre del vendedor.</p>";
							}		
							else{
								insertaProducto($_POST['nombre'], $_POST['categoria'], $_POST['precio'], $_POST['descripcion'], $_POST['resenia'], $_POST['vendedor']);//$client->insertaProducto...
							}
						}
					?>
				
				</br></br><div> <!--------------- Todos los productos --------------->
					<p class="letraUsual colorDegradiant" style="font-size: 30px;"><strong>Nuestros productos:</strong></p></br>
					<div id="menu1">
						<?php
							require_once("database.php");

							$verProducto = verProductos();

							if(count($verProducto) == 0) {
								echo "<br/><p class='negritaRojo'>No hay productos disponibles en la base de datos.</p>";
							} else {
								echo "<table class='estiloTabla' border='1'>
										<tr><td>ID</td><td>NOMBRE DEL PRODUCTO</td><td>CATEGORÍA</td><td>PRECIO</td><td>DESCRIPCIÓN</td><td>RESEÑA MÁS DESTACADA</td><td>VENDEDOR</td><td>EDITAR</td></tr>";
								foreach($verProducto as $producto){
									echo "<tr><td>".$producto['id_producto'].
									"</td><td>".$producto['nombre'].
									"</td><td>".$producto['categoria'].
									"</td><td>".$producto['precio'].
									"</td><td>".$producto['descripcion'].
									"</td><td>".$producto['resenia'].
									"</td><td>".$producto['vendedor'].
									"</td><td><a class='boton-entrar' style='width:100%;' href='admin.php?editProd=".$producto['id_producto']."'>Editar</a>
									</td>
									</tr>";
								};		
								
								/* con javascript
								"</td><td><a href='#' onclick='editarProducto(".$producto['id_producto'].")'>Editar</a>
									</td>
									</tr>";
								*/	
		
								echo "</table>";
								//echo "<div id='formulario_editar_producto'></div>";//agregado
							}	
						?>
					</div>
					<?php
						if (isset($_GET['editProd'])) {
							echo "<div id='menu1'><div id='formulario_editar_producto'>";
							require_once("editar_producto.php");
							echo "</br><a href='admin.php' class='boton-entrar'>Ocultar edición de producto.</a>";
							echo "</div></div>";
						}
					?>
				</div>	

				</br></br><div class="letraUsual"> <!--------------- Buscar productos --------------->
					<p class="letraUsual colorDegradiant" style="font-size: 30px;"><strong>Buscar productos en el stock por categoria y precio:</strong></p></br>
					<?php
						echo "<form method='POST' action='".$_SERVER['PHP_SELF']."'>
								<strong>Selecciona la categoría: </strong><select name='categoria'>";

								foreach($listaCategorias as $categoria) {
									$array = json_decode(json_encode($categoria), true);
									echo "<option value='".$array['id_categoria']."'>".$array['nombre']."</option>";
								}
				
						echo "<select><br/><strong>Selecciona el rango de precios: </strong>
						<ul>
						<input type='radio' name='precio' value='menor5' > Menor de 5€ 
						<input type='radio' name='precio' value='5a10' style='margin-left: 10%;'> 5€ a 10€ 
						<input type='radio' name='precio' value='mayor10' style='margin-left: 10%;'> Mayor de 10€<br/><br/>
						</ul>
						
						</select>";

						if(isset($_POST['buscar'])){
							$categoria = $_POST['categoria'];
							$precio = isset($_POST['precio']) ? $_POST['precio'] : '';
							//$precio = $_POST['precio'];
							$listaProductos = listaDeProductos($categoria, $precio); 
							if ($precio == ''){
								echo "<p class='negritaRojo'>Selecciona un rango de precios.</>";
							}
							else if(count($listaProductos)==0){
								echo "<p class='negritaRojo'>No hay productos disponibles con las características seleccionadas.</p>";
							}
							else{
								echo "<form method='POST' action='borrar_producto.php'>
								<table class='estiloTabla' border='1'>
										<tr><td>ID</td><td>NOMBRE DEL PRODUCTO</td><td>CATEGORÍA</td><td>PRECIO</td><td>DESCRIPCIÓN</td><td>RESEÑA MÁS DESTACADA</td><td>VENDEDOR</td><td>BORRAR PRODUCTO</td></tr>";
								foreach($listaProductos as $producto){
									$array = json_decode(json_encode($producto), true);
									echo "<tr><td>".$array['id_producto']."</td><td>".$array['nombre']."</td><td>".$array['categoria']."</td><td>".$array['precio']."</td><td>".$array['descripcion']."</td><td>".$array['resenia']."</td><td>".$array['vendedor']."</td>
									<td><input type='checkbox' name='borrar[]' value='".$array['id_producto']."'/></td></tr>";
								};
								echo "</table></br><input type='submit' class='boton-entrar' value='Borrar producto'/></form>";       
							}
						}

						echo "</select><br/>
								<input type='submit' class='boton-entrar' name='buscar' value='Buscar'/><br/>
							</form>";

						cerrarConexion();
					?>
				</div>			
			</section>
					


<!--
		<div id="content">																	-->
			<!--<div><img src="images/img4.jpg" alt="" /></div>-->
<!--			<div id="colTwo">
				<h1>Página del administrador:</br></br></h1>								-->

				<!--------------- GESTION USUARIOS --------------->

<!--				<h2>Gestión de usuarios:</h2>
			</div>
  			<div id="colOne">																-->
				<?php
			        //require_once("control_sesion.php");
/*					require_once("database.php");

					controlSesionAdmin();

					if (isset($_GET['accion']) && $_GET['accion'] == 'crear_usuario') {
						echo "<div id='menu1'><div id='formulario_usuario'>";
						require_once("crear_usuario.php");
						echo "<a href='admin.php' class='boton-entrar'>Ocultar creacion de usuario.</a>";
						echo "</div></div>";
					} else {
						echo "<a href='admin.php?accion=crear_usuario' class='boton-entrar'>Crear usuario</a>";
					}
*/				?>

				<!--------------- TABLA DE USUARIOS ACTIVOS --------------->
<!--			
				<h2></br></br>Tabla de usuarios activos:</h2></br>
				<div id="menu1">
-->					<?php 
/*						$usuarios = listarUsuarios();
						echo "<table border='1'>
								<tr><td>ID</td><td>USERNAME</td><td>TIPO USUARIO</td><td>ACCIONES</td></tr>";
						foreach($usuarios as $usuario){
							echo "<tr>
									<td>".$usuario['id_usuario']."</td>
									<td>".$usuario['nombre']."</td>";
									if($usuario['tipo_usuario'] == 0){
										echo "<td>Admin</td>";
									}
									else{
										echo "<td>User</td>";
									}
									echo "<td>
											<a href='admin.php?edit=".$usuario['id_usuario']."'>Editar</a>
											<a href='borrar_usuario.php?user=".$usuario['id_usuario']."'>Borrar</a>
										</td>
								</tr>";
						}				
						
						//<a href='editar_usuario.php?user=".$usuario['id_usuario']."'>Editar</a>
						//<a href='borrar_usuario.php?user=".$usuario['id_usuario']."'>Borrar</a>
						
						echo "</table>";
					?>			
				</div>

				<?php  

					if (isset($_GET['edit'])) {
						echo "<div id='menu1'><div id='formulario_editar_usuario'>";
						require_once("editar_usuario.php");
						echo "<a href='admin.php'>Ocultar edición de usuario.</a>";
						echo "</div></div>";
					}
			
*/				?>

<!--		</div> 																			
-->					
			<!--------------- GESTION DE PRODUCTOS --------------->
<!--
			<h2></br></br>Inserta un nuevo producto al stock:</h2></br>	
-->
			<?php
/*				$listaCategorias = listaCategorias($_SESSION['id_usuario']);

				echo "<div id='menu1'><form method='POST' action='".$_SERVER['PHP_SELF']."'>
						Nombre del Producto:<input type='text' name='nombre'/><br/><br/>
						Precio del Producto:<input type='text' name='precio'/><br/><br/>
						Descripción del Producto:<input type='text' name='descripcion'/><br/><br/>
						Reseña del Producto:<input type='text' name='resenia'/><br/><br/>
						Vendedor del Producto:<input type='text' name='vendedor'/><br/><br/>
						Categoría:<select name='categoria'>";

				foreach ($listaCategorias as $categoria) {
					$array = json_decode(json_encode($categoria), true);
					echo "<option value='".$array['id_categoria']."'>".$array['nombre']."</option>";
				}
				
				echo "</select><br/><br/>
						<input type='submit' class='boton-entrar' name='crear' value='Añadir'/>
					</form></div>";
				
				if(isset($_POST['crear'])){
					if(empty($_POST['nombre'])){
						echo "Debes indicar el nombre del producto.<br/>";
					}
					elseif(empty($_POST['precio'])){
						echo "Debes indicar el precio del producto.<br/>";
					}
					elseif(empty($_POST['descripcion'])){
						echo "Debes darle una descripcion al producto.<br/>";
					}
					elseif(empty($_POST['resenia'])){
						echo "Debes escribir una reseña del producto.<br/>";
					}
					elseif(empty($_POST['vendedor'])){
						echo "Debes indicar el nombre del vendedor.<br/>";
					}		
					else{
						insertaProducto($_POST['nombre'], $_POST['categoria'], $_POST['precio'], $_POST['descripcion'], $_POST['resenia'], $_POST['vendedor']);//$client->insertaProducto...
					}
				}
*/			?>				

					<!--------------- Todos los productos --------------->
					
<!--				<h2></br></br>Nuestros productos:</h2></br>	
					
				<div id="colOne">
					<div id="menu1">
-->					<?php
/*						require_once("database.php");

						$verProducto = verProductos();

						if(count($verProducto) == 0) {
							echo "No hay productos disponibles en la base de datos.";
						} else {
							echo "<table border='1'>
									<tr><td>ID</td><td>NOMBRE DEL PRODUCTO</td><td>CATEGORÍA</td><td>PRECIO</td><td>DESCRIPCIÓN</td><td>RESEÑA MÁS DESTACADA</td><td>VENDEDOR</td><td>EDITAR</td></tr>";
							foreach($verProducto as $producto){
								echo "<tr><td>".$producto['id_producto'].
								"</td><td>".$producto['nombre'].
								"</td><td>".$producto['categoria'].
								"</td><td>".$producto['precio'].
								"</td><td>".$producto['descripcion'].
								"</td><td>".$producto['resenia'].
								"</td><td>".$producto['vendedor'].
								"</td><td><a href='admin.php?editProd=".$producto['id_producto']."'>Editar</a>
								</td>
								</tr>";
							};		
*/							
							/* con javascript
							"</td><td><a href='#' onclick='editarProducto(".$producto['id_producto'].")'>Editar</a>
								</td>
								</tr>";
							*/	
/*	
							echo "</table>";
							//echo "<div id='formulario_editar_producto'></div>";//agregado
							}	
*/					?>
<!--					</div>
-->				<?php
/*					if (isset($_GET['editProd'])) {
						echo "<div id='menu1'><div id='formulario_editar_producto'>";
						require_once("editar_producto.php");
						echo "<a href='admin.php'>Ocultar edición de producto.</a>";
						echo "</div></div>";
					}
*/				?>
<!--
				</div>	
-->					<script>/* para javascript
						function editarProducto(id_producto) {
							var xhr = new XMLHttpRequest();
							xhr.onreadystatechange = function() {
								if (this.readyState == 4 && this.status == 200) {
									document.getElementById("formulario_editar_producto").innerHTML = this.responseText;
								}
							};
							xhr.open("GET", "editar_producto.php?id_producto="+id_producto, true);
							xhr.send();
						}*/
					</script>


			<!--------------- Buscar productos --------------->
<!--					
			<h2></br></br>Buscar productos en el stock por categoria y precio:</h2></br>	
-->
			<?php
/*				if(isset($_POST['buscar'])){
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
						echo "<form method='POST' action='borrar_producto.php'>
						<table border='1'>
								<tr><td>ID</td><td>NOMBRE DEL PRODUCTO</td><td>CATEGORÍA</td><td>PRECIO</td><td>DESCRIPCIÓN</td><td>RESEÑA MÁS DESTACADA</td><td>VENDEDOR</td><td>BORRAR PRODUCTO</td></tr>";
						foreach($listaProductos as $producto){
							$array = json_decode(json_encode($producto), true);
							echo "<tr><td>".$array['id_producto']."</td><td>".$array['nombre']."</td><td>".$array['categoria']."</td><td>".$array['precio']."</td><td>".$array['descripcion']."</td><td>".$array['resenia']."</td><td>".$array['vendedor']."</td>
							<td><input type='checkbox' name='borrar[]' value='".$array['id_producto']."'/></td></tr>";
						};
						echo "</table><input type='submit' class='boton-entrar' value='Borrar producto'/></form>";       
					}
				}
			
				echo "<form method='POST' action='".$_SERVER['PHP_SELF']."'>
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

				cerrarConexion();
*/			?>
<!--  		</div>
-->		</main>
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
	/*text-align: justify;*/
}


/*NAV, logo y sesión*/ 

.izqda{
    width:40%;
    text-align: left;
    padding-left:5%;
    margin:0;
    display: inline-block;
}

.logo {
    padding-left:2%;
}
/*
.imgLogo:hover{
    margin-left: 3%;
    transform: scale(1.5);
    transition: 1s;
}*/

.drcha{
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

nav{
    background-color:rgb(167, 217, 184);/* color anterior 84, 165, 44*/
    padding-bottom: 1.2%;
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


/*Texto y fuente*/

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

.letraUsual{
    font-family: "Comic Neue";
    font-size: 20px; 
}

.colorDegradiant{
    background: linear-gradient(90deg, yellow, green);
    background-repeat: no-repeat;
    background-size: cover;
}

.negritaRojo{
	color: red;
	font-weight: bold;
}

.CambiosUsuarios{
	border-radius: 20px;
	border: 4px solid green;
	padding: 50px;
}

.CambiosProductos{
	border-radius: 20px;
	border: 4px solid green;
	padding: 50px;
	margin-top: 2%;
}


/* Boton */
.boton-entrar:hover {
	background-color: #076500;
	color: white;
	padding: 5px 0px; 
	border: none; 
	border-radius: 4px; 
	cursor: pointer; 
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
	color: #808080;
    margin-left:10%;
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


/*Footer*/

footer {
    background-color:grey;
	width: 100%;
	padding-top: 10px;
    padding-bottom: 10px;
}
</style>
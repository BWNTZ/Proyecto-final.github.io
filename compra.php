<html>
  <head>
        <title>Nature's Food LTD. Compra.</title>
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
	<main>
        <section class="centrar">
			<h3 class="amarillo">Organic is The Future</h3></br>
			<h2 class="verde">Nature´s Food</h2></br></br>
            </br><p class="letraUsual colorDegradiant" style="font-size: 30px;"><strong>Comprueba tus datos personales y elije el método de pago para continuar con la compra:</strong></p></br>
			<div class="centrar">
                <style>
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
                </style>
                <?php             
                    $id_usuario = $_SESSION['id_usuario'];
                    $usuario = obtenerUsuario($id_usuario);
            
                    $nombre = $usuario['nombre'];
                    $nombre_r = $usuario['nombre_r'];
                    $direccion = $usuario['direccion'];
                    $telefono = $usuario['telefono'];
                    $email = $usuario['email'];
                    $tarjeta = $usuario['tarjeta'];
                    $cuenta = $usuario['cuenta_banco'];
               
                    echo "<form class='formBusqueda' style='text-align:center;' method='POST' action='#'>
                        <strong>Nombre y Apellidos: </strong>$nombre_r</br></br>
                        <strong>Dirección: </strong>$direccion</br></br>
                        <strong>Teléfono: </strong>$telefono</br></br>
                        <strong>Email: </strong>$email</br></br>
                        <strong>Elija el método de pago: </strong></br>
                            <input type='radio' id='tarjeta' name='pago'><label for='tarjeta'> Tarjeta de credito/debito: $tarjeta</label><br>
                            <input type='radio' id='cuentabancaria' name='pago'><label for='cuentabancaria'> Cuenta bancaria: $cuenta</label><br>
                            </br><input type='submit' class='boton-entrar' name='comprar' value='Comprar'>          
                        </form>";
                
                    // Procesar la compra
                    if(isset($_POST['comprar'])) {

                        if(isset($_POST['pago']) && isset($nombre_r) && isset($direccion) && isset($nombre_r) && isset($telefono) && isset($email)){     
                            $productos_comprados = $_SESSION['productos_comprados'];

                            $id_usuario = $_SESSION['id_usuario'];
                            $hora_actual = date("H:i:s");
                            
                            insertaCompra($id_usuario,$hora_actual);
                            $id_compra = obtenerIdCompra($id_usuario,$hora_actual);
                            
                            aniadeProductoEnCompra($id_compra, $productos_comprados);
                           
                            //sleep(3);
                            //echo "<p>¡Compra realizada con exito! Redirigiendo...</p>";
                            header("Location: historial.php");          
                        } else{
                            echo "<p>SE HA PRODUCIDO UN ERROR: Asegúrese de elejir un método de pago primero y rellenar sus datos personales en su perfil.</p>";
                        } 
                    }
                       
                    cerrarConexion();       
				?>
            </div>    
        </section>
    </main>

<!--
        <div id="content">
			<div><img src="images/img4.jpg" alt="" /></div>
			<div id="colTwo">
				
                <h2>Comprueba tus datos personales y elije el método de pago para continuar con la compra:</h2>
-->               
                <?php 
/*                    
                    $id_usuario = $_SESSION['id_usuario'];
                    $usuario = obtenerUsuario($id_usuario);

            
                    $nombre = $usuario['nombre'];
                    $nombre_r = $usuario['nombre_r'];
                    $direccion = $usuario['direccion'];
                    $telefono = $usuario['telefono'];
                    $email = $usuario['email'];
                    $tarjeta = $usuario['tarjeta'];
                    $cuenta = $usuario['cuenta_banco'];

                    
                    echo "<form method='POST' action='#'>
                            Nombre y Apellidos: $nombre_r</br>
                            Dirección: $direccion</br>
                            Teléfono: $telefono</br>
                            Email: $email</br>
                            Elija el método de pago: </br>
                            <input type='radio' id='tarjeta' name='pago'><label for='tarjeta'> Tarjeta de credito/debito: $tarjeta</label><br>
                            <input type='radio' id='cuentabancaria' name='pago'><label for='cuentabancaria'> Cuenta bancaria: $cuenta</label><br>
                            <input type='submit' class='boton-entrar' name='comprar' value='Comprar'>
                        
                    </form>";
                
                    // Procesar la compra
                    if(isset($_POST['comprar'])) {

                        if(isset($_POST['pago']) && isset($nombre_r) && isset($direccion) && isset($nombre_r) && isset($telefono) && isset($email)){

                           
                            $productos_comprados = $_SESSION['productos_comprados'];

                            $id_usuario = $_SESSION['id_usuario'];
                            $hora_actual = date("H:i:s");
                            
                            insertaCompra($id_usuario,$hora_actual);
                            $id_compra = obtenerIdCompra($id_usuario,$hora_actual);
                            
                            aniadeProductoEnCompra($id_compra, $productos_comprados);
                           
                            //sleep(3);
                            //echo "<p>¡Compra realizada con exito! Redirigiendo...</p>";
                            header("Location: historial.php");
                           
                        } else{
                            echo "<p>SE HA PRODUCIDO UN ERROR: Asegúrese de elejir un método de pago primero y rellenar sus datos personales en su perfil.</p>";
                        }
                        
                    }
                       
                    cerrarConexion();
                    
*/				?>
<!--            </div>
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

nav{
    background-color:rgb(167, 217, 184);
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

/*Botones y errores*/

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
	color: #808080 ;
    margin-left:10%;
  }


/*Footer*/

footer {
    background-color:grey;
	width: 100%;
    padding-bottom: 10px;
    padding-top: 10px;
}

</style>
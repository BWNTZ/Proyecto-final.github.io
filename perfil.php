<html>
	<head>
		<title>Nature's Food LTD. Perfil</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<!--<link href="style.css" rel="stylesheet" type="text/css" />-->
        <script src="perfil.js" defer></script>
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

        <!--------------- GESTION USUARIOS --------------->
        <main>
            <section class="centrar">
                <h3 class="amarillo">Organic is The Future</h3></br>
                <h2 class="verde">Nature´s Food</h2></br></br>
                </br><p class="letraUsual colorDegradiant" style="font-size: 30px;"><strong>Modifica tus datos:</strong></p></br>
                <div class="datos">
                <?php
                    //require_once("control_sesion.php");	
                    require_once("database.php");
                    $usuario = obtenerUsuario($_SESSION['id_usuario']);

                    $_SESSION['id_usuario_update'] = $usuario['id_usuario'];
                    echo "<form class='formDatos focoCampo' method='post' action='".$_SERVER['PHP_SELF']."'>
                        <strong>Nombre de usuario:</strong><br/><input type='text' name='username' value='".$usuario['nombre']."'><br/><br/>
                        <strong>Nombre y Apellidos:</strong><br/><input type='text' name='nombre_r' value='".$usuario['nombre_r']."'><br/><br/>
                        <strong>Teléfono:</strong><br/><input type='text' name='telefono' value='".$usuario['telefono']."'><br/><br/>
                        <strong>Email:</strong><br/><input type='text' name='email' value='".(isset($_POST['email']) ? $_POST['email'] : $usuario['email'])."'><br/><br/>	
                        <strong>Contraseña:</strong><br/><input type='password' name='password'><br/><br/>
                        <strong>Dirección:</strong><br/><input type='text' name='direccion' value='".$usuario['direccion']."'><br/><br/><br/>
                        <strong>Tarjeta de credio/debito:</strong><br/><input type='text' name='tarjeta' value='".$usuario['tarjeta']."'><br/><br/>
                        <strong>Cuenta bancaria:</strong><br/><input type='text' name='cuenta_banco' value='".$usuario['cuenta_banco']."'><br/><br/>";	

                    echo "<input type='submit' class='boton-entrar' name='editar' value='Añadir nuevos datos'></form>";

                    if(isset($_POST['editar'])){
                        if(/*empty($_POST['username']) ||*/ empty($_POST['password']) /*|| empty($_POST['nombre_r']) || empty($_POST['telefono']) || !validarTelefono($_POST['telefono']) || empty($_POST['direccion'])|| empty($_POST['tarjeta'])|| empty($_POST['cuenta_banco'])*/){
                            echo "<p class='error'>La contraseña no puede quedar vacía</p>";
                        }
                        else if(!empty($_POST['telefono']) && !validarTelefono($_POST['telefono'])){
                                    echo "<p class='error'>El teléfono ingresado no es válido</p>";
                        }
                        else if(!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                                echo "<p class='error'>El email ingresado no es válido</p>";
                        }
                        else if(!empty($_POST['nombre_r']) && !validarNombreApellido($_POST['nombre_r'])){
                                echo "<p class='error'>Nombre y Apellido no pueden contener números o símbolos extraños</p>";
                        }
                        else if(!empty($_POST['tarjeta']) && !validarTarjeta($_POST['tarjeta'])){
                            echo "<p class='error'>Número de tarjeta inválida</p>";
                        }
                        else if(!empty($_POST['cuenta_banco']) && !validarCuentaBancaria($_POST['cuenta_banco'])){
                        echo "<p class='error'>Número de cuenta bancaria inválido</p>";
                        }
                        else{
                            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                            modificarUsuarioCliente($_SESSION['id_usuario_update'], $_POST['username'], $_POST['nombre_r'], $password, $_POST['telefono'], $_POST['email'], $_POST['direccion'], $_POST['tarjeta'], $_POST['cuenta_banco']);
                            unset($_SESSION['id_usuario_update']);
                            header("Location: perfil.php");
                            //echo "Cambio de datos válido";
                        }
                    }

                    // cerrarConexion();
                ?>          
                </div>
            </section>

            

            <section class="centrar">
                    <?php //AÑADE FORMULARIO ENVIO SOLICITUD VENDEDOR
                        if($usuario['comprador_vendedor'] == 0){
                            echo "<div id=''>
                                <p class='letraUsual colorDegradiant' style='font-size: 30px;'><strong>¡Conviértete en Vendedor!</strong></p></br>
                                <p style='font-style: italic; font-size: 20px;'>Si deseas unirte a nuestra comunidad como suministrador de productos 
                                háznoslo saber y revisaremos tu caso. Por favor, escríbenos a continuación información relevante sobre tí 
                                como proveedor como tus capacitaciones y cualificaciones.</p></br>
                        
                                <div class='datos'>
                                    <form class='formMensaje focoCampo' action='test.php' method='POST' name='formularioVendedor'>
                                        <div>
                                            <label for='mensajeVendedor'><strong>Mensaje:</strong><br/></label>
                                            <textarea name='mensajeVendedor' id='mensajeVendedor' cols='60' rows='10'></textarea>
                                        </div>
                                        <div>
                                            </br><input class='btn boton-entrar' type='submit' name='enviar' value='Enviar'>
                                        </div>
                                    </form>
                                </div>
                            </div>";
                        } else{
                            echo "<div id=''><p class='letraUsual'style='font-size: 30px;'>¡Ahora eres Vendedor!</p></div>";
                        }
                        cerrarConexion();
                    ?>
            </section>
        </main>

<!--
    
        <div id="content">
            <div><img src="images/img4.jpg" alt="" /></div>
            <h2></br>Modifica tus datos:</h2>
            <div id="menu1">                                                -->
                <?php
                    //require_once("control_sesion.php");	
 /*                  require_once("database.php");
                    $usuario = obtenerUsuario($_SESSION['id_usuario']);

                    $_SESSION['id_usuario_update'] = $usuario['id_usuario'];
                    echo "<form method='post' action='".$_SERVER['PHP_SELF']."'>
                        Nombre de usuario:<input type='text' name='username' value='".$usuario['nombre']."'><br/>
                        Nombre y Apellidos:<input type='text' name='nombre_r' value='".$usuario['nombre_r']."'><br/>
                        Teléfono:<input type='text' name='telefono' value='".$usuario['telefono']."'><br/>
                        Email:<input type='text' name='email' value='".(isset($_POST['email']) ? $_POST['email'] : $usuario['email'])."'><br/>	
                        Contraseña:<input type='password' name='password'><br/>
                        Dirección:<input type='text' name='direccion' value='".$usuario['direccion']."'><br/><br/>
                        Tarjeta de credio/debito:<input type='text' name='tarjeta' value='".$usuario['tarjeta']."'><br/>
                        Cuenta bancaria:<input type='text' name='cuenta_banco' value='".$usuario['cuenta_banco']."'><br/>";	

                    echo "<input type='submit' class='boton-entrar' name='editar' value='Añadir nuevos datos'></form>";

                    if(isset($_POST['editar'])){
                        if(*//*empty($_POST['username']) ||*/ /*empty($_POST['password'])*/ /*|| empty($_POST['nombre_r']) || empty($_POST['telefono']) || !validarTelefono($_POST['telefono']) || empty($_POST['direccion'])|| empty($_POST['tarjeta'])|| empty($_POST['cuenta_banco'])*//*){*/
/*                            echo "La contraseña no puede quedar vacía";
                        }
                        else if(!empty($_POST['telefono']) && !validarTelefono($_POST['telefono'])){
                                    echo "El teléfono ingresado no es válido";
                        }
                        else if(!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                                echo "El email ingresado no es válido";
                        }
                        else if(!empty($_POST['nombre_r']) && !validarNombreApellido($_POST['nombre_r'])){
                                echo "Nombre y Apellido no pueden contener números o símbolos extraños";
                        }
                        else if(!empty($_POST['tarjeta']) && !validarTarjeta($_POST['tarjeta'])){
                            echo "Número de tarjeta inválida";
                        }
                        else if(!empty($_POST['cuenta_banco']) && !validarCuentaBancaria($_POST['cuenta_banco'])){
                        echo "Número de cuenta bancaria inválido";
                        }
                        else{
                            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                            modificarUsuarioCliente($_SESSION['id_usuario_update'], $_POST['username'], $_POST['nombre_r'], $password, $_POST['telefono'], $_POST['email'], $_POST['direccion'], $_POST['tarjeta'], $_POST['cuenta_banco']);
                            unset($_SESSION['id_usuario_update']);
                            header("Location: perfil.php");
                            //echo "Cambio de datos válido";
                        }
                    }

                    // cerrarConexion();   */
                ?>                                                                   
<!--            </div>                      -->
            
            <?php //AÑADE FORMULARIO ENVIO SOLICITUD VENDEDOR
                /*if($usuario['comprador_vendedor'] == 0){
                    echo "<div id='colTwo'>
                        <h1>¡Conviértete en Vendedor!</h1>
                        <p>Si deseas unirte a nuestra comunidad como suministrador de productos háznoslo saber y revisaremos tu caso. Por favor, escríbenos a continuación información relevante sobre tí como proveedor como tus capacitaciones y cualificaciones.</p>
                
                        <div id='menu1'>
                            <form action='test.php' method='POST' name='formularioVendedor'>
                                <div>
                                    <label for='mensajeVendedor' >Mensaje:</label>
                                    <textarea name='mensajeVendedor' id='mensajeVendedor' cols='40' rows='5'></textarea>
                                </div>
                                <div>
                                    <input class='btn' type='submit' name='enviar' value='Enviar'>
                                </div>
                            </form>
                        </div>
                    </div>";
                } else{
                    echo "<div id='colTwo'><h1>¡Ahora eres Vendedor!</h1></div>";
                }
                cerrarConexion();*/
            ?>
<!--      </div>                            -->

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
    background-color:rgb(167, 217, 184);
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

/* Boton Cerrar sesion */
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


/*Formulario de datos*/
 
.datos{
    /*width:100%;*/
    border-radius: 20px;
    border-color: green;
}
.formDatos {
    border: 4px solid green;
    text-align: left;
    width: 250px; 
    margin: 0 auto; 
    padding: 20px;
}

.formMensaje {
    border: 4px solid green;
    text-align: left;
    width: 460px; 
    margin: 0 auto; 
    padding: 20px;
}

.focoCampo input[type="text"],
.focoCampo input[type="password"],
.focoCampo select,
.focoCampo textarea {
    border-radius: 0.25rem;
    border: 1px solid #ced4da;
    transition: border-color 0.2s ease-in-out;
}
    
.focoCampo input[type="text"]:focus,
.focoCampo input[type="password"]:focus,
.focoCampo select:focus,
.focoCampo textarea:focus {
    outline: none;
    border-color:#00ff73;
}

.error {
    color: red;
	text-align: center;
	font-size: 18px;
	font-family: 'Times New Roman', Times, serif; 
}

/*Footer*/

footer {
    background-color:grey;
	width: 100%;
	padding-top: 10px;
    padding-bottom: 10px;
}

</style>
<html>
	<head>
		<title>Nature's Food LTD. Registro</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<!--<link href="style.css" rel="stylesheet" type="text/css" />-->
		<!--<link rel="stylesheet" href="slick/slick.css">
        <link rel="stylesheet" href="slick/slick-theme.css">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="slick/slick.min.js"></script>
        <script type="text/javascript" src="sliders.js"> </script>-->
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
            <div class="centrar">
                <h3 class="amarillo">Organic is The Future</h3></br>
                <h2 class="verde">Nature´s Food</h2></br></br>
                <p class="letraUsual"><strong>Nature's Food LTD </strong>es una empresa dedicada a la distribución de alimentos hacia nuestra comunidad. 
				        Inicie sesión para disfrutar de nuestros servicios.</p></br>       
                    
           

                <section class="registroYinicioSesion">
                    <div class="Login">
                        <div class="">
                            <p class="letraUsual" style="font-size: 30px;"><strong>¡Inicie sesión!</strong></p>     
                        </div></br>
                        
                        <div class="formLogin">
                            <form class="focoCampo" method ='post' action='validar_login.php'>
                                <strong>Nombre de usuario:</strong><br/><input type='text' name='username'><br/><br/>
                                <strong>Contraseña:</strong><br/><input type='password' name='password'><br/><br/>
                                <div><input type='submit' value='Entrar' class='boton-entrar'></div>
                            </form></br>
                            <div class="error">
                                <?php	                                                 
                                    if(isset($_SESSION['error_login'])){                       
                                        //echo $_SESSION['error_login'];                        
                                        echo "<div class='error'>" . $_SESSION['error_login'] . "</div>";               
                                        unset($_SESSION['error_login']);
                                    }                                               
                                ?> 
                            </div>	
                        </div>			
                        
                        		
                    </div>

                    <div class="Registro">
                        <div id="">
                            <p class="letraUsual" style="font-size: 30px;">
                            <strong>¡O Regístrese!</strong>
                            </p></br> 
                            <div class="formRegistro">
                                <form class="focoCampo" method='post' action='register.php'>
                                    <strong>Nombre de usuario:</strong><br/><input type='text' name='username'><br/><br/>
                                    <strong>Contraseña:</strong><br/><input type='password' name='password'><br/><br/>
                                    <strong>Confirmar contraseña:</strong><br/><input type='password' name='confirm_password'><br/><br/>
                                    <div><input type='submit' value='Registrarse' class='boton-entrar'></div><br/>
                                </form>
                            </div>
                        </div>
                        <?php	                                                
                            if(isset($_SESSION['error_login2'])){
                                //echo $_SESSION['error_login'];
                                echo "<div class='error'>" . $_SESSION['error_login2'] . "</div>";
                                unset($_SESSION['error_login2']);
                            }

                            if(isset($_SESSION['exito'])){
                                //echo $_SESSION['error_login'];
                                echo "<div class='exito'>" . $_SESSION['exito'] . "</div>";
                                unset($_SESSION['exito']);
                            }                                                           
                        ?>
                    </div>
                </section>
            </div>
        </main> 



<!--
		<div id="content">
			<div><img src="images/img4.jpg" alt="" /></div>
			<div id="colTwo">
				<p><strong>Nature's Food LTD </strong>es una empresa dedicada a la distribución de alimentos hacia nuestra comunidad. 
				Registrese para disfrutar de nuestros servicios.</p>
				<img id='imagenSesion' src="images/symbol4.gif"/><h2>Inicie sesión!</h2>
			</div>
  			<div id="colOne">
				<div id="menu1">
					<form method ='post' action='validar_login.php'>
						Nombre de usuario:<input type='text' name='username'><br/><br/>
						Contraseña:<input type='password' name='password'><br/><br/>
						<div><input type='submit' value='Entrar' class='boton-entrar'>
					</form>				
				</div> 			
			</div>
			<div class="error">                 -->
				<?php	 
                                                              /*            
					if(isset($_SESSION['error_login'])){                       
						//echo $_SESSION['error_login'];                        
						echo "<div class='error'>" . $_SESSION['error_login'] . "</div>";               
						unset($_SESSION['error_login']);
					}                                               */
				?>                                                  <!--
			</div>
  		</div>

		<div id="colTwo">
			<img id='imagenSesion' src="images/symbol5.gif"/><h2>O Regístrese!</h2>
			<div id="menu1">
				<form method='post' action='register.php'>
					Nombre de usuario:<input type='text' name='username'><br/><br/>
					Contraseña:<input type='password' name='password'><br/><br/>
					Confirmar contraseña:<input type='password' name='confirm_password'><br/><br/>
					<div><input type='submit' value='Registrarse' class='boton-entrar'></div>
				</form>
			</div>
		</div>

		<?php	                                                /*
			if(isset($_SESSION['error_login2'])){
				//echo $_SESSION['error_login'];
				echo "<div class='error'>" . $_SESSION['error_login2'] . "</div>";
				unset($_SESSION['error_login2']);
			}

			if(isset($_SESSION['exito'])){
				//echo $_SESSION['error_login'];
				echo "<div class='exito'>" . $_SESSION['exito'] . "</div>";
				unset($_SESSION['exito']);
			}                                                           */
		?>              
		</div>                                      -->
        
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
    /* margin-bottom: 50px; */
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


/*Main: Registro e inicio de sesion.*/ 

.registroYinicioSesion {
    /* display: inline-block; */
    /* text-align: center; */
    width: 100%;
    margin-top: 40px;
    margin-bottom: 40px;
    
}

.Login{
    display: inline-block;
    width:30%;
    padding-right:10%;
    /*position: relative;
    top: -150px;*/ 
    /* border-radius: 20px;
    border-color: green; */
    
}

.Registro{
    display: inline-block;
    width:30%;
    border-radius: 20px;
    border-color: green;
    padding-left:10%;

}

.formLogin {
    border: 4px solid green;
    text-align: center;
    /* width: 250px;  */
    /* margin: 0 auto;  */
    /* padding: 20px; */
}
.formRegistro {
    border: 4px solid green;
    /* text-align: center; */
    width: 250px; 
    /* margin: 0 auto;  */
    /* padding: 20px; */
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

.letraUsual{
    font-family: "Comic Neue";
    font-size: 20px; 
}

.error {
    color: red;
	text-align: center;
	font-size: 18px;
	font-family: 'Times New Roman', Times, serif; 
}
.exito {
    color: rgb(0, 190, 13);
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

/* Boton Cerrar sesion y registro*/

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
</style>
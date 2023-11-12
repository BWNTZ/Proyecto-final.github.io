<html>
    <head>
		<title>Nature's Food LTD. Inicio</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<!--<link href="style.css" rel="stylesheet" type="text/css" />-->
		<link rel="stylesheet" href="slick/slick.css">
        <link rel="stylesheet" href="slick/slick-theme.css">
        <!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
        <script src="jquery-3.5.1.min.js"></script>
        <script src="slick/slick.min.js"></script>
        <script type="text/javascript" src="sliders.js"> </script>
        <script src="index.js"></script>
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
            <section class="bienvenidoYimagen">
                <div class="texto">
                    <h3 class="amarillo">Organic is The Future</h3></br>
                    <h2 class="verde">Nature´s Food</h2></br></br>
                    <div class="alinearIzq">
                        <p class="letraUsual"><strong>Bienvenido a nuestro sitio web</strong></p></br>
                        <p class="letraUsual">En Nature's Food, nos apasiona ofrecer productos de alta calidad, nutritivos y sabrosos​ a nuestros clientes.<br><br>
                        Nos dedicamos a promover una alimentación saludable y sostenible, y trabajamos con agricultores y productores locales para asegurarnos de que nuestros productos sean lo más frescos posible.<br><br>
                        En nuestro sitio web, puedes encontrar información sobre nuestros productos, nutrición y bienestar.<br><br>
                        No dudes contactar con el equipo de Nature's Food para para solucionar tus dudas.<br><br>
                        ¡Gracias por visitarnos!
                        </p>          
                    </div>
                </div>        
                <div class="imagen"><img src="images/canasta-frutas.jpeg" width="700px"></div>
            </section>
            
            <section class="ProductosSlider" class="centrar">
                <h2 class="algunosProd">¡Algunos de nuestros productos!</h2></br>
                <div class="contenedorSlider">
                    <div id="sliderIndex"><!-- el espacio gigante de abajo es por este id-->
                        <div>
                            <img src="images/huevos.jpg" alt="" srcset="">
                        </div>
                        <div>
                            <img src="images/fresas.jpeg" alt="" srcset="">
                        </div>
                        <div>
                            <img src="images/zanahorias.jpg" alt="" srcset="">
                        </div>
                        <div>
                            <img src="images/salmon.jpg" alt="" srcset="">
                        </div>
                        <div>
                            <img src="images/uvas.jpeg" alt="" srcset="">
                        </div>
                        <div>
                            <img src="images/leche.jpg" alt="" srcset=""> 
                        </div>
                        <div>
                            <img src="images/tomates.jpeg" alt="" srcset="">
                        </div>
                        <!--<button id="slick-prev">Anterior</button>
                        <button id="slick-next">Siguiente</button><br/><br/>
                        <div id="slider">
                            <div class="nombreProducto">"Producto 1"<br/>--><!-- el class nombreProducto no provoca ningun cambio en el nombre-->
                                <!--<img src="images/huevos.jpg" alt="" srcset="">
                            </div>
                            <div>"Producto 2"<br/>
                                <img src="images/huevos.jpg" alt="" srcset="">
                            </div>-->
                    </div>
                </div>               
            </section>
        </main>
        
            <?php
                cerrarConexion();
            ?>
            </div>
        </div>
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


/*Main: bienvenido Y imagen*/ 


.bienvenidoYimagen {
    text-align: center;
    width: 100%;
    margin-top: 40px;
}

.texto{
    display: inline-block;
    width:45%;
    /*margin-top: -500px;
    padding-top: -500px;*/
    margin-left: 10px;
    margin-top: 20px;
    position: relative;
    top: -150px; 
}

.imagen{
    display: inline-block;
    width:49%;
}


/*Main: Slider*/

.ProductosSlider {
    margin-top: 40px;
    padding-bottom: 50px;
}

.algunosProd{
    font-size: 30px; 
    font-family: "Comic Neue";
    background: linear-gradient(90deg, yellow, green);
    background-repeat: no-repeat;
    background-size: cover;
}
.centrar {
    text-align: center;
}
.contenedorSlider{ 
    width: 50%;
    margin: 0 auto;
    text-align: center;
}

#sliderIndex {
    height: 70%;
}

#sliderIndex img {
    width: 100%;
    /*height: auto;*/
}


/*.nombreProducto { */ /*class para centrar nombre de los productos arriba de cada imagen en el slider*/
    /*position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: rgba(255, 255, 255, 0.7);
    padding: 10px;
    border-radius: 5px;
    text-align: center;
    font-size: 16px;
    font-weight: bold;
}*/

/*
#slider {
        height: 20%; 
        overflow: hidden; *//* para ocultar cualquier contenido que sobresalga del div */
        /*}

#slider img {
    width: 100%;
    height: auto;
}

.nombreProducto { *//*class para centrar nombre de los productos arriba de cada imagen en el slider*/
    /*text-align: center;
    font-size: 16px; 
}*/

/*
#slider {
        height: 20%; 
        overflow: hidden;*/ /* para ocultar cualquier contenido que sobresalga del div */
        /*}
#slider img {
        width: 100%;
        height: auto;
        }

.nombreProducto {*/ /*class para centrar nombre de los productos arriba de cada imagen en el slider*/
        /*text-align: center;
        font-size: 16px; 
        }*/


/*Tipo de letras*/

.verde{
    /*font-family: "Comic Neue";*/
    font-family: Georgia, serif;
    color: green;
    font-size: 70px; 
    background: radial-gradient(yellow, green); 
}

.amarillo{
    font-family: "Comic Neue",serif;
    font-style: italic;
    color: gold;
    font-size: 35px; 

    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Sombra de color negro */

    /*background-color: rgba(255, 255, 0, 0.5);*/ /* Amarillo con 50% de opacidad */

    /*background-color: yellow;
    background-image:
    repeating-linear-gradient(45deg, transparent, transparent 10px, green 10px, green 20px),
    repeating-linear-gradient(-45deg, transparent, transparent 10px, green 10px, green 20px);*/

    /*background: linear-gradient(to bottom, yellow, green);*/

    /*background: linear-gradient(90deg, yellow, green);
    background-repeat: no-repeat;
    background-size: cover;*/
}

.letraUsual{
    font-family: "Comic Neue";
    font-size: 20px; 
}

.alinearIzq{
    text-align: left;
}


/*Footer*/

footer {
    background-color:grey;
	width: 100%;
	padding-top: 10px;
    padding-bottom: 10px;
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
	color: #808080;
    margin-left:10%;
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
            
</style>

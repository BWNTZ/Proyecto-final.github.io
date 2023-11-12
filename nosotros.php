<html>
	<head>
		<title>Nature's Food LTD. Acerca de nosotros.</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<!--<link href="style.css" rel="stylesheet" type="text/css" />-->
        <link rel="stylesheet" href="slick/slick.css">
        <link rel="stylesheet" href="slick/slick-theme.css">
        <!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
        <script src="jquery-3.5.1.min.js"></script>
        <script src="slick/slick.min.js"></script>
        <script type="text/javascript" src="sliders.js"> </script>
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
        <main class="imagenFondo">
            <section class="centrar">
                <h3 class="amarillo">Organic is The Future</h3></br>
                <h2 class="verde">Nature´s Food</h2></br></br>
                <div class="alinearIzq">
                        <p class="letraUsual" style="font-style: italic;"><strong>¡Bienvenidos a Nature's Food LTD!</strong></p></br>
                        <p class="letraUsual" style="font-style: italic;">Somos una empresa dedicada a ofrecer productos frescos y naturales de alta calidad a nuestros 
                                clientes.Desde nuestra fundación en 1980, hemos trabajado arduamente para promover una alimentación saludable y sostenible en 
                                todo el mundo.
                            </br></br>En Nature's Food, creemos en la importancia de la calidad de los alimentos, por eso nuestros productos son cuidadosamente 
                                seleccionados por expertos y verificados por nuestro riguroso programa de calidad. Nuestra misión es ofrecer una experiencia de compra única, 
                                donde puedas encontrar una amplia variedad de productos frescos, orgánicos y libres de conservantes.
                            </br></br>Además, en Nature's Food nos preocupamos por el bienestar de las comunidades y del medio ambiente. Por eso, trabajamos con pequeños productores 
                                y agricultores locales, para apoyar a las economías regionales y reducir nuestra huella
                                de carbono. Nos enorgullece ofrecer una amplia gama de productos en nuestras tiendas, desde productos frescos.
                            </br></br>En Nature's Food, nos esforzamos por crear una experiencia de compra única que satisfaga todas tus necesidades. Te invitamos a visitar 
                                cualquiera de nuestras tiendas y descubrir por ti mismo todo lo que tenemos para ofrecer.
                            </br></br>¡Gracias por confiar en nosotros!
                        </p>          
                    </div>
            </section>
            <section>
                <p class="letraUsual colorDegradiant" style="font-size: 30px;"><strong> Mira las opiniones de nuestros clientes sobre nuestro servicio!</strong></p><br/>
                <button id="slick-prev">Anteriores</button>
                <button id="slick-next">Siguientes</button><br/><br/>

                <!--
                <span id="slick-prev slider-arrow">
                    <img src="flecha-izquierda.png" alt="Flecha izquierda">
                </span>
                <span id="slick-next slider-arrow">
                    <img src="flecha-derecha.png" alt="Flecha derecha">
                </span><br/><br/>   -->

                    <div id="slider" class="letraUsual">
                        <div>"Muy buenos precios, el producto empaquetado con cuidado y el envío rápido. Repetiré"<br/></div>
                        <div>"Su atención tan amable, no parece que se esté solo comprando como en cualquier otra web. Un gran servicio."<br/></div>
                        <div>"Recompensan tus compras, suele llegar rápido el producto y suele haber buena descripción del preoducto"<br/></div>
                        <div>"En mi primer pedido hubo un error, me mandaron un artículode otro que había perdido. La atención al cliente fue genial."<br/></div>
                        <div>"Una tienda web muy clara, fácil de manejar. Diseño simple y agradable. Precios atractivos."<br/></div>
                        <div>"Experiencia de compra positiva, los productos son de calidad, tienen un precio bastante asequible, mejor aún en rebajas."<br/></div>
                        <div>"Como siempre un servicio perfecto, entrega puntual y muy bien."<br/></div>
                        <div>"Mi tienda favorita. Descubrirla ha supuesto un antes y un despues en mi vida."<br/></div>
                        <div>"Llevo mucho tiempo comprando y merecen la pena."<br/></div>    
                    </div>            
            </section> 
        </main>

<!--
		<div id="content">
            <div><img src="images/img4.jpg" alt="" /></div>
			<div id="colTwo"></br>
                <h2>Conócenos!</h2>
                <p>¡Bienvenidos a Nature's Food LTD! Somos una empresa dedicada a ofrecer productos frescos y naturales de alta calidad a nuestros 
                    clientes. 
                </br>Desde nuestra fundación en 1980, hemos trabajado arduamente para promover una alimentación saludable y sostenible en 
                    todo el mundo.
                </br>En Nature's Food, creemos en la importancia de la calidad de los alimentos, por eso nuestros productos son cuidadosamente 
                    seleccionados por expertos y verificados por nuestro riguroso programa de calidad. 
                </br>Nuestra misión es ofrecer una experiencia de 
                    compra única, donde puedas encontrar una amplia variedad de productos frescos, orgánicos y libres de conservantes.
                </br>Además, en Nature's Food nos preocupamos por el bienestar de las comunidades y del medio ambiente. 
                </br>Por eso, trabajamos con pequeños productores y agricultores locales, para apoyar a las economías regionales y reducir nuestra huella
                 de carbono.
                </br>Nos enorgullece ofrecer una amplia gama de productos en nuestras tiendas, desde productos frescos.
                </br>En Nature's Food, nos esforzamos por crear una experiencia de compra única que satisfaga todas tus necesidades. Te invitamos a visitar 
                    cualquiera de nuestras tiendas y descubrir por ti mismo todo lo que tenemos para ofrecer.
                </br>¡Gracias por confiar en nosotros!</p>
			</div>
-->

 <!--           <div id="colTwo"></br>   -->
                <!--<section class="centrar">-->
<!--                   <h2>Mira las opiniones de nuestros clientes sobre nuestro servicio!</h2>
                        <button id="slick-prev">Anteriores</button>
                        <button id="slick-next">Siguientes</button><br/><br/>
                            <div id="slider">
                            <div>"Muy buenos precios, el producto empaquetado con cuidado y el envío rápido. Repetiré"<br/>
                                <img src="imagen01.jpg" alt="" srcset="">
                            </div>
                            <div>"Su atención tan amable, no parece que se esté solo comprando como en cualquier otra web. Un gran servicio."<br/>
                                <img src="imagen02.jpg" alt="" srcset="">
                            </div>
                            <div>"Recompensan tus compras, suele llegar rápido el producto y suele haber buena descripción del preoducto"<br/>
                                <img src="imagen03.jpg" alt="" srcset="">
                            </div>
                            <div>"En mi primer pedido hubo un error, me mandaron un artículode otro que había perdido. La atención al cliente fue genial."<br/>
                                <img src="imagen04.jpg" alt="" srcset="">
                            </div>
                            <div>"Una tienda web muy clara, fácil de manejar. Diseño simple y agradable. Precios atractivos."<br/>
                                <img src="imagen05.jpg" alt="" srcset="">
                            </div>
                            <div>"Experiencia de compra positiva, los productos son de calidad, tienen un precio bastante asequible, mejor aún en rebajas."<br/>
                                <img src="imagen06.jpg" alt="" srcset="">
                            </div>
                            <div>"Como siempre un servicio perfecto, entrega puntual y muy bien."<br/>
                                <img src="imagen07.jpg" alt="" srcset="">
                            </div>
                            <div>"Mi tienda favorita. Descubrirla ha supuesto un antes y un despues en mi vida."<br/>
                                <img src="imagen08.jpg" alt="" srcset="">
                            </div>
                            <div>"Llevo mucho tiempo comprando y merecen la pena."<br/>
                                <img src="imagen09.jpg" alt="" srcset="">
                            </div>                                              -->
                <!--</section>-->
<!--        </div>                                                      
            
		</div>
        </div>                                                          -->
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

.alinearIzq{
    text-align: left;
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

/* SLIDER */

#slider {
    height: 10%;
    overflow: hidden; /* oculta cualquier contenido que sobresalga del div */
    width: 100%;
}

/*
#slider-arrow {
    position: absolute; 
    top: 50%; 
    transform: translateY(-50%); 
    background-color: transparent; /
    border: none; 
    cursor: pointer; 
}

#slider-arrow img {
    width: 20px; 
    height: 20px; 
}*/


/*Footer*/

footer {
    background-color:grey;
	width: 100%;
	padding-top: 10px;
    padding-bottom: 10px;
}

.imagenFondo{
    text-align: center;
    background: url("images/2.jpg") center center fixed;
    background-size: cover;
    padding-bottom: 20px;
    padding-top: 1.2%;
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

</style>
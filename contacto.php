<html>
    <head>
        <title>Nature's Food LTD. Contacto.</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<!--<link href="style.css" rel="stylesheet" type="text/css" />-->
        <script src="contacto.js" defer></script>
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
            </div>
            <section class="formularioYmapa">
                <div class="formulario imagenFondo">
                    <div class="alinearIzq" style="width: 50%; padding-left:25%;">
                        <p class="letraUsual"><strong>¡Gracias por ponerte en contacto con Nature's Food!</strong></p></br> 
                        <p class="letraUsual">Por favor, completa el formulario a continuación y nos pondremos en contacto contigo lo antes posible.</p></br></br>
                        <div class="letraUsual">
                            <div class="camposForm">
                                <form action="test.php" method="post" name="form-main">
                                    <div class="focoCampo">
                                        <label for="nombre" >Nombre</label>
                                        <input type="text" name="nombre" id="nombre" required minlength="3" maxlength="10" pattern="^[a-zA-ZáéíóúñÑÁÉÍÓÚ\s]*$"><span></span>
                                    </div></br>
                                    <div class="focoCampo">
                                        <label for="correo" >Correo</label>
                                        <input type="email" name="correo" id="correo" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"><span></span>
                                    </div></br>
                                    <div class="focoCampo">
                                        <label for="telefono" >Telefono</label>
                                        <input type="tel" name="telefono" id="telefono" required pattern="[0-9]{9}"><span></span>
                                    </div></br>
                                    <div class="focoCampo">
                                        <label for="mensaje" >Mensaje</label>
                                        <textarea name="mensaje" id="mensaje" cols="40" rows="5"></textarea>
                                    </div></br>
                                    <div>
                                        <input class="btn boton" type="submit" name="enviar" value="Enviar">
                                    </div>
                                </form>  
                            </div>    
                        </div>          
                    </div>
                </div>

                <div class="mapaYredes ">
                    <div class="alinearIzq letraUsual" style="width: 50%; padding-left:15%;">
                        <p>Puedes contactarnos directamente:</p></br>
                        <p><strong>Correo electrónico:</strong> <a href="mailto:info@naturefood.com">info@naturefood.com</a></p>
                        <p><strong>Teléfono:</strong> 1-800-555-5555</p></br>
                        <p>También puedes encontrarnos en nuestras redes sociales:</p></br>
                        <ul >
                            <li class="RS">
                                <a href="https://www.twitter.com" target="_blank"> <img src="images/twitter.png" width="40px" height="40px"></a>
                            </li>

                            <li class="RS">
                                <a href="https://www.facebook.com" target="_blank"><img src="images/facebook.png" width="40px" height="40px"></a>
                            </li>

                            <li class="RS">
                                <a href="https://www.instagram.com" target="_blank"><img src="images/instagram.png" width="40px" height="40px"></a>
                            </li>           
                        </ul>
                    </div></br></br> 

                    <div id="map" style="width: 80%; height: 40%; margin: 0 auto; border: 1px solid black;"> 
                        <!-- clave de api AIzaSyDr8CnhGIXh0SNmq7A3hQPtMT9lAEs_3zQ -->
                        <script type="text/javascript">
                            function initMap() {
                                const myLatLng = { lat: 40.420328, lng: -3.705080 };
                                var map = new google.maps.Map(document.getElementById("map"), {
                                    center: myLatLng,
                                    zoom: 12
                                });
                                var contentString = '<?php echo "<h3>Nature\'s Food LTD</h3><p>C/Gran Vía nº2105</p>";?>';
                                var infowindow = new google.maps.InfoWindow({content: contentString});

                                var marker = new google.maps.Marker({
                                    position: myLatLng,
                                    map: map,
                                    title: "Nature\'s Food"
                                });

                                marker.addListener('click', function(){
                                    infowindow.open(
                                        map,
                                        marker
                                    );
                                });
                            }
                        </script>          
                        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDr8CnhGIXh0SNmq7A3hQPtMT9lAEs_3zQ&callback=initMap&v=weekly"></script>
                    </div>
                </div>
            </section>
        </main>
        <footer>
			<p>Copyright &copy; 2023 Designed by <strong>Bruno Wouters</strong>,<strong> Gaston Wouters</strong> and <strong>Rukaya Masmoudi Messaoud</strong></p>
        </footer>


<!--

        <div id="content">

            <div id="colTwo">
                <h1>Contacto</h1>
                <p>¡Gracias por ponerte en contacto con Nature's Food! Por favor, completa el formulario a continuación y nos pondremos en contacto contigo lo antes posible.</p>
                
                <div id="menu1">
                    <form action="test.php" method="post" name="form-main">
                        <div>
                            <label for="nombre" >Nombre</label>
                            <input type="text" name="nombre" id="nombre" required minlength="3" maxlength="10" pattern="^[a-zA-ZáéíóúñÑÁÉÍÓÚ\s]*$"><span></span>
                        </div>
                        <div>
                            <label for="correo" >Correo</label>
                            <input type="email" name="correo" id="correo" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"><span></span>
                        </div>
                        <div>
                            <label for="telefono" >Telefono</label>
                            <input type="tel" name="telefono" id="telefono" required pattern="[0-9]{9}"><span></span>
                        </div>
                        <div>
                            <label for="mensaje" >Mensaje</label>
                            <textarea name="mensaje" id="mensaje" cols="40" rows="5"></textarea>
                        </div>
                        <div>
                            <input class="btn" type="submit" name="enviar" value="Enviar">
                        </div>
                    </form>
                </div>
            </div>

            <p style="text-indent: 20px;">Puedes contactarnos directamente:</p>        
            <ul>
                <li><strong>Correo electrónico:</strong> <a href="mailto:info@naturefood.com">info@naturefood.com</a></li>
                <li><strong>Teléfono:</strong> 1-800-555-5555</li>
            </ul>
            
            <p style="text-indent: 20px;">También puedes encontrarnos en nuestras redes sociales:</p>
            <ul >
                <li class="RS">
                    <a href="https://www.twitter.com" target="_blank"> <img src="images/twitter.png" width="50px" height="50px"></a>
                </li>

                <li class="RS">
                    <a href="https://www.facebook.com" target="_blank"><img src="images/facebook.png" width="50px" height="50px"></a>
                </li>

                <li class="RS">
                    <a href="https://www.instagram.com" target="_blank"><img src="images/instagram.png" width="50px" height="50px"></a>
                </li>           
            </ul>   

            <div id="map" style="width: 80%; height: 40%; margin: 0 auto; border: 1px solid black;">
               
    -->

                <!-- clave de api AIzaSyDr8CnhGIXh0SNmq7A3hQPtMT9lAEs_3zQ                                               -->
    <!--        
                <script type="text/javascript">

                    function initMap() {
                        const myLatLng = { lat: 40.420328, lng: -3.705080 };
                        var map = new google.maps.Map(document.getElementById("map"), {
                            center: myLatLng,
                            zoom: 12
                        });
                        var contentString = '<?php /*echo "<h3>Nature\'s Food LTD</h3><p>C/Gran Vía nº2105</p>";*/?>';      SACAR EL ECHO DE COMENTARIO
                        var infowindow = new google.maps.InfoWindow({content: contentString});

                        var marker = new google.maps.Marker({
                            position: myLatLng,
                            map: map,
                            title: "Nature\'s Food"
                        });

                        marker.addListener('click', function(){
                            infowindow.open(
                                map,
                                marker
                            );
                        });
                    }

                </script>
                        
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDr8CnhGIXh0SNmq7A3hQPtMT9lAEs_3zQ&callback=initMap&v=weekly"></script>
            
            </div>     
        </div>
-->

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


/*Formulario y mapa*/

.formularioYmapa {
    text-align: center;
    width: 100%;
    margin-top: 40px;
}

.formulario{
    display: inline-block;
    width:48%;
    position: relative;
    top: -100px; 
}

.mapaYredes{
    display: inline-block;
    width:48%;
}

.alinearIzq{
    text-align: left;
}

.letraUsual{
    font-family: "Comic Neue";
    font-size: 20px; 
}

.camposForm {
	float: center;
	width: 160px;
	margin: 0px auto;
	padding-bottom: 20px;
	text-transform: uppercase;
	font-weight: bold;
	font-size: 13px;
	color: #323B2E;
}

.camposForm a {
	display: inherit;/*block ;contents*/
	width: 190px;
	padding: 5px 0px;
	background-color: #d9d9d9;
	border-top: 1px solid #EDEDED;
	border-bottom: 1px solid #B5B5B5;
	text-align: center;
	text-decoration: none;
	text-transform: uppercase;
	font-weight: bold;
	color: #808080 ;
}


/* Redes sociales*/

.RS{
    list-style-type: none;
    display: inline-block;
    vertical-align: top;
    padding: 0px 8px 0px 8px;
    }
.RS:hover{
    filter: opacity(70%);
}

/*Boton*/ 
.focoCampo input[type="text"],
.focoCampo input[type="email"],
.focoCampo input[type="tel"],
.focoCampo select,
.focoCampo textarea {
    border-radius: 0.25rem;
    border: 1px solid #ced4da;
    transition: border-color 0.2s ease-in-out;
}
    
.focoCampo input[type="text"]:focus,
.focoCampo input[type="email"]:focus,
.focoCampo input[type="tel"]:focus,
.focoCampo select:focus,
.focoCampo textarea:focus {
    outline: none;
    border-color:#00ff73;
}

.boton{
    background-color: green;
    cursor: pointer;
    font-family: Georgia, 'Times New Roman', Times, serif;
    font-size: 16px;
    font-weight: 200;
    padding: 15px;
    border-color: gold;
    border-width: 3px;
    margin-left:30%;
}

.boton:hover{
    background-color: greenyellow;
    border-color: greenyellow;
}


/*Footer*/

footer {
    background-color:grey;
	width: 100%;
	padding-top: 10px;
    padding-bottom: 10px;
}

.imagenFondo{
    /*text-align: center;*/
    background: url("images/4.jpg") center center fixed;
    /*background-size: cover;*/
    /*padding-bottom: 20px;*/
    /*padding-top: 1.2%;*/
    background-size: 50%;
    background-position: bottom;
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
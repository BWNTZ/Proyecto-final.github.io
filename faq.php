<html>
    <head>
        <title>Nature's Food LTD. Dudas.</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!--<link href="style.css" rel="stylesheet" type="text/css" />-->
        <link href="faqStyle.css" rel="stylesheet" type="text/css" />
        <script defer src="faq.js"></script>
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
        <main class="imagenFondo letraUsual">
            <div class="centrar">
                <h3 class="amarillo">Organic is The Future</h3></br>
                <h2 class="verde">Nature´s Food</h2></br></br>
                <p><strong>Preguntas más frecuentes</strong></p></br>
                
                <div class="Accordion">
                    <div class="Accordion-item">
                        <div class="Accordion-header header-1"><strong>¿Qué usas en lugar de gelatina de cerdo o de res?</strong>
                            <img src="images/angulo-hacia-abajo.png" alt="Icono" class="accordion-icon">
                        </div>
                        <div class="Accordion-content cuerpo">En nuestros dulces usamos pectina y en nuestras jaleas usamos carragenina que es un tipo de alga.</div>
                    </div>

                    <div class="Accordion-item">
                        <div class="Accordion-header header-n"><strong>¿Utiliza aceite de palma en sus productos?</strong>
                            <img src="images/angulo-hacia-abajo.png" alt="Icono" class="accordion-icon">
                        </div>
                        <div class="Accordion-content cuerpo">No, recientemente hemos realizado reformulaciones de productos para eliminar todo el aceite de palma de nuestros productos.</div>
                    </div>

                    <div class="Accordion-item">
                        <div class="Accordion-header header-n"><strong>¿Todos sus productos son orgánicos?</strong>
                            <img src="images/angulo-hacia-abajo.png" alt="Icono" class="accordion-icon">
                        </div>
                        <div class="Accordion-content cuerpo">La mayoría de nuestros productos lo son. Nuestro objetivo es producir productos orgánicos siempre que sea posible, aunque a veces esto 
                        es difícil debido a la falta de disponibilidad de materias primas. Sin embargo, todos nuestros productos están libres de transgénicos y 
                        nunca usamos colorantes, sabores o edulcorantes artificiales.</div>
                    </div>

                    <div class="Accordion-item">
                        <div class="Accordion-header header-n"><strong>¿Su embalaje es reciclable?</strong>
                            <img src="images/angulo-hacia-abajo.png" alt="Icono" class="accordion-icon">
                        </div>
                        <div class="Accordion-content cuerpo">Todas nuestras cajas están hechas de una fuente sostenible y son reciclables. Desafortunadamente, la película que usamos actualmente 
                        no es reciclable, pero estamos trabajando arduamente para encontrar una mejor solución para este tipo de empaque.</div>
                    </div>

                    <div class="Accordion-item">
                        <div class="Accordion-header header-n"><strong>¿Usas envases compostables?</strong>
                            <img src="images/angulo-hacia-abajo.png" alt="Icono" class="accordion-icon">
                        </div>
                        <div class="Accordion-content cuerpo">Siempre buscamos la solución de embalaje más sostenible para nuestros productos. Estamos trabajando arduamente para encontrar 
                        una película compostable que esté aprobada por la Soil Association y proteja los alimentos que vendemos de la mejor manera posible.</div>
                    </div>

                    <div class="Accordion-item">
                        <div class="Accordion-header header-final"><strong>¿Hacéis entregas en el extranjero?</strong>
                            <img src="images/angulo-hacia-abajo.png" alt="Icono" class="accordion-icon">
                        </div>
                        <div class="Accordion-content">Por favor vea nuestra página de Entrega para más detalles.</div>
                    </div>
                </div>
                
            </div>
        </main>
        <footer>
			<p>Copyright &copy; 2023 Designed by <strong>Bruno Wouters</strong>,<strong> Gaston Wouters</strong> and <strong>Rukaya Masmoudi Messaoud</strong></p>
        </footer>
    </body>
</html>

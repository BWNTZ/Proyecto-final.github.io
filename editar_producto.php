<?php
	require_once("control_sesion.php");
	require_once("database.php");
		
	controlSesionAdmin();
		
	$producto = obtenerProducto($_GET['editProd']);
			
	if($producto == 0){
		header("Location: admin.php");	
	} 
	else{
				
		$_SESSION['id_producto_update'] = $producto['id_producto'];
		
		echo "</br><br/><form method='post' class='letraUsual' action='#'>
			<strong>Nombre del producto: <strong/><input type='text' name='nombre' value='".$producto['nombre']."'><br/>
			<strong>Precio: <strong/><input type='text' name='precio' value='".$producto['precio']."'><br/>
            <strong>Descripcion: <strong/><input type='text' name='descripcion' value='".$producto['descripcion']."'><br/>
            <strong>Reseña: <strong/><input type='text' name='resenia' value='".$producto['resenia']."'><br/>
            <strong>Vendedor: <strong/><input type='text' name='vendedor' value='".$producto['vendedor']."'><br/>
            <strong>Categoria del producto: <strong/><select name='id_categoria'><br/>
			";
            if($producto['id_categoria']==1){
                echo "<option value='1' selected>Lácteos</option>
                    <option value='2' >Carnes</option>
                    <option value='3' >Frutas</option>
                    <option value='4'>Verduras</option>";
    
            }elseif ($producto['id_categoria']==2) {
                echo "<option value='1' >Lácteos</option>
                    <option value='2' selected>Carnes</option>
                    <option value='3' >Frutas</option>
                    <option value='4'>Verduras</option>";
            }
            elseif ($producto['id_categoria']==3) {
                echo "<option value='1' >Lácteos</option>
                    <option value='2' >Carnes</option>
                    <option value='3' selected>Frutas</option>
                    <option value='4'>Verduras</option>";
            }
            
            else{
                echo "<option value='1' >Lácteos</option>
                    <option value='2' >Carnes</option>
                    <option value='3' >Frutas</option>
                    <option value='4'selected>Verduras</option>";
            }

		echo "</select>
		</br></br><input type='submit' name='editar' value='Aceptar' class='boton-entrar'>
		</form>";
        if(isset($_POST['editar'])){
        if (!preg_match('/^\d+(\.\d{1,2})?$/', $_POST['precio'])) {
            echo "</br><p class='negritaRojo'>El precio debe ser un número y con máximo dos decimales</p>";

        } elseif (empty($_POST['nombre']) || empty($_POST['precio']) || empty($_POST['descripcion']) || empty($_POST['resenia']) || empty($_POST['vendedor'])){
                echo "</br><p class='negritaRojo'>Debes rellenar todos los campos</p>";
        }
        else {
            modificarProducto($_SESSION['id_producto_update'], $_POST['nombre'], $_POST['id_categoria'], $_POST['precio'], $_POST['descripcion'], $_POST['resenia'], $_POST['vendedor']);
            unset($_SESSION['id_producto_update']);
            echo "<script>window.location.href='admin.php';</script>";
            }
        }
	}
	//cerrarConexion($con);
?>

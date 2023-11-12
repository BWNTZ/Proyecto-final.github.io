<?php
$listaCategorias = listaCategorias($_SESSION['id_usuario']);
					
$resenia = 'No hay reseñas del producto.';

echo "<div>
        <h2 class='letraUsual colorDegradiant'>Pon tus productos a la venta.</h2>
        <div id='menu1' class='formVentaProd busqueda formBusqueda'>
            <form method='POST' action='".$_SERVER['PHP_SELF']."'>
                <label class='labelInput'>Nombre del Producto:</label><input type='text' name='nombre' class='inputs'/><br/><br/>
                <label class='labelInput'>Precio del Producto:</label><input type='text' name='precio' class='inputs'/><br/><br/>
                <label class='labelInput'>Descripción del Producto:</label><input type='text' name='descripcion' class='inputs'/><br/><br/>
                
                <label class='labelInput'>Vendedor del Producto:</label>".$usuario['nombre']."<br/><br/>
                <label class='labelInput'>Categoría:</label><select name='categoria' class='inputs'>";

    foreach ($listaCategorias as $categoria) {
        $array = json_decode(json_encode($categoria), true);
        echo "<option value='".$array['id_categoria']."'>".$array['nombre']."</option>";
    }

echo "</select><br/><br/>
        <input type='submit' class='boton-entrar' name='crear' value='Añadir'/>
    </form></div>";

if(isset($_POST['crear'])){
    if(empty($_POST['nombre'])){
        echo "<div class='negritaRojo'>Debes indicar el nombre del producto.</div><br/>";
    }
    elseif(empty($_POST['precio'])){
        echo "<div class='negritaRojo'>Debes indicar el precio del producto.</div><br/>";
    }
    elseif(empty($_POST['descripcion'])){
        echo "<div class='negritaRojo'>Debes darle una descripcion al producto.</div><br/>";
    }		
    else{
        insertaProducto($_POST['nombre'], $_POST['categoria'], $_POST['precio'], $_POST['descripcion'], $resenia, $usuario['nombre']);
    }
}
?>
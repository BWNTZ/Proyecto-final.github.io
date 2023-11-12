<?php
require_once("database.php");
if(isset($_POST['borrar'])){
    $codigos = $_POST['borrar'];
    borrarProducto($codigos);
}
//cerrar_conexion(); error
header("Location: admin.php");
?>


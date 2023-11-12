<?php
session_start();
require_once("database.php");

if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['confirm_password'])){
    $_SESSION['error_login2'] = "Debes introducir nombre de usuario y contraseñas";
    header("Location: login.php");
}
else{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    if($password != $confirm_password){
        $_SESSION['error_login2'] = "Las contraseñas no coinciden";
        header("Location: login.php");
    }
    else{
        // Verifica si el usuario ya existe
        $result = mysqli_query($con, "SELECT * FROM usuario WHERE nombre='$username'");
        if(mysqli_num_rows($result) > 0){
            $_SESSION['error_login2'] = "El nombre de usuario ya existe";
            header("Location: login.php");
        }
        else{
            // Crea el nuevo usuario
            $hash = password_hash($password, PASSWORD_DEFAULT);
            insertarUsuario($username, $hash, 1); // El tipo de usuario 1 es para clientes
            $_SESSION['username'] = $username;
            $_SESSION['tipo_usuario'] = 1;
            //echo "Usuario creado con exito";
            $_SESSION['exito'] = "Usuario creado con exito.";
            header ("Location: login.php");
        }
    }
}
?>

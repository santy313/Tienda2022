<?php
session_start();
include 'global/conexion.php';
include 'global/funcionesBBDD.php';
if (isset($_POST['userName']) && isset($_POST['userPassword'])) {
    $usuario = $_POST['userName'];
    $password = encriptar($_POST['userPassword']);
    if (empty($usuario) || empty($password)) {
        $error = "Debes introducir un nombre de usuario y una contraseña.";
    } else {
        // verificamos el usuario
        if (login($usuario, $password)) {
            $fila = login($usuario, $password);
            $_SESSION['usuario'] = $fila;
            header('Location: ./home.php');
        } else {
            $error = "Usuario o contraseña no válidos.";
        }
    }
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body class="fondoLogin" >  
        <div class="login-box">
            <img src="img/logo.png" class="avatar" alt="Avatar Image">
            <h1>Iniciar Sesión</h1>
            <form action="#" method="POST">
                <!-- ERROR SI NO SE INTRODUCE BIEN LOS DATOS -->
                <?php
                if (isset($error)) {
                    echo $error;
                }
                ?>
                <!-- USERNAME INPUT --> 
                <label for="userName">Usuario:</label>
                <input type="text" name="userName" placeholder="Nombre Usuario">

                <!-- PASSWORD INPUT -->
                <label for="userPassword">Contraseña</label>
                <input type="password" name="userPassword" placeholder="Contraseña">

                <!-- ENVIAR INPUT -->
                <input type="submit" name="enviar" value="Log In">
            </form>
        </div>
    </body>
</html>
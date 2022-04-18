<?php
session_start();
include 'global/conexion.php';
include 'global/funcionesBBDD.php';
if (isset($_SESSION['rol'])) {
    switch ($_SESSION['rol']) {
        case 1:
            header('location: index.php');
            break;
        case 2:
            header('location: index.php');
            break;
    }
}
if (isset($_POST['userName']) && isset($_POST['userPassword'])) {
    $usuario = $_POST['userName'];
    $password = $_POST['userPassword'];

    if (empty($usuario) || empty($password)) {
        $error = "Debes introducir un nombre o de usuario y una contraseña.";
    } else {
        // verificamos el usuario
        if (login($usuario, $password)) {
            $fila = login($usuario, $password);
            $_SESSION['usuario'] = $fila;
            $rol = $fila["idRol"];
            $_SESSION['rol'] = $rol;
            switch ($_SESSION['rol']) {
                case 1:
                    header('Location: ./administrador.php');
                    break;
                case 2:
                    header('Location: ./cliente.php');
                    break;
            }
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

        <link rel="stylesheet" type="text/css" href="css/sweetalert.css" />
        <script type="text/javascript" src="javascript/sweetalert.min.js"></script>

    </head>
    <body>  
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
<?php
include 'global/config.php';
include 'global/conexion.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    if (isset($_POST['enviar'])) {
        $usuario = $_POST['userName'];
        $password = $_POST['userPassword'];

        if (empty($usuario) || empty($password)) {
            $error = "Debes introducir un nombre o de usuario y una contraseña.";
        } else {
            //--- EJECUTAMOS LA CONSULTA ---///
            // $sql = 'SELECT * FROM users WHERE usuario="' . $_POST['userName'] . '" AND contrasena="' . $_POST['userPassword'] . '"';
            $sentencia = $pdo->prepare("SELECT * FROM users WHERE user_name=:userName AND user_pass=:pasword");
            $sentencia->bindParam(":userName", $_POST['userName']);
            $sentencia->bindParam(":pasword", $_POST['userPassword']);            
            $sentencia->execute();            
            if ($sentencia->rowCount() != 0) {
                session_start();
                $_SESSION['usuario'] = $usuario;
                header("Location: index.php");
            } else {
                $error = "Usuario o contraseña no válidos.";
            }
            unset($resultado);
        }
        unset($conexion);
    }
    ?>
    <div class="login-box">
        <img src="img/logo.png" class="avatar" alt="Avatar Image">
        <h1>Iniciar Sesión</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

            <!-- ERROR SI NO SE INTRODUCE BIEN LOS DATOS -->
            <?php
            if (isset($error)) {
                echo $error;
            }
            ?>
            <!-- USERNAME INPUT -->
            <label for="userName">Usuario</label>
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
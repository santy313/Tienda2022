<?php
if (isset($_POST['editar_cliente'])) {
    $usuario = $_POST['userName'];
    $password = encriptar($_POST['userPassword']);
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];

    if (empty($usuario) || empty($password))
        $error = "Debes introducir un nombre de usuario y una contraseña.";
} else {
    echo 'NO hay formulario';
}


<?php

session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ./login.php");
}
include_once '../global/funcionesBBDD.php';

if (isset($_POST['editar_cliente'])) {
    $Usuario = $_POST['idUsuario'];
//    $usuario = $_POST['userName'];
//    $password = encriptar($_POST['userPassword']);
//    $nombre = $_POST['nombre'];
//    $apellido = $_POST['apellido'];   
    echo'<pre>';
    print_r($_SESSION['usuario']);
    echo'</pre>';

    if (!empty($_POST['userName'])) {
        if ($_POST['userName'] != $_SESSION['usuario']['user_name']) {
            actualizarDatosCliente('user_name', $_POST['userName'], $_SESSION['usuario']['IdUsuario']);
        }
    }
    if (!empty($_POST['userPassword'])) {
        if (encriptar($_POST['userPassword']) != $_SESSION['usuario']['user_pass']) {
            actualizarDatosCliente('user_pass', encriptar($_POST['userPassword']), $_SESSION['usuario']['IdUsuario']);
        }
    }
    if (!empty($_POST['nombre'])) {
        if ($_POST['nombre'] != $_SESSION['usuario']['nombre']) {
            actualizarDatosCliente('nombre', $_POST['nombre'], $_SESSION['usuario']['IdUsuario']);
        }
    }
    if (!empty($_POST['apellido'])) {
        if ($_POST['apellido'] != $_SESSION['usuario']['apellido']) {
            actualizarDatosCliente('apellido', $_POST['apellido'], $_SESSION['usuario']['IdUsuario']);
        }
    }
} else {
    echo 'NO hay formulario';
}


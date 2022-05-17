<?php

include_once '../global/funcionesBBDD.php';

if (isset($_POST['nuevo_tiempo'])) {
    $idUsuario = desencriptar($_POST['idUsuario']);
    $nombreTiempo = $_POST['nombreTiempo'];
    $numeroKarts = $_POST['numeroKarts'];
    $user_name = $_POST['user_name'];
    $seg = minutosasegundos($_POST['minutos'], $_POST['segundos']);

    if (empty($nombreTiempo)) {
//        se utilia user_name al estar el campo nick name vacio                
        nuevoTiempoBBDD($user_name, $numeroKarts, $seg, $idUsuario);
    } else {
        nuevoTiempoBBDD($nombreTiempo, $numeroKarts, $seg, $idUsuario);
    }
}if (isset($_POST['borrar_tiempo'])) {
    $idMejorTiempo = desencriptar($_POST['idMejorTiempo']);
    boorarMejorTiempo($idMejorTiempo);
} else {
    echo 'NO hay formulario';
}
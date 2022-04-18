<?php

function login($usuario, $password) {
    $conexion = abrir_conexion_mysqli();
    $sql = 'SELECT * FROM users WHERE user_name="' . $usuario . '"AND user_pass="' . $password . '"';
    $resultado = $conexion->query($sql);
    $mostrar = $resultado->fetch_array(MYSQLI_ASSOC);
    cerrar_conexion_mysqli($conexion);
    return $mostrar;
}

function cargarProductos() {
    $conexion = abrir_conexion_mysqli();
    $sql = 'SELECT * FROM `productos`';
    $resultado = $conexion->query($sql);
    $respuesta;
    while ($mostrar = $resultado->fetch_array(MYSQLI_ASSOC)) {
        $respuesta[$mostrar['ID']] = $mostrar;
    }
    cerrar_conexion_mysqli($conexion);
    return $respuesta;
}

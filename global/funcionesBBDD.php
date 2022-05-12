<?php

function login($usuario, $password) {
    $conexion = abrir_conexion_mysqli();
    $sql = 'SELECT * FROM users u INNER JOIN record r on u.IdUsuario=r.IdUsuario WHERE user_name="' . $usuario . '"AND user_pass="' . $password . '"';
    $resultado = $conexion->query($sql);
    $mostrar = $resultado->fetch_array(MYSQLI_ASSOC);
    cerrar_conexion_mysqli($conexion);
    return $mostrar;
}

function desencriptar($word) {
    return openssl_decrypt($word, COD, KEY);
}

function encriptar($word) {
    return openssl_encrypt($word, COD, KEY);
}

function cargarProductos() {
    $conexion = abrir_conexion_mysqli();
    $sql = 'SELECT * FROM `productos`';
    $resultado = $conexion->query($sql);
    $respuesta;
    while ($mostrar = $resultado->fetch_array(MYSQLI_ASSOC)) {
        $respuesta[$mostrar['IdProducto']] = $mostrar;
    }
    cerrar_conexion_mysqli($conexion);
    return $respuesta;
}

function cargarTiemposPersonal($id) {
    $conexion = abrir_conexion_mysqli();
    $sql = 'SELECT * FROM users u INNER JOIN record r on u.IdUsuario=r.IdUsuario INNER JOIN kart k on r.IdKart=k.IdKart WHERE u.IdUsuario=' . $id;
    $resultado = $conexion->query($sql);
    $tiempos;
    while ($mostrar = $resultado->fetch_array(MYSQLI_ASSOC)) {
        $tiempos[$mostrar['IdRecord']] = $mostrar;
    }
    cerrar_conexion_mysqli($conexion);
    return $tiempos;
}

function cargarMejorTiempoPersonal($id) {
    $conexion = abrir_conexion_mysqli();
    $sql = 'SELECT * FROM users u INNER JOIN record r on u.IdUsuario=r.IdUsuario INNER JOIN kart k on r.IdKart=k.IdKart WHERE u.IdUsuario=' . $id;
    $resultado = $conexion->query($sql);
    $tiempos;
    while ($mostrar = $resultado->fetch_array(MYSQLI_ASSOC)) {
        $tiempos[$mostrar['IdUsuario']] = $mostrar;
    }
    cerrar_conexion_mysqli($conexion);
    return $tiempos;
}

function conversorSegundosHoras($tiempo_en_segundos) {
    $horas = floor($tiempo_en_segundos / 3600);
    $minutos = floor(($tiempo_en_segundos - ($horas * 3600)) / 60);
    $segundos = $tiempo_en_segundos - ($horas * 3600) - ($minutos * 60);

    $hora_texto = "";
    if ($horas > 0) {
        $hora_texto .= $horas . "h ";
    }

    if ($minutos > 0) {
        $hora_texto .= $minutos . "m ";
    }

    if ($segundos > 0) {
        $hora_texto .= $segundos . "s";
    }

    return $hora_texto;
}

function mostrarSelectMysql($campo, $tabla) {
    $conexion = abrir_conexion_mysqli();
    $sql = 'SELECT * FROM ' . $tabla;
    $resultado = mysqli_query($conexion, $sql);
    while ($fila = $resultado->fetch_array()) {
        echo '<option value="' . $fila[0] . '">' . $fila[$campo] . '</option>';
    }
    cerrar_conexion_mysqli($conexion);
}

<?php
define("KEY", "@ProyectoFinal2022");
define("COD", "AES-128-ECB");

function abrir_conexion_mysqli() {

    $conexion = mysqli_connect('localhost', 'root', '', 'circuitoalhama');
    $error = mysqli_errno($conexion);
    if ($error != null) {
        echo '<p>Error ' . $error . ' conectando a la base de datos:</p>';
    } else {
        mysqli_set_charset($conexion, "utf8");
        return $conexion;
    }
}

function cerrar_conexion_mysqli($conexion) {
    mysqli_close($conexion);
}

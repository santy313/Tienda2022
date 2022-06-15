<?php

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

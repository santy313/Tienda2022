<?php

include './global/conexion.php';
$conexion = abrir_conexion_mysqli();
$sql = 'SELECT * FROM `productos`';
$resultado = $conexion->query($sql);
$regreso;
while ($mostrar = $resultado->fetch_array(MYSQLI_ASSOC)){
    $regreso[$mostrar['ID']]=$mostrar;    
}
echo '<pre>';
print_r($regreso);
echo '</pre>';
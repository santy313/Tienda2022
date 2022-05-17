<?php
include 'global/conexion.php';
include './global/funcionesBBDD.php';
?>
<!doctype html>
<html lang="en">
    <head>
        <?php include './templates/cabecera.php'; ?>        
    </head>
    <body>
        <?php
        $min=3;
        $segun=0;
        $se = minutosasegundos($min, $segun);
        echo 'milisegundos= ' . $se;
        echo '<br/>';
        echo conversorSegundosHoras($se);
        ?>
    </body>
</html>
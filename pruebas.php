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
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Nº Kart</th>
                    <th>Categoria</th>
                    <th>Tiempos</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <!-- CARGA DE MEJORES TIEMPOS -->                
                    <?php
                    $listaTiempos = cargarTiempoPersonal(2);
                    print_r($listaTiempos);
                    foreach ($listaTiempos as $indice => $tiempos) {
                        echo '<br>: '.$tiempos['Nombre'].'<br>';
                        ?>                        
                        <td><?php echo $tiempos['Nombre'] ?></td>                        
                    <?php } ?>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                </tr>                                    
            </tbody>
        </table>
    </body>
</html>
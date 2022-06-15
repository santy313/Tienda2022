<div class="row">
    <div class="col-md-8">
        <table id='tiempos' class="table table-striped  table-responsive">
            <thead>
                <tr>
                    <th>NOMBRE</th>
                    <th>CATEGORIA</th>
                    <th>Nº KART</th>                                                
                    <th>TIEMPOS</th>
                    <th>FECHA</th>
                    <th>BORRAR</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($_SESSION['usuario']['idRol'] == 1) {
                    $listaTiempos = cargarTiemposClientes();
                } else {
                    $listaTiempos = cargarTiemposPersonal($_SESSION['usuario']['IdUsuario']);
                }
                if ($listaTiempos != null) {
                    foreach ($listaTiempos as $indice => $tiempos) {
                        ?>
                        <tr>
                            <td><?php echo $tiempos['user_name'] ?></td>
                            <td><?php echo $tiempos['id_TipoKart'] ?></td>
                            <td><?php echo $tiempos['nombreKarts'] ?></td>                                                    
                            <td><?php echo conversorSegundosHoras($tiempos['mejorTiempo']); ?></td>
                            <td><?php echo $tiempos['fechaRecord'] ?></td>
                            <td>
                                <form  action="./formularios/tiempos.php" method="POST">
                                    <input type="hidden" name="idMejorTiempo" value="<?php echo encriptar($tiempos['IdRecord']) ?>">
                                    <input type="hidden" name="rolUsuario" value="<?php echo $_SESSION['usuario']['idRol'] ?>">
                                    <button type="submit" class="btn btn-primary" name="borrar_tiempo" value="aceptar">X</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo '<tr><td colspan="6"><h1>Sin tiempos!!</h1></td></tr>';
                }
                ?>
            </tbody>
        </table>
        <!--FIN TABLA MEJORES TIEMPOS-->
    </div>
    <!-- AÑADIR UN NUEVO TIEMPO -->
    <?php if ($_SESSION['usuario']['idRol'] == 2) { ?>
        <div class="col-md-4">
            <h3 class="mb-3 font-weight-bold">Añadir Nuevo Tiempo</h3>
            <!-- ERROR SI NO SE INTRODUCE DATOS PARA AÑADIR NUEVO TIEMPO -->
            <?php
            if (isset($error)) {
                echo $error;
            }
            ?>
            <!-- FIN ERROR SI NO SE INTRODUCE DATOS PARA AÑADIR NUEVO TIEMPO -->
            <form action="./formularios/tiempos.php" method="POST">
                <div class="form-group">
                    <label for="nombre">NICK NAME</label>
                    <input type="text" class="form-control" name="nombreTiempo">
                    <input type="hidden" name='idUsuario' value="<?php echo encriptar($_SESSION['usuario']['IdUsuario']); ?>" >
                    <input type="hidden" name='user_name' value="<?php echo $_SESSION['usuario']['user_name']; ?>" >
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Example select</label>
                    <select class="form-control" name="numeroKarts">
                        <?php mostrarSelectMysql("nombreKarts", "kart"); ?> 
                    </select>
                </div>
                <div class="form-group">
                    <label for="nuevoTiempo">Nuevo Tiempo </label>
                    <div>
                        <label for="minutos">Minutos: </label>
                        <input type="number" value="1" min="0" max="59" name="minutos" placeholder="1">
                        <label for="segundos">Segundos: </label>
                        <input type="number" value="0" min="0" max="59" name="segundos" placeholder="0">
                    </div>                                            
                </div>
                <div class="form-group">
                    <input type="hidden" name="rolUsuario" value="<?php echo $_SESSION['usuario']['idRol'] ?>">
                    <button type="submit" class="btn btn-primary" name="nuevo_tiempo" value="aceptar">OK</button>
                </div>
            </form>                                                           
        </div>
    <?php } ?>
    <!-- FIN AÑADIR UN NUEVO TIEMPO -->
</div>
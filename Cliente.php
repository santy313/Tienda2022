<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ./login.php");
}
include 'global/conexion.php';
include 'global/funcionesBBDD.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include './templates/cabecera.php'; ?>
    </head>
    <body>
        <?php include './templates/menu.php'; ?>
        <div class="container">                        
            <!------------------------------------------------------------------------------------------------------------------->
            <div class="tabs-to-dropdown">
                <div class="nav-wrapper d-flex align-items-center justify-content-between">
                    <ul class="nav nav-pills d-none d-md-flex" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="pills-company-tab" data-toggle="pill" href="#pills-company" role="tab" aria-controls="pills-company" aria-selected="true">Datos Personales</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-product-tab" data-toggle="pill" href="#pills-product" role="tab" aria-controls="pills-product" aria-selected="false">Tiempos</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-news-tab" data-toggle="pill" href="#pills-news" role="tab" aria-controls="pills-news" aria-selected="false">News</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</a>
                        </li>
                    </ul>                    
                </div>
                <!-- INICIO DATOS PERSONALES-->

                <div class="tab-content p-2" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-company" role="tabpanel" aria-labelledby="pills-company-tab">
                        <div class="container-fluid">                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card" style="width: 18rem;">                                        
                                        <ul class="list-group list-group-flush">
                                            <li class="font-weight-bold list-group-item">Nombre: <?php echo strtoupper($_SESSION['usuario']['nombre']); ?></li>
                                            <li class="font-weight-bold list-group-item">Apellido: <?php echo strtoupper($_SESSION['usuario']['apellido']); ?></li>
                                            <li class="font-weight-bold list-group-item">Usuario: <?php echo strtoupper($_SESSION['usuario']['user_name']); ?> </li>
                                            <li class="font-weight-bold list-group-item">Contraseña: <?php echo desencriptar($_SESSION['usuario']['user_pass']); ?> </li>
                                        </ul>                                    
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h2 class="mb-3 font-weight-bold">¿Qué datos quieres actualizar?</h2>   
                                    <form action="./formularios/editar_cliente.php" method="POST">
                                        <div class="form-row">                
                                            <div class="form-group col-md-6">
                                                <label for="login">LOGIN </label>
                                                <input type="text" class="form-control" name="userName" id="login">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="contrasenha">CONTRASEÑA</label>
                                                <input type="password" class="form-control" name="userPassword" id="contrasenha">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="nombre">NOMBRE</label>
                                                <input type="text" class="form-control" name="nombre" id="nombre">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="apellido">APELLIDO</label>
                                                <input type="text" class="form-control" name="apellido" id="apellido">
                                            </div>
                                        </div>                                
                                        <legend>Mejor Tiempo </legend>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">                            
                                                <input type="text" class="form-control" id="mejorTiempo" disabled="false" value="<?php echo $_SESSION['usuario']['mejorTiempo']; ?>" placeholder="<?php echo $_SESSION['usuario']['mejorTiempo']; ?>" >
                                            </div>                    
                                        </div>                                
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                            ACEPTAR
                                        </button>
                                        <!-- fin Button trigger modal -->
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Guardar Cambios</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ESTAS SEGURO? 
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>                                                
                                                        <button type="submit" class="btn btn-primary" name="editar_cliente" value="aceptar">OK</button>                                                
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Fin Modal -->                                
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>                
                    <!-- FIN DATOS PERSONALES -->
                    <div class="tab-pane fade" id="pills-product" role="tabpanel" aria-labelledby="pills-product-tab">
                        <div class="container-fluid">
                            <h2 class="mb-3 font-weight-bold">Mejores Tiempos</h2>
                            <!-- INICIO TABLA MEJORES TIEMPOS-->
                            <div class="row">
                                <div class="col-md-8">
                                    <table class="table table-responsive">
                                        <thead>
                                            <tr>
                                                <th>NOMBRE</th>
                                                <th>CATEGORIA</th>
                                                <th>Nº KART</th>                                                
                                                <th>TIEMPOS</th>
                                                <th>FECHA</th>
                                            </tr>
                                        </thead>
                                        <tbody>                                    
                                            <?php
                                            $listaTiempos = cargarTiemposPersonal($_SESSION['usuario']['IdUsuario']);
                                            foreach ($listaTiempos as $indice => $tiempos) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $tiempos['user_name'] ?></td>
                                                    <td><?php echo $tiempos['id_TipoKart'] ?></td>
                                                    <td><?php echo $tiempos['nombreKarts'] ?></td>                                                    
                                                    <td><?php echo conversorSegundosHoras($tiempos['mejorTiempo']); ?></td>
                                                    <td><?php echo $tiempos['fechaRecord'] ?></td>
                                                </tr>
                                            <?php } ?>                                    
                                        </tbody>
                                    </table>
                                    <!--FIN TABLA MEJORES TIEMPOS-->
                                </div>
                                <div class="col-md-4">
                                    <h3 class="mb-3 font-weight-bold">Añadir Nuevo Tiempo</h3>
                                    <form>
                                        <div class="form-group">
                                            <label for="nombre">NOMBRE </label>
                                            <input type="text" class="form-control" id="nombreTiempo">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Example select</label>
                                            <select class="form-control" id="exampleFormControlSelect1">
                                                <?php mostrarSelectMysql("nombreKarts", "kart"); ?> 
                                            </select>
                                        </div>                                        
                                    </form>
                                    <p>Participante</p>                                    
                                    <p>Mejor Tiempo</p>
                                    <p>Fecha</p>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="tab-pane fade" id="pills-news" role="tabpanel" aria-labelledby="pills-news-tab">
                        <div class="container-fluid">
                            <h2 class="mb-3 font-weight-bold">News</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce porttitor leo nec ligula viverra, quis facilisis nunc vehicula. Maecenas purus orci, efficitur in dapibus vel, rutrum in massa. Sed auctor urna sit amet eros mattis interdum. Integer imperdiet ante in quam lacinia, a laoreet risus imperdiet.</p>
                            <p>Proin maximus iaculis rhoncus. Morbi ante nibh, facilisis semper faucibus consequat, facilisis ut ante. Mauris at nisl vitae justo auctor imperdiet. Cras sodales, justo sed tincidunt venenatis, ante erat ultricies eros, at mollis eros lorem ac mi. Fusce sagittis nibh nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Donec mollis eros sodales convallis faucibus. Vestibulum sit amet odio lectus. Duis eu dolor vitae est venenatis viverra eu sit amet nisl. Aenean vel sagittis odio. Quisque in lacus orci. Etiam ut odio lobortis odio consectetur ornare.</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <div class="container-fluid">
                            <h2 class="mb-3 font-weight-bold">Contact</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce porttitor leo nec ligula viverra, quis facilisis nunc vehicula. Maecenas purus orci, efficitur in dapibus vel, rutrum in massa. Sed auctor urna sit amet eros mattis interdum. Integer imperdiet ante in quam lacinia, a laoreet risus imperdiet.</p>
                            <p>Proin maximus iaculis rhoncus. Morbi ante nibh, facilisis semper faucibus consequat, facilisis ut ante. Mauris at nisl vitae justo auctor imperdiet. Cras sodales, justo sed tincidunt venenatis, ante erat ultricies eros, at mollis eros lorem ac mi. Fusce sagittis nibh nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Donec mollis eros sodales convallis faucibus. Vestibulum sit amet odio lectus. Duis eu dolor vitae est venenatis viverra eu sit amet nisl. Aenean vel sagittis odio. Quisque in lacus orci. Etiam ut odio lobortis odio consectetur ornare.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <?php
        include 'templates/footer.php'
        ?>
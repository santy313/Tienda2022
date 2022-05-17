<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ./login.php");
}
require_once 'global/conexion.php';
require_once 'global/funcionesBBDD.php';
?>
<!DOCTYPE html>
<html><head>
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
                            <a class="nav-link" id="pills-news-tab" data-toggle="pill" href="#pills-news" role="tab" aria-controls="pills-news" aria-selected="false">Usuarios</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Nuevo Usuario</a>
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
                                        <?php
                                        $cliente = cargarDatosCliente($_SESSION['usuario']['IdUsuario']);
                                        ?>
                                        <ul class="list-group list-group-flush">
                                            <li class="font-weight-bold list-group-item">Nombre: <?php echo strtoupper($cliente['nombre']); ?></li>
                                            <li class="font-weight-bold list-group-item">Apellido: <?php echo strtoupper($cliente['apellido']); ?></li>
                                            <li class="font-weight-bold list-group-item">Usuario: <?php echo strtoupper($cliente['user_name']); ?> </li>
                                            <li class="font-weight-bold list-group-item">Contraseña: <?php echo desencriptar($cliente['user_pass']); ?> </li>
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
                                                <input type="hidden" value=" <?php echo $_SESSION['usuario']['IdUsuario']; ?>" name='idUsuario'>
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
                                                <input type="text" class="form-control" id="mejorTiempo" disabled="false" placeholder="<?php echo cargarMejorTiempoPersonal(cargarTiemposPersonal($_SESSION['usuario']['IdUsuario'])) ?>" >
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
                                                <th>BORRAR</th>
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
                                                    <td>
                                                        <form  action="./formularios/tiempos.php" method="POST">
                                                            <input type="hidden" name="idMejorTiempo" value="<?php echo encriptar($tiempos['IdRecord']) ?>">
                                                            <button type="submit" class="btn btn-primary" name="borrar_tiempo" value="aceptar">X</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php } ?>                                    
                                        </tbody>
                                    </table>
                                    <!--FIN TABLA MEJORES TIEMPOS-->
                                </div>                                
                            </div>
                        </div>                        
                    </div>
                    <div class="tab-pane fade" id="pills-news" role="tabpanel" aria-labelledby="pills-news-tab">
                        <div class="container-fluid">
                            <h2 class="mb-3 font-weight-bold">Clientes</h2>
                            <!-- INICO CARGA DE CLIENTES-->
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-responsive">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>NICK NAME</th>
                                                <th>CONTRASEÑA</th>
                                                <th>NOMBRE</th>                                                
                                                <th>APELLIDO</th>
                                                <th>FECHA NACIMIENTO</th>
                                                <th>BORRAR/MODIFICAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>                                    
                                            <?php
                                            $listaClientes = cargarClientes();                                            
                                            foreach ($listaClientes as $indice => $cliente) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $cliente['IdUsuario'] ?></td>
                                                    <td><?php echo $cliente['user_name'] ?></td>
                                                    <td><?php echo desencriptar($cliente['user_pass']); ?></td>
                                                    <td><?php echo $cliente['nombre'] ?></td>
                                                    <td><?php echo $cliente['apellido'] ?></td>
                                                    <td><?php echo $cliente['fecha_nacimiento'] ?></td>
                                                    <td>
                                                        <form  action="#" method="POST">
                                                            <input type="hidden" name="idCliente" value="<?php echo encriptar($cliente['IdUsuario']) ?>">
                                                            <button type="submit" class="btn btn-primary" name="borrar_cliente" value="aceptar">X</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php } ?>                                    
                                        </tbody>
                                    </table>
                                    <!--FIN TABLA MEJORES TIEMPOS-->
                                </div>                                
                            </div>
                            <!-- FIN INICO CARGA DE CLIENTES-->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <div class="container-fluid">
                            <h2 class="mb-3 font-weight-bold">Contact</h2>
                            <!-------------------- FORMULARIO ALTA USUARIO -->
                            <form>
                                <input type="hidden" value="<?php echo $_SESSION['usuario']['IdUsuario'] ?>">
                                <label>Nombre</label>
                                <label>Apellido</label>
                            </form>
                            <!--------------- FIN  FORMULARIO ALTA USUARIO -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <?php
        include 'templates/footer.php'
        ?>
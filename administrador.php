<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ./home.php");
}
require_once 'global/conexion.php';
require_once 'global/funcionesBBDD.php';
require_once 'global/funcionesTiempos.php';
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
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="imprimir-tab" data-toggle="pill" href="#imprimir" role="tab" aria-controls="imprimir" aria-selected="false">Imprimir</a>
                        </li>                        

                    </ul>                    
                </div>
                <!-- INICIO DATOS PERSONALES-->               
                <?php include './formularios/formularioDatosPersonales.php'; ?>
                <!-- FIN DATOS PERSONALES -->                
                <div class="tab-pane fade" id="pills-product" role="tabpanel" aria-labelledby="pills-product-tab">
                    <div class="container-fluid">
                        <h2 class="mb-3 font-weight-bold">Mejores Tiempos</h2>                            
                        <!-- INICIO TABLA MEJORES TIEMPOS-->
                        <?php include './templates/tablaTiempos.php'; ?>
                        <!-- FIN TABLA MEJORES TIEMPOS-->
                    </div>                        
                </div>
                <div class="tab-pane fade" id="pills-news" role="tabpanel" aria-labelledby="pills-news-tab">
                    <div class="container-fluid">
                        <h2 class="mb-3 font-weight-bold">Clientes</h2>
                        <!-------------> 
                        <!-------------> 
                        <!------------->
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
                                                    <!------------->
                                                    <!------------->
                                                    <!--formulario para eliminar un usuario-->
                                                    <form  action="./formularios/clientes.php" method="POST">
                                                        <input type="hidden" name="idCliente" value="<?php echo encriptar($cliente['IdUsuario']) ?>">
                                                        <button type="submit" class="btn btn-primary" name="borrar_cliente" value="aceptar">X</button>                                                            
                                                        <button type="submit" class="btn btn-primary" name="editar_cliente" value="editar" formaction="../Tienda2022/formularios/formularioEditarCliente.php" >M</button>
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
                        <h2 class="mb-3 font-weight-bold">Alta Nuevo Cliente</h2>
                        <!-------------------- FORMULARIO ALTA USUARIO -->
                        <form action="./formularios/clientes.php" method="POST">
                            <div class="form-row">                
                                <div class="form-group col-md-6">
                                    <label for="login">LOGIN: </label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">@</div>
                                        </div>
                                        <input type="text" class="form-control" name="userName" placeholder="Username">
                                    </div>                                        
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="contrasenha">CONTRASEÑA</label>
                                    <input type="password" class="form-control" name="userPassword" id="contrasenha">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nombre">NOMBRE USUARIO</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="apellido">APELLIDOS USUARIO</label>
                                    <input type="text" class="form-control" name="apellido" id="apellido">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nombre">DIRECCION</label>
                                    <input type="text" class="form-control" name="direccion" id="direccion">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="apellido">DNI</label>
                                    <input type="text" class="form-control" name="dni" id="dni">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nombre">EMAIL</label>
                                    <input type="email" class="form-control" name="email" id="email">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nombre">FECHA DE NACIMIENTO</label>
                                    <input type="date" class="form-control" name="fecha" id="fecha">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="rol">ROL:</label>
                                    <select class="form-control" name="rol">
                                        <option value="2">Cliente</option>
                                        <option value="1">Administrador</option>                                            
                                    </select>

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nombre">SALARIO</label>
                                    <input type="number" min="0" placeholder="0" value="0" class="form-control" name="salario" id="salario">
                                </div>                                    
                            </div>                                
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevoUsuarioModal">
                                ACEPTAR
                            </button>
                            <!-- fin Button trigger modal -->
                            <!-- -->
                            <!-- -->
                            <!-- -->
                            <!-- Modal -->
                            <div class="modal fade" id="nuevoUsuarioModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Revisando los datos...</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <!-- <div class="modal-body"></div>-->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>                                                
                                            <button type="submit" class="btn btn-primary" name="nuevo_cliente" value="aceptar">OK</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Fin Modal -->                                
                        </form>
                        <!--------------- FIN  FORMULARIO ALTA USUARIO -->
                    </div>
                </div>
                <div class="tab-pane fade" id="imprimir" role="tabpanel" aria-labelledby="imprimir-tab">
                    <div class="container-fluid">
                        <h2 class="mb-3 font-weight-bold">Mejores Tiempos</h2>    
                        <?php include './formularios/formularioPdf.php'; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <script>
        $(document).ready(function () {
            $('#tiempos').DataTable();
        });
    </script>
    <?php
    include 'templates/footer.php'
    ?>
</body>
</html>
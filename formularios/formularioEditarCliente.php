<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ./login.php");
}
require_once '../global/conexion.php';
require_once '../global/funcionesBBDD.php';
require_once '../global/funcionesTiempos.php';

if (isset($_POST['editar_cliente'])) {
    $cliente = cargarDatosCliente(desencriptar($_POST['idCliente']));
}
?>
<!DOCTYPE html>
<html><head>
        <?php include '../templates/cabecera.php'; ?>
    </head>
    <body>
        <?php include '../templates/menu.php'; ?>
        <div class="container">
            <div class="col-md-12">
                <h2 class="mb-3 font-weight-bold">¿Qué datos quieres actualizar?</h2>   
                <form action="clientes.php" method="POST">
                    <div class="form-row">                
                        <div class="form-group col-md-6">
                            <label for="login">LOGIN: </label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">@</div>
                                </div>
                                <input type="text" class="form-control" name="userName" >
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
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="<?php echo $cliente['nombre']; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="apellido">APELLIDOS USUARIO</label>
                            <input type="text" class="form-control" name="apellido" id="apellido" placeholder="<?php echo $cliente['apellido']; ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nombre">DIRECCION</label>
                            <input type="text" class="form-control" name="direccion" id="direccion" placeholder="<?php echo $cliente['direccion']; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="apellido">DNI</label>
                            <input type="text" class="form-control" name="dni" id="dni" placeholder="<?php echo $cliente['dni']; ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nombre">EMAIL</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="<?php echo $cliente['email']; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nombre">FECHA DE NACIMIENTO</label>
                            <input type="date" class="form-control" name="fecha" value="<?php echo date($cliente['fecha_nacimiento']); ?>" id="fecha" >
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="rol">ROL:</label>
                            <select class="form-control" name="rol">
                                <?php
                                if ($cliente['idRol'] == 1) {
                                    echo '<option value="2">Cliente</option> <option value="1" selected>Administrador</option>';
                                } else {
                                    echo '<option value="2" selected>Cliente</option> <option value="1">Administrador</option>';
                                }
                                ?>                                

                            </select>

                        </div>
                        <div class="form-group col-md-6">
                            <label for="nombre">SALARIO</label>
                            <input type="number" min="0" placeholder="<?php echo $cliente['salario']; ?>" value="0" class="form-control" name="salario" id="salario">
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
                                    <h5 class="modal-title" id="exampleModalLabel">Revisando Datos...</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Actualizando Datos!
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <input type="hidden" value=" <?php echo encriptar($cliente['IdUsuario']); ?>" name='idUsuario'>
                                    <button type="submit" class="btn btn-primary" name="actualizar_cliente" value="aceptar">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fin Modal -->                                
                </form>
            </div>            
        </div>

        <?php
        include '../templates/footer.php'
        ?>
    </body>
</html>
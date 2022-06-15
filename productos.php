<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ./login.php");
}
include 'global/conexion.php';
include './global/funcionesBBDD.php';
include './global/funcionesProductos.php';
include 'carrito.php';
?>
<!DOCTYPE html>
<html>
    <?php include './templates/cabecera.php'; ?>
    <body>
        <?php include './templates/menu.php'; ?>
        <div class="container">            
            <p>Usuario: <?php print_r($_SESSION['usuario']['nombre']) ?>
                <?php if ($mensaje != "") { ?>
                <div class="alert alert-success">
                    <?php echo $mensaje; ?>
                    <a href="../../Tienda2022/mostrar_carrito.php" class="badge badge-success"> Ver Carrito</a>
                </div>        
            <?php } ?>
            <div class="row">                
                <!-- CARGA DE PRODUCTOS -->                
                <?php
                $listaProductos = cargarProductos();
                foreach ($listaProductos as $indice => $producto) {
                    ?>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                        <div class="card mb-4">
                            <img title="<?php echo $producto['Nombre']; ?>" alt="<?php echo $producto['Nombre']; ?>" class="card-img-top" src="<?php echo $producto['Imagen']; ?>" data-toggle="popover" data-trigger="hover" data-content="<?php echo $producto['Descripcion']; ?>">
                            <div class="card-body ">
                                <span><?php echo $producto['Nombre']; ?></span>
                                <h5 class="card-title"><?php echo $producto['Precio']; ?>€</h5>
                                <!-- <p class="card-text"><?php echo $producto['Descripcion']; ?></p> -->

                                <!-- boton compra producto -->                                
                                <form action="" method="post">
                                    <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['IdProducto'], COD, KEY); ?>">
                                    <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['Nombre'], COD, KEY); ?>">
                                    <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['Precio'], COD, KEY); ?>">
                                    <input type="number" name="cantidad" id="cantidad" min="1" placeholder="1" value="1"> 
                                    <hr>
                                    <button class="btn btn-primary" name="btnAccion" value="Agregar" type="submit">
                                        Agregar al carrito
                                    </button>
                                </form>                                
                                <!-- fin boton compra producto -->
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- FIN CARGA DE PRODUCTOS -->
            </div>
            <script>
                $(function () {
                    $('[data-toggle="popover"]').popover();
                });
            </script>
        </div>
        <?php
        include 'templates/footer.php'
        ?>
    </body>
</html>
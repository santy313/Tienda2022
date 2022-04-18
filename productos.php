<?php
include 'global/conexion.php';
include './global/funcionesBBDD.php';
include 'carrito.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/sweetalert.css" />
        <script type="text/javascript" src="javascript/sweetalert.min.js"></script>
        <script type="text/javascript" src="javascript/validar.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php include 'templates/menu.php'; ?>
        <div class="container">
            <br>
            <p>Usuario: <?php print_r($_SESSION['usuario']['nombre']) ?>
                <?php if ($mensaje != "") { ?>
                <div class="alert alert-success">
                    <?php echo $mensaje; ?>
                    <a href="mostrarCarrito.php" class="badge badge-success"> Ver Carrito</a>
                </div>        
            <?php } ?>
            <div class="row">                
                <!-- CARGA DE PRODUCTOS -->                
                <?php
                $listaProductos = cargarProductos();
//                foreach ($listaProductos as $indice => $producto) {
//                    echo 'p: ' . $producto ['Nombre'] . '<br/>';
//                    echo 'p: ' . $producto ['Precio'] . '<br/>';
//                }

                foreach ($listaProductos as $indice => $producto) {                                        
                    ?>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                        <div class="card">
                            <img title="<?php echo $producto['Nombre']; ?>" alt="<?php echo $producto['Nombre']; ?>" class="card-img-top" src="<?php echo $producto['Imagen']; ?>" data-toggle="popover" data-trigger="hover" data-content="<?php echo $producto['Descripcion']; ?>">
                            <div class="card-body">
                                <span><?php echo $producto['Nombre']; ?></span>
                                <h5 class="card-title"><?php echo $producto['Precio']; ?>€</h5>
                                <!-- <p class="card-text"><?php echo $producto['Descripcion']; ?></p> -->

                                <!-- boton compra producto -->                                
                                <form action="" method="post">
                                    <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['ID'], COD, KEY); ?>">
                                    <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['Nombre'], COD, KEY); ?>">
                                    <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['Precio'], COD, KEY); ?>">
                                    <input type="number" name="cantidad" id="cantidad" > 
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
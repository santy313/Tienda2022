<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php';
?>
<br>
<div class="alert alert-success">
     <?php echo $mensaje; ?>
     <a href="" class="badge badge-success"> Ver Carrito</a>
</div>
<div class="row">
     <!-- CARGA DE PRODUCTOS -->
     <?php
     $sentencia = $pdo->prepare("SELECT * FROM `productos`");
     $sentencia->execute();
     $listaProductos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
     // print_r($listaProductos);
     ?>
     <?php foreach ($listaProductos as $prodcuto) { ?>
          <div class="col-12 col-sm-12 col-md-6 col-lg-3">
               <div class="card">
                    <img title="<?php echo $prodcuto['Nombre']; ?>" alt="<?php echo $prodcuto['Nombre']; ?>" class="card-img-top" src="<?php echo $prodcuto['Imagen']; ?>" data-toggle="popover" data-trigger="hover" data-content="<?php echo $prodcuto['Descripcion']; ?>">
                    <div class="card-body">
                         <span><?php echo $prodcuto['Nombre']; ?></span>
                         <h5 class="card-title"><?php echo $prodcuto['Precio']; ?>€</h5>
                         <!-- <p class="card-text"><?php echo $prodcuto['Descripcion']; ?></p> -->

                         <!-- boton compra producto -->

                         <form action="" method="post">
                              <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($prodcuto['ID'], COD, KEY); ?>">
                              <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($prodcuto['Nombre'], COD, KEY); ?>">
                              <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($prodcuto['Precio'], COD, KEY); ?>">
                              <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1, COD, KEY); ?>">
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
     $(function() {
          $('[data-toggle="popover"]').popover()
     });
</script>

<?php
include 'templates/footer.php'
?>
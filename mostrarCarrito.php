<?php
include './global/config.php';
include './carrito.php';
include './templates/cabecera.php';
?>
<br />
<h3>LISTA DEL CARRITO</h3>
<!-- validacion si existe algo en el carrito -->
<?php if (!empty($_SESSION['CARRITO'])) { ?>
    <table class="table table-light table-bordered">
        <tbody>
            <tr>
                <th width="40%">Descripcion</th>
                <th width="15%">Cantidad</th>
                <th width="20%">Precio</th>
                <th width="20%">Total</th>
                <th width="5%" class="text-center"> X </th>
            </tr>
            <?php $total = 0; ?>
            <!-- variable para guardar el total -->
            <?php foreach ($_SESSION['CARRITO'] as $indice => $producto) { ?>
                <tr>
                    <td width="40%"><?php echo $producto['NOMBRE']; ?></td>
                    <td width="15%"><?php echo $producto['CANTIDAD']; ?></td>
                    <td width="20%"><?php echo $producto['PRECIO']; ?></td>
                    <td width="20%"><?php echo number_format($producto['PRECIO'] * $producto['CANTIDAD'], 2); ?></td>
                    <td width="5%">
                        <form action="" method="post">
                            <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['ID'], COD, KEY); ?>">
                            <button class="btn btn-danger" type="submit" name="btnAccion" value="Eliminar">Eliminar</button>
                        </form>
                    </td>
                </tr>
                <?php $total = $total + ($producto['PRECIO'] * $producto['CANTIDAD']); ?>
            <?php } ?>
            <tr>
                <td colspan="3" align="right">
                    <h3>Total</h3>
                </td>
                <td align="right">
                    <h3><?php echo number_format($total, 2) ?> €</h3>
                </td>
                <td></td>
            </tr>
        </tbody>
    </table>
<?php } else { ?>
    <div class="alert alert-success">
        No hay productos en el carrito...
    </div>
<?php } ?>

<!-- FIN validacion si existe algo en el carrito -->
<?php
include 'templates/footer.php';

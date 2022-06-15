<div class="nav-scroller py-2 mb-3">
    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
        <a class="navbar-brand"><img src="http://localhost/Tienda2022/img/logo2.png"  height="50" alt=""></a>
        
        <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="my-nav" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="../../Tienda2022/home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../Tienda2022/productos.php" tabindex="-1" aria-disabled="true">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../Tienda2022/mostrar_carrito.php" tabindex="-1" aria-disabled="true">Carrito (<?php echo (empty($_SESSION['CARRITO'])) ? 0 : count($_SESSION['CARRITO']) //pregunta si sesion carrito tiene algo, si contesta si if ternario si es cero contavilizo cuanto tiene.                                                                                                                                          
?>)</a>
                </li>
                <li class="nav-item">
                    <?php
                    if (isset($_SESSION['usuario'])) {
                        if ($_SESSION['usuario']['idRol'] == 1) {
                            echo '<a class="nav-link" href="../../Tienda2022/administrador.php" tabindex="-1" aria-disabled="true">Administrador</a>';
                        }
                        if ($_SESSION['usuario']['idRol'] == 2) {
                            echo '<a class="nav-link" href="../../Tienda2022/cliente.php" tabindex="-1" aria-disabled="true">Cliente</a>';
                        }
                    } else {
                        echo '<a class="nav-link" href="../../Tienda2022/login.php" tabindex="-1" aria-disabled="true">LOGING</a>';
                    }
                    ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../Tienda2022/templates/logoff.php" tabindex="-1" aria-disabled="true">Cerrar Sesion</a>
                </li>
            </ul>
        </div>
    </nav>
</div>
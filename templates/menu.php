<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand">Logo de la Empresa</a>          
    <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div id="my-nav" class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="./productos.php" tabindex="-1" aria-disabled="true">Productos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="mostrar-carrito.php" tabindex="-1" aria-disabled="true">Carrito (<?php echo (empty($_SESSION['CARRITO'])) ? 0 : count($_SESSION['CARRITO']) //pregunta si sesion carrito tiene algo, si contesta si if ternario si es cero contavilizo cuanto tiene.                                                                                                                                        ?>)</a>
            </li>
            <li class="nav-item">
                <?php
                if (isset($_SESSION['rol'])) {
                    if ($_SESSION['rol'] == 1) {
                        echo '<a class="nav-link disabled" href="./administrador.php" tabindex="-1" aria-disabled="true">Administrador</a>';
                    }
                    if ($_SESSION['rol'] == 2) {                        
                        echo '<a class="nav-link disabled" href="./cliente.php" tabindex="-1" aria-disabled="true">Cliente</a>';
                    }
                } else {
                    echo '<a class="nav-link disabled" href="./login.php" tabindex="-1" aria-disabled="true">LOGING</a>';
                }
                ?>                
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="templates/logoff.php" tabindex="-1" aria-disabled="true">Cerrar Sesion</a>
            </li>
        </ul>
    </div>

</nav>     
<br />
<br />

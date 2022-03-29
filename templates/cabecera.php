<?php
session_start();
if ($_SESSION['rol'] == 1) {
    ?>
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
                        <a class="nav-link disabled" href="mostrarCarrito.php" tabindex="-1" aria-disabled="true">Carrito (<?php echo (empty($_SESSION['CARRITO'])) ? 0 : count($_SESSION['CARRITO']) //pregunta si sesion carrito tiene algo, si contesta si if ternario si es cero contavilizo cuanto tiene.                                                                                                                                  ?>)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="../administrador.php" tabindex="-1" aria-disabled="true">Administrador.</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="templates/logoff.php" tabindex="-1" aria-disabled="true">Cerrar Sesion</a>
                    </li>
                </ul>
            </div>

        </nav>     
        <br />
        <br />
        <div class="container">
            
<?php } else { ?>
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
                                <a class="nav-link disabled" href="mostrarCarrito.php" tabindex="-1" aria-disabled="true">Carrito (<?php echo (empty($_SESSION['CARRITO'])) ? 0 : count($_SESSION['CARRITO']) //pregunta si sesion carrito tiene algo, si contesta si if ternario si es cero contavilizo cuanto tiene.                                                                                                                                  ?>)</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="./Cliente.php" tabindex="-1" aria-disabled="true">Cliente</a>
                    </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="templates/logoff.php" tabindex="-1" aria-disabled="true">Cerrar Sesion</a>
                            </li>
                        </ul>
                    </div>

                </nav>     
                <br />
                <br />
                <div class="container">
                    <?php
                }
                    

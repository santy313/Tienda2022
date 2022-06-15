<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ./login.php");
}
require_once 'global/conexion.php';
require_once 'global/funcionesBBDD.php';
require_once 'global/funcionesTiempos.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include './templates/cabecera.php'; ?>
    </head>
    <body>
        <?php include './templates/menu.php'; ?>
        <div class="container">                                  
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
                            <a class="nav-link" id="pills-news-tab" data-toggle="pill" href="#pills-news" role="tab" aria-controls="pills-news" aria-selected="false">Imprimir</a>
                        </li>
                        <!--                        <li class="nav-item" role="presentation">
                                                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</a>
                                                </li>-->
                    </ul>                    
                </div>
                <!---------->
                <!---------->
                <!---------->
                <!-- INICIO DATOS PERSONALES-->               
                <?php include './formularios/formularioDatosPersonales.php'; ?>
                <!-- FIN DATOS PERSONALES -->
                <div class="tab-pane fade" id="pills-product" role="tabpanel" aria-labelledby="pills-product-tab">
                    <div class="container-fluid">
                        <h2 class="mb-3 font-weight-bold">Mejores Tiempos</h2>
                        <!---------->
                        <!---------->
                        <!---------->
                        <!-- INICIO TABLA MEJORES TIEMPOS-->
                        <?php include './templates/tablaTiempos.php'; ?>
                        <!-- INICIO TABLA MEJORES TIEMPOS-->
                    </div>                        
                </div>
                <div class="tab-pane fade" id="pills-news" role="tabpanel" aria-labelledby="pills-news-tab">
                    <div class="container-fluid">
                        <!--<h2 class="mb-3 font-weight-bold">¿Que deseas imprimir?</h2>-->
                        <!---------------- inicio imprimir-->
                        <?php include './formularios/formularioPdf.php'; ?>
                        <!---------------- fin imprimir-->
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <div class="container-fluid">
                        <h2 class="mb-3 font-weight-bold">Contact</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce porttitor leo nec ligula viverra, quis facilisis nunc vehicula. Maecenas purus orci, efficitur in dapibus vel, rutrum in massa. Sed auctor urna sit amet eros mattis interdum. Integer imperdiet ante in quam lacinia, a laoreet risus imperdiet.</p>
                        <p>Proin maximus iaculis rhoncus. Morbi ante nibh, facilisis semper faucibus consequat, facilisis ut ante. Mauris at nisl vitae justo auctor imperdiet. Cras sodales, justo sed tincidunt venenatis, ante erat ultricies eros, at mollis eros lorem ac mi. Fusce sagittis nibh nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Donec mollis eros sodales convallis faucibus. Vestibulum sit amet odio lectus. Duis eu dolor vitae est venenatis viverra eu sit amet nisl. Aenean vel sagittis odio. Quisque in lacus orci. Etiam ut odio lobortis odio consectetur ornare.</p>
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
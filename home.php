<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include './templates/cabecera.php'; ?>
        <style>
            /* Make the image fully responsive */
            .carousel-inner img {
                width: 100%;
                /*height:220px;*/
            }
        </style>
    </head>
    <body>
        <?php include './templates/menu.php'; ?>
        <div class="container">
            <!--inicio-->
            <div id="kartsInicio" class="carousel slide mb-3" data-ride="carousel">
                <!-- Indicators -->
                <ul class="carousel-indicators">
                    <li data-target="#kartsInicio" data-slide-to="0" class="active"></li>
                    <li data-target="#kartsInicio" data-slide-to="1"></li>
                    <li data-target="#kartsInicio" data-slide-to="2"></li>
                </ul>

                <!-- The slideshow -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div align="center">
                            <img src="img/karts-300cc-Competicion.jpeg" alt="Los Angeles">
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div align="center">
                            <img src="img/karts-400cc-Competicion.jpg" alt="Chicago">
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div align="center">
                            <img src="img/paintball.jpeg" alt="New York">
                        </div>
                    </div>
                </div>

                <!-- Left and right controls -->
                <a class="carousel-control-prev" href="#kartsInicio" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#kartsInicio" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
            <!--fin-->
            <section id="gallery">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 mb-4">
                            <div class="card">
                                <img src="img/blog1.jpg" alt="" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">El kart eléctrico aspira a ser deporte olímpico en París 2024</h5>
                                    <p class="card-text">"Los karts eléctricos acaban de nacer y aún hay muchas cosas que mejorar, pero nuestro objetivo es que sean una disciplina más en los JJ OO de París en 2024”.Felipe Massa, que disputará la próxima edición de la Fórmula E con el equipo Venturi,se ha tomado muy en...</p>
                                    <a href="blogs/karts_electrico.php" class="btn btn-outline-success btn-sm">Leer Más</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-4">
                            <div class="card">
                                <img src="img/blog2.jpg" alt="" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">«Creer que McLaren peleará con Red Bull es ser muy optimista»</h5>
                                    <p class="card-text">Pese a la imagen de Carlos Sainz, acechando a Max Verstappen en el inicio del GP de Bahreín y al holandés tirándose 'a rebotar' sobre el coche 'papaya' para librarse del adelantamiento, en el seno de McLaren prefieren ser cautos en cuanto a lo que va a deparar el...</p>
                                    <a href="blogs/mclaren.php" class="btn btn-outline-success btn-sm">Leer más...</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-4">
                            <div class="card">
                                <img src="img/blog3.jpg" alt="" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">Daniel Briz cosecha dos segundos puestos en Alcañiz, por delante de Nacho Tuñón y Eloi González</h5>
                                    <p class="card-text">La categoría más concurrida del certamen, se perfila también como una de las más reñidas y abiertas. La primera carrera del año en Motorland se la adjudic...</p>
                                    <a href="blogs/daniel_briz.php" class="btn btn-outline-success btn-sm">Leer más..</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php
        include 'templates/footer.php'
        ?>
    </body>
</html>
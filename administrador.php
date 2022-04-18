<?php
session_start();
if (!isset($_SESSION['rol'])) {
    header("Location: ./Login.php");
}
?>
<!DOCTYPE html>
<html>
    <?php include './templates/cabecera.php'; ?>
    <body>
        <?php include './templates/menu.php'; ?>
        <div class="container">
            <?php
            // put your code here
            ?>
            <h1>Pag. Administrador</h1>
        </div>
        <?php
        include 'templates/footer.php'
        ?>
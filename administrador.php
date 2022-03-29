<?php
session_start();
if (!isset($_SESSION['rol'])) {
    header("Location: ./Login.php");
}
?>
<!DOCTYPE html>
<html>
    <?php include './templates/cabecera.php'; ?>
    <?php
    // put your code here
    ?>
    <h1>Pag. Administrador</h1>
    <?php
    include 'templates/footer.php'
    ?>
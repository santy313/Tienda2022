<!DOCTYPE html>
<html>
    <?php include './templates/cabecera.php'; ?>
    <?php
    // put your code here
    ?>


    <h1>Pag. Index</h1>
    <?php
//    $_SESSION['usuario'];
    echo '<pre>';
    print_r($_SESSION['usuario']);
    echo '</pre>';
    ?>











    <?php
    include 'templates/footer.php'
    ?>
<?php

session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ./login.php");
}
//incluimos el fichero con el que trabajamos con la BD
//include "../global/conexion.php";
require_once '../global/conexion.php';
require_once '../global/funcionesBBDD.php';

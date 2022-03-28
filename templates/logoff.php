<?php
    //0.- RECUPERAR LA SESION
    session_start();
    //1.-  DESTRUIR LA SESION
    session_destroy();
    //2.-  DESTRUIR LA VARIABLE DE INICIO
    session_unset();
    unset($_SESSION);
    //3.-  REDIRIGIR A LA PAGINA DE INICIO
    header('Location: ../Login.php');



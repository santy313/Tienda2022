<?php

session_start();
$mensaje = "";

if (isset($_POST['btnAccion'])) {
     switch ($_POST['btnAccion']) {
          case 'Agregar':
               // ID
               if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
                    $id = openssl_decrypt($_POST['id'], COD, KEY);
                    $mensaje = 'OK ID correcto ' . $id;
               } else {
                    $mensaje = 'Upss... ID incorrecto';
               }
               // NOMBRE
               if (is_string(openssl_decrypt($_POST['nombre'], COD, KEY))) {
                    $NOMBRE = openssl_decrypt($_POST['nombre'], COD, KEY);
                    $mensaje = 'OK nombre correcto ' . $NOMBRE;
               } else {
                    $mensaje = 'Upss... nombre incorrecto';
               }
               // CANTIDAD
               if (is_numeric(openssl_decrypt($_POST['cantidad'], COD, KEY))) {
                    $CANTIDAD = openssl_decrypt($_POST['cantidad'], COD, KEY);
                    $mensaje = 'OK cantidad correcto ' . $CANTIDAD;
               } else {
                    $mensaje = 'Upss... cantidad incorrecto';
               }
               // PRECIO
               if (is_numeric(openssl_decrypt($_POST['precio'], COD, KEY))) {
                    $PRECIO = openssl_decrypt($_POST['precio'], COD, KEY);
                    $mensaje = 'OK precio correcto ' . $PRECIO;
               } else {
                    $mensaje = 'Upss... precio incorrecto';
               }

               if (!isset($_SESSION['CARRITO'])) { // si no tiene nada
                    $producto = array(
                         'ID' => $id,
                         'NOMBRE' => $NOMBRE,
                         'CANTIDAD' => $CANTIDAD,
                         'PRECIO' => $PRECIO
                    );
                    $_SESSION['CARRITO'][0] = $producto;
               } else {
                    $NumeroProducto = count($_SESSION['CARRITO']);
                    $producto = array(
                         'ID' => $id,
                         'NOMBRE' => $NOMBRE,
                         'CANTIDAD' => $CANTIDAD,
                         'PRECIO' => $PRECIO
                    );
                    $_SESSION['CARRITO'][$NumeroProducto] = $producto;
               }
               //$mensaje = print_r($_SESSION, true); //ver la infomracion de lo que enviar pruebas
               break;
     }
}

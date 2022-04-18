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
            if (is_numeric($_POST['cantidad'])) {
                $CANTIDAD = $_POST['cantidad'];
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




            // CARRITO -------------------------------------------------

            if (isset($_SESSION['CARRITO'])) { // Validar si tenemos una variable de sesion                    
                $producto = array(
                    'ID' => $id,
                    'NOMBRE' => $NOMBRE,
                    'CANTIDAD' => $CANTIDAD,
                    'PRECIO' => $PRECIO
                );
                $_SESSION['CARRITO'][0] = $producto;
                $mensaje = "1. Producto agragado al carrito   ";
            } else {
                $producto = array(
                    'ID' => $id,
                    'NOMBRE' => $NOMBRE,
                    'CANTIDAD' => $CANTIDAD,
                    'PRECIO' => $PRECIO
                );
                $_SESSION['CARRITO'][0] = $producto;
            }
            break;
        case 'Eliminar':
            if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
                $ID = openssl_decrypt($_POST['id'], COD, KEY);

                foreach ($_SESSION['CARRITO'] as $indice => $producto) {
                    if ($producto['ID'] == $ID) {
                        unset($_SESSION['CARRITO'][$indice]);
                        echo "<scrip> alert('elemento borrado...');</scrip>";
                    }
                }
            } else {
                $mensaje = 'Upss... ID incorrecto';
            }
            break;
    }
}
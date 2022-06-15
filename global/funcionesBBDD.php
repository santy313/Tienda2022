<?php

require_once 'conexion.php';

function login($usuario, $password) {
    $conexion = abrir_conexion_mysqli();
    $sql = 'SELECT * FROM users WHERE user_name="' . $usuario . '" and user_pass="' . $password . '"';
    $resultado = mysqli_query($conexion, $sql);
    $mostrar = $resultado->fetch_array(MYSQLI_ASSOC);
    cerrar_conexion_mysqli($conexion);
    return $mostrar;
}

function desencriptar($word) {
    $COD = "AES-128-ECB";
    $KEY = "@ProyectoFinal2022";
    return openssl_decrypt($word, $COD, $KEY);
}

function encriptar($word) {
    $COD = 'AES-128-ECB';
    $KEY = '@ProyectoFinal2022';
    return openssl_encrypt($word, $COD, $KEY);
}

//--------------- CARGAR DATOS GENERAL

function cargarDatosCliente($idUsuario) {
    try {
        $conexion = abrir_conexion_mysqli();
        $sql = 'SELECT * FROM users WHERE IdUsuario=' . $idUsuario;
        $resultado = mysqli_query($conexion, $sql);
        $mostrar = $resultado->fetch_array(MYSQLI_ASSOC);
        cerrar_conexion_mysqli($conexion);
        return $mostrar;
    } catch (Exception $ex) {
        return 'ERROR!! al cargar los datos.';
    }
}

function cargarClientes() {
    try {
        $conexion = abrir_conexion_mysqli();
        $sql = 'SELECT * FROM users';
        $resultado = mysqli_query($conexion, $sql);
        $clientes;
        while ($mostrar = $resultado->fetch_array(MYSQLI_ASSOC)) {
            $clientes[$mostrar['IdUsuario']] = $mostrar;
        }
        cerrar_conexion_mysqli($conexion);
        return $clientes;
    } catch (Exception $e) {
        return 'ERROR!! al cargar los clientes.';
    }
}

//--------------- FIN CARGAR DATOS GENERAL

function mostrarSelectMysql($campo, $tabla) {
    $conexion = abrir_conexion_mysqli();
    $sql = 'SELECT * FROM ' . $tabla;
    $resultado = mysqli_query($conexion, $sql);
    while ($fila = $resultado->fetch_array()) {
        echo '<option value="' . $fila[0] . '">' . $fila[$campo] . '</option>';
    }
    cerrar_conexion_mysqli($conexion);
}

//------- NUEVO CLIENTE -------
//
function nuevoCliente($user_name, $user_pass, $nombre, $apellido, $direccion, $dni, $email, $fecha_nacimiento, $idRol, $salario) {
    try {
        $conexion = abrir_conexion_mysqli();
        $sql = 'INSERT INTO users (IdUsuario, user_name, user_pass, nombre, apellido, direccion, dni, email, fecha_nacimiento, idRol, salario) VALUES (NULL, "' . $user_name . '", "' . $user_pass . '", "' . $nombre . '", "' . $apellido . '", "' . $direccion . '", "' . $dni . '", "' . $email . '", "' . $fecha_nacimiento . '", ' . $idRol . ', ' . $salario . ');';
        $resultado = mysqli_query($conexion, $sql);
        if ($resultado) {
            echo '<script type="text/javascript">
        alert("Nuevo usuario creado!!");
        window.location.href="../home.php";
        </script>';
        }
    } catch (Exception $e) {
        echo 'ERROR!!' . $e . ' al dar de alta nuevo usuario!!';
    }
}

//------- FIN NUEVO CLIENTE -------
//
//
//------- ACTUALIZAR DATOS CLIENTE -------
//function actualizarDatosCliente($celda, $datoCelda, $id) {
//    try {
//        $conexion = abrir_conexion_mysqli();
//        $sql = 'UPDATE users SET ' . $celda . ' = "' . $datoCelda . '"  WHERE IdUsuario =' . $id;
//        $resultado = mysqli_query($conexion, $sql);
//        if ($resultado) {
//            echo '<script type="text/javascript">
//        alert("Actualizado!!");
//        window.location.href="../cliente.php";
//        </script>';
//        }
//    } catch (Exception $e) {
//        echo 'ERROR!! al actualizar los datos cliente!!';
//    }
//}
function actualizarDatosCliente($sql) {
    try {
        $conexion = abrir_conexion_mysqli();
        $resultado = mysqli_query($conexion, $sql);
        if ($resultado) {
            echo '<script type="text/javascript">
        alert("Actualizado!!");
        window.location.href="../home.php";
        </script>';
        }
    } catch (Exception $e) {
        echo 'ERROR!! al actualizar los datos cliente!!';
    }
}

//------- FIN ACTUALIZAR DATOS CLIENTE -------
//
//
//------- BORRAR CLIENTE -------
function borrarCliente($idUsuario) {
    try {
        $conexion = abrir_conexion_mysqli();
        $sql = 'DELETE FROM users WHERE IdUsuario =' . desencriptar($idUsuario);
        $resultado = mysqli_query($conexion, $sql);
        if ($resultado) {
            echo '<script type="text/javascript">
        alert("Usuario Borrado");
        window.location.href="../home.php";
        </script>';
        }
    } catch (Exception $e) {
        
    }
}

//------- FIN BORRAR CLIENTE -------

function redirecionHome() {
    echo '<script type="text/javascript">
        alert("ERROR!! vuelvelo a intentar.");
        window.location.href="../home.php";
        </script>';
}

function redireccionCliente() {
    echo '<script type="text/javascript">
        alert("OK!!");
        window.location.href="../cliente.php";
        </script>';
}

function redireccionAdministrador() {
    echo '<script type="text/javascript">
        alert("OK!!");
        window.location.href="../administrador.php";
        </script>';
}

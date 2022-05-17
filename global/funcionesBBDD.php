<?php

require_once 'conexion.php';

function login($usuario, $password) {
    $conexion = abrir_conexion_mysqli();
    $sql = 'SELECT * FROM users WHERE user_name="' . $usuario . '" and user_pass="' . $password . '"';
    $resultado = $conexion->query($sql);
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

function cargarProductos() {
    $conexion = abrir_conexion_mysqli();
    $sql = 'SELECT * FROM `productos`';
    $resultado = $conexion->query($sql);
    $respuesta;
    while ($mostrar = $resultado->fetch_array(MYSQLI_ASSOC)) {
        $respuesta[$mostrar['IdProducto']] = $mostrar;
    }
    cerrar_conexion_mysqli($conexion);
    return $respuesta;
}

function cargarTiemposPersonal($id) {
    $conexion = abrir_conexion_mysqli();
    $sql = 'SELECT * FROM users u INNER JOIN record r on u.IdUsuario=r.IdUsuario INNER JOIN kart k on r.IdKart=k.IdKart WHERE u.IdUsuario=' . $id;
    $resultado = $conexion->query($sql);
    $tiempos;
    while ($mostrar = $resultado->fetch_array(MYSQLI_ASSOC)) {
        $tiempos[$mostrar['IdRecord']] = $mostrar;
    }
    cerrar_conexion_mysqli($conexion);
    return $tiempos;
}

function cargarMejorTiempoPersonal($tiempos) {
    $mejorTiempo = 999999999;
    foreach ($tiempos as $key => $value) {
        if ($mejorTiempo > $value['mejorTiempo']) {
            $mejorTiempo = $value['mejorTiempo'];
        }
    }
    return conversorSegundosHoras($mejorTiempo);
}

function cargarDatosCliente($idUsuario) {
    try {
        $conexion = abrir_conexion_mysqli();
        $sql = 'SELECT * FROM users WHERE IdUsuario=' . $idUsuario;
        $resultado = $conexion->query($sql);
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
        $resultado = $conexion->query($sql);
        $clientes;
        while ($mostrar = $resultado->fetch_array(MYSQLI_ASSOC)) {
            $clientes[$mostrar['IdUsuario']] = $mostrar;
        }
        cerrar_conexion_mysqli($conexion);
        return $clientes;
    } catch (Exception $ex) {
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

// --------------- CONVERTIR MINUTOS Y SEGUNDOS A MILISEGUNDOS
function conversorSegundosHoras($tiempo_en_segundos) {
    $horas = floor($tiempo_en_segundos / 3600);
    $minutos = floor(($tiempo_en_segundos - ($horas * 3600)) / 60);
    $segundos = $tiempo_en_segundos - ($horas * 3600) - ($minutos * 60);

    $hora_texto = "";
    if ($horas > 0) {
        $hora_texto .= $horas . "h ";
    }
    if ($minutos > 0) {
        $hora_texto .= $minutos . " min. ";
    }
    if ($segundos > 0) {
        $hora_texto .= $segundos . " seg. ";
    }

    return $hora_texto;
}

function minutosasegundos($minuto, $segundo) {
    $total = ($minuto * 60) + $segundo;
    return $total;
}

// ----------- FIN ONVERTIR MINUTOS Y SEGUNDOS A MILISEGUNDOS
// 
// 
// 
//------- AÑADIR NUEVO TIEMPO RECOD -------
function nuevoTiempoBBDD($participante, $idKart, $mejorTiempo, $idUsuario) {
    try {
        $conexion = abrir_conexion_mysqli();
        $sql = 'INSERT INTO record (IdRecord, Participante, IdKart, mejorTiempo, IdUsuario, fechaRecord) VALUES (NULL, "' . $participante . '", ' . $idKart . ', ' . $mejorTiempo . ', ' . $idUsuario . ', NOW());';
        $resultado = $conexion->query($sql);
        if ($resultado) {
            echo'<script type="text/javascript">
        alert("Nuevo Tiempo Añadido");
        window.location.href="../cliente.php";
        </script>';
//            header('Location: cliente.php');
        }
        cerrar_conexion_mysqli($conexion);
    } catch (Exception $e) {
        //echo $e->getMessage();
        echo'<script type="text/javascript">
        alert("ERROR!! revisa los datos...");
        window.location.href="../cliente.php";
        </script>';
    }
}

//------- FIN AÑADIR NUEVO TIEMPO RECOD -------
//
//
//
//------- BORRAR TIEMPO -------
function boorarMejorTiempo($id) {
    try {
        $conexion = abrir_conexion_mysqli();
        $sql = 'DELETE FROM `record` WHERE `record`.`IdRecord` =' . $id;
        $resultado = $conexion->query($sql);
        if ($resultado) {
            echo'<script type="text/javascript">
        alert("Tiempo Borrado..");
        window.location.href="../cliente.php";
        </script>';
//            header('Location: cliente.php');
        }
        cerrar_conexion_mysqli($conexion);
    } catch (Exception $e) {
        //echo $e->getMessage();
        echo'<script type="text/javascript">
        alert("ERROR!! al borrar");
        window.location.href="../cliente.php";
        </script>';
    }
}

//------- FIN BORRAR TIEMPO -------
//
//
//------- ACTUALIZAR DATOS CLIENTE -------
function actualizarDatosCliente($celda, $datoCelda, $id) {
    try {
        $conexion = abrir_conexion_mysqli();
        $sql = 'UPDATE users SET ' . $celda . ' = "' . $datoCelda . '"  WHERE IdUsuario =' . $id;
        $resultado = mysqli_query($conexion, $sql);
        if ($resultado) {
            echo'<script type="text/javascript">
        alert("Actualizado!!");
        window.location.href="../cliente.php";
        </script>';
        }
    } catch (Exception $e) {
        echo 'ERROR!! al actualizar los datos cliente!!';
    }
}

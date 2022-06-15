<?php

function cargarTiemposPersonal($id) {
    try {
        $conexion = abrir_conexion_mysqli();
        $sql = 'SELECT * FROM users u INNER JOIN record r on u.IdUsuario=r.IdUsuario INNER JOIN kart k on r.IdKart=k.IdKart WHERE u.IdUsuario=' . $id;
        $resultado = mysqli_query($conexion, $sql);
        $tiempos;
        if ($resultado->fetch_array(MYSQLI_ASSOC)) {
            while ($mostrar = $resultado->fetch_array(MYSQLI_ASSOC)) {
                $tiempos[$mostrar['IdRecord']] = $mostrar;
            }
        } else {
            $tiempos = null;
        }

        cerrar_conexion_mysqli($conexion);
        return $tiempos;
    } catch (Exception $ex) {
        return $ex;
    }
}

function cargarTiemposClientes() {
    $conexion = abrir_conexion_mysqli();
    $sql = 'SELECT * FROM users u INNER JOIN record r on u.IdUsuario=r.IdUsuario INNER JOIN kart k on r.IdKart=k.IdKart';
    $resultado = mysqli_query($conexion, $sql);
    $tiempos;
    while ($mostrar = $resultado->fetch_array(MYSQLI_ASSOC)) {
        $tiempos[$mostrar['IdRecord']] = $mostrar;
    }
    cerrar_conexion_mysqli($conexion);
    return $tiempos;
}

function cargarMejorTiempoPersonal($tiempos) {
    $mejorTiempo = 999999999;
    if ($tiempos != null) {
        foreach ($tiempos as $key => $value) {
            if ($mejorTiempo > $value['mejorTiempo']) {
                $mejorTiempo = $value['mejorTiempo'];
            }
        }
        return conversorSegundosHoras($mejorTiempo);
    } else {
        return 'Sin tiempo.';
    }
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
//------- AÑADIR NUEVO TIEMPO RECOD -------
function nuevoTiempoBBDD($participante, $idKart, $mejorTiempo, $idUsuario, $rolUsuario) {
    try {
        $conexion = abrir_conexion_mysqli();
        $sql = 'INSERT INTO record (IdRecord, Participante, IdKart, mejorTiempo, IdUsuario, fechaRecord) VALUES (NULL, "' . $participante . '", ' . $idKart . ', ' . $mejorTiempo . ', ' . $idUsuario . ', NOW());';
        $resultado = mysqli_query($conexion, $sql);
        // si es verdadero y el rol es administrador
        if ($resultado && ($rolUsuario == 1)) {
            redireccionAdministrador();
        }
        // si es verdadero y el rol es cliente
        if ($resultado && ($rolUsuario == 2)) {
            redireccionCliente();
        }
        cerrar_conexion_mysqli($conexion);
    } catch (Exception $e) {
        //echo $e->getMessage();
        redirecionHome();
    }
}

//------- BORRAR TIEMPO -------
function borrarMejorTiempo($id, $rolUsuario) {
    try {
        $conexion = abrir_conexion_mysqli();
        $sql = 'DELETE FROM `record` WHERE `record`.`IdRecord` =' . $id;
        $resultado = mysqli_query($conexion, $sql);
        if ($resultado && ($rolUsuario == 1)) {
            redireccionAdministrador();
        }
        // si es verdadero y el rol es cliente
        if ($resultado && ($rolUsuario == 2)) {
            redireccionCliente();
        }
        cerrar_conexion_mysqli($conexion);
    } catch (Exception $e) {
        redirecionHome();
    }
}

//------- FIN BORRAR TIEMPO -------
<?php

function comprobarCadena($cadena, $titulo, $patron) {
    if (empty($cadena)) {
        return 'El campo ' . $titulo . ' no puede estar vacio.\n';
    }
    if (!preg_match($patron, $cadena)) {
        return 'El campo ' . $titulo . ' invalido. Solo puede tener cadena de texto.\n';
    }
}

function comprobarCeldaVacia($cadena, $titulo) {
    if (empty($cadena)) {
        return 'El campo ' . $titulo . ' no puede estar vacio.\n';
    }
}

function comprobarDni($cadena, $titulo, $patron) {
    if (empty($cadena)) {
        return 'El campo ' . $titulo . ' no puede estar vacio.\n';
    }
    if (!preg_match($patron, $cadena)) {
        return 'El campo ' . $titulo . ' invalido. Solo puede tener cadena de texto.\n';
    }
}

function comprobarEdad($fechanacimiento) {
    if (empty($fechanacimiento)) {
        return 'El campo fecha de nacimiento no puede estar vacio.\n';
    }
    list($ano, $mes, $dia) = explode("-", $fechanacimiento);
    $ano_diferencia = date("Y") - $ano;
    $mes_diferencia = date("m") - $mes;
    $dia_diferencia = date("d") - $dia;
    if ($dia_diferencia < 0 || $mes_diferencia < 0) {
        $ano_diferencia--;
    }
    if ($ano_diferencia < 16) {
        return 'El nuevo cliente tiene que ser mayor de 16 años.\n';
    }
}

function comprobarDatoBasedeDatos($nombreTabla, $palabraConsulta, $titulo) {
    $clientes = cargarClientes();
    foreach ($clientes as $key => $value) {
        if ($value[$nombreTabla] == $palabraConsulta) {
            return 'El campo ' . $titulo . ' ya existe.\n';
        }
    }
}

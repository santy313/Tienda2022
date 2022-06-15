<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ./login.php");
}
include_once '../global/funcionesBBDD.php';
include_once '../global/comprobaciones.php';

if (isset($_POST['actualizar_cliente'])) {
    $usuario = desencriptar($_POST['idUsuario']);
    $clientes = cargarClientes();

    $userName = $_POST['userName'];
    $password = $_POST['userPassword'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $dni = strtoupper($_POST['dni']);
    $email = $_POST['email'];
    $fecha = $_POST['fecha'];
    $rol = $_POST['rol'];
    $salario = $_POST['salario'];

    $errores['Login'] = comprobarDatoBasedeDatos('user_name', $userName, 'Login');

    $erroresLimpio = array_diff($errores, array("", 0, null));
    if ($erroresLimpio) {
        $texto = '<script type="text/javascript">alert("';
        foreach ($errores as $value) {
            $texto .= $value;
        }
        $texto .= '");window.location.href="../administrador.php";</script>';
        echo $texto;
    } else {
        $primeraVez = false;
        $sql = 'update users set';
        foreach ($clientes as $key => $value) {

            if ($value['IdUsuario'] == $usuario) {
//login
                if (!empty($userName)) {
                    if ($value['user_name'] != $userName) {
                        $sql .= ' user_name = "' . $userName . '" ';
                        $primeraVez = true;
                    }
                }
//
//
//password
                if (!empty($password)) {
                    if (desencriptar($value['user_pass']) != $password) {
                        if ($primeraVez) {
                            $sql .= ', user_pass = "' . encriptar($password) . '" ';
                        } else {
                            $sql .= ' user_pass = "' . encriptar($password) . '" ';
                            $primeraVez = true;
                        }
                    }
                }
                //
//
//nombre
                if (!empty($nombre)) {
                    if ($value['nombre'] != $nombre) {
                        if ($primeraVez) {
                            $sql .= ', nombre = "' . $nombre . '" ';
                        } else {
                            $sql .= ' nombre = "' . $nombre . '" ';
                            $primeraVez = true;
                        }
                    }
                }
                //
//apellido
                if (!empty($apellido)) {
                    if ($value['apellido'] != $apellido) {
                        if ($primeraVez) {
                            $sql .= ', apellido = "' . $apellido . '" ';
                        } else {
                            $sql .= ' apellido = "' . $apellido . '" ';
                            $primeraVez = true;
                        }
                    }
                }
//    $direccion = $_POST['direccion'];
                if (!empty($direccion)) {
                    if ($value['apellido'] != $apellido) {
                        if ($primeraVez) {
                            $sql .= ', direccion = "' . $direccion . '" ';
                        } else {
                            $sql .= ' direccion = "' . $direccion . '" ';
                            $primeraVez = true;
                        }
                    }
                }
//    $dni = strtoupper($_POST['dni']);
                if (!empty($dni)) {
                    if ($value['dni'] != $dni) {
                        if ($primeraVez) {
                            $sql .= ', dni = "' . $dni . '" ';
                        } else {
                            $sql .= ' dni = "' . $dni . '" ';
                            $primeraVez = true;
                        }
                    }
                }
//    $email = $_POST['email'];
                if (!empty($email)) {
                    if ($value['email'] != $email) {
                        if ($primeraVez) {
                            $sql .= ', email = "' . $email . '" ';
                        } else {
                            $sql .= ' email = "' . $email . '" ';
                            $primeraVez = true;
                        }
                    }
                }
//    $fecha = $_POST['fecha'];
                if (!empty($fecha)) {
                    if ($value['fecha_nacimiento'] != $fecha) {
                        if ($primeraVez) {
                            $sql .= ', fecha_nacimiento = "' . $fecha . '" ';
                        } else {
                            $sql .= ' apellido = "' . $fecha . '" ';
                            $primeraVez = true;
                        }
                    }
                }
//    $rol = $_POST['rol'];
                if (!empty($rol)) {
                    if ($value['idRol'] != $rol) {
                        if ($primeraVez) {
                            $sql .= ', idRol = "' . $rol . '" ';
                        } else {
                            $sql .= ' idRol = "' . $rol . '" ';
                            $primeraVez = true;
                        }
                    }
                }
//    $salario = $_POST['salario'];
                if (!empty($salario)) {
                    if ($value['salario'] != $salario) {
                        if ($primeraVez) {
                            $sql .= ', salario = "' . $salario . '" ';
                        } else {
                            $sql .= ' salario = "' . $salario . '" ';
                            $primeraVez = true;
                        }
                    }
                }
            }
        }
        $sql .= ' where IdUsuario=' . $usuario;
        if (actualizarDatosCliente($sql)) {
            echo '<script type="text/javascript">
        alert("Actualizado!!");
        window.location.href="../home.php";
        </script>';
        } else {
            redirecionHome();
        }
    }
}
if (isset($_POST['nuevo_cliente'])) {
    $userName = $_POST['userName'];
    $password = $_POST['userPassword'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $dni = strtoupper($_POST['dni']);
    $email = $_POST['email'];
    $fecha = $_POST['fecha'];
    $rol = $_POST['rol'];
    $salario = $_POST['salario'];


    $patronNombre = "/^(?=.{3,10}$)[a-zñA-ZÑ](\s?[a-zñA-ZÑ])*$/";
    $patronDni = "/^[XYZ]?\d{5,8}[A-Z]$/";

    $errores['Login'] = comprobarCadena($userName, 'Login', $patronNombre);
    $errores['Login'] = comprobarDatoBasedeDatos('user_name', $userName, 'Login');

    $errores['Password'] = comprobarCeldaVacia($password, 'Password');
    $errores['Nombre'] = comprobarCadena($nombre, 'Nombre', $patronNombre);
    $errores['Apellido'] = comprobarCadena($apellido, 'Apellido', $patronNombre);
    $errores['Direccion'] = comprobarCeldaVacia($password, 'Direccion');

    $errores['Dni'] = comprobarDni($dni, 'DNI/NIE', $patronDni);
    $errores['Dni'] = comprobarDatoBasedeDatos('dni', strtoupper($dni), 'DNI/NIE');

    $errores['Edad'] = comprobarEdad($fecha);
    $erroresLimpio = array_diff($errores, array("", 0, null));

    if ($erroresLimpio) {
        $texto = '<script type="text/javascript">alert("';
        foreach ($errores as $value) {
            $texto .= $value;
        }
        $texto .= '");window.location.href="../administrador.php";</script>';
        echo $texto;
    } else {
        nuevoCliente($userName, encriptar($password), $nombre, $apellido, $direccion, $dni, $email, $fecha, $rol, $salario);
    }
} if (isset($_POST['borrar_cliente'])) {
    if (borrarCliente($_POST['idCliente'])) {
        
    }
} 
//else {
//    echo 'NO hay formulario';
//}

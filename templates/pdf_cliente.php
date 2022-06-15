<?php

session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ./home.php");
}

//incluimos el fichero con el que trabajamos con la BD
//include "../global/conexion.php";
require_once '../global/conexion.php';
require_once '../global/funcionesBBDD.php';
require_once '../global/funcionesTiempos.php';

if (isset($_POST['imprimir'])) {
    $cliente = cargarDatosCliente(desencriptar($_POST['idUsuario']));
    $rolCliente;
    if ($cliente['idRol'] == 1) {
        $rolCliente = 'Administrador';
    } else {
        $rolCliente = 'Cliente';
    }
}

// Require composer autoload
require_once __DIR__ . '../../vendor/autoload.php';

// Create an instance of the class:
$pdf = new \Mpdf\Mpdf();

//creamos una hoja de estilo para los tiempos
$stylesheet = file_get_contents('../css/stylePdf.css');
$pdf->WriteHTML($stylesheet, 1);

//Titulo del dovcumento que se ve en el navegador
$pdf->SetTitle("Datos Personales");

//cabecera del pdf
$cabecera = "<p> Circuito Karting</p>";
$pdf->SetHeader($cabecera);

//titulo del pdf en la hoja
$pdf->WriteHTML(
        '<div class="cabecera">
          <div class="imgCabecera"></div>                    
          <div class="titulo"> Datos Personales de: ' . strtoupper($cliente['user_name']) . '
                <div class="datosEmpresa">Recuerda:  "Yo corro para campetir, no para ganar dinero…"</div>
                <div class="datosEmpresa">por: Ayrton Senna</div>                
          </div>
          
     </div>');

$pdf->WriteHTML('<table>
               <tbody>');

$pdf->WriteHTML(
        '<tr>
                <th>Nombre de Usuario: </th> <td> ' . strtoupper($cliente['user_name']) . '</td>
                <th>Nombre: </th> <td> ' . strtoupper($cliente['nombre']) . '</td>
            </tr>
            <tr>                
                <th>Apellido: </th> <td> ' . strtoupper($cliente['apellido']) . '</td>
                <th>Direccion: </th> <td> ' . strtoupper($cliente['direccion']) . '</td>
            </tr>
            <tr>
                <th>DNI/NIE: </th> <td> ' . strtoupper($cliente['dni']) . '</td>
                <th>Email: </th> <td> ' . strtoupper($cliente['email']) . '</td>        
            </tr>
            <tr>
                <th>Fecha de Nacimeinto: </th> <td> ' . date($cliente['fecha_nacimiento']) . '</td>
                <th>Rol: </th> <td> ' . strtoupper($rolCliente) . '</td>        
            </tr>            
');
if ($cliente['idRol'] == 1) {
    $pdf->WriteHTML(
            '<tr>
                <th colspan="2">Salario: </th> <td colspan="2"> ' . strtoupper($cliente['salario']) . '</td>                
            </tr>            
');
}
$pdf->WriteHTML('</tbody>
</table>');

$pdf->WriteHTML('<hr>');
$pdf->WriteHTML('<h2> Tus mejores 10 tiempos!!</h2>');
$pdf->WriteHTML('<table>
               <thead>
                    <tr>
                         <th>NOMBRE</th>
                         <th>CATEGORIA</th>
                         <th>Nº KART</th>
                         <th>TIEMPO</th>
                         <th>FECHA</th>
                    </tr>
               </thead>
               <tbody>');

// BASE DE DATOS
$conexion = abrir_conexion_mysqli();
//$sql = 'SELECT * FROM record WHERE IdUsuario = ' . $cliente['IdUsuario'] . ' ORDER BY mejorTiempo ASC LIMIT 10;';
$sql = 'SELECT * FROM users u INNER JOIN record r on u.IdUsuario=r.IdUsuario INNER JOIN kart k on r.IdKart=k.IdKart WHERE u.IdUsuario=' . $cliente['IdUsuario'] . ' ORDER BY mejorTiempo ASC LIMIT 10;';
$resultado = mysqli_query($conexion, $sql);
if ($resultado->fetch_array(MYSQLI_ASSOC)) {
    while ($mostrar = $resultado->fetch_array(MYSQLI_ASSOC)) {
        $pdf->WriteHTML('<tr>
        <td>' . $mostrar['user_name'] . '</td>
        <td>' . $mostrar['id_TipoKart'] . '</td>
        <td>' . $mostrar['nombreKarts'] . '</td>
        <td>' . conversorSegundosHoras($mostrar['mejorTiempo']) . '</td>
        <td>' . $mostrar['fechaRecord'] . '</td>                         
     </tr>');
    }
} else {
    $pdf->WriteHTML('<tr><td colspan="4">Sin tiempos en la base de datos <td></tr>');
}
// FIN BASE DE DATOS
$pdf->WriteHTML('</tbody>
</table>');
//------- AGUA DE MARCA
$pdf->SetWatermarkText("Karting Alhama");
$pdf->showWatermarkText = true;
$pdf->watermark_font = 'DejaVuSansCondensed';
$pdf->watermarkTextAlpha = 0.1;
//------------------------------------
//Creamos el pie de pagina del pdf (aparecera en todas las hojas)
$pie = "<p>Página: {PAGENO} Fecha: {DATE j-m-y}</p>";
$pdf->SetHTMLFooter($pie);

$pdf->Output('tiempos.pdf', 'I');

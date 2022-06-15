<?php

session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ./login.php");
}
//incluimos el fichero con el que trabajamos con la BD
//include "../global/conexion.php";
require_once '../global/conexion.php';
require_once '../global/funcionesBBDD.php';

//conexion a la base de datos
$conexion = abrir_conexion_mysqli();

// Require composer autoload
require_once __DIR__ . '../../vendor/autoload.php';

// Create an instance of the class:
$pdf = new \Mpdf\Mpdf();

//creamos una hoja de estilo para los tiempos
$stylesheet = file_get_contents('../css/stylePdf.css');
$pdf->WriteHTML($stylesheet, 1);

//Titulo del dovcumento que se ve en el navegador
$pdf->SetTitle("Tiempos");

//cabecera del pdf
$cabecera = "<p> Circuito Karting</p>";
$pdf->SetHeader($cabecera);

//titulo del pdf en la hoja
$pdf->WriteHTML(
        '<div class="cabecera">
          <div class="imgCabecera"></div>                    
          <div class="titulo"> Mejores Tiempos de: ' . $_SESSION['usuario']['user_name'] . '
                <div class="datosEmpresa">Nombre:  ' . $_SESSION['usuario']['nombre'] . '</div>
                <div class="datosEmpresa">Fecha Nacimiento: ' . $_SESSION['usuario']['fecha_nacimiento'] . '</div>                
          </div>
          
     </div>');

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
$listaTiempos = cargarTiemposPersonal($_SESSION['usuario']['IdUsuario']);
foreach ($listaTiempos as $indice => $tiempos) {
    $pdf->WriteHTML('<tr>
        <td>' . $tiempos['user_name'] . '</td>
        <td>' . $tiempos['id_TipoKart'] . '</td>
        <td>' . $tiempos['nombreKarts'] . '</td>
        <td>' . conversorSegundosHoras($tiempos['mejorTiempo']) . '</td>
        <td>' . $tiempos['fechaRecord'] . '</td>
     </tr>');
}
$pdf->WriteHTML('</tbody>
</table>');
//------- AGUA DE MARCA
$pdf->SetWatermarkText("Karting Alhama");
$pdf->showWatermarkText = true;
$pdf->watermark_font = 'DejaVuSansCondensed';
$pdf->watermarkTextAlpha = 0.3;
//------------------------------------
//Creamos el pie de pagina del pdf (aparecera en todas las hojas)
$pie = "<p>Página: {PAGENO} Fecha: {DATE j-m-y}</p>";
$pdf->SetHTMLFooter($pie);

$pdf->Output('tiempos.pdf', 'I');

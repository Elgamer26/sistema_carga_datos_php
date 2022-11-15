<?php

//llamos al autoload.php del mpdf
require_once __DIR__ . '/../../vendor/autoload.php';
//aqui llamo la nueva conexion
require_once "../../../modelo/conect/conect.php";

$consulta_empresa = 'SELECT * FROM empresa';
$resulta_empresa = $mysqli->query($consulta_empresa);
$data_empresa = mysqli_fetch_assoc($resulta_empresa);

$fecha = date("d-m-Y");
$tipo_compro = "";


$html = '<!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="utf-8">
        <title>Informe de herramienta en actividad</title>
        <link rel="stylesheet" href="../../css/style.css" media="all" />
      </head>
      <body>  
        <header class="clearfix">
            <table style="border-collapse;" border="1">
                <thead>
                        <tr>
                            <th width="20%" style="border-top:0px; border-left:0px; border-bottom:0px; border-right:0px;"><img src="../../../' . $data_empresa['foto'] . '" width="99" height="99"></th>
                            <th width="50%" style="border-top:0px; border-left:0px; border-bottom:0px; border-right:0px; text-align:left;">
                            <b style="color: black;">Datos de le empresa:</b><br>
                            <b style="color: black;">Direccion: </b> <span style="color: black;"> ' . $data_empresa['direccion'] . ' </span><br>
                            <b style="color: black;">Telefono: </b> <span style="color: black;"> ' . $data_empresa['telefono'] . ' </span><br>
                            <b style="color: black;">Correo: </b> <span style="color: black;"> ' . $data_empresa['correo'] . '</span><br>
                            </th>


                            <th width="30%" style="text-align: center"> 
                            <h1  style="color: black;"> Herramienta en actividad </h1>
                            <h3 style="color: black;"> Fecha emisio:  <span style="color: black;"> ' . $fecha . '  </span> </3><br>
                            </th>
                        </tr>
                </thead>
            </table>
            <h1></h1>     
        </header>
        <main>
          <table>
            <thead>
              <tr>
                <th style="color: black;" class="desc">PRODUCCION</th>
                <th style="color: black;">LOTE</th> 
                <th style="color: black;">CODIGO</th>  
                <th style="color: black;">HERRAMIENTA</th>
                <th style="color: black;">TIPO</th>
                <th style="color: black;">CANTIDAD</th> 
                <th style="color: black;">ACTIVIDAD</th> 
              </tr>
            </thead>
            <tbody>';

    $sqldetalle = 'SELECT
	produccion.nombre,
	lote.nombre AS lote,
	herramienta.codigo,
	herramienta.nombre AS herramienta,
	tipo_herramienta.tipo_herramienta,
	produccion_herramienta.cantidad,
	actividad.id,
	actividad.actividad 
    FROM
        produccion
        INNER JOIN produccion_herramienta ON produccion.id = produccion_herramienta.produccion_id
        INNER JOIN herramienta ON produccion_herramienta.herraienta_id = herramienta.id
        INNER JOIN tipo_herramienta ON herramienta.tipo = tipo_herramienta.id
        INNER JOIN lote ON produccion.lote_id = lote.id
        INNER JOIN produccion_actividades ON produccion.id = produccion_actividades.produccion_id
        INNER JOIN actividad
        INNER JOIN asignacion_actividad ON actividad.id = asignacion_actividad.actividad_id 
        AND produccion_actividades.actividad_id = asignacion_actividad.id 
        WHERE actividad.id = "' . $_GET["id"] . '"';

// aqui estoy pidiendo la conexion y la consulta envio
$resultmedi = $mysqli->query($sqldetalle);

while ($rowmedi = $resultmedi->fetch_assoc()) {

    $html .= '<tr>
                <td class="desc"> ' . $rowmedi['nombre'] . '  </td>
                <td class="desc"> ' . $rowmedi['lote'] . ' </td>  
                <td class="desc"> ' . $rowmedi['codigo'] . ' </td>
                <td class="desc"> ' . $rowmedi['herramienta'] . ' </td> 
                <td class="desc"> ' . $rowmedi['tipo_herramienta'] . ' </td>
                <td class="desc"> ' . $rowmedi['cantidad'] . ' </td>
                <td class="desc"> ' . $rowmedi['actividad'] . ' </td>
              </tr>';
}

$html .= ' </tbody>
          </table> 
          </main>        
      </body>
    </html>';


//esto es para cambiar el tamaño de la hoja
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
$mpdf->WriteHTML($html);
$mpdf->Output();

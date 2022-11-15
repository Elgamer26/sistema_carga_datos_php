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
        <title>Informe de actividad por tipo</title>
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
                            <h1  style="color: black;"> Actividad </h1>
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
                <th style="color: black; " class="desc">EMPLEADO</th>
                <th style="color: black; ">ACTIVIDAD</th> 
                <th style="color: black; ">VALOR</th>  
                <th style="color: black; ">FECHA</th> 
              </tr>
            </thead>
            <tbody>';

$sqldetalle = 'SELECT
        CONCAT_WS(" ", empleado.nombres, empleado.apellidos ) AS emppleado,
        actividad.actividad,
        asignacion_actividad.valor,
        asignacion_actividad.fecha 
        FROM
        asignacion_actividad
        INNER JOIN actividad ON asignacion_actividad.actividad_id = actividad.id
        INNER JOIN empleado ON asignacion_actividad.trabajador_id = empleado.id 
        WHERE
        asignacion_actividad.estado = 1 
        AND asignacion_actividad.actividad_id = "' . $_GET["id"] . '"';

// aqui estoy pidiendo la conexion y la consulta envio
$resultmedi = $mysqli->query($sqldetalle);

while ($rowmedi = $resultmedi->fetch_assoc()) {

    $html .= '<tr>
                <td class="desc"> ' . $rowmedi['emppleado'] . '  </td>
                <td class="desc"> ' . $rowmedi['actividad'] . ' </td>  
                <td class="desc">$ ' . $rowmedi['valor'] . ' </td>
                <td class="desc"> ' . $rowmedi['fecha'] . ' </td>  
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

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
$valor = $_GET["valor"];
$tipo = $_GET["tipo"];


$html = '<!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="utf-8">
        <title>Informe predicción enfunde</title>
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
                            <h3 style="color: black;"> Fecha emisio:  <span style="color: black;"> ' . $fecha . '  </span> </3><br>
                            <h1  style="color: black;"> Enfunde </h1>
                            <h6 style="color: black;">Predicción enfunde: <span style="color: black;"></span> ' . $valor . '  </span> </h6> 
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
                <th style="color: black;" style="text-align: center;">Predicción de enfunde "' . $valor . '"</th> 
              </tr>
            </thead>
            <tbody>';

$html .= '<tr>
                <td class="desc" style="text-align: center;">  <img src="img/enfunde_' . $valor . '_' . $tipo . '.jpg" alt="enfunde" />   </td> 
              </tr>';


$html .= ' </tbody>
          </table> 
          </main>        
      </body>
    </html>';


//esto es para cambiar el tamaño de la hoja
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
$mpdf->WriteHTML($html);
$mpdf->Output();

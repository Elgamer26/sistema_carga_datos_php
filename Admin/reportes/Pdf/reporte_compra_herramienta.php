<?php

//llamos al autoload.php del mpdf
require_once __DIR__ . '/../vendor/autoload.php';
//aqui llamo la nueva conexion
require_once "../../modelo/conect/conect.php";

$sql = 'SELECT
        compra_herramienta.id,
        proveedor.razon_social,
        proveedor.ruc,
        compra_herramienta.fecha,
        compra_herramienta.numero_compra,
        compra_herramienta.tipo_comprobante,
        compra_herramienta.iva,
        compra_herramienta.txt_totalneto,
        compra_herramienta.txt_impuesto,
        compra_herramienta.txt_a_pagar,
        compra_herramienta.estado 
        FROM
        compra_herramienta
        INNER JOIN proveedor ON compra_herramienta.proveedor = proveedor.id 
        WHERE
        compra_herramienta.id = "' . $_GET["id"] . '"';

$consulta_empresa = 'SELECT * FROM empresa';
$resulta_empresa = $mysqli->query($consulta_empresa);
$data_empresa = mysqli_fetch_assoc($resulta_empresa);

$fecha = date("d-m-Y");
$tipo_compro = "";

$result = $mysqli->query($sql);
while ($row = $result->fetch_assoc()) {

  if($row['tipo_comprobante'] == 'Notacompra'){
    $tipo_compro = "Nota compra";
  }else{
    $tipo_compro = $row['tipo_comprobante'];
  }

    $html = '<!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="utf-8">
        <title>Venta reporte</title>
        <link rel="stylesheet" href="../css/style.css" media="all" />
      </head>
      <body>  
        <header class="clearfix">
      <table style="border-collapse;" border="1">
      <thead>
      <tr>
        <th width="20%" style="border-top:0px; border-left:0px; border-bottom:0px; border-right:0px;"><img src="../../' . $data_empresa['foto'] . '" width="99" height="99"></th>
        <th width="50%" style="border-top:0px; border-left:0px; border-bottom:0px; border-right:0px; text-align:left;">
        <b style="color: black;">Datos de le empresa:</b><br>
        <b style="color: black;">Direccion: </b> <span style="color: black;"> ' . $data_empresa['direccion'] . ' </span><br>
        <b style="color: black;">Telefono: </b> <span style="color: black;"> ' . $data_empresa['telefono'] . ' </span><br>
        <b style="color: black;">Correo: </b> <span style="color: black;"> ' . $data_empresa['correo'] . '</span><br>
        </th>


        <th width="30%" style="text-align: center">
        <h3 style="color: black;"> Fecha emisio:  <span style="color: black;"> ' . $fecha . '  </span> </3><br>
        <h1  style="color: black;"> ' . $tipo_compro . '</h1>
        <h3 style="color: black;">N°: <span style="color: black;"></span>' . $row['numero_compra'] . '  </span> 
         </th>
      </tr>
    </thead>
      </table>
          <h1></h1>         
          <div id="project">
            <div><span style="color: black; font-size: 15px"><b> Proveedor : </b>  ' . $row['razon_social'] . ' </div>
            <div><span style="color: black; font-size: 15px"><b> Ruc : </b>  ' . $row['ruc'] . ' </div>
            <div><span style="color: black; font-size: 15px"><b> N° compra : </b> ' . $row['numero_compra'] . ' </div>
            <div><span style="color: black; font-size: 15px"><b> Iva: </b>  ' . $row['iva'] . ' </div>
            <div><span style="color: black; font-size: 15px"><b> Total: </b>$  ' . $row['txt_a_pagar'] . ' </div>
          </div>
        </header>
        <main>
          <table>
            <thead>
              <tr>
                <th style="color: black; " class="desc">PRODUCTO</th>
                <th style="color: black; ">CANTIDAD</th> 
                <th style="color: black; ">PRECIO</th>  
                <th style="color: black; ">DESCUENTO</th>
                <th style="color: black; ">TOTAL</th>
              </tr>
            </thead>
            <tbody>';

    $sqldetalle = 'SELECT
                detalle_compra_herramienta.id_compra,
                herramienta.nombre,
                tipo_herramienta.tipo_herramienta,
                detalle_compra_herramienta.cantidad,
                detalle_compra_herramienta.precio,
                detalle_compra_herramienta.descuento,
                detalle_compra_herramienta.total,
                detalle_compra_herramienta.estado 
                FROM
                detalle_compra_herramienta
                INNER JOIN herramienta ON detalle_compra_herramienta.id_herramienta = herramienta.id
                INNER JOIN tipo_herramienta ON herramienta.tipo = tipo_herramienta.id 
                WHERE
                detalle_compra_herramienta.id_compra = "' . $_GET["id"] . '"';

    // aqui estoy pidiendo la conexion y la consulta envio
    $resultmedi = $mysqli->query($sqldetalle);

    while ($rowmedi = $resultmedi->fetch_assoc()) {

        $html .= '<tr>
                <td class="desc"> ' . $rowmedi['nombre'] . ' ' . $rowmedi['tipo_herramienta'] . '  </td>
                <td class="desc"> ' . $rowmedi['cantidad'] . ' </td>  
                <td class="qty">$ ' . $rowmedi['precio'] . ' </td>
                <td class="total"> ' . $rowmedi['descuento'] . ' </td> 
                <td class="unit">$ ' . $rowmedi['total'] . ' </td>
              </tr>';
    }

    $html .= '<tr>
    <td colspan="4" style="background: #ffffff;"> 
    <b>
  
    </b> 
    </td>
    dff
  </tr>     
    <tr>
    <td style="background: #ffffff;" colspan="4">SUBTOTAL:</td>
    <td style="background: #ffffff;" class="total">$ ' . $row['txt_totalneto'] . '   </td>
  </tr>
  <tr>
    <td style="background: #ffffff;" colspan="4">Iva %  </td>
    <td style="background: #ffffff;" class="total">$ ' . $row['txt_impuesto'] . ' </td>
  </tr>
  <tr>
    <td style="background: #ffffff;" colspan="4" class="TOTAL">Gran total:</td>
    <td style="background: #ffffff;" class="grand total">$ ' . $row['txt_a_pagar'] . ' </td>
  </tr>
  </tbody>';


    $html .= '</tbody>
          </table>';

    if ($row['estado'] == 0) {
        $html .= '<table style="border-collapse;" border="1">
            <thead>
            <tr>
            <th width="20%" style="text-align: center; border-top:0px; border-left:0px; border-bottom:0px; border-right:0px;">
            <img src="../img/anulado.png" width="600" height="100">
            </th>
            </th>
            </tr>
            </thead>
            </table>';
    }
    $html .= '</main>        
      </body>
    </html>';
}

//esto es para cambiar el tamaño de la hoja
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
$mpdf->WriteHTML($html);
$mpdf->Output();

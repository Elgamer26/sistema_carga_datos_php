<?php
require 'envio_correo.php';
require_once "../conect/conect.php";
$ME_CO = new envio_correo();

$correo = $_POST["correo"];

$key = "";
$pattern = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
$max = strlen($pattern) - 1;
for ($i = 0; $i < 10; $i++) {
    (string)$key .= substr($pattern, mt_rand(0, $max), 1);
}

$html = '<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>

    <table style="border: 1px solid black; width: 100%; height: 258px;">
    <thead>
    <tr style="height: 73px;">
    <td style="text-align: center; background: orange; color: white; height: 73px;" colspan="2">
    <h1><strong>.:Organit Fruit:.</strong></h1>
    </td>
    </tr>
    <tr style="height: 188px;">
    <td style="height: 134px; text-align: center;" width="20%">Su password se restablecio con exito, la nueva password es: <strong>"' . $key . '"</strong></td>
    </tr>    
    </thead>
    </table>

    </body>
    </html>';

$sms = "Recuperar password";

$resultado = $ME_CO->enviar_correo($correo, $html, $sms);

if ($resultado == 1) {

    $sql = "UPDATE usuario SET contraseña = '$key' WHERE correo = '$correo'";
    $result = $mysqli->query($sql);
    exit($mysqli->close());

} else {

   echo json_encode($resultado, JSON_UNESCAPED_UNICODE);

}
exit();

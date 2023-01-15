<?php
require '../../modelo/model_predict.php';
$MPD = new model_predict();

/////////////////////////////////////
if ($_POST["funcion"] === "grafica_cajas_2018_2020") {
    $datos = $MPD->grafica_cajas_2018_2020();
    echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "grafica_enfunde_2018_2020") {
    $datos = $MPD->grafica_enfunde_2018_2020();
    echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "grafica_recobro_2018_2020") {
    $datos = $MPD->grafica_recobro_2018_2020();
    echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "grafica_produccion_2018_2020") {
    $datos = $MPD->grafica_produccion_2018_2020();
    echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    exit();
}

<?php
require '../../modelo/modelo_prediccion.php'; 
$MPD = new modelo_prediccion();

/////////////////////////////////////
if ($_POST["funcion"] === "grafica_total_años") { 
    $datos = $MPD->grafica_total_años();
    if (!empty($datos)) {
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "grafica_fechas_toddo") { 
    $datos = $MPD->grafica_fechas_toddo();
    if (!empty($datos)) {
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "grafica_tipo_cajas") { 
    $datos = $MPD->grafica_tipo_cajas();
    if (!empty($datos)) {
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "grafica_tipo_cajas_años_n") { 
    $datos = $MPD->grafica_tipo_cajas_años_n();
    if (!empty($datos)) {
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "grafica_contenedor") { 
    $datos = $MPD->grafica_contenedor();
    if (!empty($datos)) {
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "año_inicio_cajas") { 
    $datos = $MPD->año_inicio_cajas();
    if (!empty($datos)) {
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}

//// traer el año inicio
////////////////////////
if ($_POST["funcion"] === "grafica_total_años_años") {
    $año1 = htmlspecialchars($_POST["año1"], ENT_QUOTES, 'UTF-8');
    $año2 = htmlspecialchars($_POST["año2"], ENT_QUOTES, 'UTF-8');
    $consulta = $MPD->grafica_total_años_años($año1, $año2);
    if (empty($consulta)) {
        echo 0;
    } else {
        echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    }
}

/////////////////////////////////////
if ($_POST["funcion"] === "grafica_fechas_años") { 
    $año1 = htmlspecialchars($_POST["año1"], ENT_QUOTES, 'UTF-8');
    $año2 = htmlspecialchars($_POST["año2"], ENT_QUOTES, 'UTF-8');
    $datos = $MPD->grafica_fechas_años($año1, $año2);
    if (!empty($datos)) {
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "grafica_tipo_cajas_años") { 
    $año1 = htmlspecialchars($_POST["año1"], ENT_QUOTES, 'UTF-8');
    $año2 = htmlspecialchars($_POST["año2"], ENT_QUOTES, 'UTF-8');
    $datos = $MPD->grafica_tipo_cajas_años($año1, $año2);
    if (!empty($datos)) {
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "graficos_contener_anos") { 
    $año1 = htmlspecialchars($_POST["año1"], ENT_QUOTES, 'UTF-8');
    $año2 = htmlspecialchars($_POST["año2"], ENT_QUOTES, 'UTF-8');
    $datos = $MPD->graficos_contener_anos($año1, $año2);
    if (!empty($datos)) {
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "grafica_tipo_cajas_años_n_buscar") { 
    $año1 = htmlspecialchars($_POST["año1"], ENT_QUOTES, 'UTF-8');
    $año2 = htmlspecialchars($_POST["año2"], ENT_QUOTES, 'UTF-8');
    $datos = $MPD->grafica_tipo_cajas_años_n_buscar($año1, $año2);
    if (!empty($datos)) {
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}


/////////////////////////////////////
if ($_POST["funcion"] === "grafica_cajas") { 
    $datos = $MPD->grafica_cajas();
    if (!empty($datos)) {
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}


////////////////////////////////
/////////////////////////////////////
if ($_POST["funcion"] === "grafica_predecir_enfunde") { 
    $datos = $MPD->grafica_predecir_enfunde();
    if (!empty($datos)) {
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}

////////////////////////////////
/////////////////////////////////////
if ($_POST["funcion"] === "grafica_predecir_recobro") { 
    $datos = $MPD->grafica_predecir_recobro();
    if (!empty($datos)) {
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}


////////////////////////////////
/////////////////////////////////////
if ($_POST["funcion"] === "grafica_predecir_produccion") { 
    $datos = $MPD->grafica_predecir_produccion();
    if (!empty($datos)) {
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}

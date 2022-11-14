<?php
require '../../modelo/modelo_system.php';
$MSY = new modelo_system();
session_start();

/////////////////////////////////////
if ($_POST["funcion"] === "traer_datos_de_empresa") {
    $consulta = $MSY->traer_datos_de_empresa();
    echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "cambiar_foto_perfilempresa") {

    $nombrearchivo = htmlspecialchars($_POST["nombrearchivo"], ENT_QUOTES, 'UTF-8');
    $ruta_actual = htmlspecialchars($_POST["ruta_actual"], ENT_QUOTES, 'UTF-8');

    //esto es para saber si el file trae datos
    if (is_array($_FILES) && count($_FILES) > 0) {

        if ($ruta_actual != "img/empresa/banano.jpg") {
            $delete = $ruta_actual;
            unlink("../../" . $delete);
        }

        if (move_uploaded_file($_FILES['foto']["tmp_name"], "../../img/empresa/" . $nombrearchivo)) {
            $ruta = "img/empresa/$nombrearchivo";
            $consulta = $MSY->editar_foto_perfil_empresa($ruta);
            echo $consulta;
        } else {
            echo 0;
        }
    } else {
        echo 0;
    }

    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "cambiar_datos_empresa") {

    $nomber = htmlspecialchars($_POST['nomber'], ENT_QUOTES, 'UTF-8');
    $ruc = htmlspecialchars($_POST['ruc'], ENT_QUOTES, 'UTF-8');
    $direcc = htmlspecialchars($_POST['direcc'], ENT_QUOTES, 'UTF-8');
    $telefono = htmlspecialchars($_POST['telefono'], ENT_QUOTES, 'UTF-8');
    $correo = htmlspecialchars($_POST['correo'], ENT_QUOTES, 'UTF-8');
    $dueño = htmlspecialchars($_POST['dueño'], ENT_QUOTES, 'UTF-8');
    $descrp = htmlspecialchars($_POST['descrp'], ENT_QUOTES, 'UTF-8');
    $tele_dueño = htmlspecialchars($_POST['tele_dueño'], ENT_QUOTES, 'UTF-8');

    $consulta = $MSY->editar_empresa($nomber, $ruc, $direcc, $telefono, $correo, $dueño, $descrp, $tele_dueño);
    echo $consulta;

    exit();
}

// ///////////////////////////////////// 
if ($_POST["funcion"] === "datos_usuario_logeado") {
    $id =  $_SESSION["id_usu"];
    $consulta = $MSY->datos_usuario_logeado($id);
    $datos = json_encode($consulta, JSON_UNESCAPED_UNICODE);
    if (count($consulta) > 0) {
        echo $datos;
    } else {
        echo 0;
    }
    exit();
}

// ///////////////////////////////////// 
if ($_POST["funcion"] === "llamar_etiquetas") {
    $consulta = $MSY->llamar_etiquetas();
    echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    exit();
}

// ///////////////////////////////////// 
if ($_POST["funcion"] === "herramientas_usadas") {
    $consulta = $MSY->herramientas_usadas();
    if (!empty($consulta)) {
        echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }

    exit();
}

// ///////////////////////////////////// 
if ($_POST["funcion"] === "insumos_usadas") {
    $consulta = $MSY->insumos_usadas();
    if (!empty($consulta)) {
        echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }

    exit();
}

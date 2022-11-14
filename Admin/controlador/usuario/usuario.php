<?php

use Mpdf\Tag\Em;

require '../../modelo/modelo_usuario.php';
$MU = new modelo_usuario();
session_start();

///////////////////////////////////// 
if ($_POST["funcion"] === "logeo") {
    $usu = htmlspecialchars($_POST['usuario'], ENT_QUOTES, 'UTF-8');
    $pass = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
    $resutado = $MU->verifcar_usuario($usu, $pass);
    $data = json_encode($resutado, JSON_UNESCAPED_UNICODE);
    if (count($resutado) > 0) {
        echo $data;
    } else {
        echo 0;
    }
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "verificar_correo") {
    $correo = htmlspecialchars($_POST['correo'], ENT_QUOTES, 'UTF-8');
    $resutado = $MU->verificar_correo($correo);
    if (!empty($resutado)) {
        echo json_encode($resutado, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}

// ///////////////////////////////////// 
// if ($_POST["funcion"] === "retablecer_password") {

//     $correo = htmlspecialchars($_POST['correo'], ENT_QUOTES, 'UTF-8');
//     $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');

//     $resutado = $MU->retablecer_password($correo, $password);
//     echo json_encode($resutado, JSON_UNESCAPED_UNICODE);
//     exit();
// }

///////////////////////////////////// 
if ($_POST["funcion"] === "session") {
    $id_usu = $_POST["id_usu"];
    $id_rol = $_POST["rol"];

    $_SESSION["id_usu"] = $id_usu;
    $_SESSION["id_rol"] = $id_rol;
    echo 1;
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_rol") {
    $data = $MU->listar_rol();
    if ($data) {
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    } else {
        echo '{
                "sEcho": 1,
                "iTotalRecords": "0",
                "iTotalDisplayRecords": "0",
                "aaData": []
            }';
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "registrar_rol") {
    $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8');
    $consulta = $MU->registrar_rol($nombre);
    echo $consulta;
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "estado_rol") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $dato = htmlspecialchars($_POST["dato"], ENT_QUOTES, 'UTF-8');
    $consulta = $MU->estado_rol($id, $dato);
    echo $consulta;
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "editar_rol") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8');

    $consulta = $MU->editar_rol($id, $nombre);
    echo $consulta;
    exit();
}

///////////////////usuarios
if ($_POST["funcion"] === "listar_rol_usu") {
    $data = $MU->listar_rol_usu();
    //jason encode para retornar los datos
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "registra_usuario") {

    $nombres = htmlspecialchars($_POST["nombres"], ENT_QUOTES, 'UTF-8');
    $apellidos = htmlspecialchars($_POST["apellidos"], ENT_QUOTES, 'UTF-8');
    $correo = htmlspecialchars($_POST["correo"], ENT_QUOTES, 'UTF-8');
    $cedula = htmlspecialchars($_POST["cedula"], ENT_QUOTES, 'UTF-8');
    $tipo_rol = htmlspecialchars($_POST["tipo_rol"], ENT_QUOTES, 'UTF-8');
    $usuario = htmlspecialchars($_POST["usuario"], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST["password"], ENT_QUOTES, 'UTF-8');

    $nombrearchivo = htmlspecialchars($_POST['nombrearchivo'], ENT_QUOTES, 'UTF-8');
    //esto es para saber si el file trae datos

    if (is_array($_FILES) && count($_FILES) > 0) {
        $ruta = "img/usuario/$nombrearchivo";
        $consulta = $MU->registra_usuario($nombres, $apellidos, $correo, $cedula, $tipo_rol, $usuario, $password, $ruta);
        if ($consulta == 1) {
            if (move_uploaded_file($_FILES['foto']["tmp_name"], "../../img/usuario/" . $nombrearchivo)) {
                echo $consulta;
            } else {
                echo 0;
            }
        } else {
            echo $consulta;
        }
    } else {
        $ruta = "img/usuario/perfil.png";
        $consulta = $MU->registra_usuario($nombres, $apellidos, $correo, $cedula, $tipo_rol, $usuario, $password, $ruta);
        echo $consulta;
    }

    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_usuario") {
    $data = $MU->listar_usuario();
    if ($data) {
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    } else {
        echo '{
                "sEcho": 1,
                "iTotalRecords": "0",
                "iTotalDisplayRecords": "0",
                "aaData": []
            }';
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "cambiar_estado_usuario") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $dato = htmlspecialchars($_POST["dato"], ENT_QUOTES, 'UTF-8');
    $consulta = $MU->cambiar_estado_usuario($id, $dato);
    echo $consulta;
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "editar_foto_usuario") {

    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $nombrearchivo = htmlspecialchars($_POST["nombrearchivo"], ENT_QUOTES, 'UTF-8');
    $ruta_actual = htmlspecialchars($_POST["ruta_actual"], ENT_QUOTES, 'UTF-8');

    //esto es para saber si el file trae datos
    if (is_array($_FILES) && count($_FILES) > 0) {
        if ($ruta_actual != "img/usuario/perfil.png") {
            $delete = $ruta_actual;
            unlink("../../" . $delete);
        }
        if (move_uploaded_file($_FILES['foto']["tmp_name"], "../../img/usuario/" . $nombrearchivo)) {
            $ruta = "img/usuario/$nombrearchivo";
            $consulta = $MU->editar_foto_usuario($id, $ruta);
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
if ($_POST["funcion"] === "editando_usuario") {

    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $nombres = htmlspecialchars($_POST["nombres"], ENT_QUOTES, 'UTF-8');
    $apellidos = htmlspecialchars($_POST["apellidos"], ENT_QUOTES, 'UTF-8');
    $correo = htmlspecialchars($_POST["correo"], ENT_QUOTES, 'UTF-8');
    $cedula = htmlspecialchars($_POST["cedula"], ENT_QUOTES, 'UTF-8');
    $tipo_rol = htmlspecialchars($_POST["tipo_rol"], ENT_QUOTES, 'UTF-8');
    $usuario = htmlspecialchars($_POST["usuario"], ENT_QUOTES, 'UTF-8');

    $consulta = $MU->editando_usuario($id, $nombres, $apellidos, $correo, $cedula, $tipo_rol, $usuario);
    echo $consulta;
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "editando_usuario_logeado") {

    $id = $_SESSION["id_usu"];
    $nombres = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8');
    $apellidos = htmlspecialchars($_POST["apellido"], ENT_QUOTES, 'UTF-8');
    $correo = htmlspecialchars($_POST["correo"], ENT_QUOTES, 'UTF-8'); 
    $usuario = htmlspecialchars($_POST["usuarios"], ENT_QUOTES, 'UTF-8');

    $consulta = $MU->editando_usuario_logeado($id, $nombres, $apellidos, $correo, $usuario);
    echo $consulta;
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "editar_foto_usuario_logeado") {

    $id = $_SESSION["id_usu"];
    $nombrearchivo = htmlspecialchars($_POST["nombrearchivo"], ENT_QUOTES, 'UTF-8');
    $ruta_actual = htmlspecialchars($_POST["ruta_actual"], ENT_QUOTES, 'UTF-8');

    //esto es para saber si el file trae datos
    if (is_array($_FILES) && count($_FILES) > 0) {
        if ($ruta_actual != "img/usuario/perfil.png") {
            $delete = $ruta_actual;
            unlink("../../" . $delete);
        }
        if (move_uploaded_file($_FILES['foto']["tmp_name"], "../../img/usuario/" . $nombrearchivo)) {
            $ruta = "img/usuario/$nombrearchivo";
            $consulta = $MU->editar_foto_usuario($id, $ruta);
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
if ($_POST["funcion"] === "editar_passwoed_logeado") {

    $id = $_SESSION["id_usu"];
    $pass_nue = htmlspecialchars($_POST["pass_nue"], ENT_QUOTES, 'UTF-8'); 

    $consulta = $MU->editar_passwoed_logeado($id, $pass_nue);
    echo $consulta;
    exit();
}
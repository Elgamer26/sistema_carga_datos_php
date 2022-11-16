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
if ($_POST["funcion"] === "crear_permisos") {

    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');

    $usuario_p = htmlspecialchars($_POST["usuario_p"], ENT_QUOTES, 'UTF-8');
    $empresa_p = htmlspecialchars($_POST["empresa_p"], ENT_QUOTES, 'UTF-8');
    $insumo_p = htmlspecialchars($_POST["insumo_p"], ENT_QUOTES, 'UTF-8');
    $herramienta_p = htmlspecialchars($_POST["herramienta_p"], ENT_QUOTES, 'UTF-8');
    $proveedor_p = htmlspecialchars($_POST["proveedor_p"], ENT_QUOTES, 'UTF-8');
    $compra_i_p = htmlspecialchars($_POST["compra_i_p"], ENT_QUOTES, 'UTF-8');
    $compra_h_p = htmlspecialchars($_POST["compra_h_p"], ENT_QUOTES, 'UTF-8');
    $actividad_p = htmlspecialchars($_POST["actividad_p"], ENT_QUOTES, 'UTF-8');
    $trabajador_p = htmlspecialchars($_POST["trabajador_p"], ENT_QUOTES, 'UTF-8');
    $asiganar_p = htmlspecialchars($_POST["asiganar_p"], ENT_QUOTES, 'UTF-8');
    $cinta_p = htmlspecialchars($_POST["cinta_p"], ENT_QUOTES, 'UTF-8');
    $lote_p = htmlspecialchars($_POST["lote_p"], ENT_QUOTES, 'UTF-8');
    $produccion_p = htmlspecialchars($_POST["produccion_p"], ENT_QUOTES, 'UTF-8');
    $encinte_p = htmlspecialchars($_POST["encinte_p"], ENT_QUOTES, 'UTF-8');
    $fruta_p = htmlspecialchars($_POST["fruta_p"], ENT_QUOTES, 'UTF-8');
    $proceso_c_p = htmlspecialchars($_POST["proceso_c_p"], ENT_QUOTES, 'UTF-8');
    $data_c_p = htmlspecialchars($_POST["data_c_p"], ENT_QUOTES, 'UTF-8');
    $proceso_e_p = htmlspecialchars($_POST["proceso_e_p"], ENT_QUOTES, 'UTF-8');
    $data_f_p = htmlspecialchars($_POST["data_f_p"], ENT_QUOTES, 'UTF-8');
    $proceso_r_p = htmlspecialchars($_POST["proceso_r_p"], ENT_QUOTES, 'UTF-8');
    $data_r_p = htmlspecialchars($_POST["data_r_p"], ENT_QUOTES, 'UTF-8');
    $proceso_p_p = htmlspecialchars($_POST["proceso_p_p"], ENT_QUOTES, 'UTF-8');
    $data_p_p = htmlspecialchars($_POST["data_p_p"], ENT_QUOTES, 'UTF-8');
    $prediccion_c_p = htmlspecialchars($_POST["prediccion_c_p"], ENT_QUOTES, 'UTF-8');
    $prediccion_e_p = htmlspecialchars($_POST["prediccion_e_p"], ENT_QUOTES, 'UTF-8');
    $prediccion_r_p = htmlspecialchars($_POST["prediccion_r_p"], ENT_QUOTES, 'UTF-8');
    $prediccion_p_p = htmlspecialchars($_POST["prediccion_p_p"], ENT_QUOTES, 'UTF-8');
    $informe_p = htmlspecialchars($_POST["informe_p"], ENT_QUOTES, 'UTF-8');

    $consulta = $MU->crear_permisos(
        $id,
        $usuario_p,
        $empresa_p,
        $insumo_p,
        $herramienta_p,
        $proveedor_p,
        $compra_i_p,
        $compra_h_p,
        $actividad_p,
        $trabajador_p,
        $asiganar_p,
        $cinta_p,
        $lote_p,
        $produccion_p,
        $encinte_p,
        $fruta_p,
        $proceso_c_p,
        $data_c_p,
        $proceso_e_p,
        $data_f_p,
        $proceso_r_p,
        $data_r_p,
        $proceso_p_p,
        $data_p_p,
        $prediccion_c_p,
        $prediccion_e_p,
        $prediccion_r_p,
        $prediccion_p_p,
        $informe_p
    );

    echo $consulta;
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "obtener_permisos") {

    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $consulta = $MU->obtener_permisos($id);
    $datos = json_encode($consulta, JSON_UNESCAPED_UNICODE);
    if (count($consulta) > 0) {
        echo $datos;
    } else {
        echo 0;
    }

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "obtener_permisos_usuario") {

    $id = $_SESSION["id_rol"];
    $consulta = $MU->obtener_permisos($id);
    $datos = json_encode($consulta, JSON_UNESCAPED_UNICODE);
    if (count($consulta) > 0) {
        echo $datos;
    } else {
        echo 0;
    }

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "editar_permisos") {

    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');

    $usuario_p = htmlspecialchars($_POST["usuario_p"], ENT_QUOTES, 'UTF-8');
    $empresa_p = htmlspecialchars($_POST["empresa_p"], ENT_QUOTES, 'UTF-8');
    $insumo_p = htmlspecialchars($_POST["insumo_p"], ENT_QUOTES, 'UTF-8');
    $herramienta_p = htmlspecialchars($_POST["herramienta_p"], ENT_QUOTES, 'UTF-8');
    $proveedor_p = htmlspecialchars($_POST["proveedor_p"], ENT_QUOTES, 'UTF-8');
    $compra_i_p = htmlspecialchars($_POST["compra_i_p"], ENT_QUOTES, 'UTF-8');
    $compra_h_p = htmlspecialchars($_POST["compra_h_p"], ENT_QUOTES, 'UTF-8');
    $actividad_p = htmlspecialchars($_POST["actividad_p"], ENT_QUOTES, 'UTF-8');
    $trabajador_p = htmlspecialchars($_POST["trabajador_p"], ENT_QUOTES, 'UTF-8');
    $asiganar_p = htmlspecialchars($_POST["asiganar_p"], ENT_QUOTES, 'UTF-8');
    $cinta_p = htmlspecialchars($_POST["cinta_p"], ENT_QUOTES, 'UTF-8');
    $lote_p = htmlspecialchars($_POST["lote_p"], ENT_QUOTES, 'UTF-8');
    $produccion_p = htmlspecialchars($_POST["produccion_p"], ENT_QUOTES, 'UTF-8');
    $encinte_p = htmlspecialchars($_POST["encinte_p"], ENT_QUOTES, 'UTF-8');
    $fruta_p = htmlspecialchars($_POST["fruta_p"], ENT_QUOTES, 'UTF-8');
    $proceso_c_p = htmlspecialchars($_POST["proceso_c_p"], ENT_QUOTES, 'UTF-8');
    $data_c_p = htmlspecialchars($_POST["data_c_p"], ENT_QUOTES, 'UTF-8');
    $proceso_e_p = htmlspecialchars($_POST["proceso_e_p"], ENT_QUOTES, 'UTF-8');
    $data_f_p = htmlspecialchars($_POST["data_f_p"], ENT_QUOTES, 'UTF-8');
    $proceso_r_p = htmlspecialchars($_POST["proceso_r_p"], ENT_QUOTES, 'UTF-8');
    $data_r_p = htmlspecialchars($_POST["data_r_p"], ENT_QUOTES, 'UTF-8');
    $proceso_p_p = htmlspecialchars($_POST["proceso_p_p"], ENT_QUOTES, 'UTF-8');
    $data_p_p = htmlspecialchars($_POST["data_p_p"], ENT_QUOTES, 'UTF-8');
    $prediccion_c_p = htmlspecialchars($_POST["prediccion_c_p"], ENT_QUOTES, 'UTF-8');
    $prediccion_e_p = htmlspecialchars($_POST["prediccion_e_p"], ENT_QUOTES, 'UTF-8');
    $prediccion_r_p = htmlspecialchars($_POST["prediccion_r_p"], ENT_QUOTES, 'UTF-8');
    $prediccion_p_p = htmlspecialchars($_POST["prediccion_p_p"], ENT_QUOTES, 'UTF-8');
    $informe_p = htmlspecialchars($_POST["informe_p"], ENT_QUOTES, 'UTF-8');

    $consulta = $MU->editar_permisos(
        $id,
        $usuario_p,
        $empresa_p,
        $insumo_p,
        $herramienta_p,
        $proveedor_p,
        $compra_i_p,
        $compra_h_p,
        $actividad_p,
        $trabajador_p,
        $asiganar_p,
        $cinta_p,
        $lote_p,
        $produccion_p,
        $encinte_p,
        $fruta_p,
        $proceso_c_p,
        $data_c_p,
        $proceso_e_p,
        $data_f_p,
        $proceso_r_p,
        $data_r_p,
        $proceso_p_p,
        $data_p_p,
        $prediccion_c_p,
        $prediccion_e_p,
        $prediccion_r_p,
        $prediccion_p_p,
        $informe_p
    );

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

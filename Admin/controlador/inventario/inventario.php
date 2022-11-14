<?php
require '../../modelo/modulo_inventario.php';
$MI = new modulo_inventario();

/////////////////////////////////////
if ($_POST["funcion"] === "registrar_tipo_insumo") {
    $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8');
    $consulta = $MI->registrar_tipo_insumo($nombre);
    echo $consulta;
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_tipo_insumo") {
    $data = $MI->listar_tipo_insumo();
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
if ($_POST["funcion"] === "estado_tipo_insumo") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $dato = htmlspecialchars($_POST["dato"], ENT_QUOTES, 'UTF-8');
    $consulta = $MI->estado_tipo_insumo($id, $dato);
    echo $consulta;
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "editar_tipo_i") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8');

    $consulta = $MI->editar_tipo_i($id, $nombre);
    echo $consulta;
    exit();
}

////////////////////////////////////
if ($_POST["funcion"] === "listar_tipo_insumo_COMBO") {
    $data = $MI->listar_tipo_insumo_COMBO();
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "registra_insumo") {

    $codigo = htmlspecialchars($_POST["codigo"], ENT_QUOTES, 'UTF-8');
    $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8');
    $marca = htmlspecialchars($_POST["marca"], ENT_QUOTES, 'UTF-8');
    $tipo = htmlspecialchars($_POST["tipo"], ENT_QUOTES, 'UTF-8');
    $precio = htmlspecialchars($_POST["precio"], ENT_QUOTES, 'UTF-8');
    $cantidad = htmlspecialchars($_POST["cantidad"], ENT_QUOTES, 'UTF-8');
    $descripcion = htmlspecialchars($_POST["descripcion"], ENT_QUOTES, 'UTF-8');

    $nombrearchivo = htmlspecialchars($_POST['nombrearchivo'], ENT_QUOTES, 'UTF-8');
    //esto es para saber si el file trae datos

    if (is_array($_FILES) && count($_FILES) > 0) {
        $ruta = "img/insumo/$nombrearchivo";
        $consulta = $MI->registra_insumo($codigo, $nombre, $marca, $tipo, $precio, $cantidad, $descripcion, $ruta);
        if ($consulta == 1) {
            if (move_uploaded_file($_FILES['foto']["tmp_name"], "../../img/insumo/" . $nombrearchivo)) {
                echo $consulta;
            } else {
                echo 0;
            }
        } else {
            echo $consulta;
        }
    } else {
        $ruta = "img/insumo/insumo.png";
        $consulta = $MI->registra_insumo($codigo, $nombre, $marca, $tipo, $precio, $cantidad, $descripcion, $ruta);
        echo $consulta;
    }

    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "llistar_tabla_insumo") {
    $data = $MI->llistar_tabla_insumo();
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
if ($_POST["funcion"] === "cambiar_estado_insumo") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $dato = htmlspecialchars($_POST["dato"], ENT_QUOTES, 'UTF-8');
    $consulta = $MI->cambiar_estado_insumo($id, $dato);
    echo $consulta;
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "editar_insumo") {

    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $codigo = htmlspecialchars($_POST["codigo"], ENT_QUOTES, 'UTF-8');
    $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8');
    $marca = htmlspecialchars($_POST["marca"], ENT_QUOTES, 'UTF-8');
    $tipo = htmlspecialchars($_POST["tipo"], ENT_QUOTES, 'UTF-8');
    $precio = htmlspecialchars($_POST["precio"], ENT_QUOTES, 'UTF-8');
    $cantidad = htmlspecialchars($_POST["cantidad"], ENT_QUOTES, 'UTF-8');
    $descripcion = htmlspecialchars($_POST["descripcion"], ENT_QUOTES, 'UTF-8');

    $consulta = $MI->editar_insumo($id, $codigo, $nombre, $marca, $tipo, $precio, $cantidad, $descripcion);
    echo $consulta;

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "editar_foto_insumo") {

    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $nombrearchivo = htmlspecialchars($_POST["nombrearchivo"], ENT_QUOTES, 'UTF-8');
    $ruta_actual = htmlspecialchars($_POST["ruta_actual"], ENT_QUOTES, 'UTF-8');

    //esto es para saber si el file trae datos
    if (is_array($_FILES) && count($_FILES) > 0) {
        if ($ruta_actual != "img/insumo/insumo.png") {
            $delete = $ruta_actual;
            unlink("../../" . $delete);
        }
        if (move_uploaded_file($_FILES['foto']["tmp_name"], "../../img/insumo/" . $nombrearchivo)) {
            $ruta = "img/insumo/$nombrearchivo";
            $consulta = $MI->editar_foto_insumo($id, $ruta);
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
if ($_POST["funcion"] === "registrar_tipo_herramienta") {
    $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8');
    $consulta = $MI->registrar_tipo_herramienta($nombre);
    echo $consulta;
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_tipo_herramienta") {
    $data = $MI->listar_tipo_herramienta();
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
if ($_POST["funcion"] === "cambiar_estado_tipo_e") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $dato = htmlspecialchars($_POST["dato"], ENT_QUOTES, 'UTF-8');
    $consulta = $MI->cambiar_estado_tipo_e($id, $dato);
    echo $consulta;
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "editar_tipo_h") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8');

    $consulta = $MI->editar_tipo_h($id, $nombre);
    echo $consulta;
    exit();
}

////////////////////////////////////
if ($_POST["funcion"] === "listar_tipo_herramienta_COMBO") {
    $data = $MI->listar_tipo_herramienta_COMBO();
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "registra_herramienta") {

    $codigo = htmlspecialchars($_POST["codigo"], ENT_QUOTES, 'UTF-8');
    $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8');
    $marca = htmlspecialchars($_POST["marca"], ENT_QUOTES, 'UTF-8');
    $tipo = htmlspecialchars($_POST["tipo"], ENT_QUOTES, 'UTF-8');
    $precio = htmlspecialchars($_POST["precio"], ENT_QUOTES, 'UTF-8');
    $cantidad = htmlspecialchars($_POST["cantidad"], ENT_QUOTES, 'UTF-8');
    $descripcion = htmlspecialchars($_POST["descripcion"], ENT_QUOTES, 'UTF-8');

    $nombrearchivo = htmlspecialchars($_POST['nombrearchivo'], ENT_QUOTES, 'UTF-8');
    //esto es para saber si el file trae datos

    if (is_array($_FILES) && count($_FILES) > 0) {
        $ruta = "img/herramienta/$nombrearchivo";
        $consulta = $MI->registra_herramienta($codigo, $nombre, $marca, $tipo, $precio, $cantidad, $descripcion, $ruta);
        if ($consulta == 1) {
            if (move_uploaded_file($_FILES['foto']["tmp_name"], "../../img/herramienta/" . $nombrearchivo)) {
                echo $consulta;
            } else {
                echo 0;
            }
        } else {
            echo $consulta;
        }
    } else {
        $ruta = "img/herramienta/herramienta.png";
        $consulta = $MI->registra_herramienta($codigo, $nombre, $marca, $tipo, $precio, $cantidad, $descripcion, $ruta);
        echo $consulta;
    }

    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_tabla_herramienta") {
    $data = $MI->listar_tabla_herramienta();
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
if ($_POST["funcion"] === "cambiar_estado_herramienta") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $dato = htmlspecialchars($_POST["dato"], ENT_QUOTES, 'UTF-8');

    $consulta = $MI->cambiar_estado_herramienta($id, $dato);
    echo $consulta;
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "editar_herramienta") {

    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $codigo = htmlspecialchars($_POST["codigo"], ENT_QUOTES, 'UTF-8');
    $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8');
    $marca = htmlspecialchars($_POST["marca"], ENT_QUOTES, 'UTF-8');
    $tipo = htmlspecialchars($_POST["tipo"], ENT_QUOTES, 'UTF-8');
    $precio = htmlspecialchars($_POST["precio"], ENT_QUOTES, 'UTF-8');
    $cantidad = htmlspecialchars($_POST["cantidad"], ENT_QUOTES, 'UTF-8');
    $descripcion = htmlspecialchars($_POST["descripcion"], ENT_QUOTES, 'UTF-8');

    $consulta = $MI->editar_herramienta($id, $codigo, $nombre, $marca, $tipo, $precio, $cantidad, $descripcion);
    echo $consulta;

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "editar_foto_herramienta") {

    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $nombrearchivo = htmlspecialchars($_POST["nombrearchivo"], ENT_QUOTES, 'UTF-8');
    $ruta_actual = htmlspecialchars($_POST["ruta_actual"], ENT_QUOTES, 'UTF-8');

    //esto es para saber si el file trae datos
    if (is_array($_FILES) && count($_FILES) > 0) {
        if ($ruta_actual != "img/herramienta/herramienta.png") {
            $delete = $ruta_actual;
            unlink("../../" . $delete);
        }
        if (move_uploaded_file($_FILES['foto']["tmp_name"], "../../img/herramienta/" . $nombrearchivo)) {
            $ruta = "img/herramienta/$nombrearchivo";
            $consulta = $MI->editar_foto_herramienta($id, $ruta);
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
if ($_POST["funcion"] === "registra_proveedor") {
 
    $razon_social = htmlspecialchars($_POST["razon_social"], ENT_QUOTES, 'UTF-8');
    $ruc = htmlspecialchars($_POST["ruc"], ENT_QUOTES, 'UTF-8');
    $telefono = htmlspecialchars($_POST["telefono"], ENT_QUOTES, 'UTF-8');
    $direccion = htmlspecialchars($_POST["direccion"], ENT_QUOTES, 'UTF-8');
    $correo = htmlspecialchars($_POST["correo"], ENT_QUOTES, 'UTF-8');
    $encargado = htmlspecialchars($_POST["encargado"], ENT_QUOTES, 'UTF-8');
    $descripcion = htmlspecialchars($_POST["decripcion_proveedor"], ENT_QUOTES, 'UTF-8');

    $consulta = $MI->registra_proveedor($razon_social, $ruc, $telefono, $direccion, $correo, $encargado, $descripcion);
    echo $consulta;

    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_tabla_proveedor") {
    $data = $MI->listar_tabla_proveedor();
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
if ($_POST["funcion"] === "cambiar_estado_proveedor") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $dato = htmlspecialchars($_POST["dato"], ENT_QUOTES, 'UTF-8');

    $consulta = $MI->cambiar_estado_proveedor($id, $dato);
    echo $consulta;
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "editara_proveedor") {
 
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $razon_social = htmlspecialchars($_POST["razon_social"], ENT_QUOTES, 'UTF-8');
    $ruc = htmlspecialchars($_POST["ruc"], ENT_QUOTES, 'UTF-8');
    $telefono = htmlspecialchars($_POST["telefono"], ENT_QUOTES, 'UTF-8');
    $direccion = htmlspecialchars($_POST["direccion"], ENT_QUOTES, 'UTF-8');
    $correo = htmlspecialchars($_POST["correo"], ENT_QUOTES, 'UTF-8');
    $encargado = htmlspecialchars($_POST["encargado"], ENT_QUOTES, 'UTF-8');
    $descripcion = htmlspecialchars($_POST["decripcion_proveedor"], ENT_QUOTES, 'UTF-8');

    $consulta = $MI->editara_proveedor($id, $razon_social, $ruc, $telefono, $direccion, $correo, $encargado, $descripcion);
    echo $consulta;

    exit();
}

////////////////////////////////////
if ($_POST["funcion"] === "listar_proveedor_combo") {
    $data = $MI->listar_proveedor_combo();
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_isnumos_disponibles") {
    $data = $MI->listar_isnumos_disponibles();
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
if ($_POST["funcion"] === "registrar_compra_insumo") {
 
    $proveedor = htmlspecialchars($_POST["proveedor"], ENT_QUOTES, 'UTF-8');
    $fecha = htmlspecialchars($_POST["fecha"], ENT_QUOTES, 'UTF-8');
    $numero_compra = htmlspecialchars($_POST["numero_compra"], ENT_QUOTES, 'UTF-8');
    $tipo_comprobante = htmlspecialchars($_POST["tipo_comprobante"], ENT_QUOTES, 'UTF-8');
    $iva = htmlspecialchars($_POST["iva"], ENT_QUOTES, 'UTF-8');
    $txt_totalneto = htmlspecialchars($_POST["txt_totalneto"], ENT_QUOTES, 'UTF-8');
    $txt_impuesto = htmlspecialchars($_POST["txt_impuesto"], ENT_QUOTES, 'UTF-8');
    $txt_a_pagar = htmlspecialchars($_POST["txt_a_pagar"], ENT_QUOTES, 'UTF-8');

    $consulta = $MI->registrar_compra_insumo($proveedor, $fecha, $numero_compra, $tipo_comprobante, $iva, $txt_totalneto, $txt_impuesto, $txt_a_pagar);
    echo $consulta;

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "registrar_detalle_compra_insumo") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $idpm = htmlspecialchars($_POST['idpm'], ENT_QUOTES, 'UTF-8');
    $cantidad = htmlspecialchars($_POST['cantidad'], ENT_QUOTES, 'UTF-8');
    $precio = htmlspecialchars($_POST['precio'], ENT_QUOTES, 'UTF-8');
    $des = htmlspecialchars($_POST['des'], ENT_QUOTES, 'UTF-8');
    $sutotal = htmlspecialchars($_POST['sutotal'], ENT_QUOTES, 'UTF-8');

    $arraglo_idpm = explode(",", $idpm); //aqui separo los datos
    $arraglo_cantidad = explode(",", $cantidad); //aqui separo los datos
    $arraglo_precio = explode(",", $precio); //aqui separo los datos
    $arraglo_des  = explode(",", $des); //aqui separo los datos
    $arraglo_sutotal = explode(",", $sutotal); //aqui separo los datos  

    //bucle para contar la cantidad de datos
    for ($i = 0; $i < count($arraglo_idpm); $i++) {
        $consulta = $MI->registrar_detalle_compra_insumo(
            $id,
            $arraglo_idpm[$i],
            $arraglo_cantidad[$i],
            $arraglo_precio[$i],
            $arraglo_des[$i],
            $arraglo_sutotal[$i]
        );
    }
    echo $consulta;

    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_compras_insumos") {
    $data = $MI->listar_compras_insumos();
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

/////////////////////////
if ($_POST["funcion"] === "anular_compra_insumo") {
    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $consulta = $MI->anular_compra_insumo($id);
    echo $consulta;
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_herramientas_disponibles") {
    $data = $MI->listar_herramientas_disponibles();
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
if ($_POST["funcion"] === "registrar_compra_herramienta") {
 
    $proveedor = htmlspecialchars($_POST["proveedor"], ENT_QUOTES, 'UTF-8');
    $fecha = htmlspecialchars($_POST["fecha"], ENT_QUOTES, 'UTF-8');
    $numero_compra = htmlspecialchars($_POST["numero_compra"], ENT_QUOTES, 'UTF-8');
    $tipo_comprobante = htmlspecialchars($_POST["tipo_comprobante"], ENT_QUOTES, 'UTF-8');
    $iva = htmlspecialchars($_POST["iva"], ENT_QUOTES, 'UTF-8');
    $txt_totalneto = htmlspecialchars($_POST["txt_totalneto"], ENT_QUOTES, 'UTF-8');
    $txt_impuesto = htmlspecialchars($_POST["txt_impuesto"], ENT_QUOTES, 'UTF-8');
    $txt_a_pagar = htmlspecialchars($_POST["txt_a_pagar"], ENT_QUOTES, 'UTF-8');

    $consulta = $MI->registrar_compra_herramienta($proveedor, $fecha, $numero_compra, $tipo_comprobante, $iva, $txt_totalneto, $txt_impuesto, $txt_a_pagar);
    echo $consulta;

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "registrar_detalle_compra_herramienta") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $idpm = htmlspecialchars($_POST['idpm'], ENT_QUOTES, 'UTF-8');
    $cantidad = htmlspecialchars($_POST['cantidad'], ENT_QUOTES, 'UTF-8');
    $precio = htmlspecialchars($_POST['precio'], ENT_QUOTES, 'UTF-8');
    $des = htmlspecialchars($_POST['des'], ENT_QUOTES, 'UTF-8');
    $sutotal = htmlspecialchars($_POST['sutotal'], ENT_QUOTES, 'UTF-8');

    $arraglo_idpm = explode(",", $idpm); //aqui separo los datos
    $arraglo_cantidad = explode(",", $cantidad); //aqui separo los datos
    $arraglo_precio = explode(",", $precio); //aqui separo los datos
    $arraglo_des  = explode(",", $des); //aqui separo los datos
    $arraglo_sutotal = explode(",", $sutotal); //aqui separo los datos  

    //bucle para contar la cantidad de datos
    for ($i = 0; $i < count($arraglo_idpm); $i++) {
        $consulta = $MI->registrar_detalle_compra_herramienta(
            $id,
            $arraglo_idpm[$i],
            $arraglo_cantidad[$i],
            $arraglo_precio[$i],
            $arraglo_des[$i],
            $arraglo_sutotal[$i]
        );
    }
    echo $consulta;

    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_compras_herramienta") {
    $data = $MI->listar_compras_herramienta();
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

/////////////////////////
if ($_POST["funcion"] === "anular_compra_herramienta") {
    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $consulta = $MI->anular_compra_herramienta($id);
    echo $consulta;
    exit();
}
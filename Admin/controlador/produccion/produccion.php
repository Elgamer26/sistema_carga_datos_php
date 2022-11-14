<?php
require '../../modelo/modelo_produccion.php';
$MP = new modelo_produccion();
session_start();

/////////////////////////////////////
if ($_POST["funcion"] === "registra_actividad") {
    $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8');
    $consulta = $MP->registra_actividad($nombre);
    echo $consulta;
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_actividad") {
    $data = $MP->listar_actividad();
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
if ($_POST["funcion"] === "cambiar_estado_actividad") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $dato = htmlspecialchars($_POST["dato"], ENT_QUOTES, 'UTF-8');
    $consulta = $MP->cambiar_estado_actividad($id, $dato);
    echo $consulta;
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "editar_actividad") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8');
    $consulta = $MP->editar_actividad($id, $nombre);
    echo $consulta;
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "registra_trabajador") {

    $nombres = htmlspecialchars($_POST["nombres"], ENT_QUOTES, 'UTF-8');
    $apellidos = htmlspecialchars($_POST["apellidos"], ENT_QUOTES, 'UTF-8');
    $fecha = htmlspecialchars($_POST["fecha"], ENT_QUOTES, 'UTF-8');
    $cedula = htmlspecialchars($_POST["cedula"], ENT_QUOTES, 'UTF-8');
    $direccions = htmlspecialchars($_POST["direccions"], ENT_QUOTES, 'UTF-8');
    $telefono = htmlspecialchars($_POST["telefono"], ENT_QUOTES, 'UTF-8');
    $correo = htmlspecialchars($_POST["correo"], ENT_QUOTES, 'UTF-8');
    $sexo = htmlspecialchars($_POST["sexo"], ENT_QUOTES, 'UTF-8');

    $consulta = $MP->registra_trabajador($nombres, $apellidos, $fecha, $cedula, $direccions, $telefono, $correo, $sexo);
    echo $consulta;
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_trabajador") {
    $data = $MP->listar_trabajador();
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
if ($_POST["funcion"] === "cambiar_estado_trabajador") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $dato = htmlspecialchars($_POST["dato"], ENT_QUOTES, 'UTF-8');
    $consulta = $MP->cambiar_estado_trabajador($id, $dato);
    echo $consulta;
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "editar_trabajador") {

    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $nombres = htmlspecialchars($_POST["nombres"], ENT_QUOTES, 'UTF-8');
    $apellidos = htmlspecialchars($_POST["apellidos"], ENT_QUOTES, 'UTF-8');
    $fecha = htmlspecialchars($_POST["fecha"], ENT_QUOTES, 'UTF-8');
    $cedula = htmlspecialchars($_POST["cedula"], ENT_QUOTES, 'UTF-8');
    $direccions = htmlspecialchars($_POST["direccions"], ENT_QUOTES, 'UTF-8');
    $telefono = htmlspecialchars($_POST["telefono"], ENT_QUOTES, 'UTF-8');
    $correo = htmlspecialchars($_POST["correo"], ENT_QUOTES, 'UTF-8');
    $sexo = htmlspecialchars($_POST["sexo"], ENT_QUOTES, 'UTF-8');

    $consulta = $MP->editar_trabajador($id, $nombres, $apellidos, $fecha, $cedula, $direccions, $telefono, $correo, $sexo);
    echo $consulta;
    exit();
}

////////////////////////////////////
if ($_POST["funcion"] === "listar_actividad_combo") {
    $data = $MP->listar_actividad_combo();
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit();
}

////////////////////////////////////
if ($_POST["funcion"] === "listar_trabajador_combo") {
    $data = $MP->listar_trabajador_combo();
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "registra_asignacion") {

    $empleado = htmlspecialchars($_POST["empleado"], ENT_QUOTES, 'UTF-8');
    $actividad = htmlspecialchars($_POST["actividad"], ENT_QUOTES, 'UTF-8');
    $fecha = htmlspecialchars($_POST["fecha"], ENT_QUOTES, 'UTF-8');
    $costo = htmlspecialchars($_POST["costo"], ENT_QUOTES, 'UTF-8');

    $consulta = $MP->registra_asignacion($empleado, $actividad, $fecha, $costo);
    echo $consulta;
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_asignacion") {
    $data = $MP->listar_asignacion();
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
if ($_POST["funcion"] === "cambiar_estado_asignacion") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $dato = htmlspecialchars($_POST["dato"], ENT_QUOTES, 'UTF-8');
    $consulta = $MP->cambiar_estado_asignacion($id, $dato);
    echo $consulta;
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "editar_asignacion") {

    $empleado = htmlspecialchars($_POST["empleado"], ENT_QUOTES, 'UTF-8');
    $actividad = htmlspecialchars($_POST["actividad"], ENT_QUOTES, 'UTF-8');
    $fecha = htmlspecialchars($_POST["fecha"], ENT_QUOTES, 'UTF-8');
    $costo = htmlspecialchars($_POST["costo"], ENT_QUOTES, 'UTF-8');
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');

    $consulta = $MP->editar_asignacion($id, $empleado, $actividad, $fecha, $costo);
    echo $consulta;
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_tipo_cintas") {
    $data = $MP->listar_tipo_cintas();
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
if ($_POST["funcion"] === "editar_color") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $color = htmlspecialchars($_POST["color"], ENT_QUOTES, 'UTF-8');
    $consulta = $MP->editar_color($id, $color);
    echo $consulta;
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "registrar_lotes") {
    $lote = htmlspecialchars($_POST["lote"], ENT_QUOTES, 'UTF-8');
    $consulta = $MP->registrar_lotes($lote);
    echo $consulta;
    exit();
}

//////////////////////
if ($_POST["funcion"] === "registrar_detalle_hectarea") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $hectarea = htmlspecialchars($_POST['hectarea'], ENT_QUOTES, 'UTF-8');

    $arraglo_hectarea = explode(",", $hectarea); //aqui separo los datos
    //bucle para contar la cantidad de datos
    for ($i = 0; $i < count($arraglo_hectarea); $i++) {
        $consulta = $MP->registrar_detalle_hectarea($id, $arraglo_hectarea[$i]);
    }
    echo $consulta;

    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_lotes") {
    $data = $MP->listar_lotes();
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
if ($_POST["funcion"] === "cargra_detalle_lote") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $consulta = $MP->cargra_detalle_lote($id);
    echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "editar_lotes") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $lote = htmlspecialchars($_POST["lote"], ENT_QUOTES, 'UTF-8');
    $consulta = $MP->editar_lotes($id, $lote);
    echo $consulta;
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "estado_lote") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $dato = htmlspecialchars($_POST["dato"], ENT_QUOTES, 'UTF-8');
    $consulta = $MP->estado_lote($id, $dato);
    echo $consulta;
    exit();
}

////////////////////////////////////
if ($_POST["funcion"] === "listar_lote") {
    $data = $MP->listar_lote();
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "cargra_detalle_lote_disponibles") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $consulta = $MP->cargra_detalle_lote_disponibles($id);
    if(!empty($consulta)){
        echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    }else{
        echo 0;
    }
    
    exit();
}

////////////////////////////////////
if ($_POST["funcion"] === "listar_actividad_combo_produccion") {
    $data = $MP->listar_actividad_combo_produccion();
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit();
}

////////////////////////////////////
if ($_POST["funcion"] === "listar_herramienta_combo") {
    $data = $MP->listar_herramienta_combo();
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "traer_cantidad_herramienta") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $consulta = $MP->traer_cantidad_herramienta($id);
    if(!empty($consulta)){
        echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    }else{
        echo 0;
    }
    
    exit();
}

////////////////////////////////////
if ($_POST["funcion"] === "listar_insumo_combo_produccion") {
    $data = $MP->listar_insumo_combo_produccion();
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "traer_cantidad_insumo") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $consulta = $MP->traer_cantidad_insumo($id);
    if(!empty($consulta)){
        echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    }else{
        echo 0;
    }
    
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "registrar_produccion_save") {
    $produccion = htmlspecialchars($_POST["produccion"], ENT_QUOTES, 'UTF-8');
    $f_i = htmlspecialchars($_POST["f_i"], ENT_QUOTES, 'UTF-8');
    $f_f = htmlspecialchars($_POST["f_f"], ENT_QUOTES, 'UTF-8');
    $lote_id = htmlspecialchars($_POST["lote_id"], ENT_QUOTES, 'UTF-8');
    $usuario = $_SESSION["id_usu"];
    $consulta = $MP->registrar_produccion_save($produccion, $f_i, $f_f, $lote_id, $usuario);
    echo $consulta;
    exit();
}

//////////////////////
if ($_POST["funcion"] === "detalle_hectreas_produccion") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $hectarea = htmlspecialchars($_POST['hectarea'], ENT_QUOTES, 'UTF-8');

    $arraglo_hectarea = explode(",", $hectarea); //aqui separo los datos
    //bucle para contar la cantidad de datos
    for ($i = 0; $i < count($arraglo_hectarea); $i++) {
        $consulta = $MP->detalle_hectreas_produccion($id, $arraglo_hectarea[$i]);
    }
    echo $consulta;

    exit();
}

//////////////////////
if ($_POST["funcion"] === "detalle_actividades_produccion") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $actividad = htmlspecialchars($_POST['actividad'], ENT_QUOTES, 'UTF-8');

    $arraglo_actividad = explode(",", $actividad); //aqui separo los datos
    //bucle para contar la cantidad de datos
    for ($i = 0; $i < count($arraglo_actividad); $i++) {
        $consulta = $MP->detalle_actividades_produccion($id, $arraglo_actividad[$i]);
    }
    echo $consulta;

    exit();
}

//////////////////////
if ($_POST["funcion"] === "detalle_herraienta_produccion") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $herramienta = htmlspecialchars($_POST['herramienta'], ENT_QUOTES, 'UTF-8');
    $cantidad = htmlspecialchars($_POST['cantidad'], ENT_QUOTES, 'UTF-8');

    $arraglo_herramienta = explode(",", $herramienta); //aqui separo los datos
    $arraglo_cantidad = explode(",", $cantidad); //aqui separo los datos
    //bucle para contar la cantidad de datos
    for ($i = 0; $i < count($arraglo_herramienta); $i++) {
        $consulta = $MP->detalle_herraienta_produccion($id, $arraglo_herramienta[$i], $arraglo_cantidad[$i]);
    }
    echo $consulta;

    exit();
}

//////////////////////
if ($_POST["funcion"] === "detalle_insumo_produccion") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $insumo = htmlspecialchars($_POST['insumo'], ENT_QUOTES, 'UTF-8');
    $cantidad = htmlspecialchars($_POST['cantidad'], ENT_QUOTES, 'UTF-8');

    $arraglo_insumo = explode(",", $insumo); //aqui separo los datos
    $arraglo_cantidad = explode(",", $cantidad); //aqui separo los datos
    //bucle para contar la cantidad de datos
    for ($i = 0; $i < count($arraglo_insumo); $i++) {
        $consulta = $MP->detalle_insumo_produccion($id, $arraglo_insumo[$i], $arraglo_cantidad[$i]);
    }
    echo $consulta;

    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_produccion") {
    $data = $MP->listar_produccion();
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
if ($_POST["funcion"] === "cargar_detalle_produccion_lote") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $consulta = $MP->cargar_detalle_produccion_lote($id); 
    echo json_encode($consulta, JSON_UNESCAPED_UNICODE);    
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "cargar_detalle_produccion_actividades") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $consulta = $MP->cargar_detalle_produccion_actividades($id); 
    echo json_encode($consulta, JSON_UNESCAPED_UNICODE);    
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "cargar_detalle_produccion_herramientas") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $consulta = $MP->cargar_detalle_produccion_herramientas($id); 
    echo json_encode($consulta, JSON_UNESCAPED_UNICODE);    
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "cargar_detalle_produccion_insumo") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $consulta = $MP->cargar_detalle_produccion_insumo($id); 
    echo json_encode($consulta, JSON_UNESCAPED_UNICODE);    
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "cancelar_produccion") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $dato = htmlspecialchars($_POST["dato"], ENT_QUOTES, 'UTF-8');
    $consulta = $MP->cancelar_produccion($id, $dato);
    echo $consulta;
    exit();
}

////////////////////////////////////
if ($_POST["funcion"] === "listar_produccion_combo") {
    $data = $MP->listar_produccion_combo();
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "traer_cantidad_semanas_produccion") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $consulta = $MP->traer_cantidad_semanas_produccion($id);
    if(!empty($consulta)){
        echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    }else{
        echo 0;
    }
    
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "cargar_detalle_encinte_produccion") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $consulta = $MP->cargar_detalle_encinte_produccion($id);
    if(!empty($consulta)){
        echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    }else{
        echo 0;
    }
    
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "cargar_detalle_produccion_racimos") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $consulta = $MP->cargar_detalle_produccion_racimos($id);
    if(!empty($consulta)){
        echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    }else{
        echo 0;
    }
    
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "cargar_detalle_produccion_desechos") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $consulta = $MP->cargar_detalle_produccion_desechos($id);
    if(!empty($consulta)){
        echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    }else{
        echo 0;
    }
    
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "guardar_encinte_produccion") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $numero = htmlspecialchars($_POST["numero"], ENT_QUOTES, 'UTF-8');
    $fecha = htmlspecialchars($_POST["fecha"], ENT_QUOTES, 'UTF-8');
    $detalle = htmlspecialchars($_POST["detalle"], ENT_QUOTES, 'UTF-8');
 
    $consulta = $MP->guardar_encinte_produccion($id, $numero, $fecha, $detalle);
    echo $consulta;
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "eliminar_detalle_cinta") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $idpro = htmlspecialchars($_POST["idpro"], ENT_QUOTES, 'UTF-8'); 
 
    $consulta = $MP->eliminar_detalle_cinta($id, $idpro);
    echo $consulta;
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "registro_frutasa") {

    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $fecha = htmlspecialchars($_POST["fecha"], ENT_QUOTES, 'UTF-8');
    $tipo = htmlspecialchars($_POST["tipo"], ENT_QUOTES, 'UTF-8');
    $numero = htmlspecialchars($_POST["numero"], ENT_QUOTES, 'UTF-8');
 
    $consulta = $MP->registro_frutasa($id, $fecha, $tipo, $numero);
    echo $consulta;
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_racimos_produccion") {
    $data = $MP->listar_racimos_produccion();
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
if ($_POST["funcion"] === "listar_desecho_produccion") {
    $data = $MP->listar_desecho_produccion();
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
if ($_POST["funcion"] === "eliminar_racimos_list") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8'); 
    $consulta = $MP->eliminar_racimos_list($id);
    echo $consulta;
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "eliminar_desecho_list") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8'); 
    $consulta = $MP->eliminar_desechos_list($id);
    echo $consulta;
    exit();
}
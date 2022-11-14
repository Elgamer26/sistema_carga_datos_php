<?php
//esto es en caso de que no exista la session me llevara al login index
session_start();
if (!isset($_SESSION["id_usu"])) {
    header("location: ../");
}
require "../../modelo/conect/conect.php";
$user = 'SELECT
    usuario.usuario_id, 
    usuario.nombres, 
    usuario.apellidos, 
    usuario.correo, 
    usuario.cedula, 
    usuario.usuario, 
    usuario.`contraseña`, 
    usuario.foto, 
    usuario.rol_id, 
    rol.rol, 
    usuario.estado
    FROM
    usuario
    INNER JOIN
    rol
    ON 
    usuario.rol_id = rol.rol_id WHERE usuario.usuario_id = ' . $_SESSION["id_usu"] . '';
$resulta_user = $mysqli->query($user);
$data_web = mysqli_fetch_assoc($resulta_user);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Language" content="en" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Sistema bananera</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components." />
    <meta name="msapplication-tap-highlight" content="no" />

    <link rel="icon" href="../../img/banana.png">

    <link rel="stylesheet" href="../../plugins/modales/bootstrap4/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../plugins/modales/jqueryUI/jquery-ui-1.12.1/jquery-ui.min.css">

    <link href="../../plugins/DATATABLES/datatables.min.css" rel="stylesheet" />
    <link href="../../plugins/SELECT2/css/select2.min.css" rel="stylesheet" />
    <link href="../../template/main.css" rel="stylesheet" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
</head>

<style>
    body {
        padding-right: 0 !important;
    }

    .dataTables_length {
        padding: 10px;
    }

    .azuldete {
        color: #fff !important;
        background: #17a2b8 !important;
        border-color: #17a2b8 !important;
    }

    .redfule {
        color: #fff !important;
        background: #dc3545 !important;
        border-color: #dc3545 !important;
    }

    .greenlover {
        color: #fff !important;
        background: #28a745 !important;
        border-color: #28a745 !important;
    }

    .moverabajo {
        padding-top: 22px;
    }

    .fc th {
        padding: 10px 0px !important;
        vertical-align: middle !important;
        background: greenyellow !important;
    }

    #global {
        height: 557px;
        overflow-y: scroll;
        border-radius: 20px;
        border: 3px solid orange;
    }

    #global::-webkit-scrollbar-track {
        background-color: transparent;
    }

    #global::-webkit-scrollbar {
        width: 1px;
        background-color: transparent;
    }

    #global::-webkit-scrollbar-thumb {
        background-color: #000000;
    }

    .alertify-notifier .ajs-message.ajs-error {
        color: #fff;
        background: rgba(217, 92, 92, 0, 95);
        text-shadow: -1px -1px 0 rgba(0, 0, 0, 0, 5);
    }

    .alertify-notifier .ajs-message.ajs-success {
        color: #fff;
        background: rgba(217, 92, 92, 0, 95);
        text-shadow: -1px -1px 0 rgba(0, 0, 0, 0, 5);
    }
</style>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo" style="display: flex; justify-content: center; padding: 40px; margin: 40px;">

                <a href="../home/index.php">
                    <div class="logo-src"> </div>
                </a>
                <!-- <img src="img/logo2.png" alt=""> style="background-image: url('img/logo2.png'); -->

                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>

            <div class="app-header__content">
                <div class="app-header-left">
                    <div class="search-wrapper">
                        <div class="input-holder"></div>
                        <button class="close"></button>
                    </div>
                    <ul class="header-menu nav">
                        <li class="nav-item"></li>
                        <li class="btn-group nav-item"></li>
                        <li class="dropdown nav-item"></li>
                    </ul>
                </div>

                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a style="cursor: pointer;" onclick="datos_usuarios();"> <img width="42" class="rounded-circle" src="../../<?php print_r($data_web["foto"]); ?>" alt="" /></a>
                                    </div>
                                </div>
                                <div class="widget-content-left ml-3 header-user-info">
                                    <div class="widget-heading"> <?php print_r($data_web["nombres"] . " " . $data_web["apellidos"]);  ?></div>
                                    <div class="bg bg-info" style="text-align: center; color: white; border-radius: 20px;"> <b>
                                            <div style="color: white;" class="widget-subheading"><?php print_r($data_web["rol"]);  ?></div>
                                        </b>
                                    </div>

                                </div>

                                <div class="widget-content-left ml-3 header-user-info">
                                    <a href="../../controlador/usuario/cerrar.php" class="btn btn-danger">
                                        <b><i class="fa fa-power-off"></i> Cerrar sesión</b>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>

                <div id="global">

                    <div class="scrollbar-sidebar">
                        <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                                <li class="app-sidebar__heading">Módulo de seguridad</li>
                                <li>
                                    <a href="../usuario/lista_rol.php">
                                        <i class="metismenu-icon fa fa-bookmark"></i>
                                        Roles
                                    </a>
                                </li>
                                <li>
                                    <a href="../usuario/create.php">
                                        <i class="metismenu-icon fa fa-user-plus"></i>
                                        Usuarios
                                    </a>
                                </li>
                                <li>
                                    <a href="../usuario/listado.php">
                                        <i class="metismenu-icon fa fa-list"></i>
                                        Listado usuarios
                                    </a>
                                </li>
                                <li>
                                    <a href="../home/empresa.php">
                                        <i class="metismenu-icon fa fa-home"></i>
                                        Empresa
                                    </a>
                                </li>

                                <li class="app-sidebar__heading">Módulo de inventario</li>
                                <li>
                                    <a href="../inventario/list_tipoi.php">
                                        <i class="metismenu-icon fa fa-bookmark"></i>
                                        Tipo insumo
                                    </a>
                                </li>
                                <li>
                                    <a href="../inventario/list_insumo.php">
                                        <i class="metismenu-icon fa fa-cube"></i>
                                        Insumos
                                    </a>
                                </li>
                                <li>
                                    <a href="../inventario/list_tipoe.php">
                                        <i class="metismenu-icon fa fa-bookmark"></i>
                                        Tipo herramienta
                                    </a>
                                </li>
                                <li>
                                    <a href="../inventario/list_herramienta.php">
                                        <i class="metismenu-icon fa fa-wrench"></i>
                                        Herramienta
                                    </a>
                                </li>
                                <li>
                                    <a href="../inventario/list_proveedor.php">
                                        <i class="metismenu-icon fa fa-user"></i>
                                        Proveedor
                                    </a>
                                </li>
                                <li>
                                    <a href="../inventario/list_comprai.php">
                                        <i class="metismenu-icon fa fa-shopping-cart"></i>
                                        Compras insumos
                                    </a>
                                </li>
                                <li>
                                    <a href="../inventario/list_comprah.php">
                                        <i class="metismenu-icon fa fa-shopping-cart"></i>
                                        Compras herramientas
                                    </a>
                                </li>

                                <li class="app-sidebar__heading">Módulo Control de la producción</li>
                                <li>
                                    <a href="../produccion/actividades.php">
                                        <i class="metismenu-icon fa fa-bookmark"></i>
                                        Actividades
                                    </a>
                                </li>
                                <li>
                                    <a href="../produccion/trabajadores.php">
                                        <i class="metismenu-icon fa fa-users"></i>
                                        Trabajadores
                                    </a>
                                </li>
                                <li>
                                    <a href="../produccion/asignar_actividad.php">
                                        <i class="metismenu-icon fa fa-hammer"></i>
                                        Asignar actividades
                                    </a>
                                </li>
                                <li>
                                    <a href="../produccion/tipo_cinta.php">
                                        <i class="metismenu-icon fa fa-bookmark"></i>
                                        Tipo de cintas
                                    </a>
                                </li>
                                <li>
                                    <a href="../produccion/lotes.php">
                                        <i class="metismenu-icon fa fa-cubes"></i>
                                        Lotes
                                    </a>
                                </li>
                                <li>
                                    <a href="../produccion/produccion.php">
                                        <i class="metismenu-icon fa fa-cube"></i>
                                        Producción
                                    </a>
                                </li>
                                <li>
                                    <a href="../produccion/encinte.php">
                                        <i class="metismenu-icon fa fa-tags"></i>
                                        Encinte
                                    </a>
                                </li>
                                <li>
                                    <a href="../produccion/frutas.php">
                                        <i class="metismenu-icon fa fa-box"></i>
                                        Registro de fruta
                                    </a>
                                </li>
                                <li>
                                    <a href="../produccion/list_frutas.php">
                                        <i class="metismenu-icon fa fa-list"></i>
                                        Listado de fruta
                                    </a>
                                </li>

                                <li class="app-sidebar__heading">Manejo de datos</li>
                                <li>
                                    <a href="../manejo_datos/proceso_cajas.php">
                                        <i class="metismenu-icon fa fa-cubes"></i>
                                        Proceso de cajas
                                    </a>
                                </li>
                                <li>
                                    <a href="../manejo_datos/data_cajas.php">
                                        <i class="metismenu-icon fa fa-file-excel"></i>
                                        Data Excel cajas
                                    </a>
                                </li>
                                <li>
                                    <a href="../manejo_datos/proceso_enfunde.php">
                                        <i class="metismenu-icon fa fa-cubes"></i>
                                        Proceso de enfunde
                                    </a>
                                </li>
                                <li>
                                    <a href="../manejo_datos/data_fundas.php">
                                        <i class="metismenu-icon fa fa-file-excel"></i>
                                        Data Excel fundas
                                    </a>
                                </li>
                                <li>
                                    <a href="../manejo_datos/proceso_recobro.php">
                                        <i class="metismenu-icon fa fa-cubes"></i>
                                        Proceso de recobro
                                    </a>
                                </li>
                                <li>
                                    <a href="../manejo_datos/data_recobro.php">
                                        <i class="metismenu-icon fa fa-file-excel"></i>
                                        Data Excel recobro
                                    </a>
                                </li>

                                <li class="app-sidebar__heading">Dashboard</li>
                                <li>
                                    <a href="../manejo_datos/prediccion_cajas.php">
                                        <i class="metismenu-icon fas fa-chart-area"></i>
                                        Predicción de cajas
                                    </a>
                                </li>
                                <li>
                                    <a href="../manejo_datos/prediccion_enfunde.php">
                                        <i class="metismenu-icon fas fa-chart-area"></i>
                                        Predicción de enfunde
                                    </a>
                                </li>
                                <li>
                                    <a href="../manejo_datos/prediccion_recobro.php">
                                        <i class="metismenu-icon fas fa-chart-area"></i>
                                        Predicción recobro de cintas
                                    </a>
                                </li>


                                <li class="app-sidebar__heading">Informes</li>
                                <li>
                                    <a href="dashboard-boxes.html">
                                        <i class="metismenu-icon pe-7s-display2"></i>
                                        Informe de productos utilizados
                                    </a>
                                </li>
                                <li>
                                    <a href="dashboard-boxes.html">
                                        <i class="metismenu-icon pe-7s-display2"></i>
                                        Informe de materiales
                                    </a>
                                </li>
                                <li>
                                    <a href="dashboard-boxes.html">
                                        <i class="metismenu-icon pe-7s-display2"></i>
                                        Informe de actividades
                                    </a>
                                </li>
                                <li>
                                    <a href="dashboard-boxes.html">
                                        <i class="metismenu-icon pe-7s-display2"></i>
                                        Informe de cajas del banano
                                    </a>
                                </li>
                                <li>
                                    <a href="dashboard-boxes.html">
                                        <i class="metismenu-icon pe-7s-display2"></i>
                                        Informe de fruta encintada
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>

            </div>

            <div class="app-main__outer">
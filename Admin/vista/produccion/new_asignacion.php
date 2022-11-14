<?php require "../layout/header.php" ?>

<?php
date_default_timezone_set('America/Guayaquil');
$fecha = date("Y-m-d");
?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-user-plus"> </i>
                </div>
                <div>
                    Nueva asignación de actividades
                    <div class="page-title-subheading">
                        Crear una nueva asignación de actividades.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <label class="form-label">Nuevo asignación</label>
                <div class="d-inline-block dropdown">
                    <a href="../produccion/asignar_actividad.php"> / Listado </a>
                </div> <a href="../home/index.php"> / Principal <i class="fa fa-home"></i></a> </a>
            </div>
        </div>
    </div>

    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-title">Nuevo asignación.</h5>

            <div class="row align-items-center">

                <div class="col-sm-12 form-group">
                    <label>Datos del empleado</label> &nbsp;&nbsp; <label style="color:red;" id="empleado_obliga"></label>
                    <select class="tipo_aaaa form-control" id="datos_empleado" style="width:100%;">
                    </select>
                </div>

                <div class="col-sm-6 form-group">
                    <label>Tipo de actividad</label> &nbsp;&nbsp; <label style="color:red;" id="tipoo_obliga"></label>
                    <select class="tipo_a form-control" id="tipo_actividad" style="width:100%;">
                    </select>
                </div>

                <div class="col-sm-3 form-group">
                    <label>Costo de la actividad</label> &nbsp;&nbsp; <label style="color:red;" id="costo_obliga"></label>
                    <input type="number" class="form-control" id="costo_acivdad">
                </div>

                <div class="col-sm-3 form-group">
                    <label>Fecha</label> &nbsp;&nbsp; <label style="color:red;" id="fecha_obliga"></label>
                    <input type="date" class="form-control" id="fecha_asiga" value="<?php echo $fecha; ?>">
                </div>

                <div class="col-md-12 p-1">
                    <button onclick="registra_asignacion();" class="btn btn-primary">
                        <i class="fa fa-save"></i> Registrar
                    </button> -
                    <a href="../produccion/asignar_actividad.php" class="btn btn-danger">Volver</a>
                </div>

            </div>

        </div>
    </div>
</div>

<?php require "../layout/footer.php" ?>
<script src="../../js/produccion.js"></script>

<script>
    $(".tipo_aaaa").select2();
    $(".tipo_a").select2();
    listar_actividad_combo();
    listar_trabajador_combo();

    function listar_actividad_combo() {
        funcion = "listar_actividad_combo";
        $.ajax({
            url: "../../controlador/produccion/produccion.php",
            type: "POST",
            data: {
                funcion: funcion,
            },
        }).done(function(response) {
            var data = JSON.parse(response);
            var cadena = "<option value='0'> --- Ingrese tipo de actividad --- </option>";
            if (data.length > 0) {
                //bucle para extraer los datos del rol
                for (var i = 0; i < data.length; i++) {
                    cadena +=
                        "<option value='" + data[i][0] + "'> " + data[i][1] + " </option>";
                }
                //aqui concadenamos al id del select
                $("#tipo_actividad").html(cadena);
            } else {
                cadena += "<option value=''>No hay datos de tipo</option>";
                $("#tipo_actividad").html(cadena);
            }
        });
    }

    function listar_trabajador_combo() {
        funcion = "listar_trabajador_combo";
        $.ajax({
            url: "../../controlador/produccion/produccion.php",
            type: "POST",
            data: {
                funcion: funcion,
            },
        }).done(function(response) {
            var data = JSON.parse(response);
            var cadena = "<option value='0'> --- Ingrese trabajador --- </option>";
            if (data.length > 0) {
                //bucle para extraer los datos del rol
                for (var i = 0; i < data.length; i++) {
                    cadena +=
                        "<option value='" + data[i][0] + "'> " + data[i][1] + " </option>";
                }
                //aqui concadenamos al id del select
                $("#datos_empleado").html(cadena);
            } else {
                cadena += "<option value=''>No hay datos de tipo</option>";
                $("#datos_empleado").html(cadena);
            }
        });
    }
</script>
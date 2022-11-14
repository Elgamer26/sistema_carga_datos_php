<?php require "../layout/header.php" ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-list"> </i>
                </div>
                <div>
                    Listado de actividades asignadas - <a style="color: white;" href="../produccion/new_asignacion.php" class="btn btn-primary "><i class="fa fa-plus"></i> Nuevo registro</a>
                    <div class="page-title-subheading">
                        Lista de actividades asignadas disponibles
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <label class="form-label">Listado </label>
                <div class="d-inline-block dropdown">
                    <a href="../home/index.php"> / Principal <i class="fa fa-home"></i></a>
                </div>
            </div>
        </div>
    </div>

    <table id="tbala_asignacion" class="mb-0 table table-striped" style="width: 100%;">
        <thead>
            <tr>

                <th>#</th>
                <th>Acción</th>
                <th>Empleado</th>
                <th>Actividad</th>
                <th>Fecha</th>
                <th>Costo</th>
                <th>Estado</th>

            </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
            <tr>

                <th>#</th>
                <th>Acción</th>
                <th>Empleado</th>
                <th>Actividad</th>
                <th>Fecha</th>
                <th>Costo</th>
                <th>Estado</th>

            </tr>
        </tfoot>
    </table>

</div>

<?php require "../layout/footer.php" ?>
<script src="../../js/produccion.js"></script>


<div class="modal fade" id="modal_editar_asignacion" role="dialog" aria-labelledby="modal_eitar_rolLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_eitar_rolLabel">Editar asignación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input type="text" id="id_asignacion" hidden>

                <div class="form-row text-center">

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
                        <input type="date" class="form-control" id="fecha_asiga">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        Cerrar
                    </button>
                    <button onclick="editar_asignacion()" class="btn btn-primary">Guardar</button>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    listar_asignacion();

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
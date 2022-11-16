<?php require "../layout/header.php" ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-list"> </i>
                </div>
                <div>
                    Listado de trabajadores - <a style="color: white;" href="../produccion/create_trabajador.php" class="btn btn-primary "><i class="fa fa-plus"></i> Nuevo registro</a>
                    <div class="page-title-subheading">
                        Lista de trabajadores disponibles
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

    <table id="tabla_trabajador" class="mb-0 table table-striped" style="width: 100%;">
        <thead>
            <tr>

                <th>#</th>
                <th>Acción</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Cédula</th>
                <th>Teléfono</th>
                <th>Sexo</th>
                <th>Correo</th>
                <th>Estado</th>

            </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
            <tr>

                <th>#</th>
                <th>Acción</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Cédula</th>
                <th>Teléfono</th>
                <th>Sexo</th>
                <th>Correo</th>
                <th>Estado</th>

            </tr>
        </tfoot>
    </table>

</div>

<?php require "../layout/footer.php" ?>
<script src="../../js/produccion.js"></script>


<div class="modal fade" id="modal_editar_trabajador" role="dialog" aria-labelledby="modal_eitar_rolLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_eitar_rolLabel">Editar trabajador</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input type="text" id="id_trabajador" hidden>

                <div class="form-row text-center">

                    <div class="col-sm-6 form-group">
                        <label>Nombres</label> &nbsp;&nbsp; <label style="color:red;" id="nombre_oblig"></label>
                        <input type="text" maxlength="40" class="form-control" id="nombres" placeholder="Ingrese nombres" onkeypress="return soloLetras(event)">
                    </div>

                    <div class="col-sm-6 form-group">
                        <label>Apellidos</label> &nbsp;&nbsp; <label style="color:red;" id="apellido_obliga"></label>
                        <input type="text" maxlength="40" class="form-control" id="apellidos" placeholder="Ingrese apellidos" onkeypress="return soloLetras(event)">
                    </div>

                    <div class="col-sm-6 form-group">
                        <label>Fecha nacimiento</label> &nbsp;&nbsp; <label style="color:red;" id="fecah_obliga"></label>
                        <input type="date" class="form-control" id="fecha_nacimiento">
                    </div>

                    <div class="col-sm-6 form-group">
                        <label>Cedula</label> &nbsp;&nbsp; <label style="color:red;" id="dcoumento_obliga"></label>
                        <input type="text" maxlength="10" class="form-control" id="numero_docu" placeholder="Ingrese numero de cedula" onkeypress="return soloNumeros(event)">
                    </div>

                    <div class="col-sm-6 form-group">
                        <label>Direccion</label> &nbsp;&nbsp; <label style="color:red;" id="direccion_obliga"></label>
                        <input type="text" maxlength="40" class="form-control" id="direccions" placeholder="Ingrese direccions">
                    </div>

                    <div class="col-sm-6 form-group">
                        <label>Telefono</label> &nbsp;&nbsp; <label style="color:red;" id="telefono_obliga"></label>
                        <input type="text" maxlength="15" class="form-control" id="telefono_empleado" placeholder="Ingrese telefono" onkeypress="return soloNumeros(event)">
                    </div>

                    <div class="col-sm-6 form-group">
                        <label>Correo</label> &nbsp;&nbsp; <label style="color:red;" id="correo_obliga"></label>
                        <input type="text" maxlength="100" class="form-control" id="correo_empleado" placeholder="Ingrese correo">
                        <label for="" id="email_correcto" style="color: red;"></label><br>
                    </div>

                    <div class="col-sm-6 form-group">
                        <label>Sexo</label>
                        <select class="form-control" id="sexo">
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        Cerrar
                    </button>
                    <button onclick="editar_trabajador()" class="btn btn-primary">Guardar</button>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    listar_trabajador();

    $("#numero_docu").validarCedulaEC({
        onValid: function() {
            alertify.success('Cedula correcto');
        },
        onInvalid: function() {
            alertify.error('Cedula incorrecto');
            $("#numero_docu").val("");
            $("#numero_docu").focus();
        }
    });
</script>
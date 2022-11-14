<?php require "../layout/header.php" ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-user-plus"> </i>
                </div>
                <div>
                    Nuevo trabajador
                    <div class="page-title-subheading">
                        Crear un nuevo trabajador.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <label class="form-label">Nuevo trabajador</label>
                <div class="d-inline-block dropdown">
                    <a href="../produccion/trabajadores.php"> / Listado </a>
                </div> <a href="../home/index.php"> / Principal <i class="fa fa-home"></i></a> </a>
            </div>
        </div>
    </div>

    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-title">Nuevo trabajador.</h5>

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
                    <input type="text" maxlength="50" class="form-control" id="correo_empleado" placeholder="Ingrese correo">
                    <label for="" id="email_correcto" style="color: red;"></label><br>
                </div>

                <div class="col-sm-6 form-group">
                    <label>Sexo</label>
                    <select class="form-control" id="sexo">
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                    </select>
                </div>

                <div class="col-md-12 p-1">
                    <button onclick="registra_trabajador();" class="btn btn-primary">
                        <i class="fa fa-save"></i> Registrar
                    </button> -
                    <a href="../produccion/trabajadores.php" class="btn btn-danger">Volver</a>
                </div>
            </div>

        </div>
    </div>
</div>

<?php require "../layout/footer.php" ?>
<script src="../../js/produccion.js"></script>

<script>
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
<?php require "../layout/header.php" ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-user-plus"> </i>
                </div>
                <div>
                    Nuevo proveedor
                    <div class="page-title-subheading">
                        Crear un nuevo proveedor.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <label class="form-label">Nuevo proveedor</label>
                <div class="d-inline-block dropdown">
                    <a href="../inventario/list_proveedor.php"> / Listado </a>
                </div> <a href="../home/index.php"> / Principal <i class="fa fa-home"></i></a> </a>
            </div>
        </div>
    </div>

    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-title">Nuevo proveedor.</h5>

            <div class="form-row text-center">

                <div class="col-md-4 mb-3">
                    <label for="razon_social">Razon social</label> <b><label style="color: red;" id="razon_social_obligg"></label></b>
                    <input type="text" maxlength="100" class="form-control" id="razon_social" placeholder="Ingrese razon social" />
                </div>

                <div class="col-md-4 mb-3">
                    <label for="ruc">Ruc</label> <b><label style="color: red;" id="ruc_obligg"></label></b>
                    <input type="text" maxlength="13" class="form-control" id="ruc" placeholder="Ingrese ruc proveedor" onkeypress="return soloNumeros(event)" />
                </div>

                <div class="col-md-4 mb-3">
                    <label for="telefono">Telefono</label> <b><label style="color: red;" id="telefono_obligg"></label></b>
                    <input type="number" class="form-control" id="telefono" placeholder="Ingrese el telefono" onkeypress="return soloNumeros(event)" />
                </div>

                <div class="col-md-6 mb-3">
                    <label for="direccion">Direcciónn</label> <b><label style="color: red;" id="direccion_obligg"></label></b>
                    <input type="text" maxlength="100" class="form-control" id="direccion" placeholder="Ingrese la dirección" />
                </div>

                <div class="col-md-6 mb-3">
                    <label for="correo">Correo</label> <b><label style="color: red;" id="correo_obligg"></label></b>
                    <input type="text" maxlength="100" class="form-control" id="correo" placeholder="Ingrese correo" />
                    <label for="" id="email_correcto" style="color: red;"></label>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="encargado">Encargado</label> <b><label style="color: red;" id="encargado_obligg"></label></b>
                    <input type="text" maxlength="100" class="form-control" id="encargado" placeholder="Ingrese encargado" onkeypress="return soloLetras(event)" />
                </div>

                <div class="col-md-6 mb-3">
                    <label>Descripción</label> <b><label style="color:red;" id="descrip_prov_obliga"></label></b>
                    <textarea class="form-control" rows="3" id="decripcion_proveedor"></textarea>
                </div>

                <div class="col-md-12 p-2">
                    <button onclick="registra_proveedor();" class="btn btn-primary">
                        <i class="fa fa-save"></i> Registrar
                    </button> -
                    <a href="../inventario/list_proveedor.php" class="btn btn-danger">Volver</a>
                </div>

            </div>

        </div>
    </div>
</div>

<?php require "../layout/footer.php" ?>
<script src="../../js/inventario.js"></script>

<script>
    var correo_proveedor = false;

    $("#correo").keyup(function() {
        if (this.value != "") {
            document.getElementById('correo').addEventListener('input', function() {
                campo = event.target;
                //este codigo me da formato email
                email = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
                //esto es para validar si es un email valida
                if (email.test(campo.value)) {
                    //estilos para cambiar de color y ocultar el boton
                    $(this).css("border", "1px solid green");
                    $("#email_correcto").html("");
                    correo_proveedor = true;
                } else {
                    $(this).css("border", "1px solid red");
                    $("#email_correcto").html("Email incorrecto");
                    correo_proveedor = false;
                }
            });
        } else {
            $(this).css("border", "1px solid green");
            $("#email_correcto").html("");
            correo_proveedor = false;
        }
    });

    $("#ruc").validarCedulaEC({
        onValid: function() {
            $("#ruc_obligg").html("");
            alertify.success('Ruc correcto');
        },
        onInvalid: function() {
            $("#ruc_obligg").html("Ruc incorrecto")
            alertify.error('Ruc incorrecto');
            $("#ruc").val("");
            $("#ruc").focus();
        }
    });
</script>
<?php require "../layout/header.php" ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-list"> </i>
                </div>
                <div>
                    Listado de proveedor - <a style="color: white;" href="../inventario/crear_proveedor.php" class="btn btn-primary "><i class="fa fa-plus"></i> Nuevo registro</a>
                    <div class="page-title-subheading">
                        Lista de proveedores disponibles
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

    <div class="form-row text-center">
        <div class="col-lg-12" style="width: 100%;">
            <table id="tabla_proveedor" class="mb-0 table table-striped" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Acción</th>
                        <th>Razon social</th>
                        <th>Ruc</th>
                        <th>Telefono</th>
                        <th>Dirección</th>
                        <th>Correo</th>
                        <th>Encargado</th>
                        <th>Descripción</th>
                        <th>Estado</th>

                    </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <tr>
                        <th>Acción</th>
                        <th>Razon social</th>
                        <th>Ruc</th>
                        <th>Telefono</th>
                        <th>Dirección</th>
                        <th>Correo</th>
                        <th>Encargado</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<?php require "../layout/footer.php" ?>
<script src="../../js/inventario.js"></script>

<div class="modal fade" id="modal_editar_proveedor" role="dialog" aria-labelledby="modal_eitar_rolLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_eitar_rolLabel">Editar proveedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input type="text" id="id_proveedor" hidden>

                <div class="form-row text-center">

                    <div class="col-md-4 mb-3">
                        <label for="razon_social">Razon social</label> <b><label style="color: red;" id="razon_social_obligg"></label></b>
                        <input type="text" maxlength="50" class="form-control" id="razon_social" placeholder="Ingrese razon social" />
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
                        <input type="text" maxlength="50" class="form-control" id="direccion" placeholder="Ingrese la dirección" />
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="correo">Correo</label> <b><label style="color: red;" id="correo_obligg"></label></b>
                        <input type="text" maxlength="50" class="form-control" id="correo" placeholder="Ingrese correo" />
                        <label for="" id="email_correcto" style="color: red;"></label>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="encargado">Encargado</label> <b><label style="color: red;" id="encargado_obligg"></label></b>
                        <input type="text" maxlength="50" class="form-control" id="encargado" placeholder="Ingrese encargado" onkeypress="return soloLetras(event)" />
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Descripción</label> <b><label style="color:red;" id="descrip_prov_obliga"></label></b>
                        <textarea class="form-control" rows="3" id="decripcion_proveedor"></textarea>
                    </div>

                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Cerrar
                </button>
                <button onclick="editar_proveedor();" class="btn btn-primary">Guardar</button>
            </div>

        </div>
    </div>
</div>

<script>
    listar_tabla_proveedor();
    var correo_proveedor_edit = false;

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
                    correo_proveedor_edit = true;
                } else {
                    $(this).css("border", "1px solid red");
                    $("#email_correcto").html("Email incorrecto");
                    correo_proveedor_edit = false;
                }
            });
        } else {
            $(this).css("border", "1px solid green");
            $("#email_correcto").html("");
            correo_proveedor_edit = false;
        }
    });
</script>
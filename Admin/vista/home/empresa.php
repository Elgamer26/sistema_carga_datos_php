<?php require "../layout/header.php" ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-home"> </i>
                </div>
                <div>
                    Hacienda ORGANICFRUIT.
                    <div class="page-title-subheading">
                        Datos de la hacienda.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <label class="form-label">Hacienda</label>
                <div class="d-inline-block dropdown">
                </div> <a href="../home/index.php"> / Principal <i class="fa fa-home"></i></a> </a>
            </div>
        </div>
    </div>

    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-title">Datos de la hacienda.</h5>

            <div class="form-row text-center">

                <div class="col-md-4 mb-3 mx-auto">
                    <label for="foto">Foto de la empresa</label>
                    <img id="foto_empresa" height="187" width="200" class="border rounded mx-auto d-block img-fluid" />
                    <input type="text" hidden id="foto_actual" />
                    <input type="file" class="form-control" id="foto_nueva" />
                    <button class="m-2 btn btn-info btn-rounded mb-3" onclick="cambiar_foto_perfil_empresa();"><i class="fa fa-plus"></i> Cambiar foto</button>
                </div>

            </div>

            <div class="form-row text-center">

                <div class="col-md-6 mb-3">
                    <label for="nombre">Nombre empresa</label> <b><label style="color: red;" id="nombre_obligg"></label></b>
                    <input type="text" maxlength="50" onkeypress="return soloLetras(event)" class="form-control" id="nombre" placeholder="Ingrese nombre de la empresa" />
                </div>

                <div class="col-md-6 mb-3">
                    <label for="ruc">Ruc</label> <b><label style="color: red;" id="ruc_obligg"></label></b>
                    <input type="text" maxlength="13" onkeypress="return soloNumeros(event)" class="form-control" id="ruc" placeholder="Ingrese ruc de la empresa" />
                </div>

                <div class="col-md-6 mb-3">
                    <label for="direccion">Dirección</label> <b><label style="color: red;" id="direccion_obligg"></label></b>
                    <input type="text" maxlength="100" class="form-control" id="direccion" placeholder="Ingrese dirección de la empresa" />
                </div>

                <div class="col-md-6 mb-3">
                    <label for="telefono">Telefono</label> <b><label style="color: red;" id="telefono_obligg"></label></b>
                    <input type="text" maxlength="10" onkeypress="return soloNumeros(event)" class="form-control" id="telefono" placeholder="Ingrese telefono de la empresa" />
                </div>

                <div class="col-md-6 mb-3">
                    <label for="correo">Correo</label> <b><label style="color: red;" id="correo_obligg"></label></b>
                    <input type="text" maxlength="100" class="form-control" id="correo_e" placeholder="Ingrese el correo" />
                    <label for="" id="email_correcto" style="color: red;"></label>
                </div>

                <div class="col-md-12 mb-3">
                    <label for="detalle">Actividad</label> <b><label style="color: red;" id="detalle_obligg"></label></b>
                    <textarea class="form-control" id="detalle" cols="30" rows="3"></textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="encargado">Encargado</label> <b><label style="color: red;" id="encargado_obligg"></label></b>
                    <input type="text" maxlength="50" onkeypress="return soloLetras(event)" class="form-control" id="encargado" placeholder="Ingrese encargado de la empresa" />
                </div>

                <div class="col-md-6 mb-3">
                    <label for="telefono_encargado">Telefono encargado</label> <b><label style="color: red;" id="telefono_encargado_obligg"></label></b>
                    <input type="text" maxlength="10" onkeypress="return soloNumeros(event)" class="form-control" id="telefono_encargado" placeholder="Ingrese telefono encargado de la empresa" />
                </div>

                <div class="col-md-12 p-3">
                    <button onclick="editra_datos_empresa();" class="btn btn-primary">
                        <i class="fa fa-edit"></i> Editar
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<?php require "../layout/footer.php" ?>
<script src="../../js/system.js"></script>

<script>
    traer_datos_de_empresa();
    var correo_home = false;

    document.getElementById("foto_nueva").addEventListener("change", () => {
        var filename = document.getElementById("foto_nueva").value;
        var idxdot = filename.lastIndexOf(".") + 1;
        var extfile = filename.substr(idxdot, filename.length).toLowerCase();
        if (extfile == "jpg" || extfile == "jpeg" || extfile == "png") {} else {
            swal.fire(
                "Mensaje de alerta",
                "Solo se aceptan imagenes - USTED SUBIO UN ARCHIVO CON LA EXTENCIO ." + extfile,
                "warning"
            );
            document.getElementById("foto_nueva").value = "";
        }
    });

    $("#correo_e").keyup(function() {
        if (this.value != "") {
            document.getElementById('correo_e').addEventListener('input', function() {
                campo = event.target;
                //este codigo me da formato email
                email = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
                //esto es para validar si es un email valida
                if (email.test(campo.value)) {
                    //estilos para cambiar de color y ocultar el boton
                    $(this).css("border", "1px solid green");
                    $("#email_correcto").html("");
                    correo_home = true;
                } else {
                    $(this).css("border", "1px solid red");
                    $("#email_correcto").html("Email incorrecto");
                    correo_home = false;
                }
            });
        } else {
            $(this).css("border", "1px solid green");
            $("#email_correcto").html("");
            correo_home = false;
        }
    });
</script>

<!-- mx-auto
mx-auto -->
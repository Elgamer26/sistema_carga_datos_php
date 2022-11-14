<?php require "../layout/header.php" ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-list"> </i>
                </div>
                <div>
                    Listado de usuario
                    <div class="page-title-subheading">
                        Lista de usuarios disponibles
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
        <div class="col-lg-12">

            <table id="tabla_usuario" class="table table-striped table-responsive" style="width: 100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th style="width: 100% !important;">Acción</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Rol</th>
                        <th>Foto</th>
                        <th>Correo</th>
                        <th>Cedula</th>
                        <th>Usuario</th>
                        <th>Estado</th>

                    </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th style="width: 100% !important;">Acción</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Rol</th>
                        <th>Foto</th>
                        <th>Correo</th>
                        <th>Cedula</th>
                        <th>Usuario</th>
                        <th>Estado</th>

                    </tr>
                </tfoot>
            </table>

        </div>
    </div>
</div>

<?php require "../layout/footer.php" ?>
<script src="../../js/usuario.js"></script>

<div class="modal fade" id="modal_editar_photo" role="dialog" aria-labelledby="modal_eitar_rolLabel" aria-hidden="true">
    <div class="modal-dialog xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_eitar_rolLabel">Editar foto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <input type="number" id="id_foto_producto" hidden>
                        <div class="col-md-12 mb-3 form-group">
                            <div class="ibox-body text-center">

                                <img class="img-circle" id="foto_producto" style="border-radius: 50%;" white="350px" height="350px">
                                <h5 class="font-strong m-b-10 m-t-10"><span>Foto de usuario</span></h5>
                                <div>
                                    <input type="file" id="foto_new" class="form-control">
                                    <input type="text" id="foto_actu" hidden>
                                    <button class="btn btn-info btn-rounded mb-3" onclick="editar_foto_usuario();"><i class="fa fa-plus"></i> Cambiar foto</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_editar_usuario" role="dialog" aria-labelledby="modal_eitar_rolLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_eitar_rolLabel">Editar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            <input type="text" id="id_usuario" hidden>

                <div class="form-row text-center">
                    <div class="col-md-6 mb-3">
                        <label for="nombres">Nombres</label> <b><label style="color: red;" id="nombres_obligg"></label></b>
                        <input type="text" maxlength="50" onkeypress="return soloLetras(event)" class="form-control" id="nombres" placeholder="Ingrese el nombres" />
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="apellidos">Apellidos</label> <b><label style="color: red;" id="apellidos_obligg"></label></b>
                        <input type="text" maxlength="50" onkeypress="return soloLetras(event)" class="form-control" id="apellidos" placeholder="Ingrese el apellidos" />
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="correo">Correo</label> <b><label style="color: red;" id="correo_obligg"></label></b>
                        <input type="text" maxlength="100" class="form-control" id="correo" placeholder="Ingrese el correo" />
                        <label for="" id="email_correcto" style="color: red;"></label>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="cedula">Cedula</label> <b><label style="color: red;" id="cedula_obligg"></label></b>
                        <input type="text" maxlength="10" onkeypress="return soloNumeros(event)" class="form-control" id="cedula" placeholder="Ingrese la cedula" />
                        <label for="" id="cedula_empleado" style="color: red; font-size: 12px;"></label>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="tipo_rol">Tipo de rol</label> <b><label style="color: red;" id="tipo_rol_obligg"></label></b>
                        <select class="form-cotrol tipo_rol" style="width: 100%;" id="tipo_rol"></select>
                    </div>

                    <div class="col-md-5 mb-3">
                        <label for="usuario">Usuario</label> <b><label style="color: red;" id="usuario_obligg"></label></b>
                        <input type="text" maxlength="20" class="form-control" id="usuario" placeholder="Ingrese el usuario" />
                    </div>

                    <div class="col-md-12 p-3">
                        <button onclick="editar_usuario();" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Editar
                        </button> -
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    listar_usuario();
    listar_rol_usu();
    $(".tipo_rol").select2();
    var correo_usus_edit = false;

    document.getElementById("foto_new").addEventListener("change", () => {
        var filename = document.getElementById("foto_new").value;
        var idxdot = filename.lastIndexOf(".") + 1;
        var extfile = filename.substr(idxdot, filename.length).toLowerCase();
        if (extfile == "jpg" || extfile == "jpeg" || extfile == "png") {} else {
            swal.fire(
                "Mensaje de alerta",
                "Solo se aceptan imagenes - USTED SUBIO UN ARCHIVO CON LA EXTENCIO ." + extfile,
                "warning"
            );
            document.getElementById("foto_new").value = "";
        }
    });

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
                    correo_usus_edit = true;
                } else {
                    $(this).css("border", "1px solid red");
                    $("#email_correcto").html("Email incorrecto");
                    correo_usus_edit = false;
                }
            });
        } else {
            $(this).css("border", "1px solid green");
            $("#email_correcto").html("");
            correo_usus_edit = false;
        }
    });

    $("#cedula").keyup(function() {
        if (this.value != "") {
            var cad = document.getElementById("cedula").value.trim();
            var total = 0;
            var longitud = cad.length;
            var longcheck = longitud - 1;

            if (cad != "") {
                if (cad !== "" && longitud === 10) {
                    for (i = 0; i < longcheck; i++) {
                        if (i % 2 === 0) {
                            var aux = cad.charAt(i) * 2;
                            if (aux > 9) aux -= 9;
                            total += aux;
                        } else {
                            total += parseInt(cad.charAt(i)); // parseInt o concatenará en lugar de sumar           
                        }
                    }
                    total = total % 10 ? 10 - total % 10 : 0;
                    if (cad.charAt(longitud - 1) == total) {

                        var digitos = String(cad).split('').map(d => parseInt(d));
                        var digito = digitos[0];
                        var veri = digitos.every((d) => d == digito);

                        if (!veri) {
                            $(this).css("border", "1px solid green");
                            $("#cedula_empleado").html("");
                        } else {
                            document.getElementById("cedula_empleado").innerHTML = ("cedula Inválida");
                            $(this).css("border", "1px solid red");
                        }

                    } else {
                        document.getElementById("cedula_empleado").innerHTML = ("cedula Inválida");
                        $(this).css("border", "1px solid red");
                        // $("#ocutar_p").hide();
                    }
                } else {
                    document.getElementById("cedula_empleado").innerHTML = ("La cedula no tiene 10 digitos");
                    $(this).css("border", "1px solid red");
                    // $("#ocutar_p").hide();
                }
            } else {
                document.getElementById("cedula_empleado").innerHTML = ("Debe ingresra una cedula");
                $(this).css("border", "1px solid red");
            }
        } else {
            $(this).css("border", "1px solid green");
            $("#cedula_empleado").html("");
        }
    });
</script>

 
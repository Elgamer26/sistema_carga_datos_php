<?php require "../layout/header.php" ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-user-plus"> </i>
                </div>
                <div>
                    Nuevo usuario 
                    <div class="page-title-subheading">
                        Crear un nuevo usuario.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <label class="form-label">Nuevo usuario</label>
                <div class="d-inline-block dropdown">
                </div> <a href="../home/index.php"> / Principal <i class="fa fa-home"></i></a> </a>
            </div>
        </div>
    </div>

    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-title">Nuevo usuario.</h5>

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

                <div class="col-md-3 mb-3">
                    <label for="password">Password</label> <b><label style="color: red;" id="password_obligg"></label></b>
                    <input type="password" class="form-control" id="password" placeholder="Ingrese el password" />
                    <span id="passstrength"></span>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="password_c">Confirma password</label> <b><label style="color: red;" id="password_c_obligg"></label></b>
                    <input type="password" class="form-control" id="password_c" placeholder="Vuelva a ingresa el password" />
                </div>

                <div class="col-md-1 mb-3">
                    <label> . . .</label>
                    <button onclick="mostrar_usu();" class="btn btn-primary"><i class="fa fa-eye"></i> Ver</button>
                </div>

                <div class="col-md-4 mb-3 mx-auto">
                    <label for="password_c">Foto</label> <b><label style="color: orange;"> - La foto no es obligatorio</label></b>

                    <img id="img_producto" height="187" width="200" class="border rounded mx-auto d-block img-fluid" src="../../img/usuario/perfil.png" />

                    <input type="file" class="form-control" id="foto" onchange="mostrar_imagen(this)" />
                </div>


                <div class="col-md-12 p-3">
                    <button onclick="registra_usuario();" class="btn btn-primary">
                        <i class="fa fa-save"></i> Registrar
                    </button> -
                    <a href="../usuario/listado.php" class="btn btn-danger">Volver</a>
                </div>
            </div>

        </div>
    </div>
</div>

<?php require "../layout/footer.php" ?>
<script src="../../js/usuario.js"></script>

<script>
    listar_rol_usu();
    var pass_usus = false;
    var correo_usus = false;
    $(".tipo_rol").select2();

    function mostrar_usu() {
        var ver = document.getElementById("password");
        var con = document.getElementById("password_c");

        if (ver.type == "password") {
            ver.type = "text";
            con.type = "text";
        } else {
            ver.type = "password";
            con.type = "password";
        }
    }

    $('#password').keyup(function(e) {
        var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
        var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
        var enoughRegex = new RegExp("(?=.{6,}).*", "g");
        if (false == enoughRegex.test($(this).val())) {
            $('#passstrength').html('Más caracteres.');
            $('#passstrength').css('color', 'red');

            pass_usus = false;
        } else if (strongRegex.test($(this).val())) {
            $('#passstrength').className = 'ok';
            $('#passstrength').html('Fuerte!');
            $('#passstrength').css('color', 'green');

            pass_usus = true;
        } else if (mediumRegex.test($(this).val())) {
            $('#passstrength').className = 'alert';
            $('#passstrength').html('Media!');
            $('#passstrength').css('color', 'orange');

            pass_usus = false
        } else {
            $('#passstrength').className = 'error';
            $('#passstrength').html('Débil!');
            $('#passstrength').css('color', 'red');

            pass_usus = false
        }
        return true;
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

    function mostrar_imagen(input) {
        var filename = document.getElementById("foto").value;
        var idxdot = filename.lastIndexOf(".") + 1;
        var extfile = filename.substr(idxdot, filename.length).toLowerCase();
        if (extfile == "jpg" || extfile == "jpeg" || extfile == "png") {

            if (input.files) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#img_producto").attr("src", e.target.result).width(200).height(197);
                }
                reader.readAsDataURL(input.files[0]);
            }

        } else {
            swal.fire(
                "Mensaje de alerta",
                "Solo se aceptan imagenes - USTED SUBIO UN ARCHIVO CON LA EXTENCIO ." + extfile,
                "warning"
            );
            $("#img_producto").attr("src", "../../img/usuario/perfil.png").width(200).height(197);
            return document.getElementById("foto").value = "";
        }

    }

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
                    correo_usus = true;
                } else {
                    $(this).css("border", "1px solid red");
                    $("#email_correcto").html("Email incorrecto");
                    correo_usus = false;
                }
            });
        } else {
            $(this).css("border", "1px solid green");
            $("#email_correcto").html("");
            correo_usus = false;
        }
    });
</script>

<!-- mx-auto
mx-auto -->
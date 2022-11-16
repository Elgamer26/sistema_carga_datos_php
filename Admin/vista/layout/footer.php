<div class="app-wrapper-footer">
    <div class="app-footer">
        <div class="app-footer__inner">
            <div class="app-footer-left">
                <ul class="nav">
                    <li class="nav-item">
                        <b>Sistema OrganicFruit - Todos los derechos reservados 2022</b>
                    </li>

                </ul>
            </div>

        </div>
    </div>
</div>

</div>

<!-- <script src="http://maps.google.com/maps/api/js?sensor=true"></script> -->
</div>
</div>
<script type="text/javascript" src="../../template/assets/scripts/main.js"></script>
<script src="../../plugins/js/jquery-3.6.1.min.js"></script>
<script src="../../plugins/modales/popper/popper.min.js"></script>

<script src="../../plugins/modales/bootstrap4/js/bootstrap.min.js"></script>
<script src="../../plugins/modales/jqueryUI/jquery-ui-1.12.1/jquery-ui.min.js"></script>

<script src="../../plugins/DATATABLES/datatables.min.js"></script>
<script src="../../plugins/js/sweetalert2/sweetalert2.all.min.js"></script>

<script src="../../plugins/SELECT2/js/select2.min.js"></script>
<!-- <script src="../../plugins/Chart/chart.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@latest/dist/Chart.min.js"></script>

<!-- mis scripts -->
<script src="../../js/system.js"></script>
<script src="../../js/numero.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>


</body>

</html>

<div class="modal fade" id="modal_datos_usuario" role="dialog" aria-labelledby="modal_eitar_rolLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_eitar_rolLabel">Editar datos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input type="text" id="id_usuario" hidden>

                <div class="form-row text-center">

                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a data-toggle="tab" href="#tab-eg13-0" class="active nav-link"><i class="fa fa-user"></i> Datos de usuario</a></li>
                                    <li class="nav-item"><a data-toggle="tab" href="#tab-eg13-1" class="nav-link"><i class="fa fa-image"></i> Foto de perfil</a></li>
                                    <li class="nav-item"><a data-toggle="tab" href="#tab-eg13-2" class="nav-link"><i class="fa fa-key"></i> Password</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-eg13-0" role="tabpanel">

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="nombres_l">Nombres</label> <b><label style="color: red;" id="nombres_l_obligg"></label></b>
                                                <input type="text" maxlength="50" onkeypress="return soloLetras(event)" class="form-control" id="nombres_l" placeholder="Ingrese el nombres" />
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="apellidos_l">Apellidos</label> <b><label style="color: red;" id="apellidos_l_obligg"></label></b>
                                                <input type="text" maxlength="50" onkeypress="return soloLetras(event)" class="form-control" id="apellidos_l" placeholder="Ingrese el apellidos" />
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="correo_l">Correo</label> <b><label style="color: red;" id="correo_l_obligg"></label></b>
                                                <input type="text" maxlength="100" class="form-control" id="correo_l" placeholder="Ingrese el correo" />
                                                <label for="" id="email_l_correcto" style="color: red;"></label>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="usuario_l">Usuario</label> <b><label style="color: red;" id="usuario_l_obligg"></label></b>
                                                <input type="text" maxlength="100" class="form-control" id="usuario_l" placeholder="Ingrese el usuario_l" />
                                            </div>

                                            <div class="col-md-12 p-3">
                                                <button onclick="editar_usuario_login();" class="btn btn-primary">
                                                    <i class="fa fa-edit"></i> Editar
                                                </button> -
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane" id="tab-eg13-1" role="tabpanel">

                                        <div class="row">

                                            <div class="col-md-12 mb-3 form-group">
                                                <div class="ibox-body text-center">

                                                    <img id="foto_usuario_l" style="border-radius: 10%;" white="300px" height="300px">
                                                    <h5 class="font-strong m-b-10 m-t-10"><span>Foto de usuario</span></h5>
                                                    <div>
                                                        <input type="file" id="foto_new_l" class="form-control">
                                                        <input type="text" id="foto_actu_l" hidden>
                                                        <button class="btn btn-info btn-rounded m-2" onclick="editar_foto_usuario_logeado();"><i class="fa fa-plus"></i> Cambiar foto</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane" id="tab-eg13-2" role="tabpanel">

                                        <div class="row">

                                            <input type="text" hidden id="pass_oculto" />

                                            <div class="col-md-11 mb-3">
                                                <label for="pass_ac">assword actual</label> <b><label style="color: red;" id="pass_ac_obligg"></label></b>
                                                <input type="password" maxlength="50" class="form-control" id="pass_ac" placeholder="Ingrese el password actual" />
                                            </div>

                                            <div class="col-md-1 mb-3">
                                                <label> </label>
                                                <button onclick="mostrar_pass_l();" class="btn btn-primary"><i class="fa fa-eye"></i></button>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="pass_nue">assword nuevo</label> <b><label style="color: red;" id="pass_nue_obligg"></label></b>
                                                <input type="password" maxlength="50" class="form-control" id="pass_nue" placeholder="Ingrese el password nuevo" />
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="pass_co">Confirmar password</label> <b><label style="color: red;" id="pass_co_obligg"></label></b>
                                                <input type="password" maxlength="50" class="form-control" id="pass_co" placeholder="Confirmar password" />
                                            </div>

                                            <div class="col-md-12 p-3">
                                                <button onclick="cambiar_password_login();" class="btn btn-primary">
                                                    <i class="fa fa-edit"></i> Cambiar password
                                                </button> -
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var correo_usus_lo = true;
    datos_usuario_logeado();
    obtener_permisos_usuario();
    

    //////
    /// par los graficos
    function colores_rgb() {
        var coolor = "(" + generar_numero(255) + "," + generar_numero(255) + "," + generar_numero(255) + ")";
        return "rgb" + coolor;
    }

    function generar_numero(numero) {
        return (Math.random() * numero).toFixed(0);
    }

    ////loader
    function mostar_loader_datos(alerta) {
        var texto = null;
        var mostrar = false;

        switch (alerta[0]) {
            case "datos":
                texto = alerta[1];
                mostrar = true;
                break;
        }
        if (mostrar) {
            Swal.fire({
                icon: "info",
                title: alerta[2],
                html: texto,
                allowOutsideClick: false,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                },
            });
        }
    }

    function cerrar_loader_datos(alerta) {
        var tipo = null;
        var texto = null;
        var mostrar = false;

        switch (alerta[0]) {
            case "exito":
                tipo = alerta[1];
                texto = alerta[2];
                mostrar = true;
                break;

            case "existe":
                tipo = alerta[1];
                texto = alerta[2];
                mostrar = true;
                break;

            case "error":
                tipo = alerta[1];
                texto = alerta[2];
                mostrar = true;
                break;

            default:
                swal.close();
                break;
        }
        if (mostrar) {
            Swal.fire({
                position: "center",
                icon: tipo,
                text: texto,
                showConfirmButton: true,
                allowOutsideClick: false,
            });
        }
    }

    /////////////////
    function soloLetras(e) {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toLowerCase();
        letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
        especiales = "8-37-39-46";
        tecla_especial = false
        for (var i in especiales) {
            if (key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }
        if (letras.indexOf(tecla) == -1 && !tecla_especial) {
            return swal.fire(
                "No se permiten numeros!!",
                "Solo se permiten letras",
                "warning"
            );
        }
    }

    function soloNumeros(e) {
        var key = window.event ? e.which : e.keyCode;
        if (key < 48 || key > 57) {
            return swal.fire(
                "No se permiten letras!!",
                "Solo se permiten numeros",
                "warning"
            );
        }
    }

    function mostrar_pass_l() {
        var ver = document.getElementById("pass_ac");
        var con = document.getElementById("pass_nue");
        var co = document.getElementById("pass_co");

        if (ver.type == "password") {
            ver.type = "text";
            con.type = "text";
            co.type = "text";
        } else {
            ver.type = "password";
            con.type = "password";
            co.type = "password";
        }
    }

    $("#correo_l").keyup(function() {
        if (this.value != "") {
            document.getElementById('correo_l').addEventListener('input', function() {
                campo = event.target;
                //este codigo me da formato email
                email = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
                //esto es para validar si es un email valida
                if (email.test(campo.value)) {
                    //estilos para cambiar de color y ocultar el boton
                    $(this).css("border", "1px solid green");
                    $("#email_l_correcto").html("");
                    correo_usus_lo = true;
                } else {
                    $(this).css("border", "1px solid red");
                    $("#email_l_correcto").html("Email incorrecto");
                    correo_usus_lo = false;
                }
            });
        } else {
            $(this).css("border", "1px solid green");
            $("#email_l_correcto").html("");
            correo_usus_lo = false;
        }
    });

    function obtener_permisos_usuario() {
        funcion = "obtener_permisos_usuario";
        $.ajax({
            url: "../../controlador/usuario/usuario.php",
            type: "POST",
            data: {
                funcion: funcion
            },
        }).done(function(response) {
            var data = JSON.parse(response);

            console.log(data);

            data[0][2].toString() == "true" ?
                ($("#usuario_p_").show()) :
                ($("#usuario_p_").hide());

            data[0][3].toString() == "true" ?
                ($("#empresa_p_").show()) :
                ($("#empresa_p_").hide());

            data[0][4].toString() == "true" ?
                ($("#insumo_p_").show()) :
                ($("#insumo_p_").hide());

            data[0][5].toString() == "true" ?
                ($("#herramienta_p_").show()) :
                ($("#herramienta_p_").hide());

            data[0][6].toString() == "true" ?
                ($("#proveedor_p_").show()) :
                ($("#proveedor_p_").hide());

            data[0][7].toString() == "true" ?
                ($("#compra_i_p_").show()) :
                ($("#compra_i_p_").hide());

            data[0][8].toString() == "true" ?
                ($("#compra_h_p_").show()) :
                ($("#compra_h_p_").hide());

            data[0][9].toString() == "true" ?
                ($("#actividad_p_").show()) :
                ($("#actividad_p_").hide());

            data[0][10].toString() == "true" ?
                ($("#trabajador_p_").show()) :
                ($("#trabajador_p_").hide());

            data[0][11].toString() == "true" ?
                ($("#asiganar_p_").show()) :
                ($("#asiganar_p_").hide());

            data[0][12].toString() == "true" ?
                ($("#cinta_p_").show()) :
                ($("#cinta_p_").hide());

            data[0][13].toString() == "true" ?
                ($("#lote_p_").show()) :
                ($("#lote_p_").hide());

            data[0][14].toString() == "true" ?
                ($("#produccion_p_").show()) :
                ($("#produccion_p_").hide());

            data[0][15].toString() == "true" ?
                ($("#encinte_p_").show()) :
                ($("#encinte_p_").hide());

            data[0][16].toString() == "true" ?
                ($("#fruta_p_").show()) :
                ($("#fruta_p_").hide());

            data[0][17].toString() == "true" ?
                ($("#proceso_c_p_").show()) :
                ($("#proceso_c_p_").hide());

            data[0][18].toString() == "true" ?
                ($("#data_c_p_").show()) :
                ($("#data_c_p_").hide());

            data[0][19].toString() == "true" ?
                ($("#proceso_e_p_").show()) :
                ($("#proceso_e_p_").hide());

            data[0][20].toString() == "true" ?
                ($("#data_f_p_").show()) :
                ($("#data_f_p_").hide());

            data[0][21].toString() == "true" ?
                ($("#proceso_r_p_").show()) :
                ($("#proceso_r_p_").hide());

            data[0][22].toString() == "true" ?
                ($("#data_r_p_").show()) :
                ($("#data_r_p_").hide());

            data[0][23].toString() == "true" ?
                ($("#proceso_p_p_").show()) :
                ($("#proceso_p_p_").hide());

            data[0][24].toString() == "true" ?
                ($("#data_p_p_").show()) :
                ($("#data_p_p_").hide());

            data[0][25].toString() == "true" ?
                ($("#prediccion_c_p_").show()) :
                ($("#prediccion_c_p_").hide());

            data[0][26].toString() == "true" ?
                ($("#prediccion_e_p_").show()) :
                ($("#prediccion_e_p_").hide());

            data[0][27].toString() == "true" ?
                ($("#prediccion_r_p_").show()) :
                ($("#prediccion_r_p_").hide());

            data[0][28].toString() == "true" ?
                ($("#prediccion_p_p_").show()) :
                ($("#prediccion_p_p_").hide());

            data[0][29].toString() == "true" ?
                ($(".informe_p_").show()) :
                ($(".informe_p_").hide());

        });
    }
</script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar password</title>
    <link rel="icon" href="../Admin/img/candado.jpg">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>

<style>
    .register {
        background: -webkit-linear-gradient(left, #3931af, #00c6ff);
        margin-top: 3%;
        padding: 3%;
    }

    .register-left {
        text-align: center;
        color: #fff;
        margin-top: 4%;
    }

    .register-left input {
        border: none;
        border-radius: 1.5rem;
        padding: 2%;
        width: 60%;
        background: #f8f9fa;
        font-weight: bold;
        color: #383d41;
        margin-top: 30%;
        margin-bottom: 3%;
        cursor: pointer;
    }

    .register-right {
        background: #f8f9fa;
        border-top-left-radius: 10% 50%;
        border-bottom-left-radius: 10% 50%;
    }

    .register-left img {
        margin-top: 15%;
        margin-bottom: 5%;
        width: 25%;
        -webkit-animation: mover 2s infinite alternate;
        animation: mover 1s infinite alternate;
    }

    @-webkit-keyframes mover {
        0% {
            transform: translateY(0);
        }

        100% {
            transform: translateY(-20px);
        }
    }

    @keyframes mover {
        0% {
            transform: translateY(0);
        }

        100% {
            transform: translateY(-20px);
        }
    }

    .register-left p {
        font-weight: lighter;
        padding: 12%;
        margin-top: -9%;
    }

    .register .register-form {
        padding: 10%;
        margin-top: 10%;
    }

    .btnRegister {
        float: right;
        margin-top: 10%;
        border: none;
        border-radius: 1.5rem;
        padding: 2%;
        background: #0062cc;
        color: #fff;
        font-weight: 600;
        width: 50%;
        cursor: pointer;
    }

    .register .nav-tabs {
        margin-top: 3%;
        border: none;
        background: #0062cc;
        border-radius: 1.5rem;
        width: 28%;
        float: right;
    }

    .register .nav-tabs .nav-link {
        padding: 2%;
        height: 34px;
        font-weight: 600;
        color: #fff;
        border-top-right-radius: 1.5rem;
        border-bottom-right-radius: 1.5rem;
    }

    .register .nav-tabs .nav-link:hover {
        border: none;
    }

    .register .nav-tabs .nav-link.active {
        width: 100px;
        color: #0062cc;
        border: 2px solid #0062cc;
        border-top-left-radius: 1.5rem;
        border-bottom-left-radius: 1.5rem;
    }

    .register-heading {
        text-align: center;
        margin-top: 8%;
        margin-bottom: -15%;
        color: #495057;
    }
</style>

<body class="container register">
    <div class="enviar_correo_full">
        <div class="row">
            <div class="col-md-3 register-left">
                <img alt="" />
                <h3>Vover al login!</h3>
                <p>Para recuperar su contraseña, debe tener un correo registrado en el sistema!</p>
                <input type="button" id="volver_login" value="Login" /><br />
            </div>

            <div class="col-md-9 register-right">

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">Recuperar password</h3>


                        <div class="row register-form">

                            <div class="col-md-12">
                                <div style="
                                    text-align: center;
                                    background: #ff000094; 
                                    padding: 5px;
                                    display: none;
                                    color: white;" id="correo_fail">
                                    <span><b> Correo ingresa no es valido</b></span>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div style="
                                    text-align: center;
                                    background: green; 
                                    padding: 5px;
                                    display: none;
                                    color: white;" id="password_ok">
                                    <span><b> Password restabecido con exito, se envio al correo la nueva password!</b></span>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div style="
                                    text-align: center;
                                    background: #ff000094; 
                                    padding: 5px;
                                    display: none;
                                    color: white;" id="error_correo">
                                    <span><b> Error al enviar el correo</b></span>
                                </div>
                            </div>

                            <br>
                            <br>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Ingrese un correo" id="correo" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <input type="button" class="btnRegister" value="Enviar" id="enviar_correo" />
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

</body>

</html>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>

<script>
    $(document).on('click', '#volver_login', function(event) {
        event.preventDefault();
        window.location.href = "index.php";
    })

    $(document).on('click', '#enviar_correo', function(event) {
        event.preventDefault();
        var correo = $("#correo").val();
        var funcion;
        funcion = "verificar_correo";

        $(".enviar_correo_full").LoadingOverlay("show", {
            image: "",
            text: "Enviando correo..."
        });

        $.ajax({
            type: "POST",
            url: "../Admin/controlador/usuario/usuario.php",
            data: {
                correo: correo,
                funcion: funcion
            },
            success: function(response) {
                $("#correo_fail").hide();
                $("#error_correo").hide();
                $("#password_ok").hide();
                if (response == 0) {
                    $(".enviar_correo_full").LoadingOverlay("hide");
                    $("#correo_fail").show(2000);
                } else {
                    $.ajax({
                        type: "POST",
                        url: "../Admin/modelo/envio_correo/recuperar_password.php",
                        data: {
                            correo: correo
                        },
                        success: function(resp) {
                            if (resp == 1) {
                                $(".enviar_correo_full").LoadingOverlay("hide");
                                $("#correo").val("");
                                $("#password_ok").show(2000);
                            } else {
                                $(".enviar_correo_full").LoadingOverlay("hide");
                                $("#error_correo").show(2000);
                            }
                        }
                    });

                }
            }
        });
    })
</script>
<?php require "../layout/header.php" ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-wrench"> </i>
                </div>
                <div>
                    Nuevo herramienta
                    <div class="page-title-subheading">
                        Crear un nuevo herramienta.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <label class="form-label">Nuevo herramienta</label>
                <div class="d-inline-block dropdown">
                    <a href="../inventario/list_herramienta.php"> / Listado </a>
                </div> <a href="../home/index.php"> / Principal <i class="fa fa-home"></i></a> </a>
            </div>
        </div>
    </div>

    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-title">Nuevo herramienta.</h5>

            <div class="form-row text-center">

                <div class="col-md-2 mb-3">
                    <label for="codigo_herramientao">Codigo herramienta</label> <b><label style="color: red;" id="codigo_herramientao_obligg"></label></b>
                    <input type="text" maxlength="10" value="<?php echo rand(0, 9999999); ?>" class="form-control" id="codigo_herramientao" placeholder="Ingrese el codigo herramienta" onkeypress="return soloNumeros(event)" />
                </div>

                <div class="col-md-5 mb-3">
                    <label for="nombre_herramienta">Nombre herramienta</label> <b><label style="color: red;" id="nombre_herramienta_obligg"></label></b>
                    <input type="text" maxlength="50" class="form-control" id="nombre_herramienta" placeholder="Ingrese el nombre herramienta" />
                </div>

                <div class="col-md-5 mb-3">
                    <label for="marca_herramienta">Marca herramienta</label> <b><label style="color: red;" id="marca_herramienta_obligg"></label></b>
                    <input type="text" maxlength="50" class="form-control" id="marca_herramienta" placeholder="Ingrese marca herramienta" />
                </div>

                <div class="col-md-4 mb-3">
                    <label for="tipo_herramienta">Tipo de herramienta</label> <b><label style="color: red;" id="tipo_herramienta_obligg"></label></b>
                    <select class="form-cotrol tipo_herramienta" style="width: 100%;" id="tipo_herramienta"></select>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="precio_compra">Precio compra</label> <b><label style="color: red;" id="precio_compra_obligg"></label></b>
                    <input type="number" class="form-control" id="precio_compra" placeholder="Ingrese el precio compra" />
                </div>

                <div class="col-md-4 mb-3">
                    <label for="cantidad_herramienta">Cantidad</label> <b><label style="color: red;" id="cantidad_herramienta_obligg"></label></b>
                    <input type="text" maxlength="10" class="form-control" id="cantidad_herramienta" placeholder="Ingrese la cantidad" onkeypress="return soloNumeros(event)" />
                </div>

                <div class="col-md-12 mb-3">
                    <label>Descripción</label> <b><label style="color:red;" id="descripc_obliga"></label></b>
                    <textarea class="form-control" rows="3" id="decripcion_herramienta"></textarea>
                </div>

                <div class="col-md-12 mb-3 mx-auto">
                    <label for="password_c">Foto herramienta</label> <b><label style="color: orange;"> - La foto no es obligatorio</label></b>
                    <img id="img_herramienta" height="200" width="200" class="border rounded mx-auto d-block img-fluid" src="../../img/herramienta/herramienta.png" />
                    <div class="row">
                        <div class="col-md-6 mb-3 mx-auto">
                            <input type="file" class="form-control" id="foto" onchange="mostrar_imagen_herramienta(this)" />
                        </div>
                    </div>
                </div>

                <div class="col-md-12 p-1">
                    <button onclick="registra_herramienta();" class="btn btn-primary">
                        <i class="fa fa-save"></i> Registrar
                    </button> -
                    <a href="../inventario/list_herramienta.php" class="btn btn-danger">Volver</a>
                </div>
            </div>

        </div>
    </div>
</div>

<?php require "../layout/footer.php" ?>
<script src="../../js/inventario.js"></script>

<script>
    listar_tipo_herramienta_COMBO();
    $(".tipo_herramienta").select2();

    function mostrar_imagen_herramienta(input) {
        var filename = document.getElementById("foto").value;
        var idxdot = filename.lastIndexOf(".") + 1;
        var extfile = filename.substr(idxdot, filename.length).toLowerCase();
        if (extfile == "jpg" || extfile == "jpeg" || extfile == "png") {

            if (input.files) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#img_herramienta").attr("src", e.target.result).width(200).height(200);
                }
                reader.readAsDataURL(input.files[0]);
            }

        } else {
            swal.fire(
                "Mensaje de alerta",
                "Solo se aceptan imagenes - USTED SUBIO UN ARCHIVO CON LA EXTENCIO ." + extfile,
                "warning"
            );
            $("#img_herramienta").attr("src", "../../img/herramienta/herramienta.png").width(200).height(200);
            return document.getElementById("foto").value = "";
        }

    }
</script>
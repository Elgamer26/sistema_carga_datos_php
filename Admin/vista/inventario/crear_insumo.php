<?php require "../layout/header.php" ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-cube"> </i>
                </div>
                <div>
                    Nuevo insumo
                    <div class="page-title-subheading">
                        Crear un nuevo insumo.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <label class="form-label">Nuevo insumo</label>
                <div class="d-inline-block dropdown">
                    <a href="../inventario/list_insumo.php"> / Listado </a>
                </div> <a href="../home/index.php"> / Principal <i class="fa fa-home"></i></a> </a>
            </div>
        </div>
    </div>

    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-title">Nuevo insumo.</h5>

            <div class="form-row text-center">

                <div class="col-md-2 mb-3">
                    <label for="codigo_insumoo">Codigo insumo</label> <b><label style="color: red;" id="codigo_insumoo_obligg"></label></b>
                    <input type="text" maxlength="10" value="<?php echo rand(0, 9999999); ?>" class="form-control" id="codigo_insumoo" placeholder="Ingrese el codigo insumo" onkeypress="return soloNumeros(event)" />
                </div>

                <div class="col-md-5 mb-3">
                    <label for="nombre_insumo">Nombre insumo</label> <b><label style="color: red;" id="nombre_insumo_obligg"></label></b>
                    <input type="text" maxlength="50" class="form-control" id="nombre_insumo" placeholder="Ingrese el nombre insumo" />
                </div>

                <div class="col-md-5 mb-3">
                    <label for="marca_insumo">Marca insumo</label> <b><label style="color: red;" id="marca_insumo_obligg"></label></b>
                    <input type="text" maxlength="50" class="form-control" id="marca_insumo" placeholder="Ingrese marca insumo" />
                </div>

                <div class="col-md-4 mb-3">
                    <label for="tipo_insumo">Tipo de insumo</label> <b><label style="color: red;" id="tipo_insumo_obligg"></label></b>
                    <select class="form-cotrol tipo_insumo" style="width: 100%;" id="tipo_insumo"></select>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="precio_compra">Precio compra</label> <b><label style="color: red;" id="precio_compra_obligg"></label></b>
                    <input type="text" onkeypress="return filterfloat(event, this);" class="form-control" id="precio_compra" placeholder="Ingrese el precio compra" />
                </div>

                <div class="col-md-4 mb-3">
                    <label for="cantidad_insumo">Cantidad</label> <b><label style="color: red;" id="cantidad_insumo_obligg"></label></b>
                    <input type="text" maxlength="7" class="form-control" id="cantidad_insumo" placeholder="Ingrese la cantidad" onkeypress="return soloNumeros(event)"/>
                </div>

                <div class="col-md-12 mb-3">
                    <label>Descripción</label>  <b><label style="color:red;" id="descripc_obliga"></label></b>
                    <textarea class="form-control" rows="3" id="decripcion_mterial"></textarea>
                </div>

                <div class="col-md-12 mb-3 mx-auto">
                    <label for="password_c">Foto insumo</label> <b><label style="color: orange;"> - La foto no es obligatorio</label></b>
                    <img id="img_producto" height="200" width="200" class="border rounded mx-auto d-block img-fluid" src="../../img/insumo/insumo.png" />
                    <div class="row">
                        <div class="col-md-6 mb-3 mx-auto">
                            <input type="file" class="form-control" id="foto" onchange="mostrar_imagen_insumo(this)" />
                        </div>
                    </div>
                </div>

                <div class="col-md-12 p-1">
                    <button onclick="registra_insumo();" class="btn btn-primary">
                        <i class="fa fa-save"></i> Registrar
                    </button> -
                    <a href="../inventario/list_insumo.php" class="btn btn-danger">Volver</a>
                </div>
            </div>

        </div>
    </div>
</div>

<?php require "../layout/footer.php" ?>
<script src="../../js/inventario.js"></script>

<script>
    listar_tipo_insumo_COMBO();
    $(".tipo_insumo").select2();

    function mostrar_imagen_insumo(input) {
        var filename = document.getElementById("foto").value;
        var idxdot = filename.lastIndexOf(".") + 1;
        var extfile = filename.substr(idxdot, filename.length).toLowerCase();
        if (extfile == "jpg" || extfile == "jpeg" || extfile == "png") {

            if (input.files) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#img_producto").attr("src", e.target.result).width(200).height(200);
                }
                reader.readAsDataURL(input.files[0]);
            }

        } else {
            swal.fire(
                "Mensaje de alerta",
                "Solo se aceptan imagenes - USTED SUBIO UN ARCHIVO CON LA EXTENCIO ." + extfile,
                "warning"
            );
            $("#img_producto").attr("src", "../../img/insumo/insumo.png").width(200).height(200);
            return document.getElementById("foto").value = "";
        }

    }
</script>

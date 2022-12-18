<?php require "../layout/header.php" ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-list"> </i>
                </div>
                <div>
                    Listado de insumo - <a style="color: white;" href="../inventario/crear_insumo.php" class="btn btn-primary "><i class="fa fa-plus"></i> Nuevo registro</a>
                    - <a style="color: white;" href="../inventario/list_tipoi.php" class="btn btn-danger "><i class="fa fa-bookmark"></i> Tipo de insumo</a>
                    <div class="page-title-subheading">
                        Lista de insumos disponibles
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
            <table id="table_insumo" class="mb-0 table table-striped" style="width: 100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Marca</th>
                        <th>Tipo</th>
                        <th>Foto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Marca</th>
                        <th>Tipo</th>
                        <th>Foto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>

<?php require "../layout/footer.php" ?>
<script src="../../js/inventario.js"></script>

<div class="modal fade" id="modal_editar_photo_insumo" role="dialog" aria-labelledby="edtar_foto_insumo" aria-hidden="true">
    <div class="modal-dialog xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edtar_foto_insumo">Editar foto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">

                        <input type="number" id="id_foto_insumo" hidden>

                        <div class="col-md-12 mb-3 form-group">
                            <div class="ibox-body text-center">

                                <img class="img-circle" id="foto_insumo_edit" style="border-radius: 50%;" white="300px" height="300px">
                                <h5 class="font-strong m-b-10 m-t-10"><span>Foto de insumo</span></h5>
                                <div>
                                    <input type="file" id="foto_new_i" class="form-control">
                                    <input type="text" id="foto_actu_insumo" hidden>
                                    <button class="btn btn-info btn-rounded mb-3" onclick="editar_foto_insumo();"><i class="fa fa-plus"></i> Cambiar foto</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_editar_insumo" role="dialog" aria-labelledby="modal_eitar_rolLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_eitar_rolLabel">Editar insumo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input type="text" id="id_insumo" hidden>

                <div class="form-row text-center">

                    <div class="col-md-2 mb-3">
                        <label for="codigo_insumoo">Codigo insumo</label> <b><label style="color: red;" id="codigo_insumoo_obligg"></label></b>
                        <input type="text" maxlength="10" class="form-control" id="codigo_insumoo" placeholder="Ingrese el codigo insumo" onkeypress="return soloNumeros(event)" />
                    </div>

                    <div class="col-md-5 mb-3">
                        <label for="nombre_insumo">Nombre insumo</label> <b><label style="color: red;" id="nombre_insumo_obligg"></label></b>
                        <input type="text" maxlength="50" class="form-control" id="nombre_insumo" placeholder="Ingrese el nombre insumo" />
                    </div>

                    <div class="col-md-5 mb-3">
                        <label for="marca_insumo">Marca insumo</label> <b><label style="color: red;" id="marca_insumo_obligg"></label></b>
                        <input type="text" maxlength="50" class="form-control" id="marca_insumo" placeholder="Ingrese lamarca insumo" />
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
                        <input type="text" maxlength="7" class="form-control" id="cantidad_insumo" placeholder="Ingrese la cantidad" onkeypress="return soloNumeros(event)" />
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Descripción</label> <b><label style="color:red;" id="descripc_obliga"></label></b>
                        <textarea class="form-control" rows="3" id="decripcion_mterial"></textarea>
                    </div>

                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Cerrar
                </button>
                <button onclick="editar_insumo()" class="btn btn-primary">Guardar</button>
            </div>

        </div>
    </div>
</div>

<script>
    llistar_tabla_insumo();
    listar_tipo_insumo_COMBO();
    $(".tipo_insumo").select2();

    document.getElementById("foto_new_i").addEventListener("change", () => {
        var filename = document.getElementById("foto_new_i").value;
        var idxdot = filename.lastIndexOf(".") + 1;
        var extfile = filename.substr(idxdot, filename.length).toLowerCase();
        if (extfile == "jpg" || extfile == "jpeg" || extfile == "png") {} else {
            swal.fire(
                "Mensaje de alerta",
                "Solo se aceptan imagenes - USTED SUBIO UN ARCHIVO CON LA EXTENCIO ." + extfile,
                "warning"
            );
            document.getElementById("foto_new_i").value = "";
        }
    });
</script>
<?php require "../layout/header.php" ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-list"> </i>
                </div>
                <div>
                    Listado de herramienta - <a style="color: white;" href="../inventario/crear_herramienta.php" class="btn btn-primary "><i class="fa fa-plus"></i> Nuevo registro</a>
                    - <a style="color: white;"  href="../inventario/list_tipoe.php" class="btn btn-danger "><i class="fa fa-bookmark"></i> Tipo de herramienta</a>
                    <div class="page-title-subheading">
                        Lista de herramientas disponibles
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
            <table id="table_herramienta" class="mb-0 table table-striped" style="width: 100%;">
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

<div class="modal fade" id="modal_editar_photo_herramienta" role="dialog" aria-labelledby="edtar_foto_herramienta" aria-hidden="true">
    <div class="modal-dialog xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edtar_foto_herramienta">Editar foto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">

                        <input type="number" id="id_foto_herramienta" hidden>

                        <div class="col-md-12 mb-3 form-group">
                            <div class="ibox-body text-center">

                                <img class="img-circle" id="foto_herramienta_edit" style="border-radius: 50%;" white="300px" height="300px">
                                <h5 class="font-strong m-b-10 m-t-10"><span>Foto de herramienta</span></h5>
                                <div>
                                    <input type="file" id="foto_new_h" class="form-control">
                                    <input type="text" id="foto_actu_herramienta" hidden>
                                    <button class="btn btn-info btn-rounded mb-3" onclick="editar_foto_herramienta();"><i class="fa fa-plus"></i> Cambiar foto</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_editar_herramienta" role="dialog" aria-labelledby="modal_eitar_rolLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_eitar_rolLabel">Editar herramienta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input type="text" id="id_herramienta" hidden>

                <div class="form-row text-center">

                    <div class="col-md-3 mb-3">
                        <label for="codigo_herramientao">Codigo herramienta</label> <b><label style="color: red;" id="codigo_herramientao_obligg"></label></b>
                        <input type="text" maxlength="10" class="form-control" id="codigo_herramientao" placeholder="Ingrese el codigo herramienta" onkeypress="return soloNumeros(event)" />
                    </div>

                    <div class="col-md-4 mb-3">
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
                        <input type="text" class="form-control" onkeypress="return filterfloat(event, this);" id="precio_compra" placeholder="Ingrese el precio compra" />
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="cantidad_herramienta">Cantidad</label> <b><label style="color: red;" id="cantidad_herramienta_obligg"></label></b>
                        <input type="text" maxlength="7" class="form-control" id="cantidad_herramienta" placeholder="Ingrese la cantidad" onkeypress="return soloNumeros(event)" />
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Descripción</label> <b><label style="color:red;" id="descripc_obliga"></label></b>
                        <textarea class="form-control" rows="3" id="decripcion_herramienta"></textarea>
                    </div>

                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Cerrar
                </button>
                <button onclick="editar_herramienta()" class="btn btn-primary">Guardar</button>
            </div>

        </div>
    </div>
</div>

<script>
    listar_tabla_herramienta();
    listar_tipo_herramienta_COMBO();
    $(".tipo_herramienta").select2();

    document.getElementById("foto_new_h").addEventListener("change", () => {
        var filename = document.getElementById("foto_new_h").value;
        var idxdot = filename.lastIndexOf(".") + 1;
        var extfile = filename.substr(idxdot, filename.length).toLowerCase();
        if (extfile == "jpg" || extfile == "jpeg" || extfile == "png") {} else {
            swal.fire(
                "Mensaje de alerta",
                "Solo se aceptan imagenes - USTED SUBIO UN ARCHIVO CON LA EXTENCIO ." + extfile,
                "warning"
            );
            document.getElementById("foto_new_h").value = "";
        }
    });
</script>
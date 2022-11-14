<?php require "../layout/header.php" ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-list"> </i>
                </div>
                <div>
                    Listado tipo de insumo - <a style="color: white;" href="../inventario/tipo_inventario.php" class="btn btn-primary "><i class="fa fa-plus"></i> Nuevo registro</a>
                    <div class="page-title-subheading">
                        Lista de tipos de insumos disponibles
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



    <table id="tabla_tipo_i" class="mb-0 table table-striped" style="width: 100%;">
        <thead>
            <tr>
                <th>#</th>
                <th>Acción</th>
                <th>Nombres</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
            <tr>
                <th>#</th>
                <th>Acción</th>
                <th>Nombres</th>
                <th>Estado</th>
            </tr>
        </tfoot>
    </table>

</div>

<?php require "../layout/footer.php" ?>
<script src="../../js/inventario.js"></script>
<script>
    listar_tipo_insumo();
</script>

<!-- modal de esitar rol -->
<div class="modal fade" id="modal_eitar_tipoi" role="dialog" aria-labelledby="modal_eitar_tipoiLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_eitar_tipoiLabel">Editar tipo insumo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input type="text" id="id_tipoi" hidden>

                <div class="form-group">
                    <label for="nombre_tipoi_e" class="col-form-label">Nonbre del tipo:</label> <label style="color: red;" id="nombre_tipoi_e_obligg"></label>
                    <input type="text" class="form-control" id="nombre_tipoi_e" />
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Cerrar
                </button>
                <button onclick="editar_tipo_i()" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
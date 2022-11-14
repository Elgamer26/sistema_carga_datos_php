<?php require "../layout/header.php" ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-list"> </i>
                </div>
                <div>
                    Listado de actividades - <a style="color: white;" href="../produccion/create_actividad.php" class="btn btn-primary "><i class="fa fa-plus"></i> Nuevo registro</a>
                    <div class="page-title-subheading">
                        Lista de actividades
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <label class="form-label">actividades </label>
                <div class="d-inline-block dropdown">
                    <a href="../home/index.php"> / Principal <i class="fa fa-home"></i></a>
                </div>
            </div>
        </div>
    </div>

    <table id="tabla_actividad" class="mb-0 table table-striped text-center" style="width: 100%;">
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
<script src="../../js/produccion.js"></script>
<script>
    listar_actividad();
</script>

<!-- modal de esitar rol -->
<div class="modal fade" id="modal_eitar_actividad" role="dialog" aria-labelledby="modal_eitar_rolLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_eitar_rolLabel">Editar actividad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input type="text" id="id_actividad" hidden>

                <div class="form-group">
                    <label for="actividad" class="col-form-label">Nonbre del rol:</label> <label style="color: red;" id="actividad_edit_obligg"></label>
                    <input type="text" class="form-control" id="actividad" />
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Cerrar
                </button>
                <button onclick="editar_actividad()" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
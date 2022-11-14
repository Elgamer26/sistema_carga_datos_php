<?php require "../layout/header.php" ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-list"> </i>
                </div>
                <div>
                    Listado de lotes - <a style="color: white;" href="../produccion/create_lote.php" class="btn btn-primary "><i class="fa fa-plus"></i> Nuevo registro</a>
                    <div class="page-title-subheading">
                        Lista de lotes
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <label class="form-label">Lotes </label>
                <div class="d-inline-block dropdown">
                    <a href="../home/index.php"> / Principal <i class="fa fa-home"></i></a>
                </div>
            </div>
        </div>
    </div>

    <table id="tabla_lote" class="mb-0 table table-striped text-center" style="width: 100%;">
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
    listar_lotes();
</script>

<div class="modal fade" id="modal_hectareas_ver" role="dialog" aria-labelledby="modal_eitar_rolLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hectareas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">

                    <div class="col-sm-12 form-group">
                        <table id="taba_hectareas" class="table table-striped table-bordered table-sm mx-auto" cellspacing="0" width="100%">
                            <thead bgcolor="purple" style="color:#fff;">
                                <tr>
                                    <th>#</th>
                                    <th>Hectarea</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>

                            <tbody id="tbody_taba_hectareasl">

                            </tbody>

                            <tfoot bgcolor="purple" style="color:#fff;">
                                <tr>
                                    <th>#</th>
                                    <th>Hectarea</th>
                                    <th>Estado</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Cerrar
                </button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modal_editar_lote" role="dialog" aria-labelledby="modal_eitar_rolLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lote</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" id="id_lote" hidden>
                <div class="row">
                    <div class="col-md-12 mx-auto">
                        <label for="lote">Nombre lote</label> <b><label style="color: red;" id="lote_obligg"></label></b>
                        <input type="text" class="form-control" id="lote" placeholder="Ingrese nombre de lote" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Cerrar
                </button>
                <button onclick="editar_lotes();" class="btn btn-primary" type="submit">
                    <i class="fa fa-save"></i> Registrar
                </button>
            </div>
        </div>
    </div>
</div>
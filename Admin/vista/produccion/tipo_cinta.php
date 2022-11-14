<?php require "../layout/header.php" ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-list"> </i>
                </div>
                <div>
                    Listado de tipos de cintas
                    <div class="page-title-subheading">
                        Lista tipos cintas
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <label class="form-label">Cintas </label>
                <div class="d-inline-block dropdown">
                    <a href="../home/index.php"> / Principal <i class="fa fa-home"></i></a>
                </div>
            </div>
        </div>
    </div>

    <table id="tabla_cintas" class="mb-0 table table-striped text-center" style="width: 100%;">
        <thead>
            <tr>
                <th>#</th>
                <th>Opcion</th>
                <th>Semana</th>
                <th>Color</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>#</th>
                <th>Opcion</th>
                <th>Semana</th>
                <th>Color</th>
            </tr>
        </tfoot>
    </table>
</div>

<?php require "../layout/footer.php" ?>
<script src="../../js/produccion.js"></script>
<script>
    listar_tipo_cintas();
</script>

<!-- modal de esitar rol -->
<div class="modal fade" id="modal_eitar_tipo_cinta" role="dialog" aria-labelledby="modal_eitar_rolLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_eitar_rolLabel">Editar color cinta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input type="text" id="id_tipo_cinta" hidden>

                <div class="col-lg-12">
                    <label for="color_cinta">Color cinta</label>
                    <input type='color' class='form-control' id="color_cinta"><br>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Cerrar
                </button>
                <button onclick="editar_color()" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
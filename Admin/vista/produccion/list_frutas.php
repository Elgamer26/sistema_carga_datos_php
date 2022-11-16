<?php require "../layout/header.php" ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-list"> </i>
                </div>
                <div>
                    Listado de frutas - <a style="color: white;" href="../produccion/frutas.php" class="btn btn-success "><i class="fa fa-plus"></i> Registro de fruta</a>
                    <div class="page-title-subheading">
                        Lista de frutas
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <label class="form-label">Frutas </label>
                <div class="d-inline-block dropdown">
                    <a href="../home/index.php"> / Principal <i class="fa fa-home"></i></a>
                </div>
            </div>
        </div>
    </div>

    <ul class="nav nav-pills">

        <li class="nav-item">
            <a class="nav-link active" href="#pill-1-7" data-toggle="tab">Racimos</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#pill-1-6" data-toggle="tab">Desechos</a>
        </li>

    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="pill-1-7">

            <table id="tabla_racimos_list" class="mb-0 table table-striped text-center" style="width: 100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Acción</th>
                        <th>Producción</th>
                        <th>Fecha</th>
                        <th>Cantidad</th>
                        <th>Tipo</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Acción</th>
                        <th>Producción</th>
                        <th>Fecha</th>
                        <th>Cantidad</th>
                        <th>Tipo</th>
                    </tr>
                </tfoot>
            </table>

        </div>

        <div class="tab-pane" id="pill-1-6">

            <table id="tabla_desechos_list" class="mb-0 table table-striped text-center" style="width: 100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Acción</th>
                        <th>Producción</th>
                        <th>Fecha</th>
                        <th>Cantidad</th>
                        <th>Tipo</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Acción</th>
                        <th>Producción</th>
                        <th>Fecha</th>
                        <th>Cantidad</th>
                        <th>Tipo</th>
                    </tr>
                </tfoot>
            </table>

        </div>
    </div>
</div>

<?php require "../layout/footer.php" ?>
<script src="../../js/produccion.js"></script>
<script>
    listar_racimos_produccion();
    listar_desecho_produccion();
</script>
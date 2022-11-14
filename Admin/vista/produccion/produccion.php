<?php require "../layout/header.php" ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-list"> </i>
                </div>
                <div>
                    Listado de producción - <a style="color: white;" href="../produccion/create_produccion.php" class="btn btn-primary "><i class="fa fa-plus"></i> Nuevo registro</a>
                    <div class="page-title-subheading">
                        Lista de producción
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <label class="form-label">Producción </label>
                <div class="d-inline-block dropdown">
                    <a href="../home/index.php"> / Principal <i class="fa fa-home"></i></a>
                </div>
            </div>
        </div>
    </div>

    <table id="tabla_produccion" class="mb-0 table table-striped text-center" style="width: 100%;">
        <thead>
            <tr>
                <th>#</th>
                <th>Acción</th>
                <th>Nombres producción</th>
                <th>Fecha inicio</th>
                <th>Fecha fin</th>
                <th>Lote</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
            <tr>
                <th>#</th>
                <th>Acción</th>
                <th>Nombres producción</th>
                <th>Fecha inicio</th>
                <th>Fecha fin</th>
                <th>Lote</th>
                <th>Estado</th>
            </tr>
        </tfoot>
    </table>

</div>

<?php require "../layout/footer.php" ?>
<script src="../../js/produccion.js"></script>
<script>
    listar_produccion();
</script>

<div class="modal fade" id="modal_detalle_produccion" role="dialog" aria-labelledby="modal_eitar_rolLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalle de la producción</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">

                    <div class="col-sm-12 form-group text-center">
                        <div class="ibox">
                            <div class="ibox-body">
                                <ul class="nav nav-pills">

                                    <li class="nav-item">
                                        <a class="nav-link active" href="#pill-1-7" data-toggle="tab">Hectares</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#pill-1-1" data-toggle="tab">Actividades</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#pill-1-2" data-toggle="tab">Herramientas</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#pill-1-3" data-toggle="tab">Insumos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#pill-1-6" data-toggle="tab">Cintas</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#pill-1-4" data-toggle="tab">Racimos/Desechos</a>
                                    </li>                                  

                                </ul>
                                <div class="tab-content">

                                    <div class="tab-pane" id="pill-1-1">
                                        <div class="row">
                                            <table id="tabla_detalle_atividad" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                                <thead bgcolor="purple" style="color:#fff;">
                                                    <tr>
                                                        <th style="width: 50px;">#</th>
                                                        <th>Empleado</th>
                                                        <th>Actividad</th> 
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody_detalle_atividad">
                                                </tbody>
                                                <tfoot bgcolor="purple" style="color:#fff;">
                                                    <tr>
                                                        <th style="width: 50px;">#</th>
                                                        <th>Empleado</th>
                                                        <th>Actividad</th> 
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="pill-1-2">
                                        <div class="row">
                                            <table id="tabla_detalle_material" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                                <thead bgcolor="purple" style="color:#fff;">
                                                    <tr>
                                                        <th style="width: 50px;">#</th>
                                                        <th>Herramienta</th> 
                                                        <th>Cantidad</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody_detalle_material">
                                                </tbody>
                                                <tfoot bgcolor="purple" style="color:#fff;">
                                                    <tr>
                                                        <th style="width: 50px;">#</th>
                                                        <th>Herramienta</th> 
                                                        <th>Cantidad</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="pill-1-3">

                                        <div class="row">
                                            <table id="tabla_detalle_insumo" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                                <thead bgcolor="purple" style="color:#fff;">
                                                    <tr>
                                                        <th style="width: 50px;">#</th>
                                                        <th>Insumo</th> 
                                                        <th>Cantidad</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody_detalle_insumo">
                                                </tbody>
                                                <tfoot bgcolor="purple" style="color:#fff;">
                                                    <tr>
                                                        <th style="width: 50px;">#</th>
                                                        <th>Insumo</th> 
                                                        <th>Cantidad</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="pill-1-4">
                                        <div class="row">

                                            <div class="col-sm-6 form-group">
                                                <label><b>Racimos</b></label>
                                                <table id="tabla_racimos" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                                    <thead bgcolor="purple" style="color:#fff;">
                                                        <tr>
                                                            <th style="width: 20px;">#</th>
                                                            <th>Fecha</th>
                                                            <th>Cantidad</th>
                                                            <th>Tipo</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody_detalle_racimos">
                                                    </tbody>
                                                    <tfoot bgcolor="purple" style="color:#fff;">
                                                        <tr>
                                                            <th style="width: 20px;">#</th>
                                                            <th>Fecha</th>
                                                            <th>Cantidad</th>
                                                            <th>Tipo</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>

                                            </div>

                                            <div class="col-sm-6 form-group">
                                                <label><b>Desechos</b></label>
                                                <table id="tabla_desechos" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                                    <thead bgcolor="purple" style="color:#fff;">
                                                        <tr>
                                                            <th style="width: 20px;">#</th>
                                                            <th>Fecha</th>
                                                            <th>Cantidad</th>
                                                            <th>Tipo</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody_detalle_desechos">
                                                    </tbody>
                                                    <tfoot bgcolor="purple" style="color:#fff;">
                                                        <tr>
                                                            <th style="width: 20px;">#</th>
                                                            <th>Fecha</th>
                                                            <th>Cantidad</th>
                                                            <th>Tipo</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="tab-pane" id="pill-1-6">

                                        <div class="row">
                                            <table id="tabala_semanas" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                                <thead bgcolor="purple" style="color:#fff;">
                                                    <tr>
                                                        <th style="width: 35px;">#</th>
                                                        <th>Semana</th>
                                                        <th>Color</th>
                                                        <th>Fecha registro</th>
                                                        <th>Detalle</th>

                                                    </tr>
                                                </thead>

                                                <tbody id="tbody_tabala_semanas">

                                                </tbody>

                                                <tfoot bgcolor="purple" style="color:#fff;">
                                                    <tr>
                                                        <th style="width: 35px;">#</th>
                                                        <th>Semana</th>
                                                        <th>Color</th>
                                                        <th>Fecha registro</th>
                                                        <th>Detalle</th>

                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade show active" id="pill-1-7">

                                        <div class="row">

                                            <table id="tabla_hectareas" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                                <thead bgcolor="purple" style="color:#fff;">
                                                    <tr>
                                                        <th style="width: 100px;">#</th>
                                                        <th>Hectarea</th>
                                                    </tr>
                                                </thead>

                                                <tbody id="tbody_detalle_hectarea">

                                                </tbody>

                                                <tfoot bgcolor="purple" style="color:#fff;">
                                                    <tr>
                                                        <th style="width: 100px;">#</th>
                                                        <th>Hectarea</th>
                                                    </tr>
                                                </tfoot>
                                            </table>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

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
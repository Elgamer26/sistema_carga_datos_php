<?php require "../layout/header.php" ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-list"> </i>
                </div>
                <div>
                    Listado de compras insumo - <a style="color: white;" href="../inventario/crear_comprai.php" class="btn btn-primary "><i class="fa fa-plus"></i> Nuevo registro</a>
                    <div class="page-title-subheading">
                        Lista de compras insumos disponibles
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
            <table id="tabla_compras_insumos" class="mb-0 table table-striped" style="width: 100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Acción</th>
                        <th>N° compra</th>
                        <th>Fecha</th>
                        <th>Proveedor</th>
                        <th>Comprobante</th>
                        <th>Iva</th>
                        <th>Sub total</th> 
                        <th>Total pago</th>
                        <th>Estado</th>                  
                    </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <tr>
                    <th>#</th>
                        <th>Acción</th>
                        <th>N° compra</th>
                        <th>Fecha</th>
                        <th>Proveedor</th>
                        <th>Comprobante</th>
                        <th>Iva</th>
                        <th>Sub total</th> 
                        <th>Total pago</th>
                        <th>Estado</th>  
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>

<?php require "../layout/footer.php" ?>
<script src="../../js/inventario.js"></script>

<div class="modal fade" id="modal_editar_compras insumo" role="dialog" aria-labelledby="modal_eitar_rolLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_eitar_rolLabel">Editar compras insumo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input type="text" id="id_compras insumo" hidden>

                <div class="form-row text-center">

                    <div class="col-md-3 mb-3">
                        <label for="codigo_compras insumoo">Codigo compras insumo</label> <b><label style="color: red;" id="codigo_compras insumoo_obligg"></label></b>
                        <input type="text" maxlength="10" class="form-control" id="codigo_compras insumoo" placeholder="Ingrese el codigo compras insumo" onkeypress="return soloNumeros(event)" />
                    </div>

                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Cerrar
                </button>
                <button class="btn btn-primary">Guardar</button>
            </div>

        </div>
    </div>
</div>

<script>
    listar_compras_insumos();
</script>
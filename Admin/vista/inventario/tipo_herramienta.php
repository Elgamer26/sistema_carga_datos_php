<?php require "../layout/header.php" ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-bookmark"> </i>
                </div>
                <div>
                    Nuevo tipo de herramienta
                    <div class="page-title-subheading">
                        Crear un tipo de herramienta con sus permisos.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <label class="form-label">Tipo de herramienta</label>
                <div class="d-inline-block dropdown">
                    <a href="../inventario/list_tipoe.php"> / Listado </a>
                </div> <a href="../home/index.php"> / Principal <i class="fa fa-home"></i></a>
            </div>
        </div>
    </div>

    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-title">Nuevo tipo de herramienta.</h5>

            <div class="form-row text-center">
                <div class="col-md-6 mx-auto">
                    <label for="nombre_tipo_e">Nombre tipo de herramienta</label> <b><label style="color: red;" id="nombre_tipo_e_obligg"></label></b>
                    <input type="text" class="form-control" id="nombre_tipo_e" placeholder="Ingrese el nombre del tipo de herramienta" />
                </div>

                <div class="col-md-12 mx-auto p-3">
                    <button onclick="registra_tipo_herramienta();" class="btn btn-primary" type="submit">
                        <i class="fa fa-save"></i> Registrar
                    </button> -
                    <a href="../inventario/list_tipoe.php" class="btn btn-danger">Volver</a>
                </div>
            </div>

        </div>
    </div>
</div>

<?php require "../layout/footer.php" ?>
<script src="../../js/inventario.js"></script>
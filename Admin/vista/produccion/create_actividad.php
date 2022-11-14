<?php require "../layout/header.php" ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-bookmark"> </i>
                </div>
                <div>
                    Nueva actividad
                    <div class="page-title-subheading">
                        Crear una actividad.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <label class="form-label">Nueva actividad</label>
                <div class="d-inline-block dropdown">
                    <a href="../produccion/actividades.php"> / Listado actividad </a>
                </div> <a href="../home/index.php"> / Principal <i class="fa fa-home"></i></a>
            </div>
        </div>
    </div>

    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-title">Nueva actividad.</h5>

            <div class="form-row text-center">
                <div class="col-md-6 mx-auto">
                    <label for="nombre_actividad">Nombre actividad</label> <b><label style="color: red;" id="nombre_actividad_obligg"></label></b>
                    <input type="text" class="form-control" id="nombre_actividad" placeholder="Ingrese la actividad" />
                </div>

                <div class="col-md-12 mx-auto p-3">
                    <button onclick="registra_actividad();" class="btn btn-primary" type="submit">
                        <i class="fa fa-save"></i> Registrar
                    </button> -
                    <a href="../produccion/actividades.php" class="btn btn-danger">Volver</a>
                </div>
            </div>

        </div>
    </div>
</div>

<?php require "../layout/footer.php" ?>
<script src="../../js/produccion.js"></script>
<?php require "../layout/header.php" ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-cubes"> </i>
                </div>
                <div>
                    Proceso de enfunde
                    <div class="page-title-subheading">
                        Crear un Proceso de enfunde.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <label class="form-label">Proceso de enfunde</label>
                <div class="d-inline-block dropdown">
                </div> <a href="../home/index.php"> / Principal <i class="fa fa-home"></i></a> </a>
            </div>
        </div>
    </div>

    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-title">Proceso de enfunde.</h5>

            <div class="form-row text-center">

                <div class="col-md-6 mb-3 mx-auto">
                    <label>Subir archivo Excel</label>
                    <img id="img_producto" height="150" width="150" class="border rounded mx-auto d-block img-fluid" src="../../img/carga/excel.png" />
                    <input type="file" class="form-control" id="foto" onchange="mostrar_imagen(this)" />
                </div>

                <div class="col-md-6 mb-3 mx-auto">
                    <label for="nombre_ar">Nombre del archivo</label> <b><label style="color: red;" id="nombre_oblliig"></label></b>
                    <input type="text" class="form-control" id="nombre_ar" placeholder="Ingrese nombre del archivo" />
                </div>

                <div class="col-md-12">
                    <button onclick="subir_excel_enfunde();" class="btn btn-primary">
                        <i class="fa fa-save"></i> Subir archivo
                    </button>
                    -
                    <a href="../manejo_datos/proceso_enfunde.php" class="btn btn-danger">Recargar</a>
                </div>

                <div class="col-md-12 p-3">
                    <hr>
                    <label class="badge badge-success" style="font-size: 15px;"> Archivos cargados</label>
                </div>



            </div>

            <div class="form-row text-center" id="unir_exel_enfunde">

            </div>

        </div>
    </div>
</div>

<?php require "../layout/footer.php" ?>
<script src="../../js/prediccion.js"></script>

<script>
    cargar_excel_enfunde_();

    function mostrar_imagen(input) {
        var filename = document.getElementById("foto").value;
        var idxdot = filename.lastIndexOf(".") + 1;
        var extfile = filename.substr(idxdot, filename.length).toLowerCase();
        if (extfile == "xlsx") {

            $("#img_producto").attr("src", "../../img/carga/excel.png").width(150).height(150);

        } else {
            swal.fire(
                "Mensaje de alerta",
                "Solo se aceptan archivos excel - USTED SUBIO UN ARCHIVO CON LA EXTENCIO ." + extfile,
                "warning"
            );
            $("#img_producto").attr("src", "../../img/carga/excel.png").width(150).height(150);
            return document.getElementById("foto").value = "";
        }

    }
</script>
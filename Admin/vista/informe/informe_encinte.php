<?php require "../layout/header.php" ?>

<style>
    .contennidor {
        background: gray;
        min-height: 90vh;
    }
</style>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-file"> </i>
                </div>
                <div>
                    Informe de encinte
                    <div class="page-title-subheading">
                        Informe de encinte
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <label class="form-label">Informe de encinte </label>
                <div class="d-inline-block dropdown">
                    <a href="../home/index.php"> / Principal <i class="fa fa-home"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="form-row text-center">

        <div class="col-lg-4">
            <label> Fecha inicio</label>
            <input type="date" class="form-control" id="f_i" />
        </div>

        <div class="col-lg-4">
            <label> Fecha fin</label>
            <input type="date" class="form-control" id="f_f" />
        </div>

        <div class="col-lg-1">
            <labe> Buscar...</label>
                <button onclick="var_encinte();" class="btn btn-danger"><i class="fa fa-search"></i></button>
                <br>
                <br>
        </div>

        <br>

        <div class="col-lg-12">
            <center>
                <iframe width="100%" height="100%" class="contennidor" id="iframe_encinte"></iframe>
            </center>
        </div>

    </div>

    <?php require "../layout/footer.php" ?>
    <script>
        $(document).ready(function() {

            var n = new Date();
            var y = n.getFullYear();
            var m = n.getMonth() + 1;
            var d = n.getDate();
            if (d < 10) {
                d = '0' + d;
            }
            if (m < 10) {
                m = '0' + m;
            }

            document.getElementById("f_i").value = y + "-" + m + "-" + d;
            document.getElementById("f_f").value = y + "-" + m + "-" + d;

        });

        function var_encinte() {

            var fecha_inicio = $("#f_i").val();
            var fecha_fin = $("#f_f").val();

            if (fecha_inicio > fecha_fin) {
                return Swal.fire(
                    "Mensaje de advertencia",
                    "La fecha inicio '" +
                    fecha_inicio +
                    "' es mayor a la fecha final '" +
                    fecha_fin +
                    "'",
                    "warning"
                );
            }

            var ifrm = document.getElementById("iframe_encinte");
            ifrm.setAttribute("src", "../../reportes/Pdf/Reportes/reporte_encinte.php?f_i='" + fecha_inicio + "'&f_f='" + fecha_fin + "'");
        }
    </script>
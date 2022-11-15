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
                    Informe cajas de banano
                    <div class="page-title-subheading">
                        Informe cajas de banano
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <label class="form-label">Informe cajas de banano </label>
                <div class="d-inline-block dropdown">
                    <a href="../home/index.php"> / Principal <i class="fa fa-home"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="form-row text-center">

        <div class="col-md-12 form-group">

            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" href="#pill-1-4" data-toggle="tab">Cajas racimos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#pill-1-1" data-toggle="tab">Desechos</a>
                </li>
            </ul>

            <div class="tab-content">

                <div class="tab-pane fade show active" id="pill-1-4">

                    <div class="row">

                        <div class="col-lg-4">
                            <label> Fecha inicio</label>
                            <input type="date" class="form-control" id="f_i" />
                        </div>

                        <div class="col-lg-4">
                            <label> Fecha fin</label>
                            <input type="date" class="form-control" id="f_f" />
                        </div>

                        <div class="col-lg-1">
                            <labe> Buscar racimos</label>
                                <button onclick="var_racimos();" class="btn btn-danger"><i class="fa fa-search"></i></button>
                                <br>
                                <br>
                        </div>

                        <br>

                        <div class="col-lg-12">
                            <center>
                                <iframe width="100%" height="100%" class="contennidor" id="iframe_racimos"></iframe>
                            </center>
                        </div>

                    </div>

                </div>

                <div class="tab-pane" id="pill-1-1">

                    <div class="row">

                        <div class="col-lg-4">
                            <label> Fecha inicio</label>
                            <input type="date" class="form-control" id="f_id" />
                        </div>

                        <div class="col-lg-4">
                            <label> Fecha fin</label>
                            <input type="date" class="form-control" id="f_fd" />
                        </div>

                        <div class="col-lg-1">
                            <labe> Buscar desechos</label>
                                <button onclick="var_desechos();" class="btn btn-danger"><i class="fa fa-search"></i></button>
                                <br>
                                <br>
                        </div>

                        <br>

                        <div class="col-lg-12">
                            <center>
                                <iframe width="100%" height="100%" class="contennidor" id="iframe_desechos"></iframe>
                            </center>
                        </div>

                    </div>

                </div>

            </div>

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

            document.getElementById("f_id").value = y + "-" + m + "-" + d;
            document.getElementById("f_fd").value = y + "-" + m + "-" + d;

        });

        function var_racimos() {

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

            var ifrm = document.getElementById("iframe_racimos");
            ifrm.setAttribute("src", "../../reportes/Pdf/Reportes/reporte_racimos.php?f_i='" + fecha_inicio + "'&f_f='" + fecha_fin + "'");
        }

        function var_desechos() {

            var fecha_inicio = $("#f_id").val();
            var fecha_fin = $("#f_fd").val();

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

            var ifrm = document.getElementById("iframe_desechos");
            ifrm.setAttribute("src", "../../reportes/Pdf/Reportes/reporte_desechos.php?f_i='" + fecha_inicio + "'&f_f='" + fecha_fin + "'");
        }
    </script>
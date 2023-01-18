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
                    Informe prediccón
                    <div class="page-title-subheading">
                        Informe prediccón
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <label class="form-label">Prediccón</label>
                <div class="d-inline-block dropdown">
                    <a href="../home/index.php"> / Principal <i class="fa fa-home"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="form-row text-center">

        <div class="col-lg-2" style="width: 100%;">
            <label> Años</label>
            <select class="form-control años_predecir" style="width: 100%;" id="años_predecir">
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                <option value="todo">Todo</option>
            </select>
        </div>

        <div class="col-lg-2" style="width: 100%;">
            <label> Tipo gráfica</label>
            <select class="form-control tipo_grafica" style="width: 100%;" id="tipo_grafica">
                <option value="barra">Barra</option>
                <option value="linea">Línea</option>
            </select>
        </div>

        <br><br><br><br>

        <div class="col-md-12 form-group">

            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" href="#pill-1-4" data-toggle="tab">Cajas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#pill-1-1" data-toggle="tab">Enfunde</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#pill-1-2" data-toggle="tab">Recobro de cintas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#pill-1-3" data-toggle="tab">Producción</a>
                </li>

            </ul>

            <div class="tab-content">

                <div class="tab-pane fade show active" id="pill-1-4">

                    <div class="row">

                        <div class="col-lg-12">
                            <center>
                                <iframe width="100%" height="100%" class="contennidor" id="iframe_cajas"></iframe>
                            </center>
                        </div>

                    </div>

                </div>

                <div class="tab-pane fade" id="pill-1-1">

                    <div class="row">

                        <div class="col-lg-12">
                            <center>
                                <iframe width="100%" height="100%" class="contennidor" id="iframe_enfunde"></iframe>
                            </center>
                        </div>

                    </div>

                </div>

                <div class="tab-pane fade" id="pill-1-2">

                    <div class="row">

                        <div class="col-lg-12">
                            <center>
                                <iframe width="100%" height="100%" class="contennidor" id="iframe_cintas"></iframe>
                            </center>
                        </div>

                    </div>

                </div>

                <div class="tab-pane fade" id="pill-1-3">

                    <div class="row">

                        <div class="col-lg-12">
                            <center>
                                <iframe width="100%" height="100%" class="contennidor" id="iframe_produccion"></iframe>
                            </center>
                        </div>

                    </div>

                </div>

            </div>

        </div>


    </div>

    <?php require "../layout/footer.php" ?>

    <script>
        $(".años_predecir").select2();
        $(".tipo_grafica").select2();

        $(document).on("change", "#años_predecir", function() {
            var dato = $(this).val();
            var grafico = $("#tipo_grafica").val();

            var ifrm = document.getElementById("iframe_cajas");
            ifrm.setAttribute("src", "../../reportes/Pdf/Reportes/reporte_predecir_cajas.php?valor=" + dato + "&tipo=" + grafico + "");

            var ifri = document.getElementById("iframe_enfunde");
            ifri.setAttribute("src", "../../reportes/Pdf/Reportes/reporte_predecir_enfunde.php?valor=" + dato + "&tipo=" + grafico + "");

            var ifri = document.getElementById("iframe_cintas");
            ifri.setAttribute("src", "../../reportes/Pdf/Reportes/reporte_predecir_cintas.php?valor=" + dato + "&tipo=" + grafico + "");

            var ifri = document.getElementById("iframe_produccion");
            ifri.setAttribute("src", "../../reportes/Pdf/Reportes/reporte_predecir_preduccion.php?valor=" + dato + "&tipo=" + grafico + "");

        });

        $(document).on("change", "#tipo_grafica", function() {
            var grafico = $(this).val();
            var dato = $("#años_predecir").val();

            var ifrm = document.getElementById("iframe_cajas");
            ifrm.setAttribute("src", "../../reportes/Pdf/Reportes/reporte_predecir_cajas.php?valor=" + dato + "&tipo=" + grafico + "");

            var ifri = document.getElementById("iframe_enfunde");
            ifri.setAttribute("src", "../../reportes/Pdf/Reportes/reporte_predecir_enfunde.php?valor=" + dato + "&tipo=" + grafico + "");

            var ifri = document.getElementById("iframe_cintas");
            ifri.setAttribute("src", "../../reportes/Pdf/Reportes/reporte_predecir_cintas.php?valor=" + dato + "&tipo=" + grafico + "");

            var ifri = document.getElementById("iframe_produccion");
            ifri.setAttribute("src", "../../reportes/Pdf/Reportes/reporte_predecir_preduccion.php?valor=" + dato + "&tipo=" + grafico + "");

        });
    </script>
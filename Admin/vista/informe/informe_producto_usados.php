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
                    Informe productos usados en actividad
                    <div class="page-title-subheading">
                        Informe productos usados en actividad
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <label class="form-label">Productos usados en actividad </label>
                <div class="d-inline-block dropdown">
                    <a href="../home/index.php"> / Principal <i class="fa fa-home"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="form-row text-center">

        <div class="col-lg-8" style="width: 100%;">
            <label> Tipo de actividad</label> <b><label style="color: red;" id="select_tipo_actividades_obligg"></label></b>
            <select class="form-control tipo_actividades" style="width: 100%;" id="tipo_actividades"></select>
        </div>

        <br><br><br><br>

        <div class="col-md-12 form-group">

            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" href="#pill-1-4" data-toggle="tab">Herramientas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#pill-1-1" data-toggle="tab">Insumos</a>
                </li>
            </ul>

            <div class="tab-content">

                <div class="tab-pane fade show active" id="pill-1-4">

                    <div class="row">

                        <div class="col-lg-12">
                            <center>
                                <iframe width="100%" height="100%" class="contennidor" id="iframe_herramientas"></iframe>
                            </center>
                        </div>

                    </div>

                </div>

                <div class="tab-pane" id="pill-1-1">

                    <div class="row">

                        <div class="col-lg-12">
                            <center>
                                <iframe width="100%" height="100%" class="contennidor" id="iframe_insumos"></iframe>
                            </center>
                        </div>

                    </div>

                </div>

            </div>

        </div>


    </div>

    <?php require "../layout/footer.php" ?>

    <script>
        $(".tipo_actividades").select2();
        listar_tipo_actividades_COMBO();

        function listar_tipo_actividades_COMBO() {
            funcion = "listar_actividad_combo";
            $.ajax({
                url: "../../controlador/produccion/produccion.php",
                type: "POST",
                data: {
                    funcion: funcion,
                },
            }).done(function(response) {
                var data = JSON.parse(response);
                var cadena = "<option value='0'> --- Ingrese tipo de actividade --- </option>";
                if (data.length > 0) {
                    //bucle para extraer los datos del rol
                    for (var i = 0; i < data.length; i++) {
                        cadena +=
                            "<option value='" + data[i][0] + "'> " + data[i][1] + " </option>";
                    }
                    //aqui concadenamos al id del select
                    $("#tipo_actividades").html(cadena);
                } else {
                    cadena += "<option value=''>No hay datos</option>";
                    $("#tipo_actividades").html(cadena);
                }
            });
        }

        $(document).on("change", "#tipo_actividades", function() {
            var id = $(this).val();

            if (id == '0') {
                $("#select_tipo_actividades_obligg").html(" - Seleccione un tipo de actividad");
                return Swal.fire(
                    "Mensaje de advertencia",
                    "Seleccione un tipo de actividad",
                    "warning"
                );
            }

            $("#select_tipo_actividades_obligg").html("");

            var ifrm = document.getElementById("iframe_herramientas");
            ifrm.setAttribute("src", "../../reportes/Pdf/Reportes/reporte_herramientas_actividad.php?id=" + id + "");

            var ifri = document.getElementById("iframe_insumos");
            ifri.setAttribute("src", "../../reportes/Pdf/Reportes/reporte_insumos_actividad.php?id=" + id + "");

        });
    </script>
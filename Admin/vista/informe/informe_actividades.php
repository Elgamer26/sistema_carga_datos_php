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
                    Informe de actividades
                    <div class="page-title-subheading">
                        Informe de actividades
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <label class="form-label">Informe de actividades </label>
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

        <div class="col-lg-1">
            <labe> Ver todo ...</label>
                <button onclick="ver_todo_actividad();" class="btn btn-danger"><i class="fa fa-search"></i></button>
                <br>
                <br>
        </div>

        <br>
        <br>
        <br>
        <br>

        <div class="col-lg-12">
            <center>
                <iframe width="100%" height="100%" class="contennidor" id="iframe_actividad"></iframe>
            </center>
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

            var ifrm = document.getElementById("iframe_actividad");
            ifrm.setAttribute("src", "../../reportes/Pdf/Reportes/reporte_actividad_tipo.php?id=" + id + "");

        });

        function ver_todo_actividad() {
            var ifrm = document.getElementById("iframe_actividad");
            ifrm.setAttribute("src", "../../reportes/Pdf/Reportes/reporte_actividad.php");
        }
    </script>
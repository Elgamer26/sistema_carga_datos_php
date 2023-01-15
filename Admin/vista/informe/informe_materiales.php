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
                    Informe de herramientas
                    <div class="page-title-subheading">
                        Informe de herramientas
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <label class="form-label">Informe de herramientas </label>
                <div class="d-inline-block dropdown">
                    <a href="../home/index.php"> / Principal <i class="fa fa-home"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="form-row text-center">

        <div class="col-lg-8" style="width: 100%;">
            <label> Tipo de herramienta</label> <b><label style="color: red;" id="select_tipo_herramienta_obligg"></label></b>
            <select class="form-control tipo_herramienta" style="width: 100%;" id="tipo_herramienta"></select>
        </div>

        <div class="col-lg-1" style="width: 100%;">
            <labe> Ver todo ...</label>
                <button onclick="ver_todo_herramienta();" class="btn btn-danger"><i class="fa fa-search"></i></button>
                <br>
                <br>
        </div>

        <br>
        <br>
        <br>
        <br>

        <div class="col-lg-12">
            <center>
                <iframe width="100%" height="100%" class="contennidor" id="iframe_herramienta"></iframe>
            </center>
        </div>

    </div>

    <?php require "../layout/footer.php" ?>
    <script>
        $(".tipo_herramienta").select2();
        listar_tipo_herramienta_COMBO();

        function listar_tipo_herramienta_COMBO() {
            funcion = "listar_tipo_herramienta_COMBO";
            $.ajax({
                url: "../../controlador/inventario/inventario.php",
                type: "POST",
                data: {
                    funcion: funcion,
                },
            }).done(function(response) {
                var data = JSON.parse(response);
                var cadena = "<option value='0'> --- Ingrese tipo de herramienta --- </option>";
                if (data.length > 0) {
                    //bucle para extraer los datos del rol
                    for (var i = 0; i < data.length; i++) {
                        cadena +=
                            "<option value='" + data[i][0] + "'> " + data[i][1] + " </option>";
                    }
                    //aqui concadenamos al id del select
                    $("#tipo_herramienta").html(cadena);
                } else {
                    cadena += "<option value=''>No hay datos</option>";
                    $("#tipo_herramienta").html(cadena);
                }
            });
        }

        $(document).on("change", "#tipo_herramienta", function() {
            var id = $(this).val();

            if (id == '0') {
                $("#select_tipo_herramienta_obligg").html(" - Seleccione un tipo de herramienta");
                return Swal.fire(
                    "Mensaje de advertencia",
                    "Seleccione un tipo de herramienta",
                    "warning"
                );
            }

            $("#select_tipo_herramienta_obligg").html("");

            var ifrm = document.getElementById("iframe_herramienta");
            ifrm.setAttribute("src", "../../reportes/Pdf/Reportes/reporte_herramienta_tipo.php?id=" + id + "");

        });

        function ver_todo_herramienta() {
            var ifrm = document.getElementById("iframe_herramienta");
            ifrm.setAttribute("src", "../../reportes/Pdf/Reportes/reporte_herramienta.php");
        }
    </script>
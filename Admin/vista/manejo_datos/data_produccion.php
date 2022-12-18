<?php require "../layout/header.php" ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-database"> </i>
                </div>
                <div>
                    Data de Excel producción
                    <div class="page-title-subheading">
                        Lista data de Excel producción
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <label class="form-label">Data producción </label>
                <div class="d-inline-block dropdown">
                    <a href="../home/index.php"> / Principal <i class="fa fa-home"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="form-row text-center">

        <div class="col-lg-8" style="width: 100%;">
            <label> Excel cargado al sistema</label> <b><label style="color: red;" id="selec_fila_excel_obligg"></label></b>
            <select class="form-control excel_produccion" style="width: 100%;" id="excel_produccion"></select>
        </div>

        <div class="col-lg-1" style="width: 100%;">
            <labe> Ver data</label>
                <button onclick="ver_data_excel_produccion();" class="btn btn-danger"><i class="fa fa-search"></i></button>
                <br>
                <br>
        </div>

        <br>

        <div class="col-lg-12" style="width: 100%;">
            <table id="tabla_data_produccion" class="mb-0 table table-striped" style="width: 100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Semana</th>
                        <th>Fecha</th>
                        <th>Racimos cosechados</th>
                        <th>Racimos rechazados</th>
                        <th>Racimos procesados</th>
                        <th>Cajas procesadas</th> 
                    </tr>
                </thead>

                <tbody id="tbody_table_produccion_excel">
                </tbody>

                <tfoot>
                    <tr>
                    <th>#</th>
                        <th>Semana</th>
                        <th>Fecha</th>
                        <th>Racimos cosechados</th>
                        <th>Racimos rechazados</th>
                        <th>Racimos procesados</th>
                        <th>Cajas procesadas</th> 
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>

<?php require "../layout/footer.php" ?>
<script src="../../js/prediccion.js"></script>

<script>
    var tabla_data_produccion;
    $(".excel_produccion").select2();
    listar_archivos_produccion_excel();

    function listar_archivos_produccion_excel() {
        funcion = "cargar_excel_produccion_";
        $.ajax({
            url: "../../controlador/prediccion/prediccion.php",
            type: "POST",
            data: {
                funcion: funcion,
            },
        }).done(function(response) {
            var data = JSON.parse(response);
            var cadena = "<option value='0'> --- Seleccione un archivo --- </option>";
            if (data.length > 0) {
                //bucle para extraer los datos del rol
                for (var i = 0; i < data.length; i++) {

                    nombre = data[i][1].split('/', 3);
                    fin = nombre[2].split('.');

                    cadena +=
                        "<option value='" +
                        data[i][0] +
                        "'> " +
                        fin[0] +
                        " - Fecha carga: " +
                        data[i][2] +
                        " </option>";
                }
                //aqui concadenamos al id del select
                $("#excel_produccion").html(cadena);
            } else {
                cadena += "<option value='0'>No hay data</option>";
                $("#excel_produccion").html(cadena);
            }
        });
    }

    function ver_data_excel_produccion() {
        var id = $("#excel_produccion").val();
        funcion = 'ver_data_excel_produccion';

        if (id == 0) {
            $("#tbody_table_produccion_excel").empty()
            $("#selec_fila_excel_obligg").html(" - Seleccione una data");
            return swal.fire(
                "No hay data",
                "Debe seleccionar una data",
                "warning"
            );
        } else {
            $("#selec_fila_excel_obligg").html("");
        }

        tabla_data_produccion = $("#tabla_data_produccion").DataTable({
            ordering: true,
            paging: true,
            aProcessing: true,
            aServerSide: true,
            searching: {
                regex: true
            },
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"],
            ],
            pageLength: 100,
            destroy: true,
            async: false,
            processing: true,

            ajax: {
                url: "../../controlador/prediccion/prediccion.php",
                type: "POST",
                data: {
                    funcion: funcion,
                    id: id
                },
            },
            //hay que poner la misma cantidad de columnas y tambien en el html
            columns: [{
                    defaultContent: ""
                },
                {
                    data: "color",
                    render: function(data, type, row) {
                        return (
                            "<input type='color' class='form-control' value='" +
                            data +
                            "' disabled>"
                        );
                    },
                },
                {
                    data: "fecha"
                },
                {
                    data: "racimos_cosechados"
                },
                {
                    data: "racimos_rechazados"
                },
                {
                    data: "racimos_precesados"
                },
                {
                    data: "cajas_procesadas"
                },
            ],

            language: {
                rows: "%d fila seleccionada",
                processing: "Tratamiento en curso...",
                search: "Buscar&nbsp;:",
                lengthMenu: "Agrupar en _MENU_ items",
                info: "Mostrando los item (_START_ al _END_) de un total _TOTAL_ items",
                infoEmpty: "No existe datos.",
                infoFiltered: "(filtrado de _MAX_ elementos en total)",
                infoPostFix: "",
                loadingRecords: "Cargando...",
                zeroRecords: "No se encontro resultados en tu busqueda",
                emptyTable: "No hay datos disponibles en la tabla",
                paginate: {
                    first: "Primero",
                    previous: "Anterior",
                    next: "Siguiente",
                    last: "Ultimo",
                },
                select: {
                    rows: "%d fila seleccionada",
                },
                aria: {
                    sortAscending: ": active para ordenar la columa en orden ascendente",
                    sortDescending: ": active para ordenar la columna en orden descendente",
                },
            },
            select: true,
            responsive: "true",
            order: [
                [0, "ASC"]
            ],
        });

        //esto es para crearn un contador para la tabla este contador es automatico
        tabla_data_produccion.on("draw.dt", function() {
            var pageinfo = $("#tabla_data_produccion").DataTable().page.info();
            tabla_data_produccion
                .column(0, {
                    page: "current"
                })
                .nodes()
                .each(function(cell, i) {
                    cell.innerHTML = i + 1 + pageinfo.start;
                });
        });
    }
</script>
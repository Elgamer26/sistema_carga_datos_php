<?php require "../layout/header.php" ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-database"> </i>
                </div>
                <div>
                    Data de Excel fundas
                    <div class="page-title-subheading">
                        Lista data de Excel fundas
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <label class="form-label">Data fundas </label>
                <div class="d-inline-block dropdown">
                    <a href="../home/index.php"> / Principal <i class="fa fa-home"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="form-row text-center">

        <div class="col-lg-8" style="width: 100%;">
            <label> Excel cargado al sistema</label> <b><label style="color: red;" id="selec_fila_excel_obligg"></label></b>
            <select class="form-control excel_fundas" style="width: 100%;" id="excel_fundas"></select>
        </div>

        <div class="col-lg-1" style="width: 100%;">
            <labe> Ver data</label>
                <button onclick="ver_data_excel_fundas();" class="btn btn-danger"><i class="fa fa-search"></i></button>
                <br>
                <br>
        </div>

        <br>

        <div class="col-lg-12" style="width: 100%;">
            <table id="tabla_data_fundas" class="mb-0 table table-striped" style="width: 100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Semana</th>
                        <th>Lote 1A</th>
                        <th>Lote 1B</th>
                        <th>Lote 1C</th>
                        <th>Lote 2</th>
                        <th>Lote 3</th>
                        <th>Lote 4</th>
                        <th>Lote 5</th>
                        <th>Lote 6</th>
                        <th>Lote 7</th>
                        <th>Lote 8</th>
                        <th>Lote A</th>
                        <th>Lote B</th>
                        <th>Lote C</th>
                        <th>Lote D</th>
                        <th>Total</th>
                        <th>Fecha</th>
                    </tr>
                </thead>

                <tbody id="tbody_table_fundas_excel">
                </tbody>

                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Semana</th>
                        <th>Lote 1A</th>
                        <th>Lote 1B</th>
                        <th>Lote 1C</th>
                        <th>Lote 2</th>
                        <th>Lote 3</th>
                        <th>Lote 4</th>
                        <th>Lote 5</th>
                        <th>Lote 6</th>
                        <th>Lote 7</th>
                        <th>Lote 8</th>
                        <th>Lote A</th>
                        <th>Lote B</th>
                        <th>Lote C</th>
                        <th>Lote D</th>
                        <th>Total</th>
                        <th>Fecha</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>

<?php require "../layout/footer.php" ?>
<script src="../../js/prediccion.js"></script>

<script>
    var tabla_data_fundas;
    $(".excel_fundas").select2();
    listar_archivos_fundas_excel();

    function listar_archivos_fundas_excel() {
        funcion = "cargar_excel_enfunde_";
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
                $("#excel_fundas").html(cadena);
            } else {
                cadena += "<option value='0'>No hay data</option>";
                $("#excel_fundas").html(cadena);
            }
        });
    }

    function ver_data_excel_fundas() {
        var id = $("#excel_fundas").val();
        funcion = 'ver_data_excel_enfunde';

        if (id == 0) {
            $("#tbody_table_fundas_excel").empty()
            $("#selec_fila_excel_obligg").html(" - Seleccione una data");
            return swal.fire(
                "No hay data",
                "Debe seleccionar una data",
                "warning"
            );
        } else {
            $("#selec_fila_excel_obligg").html("");
        }

        tabla_data_fundas = $("#tabla_data_fundas").DataTable({
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
                    data: "lote_1A"
                },
                {
                    data: "lote_1B"
                },
                {
                    data: "lote_1C"
                },
                {
                    data: "lote_2"
                },
                {
                    data: "lote_3"
                },
                {
                    data: "lote_4"
                },
                {
                    data: "lote_5"
                },
                {
                    data: "lote_6"
                },
                {
                    data: "lote_7"
                },
                {
                    data: "lote_8"
                },
                {
                    data: "lote_A"
                },
                {
                    data: "lote_B"
                },
                {
                    data: "lote_C"
                },
                {
                    data: "lote_D"
                },
                {
                    data: "total"
                },
                {
                    data: "fecha"
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
        tabla_data_fundas.on("draw.dt", function() {
            var pageinfo = $("#tabla_data_fundas").DataTable().page.info();
            tabla_data_fundas
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
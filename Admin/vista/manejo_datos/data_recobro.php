<?php require "../layout/header.php" ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-database"> </i>
                </div>
                <div>
                    Data de Excel recobros
                    <div class="page-title-subheading">
                        Lista data de Excel recobros
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <label class="form-label">Data recobros </label>
                <div class="d-inline-block dropdown">
                    <a href="../home/index.php"> / Principal <i class="fa fa-home"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="form-row text-center">

        <div class="col-lg-8" style="width: 100%;">
            <label> Excel cargado al sistema</label> <b><label style="color: red;" id="selec_fila_excel_obligg"></label></b>
            <select class="form-control excel_recobro" style="width: 100%;" id="excel_recobro"></select>
        </div>

        <div class="col-lg-1" style="width: 100%;">
            <labe> Ver data</label>
                <button onclick="ver_data_excel_recobro();" class="btn btn-danger"><i class="fa fa-search"></i></button>
                <br>
                <br>
        </div>

        <br>

        <div class="col-lg-12" style="width: 100%;">
            <table id="tabla_data_recobro" class="mb-0 table table-striped" style="width: 100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Semana</th>
                        <!-- <th>1A CAID</th>
                        <th>1A SALDO</th>
                        <th>1B CAID</th>
                        <th>1B SALDO</th>
                        <th>1C CAID</th>
                        <th>1C SALDO</th>
                        <th>2 CAID</th>
                        <th>2 SALDO</th>
                        <th>3 CAID</th>
                        <th>3 SALDO</th>
                        <th>4 CAID</th>
                        <th>4 SALDO</th>
                        <th>5 CAID</th>
                        <th>5 SALDO</th>
                        <th>6 CAID</th>
                        <th>6 SALDO</th>
                        <th>7 CAID</th>
                        <th>7 SALDO</th>
                        <th>8 CAID</th>
                        <th>8 SALDO</th>
                        <th>A CAID</th>
                        <th>A SALDO</th>
                        <th>B CAID</th>
                        <th>B SALDO</th>
                        <th>C CAID</th>
                        <th>C SALDO</th>
                        <th>D CAID</th>
                        <th>D SALDO</th> -->
                        <th>CAIDOS</th>
                        <th>TOTAL</th>
                        <th>SALDOS</th>
                        <th>PROCENTAJE</th>
                    </tr>
                </thead>

                <tbody id="tbody_table_recobro_excel">
                </tbody>

                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Semana</th>
                        <!-- <th>1A CAID</th>
                        <th>1A SALDO</th>
                        <th>1B CAID</th>
                        <th>1B SALDO</th>
                        <th>1C CAID</th>
                        <th>1C SALDO</th>
                        <th>2 CAID</th>
                        <th>2 SALDO</th>
                        <th>3 CAID</th>
                        <th>3 SALDO</th>
                        <th>4 CAID</th>
                        <th>4 SALDO</th>
                        <th>5 CAID</th>
                        <th>5 SALDO</th>
                        <th>6 CAID</th>
                        <th>6 SALDO</th>
                        <th>7 CAID</th>
                        <th>7 SALDO</th>
                        <th>8 CAID</th>
                        <th>8 SALDO</th>
                        <th>A CAID</th>
                        <th>A SALDO</th>
                        <th>B CAID</th>
                        <th>B SALDO</th>
                        <th>C CAID</th>
                        <th>C SALDO</th>
                        <th>D CAID</th>
                        <th>D SALDO</th> -->
                        <th>CAIDOS</th>
                        <th>TOTAL</th>
                        <th>SALDOS</th>
                        <th>PROCENTAJE</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>

<?php require "../layout/footer.php" ?>
<script src="../../js/prediccion.js"></script>

<script>
    var tabla_data_recobro;
    $(".excel_recobro").select2();
    listar_archivos_recobro_excel();

    function listar_archivos_recobro_excel() {
        funcion = "cargar_excel_recobro_";
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
                $("#excel_recobro").html(cadena);
            } else {
                cadena += "<option value='0'>No hay data</option>";
                $("#excel_recobro").html(cadena);
            }
        });
    }

    function ver_data_excel_recobro() {
        var id = $("#excel_recobro").val();
        funcion = 'ver_data_excel_recobro';

        if (id == 0) {
            $("#tbody_table_recobro_excel").empty()
            $("#selec_fila_excel_obligg").html(" - Seleccione una data");
            return swal.fire(
                "No hay data",
                "Debe seleccionar una data",
                "warning"
            );
        } else {
            $("#selec_fila_excel_obligg").html("");
        }

        tabla_data_recobro = $("#tabla_data_recobro").DataTable({
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
                // {
                //     data: "1A_cai"
                // },
                // {
                //     data: "1A_saldo"
                // },
                // {
                //     data: "1B_cai"
                // },
                // {
                //     data: "1B_saldo"
                // },
                // {
                //     data: "1C_cai"
                // },
                // {
                //     data: "1C_saldo"
                // },
                // {
                //     data: "2_cai"
                // },
                // {
                //     data: "2_saldo"
                // },
                // {
                //     data: "3_cai"
                // },
                // {
                //     data: "3_saldo"
                // },
                // {
                //     data: "4_cai"
                // },
                // {
                //     data: "4_saldo"
                // },
                // {
                //     data: "5_cai"
                // },
                // {
                //     data: "5_saldo"
                // },
                // {
                //     data: "6_cai"
                // },
                // {
                //     data: "6_saldo"
                // },
                // {
                //     data: "7_cai"
                // },
                // {
                //     data: "7_saldo"
                // },
                // {
                //     data: "8_cai"
                // },
                // {
                //     data: "8_saldo"
                // },
                // {
                //     data: "A_cai"
                // },
                // {
                //     data: "A_saldo"
                // },
                // {
                //     data: "B_cai"
                // },
                // {
                //     data: "B_saldo"
                // },
                // {
                //     data: "C_cai"
                // },
                // {
                //     data: "C_saldo"
                // },
                // {
                //     data: "D_cai"
                // },
                // {
                //     data: "D_saldo"
                // },
                {
                    data: "caidos"
                },
                {
                    data: "total"
                },
                {
                    data: "saldos"
                },
                {
                    data: "porcentaje"
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
        tabla_data_recobro.on("draw.dt", function() {
            var pageinfo = $("#tabla_data_recobro").DataTable().page.info();
            tabla_data_recobro
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
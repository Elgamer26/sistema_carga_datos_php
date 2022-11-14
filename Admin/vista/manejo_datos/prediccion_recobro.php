<?php require "../layout/header.php" ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-chart-area"> </i>
                </div>
                <div>
                    Prediccion recobro de cintas
                    <div class="page-title-subheading">
                        Prediccion recobro de cintas
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <label class="form-label">Prediccion recobro de cintas </label>
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
                <button onclick="llamar_dato_grafica_recobro();" class="btn btn-danger"><i class="fa fa-search"></i></button>
                <br>
                <br>
        </div>
        <hr>

        <div class="col-lg-12" style="background: #f3ede3; border-radius: 20px;">
            <br>
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" href="#pill-1-4" data-toggle="tab">RECOBRO DE CINTAS CAIDOS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#pill-1-1" data-toggle="tab">RECOBRO DE CINTAS SALDO</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="pill-1-4">
                    <div class="row">
                        <div class="col-lg-12 chart_c_3">
                            <canvas id="grafica_3" width="100" height="30"></canvas>
                        </div>
                        <hr>
                        <div class="col-lg-12 chart_c_4">
                            <canvas id="grafica_4" width="100" height="30"></canvas>
                        </div>
                        <hr>
                        <div class="col-lg-12 chart_c_5">
                            <canvas id="grafica_5" width="100" height="30"></canvas>
                        </div>
                        <hr>
                        <div class="col-lg-12 chart_c_6">
                            <canvas id="grafica_6" width="100" height="30"></canvas>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="pill-1-1">

                    <div class="row">
                        <div class="col-lg-12 chart_c_10">
                            <canvas id="grafica_10" width="100" height="30"></canvas>
                        </div>
                        <hr>
                        <div class="col-lg-12 chart_c_11">
                            <canvas id="grafica_11" width="100" height="30"></canvas>
                        </div>
                        <hr>
                        <div class="col-lg-12 chart_c_12">
                            <canvas id="grafica_12" width="100" height="30"></canvas>
                        </div>
                        <hr>
                        <div class="col-lg-12 chart_c_13">
                            <canvas id="grafica_13" width="100" height="30"></canvas>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <hr>
        <div class="col-lg-12 chart_c_1">
            <canvas id="grafica_1" width="100" height="30"></canvas>
        </div>
        <hr>
        <div class="col-lg-12 chart_c_2">
            <canvas id="grafica_2" width="100" height="30"></canvas>
        </div>
        <hr>
        <div class="col-lg-12 chart_c">
            <canvas id="grafica" width="100" height="30"></canvas>
        </div>
        <hr>
        <div class="col-lg-12 chart_p">
            <canvas id="grafica_p" width="100" height="30"></canvas>
        </div>
        <hr>
    </div>
    <div id="chart-container"></div>

</div>

<?php require "../layout/footer.php" ?>
<script src="../../js/prediccion.js"></script>

<script>
    var funcion;

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

    function llamar_dato_grafica_recobro() {
        var id = $("#excel_recobro").val();
        funcion = 'llamar_dato_grafica_recobro';

        if (id == 0) {
            $("canvas#grafica").remove();
            $("canvas#grafica_1").remove();
            $("canvas#grafica_2").remove();
            $("canvas#grafica_3").remove();
            $("canvas#grafica_4").remove();
            $("canvas#grafica_5").remove();
            $("canvas#grafica_6").remove();
            $("canvas#grafica_10").remove();
            $("canvas#grafica_11").remove();
            $("canvas#grafica_12").remove();
            $("canvas#grafica_13").remove();
            $("canvas#grafica_p").remove();
            $("#selec_fila_excel_obligg").html(" - Seleccione una data");
            return swal.fire(
                "No hay data",
                "Debe seleccionar una data",
                "warning"
            );
        } else {
            $("#selec_fila_excel_obligg").html("");
        }

        $.LoadingOverlay("show", {
            image: "",
            fontawesome: "fa fa-cog fa-spin"
        });

        $.ajax({
            url: "../../controlador/prediccion/prediccion.php",
            type: "POST",
            data: {
                funcion: funcion,
                id: id
            },
        }).done(function(response_recobro) {

            if (response_recobro != 0) {
                var semana = [];
                var total = [];
                var data = JSON.parse(response_recobro);

                for (var i = 0; i < data.length; i++) {
                    semana.push(data[i][0]);
                    total.push(data[i][1]);
                }

                $("canvas#grafica").remove();
                $("div.chart_c").append('<canvas id="grafica" width="100" height="30"></canvas>');

                // Obtener una referencia al elemento canvas del DOM
                const grafica_recobro = document.querySelector("#grafica");
                // Las etiquetas son las que van en el eje X. 
                const etiquetas_recobro = semana
                // Podemos tener varios conjuntos de datos
                const data_recobro = {
                    label: "Recobro de cintas",
                    data: total, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
                    borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
                    borderWidth: 1, // Ancho del borde
                };

                new Chart(grafica_recobro, {
                    type: 'line', // Tipo de gráfica
                    data: {
                        labels: etiquetas_recobro,
                        datasets: [
                            data_recobro
                            // Aquí más datos...
                        ]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }],
                        },
                        title: {
                            display: true,
                            text: 'TOTAL RECOBRO DE CINTAS POR SEMANA'
                        }
                    }
                });

                ///////////////
                ///////////////

                funcion = 'Llamar_dato_grafica_recobro_saldo_caidos';
                $.ajax({
                    type: "POST",
                    url: "../../controlador/prediccion/prediccion.php",
                    data: {
                        funcion: funcion,
                        id: id
                    },
                    success: function(response_caidos_saldo) {

                        var semana_c_s = [];
                        var caidos = [];
                        var saldo = [];
                        var data_s_c = JSON.parse(response_caidos_saldo);

                        for (var i = 0; i < data_s_c.length; i++) {
                            semana_c_s.push(data_s_c[i][0]);
                            caidos.push(data_s_c[i][1]);
                            saldo.push(data_s_c[i][2]);
                        }

                        $("canvas#grafica_1").remove();
                        $("div.chart_c_1").append('<canvas id="grafica_1" width="100" height="30"></canvas>');

                        // Obtener una referencia al elemento canvas del DOM
                        const grafica_s_c = document.querySelector("#grafica_1");
                        // Las etiquetas son las que van en el eje X. 
                        const etiquetas_s_c = semana_c_s

                        const CAIDOS_CAIDOS = {
                            label: "CAIDOS",
                            data: caidos, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
                            borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };

                        const SADO_SALDO = {
                            label: "SALDO",
                            data: saldo, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(255, 159, 64, 0.2)', // Color de fondo
                            borderColor: 'rgba(255, 159, 64, 1)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };

                        // Podemos tener varios conjuntos de datos
                        new Chart(grafica_s_c, {
                            type: 'line', // Tipo de gráfica
                            data: {
                                labels: etiquetas_s_c,
                                datasets: [
                                    CAIDOS_CAIDOS,
                                    SADO_SALDO
                                ]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }],
                                },
                                title: {
                                    display: true,
                                    text: 'TOTA DE SALDO Y CAIDOS POR SEMANA'
                                }
                            }
                        });
                    }
                });

                ///////////////
                ///////////////

                funcion = 'recobro_total_caidos_saldo_lote';
                $.ajax({
                    type: "POST",
                    url: "../../controlador/prediccion/prediccion.php",
                    data: {
                        funcion: funcion,
                        id: id
                    },
                    success: function(totales_lotes) {

                        var semana_t_t = [];
                        var total_caidos = [];
                        var total_saldo = [];

                        var data_total_cs_lotes = JSON.parse(totales_lotes);

                        for (var i = 0; i < data_total_cs_lotes.length; i++) {
                            semana_t_t.push(data_total_cs_lotes[i][0]);
                            total_caidos.push(data_total_cs_lotes[i][1]);
                            total_saldo.push(data_total_cs_lotes[i][2]);
                        }

                        $("canvas#grafica_2").remove();
                        $("div.chart_c_2").append('<canvas id="grafica_2" width="100" height="30"></canvas>');

                        // Obtener una referencia al elemento canvas del DOM
                        const grafica_lotes_total = document.querySelector("#grafica_2");
                        // Las etiquetas son las que van en el eje X. 
                        const etiquetas_lotes_totales = semana_t_t

                        const CAIDOS_TOTAL = {
                            label: "TOTAL CAIDOS",
                            data: total_caidos, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
                            borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };

                        const SALDO_TOTAL = {
                            label: "TOTAL SALDO",
                            data: total_saldo, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(255, 159, 64, 0.2)', // Color de fondo
                            borderColor: 'rgba(255, 159, 64, 1)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };

                        // Podemos tener varios conjuntos de datos
                        new Chart(grafica_lotes_total, {
                            type: 'line', // Tipo de gráfica
                            data: {
                                labels: etiquetas_lotes_totales,
                                datasets: [
                                    CAIDOS_TOTAL,
                                    SALDO_TOTAL
                                ]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }],
                                },
                                title: {
                                    display: true,
                                    text: 'TOTAL DE CAIDOS Y SALDOS POR LOTE'
                                }
                            }
                        });
                    }
                });

                ///////////////
                ///////////////

                funcion = 'recobro_caidos_semana_uno';
                $.ajax({
                    type: "POST",
                    url: "../../controlador/prediccion/prediccion.php",
                    data: {
                        funcion: funcion,
                        id: id
                    },
                    success: function(response_lote_one) {

                        var semana_one = [];
                        var lote1a_one = [];
                        var lote1b_one = [];
                        var lote1c_onw = [];
                        var lote2_onw = [];
                        var data_one = JSON.parse(response_lote_one);

                        for (var i = 0; i < data_one.length; i++) {
                            semana_one.push(data_one[i][0]);
                            lote1a_one.push(data_one[i][1]);
                            lote1b_one.push(data_one[i][2]);
                            lote1c_onw.push(data_one[i][3]);
                            lote2_onw.push(data_one[i][4]);
                        }

                        $("canvas#grafica_3").remove();
                        $("div.chart_c_3").append('<canvas id="grafica_3" width="100" height="30"></canvas>');

                        // Obtener una referencia al elemento canvas del DOM
                        const grafica_one = document.querySelector("#grafica_3");
                        // Las etiquetas son las que van en el eje X. 
                        const etiquetas_one = semana_one

                        const LOTE1A_ONE = {
                            label: "LOTE 1A",
                            data: lote1a_one, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
                            borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };
                        const LOTE1B_ONE = {
                            label: "LOTE 1B",
                            data: lote1b_one, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(255, 159, 64, 0.2)', // Color de fondo
                            borderColor: 'rgba(255, 159, 64, 1)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };
                        const LOTE1C_ONE = {
                            label: "LOTE 1C",
                            data: lote1c_onw, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(134, 321, 56, 0.2)', // Color de fondo
                            borderColor: 'rgba(23, 213, 67, 2)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };
                        const LOTE2_ONE = {
                            label: "LOTE 2",
                            data: lote2_onw, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(34, 21, 56, 0.2)', // Color de fondo
                            borderColor: 'rgba(123, 13, 167, 5)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };

                        // Podemos tener varios conjuntos de datos
                        new Chart(grafica_one, {
                            type: 'line', // Tipo de gráfica
                            data: {
                                labels: etiquetas_one,
                                datasets: [
                                    LOTE1A_ONE,
                                    LOTE1B_ONE,
                                    LOTE1C_ONE,
                                    LOTE2_ONE
                                ]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }],
                                },
                                title: {
                                    display: true,
                                    text: 'RECOBRO DE CINTAS CAIDOS DEL LOTE 1A - 1B - 1C - 2'
                                }
                            }
                        });
                    }
                });

                ///////////////
                ///////////////

                funcion = 'recobro_caidos_semana_dos';
                $.ajax({
                    type: "POST",
                    url: "../../controlador/prediccion/prediccion.php",
                    data: {
                        funcion: funcion,
                        id: id
                    },
                    success: function(response_lote_dos) {

                        var semana_dos = [];
                        var lote3_dos = [];
                        var lote4_dos = [];
                        var lote5_dos = [];
                        var lote6_dos = [];
                        var data_dos = JSON.parse(response_lote_dos);

                        for (var i = 0; i < data_dos.length; i++) {
                            semana_dos.push(data_dos[i][0]);
                            lote3_dos.push(data_dos[i][1]);
                            lote4_dos.push(data_dos[i][2]);
                            lote5_dos.push(data_dos[i][3]);
                            lote6_dos.push(data_dos[i][4]);
                        }

                        $("canvas#grafica_4").remove();
                        $("div.chart_c_4").append('<canvas id="grafica_4" width="100" height="30"></canvas>');

                        // Obtener una referencia al elemento canvas del DOM
                        const grafica_dos = document.querySelector("#grafica_4");
                        // Las etiquetas son las que van en el eje X. 
                        const etiquetas_dos = semana_dos

                        const LOTE3_DOS = {
                            label: "LOTE 3",
                            data: lote3_dos, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
                            borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };
                        const LOTE4_DOS = {
                            label: "LOTE 4",
                            data: lote4_dos, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(255, 159, 64, 0.2)', // Color de fondo
                            borderColor: 'rgba(255, 159, 64, 1)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };
                        const LOTE5_DOS = {
                            label: "LOTE 5",
                            data: lote5_dos, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(134, 321, 56, 0.2)', // Color de fondo
                            borderColor: 'rgba(23, 213, 67, 2)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };
                        const LOTE6_DOS = {
                            label: "LOTE 6",
                            data: lote6_dos, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(34, 21, 56, 0.2)', // Color de fondo
                            borderColor: 'rgba(123, 13, 167, 5)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };

                        // Podemos tener varios conjuntos de datos
                        new Chart(grafica_dos, {
                            type: 'line', // Tipo de gráfica
                            data: {
                                labels: etiquetas_dos,
                                datasets: [
                                    LOTE3_DOS,
                                    LOTE4_DOS,
                                    LOTE5_DOS,
                                    LOTE6_DOS
                                ]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }],
                                },
                                title: {
                                    display: true,
                                    text: 'RECOBRO DE CINTAS CAIDOS DEL LOTE: 3 - 4 - 5 - 6'
                                }
                            }
                        });
                    }
                });

                ///////////////
                ///////////////

                funcion = 'recobro_caidos_semana_tres';
                $.ajax({
                    type: "POST",
                    url: "../../controlador/prediccion/prediccion.php",
                    data: {
                        funcion: funcion,
                        id: id
                    },
                    success: function(response_lote_tres) {

                        var semana_tres = [];
                        var lote7_tres = [];
                        var lote8_tres = [];
                        var loteA_tres = [];
                        var loteB_tres = [];
                        var data_tres = JSON.parse(response_lote_tres);

                        for (var i = 0; i < data_tres.length; i++) {
                            semana_tres.push(data_tres[i][0]);
                            lote7_tres.push(data_tres[i][1]);
                            lote8_tres.push(data_tres[i][2]);
                            loteA_tres.push(data_tres[i][3]);
                            loteB_tres.push(data_tres[i][4]);
                        }

                        $("canvas#grafica_5").remove();
                        $("div.chart_c_5").append('<canvas id="grafica_5" width="100" height="30"></canvas>');

                        // Obtener una referencia al elemento canvas del DOM
                        const grafica_tres = document.querySelector("#grafica_5");
                        // Las etiquetas son las que van en el eje X. 
                        const etiquetas_tres = semana_tres

                        const LOTE7_TRES = {
                            label: "LOTE 7",
                            data: lote7_tres, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
                            borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };
                        const LOTE8_TRES = {
                            label: "LOTE 8",
                            data: lote8_tres, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(255, 159, 64, 0.2)', // Color de fondo
                            borderColor: 'rgba(255, 159, 64, 1)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };
                        const LOTEA_TRES = {
                            label: "LOTE A",
                            data: loteA_tres, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(134, 321, 56, 0.2)', // Color de fondo
                            borderColor: 'rgba(23, 213, 67, 2)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };
                        const LOTEB_TRES = {
                            label: "LOTE B",
                            data: loteB_tres, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(34, 21, 56, 0.2)', // Color de fondo
                            borderColor: 'rgba(123, 13, 167, 5)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };

                        // Podemos tener varios conjuntos de datos
                        new Chart(grafica_tres, {
                            type: 'line', // Tipo de gráfica
                            data: {
                                labels: etiquetas_tres,
                                datasets: [
                                    LOTE7_TRES,
                                    LOTE8_TRES,
                                    LOTEA_TRES,
                                    LOTEB_TRES
                                ]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }],
                                },
                                title: {
                                    display: true,
                                    text: 'RECOBRO DE CINTAS CAIDOS DEL LOTE: 7 - 8 - A - B'
                                }
                            }
                        });
                    }
                });

                ///////////////
                ///////////////

                funcion = 'recobro_caidos_semana_cuatro';
                $.ajax({
                    type: "POST",
                    url: "../../controlador/prediccion/prediccion.php",
                    data: {
                        funcion: funcion,
                        id: id
                    },
                    success: function(response_lote_cuatro) {

                        var semana_cuatro = [];
                        var lotec_cuatro = [];
                        var loted_cuatro = [];
                        var data_cuatro = JSON.parse(response_lote_cuatro);

                        for (var i = 0; i < data_cuatro.length; i++) {
                            semana_cuatro.push(data_cuatro[i][0]);
                            lotec_cuatro.push(data_cuatro[i][1]);
                            loted_cuatro.push(data_cuatro[i][2]);
                        }

                        $("canvas#grafica_6").remove();
                        $("div.chart_c_6").append('<canvas id="grafica_6" width="100" height="30"></canvas>');

                        // Obtener una referencia al elemento canvas del DOM
                        const grafica_cuatro = document.querySelector("#grafica_6");
                        // Las etiquetas son las que van en el eje X. 
                        const etiquetas_cuatro = semana_cuatro

                        const LOTEC_CUATRO = {
                            label: "LOTE C",
                            data: lotec_cuatro, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
                            borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };
                        const LOTED_CUATRO = {
                            label: "LOTE D",
                            data: loted_cuatro, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(255, 159, 64, 0.2)', // Color de fondo
                            borderColor: 'rgba(255, 159, 64, 1)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };

                        // Podemos tener varios conjuntos de datos
                        new Chart(grafica_cuatro, {
                            type: 'line', // Tipo de gráfica
                            data: {
                                labels: etiquetas_cuatro,
                                datasets: [
                                    LOTEC_CUATRO,
                                    LOTED_CUATRO
                                ]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }],
                                },
                                title: {
                                    display: true,
                                    text: 'RECOBRO DE CINTAS CAIDOS DEL LOTE: C - D'
                                }
                            }
                        });
                    }
                });

                ///////////////
                ///////////////

                funcion = 'recobro_saldos_semana_uno';
                $.ajax({
                    type: "POST",
                    url: "../../controlador/prediccion/prediccion.php",
                    data: {
                        funcion: funcion,
                        id: id
                    },
                    success: function(response_lote_diez) {

                        var semana_diez = [];
                        var lote1a_diez = [];
                        var lote1b_diez = [];
                        var lote1c_diez = [];
                        var lote2_diez = [];
                        var data_diez = JSON.parse(response_lote_diez);

                        for (var i = 0; i < data_diez.length; i++) {
                            semana_diez.push(data_diez[i][0]);
                            lote1a_diez.push(data_diez[i][1]);
                            lote1b_diez.push(data_diez[i][2]);
                            lote1c_diez.push(data_diez[i][3]);
                            lote2_diez.push(data_diez[i][4]);
                        }

                        $("canvas#grafica_10").remove();
                        $("div.chart_c_10").append('<canvas id="grafica_10" width="100" height="30"></canvas>');

                        // Obtener una referencia al elemento canvas del DOM
                        const grafica_diez = document.querySelector("#grafica_10");
                        // Las etiquetas son las que van en el eje X. 
                        const etiquetas_diez = semana_diez

                        const LOTE1A_DIEZ = {
                            label: "LOTE 1A",
                            data: lote1a_diez, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
                            borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };
                        const LOTE1B_DIEZ = {
                            label: "LOTE 1B",
                            data: lote1b_diez, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(255, 159, 64, 0.2)', // Color de fondo
                            borderColor: 'rgba(255, 159, 64, 1)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };
                        const LOTE1C_DIEZ = {
                            label: "LOTE 1C",
                            data: lote1c_diez, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(134, 321, 56, 0.2)', // Color de fondo
                            borderColor: 'rgba(23, 213, 67, 2)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };
                        const LOTE2_DIEZ = {
                            label: "LOTE 2",
                            data: lote2_diez, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(34, 21, 56, 0.2)', // Color de fondo
                            borderColor: 'rgba(123, 13, 167, 5)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };

                        // Podemos tener varios conjuntos de datos
                        new Chart(grafica_diez, {
                            type: 'line', // Tipo de gráfica
                            data: {
                                labels: etiquetas_diez,
                                datasets: [
                                    LOTE1A_DIEZ,
                                    LOTE1B_DIEZ,
                                    LOTE1C_DIEZ,
                                    LOTE2_DIEZ
                                ]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }],
                                },
                                title: {
                                    display: true,
                                    text: 'RECOBRO DE CINTAS SALDOS DEL LOTE 1A - 1B - 1C - 2'
                                }
                            }
                        });
                    }
                });

                ///////////////
                ///////////////

                funcion = 'recobro_saldos_semana_dos';
                $.ajax({
                    type: "POST",
                    url: "../../controlador/prediccion/prediccion.php",
                    data: {
                        funcion: funcion,
                        id: id
                    },
                    success: function(response_lote_once) {

                        var semana_once = [];
                        var lote3_once = [];
                        var lote4_once = [];
                        var lote5_once = [];
                        var lote6_once = [];
                        var data_once = JSON.parse(response_lote_once);

                        for (var i = 0; i < data_once.length; i++) {
                            semana_once.push(data_once[i][0]);
                            lote3_once.push(data_once[i][1]);
                            lote4_once.push(data_once[i][2]);
                            lote5_once.push(data_once[i][3]);
                            lote6_once.push(data_once[i][4]);
                        }

                        $("canvas#grafica_11").remove();
                        $("div.chart_c_11").append('<canvas id="grafica_11" width="100" height="30"></canvas>');

                        // Obtener una referencia al elemento canvas del DOM
                        const grafica_once = document.querySelector("#grafica_11");
                        // Las etiquetas son las que van en el eje X. 
                        const etiquetas_once = semana_once

                        const LOTE3_ONCE = {
                            label: "LOTE 3",
                            data: lote3_once, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
                            borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };
                        const LOTE4_ONCE = {
                            label: "LOTE 4",
                            data: lote4_once, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(255, 159, 64, 0.2)', // Color de fondo
                            borderColor: 'rgba(255, 159, 64, 1)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };
                        const LOTE5_ONCE = {
                            label: "LOTE 5",
                            data: lote5_once, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(134, 321, 56, 0.2)', // Color de fondo
                            borderColor: 'rgba(23, 213, 67, 2)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };
                        const LOTE6_ONCE = {
                            label: "LOTE 6",
                            data: lote6_once, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(34, 21, 56, 0.2)', // Color de fondo
                            borderColor: 'rgba(123, 13, 167, 5)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };

                        // Podemos tener varios conjuntos de datos
                        new Chart(grafica_once, {
                            type: 'line', // Tipo de gráfica
                            data: {
                                labels: etiquetas_once,
                                datasets: [
                                    LOTE3_ONCE,
                                    LOTE4_ONCE,
                                    LOTE5_ONCE,
                                    LOTE6_ONCE
                                ]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }],
                                },
                                title: {
                                    display: true,
                                    text: 'RECOBRO DE CINTAS SALDOS DEL LOTE: 3 - 4 - 5 - 6'
                                }
                            }
                        });
                    }
                });

                ///////////////
                ///////////////

                funcion = 'recobro_saldos_semana_tres';
                $.ajax({
                    type: "POST",
                    url: "../../controlador/prediccion/prediccion.php",
                    data: {
                        funcion: funcion,
                        id: id
                    },
                    success: function(response_lote_doce) {

                        var semana_doce = [];
                        var lote7_doce = [];
                        var lote8_doce = [];
                        var loteA_doce = [];
                        var loteB_doce = [];
                        var data_doce = JSON.parse(response_lote_doce);

                        for (var i = 0; i < data_doce.length; i++) {
                            semana_doce.push(data_doce[i][0]);
                            lote7_doce.push(data_doce[i][1]);
                            lote8_doce.push(data_doce[i][2]);
                            loteA_doce.push(data_doce[i][3]);
                            loteB_doce.push(data_doce[i][4]);
                        }

                        $("canvas#grafica_12").remove();
                        $("div.chart_c_12").append('<canvas id="grafica_12" width="100" height="30"></canvas>');

                        // Obtener una referencia al elemento canvas del DOM
                        const grafica_doce = document.querySelector("#grafica_12");
                        // Las etiquetas son las que van en el eje X. 
                        const etiquetas_doce = semana_doce

                        const LOTE7_DOCE = {
                            label: "LOTE 7",
                            data: lote7_doce, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
                            borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };
                        const LOTE8_DOCE = {
                            label: "LOTE 8",
                            data: lote8_doce, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(255, 159, 64, 0.2)', // Color de fondo
                            borderColor: 'rgba(255, 159, 64, 1)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };
                        const LOTEA_DOCE = {
                            label: "LOTE A",
                            data: loteA_doce, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(134, 321, 56, 0.2)', // Color de fondo
                            borderColor: 'rgba(23, 213, 67, 2)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };
                        const LOTEB_DOCE = {
                            label: "LOTE B",
                            data: loteB_doce, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(34, 21, 56, 0.2)', // Color de fondo
                            borderColor: 'rgba(123, 13, 167, 5)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };

                        // Podemos tener varios conjuntos de datos
                        new Chart(grafica_doce, {
                            type: 'line', // Tipo de gráfica
                            data: {
                                labels: etiquetas_doce,
                                datasets: [
                                    LOTE7_DOCE,
                                    LOTE8_DOCE,
                                    LOTEA_DOCE,
                                    LOTEB_DOCE
                                ]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }],
                                },
                                title: {
                                    display: true,
                                    text: 'RECOBRO DE CINTAS SALDOS DEL LOTE: 7 - 8 - A - B'
                                }
                            }
                        });
                    }
                });

                ///////////////
                ///////////////

                funcion = 'recobro_saldos_semana_cuatro';
                $.ajax({
                    type: "POST",
                    url: "../../controlador/prediccion/prediccion.php",
                    data: {
                        funcion: funcion,
                        id: id
                    },
                    success: function(response_lote_trece) {

                        var semana_trece = [];
                        var lotec_trece = [];
                        var loted_trece = [];
                        var data_trece = JSON.parse(response_lote_trece);

                        for (var i = 0; i < data_trece.length; i++) {
                            semana_trece.push(data_trece[i][0]);
                            lotec_trece.push(data_trece[i][1]);
                            loted_trece.push(data_trece[i][2]);
                        }

                        $("canvas#grafica_13").remove();
                        $("div.chart_c_13").append('<canvas id="grafica_13" width="100" height="30"></canvas>');

                        // Obtener una referencia al elemento canvas del DOM
                        const grafica_trece = document.querySelector("#grafica_13");
                        // Las etiquetas son las que van en el eje X. 
                        const etiquetas_trece = semana_trece

                        const LOTEC_TRECE = {
                            label: "LOTE C",
                            data: lotec_trece, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
                            borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };
                        const LOTED_TRECE = {
                            label: "LOTE D",
                            data: loted_trece, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(255, 159, 64, 0.2)', // Color de fondo
                            borderColor: 'rgba(255, 159, 64, 1)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };

                        // Podemos tener varios conjuntos de datos
                        new Chart(grafica_trece, {
                            type: 'line', // Tipo de gráfica
                            data: {
                                labels: etiquetas_trece,
                                datasets: [
                                    LOTEC_TRECE,
                                    LOTED_TRECE
                                ]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }],
                                },
                                title: {
                                    display: true,
                                    text: 'RECOBRO DE CINTAS SALDOS DEL LOTE: C - D'
                                }
                            }
                        });
                    }
                });

                ///////////////
                ///////////////

                funcion = 'recobro_porcentaje';
                $.ajax({
                    type: "POST",
                    url: "../../controlador/prediccion/prediccion.php",
                    data: {
                        funcion: funcion,
                        id: id
                    },
                    success: function(response_porcentaje) {

                        var semana_porcentaje = [];
                        var porcentaje = [];
                        var data_porcentaje = JSON.parse(response_porcentaje);

                        for (var i = 0; i < data_porcentaje.length; i++) {
                            semana_porcentaje.push(data_porcentaje[i][0]);
                            porcentaje.push(data_porcentaje[i][1]);
                        }

                        $("canvas#grafica_p").remove();
                        $("div.chart_p").append('<canvas id="grafica_p" width="100" height="30"></canvas>');

                        // Obtener una referencia al elemento canvas del DOM
                        const grafica_porcentaaje = document.querySelector("#grafica_p");
                        // Las etiquetas son las que van en el eje X. 
                        const etiquetas_porcentaje = semana_porcentaje

                        const PORCENTAJJEE = {
                            label: "PORCENTAJE",
                            data: porcentaje, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(134, 321, 56, 0.2)', // Color de fondo
                            borderColor: 'rgba(23, 213, 67, 2)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };

                        // Podemos tener varios conjuntos de datos
                        new Chart(grafica_porcentaaje, {
                            type: 'bar', // Tipo de gráfica
                            data: {
                                labels: etiquetas_porcentaje,
                                datasets: [
                                    PORCENTAJJEE
                                ]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }],
                                },
                                title: {
                                    display: true,
                                    text: 'PORCENTAJE DE RECOBROS DE CINTAS'
                                }
                            }
                        });
                    }
                });

                $.LoadingOverlay("hide");
                return false;

            } else {
                $("canvas#grafica").remove();
                $("canvas#grafica_1").remove();
                $("canvas#grafica_2").remove();
                $("canvas#grafica_3").remove();
                $("canvas#grafica_4").remove();
                $("canvas#grafica_5").remove();
                $("canvas#grafica_6").remove();
                $("canvas#grafica_10").remove();
                $("canvas#grafica_11").remove();
                $("canvas#grafica_12").remove();
                $("canvas#grafica_13").remove();
                $("canvas#grafica_p").remove();
                return $.LoadingOverlay("hide");
            }

        });
    }
</script>
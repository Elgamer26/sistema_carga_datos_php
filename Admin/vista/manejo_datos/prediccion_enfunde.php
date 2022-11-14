<?php require "../layout/header.php" ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-chart-area"> </i>
                </div>
                <div>
                    Prediccion enfunde
                    <div class="page-title-subheading">
                        Prediccion enfunde
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <label class="form-label">Prediccion enfunde </label>
                <div class="d-inline-block dropdown">
                    <a href="../home/index.php"> / Principal <i class="fa fa-home"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="form-row text-center">

        <div class="col-lg-8" style="width: 100%;">
            <label> Excel cargado al sistema</label> <b><label style="color: red;" id="selec_fila_excel_obligg"></label></b>
            <select class="form-control excel_enfunde" style="width: 100%;" id="excel_enfunde"></select>
        </div>

        <div class="col-lg-1" style="width: 100%;">
            <labe> Ver data</label>
                <button onclick="llamar_dato_grafica_enfunde();" class="btn btn-danger"><i class="fa fa-search"></i></button>
                <br>
                <br>
        </div>
        
        <br>

        <div class="col-lg-12 chart_c_1">
            <canvas id="grafica_1" width="100" height="30"></canvas>
        </div>

        <hr>

        <div class="col-lg-12 chart_c_2">
            <canvas id="grafica_2" width="100" height="30"></canvas>
        </div>

        <hr>

        <div class="col-lg-12 chart_c_3">
            <canvas id="grafica_3" width="100" height="30"></canvas>
        </div>

        <hr>

        <div class="col-lg-12 chart_c_4">
            <canvas id="grafica_4" width="100" height="30"></canvas>
        </div>

        <hr>

        <div class="col-lg-12 chart_c">
            <canvas id="grafica" width="100" height="30"></canvas>
        </div>

        <hr>

        <div class="col-lg-12 chart_c_5">
            <canvas id="grafica_5" width="100" height="30"></canvas>
        </div>

    </div>

    <div id="chart-container"></div>

</div>

<?php require "../layout/footer.php" ?>
<script src="../../js/prediccion.js"></script>

<script>
    var funcion;

    $(".excel_enfunde").select2();
    listar_archivos_enfunde_excel();

    function listar_archivos_enfunde_excel() {
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
                $("#excel_enfunde").html(cadena);
            } else {
                cadena += "<option value='0'>No hay data</option>";
                $("#excel_enfunde").html(cadena);
            }
        });
    }

    function llamar_dato_grafica_enfunde() {
        var id = $("#excel_enfunde").val();
        funcion = 'llamar_dato_grafica_enfunde';

        if (id == 0) {
            $("canvas#grafica").remove();
            $("canvas#grafica_1").remove();
            $("canvas#grafica_2").remove();
            $("canvas#grafica_3").remove();
            $("canvas#grafica_4").remove();
            $("canvas#grafica_5").remove();
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
        }).done(function(response) {

            if (response != 0) {
                var semana = [];
                var total = [];

                var data = JSON.parse(response);

                for (var i = 0; i < data.length; i++) {
                    semana.push(data[i][0]);
                    total.push(data[i][1]);
                }

                $("canvas#grafica").remove();
                $("div.chart_c").append('<canvas id="grafica" width="100" height="30"></canvas>');

                // Obtener una referencia al elemento canvas del DOM
                const grafica_cajas = document.querySelector("#grafica");
                // Las etiquetas son las que van en el eje X. 
                const etiquetas_cajas = semana
                // Podemos tener varios conjuntos de datos
                const data_cajas_1 = {
                    label: "Enfunde",
                    data: total, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
                    borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
                    borderWidth: 1, // Ancho del borde
                };

                new Chart(grafica_cajas, {
                    type: 'line', // Tipo de gráfica
                    data: {
                        labels: etiquetas_cajas,
                        datasets: [
                            data_cajas_1
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
                            text: 'TOTAL DE ENFUNDE POR SEMANA'
                        }
                    }
                });

                ///////////////
                ///////////////

                funcion = 'llamar_graficas_fundas_primeros_lotes';
                $.ajax({
                    type: "POST",
                    url: "../../controlador/prediccion/prediccion.php",
                    data: {
                        funcion: funcion,
                        id: id
                    },
                    success: function(response_fir) {

                        var semana_fir = [];
                        var lote1a = [];
                        var lote1b = [];
                        var lote1c = [];
                        var data_fir = JSON.parse(response_fir);

                        for (var i = 0; i < data_fir.length; i++) {
                            semana_fir.push(data_fir[i][0]);
                            lote1a.push(data_fir[i][1]);
                            lote1b.push(data_fir[i][2]);
                            lote1c.push(data_fir[i][3]);
                        }

                        $("canvas#grafica_1").remove();
                        $("div.chart_c_1").append('<canvas id="grafica_1" width="100" height="30"></canvas>');

                        // Obtener una referencia al elemento canvas del DOM
                        const grafica_total = document.querySelector("#grafica_1");
                        // Las etiquetas son las que van en el eje X. 
                        const etiquetas_1 = semana_fir

                        const LOTE_1A = {
                            label: "LOTE 1A",
                            data: lote1a, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
                            borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };
                        const LOTE_1B = {
                            label: "LOTE 1B",
                            data: lote1b, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(255, 159, 64, 0.2)', // Color de fondo
                            borderColor: 'rgba(255, 159, 64, 1)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };
                        const LOTE_1C = {
                            label: "LOTE 1C",
                            data: lote1c, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(134, 321, 56, 0.2)', // Color de fondo
                            borderColor: 'rgba(23, 213, 67, 2)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };

                        // Podemos tener varios conjuntos de datos
                        new Chart(grafica_total, {
                            type: 'line', // Tipo de gráfica
                            data: {
                                labels: etiquetas_1,
                                datasets: [
                                    LOTE_1A,
                                    LOTE_1B,
                                    LOTE_1C
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
                                    text: 'ENFUNDES DE LOS LOTES: 1A - 1B - 1C'
                                }
                            }
                        });
                    }
                });

                ///////////////
                ///////////////

                funcion = 'llamar_graficas_fundas_segundos_lotes';
                $.ajax({
                    type: "POST",
                    url: "../../controlador/prediccion/prediccion.php",
                    data: {
                        funcion: funcion,
                        id: id
                    },
                    success: function(response_two) {

                        var semana_two = [];
                        var lote2 = [];
                        var lote3 = [];
                        var lote4 = [];
                        var lote5 = [];
                        var data_two = JSON.parse(response_two);

                        for (var i = 0; i < data_two.length; i++) {
                            semana_two.push(data_two[i][0]);
                            lote2.push(data_two[i][1]);
                            lote3.push(data_two[i][2]);
                            lote4.push(data_two[i][3]);
                            lote5.push(data_two[i][4]);
                        }

                        $("canvas#grafica_2").remove();
                        $("div.chart_c_2").append('<canvas id="grafica_2" width="100" height="30"></canvas>');

                        // Obtener una referencia al elemento canvas del DOM
                        const grafica_two = document.querySelector("#grafica_2");
                        // Las etiquetas son las que van en el eje X. 
                        const etiquetas_rwo = semana_two

                        const LOTE_2 = {
                            label: "LOTE 2",
                            data: lote2, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
                            borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };
                        const LOTE_3 = {
                            label: "LOTE 3",
                            data: lote3, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(255, 159, 64, 0.2)', // Color de fondo
                            borderColor: 'rgba(255, 159, 64, 1)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };
                        const LOTE_4 = {
                            label: "LOTE 4",
                            data: lote4, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(134, 321, 56, 0.2)', // Color de fondo
                            borderColor: 'rgba(23, 213, 67, 2)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };
                        const LOTE_5 = {
                            label: "LOTE 5",
                            data: lote5, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(125, 31, 250, 0.2)', // Color de fondo
                            borderColor: 'rgba(25, 131, 50, 3)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };

                        // Podemos tener varios conjuntos de datos
                        new Chart(grafica_two, {
                            type: 'line', // Tipo de gráfica
                            data: {
                                labels: etiquetas_rwo,
                                datasets: [
                                    LOTE_2,
                                    LOTE_3,
                                    LOTE_4,
                                    LOTE_5
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
                                    text: 'ENFUNDES DE LOS LOTES: 2 - 3 - 4 - 5'
                                }
                            }
                        });
                    }
                });

                ///////////////
                ///////////////

                funcion = 'llamar_graficas_fundas_tercer_lotes';
                $.ajax({
                    type: "POST",
                    url: "../../controlador/prediccion/prediccion.php",
                    data: {
                        funcion: funcion,
                        id: id
                    },
                    success: function(response_tree) {

                        var semana_tree = [];
                        var lote6 = [];
                        var lote7 = [];
                        var lote8 = [];
                        var data_tree = JSON.parse(response_tree);

                        for (var i = 0; i < data_tree.length; i++) {
                            semana_tree.push(data_tree[i][0]);
                            lote6.push(data_tree[i][1]);
                            lote7.push(data_tree[i][2]);
                            lote8.push(data_tree[i][3]);
                        }

                        $("canvas#grafica_3").remove();
                        $("div.chart_c_3").append('<canvas id="grafica_3" width="100" height="30"></canvas>');

                        // Obtener una referencia al elemento canvas del DOM
                        const grafica_tree = document.querySelector("#grafica_3");
                        // Las etiquetas son las que van en el eje X. 
                        const etiquetas_tree = semana_tree

                        const LOTE_6 = {
                            label: "LOTE 6",
                            data: lote6, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
                            borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };
                        const LOTE_7 = {
                            label: "LOTE 7",
                            data: lote7, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(255, 159, 64, 0.2)', // Color de fondo
                            borderColor: 'rgba(255, 159, 64, 1)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };
                        const LOTE_8 = {
                            label: "LOTE 8",
                            data: lote8, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(134, 321, 56, 0.2)', // Color de fondo
                            borderColor: 'rgba(23, 213, 67, 2)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };

                        // Podemos tener varios conjuntos de datos
                        new Chart(grafica_tree, {
                            type: 'line', // Tipo de gráfica
                            data: {
                                labels: etiquetas_tree,
                                datasets: [
                                    LOTE_6,
                                    LOTE_7,
                                    LOTE_8
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
                                    text: 'ENFUNDES DE LOS LOTES: 6 - 7 - 8'
                                }
                            }
                        });
                    }
                });

                ///////////////
                ///////////////

                funcion = 'llamar_graficas_fundas_cuarto_lotes';
                $.ajax({
                    type: "POST",
                    url: "../../controlador/prediccion/prediccion.php",
                    data: {
                        funcion: funcion,
                        id: id
                    },
                    success: function(response_for) {

                        var semana_for = [];
                        var loteA = [];
                        var loteB = [];
                        var loteC = [];
                        var loteD = [];
                        var data_two = JSON.parse(response_for);

                        for (var i = 0; i < data_two.length; i++) {
                            semana_for.push(data_two[i][0]);
                            loteA.push(data_two[i][1]);
                            loteB.push(data_two[i][2]);
                            loteC.push(data_two[i][3]);
                            loteD.push(data_two[i][4]);
                        }

                        $("canvas#grafica_4").remove();
                        $("div.chart_c_4").append('<canvas id="grafica_4" width="100" height="30"></canvas>');

                        // Obtener una referencia al elemento canvas del DOM
                        const grafica_for = document.querySelector("#grafica_4");
                        // Las etiquetas son las que van en el eje X. 
                        const etiquetas_for = semana_for

                        const LOTE_A = {
                            label: "LOTE A",
                            data: loteA, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
                            borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };
                        const LOTE_B = {
                            label: "LOTE B",
                            data: loteB, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(255, 159, 64, 0.2)', // Color de fondo
                            borderColor: 'rgba(255, 159, 64, 1)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };
                        const LOTE_C = {
                            label: "LOTE C",
                            data: loteC, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(134, 321, 56, 0.2)', // Color de fondo
                            borderColor: 'rgba(23, 213, 67, 2)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };
                        const LOTE_D = {
                            label: "LOTE D",
                            data: loteD, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(125, 31, 250, 0.2)', // Color de fondo
                            borderColor: 'rgba(25, 131, 50, 3)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };

                        // Podemos tener varios conjuntos de datos
                        new Chart(grafica_for, {
                            type: 'line', // Tipo de gráfica
                            data: {
                                labels: etiquetas_for,
                                datasets: [
                                    LOTE_A,
                                    LOTE_B,
                                    LOTE_C,
                                    LOTE_D
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
                                    text: 'ENFUNDES DE LOS LOTES: A - B - C - D'
                                }
                            }
                        });
                    }
                });

                ///////////////
                ///////////////

                funcion = 'Llamar_total_fundas_lotes';
                $.ajax({
                    type: "POST",
                    url: "../../controlador/prediccion/prediccion.php",
                    data: {
                        funcion: funcion,
                        id: id
                    },
                    success: function(response_all) {

                        var lotes_all = [];
                        var total_all = [];
                        var colores = [];

                        var data_all = JSON.parse(response_all);

                        for (var i = 0; i < data_all.length; i++) {
                            lotes_all.push(data_all[i][0]);
                            total_all.push(data_all[i][1]);
                            colores.push(colores_rgb());
                        }

                        $("canvas#grafica_5").remove();
                        $("div.chart_c_5").append('<canvas id="grafica_5" width="100" height="30"></canvas>');

                        // Obtener una referencia al elemento canvas del DOM
                        const grafica_all = document.querySelector("#grafica_5");
                        // Las etiquetas son las que van en el eje X. 
                        const etiquetas_all = lotes_all

                        const LOTE_All = {
                            label: "LOTES",
                            data: total_all, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: colores, // Color de fondo
                            borderColor: colores, // Color del borde
                            borderWidth: 4, // Ancho del borde
                        };

                        // Podemos tener varios conjuntos de datos
                        new Chart(grafica_all, {
                            type: 'bar', // Tipo de gráfica
                            data: {
                                labels: etiquetas_all,
                                datasets: [
                                    LOTE_All
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
                                    text: 'TOTAL DE ENFUNDE POR LOTES'
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
                return $.LoadingOverlay("hide");
            }

        });
    }
</script>
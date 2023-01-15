<?php require "../layout/header.php" ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-chart-area"> </i>
                </div>
                <div>
                    Predicción de producción - <button onclick="mostrar_grafica_linea(this);" class="btn btn-success">Grafica linea</button> -
                    <button onclick="mostrar_grafica_barra(this);" class="btn btn-warning">Grafica barra</button> 
                    <div class="page-title-subheading">
                        Predicción de producción
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <label class="form-label">Predicción de producción </label>
                <div class="d-inline-block dropdown">
                    <a href="../home/index.php"> / Principal <i class="fa fa-home"></i></a>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="form-row text-center">

    <div class="col-lg-6 chart_c_pasado">
            <canvas id="grafico_c_pasado" width="100" height="50"></canvas>
        </div>

        <div class="col-lg-6 chart_1">
            <canvas id="grafico_1" width="100" height="50"></canvas>
        </div>

        <div class="col-lg-6 chart_a">
            <canvas id="grafica_año" width="100" height="50"></canvas>
        </div>

        <div class="col-lg-6 chart_ano_f">
            <canvas id="grafica_ano_f" width="100" height="30"></canvas>
        </div>

    </div>



    <div id="chart-container"></div>

</div>

<?php require "../layout/footer.php" ?>
<script src="../../js/prediccion.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs/dist/tf.min.js"></script>

<script>
    function mostrar_grafica_linea() {
        grafica_produccion_2018_2020("line");
        grafica_produccion_2023_2025("line");
    }

    function mostrar_grafica_barra() {
        grafica_produccion_2018_2020("bar");
        grafica_produccion_2023_2025("bar");
    }

    var funcion;
    grafica_produccion_2018_2020("bar");

    var cajas2018 = [];
    var cajas2019 = [];
    var cajas2020 = [];

    var cajas_año = [];
    var cajas2_año = [];
    var cajas3_año = [];

    ////////////////////////////////
    function grafica_produccion_2018_2020(typpe) {
        funcion = "grafica_produccion_2018_2020";
        $.ajax({
            url: "../../controlador/prediccion/control_predict.php",
            type: "POST",
            data: {
                funcion: funcion,
            },
        }).done(function(response) {
            if (response != 0) {
                var data = JSON.parse(response);

                for (var i = 0; i < data.length; i++) {
                    cajas2018.push(data[i][1]);
                    cajas2019.push(data[i][2]);
                    cajas2020.push(data[i][3]);
                }

                //esto es para desctuir el grafico porque sale un error
                $("canvas#grafico_c_pasado").remove();
                $("div.chart_c_pasado").append('<canvas id="grafico_c_pasado" width="100" height="50"></canvas>');
                ///este es el grafico

                const CAJAS2018 = {
                    label: "2018",
                    data: cajas2018, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                    backgroundColor: 'rgba(17, 160, 185, 1)', // Color de fondo
                    borderColor: 'rgba(17, 160, 185, 1)', // Color del borde
                    borderWidth: 1, // Ancho del borde
                    fill: false,
                    lineTension: 0,
                };

                const CAJAS2019 = {
                    label: "2019",
                    data: cajas2019, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                    backgroundColor: 'rgba(230, 109, 23, 1)', // Color de fondo
                    borderColor: 'rgba(230, 109, 23, 1)', // Color del borde
                    borderWidth: 1, // Ancho del borde
                    fill: false,
                    lineTension: 0,
                };

                const CAJAS2020 = {
                    label: "2020",
                    data: cajas2020, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                    backgroundColor: 'rgba(175, 17, 185, 1)', // Color de fondo
                    borderColor: 'rgba(175, 17, 185, 1)', // Color del borde
                    borderWidth: 1, // Ancho del borde
                    fill: false,
                    lineTension: 0,
                };

                var ctxc = document.getElementById("grafico_c_pasado").getContext("2d");
                var myChart = new Chart(ctxc, {
                    type: typpe,
                    data: {
                        labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                        datasets: [
                            CAJAS2018,
                            CAJAS2019,
                            CAJAS2020
                        ]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                },
                            }, ],
                        },
                        title: {
                            display: true,
                            text: 'Producción producidas por mes'
                        }
                    },
                });

                //esto es para desctuir el grafico porque sale un error
                $("canvas#grafica_año").remove();
                $("div.chart_a").append('<canvas id="grafica_año" width="100" height="50"></canvas>');
                ///este es el grafico

                var ctxa = document.getElementById("grafica_año").getContext("2d");
                var myChart = new Chart(ctxa, {
                    type: typpe,
                    data: {
                        labels: [2018, 2019, 2020],
                        datasets: [{
                            label: "Año",
                            data: [235328, 238792, 252519], // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(17, 160, 185, 1)', // Color de fondo
                            borderColor: 'rgba(17, 160, 185, 1)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                            fill: false,
                            lineTension: 0,
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                            },
                        },

                        title: {
                            display: true,
                            text: 'Producción producidas 2018 - 2020'
                        }
                    },
                });
            } else {
                $("canvas#grafico_c_pasado").remove();
                $("canvas#grafica_año").remove();
            }
        });
    }

    grafica_produccion_2023_2025("bar");

    /////////////////
    ////////////////// 
    ////////////////////////////////
    function grafica_produccion_2023_2025(typpe) {
        var año_2023 = [19845,21458,20071,20684,21297,22909,20522,22135,21748,20361,20974,20087];
        var año_2024 = [19913,22265,20918,21571,20224,22876,20529,22182,21835,20487,21740,20193];
        var año_2025 = [20615,23341,21067,21793,20519,22946,20972,22698,22924,20950,21876,20402];

        $("canvas#grafico_1").remove();
        $("div.chart_1").append('<canvas id="grafico_1" width="100" height="50"></canvas>');

        ///este es el grafico
        const CAJAS_2023 = {
            label: "2023",
            data: año_2023, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
            backgroundColor: 'rgba(17, 160, 185, 1)', // Color de fondo
            borderColor: 'rgba(17, 160, 185, 1)', // Color del borde
            borderWidth: 1, // Ancho del borde
            fill: false,
            lineTension: 0,
        };
        const CAJAS_2024 = {
            label: "2024",
            data: año_2024, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
            backgroundColor: 'rgba(230, 109, 23, 1)', // Color de fondo
            borderColor: 'rgba(230, 109, 23, 1)', // Color del borde
            borderWidth: 1, // Ancho del borde
            fill: false,
            lineTension: 0,
        };
        const CAJAS_2025 = {
            label: "2025",
            data: año_2025, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
            backgroundColor: 'rgba(175, 17, 185, 1)', // Color de fondo
            borderColor: 'rgba(175, 17, 185, 1)', // Color del borde
            borderWidth: 1, // Ancho del borde
            fill: false,
            lineTension: 0,
        };

        var ctxb = document.getElementById("grafico_1").getContext("2d");
        var myChart = new Chart(ctxb, {
            type: typpe,
            data: {
                labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                datasets: [
                    CAJAS_2023,
                    CAJAS_2024,
                    CAJAS_2025
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                        },
                    }, ],
                },
                title: {
                    display: true,
                    text: 'Producción por producir mes'
                }
            },
        });

        ///////////////
        ////////////////// 
        var unir_anos_futuro = [];

        let año_2023_l = año_2023.reduce((a, b) => a + b, 0);
        unir_anos_futuro.push(año_2023_l.toString());
        let año_2024_l = año_2024.reduce((a, b) => a + b, 0);
        unir_anos_futuro.push(año_2024_l.toString());
        let año_2025_l = año_2025.reduce((a, b) => a + b, 0);
        unir_anos_futuro.push(año_2025_l.toString());

        $("canvas#grafica_ano_f").remove();
        $("div.chart_ano_f").append('<canvas id="grafica_ano_f" width="100" height="50"></canvas>');

        var ctxd = document.getElementById("grafica_ano_f").getContext("2d");
        var myChart = new Chart(ctxd, {
            type: typpe,
            data: {
                labels: [2023, 2024, 2025],
                datasets: [{
                    label: "Año",
                    data: unir_anos_futuro, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                    backgroundColor: 'rgba(230, 109, 23, 1)', // Color de fondo
                    borderColor: 'rgba(230, 109, 23, 1)', // Color del borde
                    borderWidth: 1, // Ancho del borde
                    fill: false,
                    lineTension: 0,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },

                title: {
                    display: true,
                    text: 'Producción por producir 2023- 2025'
                }
            },
        });
    }


    // var funcion;
    // grafica_fechas();
    // grafica_años();

    // var cajas = [];
    // var cajas2 = [];
    // var cajas3 = [];

    // var tipo_grafico = "bar";
    // var nombre_grafico = "Barra";

    // ////////////////////////////////
    // function grafica_fechas() {
    //     funcion = "grafica_predecir_produccion";
    //     $.ajax({
    //         url: "../../controlador/prediccion/prediccion_new.php",
    //         type: "POST",
    //         data: {
    //             funcion: funcion,
    //         },
    //     }).done(function(response) {
    //         if (response != 0) {
    //             var data = JSON.parse(response);
    //             for (var i = 0; i < data.length; i++) {
    //                 cajas.push(data[i][0]);
    //                 cajas2.push(data[i][1]);
    //                 cajas3.push(data[i][2]);
    //             }

    //             mostrar_graficos_fechas(
    //                 cajas,
    //                 tipo_grafico,
    //                 nombre_grafico,
    //                 cajas2,
    //                 cajas3
    //             );
    //         } else {
    //             $("canvas#grafico_1").remove();
    //         }
    //     });
    // }

    // /////// aqui se ceran las graficas
    // function mostrar_graficos_fechas(
    //     cajas,
    //     tipo_grafico,
    //     nombre_grafico,
    //     cajas2,
    //     cajas3
    // ) {
    //     //esto es para desctuir el grafico porque sale un error
    //     $("canvas#grafico_1").remove();
    //     $("div.chart_1").append(
    //         '<canvas id="grafico_1" width="100" height="30"></canvas>'
    //     );
    //     ///este es el grafico

    //     const cajas1 = {
    //         label: "2023",
    //         data: cajas, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
    //         backgroundColor: 'rgba(17, 160, 185, 1)', // Color de fondo
    //         borderColor: 'rgba(17, 160, 185, 1)', // Color del borde
    //         borderWidth: 1, // Ancho del borde
    //     };
    //     const cajas22 = {
    //         label: "2024",
    //         data: cajas2, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
    //         backgroundColor: 'rgba(230, 109, 23, 1)', // Color de fondo
    //         borderColor: 'rgba(230, 109, 23, 1)', // Color del borde
    //         borderWidth: 1, // Ancho del borde
    //     };
    //     const cajas33 = {
    //         label: "2025",
    //         data: cajas3, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
    //         backgroundColor: 'rgba(175, 17, 185, 1)', // Color de fondo
    //         borderColor: 'rgba(175, 17, 185, 1)', // Color del borde
    //         borderWidth: 1, // Ancho del borde
    //     };

    //     var ctx = document.getElementById("grafico_1").getContext("2d");
    //     var myChart = new Chart(ctx, {
    //         type: tipo_grafico,
    //         data: {
    //             labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
    //             datasets: [
    //                 cajas1,
    //                 cajas22,
    //                 cajas33
    //             ]
    //         },
    //         options: {
    //             scales: {
    //                 yAxes: [{
    //                     ticks: {
    //                         beginAtZero: true,
    //                     },
    //                 }, ],
    //             },
    //             title: {
    //                 display: true,
    //                 text: 'Recobros futuros por mes'
    //             }
    //         },
    //     });
    // }


    // var cajas_año = [];
    // var cajas2_año = [];
    // var cajas3_año = [];

    // ////////////////////////////////
    // function grafica_años() {
    //     funcion = "grafica_predecir_produccion";
    //     $.ajax({
    //         url: "../../controlador/prediccion/prediccion_new.php",
    //         type: "POST",
    //         data: {
    //             funcion: funcion,
    //         },
    //     }).done(function(response) {
    //         if (response != 0) {
    //             var data = JSON.parse(response);
    //             for (var i = 0; i < data.length; i++) {

    //                 cajas.push(data[i][0]);
    //                 cajas_año.push(parseInt(cajas) + parseInt(cajas));

    //                 cajas2.push(data[i][1]);
    //                 cajas2_año.push(parseInt(cajas2) + parseInt(cajas2));

    //                 cajas3.push(data[i][2]);
    //                 cajas3_año.push(parseInt(cajas3) + parseInt(cajas3));

    //             }

    //             mostrar_graficos_años(
    //                 cajas_año,
    //                 tipo_grafico,
    //                 nombre_grafico,
    //                 cajas2_año,
    //                 cajas3_año
    //             );
    //         } else {
    //             $("canvas#grafica_año").remove();
    //         }
    //     });
    // }

    // /////// aqui se ceran las graficas
    // function mostrar_graficos_años(
    //     cajas_año,
    //     tipo_grafico,
    //     nombre_grafico,
    //     cajas2_año,
    //     cajas3_año
    // ) {
    //     //esto es para desctuir el grafico porque sale un error
    //     $("canvas#grafica_año").remove();
    //     $("div.chart_a").append(
    //         '<canvas id="grafica_año" width="100" height="25"></canvas>'
    //     );
    //     ///este es el grafico

    //     const cajas1 = {
    //         label: "2023",
    //         data: cajas_año, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
    //         backgroundColor: 'rgba(17, 160, 185, 1)', // Color de fondo
    //         borderColor: 'rgba(17, 160, 185, 1)', // Color del borde
    //         borderWidth: 1, // Ancho del borde
    //     };
    //     const cajas22 = {
    //         label: "2024",
    //         data: cajas2_año, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
    //         backgroundColor: 'rgba(230, 109, 23, 1)', // Color de fondo
    //         borderColor: 'rgba(230, 109, 23, 1)', // Color del borde
    //         borderWidth: 1, // Ancho del borde
    //     };
    //     const cajas33 = {
    //         label: "2025",
    //         data: cajas3_año, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
    //         backgroundColor: 'rgba(175, 17, 185, 1)', // Color de fondo
    //         borderColor: 'rgba(175, 17, 185, 1)', // Color del borde
    //         borderWidth: 1, // Ancho del borde
    //     };

    //     var ctx = document.getElementById("grafica_año").getContext("2d");
    //     var myChart = new Chart(ctx, {
    //         type: tipo_grafico,
    //         data: {
    //             labels: ["Años"],
    //             datasets: [
    //                 cajas1,
    //                 cajas22,
    //                 cajas33
    //             ]
    //         },
    //         options: {
    //             scales: {
    //                 yAxes: [{
    //                     ticks: {
    //                         beginAtZero: true,
    //                     },
    //                 }, ],
    //             },
    //             title: {
    //                 display: true,
    //                 text: 'Recobros por años'
    //             }
    //         },
    //     });
    // }
</script>
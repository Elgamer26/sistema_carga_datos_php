<?php require "../layout/header.php" ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-chart-area"> </i>
                </div>
                <div>
                    Predicción de producción
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

        <div class="col-lg-12 chart_1">
            <canvas id="grafico_1" width="100" height="30"></canvas>
        </div>

        <div class="col-lg-12 chart_a">
            <canvas id="grafica_año" width="100" height="50"></canvas>
        </div>

    </div>



    <div id="chart-container"></div>

</div>

<?php require "../layout/footer.php" ?>
<script src="../../js/prediccion.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs/dist/tf.min.js"></script>

<script>
    var funcion;
    grafica_fechas();
    grafica_años();

    var cajas = [];
    var cajas2 = [];
    var cajas3 = [];

    var tipo_grafico = "bar";
    var nombre_grafico = "Barra";

    ////////////////////////////////
    function grafica_fechas() {
        funcion = "grafica_predecir_produccion";
        $.ajax({
            url: "../../controlador/prediccion/prediccion_new.php",
            type: "POST",
            data: {
                funcion: funcion,
            },
        }).done(function(response) {
            if (response != 0) {
                var data = JSON.parse(response);
                for (var i = 0; i < data.length; i++) {
                    cajas.push(data[i][0]);
                    cajas2.push(data[i][1]);
                    cajas3.push(data[i][2]);
                }

                mostrar_graficos_fechas(
                    cajas,
                    tipo_grafico,
                    nombre_grafico,
                    cajas2,
                    cajas3
                );
            } else {
                $("canvas#grafico_1").remove();
            }
        });
    }

    /////// aqui se ceran las graficas
    function mostrar_graficos_fechas(
        cajas,
        tipo_grafico,
        nombre_grafico,
        cajas2,
        cajas3
    ) {
        //esto es para desctuir el grafico porque sale un error
        $("canvas#grafico_1").remove();
        $("div.chart_1").append(
            '<canvas id="grafico_1" width="100" height="30"></canvas>'
        );
        ///este es el grafico

        const cajas1 = {
            label: "2023",
            data: cajas, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
            backgroundColor: 'rgba(17, 160, 185, 1)', // Color de fondo
            borderColor: 'rgba(17, 160, 185, 1)', // Color del borde
            borderWidth: 1, // Ancho del borde
        };
        const cajas22 = {
            label: "2024",
            data: cajas2, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
            backgroundColor: 'rgba(230, 109, 23, 1)', // Color de fondo
            borderColor: 'rgba(230, 109, 23, 1)', // Color del borde
            borderWidth: 1, // Ancho del borde
        };
        const cajas33 = {
            label: "2025",
            data: cajas3, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
            backgroundColor: 'rgba(175, 17, 185, 1)', // Color de fondo
            borderColor: 'rgba(175, 17, 185, 1)', // Color del borde
            borderWidth: 1, // Ancho del borde
        };

        var ctx = document.getElementById("grafico_1").getContext("2d");
        var myChart = new Chart(ctx, {
            type: tipo_grafico,
            data: {
                labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                datasets: [
                    cajas1,
                    cajas22,
                    cajas33
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
                    text: 'Recobros futuros por mes'
                }
            },
        });
    }


    var cajas_año = [];
    var cajas2_año = [];
    var cajas3_año = [];

    ////////////////////////////////
    function grafica_años() {
        funcion = "grafica_predecir_produccion";
        $.ajax({
            url: "../../controlador/prediccion/prediccion_new.php",
            type: "POST",
            data: {
                funcion: funcion,
            },
        }).done(function(response) {
            if (response != 0) {
                var data = JSON.parse(response);
                for (var i = 0; i < data.length; i++) {

                    cajas.push(data[i][0]);
                    cajas_año.push(parseInt(cajas) + parseInt(cajas));

                    cajas2.push(data[i][1]);
                    cajas2_año.push(parseInt(cajas2) + parseInt(cajas2));

                    cajas3.push(data[i][2]);
                    cajas3_año.push(parseInt(cajas3) + parseInt(cajas3));

                }

                mostrar_graficos_años(
                    cajas_año,
                    tipo_grafico,
                    nombre_grafico,
                    cajas2_año,
                    cajas3_año
                );
            } else {
                $("canvas#grafica_año").remove();
            }
        });
    }

    /////// aqui se ceran las graficas
    function mostrar_graficos_años(
        cajas_año,
        tipo_grafico,
        nombre_grafico,
        cajas2_año,
        cajas3_año
    ) {
        //esto es para desctuir el grafico porque sale un error
        $("canvas#grafica_año").remove();
        $("div.chart_a").append(
            '<canvas id="grafica_año" width="100" height="25"></canvas>'
        );
        ///este es el grafico

        const cajas1 = {
            label: "2023",
            data: cajas_año, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
            backgroundColor: 'rgba(17, 160, 185, 1)', // Color de fondo
            borderColor: 'rgba(17, 160, 185, 1)', // Color del borde
            borderWidth: 1, // Ancho del borde
        };
        const cajas22 = {
            label: "2024",
            data: cajas2_año, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
            backgroundColor: 'rgba(230, 109, 23, 1)', // Color de fondo
            borderColor: 'rgba(230, 109, 23, 1)', // Color del borde
            borderWidth: 1, // Ancho del borde
        };
        const cajas33 = {
            label: "2025",
            data: cajas3_año, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
            backgroundColor: 'rgba(175, 17, 185, 1)', // Color de fondo
            borderColor: 'rgba(175, 17, 185, 1)', // Color del borde
            borderWidth: 1, // Ancho del borde
        };

        var ctx = document.getElementById("grafica_año").getContext("2d");
        var myChart = new Chart(ctx, {
            type: tipo_grafico,
            data: {
                labels: ["Años"],
                datasets: [
                    cajas1,
                    cajas22,
                    cajas33
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
                    text: 'Recobros por años'
                }
            },
        });
    }
</script>
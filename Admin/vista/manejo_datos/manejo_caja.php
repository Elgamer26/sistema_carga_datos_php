<?php require "../layout/header.php" ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-chart-area"> </i>
                </div>
                <div>
                    Prediccion cajas
                    <div class="page-title-subheading">
                        Prediccion cajas
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <label class="form-label">Prediccion cajas </label>
                <div class="d-inline-block dropdown">
                    <a href="../home/index.php"> / Principal <i class="fa fa-home"></i></a>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="form-row text-center">

        <div class="col-lg-3">
            <label> Año inicio</label> <b><label style="color: red;" id="año_inicio_obligg"></label></b>
            <select class="form-control select2" style="width: 100%;" id="añoinicio"></select>
        </div>

        <div class="col-lg-3">
            <label> Año fin</label> <b><label style="color: red;" id="año_fin_obligg"></label></b>
            <select class="form-control select2" style="width: 100%;" id="añofin"></select>
        </div>

        <div class="col-lg-1">
            <label> Buscar...</label>
            <button onclick="buscar_graficos_años();" class="btn btn-danger"><i class="fa fa-search"></i></button>
        </div>

        <br><br><br><br>

        <div class="col-lg-12 chart_1">
            <canvas id="grafico_1" width="100" height="30"></canvas>
        </div>

        <div class="col-lg-12 chart_1">
            <canvas id="grafico_1" width="100" height="30"></canvas>
        </div>

        <div class="col-lg-6 chart_a">
            <canvas id="grafica_año" width="100" height="50"></canvas>
        </div>

        <div class="col-lg-6 chart_t">
            <canvas id="grafica_tipo" width="100" height="50"></canvas>
        </div>

        <br><br><br><br>

        <div class="col-lg-12 chart_t_a">
            <canvas id="grafica_tipo_año" width="100" height="30"></canvas>
        </div>

        <br><br><br><br>

        <div class="col-lg-12 chart_c">
            <canvas id="grafica_c" width="100" height="30"></canvas>
        </div>

    </div>



    <div id="chart-container"></div>

</div>

<?php require "../layout/footer.php" ?>
<script src="../../js/prediccion.js"></script>

<script>
    var funcion;
    $(".select2").select2();
    grafica_total_años();
    grafica_fechas();
    grafica_tipo_cajas();
    graficos_contener();
    años_cajas();
    grafica_tipo_cajas_años_n();

    /// traer los años subidos en excell
    function años_cajas() {
        funcion = "año_inicio_cajas";
        $.ajax({
            url: "../../controlador/prediccion/prediccion_new.php",
            type: "POST",
            data: {
                funcion: funcion,
            },
        }).done(function(response) {
            var data = JSON.parse(response);
            var cadena = "<option value='0'> --- Seleccione un año --- </option>";
            if (data.length > 0) {
                //bucle para extraer los datos del rol
                for (var i = 0; i < data.length; i++) {

                    cadena +=
                        "<option value='" +
                        data[i][0] +
                        "'> " +
                        data[i][0] +
                        " </option>";
                }
                //aqui concadenamos al id del select
                $("#añoinicio").html(cadena);
                $("#añofin").html(cadena);
            } else {
                cadena += "<option value='0'>No hay año</option>";
                $("#añoinicio").html(cadena);
                $("#añofin").html(cadena);
            }
        });
    }

    ////////////////////////////////
    function grafica_total_años() {
        var tipo_grafico = "doughnut";
        var nombre_grafico = "Dona";
        funcion = "grafica_total_años";
        $.ajax({
            url: "../../controlador/prediccion/prediccion_new.php",
            type: "POST",
            data: {
                funcion: funcion,
            },
        }).done(function(response) {
            if (response != 0) {
                var año = [];
                var cajas = [];
                var colores = [];
                var data = JSON.parse(response);
                for (var i = 0; i < data.length; i++) {
                    año.push(data[i][0]);
                    cajas.push(data[i][1]);
                    colores.push(colores_rgb());
                }
                mostrar_graficos_año(
                    año,
                    cajas,
                    tipo_grafico,
                    nombre_grafico,
                    colores
                );
            } else {
                $("canvas#grafica_año").remove();
            }
        });
    }

    ////////////////////////////////
    function grafica_fechas() {
        var tipo_grafico = "bar";
        var nombre_grafico = "Barra";
        funcion = "grafica_fechas";
        $.ajax({
            url: "../../controlador/prediccion/prediccion_new.php",
            type: "POST",
            data: {
                funcion: funcion,
            },
        }).done(function(response) {
            if (response != 0) {
                var año = [];
                var cajas = [];
                var colores = [];
                var data = JSON.parse(response);
                for (var i = 0; i < data.length; i++) {
                    año.push(data[i][2] + " - " + data[i][3]);
                    cajas.push(data[i][1]);
                    colores.push(colores_rgb());
                }
                mostrar_graficos_fechas(
                    año,
                    cajas,
                    tipo_grafico,
                    nombre_grafico,
                    colores
                );
            } else {
                $("canvas#grafico_1").remove();
            }
        });
    }

    ////////////////////////////////
    function grafica_tipo_cajas() {
        var tipo_grafico = "bar";
        var nombre_grafico = "Barra";
        funcion = "grafica_tipo_cajas";
        $.ajax({
            url: "../../controlador/prediccion/prediccion_new.php",
            type: "POST",
            data: {
                funcion: funcion,
            },
        }).done(function(response) {
            if (response != 0) {
                var tipo = [];
                var cajas = [];
                var colores = [];
                var data = JSON.parse(response);
                for (var i = 0; i < data.length; i++) {
                    tipo.push(data[i][1]);
                    cajas.push(data[i][0]);
                    colores.push(colores_rgb());
                }
                mostrar_graficos_tipo_caja(
                    tipo,
                    cajas,
                    tipo_grafico,
                    nombre_grafico,
                    colores
                );
            } else {
                $("canvas#grafica_tipo").remove();
            }
        });
    }

    ////////////////////////////////
    function grafica_tipo_cajas_años_n() {
        var tipo_grafico = "line";
        var nombre_grafico = "Linea";
        funcion = "grafica_tipo_cajas_años_n";
        $.ajax({
            url: "../../controlador/prediccion/prediccion_new.php",
            type: "POST",
            data: {
                funcion: funcion,
            },
        }).done(function(response) {
            if (response != 0) {
                var tipo = [];
                var cajas = [];
                var colores = [];
                var data = JSON.parse(response);
                for (var i = 0; i < data.length; i++) {
                    tipo.push(data[i][1]);
                    cajas.push(data[i][0]);
                    colores.push(colores_rgb());
                }
                mostrar_graficos_tipo_caja_años(
                    tipo,
                    cajas,
                    tipo_grafico,
                    nombre_grafico,
                    colores
                );
            } else {
                $("canvas#grafica_tipo_año").remove();
            }
        });
    }

    ////////////////////////////////
    function graficos_contener() {
        funcion = "grafica_contenedor";
        $.ajax({
            url: "../../controlador/prediccion/prediccion_new.php",
            type: "POST",
            data: {
                funcion: funcion,
            },
        }).done(function(response) {

            if (response != 0) {
                var nombre = [];
                var caja = [];
                var peso = [];
                var data = JSON.parse(response);

                for (var i = 0; i < data.length; i++) {
                    nombre.push(data[i][0] + " - " + data[i][5] + " " + data[i][4]);
                    caja.push(data[i][1]);
                    peso.push(data[i][2]);
                }

                $("canvas#grafica_c").remove();
                $("div.chart_c").append('<canvas id="grafica_c" width="100" height="30"></canvas>');

                // Obtener una referencia al elemento canvas del DOM
                const grafica_cajas = document.querySelector("#grafica_c");
                // Las etiquetas son las que van en el eje X. 
                const etiquetas_cajas = nombre
                // Podemos tener varios conjuntos de datos
                const data_caja = {
                    label: "Cajas",
                    data: caja, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
                    borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
                    borderWidth: 1, // Ancho del borde
                };
                const data_peso = {
                    label: "Peso",
                    data: peso, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                    backgroundColor: 'rgba(255, 159, 64, 0.2)', // Color de fondo
                    borderColor: 'rgba(255, 159, 64, 1)', // Color del borde
                    borderWidth: 1, // Ancho del borde
                };

                new Chart(grafica_cajas, {
                    type: 'bar', // Tipo de gráfica
                    data: {
                        labels: etiquetas_cajas,
                        datasets: [
                            data_caja,
                            data_peso,
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
                            text: 'Contenedor'
                        }
                    }
                });

            } else {
                $("canvas#grafica_c").remove();
            }

        });
    }


    ////
    ///
    // buscar por años
    function buscar_graficos_años() {
        var año1 = $("#añoinicio").val();
        var año2 = $("#añofin").val();

        if (año1 == "0" || año2 == "0") {
            $("#año_inicio_obligg").html("Debe seleccionar años");
            $("#año_fin_obligg").html("Debe seleccionar años");
            return swal.fire(
                "No hay años",
                "Debe seleccionar años",
                "warning"
            );
        } else {
            $("#año_fin_obligg").html("");
            $("#año_inicio_obligg").html("");
        }

        if (año2 < año1) {
            $("#año_fin_obligg").html("Años incorrectos");
            $("#año_inicio_obligg").html("Años incorrectos");
            return swal.fire(
                "Años incorrectos",
                "El año fin no debe ser mayo al año inicio",
                "warning"
            );
        } else {
            $("#año_inicio_obligg").html("");
            $("#año_fin_obligg").html("");
        }

        grafica_total_años_años(año1, año2);
        grafica_fechas_años(año1, año2);
        grafica_tipo_cajas_años(año1, año2);
        graficos_contener_anos(año1, año2);
        grafica_tipo_cajas_años_n_buscar(año1, año2);
    }

    ////////////////////////////////
    function grafica_total_años_años(año1, año2) {
        var tipo_grafico = "doughnut";
        var nombre_grafico = "Dona";
        funcion = "grafica_total_años_años";
        $.ajax({
            url: "../../controlador/prediccion/prediccion_new.php",
            type: "POST",
            data: {
                funcion: funcion,
                año1: año1,
                año2: año2
            },
        }).done(function(response) {
            if (response != 0) {
                var año = [];
                var cajas = [];
                var colores = [];
                var data = JSON.parse(response);
                for (var i = 0; i < data.length; i++) {
                    año.push(data[i][0]);
                    cajas.push(data[i][1]);
                    colores.push(colores_rgb());
                }
                mostrar_graficos_año(
                    año,
                    cajas,
                    tipo_grafico,
                    nombre_grafico,
                    colores
                );
            } else {
                $("canvas#grafica_año").remove();
            }
        });
    }

    ////////////////////////////////
    function grafica_fechas_años(año1, año2) {
        var tipo_grafico = "bar";
        var nombre_grafico = "Barra";
        funcion = "grafica_fechas_años";
        $.ajax({
            url: "../../controlador/prediccion/prediccion_new.php",
            type: "POST",
            data: {
                funcion: funcion,
                año1: año1,
                año2: año2
            },
        }).done(function(response) {
            if (response != 0) {
                var año = [];
                var cajas = [];
                var colores = [];
                var data = JSON.parse(response);
                for (var i = 0; i < data.length; i++) {
                    año.push(data[i][2] + " - " + data[i][3]);
                    cajas.push(data[i][1]);
                    colores.push(colores_rgb());
                }
                mostrar_graficos_fechas(
                    año,
                    cajas,
                    tipo_grafico,
                    nombre_grafico,
                    colores
                );
            } else {
                $("canvas#grafico_1").remove();
            }
        });
    }

    ////////////////////////////////
    function grafica_tipo_cajas_años(año1, año2) {
        var tipo_grafico = "bar";
        var nombre_grafico = "Barra";
        funcion = "grafica_tipo_cajas_años";
        $.ajax({
            url: "../../controlador/prediccion/prediccion_new.php",
            type: "POST",
            data: {
                funcion: funcion,
                año1: año1,
                año2: año2
            },
        }).done(function(response) {
            if (response != 0) {
                var tipo = [];
                var cajas = [];
                var colores = [];
                var data = JSON.parse(response);
                for (var i = 0; i < data.length; i++) {
                    tipo.push(data[i][1]);
                    cajas.push(data[i][0]);
                    colores.push(colores_rgb());
                }
                mostrar_graficos_tipo_caja(
                    tipo,
                    cajas,
                    tipo_grafico,
                    nombre_grafico,
                    colores
                );
            } else {
                $("canvas#grafica_tipo").remove();
            }
        });
    }

    ////////////////////////////////
    function grafica_tipo_cajas_años_n_buscar(año1, año2) {
        var tipo_grafico = "line";
        var nombre_grafico = "Linea";
        funcion = "grafica_tipo_cajas_años_n_buscar";
        $.ajax({
            url: "../../controlador/prediccion/prediccion_new.php",
            type: "POST",
            data: {
                funcion: funcion,
                año1: año1,
                año2: año2
            },
        }).done(function(response) {
            if (response != 0) {
                var tipo = [];
                var cajas = [];
                var colores = [];
                var data = JSON.parse(response);
                for (var i = 0; i < data.length; i++) {
                    tipo.push(data[i][1]);
                    cajas.push(data[i][0]);
                    colores.push(colores_rgb());
                }
                mostrar_graficos_tipo_caja_años(
                    tipo,
                    cajas,
                    tipo_grafico,
                    nombre_grafico,
                    colores
                );
            } else {
                $("canvas#grafica_tipo_año").remove();
            }
        });
    }

    ////////////////////////////////
    function graficos_contener_anos(año1, año2) {
        funcion = "graficos_contener_anos";
        $.ajax({
            url: "../../controlador/prediccion/prediccion_new.php",
            type: "POST",
            data: {
                funcion: funcion,
                año1: año1,
                año2: año2
            },
        }).done(function(response) {

            if (response != 0) {
                var nombre = [];
                var caja = [];
                var peso = [];
                var data = JSON.parse(response);

                for (var i = 0; i < data.length; i++) {
                    nombre.push(data[i][0] + " - " + data[i][5] + " " + data[i][4]);
                    caja.push(data[i][1]);
                    peso.push(data[i][2]);
                }

                $("canvas#grafica_c").remove();
                $("div.chart_c").append('<canvas id="grafica_c" width="100" height="30"></canvas>');

                // Obtener una referencia al elemento canvas del DOM
                const grafica_cajas = document.querySelector("#grafica_c");
                // Las etiquetas son las que van en el eje X. 
                const etiquetas_cajas = nombre
                // Podemos tener varios conjuntos de datos
                const data_caja = {
                    label: "Cajas",
                    data: caja, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
                    borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
                    borderWidth: 1, // Ancho del borde
                };
                const data_peso = {
                    label: "Peso",
                    data: peso, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                    backgroundColor: 'rgba(255, 159, 64, 0.2)', // Color de fondo
                    borderColor: 'rgba(255, 159, 64, 1)', // Color del borde
                    borderWidth: 1, // Ancho del borde
                };

                new Chart(grafica_cajas, {
                    type: 'bar', // Tipo de gráfica
                    data: {
                        labels: etiquetas_cajas,
                        datasets: [
                            data_caja,
                            data_peso,
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
                            text: 'Contenedor'
                        }
                    }
                });

            } else {
                $("canvas#grafica_c").remove();
            }

        });
    }


    /////// aqui se ceran las graficas
    function mostrar_graficos_año(
        año,
        cajas,
        tipo_grafico,
        nombre_grafico,
        colores
    ) {
        //esto es para desctuir el grafico porque sale un error
        $("canvas#grafica_año").remove();
        $("div.chart_a").append(
            '<canvas id="grafica_año" width="100" height="50"></canvas>'
        );
        ///este es el grafico


        var ctx = document.getElementById("grafica_año").getContext("2d");
        var myChart = new Chart(ctx, {
            type: tipo_grafico,
            data: {
                labels: año,
                datasets: [{
                    label: nombre_grafico,
                    data: cajas,
                    backgroundColor: colores,
                    borderColor: colores,
                    borderWidth: 1,
                }, ],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                    
                },
                title: {
                    display: true,
                    text: 'Total de cajas por año'
                },
                // tooltips: {
                //     mode: 'x',
                //     intersect: true,
                // },
                // legend: {
                //     display: true
                // },
            },
        });
    }

    function mostrar_graficos_fechas(
        año,
        cajas,
        tipo_grafico,
        nombre_grafico,
        colores
    ) {
        //esto es para desctuir el grafico porque sale un error
        $("canvas#grafico_1").remove();
        $("div.chart_1").append(
            '<canvas id="grafico_1" width="100" height="30"></canvas>'
        );
        ///este es el grafico

        var ctx = document.getElementById("grafico_1").getContext("2d");
        var myChart = new Chart(ctx, {
            type: tipo_grafico,
            data: {
                labels: año,
                datasets: [{
                    label: nombre_grafico,
                    data: cajas,
                    backgroundColor: 'rgba(255, 159, 64, 0.2)', // Color de fondo
                    borderColor: 'rgba(255, 159, 64, 1)', // Color del borde
                    borderWidth: 1, // Ancho del borde
                }, ],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
                title: {
                    display: true,
                    text: 'Cajas por fechas'
                }
            },
        });
    }

    function mostrar_graficos_tipo_caja(
        tipo,
        cajas,
        tipo_grafico,
        nombre_grafico,
        colores
    ) {
        //esto es para desctuir el grafico porque sale un error
        $("canvas#grafica_tipo").remove();
        $("div.chart_t").append(
            '<canvas id="grafica_tipo" width="100" height="50"></canvas>'
        );
        ///este es el grafico

        var ctx = document.getElementById("grafica_tipo").getContext("2d");
        var myChart = new Chart(ctx, {
            type: tipo_grafico,
            data: {
                labels: tipo,
                datasets: [{
                    label: nombre_grafico,
                    data: cajas,
                    backgroundColor: colores,
                    borderColor: colores,
                    borderWidth: 1, // Ancho del borde
                }, ],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
                title: {
                    display: true,
                    text: 'Tipo de cajas total'
                }
            },
        });
    }

    function mostrar_graficos_tipo_caja_años(
        tipo,
        cajas,
        tipo_grafico,
        nombre_grafico,
        colores
    ) {
        //esto es para desctuir el grafico porque sale un error
        $("canvas#grafica_tipo_año").remove();
        $("div.chart_t_a").append(
            '<canvas id="grafica_tipo_año" width="100" height="30"></canvas>'
        );
        ///este es el grafico

        var ctx = document.getElementById("grafica_tipo_año").getContext("2d");
        var myChart = new Chart(ctx, {
            type: tipo_grafico,
            data: {
                labels: tipo,
                datasets: [{
                    label: nombre_grafico,
                    data: cajas,
                    backgroundColor: 'rgba(134, 321, 56, 0.2)', // Color de fondo
                    borderColor: 'rgba(23, 213, 67, 2)', // Color del borde
                    borderWidth: 1, // Ancho del borde
                }, ],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
                title: {
                    display: true,
                    text: 'Tipo de cajas total por año'
                }
            },
        });
    }
</script>
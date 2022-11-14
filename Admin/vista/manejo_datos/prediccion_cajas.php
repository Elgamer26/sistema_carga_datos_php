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

    <div class="form-row text-center">

        <div class="col-lg-8" style="width: 100%;">
            <label> Excel cargado al sistema</label> <b><label style="color: red;" id="selec_fila_excel_obligg"></label></b>
            <select class="form-control excel_cajas" style="width: 100%;" id="excel_cajas"></select>
        </div>

        <div class="col-lg-1" style="width: 100%;">
            <labe> Ver data</label>
                <button onclick="llamar_dato_grafica();" class="btn btn-danger"><i class="fa fa-search"></i></button>
                <br>
                <br>
        </div>
        <br>

        <div class="col-lg-12 chart_c">
            <canvas id="grafica" width="100" height="30"></canvas>
        </div>

        <hr>

        <div class="col-lg-12 chart_c_1">
            <canvas id="grafica_1" width="100" height="30"></canvas>
        </div>

    </div>

    <div id="chart-container"></div>

</div>

<?php require "../layout/footer.php" ?>
<script src="../../js/prediccion.js"></script>

<script>
    var funcion;

    $(".excel_cajas").select2();
    listar_archivos_cajas_excel();

    function listar_archivos_cajas_excel() {
        funcion = "cargar_excel_cajas_";
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
                $("#excel_cajas").html(cadena);
            } else {
                cadena += "<option value='0'>No hay data</option>";
                $("#excel_cajas").html(cadena);
            }
        });
    }

    function llamar_dato_grafica() {
        var id = $("#excel_cajas").val();
        funcion = 'llamar_dato_grafica';

        if (id == 0) {
            $("canvas#grafica").remove();
            $("canvas#grafica_1").remove();
            // $("canvas#grafica_2").remove();
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
                var nombre = [];
                var caja_1 = [];
                var caja_2 = [];
                var data = JSON.parse(response);

                for (var i = 0; i < data.length; i++) {
                    nombre.push(data[i][0]);
                    caja_1.push(data[i][1]);
                    caja_2.push(data[i][2]);
                }

                $("canvas#grafica").remove();
                $("div.chart_c").append('<canvas id="grafica" width="100" height="30"></canvas>');

                // Obtener una referencia al elemento canvas del DOM
                const grafica_cajas = document.querySelector("#grafica");
                // Las etiquetas son las que van en el eje X. 
                const etiquetas_cajas = nombre
                // Podemos tener varios conjuntos de datos
                const data_cajas_1 = {
                    label: "Cajas 1",
                    data: caja_1, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
                    borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
                    borderWidth: 1, // Ancho del borde
                };
                const data_cajas_2 = {
                    label: "Cajas 2",
                    data: caja_2, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                    backgroundColor: 'rgba(255, 159, 64, 0.2)', // Color de fondo
                    borderColor: 'rgba(255, 159, 64, 1)', // Color del borde
                    borderWidth: 1, // Ancho del borde
                };

                new Chart(grafica_cajas, {
                    type: 'line', // Tipo de gráfica
                    data: {
                        labels: etiquetas_cajas,
                        datasets: [
                            data_cajas_1,
                            data_cajas_2,
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
                            text: 'DATOS DE CAJAS'
                        }
                    }
                });

                ///////////////
                ///////////////

                funcion = 'llamar_total_grafica';
                $.ajax({
                    type: "POST",
                    url: "../../controlador/prediccion/prediccion.php",
                    data: {
                        funcion: funcion,
                        id: id
                    },
                    success: function(response_t) {

                        var nombre_t = [];
                        var caja_1_t = [];
                        var caja_2_t = [];
                        var data_t = JSON.parse(response_t);

                        for (var i = 0; i < data_t.length; i++) {
                            nombre_t.push(data_t[i][0]);
                            caja_1_t.push(data_t[i][1]);
                            caja_2_t.push(data_t[i][2]);
                        }

                        $("canvas#grafica_1").remove();
                        $("div.chart_c_1").append('<canvas id="grafica_1" width="100" height="30"></canvas>');

                        // Obtener una referencia al elemento canvas del DOM
                        const grafica_total = document.querySelector("#grafica_1");
                        // Las etiquetas son las que van en el eje X. 
                        const etiquetas_1 = nombre_t

                        const tota_cajas_1 = {
                            label: "Cajas 1",
                            data: caja_1_t, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
                            borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };
                        const total_cajas2 = {
                            label: "Cajas 2",
                            data: caja_2_t, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                            backgroundColor: 'rgba(255, 159, 64, 0.2)', // Color de fondo
                            borderColor: 'rgba(255, 159, 64, 1)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };

                        // Podemos tener varios conjuntos de datos
                        new Chart(grafica_total, {
                            type: 'line', // Tipo de gráfica
                            data: {
                                labels: etiquetas_1,
                                datasets: [
                                    tota_cajas_1,
                                    total_cajas2
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
                                    text: 'Total de cajas por su tipo'
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
            }

        });
    }
</script>
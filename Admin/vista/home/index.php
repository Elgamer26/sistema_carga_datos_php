<?php require "../layout/header.php" ?>

<div class="app-main__inner">
    <div class="row">
        <div class="col-md-3 col-xl-3">
            <div class="card mb-3 widget-content bg-midnight-bloom">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Trabajadores</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white">
                            <span id="id_trabajador">0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xl-3">
            <div class="card mb-3 widget-content bg-arielle-smile">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Insumos</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white">
                            <span id="id_insumo">0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xl-3">
            <div class="card mb-3 widget-content bg-grow-early">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Herramientas</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white">
                            <span id="id_herramienta">0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xl-3">
            <div class="card mb-3 widget-content bg-premium-dark">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Producciones</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-warning">
                            <span id="id_producciones">0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12 col-lg-6">
            <div class="mb-3 card">
                <div class="card-header-tab card-header-tab-animation card-header">
                    <div class="card-header-title">
                        <i class="header-icon lnr-apartment icon-gradient bg-love-kiss">
                        </i>
                        Las 5 herramientas mas usadas
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tabs-eg-77">
                            <div class="card mb-3 widget-chart widget-chart2 text-left w-100">
                                <div class="widget-chat-wrapper-outer">
                                    <div class="widget-chart-wrapper widget-chart-wrapper-lg opacity-10 m-0">

                                        <div class="chart_h">
                                            <canvas id="canvas_h"></canvas>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-12 col-lg-6">
            <div class="mb-3 card">
                <div class="card-header-tab card-header-tab-animation card-header">
                    <div class="card-header-title">
                        <i class="header-icon lnr-apartment icon-gradient bg-love-kiss">
                        </i>
                        Los 5 insumos mas usadas
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tabs-eg-77">
                            <div class="card mb-3 widget-chart widget-chart2 text-left w-100">
                                <div class="widget-chat-wrapper-outer">
                                    <div class="widget-chart-wrapper widget-chart-wrapper-lg opacity-10 m-0">

                                        <div class="chart_i">
                                            <canvas id="canvas_i"></canvas>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php require "../layout/footer.php" ?>

<script>
    llamar_etiquetas();
    herramientas_usadas();
    insumos_usadas();

    function llamar_etiquetas() {
        funcion = "llamar_etiquetas";
        $.ajax({
            type: "POST",
            url: "../../controlador/system/system.php",
            data: {
                funcion: funcion
            },
            success: function(response) {
                var data = JSON.parse(response);
                $("#id_trabajador").html(data[0]['trabajador']);
                $("#id_insumo").html(data[0]['insumos']);
                $("#id_herramienta").html(data[0]['herramienta']);
                $("#id_producciones").html(data[0]['produccion']);
            }
        });
    }

    ////////////////////////////////
    function herramientas_usadas() {
        var tipo_grafico = "doughnut";
        var nombre_grafico_h = "Dona";
        funcion = "herramientas_usadas";

        $.ajax({
            url: "../../controlador/system/system.php",
            type: "POST",
            data: {
                funcion: funcion,
            },
        }).done(function(response) {
            if (response != 0) {
                var nombre_h = [];
                var cantidad_h = [];
                var colores_h = [];
                var data = JSON.parse(response);
                for (var i = 0; i < data.length; i++) {
                    nombre_h.push(data[i][0]);
                    cantidad_h.push(data[i][1]);
                    colores_h.push(colores_rgb());
                }
                mostrar_graficos_cinco_herramientas(
                    nombre_h,
                    cantidad_h,
                    tipo_grafico,
                    nombre_grafico_h,
                    colores_h
                );
            } else {
                $("canvas#canvas_h").remove();
            }
        });
    }

    function mostrar_graficos_cinco_herramientas(
        nombre_pr,
        cantidad,
        tipo_grafico,
        nombre_grafico,
        colores
    ) {
        //esto es para desctuir el grafico porque sale un error
        $("canvas#canvas_h").remove();
        $("div.chart_h").append('<canvas id="canvas_h" width="40" height="30"></canvas>');
        ///este es el grafico

        var ctx = document.getElementById("canvas_h");
        var myChart = new Chart(ctx, {
            type: tipo_grafico,
            data: {
                labels: nombre_pr,
                datasets: [{
                    label: nombre_grafico,
                    data: cantidad,
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
            },
        });
    }

    ////////////////////////////////
    function insumos_usadas() {
        var tipo_grafico = "pie";
        var nombre_grafico_i = "Pastel";
        funcion = "insumos_usadas";

        $.ajax({
            url: "../../controlador/system/system.php",
            type: "POST",
            data: {
                funcion: funcion,
            },
        }).done(function(response) {
            if (response != 0) {
                var nombre_i = [];
                var cantidad_i = [];
                var colores_i = [];
                var data = JSON.parse(response);
                for (var i = 0; i < data.length; i++) {
                    nombre_i.push(data[i][0]);
                    cantidad_i.push(data[i][1]);
                    colores_i.push(colores_rgb());
                }
                mostrar_graficos_cinco_insumos(
                    nombre_i,
                    cantidad_i,
                    tipo_grafico,
                    nombre_grafico_i,
                    colores_i
                );
            } else {
                $("canvas#canvas_i").remove();
            }
        });
    }

    function mostrar_graficos_cinco_insumos(
        nombre_pr,
        cantidad,
        tipo_grafico,
        nombre_grafico,
        colores
    ) {
        //esto es para desctuir el grafico porque sale un error
        $("canvas#canvas_i").remove();
        $("div.chart_i").append('<canvas id="canvas_i" width="40" height="30"></canvas>');
        ///este es el grafico

        var ctx = document.getElementById("canvas_i");
        var myChart = new Chart(ctx, {
            type: tipo_grafico,
            data: {
                labels: nombre_pr,
                datasets: [{
                    label: nombre_grafico,
                    data: cantidad,
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
            },
        });
    }
</script>
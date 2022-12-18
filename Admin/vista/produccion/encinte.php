<?php require "../layout/header.php" ?>

<?php
date_default_timezone_set('America/Guayaquil');
$fecha = date("Y-m-d");
?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-tags"> </i>
                </div>
                <div>
                    Nuevo registro de cintas
                    <div class="page-title-subheading">
                        Crear nuevo registro de cintas.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <label class="form-label">Registro de cintas</label>
                <div class="d-inline-block dropdown">
                </div> <a href="../home/index.php"> / Principal <i class="fa fa-home"></i></a> </a>
            </div>
        </div>
    </div>

    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-title">Registro de cintas.</h5>

            <div class="row align-items-center">

                <div class="col-sm-8 form-group">
                    <label>Seleccione producción</label> &nbsp;&nbsp; <label style="color:red;" id="prodcuciion_id_oblig"></label>
                    <select class="prodcuciion_id form-control" id="prodcuciion_id"> </select>
                </div>

                <div class="col-sm-2 form-group">
                    <label>Semana</label> &nbsp;&nbsp; <label style="color:red;" id="n_semana_oblig"></label>
                    <input type="text" class="form-control" id="n_semana" disabled>
                </div>

                <div class="col-sm-2 form-group">
                    <label>Seleccione la fecha</label> &nbsp;&nbsp; <label style="color:red;" id="fecha_oblig"></label>
                    <input type="date" class="form-control calendario" id="fecha" value="<?php echo $fecha ?>">
                </div>

                <div class="col-sm-9 form-group">
                    <label>Detalle</label> &nbsp;&nbsp; <label style="color:red;" id="detalle_oblig"></label>
                    <input type="text" class="form-control" id="detalle">
                </div>

                <div class="col-md-3 p-1">
                    <button onclick="registro_encinte();" class="btn btn-primary">
                        <i class="fa fa-save"></i> Registrar
                    </button> -
                    <a href="../produccion/encinte.php" class="btn btn-danger">Recargar</a>
                </div>

                <table id="tabala_semanas" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                    <thead bgcolor="purple" style="color:#fff;">
                        <tr>
                            <th style="width: 35px;">#</th>
                            <th>Semana</th>
                            <th>Color</th>
                            <th>Fecha registro</th>
                            <th>Detalle</th>
                            <th style="width: 45px;">Accion</th>
                        </tr>
                    </thead>

                    <tbody id="tbody_tabala_semanas">

                    </tbody>

                    <tfoot bgcolor="purple" style="color:#fff;">
                        <tr>
                            <th style="width: 35px;">#</th>
                            <th>Semana</th>
                            <th>Color</th>
                            <th>Fecha registro</th>
                            <th>Detalle</th>
                            <th style="width: 45px;">Accion</th>
                        </tr>
                    </tfoot>
                </table>

            </div>

        </div>
    </div>
</div>

<?php require "../layout/footer.php" ?>
<script src="../../js/produccion.js"></script>

<script>
    mostar_fecha(fecha_atras, fecha_adelante);

    $(".prodcuciion_id").select2();
    listar_produccion_combo();

    function listar_produccion_combo() {
        funcion = "listar_produccion_combo";
        $.ajax({
            url: "../../controlador/produccion/produccion.php",
            type: "POST",
            data: {
                funcion: funcion,
            },
        }).done(function(response) {
            var data = JSON.parse(response);
            var cadena = "<option value='0'> --- Seleccione la producción --- </option>";
            if (data.length > 0) {
                //bucle para extraer los datos del rol
                for (var i = 0; i < data.length; i++) {
                    cadena +=
                        "<option value='" + data[i][0] + "'> " + data[i][1] + " - " + data[i][2] + " </option>";
                }
                //aqui concadenamos al id del select
                $("#prodcuciion_id").html(cadena);
            } else {
                cadena += "<option value='0'>No hay producción</option>";
                $("#prodcuciion_id").html(cadena);
            }
        });
    }

    $("#prodcuciion_id").on("change", function() {
        var id = $(this).val();

        semanas_produccion(id);
    });

    function semanas_produccion(id) {
        if (id == 0 || id.length == 0) {
            return $("#n_semana").val("");
        }

        funcion = "traer_cantidad_semanas_produccion";
        $.ajax({
            url: "../../controlador/produccion/produccion.php",
            type: "POST",
            data: {
                funcion: funcion,
                id: id,
            },
        }).done(function(resp) {
            if (resp != 0) {
                var data = JSON.parse(resp);
                $("#n_semana").val(data[0]);
            } else {
                $("#n_semana").val("");
            }
        });
    }

    $("#prodcuciion_id").on("change", function() {
        var id = $(this).val();
        detalle_encinte_produccion(id);
    });

    function detalle_encinte_produccion(id) {
        if (id == 0 || id.length == 0) {
            $("#n_semana").val("");
            return $("#tbody_tabala_semanas").empty();
        }

        var numero = $("#n_semana").val();
        var n = parseInt(numero) + 1;

        funcion = "cargar_detalle_encinte_produccion";
        $.ajax({
            url: "../../controlador/produccion/produccion.php",
            type: "POST",
            data: {
                funcion: funcion,
                id: id,
            },
        }).done(function(resp) {
            if (resp != 0) {
                var data = JSON.parse(resp);
                var llenat = "";
                var count = 0;
                var boton = "";
                data["data"].forEach((row) => {
                    count++;
                    if (parseInt(n) != parseInt(count)) {
                        boton = "<button class='btn btn-default'> <i class='fa fa-check'></i></button>";
                    } else {
                        boton = "<button class='btn btn-danger' onclick='eliminar_detalle_cinta(" + row['id'] + ", " + row['produccion_id'] + ");'><i class='fa fa-trash'></i></button>";
                    }
                    llenat += `<tr>
                    <td>${count}</td>  
                    <td>${row["semana"]}</td> 
                    <td style="text-align: center;"><input type='color' value='${row["color"]}' disabled></td>
                    <td>${row["fecha"]}</td> 
                    <td>${row["detalle"]}</td>  
                    <td style="text-align: center;">${boton}</td>   
                    </tr>`;

                    $("#tbody_tabala_semanas").html(llenat);
                });
            } else {
                $("#tbody_tabala_semanas").empty();
            }
        });
    }
</script>
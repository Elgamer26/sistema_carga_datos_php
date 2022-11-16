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
                    <i class="fa fa-box"> </i>
                </div>
                <div>
                    Registro fruta
                    <div class="page-title-subheading">
                    Registro fruta
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <label class="form-label">Registro fruta</label>
                <div class="d-inline-block dropdown">
                    <a href="../produccion/produccion.php"> / Listado de lotes </a>
                </div> <a href="../home/index.php"> / Principal <i class="fa fa-home"></i></a>
            </div>
        </div>
    </div>

    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-title">Registro fruta</h5>

            <div class="form-row text-center">

                <div class="col-sm-12 form-group">
                    <label>Seleccione producción</label> &nbsp;&nbsp; <label style="color:red;" id="prodcuciion_id_oblig"></label>
                    <select class="prodcuciion_id form-control" id="prodcuciion_id"> </select>
                </div>

                <div class="col-sm-2 form-group">
                    <label>Seleccione la fecha</label> &nbsp;&nbsp; <label style="color:red;" id="fecha_ras_des_oblig"></label>
                    <input type="date" class="calendario form-control" value="<?php echo $fecha; ?>" id="fecha_ras_des">
                </div>

                <div class="col-sm-2 form-group">
                    <label>Seleccione tipo</label> &nbsp;&nbsp; <label style="color:red;" id="tipo_ses_oblig"></label>
                    <select class="form-control" id="tipo_ses">
                        <option value="0">-----------</option>
                        <option value="Racimos">Racimos</option>
                        <option value="Desechos">Desechos</option>
                    </select>
                </div>

                <div class="col-sm-3 form-group">
                    <label>Cantidad fruta</label> &nbsp;&nbsp; <label style="color:red;" id="cantidad_oblig"></label>
                    <input type="text" maxlength="10" class="form-control" id="numero_ra" placeholder="Ingrese cantidad" onkeypress="return soloNumeros(event)">
                </div>

                <div class="col-md-12 mx-auto p-3">
                    <button onclick="guardr_racimos();" class="btn btn-primary" type="submit">
                        <i class="fa fa-save"></i> Registrar
                    </button> -
                    <a href="../produccion/list_frutas.php" class="btn btn-danger">Volver</a>
                </div>
            </div>

        </div>
    </div>
</div>

<?php require "../layout/footer.php" ?>
<script src="../../js/produccion.js"></script>

<script>
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
</script>
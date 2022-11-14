<?php require "../layout/header.php" ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-cubes"> </i>
                </div>
                <div>
                    Nuevo lote
                    <div class="page-title-subheading">
                        Crear lote.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <label class="form-label">Nuevo lote</label>
                <div class="d-inline-block dropdown">
                    <a href="../produccion/lotes.php"> / Listado de lotes </a>
                </div> <a href="../home/index.php"> / Principal <i class="fa fa-home"></i></a>
            </div>
        </div>
    </div>

    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-title">Nuevo lote.</h5>

            <div class="form-row text-center">
                <div class="col-md-6 mx-auto">
                    <label for="lote">Nombre lote</label> <b><label style="color: red;" id="lote_obligg"></label></b>
                    <input type="text" class="form-control" id="lote" placeholder="Ingrese el nombre del lote" />
                </div>

                <div class="col-md-12 mx-auto">
                    <hr>
                    <div class="row">

                        <div class="col-sm-6 mx-auto">
                            <label>Hectárea</label> &nbsp;&nbsp; <label style="color:red;" id="hectárea_obliga"></label>
                            <div class="input-group mb-6">
                                <input type="text" class="form-control" maxlength="8" onkeypress="return soloNumeros(event)" id="hectarea" placeholder="Ingrese hectárea">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary" onclick="ingresar_hectareas();"><i class="fa fa-download"></i> Agregar</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 mx-auto">
                            <table id="taba_hectareas" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                <thead bgcolor="purple" style="color:#fff;">
                                    <tr>
                                        <th>Hectareas</th>
                                        <th>Accion</th>
                                    </tr>
                                </thead>

                                <tbody id="tbody_taba_hectareasl">

                                </tbody>

                                <tfoot bgcolor="purple" style="color:#fff;">
                                    <tr>
                                        <th>Hectareas</th>
                                        <th>Accion</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>

                </div>

                <div class="col-md-12 mx-auto p-3">
                    <button onclick="guardar_lotes();" class="btn btn-primary" type="submit">
                        <i class="fa fa-save"></i> Registrar
                    </button> -
                    <a href="../produccion/lotes.php" class="btn btn-danger">Volver</a>
                </div>
            </div>

        </div>
    </div>
</div>

<?php require "../layout/footer.php" ?>
<script src="../../js/produccion.js"></script>

<script>
    function ingresar_hectareas() {

        var hectarea = $("#hectarea").val();
        var hec = "";

        if (hectarea.length == 0 || hectarea.trim() == "") {
            $("#hectárea_obliga").html(" - Ingrese la hectarea")
            return swal.fire(
                "Campo vacios",
                "Ingrese la hectarea",
                "warning"
            );
        } else {
            $("#hectárea_obliga").html("")
        }

        hec = "H" + hectarea;

        if (verificar_hectarea(hec)) {
            return Swal.fire(
                "Mensaje de advertencia",
                "La hectarea '" + hec + "', ya fue agregado al detalle",
                "warning"
            );
        }

        var datos_agg = "<tr>";
        datos_agg += "<td for='id'>" + hec + "</td>"; +
        "</td>";
        datos_agg +=
            "<td><button onclick='remomver_hectrea(this)' class='btn btn-danger'><i class='fa fa-trash'></i></button></td>";
        datos_agg += "</tr>";

        $("#tbody_taba_hectareasl").append(datos_agg);
        $("#hectarea").val("");
    }

    function remomver_hectrea(t) {
        var td = t.parentNode;
        var tr = td.parentNode;
        var table = tr.parentNode;
        table.removeChild(tr);
    }

    function verificar_hectarea(id) {
        let idverificar = document.querySelectorAll(
            "#tbody_taba_hectareasl td[for='id']"
        );
        return [].filter.call(idverificar, (td) => td.textContent == id).length == 1;
    }
</script>
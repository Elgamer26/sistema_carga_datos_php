<?php require "../layout/header.php" ?>

<style>
    input[type="checkbox"] {
        position: relative;
        width: 60px;
        height: 30px;
        -webkit-appearance: none;
        background: rgb(168, 168, 168);
        outline: none;
        border-radius: 15px;
        box-shadow: inset 0 0 5px rgba(0, 0, 0, .5);
    }

    input:checked[type="checkbox"] {
        background: rgb(51 255 0);
    }

    input[type="checkbox"]:before {
        content: "";
        position: absolute;
        width: 30px;
        height: 30px;
        border-radius: 20px;
        top: 0;
        left: 0;
        background: white;
        transition: 0.5s;

    }

    input:checked[type="checkbox"]:before {
        left: 30px;
    }
</style>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-cube"> </i>
                </div>
                <div>
                    Nueva producción
                    <div class="page-title-subheading">
                        Crear producción.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <label class="form-label">Nueva producción</label>
                <div class="d-inline-block dropdown">
                    <a href="../produccion/produccion.php"> / Listado de lotes </a>
                </div> <a href="../home/index.php"> / Principal <i class="fa fa-home"></i></a>
            </div>
        </div>
    </div>

    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-title">Nueva producción.</h5>

            <div class="form-row text-center">
                <div class="col-md-6 mx-auto">
                    <label for="produccion">Nombre de producción</label> <b><label style="color: red;" id="produccion_obligg"></label></b>
                    <input type="text" class="form-control" id="produccion" placeholder="Ingrese nombre de producción" />
                </div>

                <div class="col-md-3 mx-auto">
                    <label for="fecha_i">Fecha inicio</label> <b><label style="color: red;" id="fecha_i_obligg"></label></b>
                    <input type="date" class="form-control calendario" id="fecha_i" />
                </div>

                <div class="col-md-3 mx-auto">
                    <label for="fecha_f">Fecha fin</label> <b><label style="color: red;" id="fecha_f_obligg"></label></b>
                    <input type="date" class="form-control calendariomas" id="fecha_f" /><br>
                </div>

                <hr>
                <br>

                <div class="col-md-12 form-group">
                    <div class="ibox">

                        <div class="ibox-head">
                            <div class="ibox-title">
                                <h5><b>Detalle de producción</b></h5>
                            </div>
                        </div>

                        <div class="ibox-body">

                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#pill-1-4" data-toggle="tab">Hectareas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#pill-1-1" data-toggle="tab">Actividades</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#pill-1-2" data-toggle="tab">Herramientas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#pill-1-3" data-toggle="tab">Insumos</a>
                                </li>
                            </ul>

                            <div class="tab-content">

                                <div class="tab-pane" id="pill-1-1">
                                    <div class="row">
                                        <div class="col-sm-10 form-group mx-auto">
                                            <label>Seleccione actividad</label> &nbsp;&nbsp; <label style="color:red;" id="tipo_ac_pbligg"></label>
                                            <select class="activi_id form-control" id="tipo_actividad" style="width:100%">
                                            </select>
                                        </div>

                                        <div class="col-sm-1 form-group">
                                            <label>Agregar</label>
                                            <button onclick="ingreso_activida();" class="btn btn-primary"><i class="fa fa-download"></i></button>
                                        </div>

                                        <table id="tabla_detalle_atividad" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                            <thead bgcolor="purple" style="color:#fff;">
                                                <tr>
                                                    <th hidden>#</th>
                                                    <th>Actividad</th>
                                                    <th>Accion</th>
                                                </tr>
                                            </thead>

                                            <tbody id="tbody_detalle_atividad">
                                            </tbody>

                                            <tfoot bgcolor="purple" style="color:#fff;">
                                                <tr>
                                                    <th hidden>#</th>
                                                    <th>Actividad</th>
                                                    <th>Accion</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane" id="pill-1-2">

                                    <div class="row">

                                        <div class="col-sm-7 form-group">
                                            <label>Seleccione herramienta</label> &nbsp;&nbsp; <label style="color:red;" id="herramienta_pbligg"></label>
                                            <select class="herramienta_id form-control" id="herramienta_id" style="width:100%">
                                            </select>
                                        </div>

                                        <div class="col-sm-2 form-group">
                                            <label>Disponible</label>&nbsp;&nbsp; <label style="color:red;" id="dispni_obligg"></label>
                                            <input type="text" class="form-control" id="disponibe_material" readonly>
                                        </div>

                                        <div class="col-sm-2 form-group">
                                            <label>Cantidad</label>&nbsp;&nbsp; <label style="color:red;" id="canti_ma_pbligg"></label>
                                            <input type="text" maxlength="3" onkeypress="return soloNumeros(event)" class="form-control" id="canti_materal" value="0">
                                        </div>

                                        <div class="col-sm-1 form-group">
                                            <label>Agregar</label>
                                            <button onclick="ingresar_detalle_material();" class="btn btn-primary"><i class="fa fa-check"></i></button>
                                        </div>

                                        <table id="tabla_detalle_material" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                            <thead bgcolor="purple" style="color:#fff;">
                                                <tr>
                                                    <th hidden style="width: 20px;">#</th>
                                                    <th>Material</th>
                                                    <th>Cantidad</th>
                                                    <th>Accion</th>
                                                </tr>
                                            </thead>

                                            <tbody id="tbody_detalle_material">

                                            </tbody>

                                            <tfoot bgcolor="purple" style="color:#fff;">
                                                <tr>
                                                    <th hidden style="width: 20px;">#</th>
                                                    <th>Material</th>
                                                    <th>Cantidad</th>
                                                    <th>Accion</th>
                                                </tr>
                                            </tfoot>
                                        </table>

                                    </div>

                                </div>

                                <div class="tab-pane" id="pill-1-3">

                                    <div class="row">

                                        <div class="col-sm-7 form-group">
                                            <label>Seleccione insumo</label> &nbsp;&nbsp; <label style="color:red;" id="insumo_pbligg"></label>
                                            <select class="insumo_id form-control" id="insumo_id" style="width:100%">
                                            </select>
                                        </div>

                                        <div class="col-sm-2 form-group">
                                            <label>Disponible</label>&nbsp;&nbsp; <label style="color:red;" id="dispni_insumo_obligg"></label>
                                            <input type="text" class="form-control" id="disponibe_insumo" readonly>
                                        </div>

                                        <div class="col-sm-2 form-group">
                                            <label>Cantidad</label>&nbsp;&nbsp; <label style="color:red;" id="canti_insumo_pbligg"></label>
                                            <input type="text" maxlength="3" onkeypress="return soloNumeros(event)" class="form-control" id="canti_insumo" value="0">
                                        </div>

                                        <div class="col-sm-1 form-group">
                                            <label>Agregar</label>
                                            <button onclick="ingresar_detalle_insumo();" class="btn btn-primary"><i class="fa fa-check"></i></button>
                                        </div>

                                        <table id="tabla_detalle_insumo" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                            <thead bgcolor="purple" style="color:#fff;">
                                                <tr>
                                                    <th hidden style="width: 20px;">#</th>
                                                    <th>Insumo</th>
                                                    <th>Cantidad</th>
                                                    <th>Accion</th>
                                                </tr>
                                            </thead>

                                            <tbody id="tbody_detalle_insumo">

                                            </tbody>

                                            <tfoot bgcolor="purple" style="color:#fff;">
                                                <tr>
                                                    <th hidden style="width: 20px;">#</th>
                                                    <th>Insumo</th>
                                                    <th>Cantidad</th>
                                                    <th>Accion</th>
                                                </tr>
                                            </tfoot>
                                        </table>

                                    </div>

                                </div>

                                <div class="tab-pane fade show active" id="pill-1-4">

                                    <div class="row">

                                        <div class="col-sm-6 form-group mx-auto">
                                            <label>Seleccione lote</label> &nbsp;&nbsp; <label style="color:red;" id="lote_id_obligg"></label>
                                            <select class="lote_id form-control" id="lote_id" style="width:100%">
                                            </select>
                                        </div>

                                        <table id="tabla_hectareas" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                            <thead bgcolor="purple" style="color:#fff;">
                                                <tr>
                                                    <th hidden>id</th>
                                                    <th style="width: 50px;">#</th>
                                                    <th>Hectarea</th>
                                                    <th>Accion</th>
                                                </tr>
                                            </thead>

                                            <tbody id="tbody_detalle_hectarea">

                                            </tbody>

                                            <tfoot bgcolor="purple" style="color:#fff;">
                                                <tr>
                                                    <th hidden>id</th>
                                                    <th style="width: 50px;">#</th>
                                                    <th>Hectarea</th>
                                                    <th>Accion</th>
                                                </tr>
                                            </tfoot>
                                        </table>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-12 mx-auto p-3">
                    <button onclick="guardar_produccion_nueva();" class="btn btn-primary" type="submit">
                        <i class="fa fa-save"></i> Registrar
                    </button> -
                    <a href="../produccion/produccion.php" class="btn btn-danger">Volver</a>
                </div>
            </div>

        </div>
    </div>
</div>

<?php require "../layout/footer.php" ?>
<script src="../../js/produccion.js"></script>

<script>
    $(document).ready(function() {
        var n = new Date();
        var y = n.getFullYear();
        var m = n.getMonth() + 1;
        var d = n.getDate();
        if (d < 10) {
            d = '0' + d;
        }
        if (m < 10) {
            m = '0' + m;
        }
        document.getElementById("fecha_i").value = y + "-" + m + "-" + d;
        document.getElementById("fecha_f").value = y + "-" + m + "-" + d;
    });

    mostar_fecha(fecha_atras, fecha_adelante);
    mostar_fechamas(fecha_atras, fecha_mass);

    $(".lote_id").select2();
    $(".activi_id").select2();
    $(".herramienta_id").select2();
    $(".insumo_id").select2();
    listar_lote();
    listar_actividad_combo_produccion();
    listar_herramienta_combo();
    listar_insumo_combo_produccion();

    function listar_lote() {
        funcion = "listar_lote";
        $.ajax({
            url: "../../controlador/produccion/produccion.php",
            type: "POST",
            data: {
                funcion: funcion,
            },
        }).done(function(response) {
            var data = JSON.parse(response);
            var cadena = "<option value='0'> --- seleccione el lote --- </option>";
            if (data.length > 0) {
                //bucle para extraer los datos del rol
                for (var i = 0; i < data.length; i++) {
                    cadena += "<option value='" + data[i][0] + "'> " + data[i][1] + " </option>";
                }
                //aqui concadenamos al id del select
                $("#lote_id").html(cadena);
            } else {
                cadena += "<option value=''>No hay lotes</option>";
                $("#lote_id").html(cadena);
            }
        });
    }

    $("#lote_id").on("change", function() {
        var id = $(this).val();

        if (id == 0 || id.length == 0 || id.trim() == "") {
            return $("#tbody_detalle_hectarea").empty();
        }

        funcion = "cargra_detalle_lote_disponibles";
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
                data["data"].forEach((row) => {

                    count++;
                    llenat += `<tr>
                    <td hidden>${row["id"]}</td>  
                    <td>${count}</td> 
                    <td>${row["nombre"]}</td>  
                    <td> <input type='checkbox' id='checkfull' name='gender'> </td>   
                    </tr>`;

                    $("#tbody_detalle_hectarea").html(llenat);
                });
            } else {
                $("#tbody_detalle_hectarea").empty();
            }
        });

    });

    /////// para listar actividad
    function listar_actividad_combo_produccion() {
        funcion = "listar_actividad_combo_produccion";
        $.ajax({
            url: "../../controlador/produccion/produccion.php",
            type: "POST",
            data: {
                funcion: funcion,
            },
        }).done(function(response) {
            var data = JSON.parse(response);
            var cadena = "<option value='0'> --- seleccione la actividad --- </option>";
            if (data.length > 0) {
                //bucle para extraer los datos del rol
                for (var i = 0; i < data.length; i++) {
                    cadena += "<option value='" + data[i][0] + "'>Trabajador: " + data[i][1] + " - Actividad: " + data[i][2] + " </option>";
                }
                //aqui concadenamos al id del select
                $("#tipo_actividad").html(cadena);
            } else {
                cadena += "<option value=''>No hay actividad</option>";
                $("#tipo_actividad").html(cadena);
            }
        });
    }

    function ingreso_activida() {
        var texto = $("#tipo_actividad option:selected").text();
        var id = $("#tipo_actividad").val();

        if (id.length == 0 || id == "0" || id.trim() == "0") {
            $("#tipo_ac_pbligg").html(" - Seleccione la actividad");
            return Swal.fire(
                "Mensaje de advertencia",
                " Seleccione la actividad",
                "warning"
            );
        } else {
            $("#tipo_ac_pbligg").html("");
        }

        if (verificar_actividad(id)) {
            return Swal.fire(
                "Mensaje de advertencia",
                "El empleado '" + texto + "' , ya fue agregado al detalle",
                "warning"
            );
        }

        var datos_agg = "<tr>";
        datos_agg += "<td hidden for='id'>" + id + "</td>";
        datos_agg += "<td>" + texto + "</td>";
        datos_agg +=
            "<td><button onclick='remove_actividad(this)' class='btn btn-danger'><i class='fa fa-trash'></i></button></td>";
        datos_agg += "</tr>";

        //esto me ayuda a enviar los datos a la tabla
        $("#tbody_detalle_atividad").append(datos_agg);
    }

    function verificar_actividad(id) {
        let idverificar = document.querySelectorAll(
            "#tabla_detalle_atividad td[for='id']"
        );
        return [].filter.call(idverificar, (td) => td.textContent == id).length == 1;
    }

    function remove_actividad(t) {
        var td = t.parentNode;
        var tr = td.parentNode;
        var table = tr.parentNode;
        table.removeChild(tr);
    }

    ////// para listar la harremienta
    function listar_herramienta_combo() {
        funcion = "listar_herramienta_combo";
        $.ajax({
            url: "../../controlador/produccion/produccion.php",
            type: "POST",
            data: {
                funcion: funcion,
            },
        }).done(function(response) {
            var data = JSON.parse(response);
            var cadena = "<option value='0'> --- seleccione la herramienta --- </option>";
            if (data.length > 0) {
                //bucle para extraer los datos del rol
                for (var i = 0; i < data.length; i++) {
                    cadena += "<option value='" + data[i][0] + "'> " + data[i][1] + " - " + data[i][2] + " - " + data[i][3] + " </option>";
                }
                //aqui concadenamos al id del select
                $("#herramienta_id").html(cadena);
            } else {
                cadena += "<option value=''>No hay herramienta</option>";
                $("#herramienta_id").html(cadena);
            }
        });
    }

    $("#herramienta_id").on("change", function() {
        var id = $(this).val();

        if (id == 0 || id.length == 0 || id.trim() == "") {
            return $("#disponibe_material").val("");
        }

        funcion = "traer_cantidad_herramienta";
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
                $("#disponibe_material").val(data[0]);
            } else {
                $("#disponibe_material").val("");
            }
        });

    });

    function ingresar_detalle_material() {
        var texto = $("#herramienta_id option:selected").text();
        var id = $("#herramienta_id").val();

        var actual = $("#disponibe_material").val();
        var cantidada = $("#canti_materal").val();

        if (id.length == 0 || id == "0" || id.trim() == "") {
            $("#herramienta_pbligg").html(" - Seleccione la herramienta");
            return Swal.fire(
                "Mensaje de advertencia",
                " Seleccione la herramienta",
                "warning"
            );
        } else {
            $("#herramienta_pbligg").html("");
        }

        if (cantidada.length == 0 || cantidada <= "0" || cantidada.trim() == "") {
            $("#canti_ma_pbligg").html(" - Ingrese la cantidad");
            return Swal.fire(
                "Mensaje de advertencia",
                "Ingrese la cantidad",
                "warning"
            );
        } else {
            $("#canti_ma_pbligg").html("");
        }

        if (parseInt(cantidada) > parseInt(actual)) {
            $("#canti_ma_pbligg").html("XXX");
            $("#dispni_obligg").html("XXX");
            return Swal.fire(
                "Mensaje de advertencia",
                "La cantidad ingresada " + cantidada + ", no puede superar la cantidad de herramienta " + actual + " disponible",
                "warning"
            );
        } else {
            $("#canti_ma_pbligg").html("");
            $("#dispni_obligg").html("");
        }

        if (verificar_herramienta_(id)) {
            return Swal.fire(
                "Mensaje de advertencia",
                "La herramienta '" + texto + "' , ya fue agregado al detalle",
                "warning"
            );
        }

        var datos_agg = "<tr>";
        datos_agg += "<td hidden for='id'>" + id + "</td>";
        datos_agg += "<td>" + texto + "</td>";
        datos_agg += "<td>" + cantidada + "</td>";
        datos_agg +=
            "<td><button onclick='remove_material_(this)' class='btn btn-danger'><i class='fa fa-trash'></i></button></td>";
        datos_agg += "</tr>";

        //esto me ayuda a enviar los datos a la tabla
        $("#tbody_detalle_material").append(datos_agg);
        $("#canti_materal").val("0");
    }

    function verificar_herramienta_(id) {
        let idverificar = document.querySelectorAll(
            "#tabla_detalle_material td[for='id']"
        );
        return [].filter.call(idverificar, (td) => td.textContent == id).length == 1;
    }

    function remove_material_(t) {
        var td = t.parentNode;
        var tr = td.parentNode;
        var table = tr.parentNode;
        table.removeChild(tr);
    }

    ////// para listar el insumo
    function listar_insumo_combo_produccion() {
        funcion = "listar_insumo_combo_produccion";
        $.ajax({
            url: "../../controlador/produccion/produccion.php",
            type: "POST",
            data: {
                funcion: funcion,
            },
        }).done(function(response) {
            var data = JSON.parse(response);
            var cadena = "<option value='0'> --- seleccione el insumo --- </option>";
            if (data.length > 0) {
                //bucle para extraer los datos del rol
                for (var i = 0; i < data.length; i++) {
                    cadena += "<option value='" + data[i][0] + "'> " + data[i][1] + " - " + data[i][2] + " - " + data[i][3] + " </option>";
                }
                //aqui concadenamos al id del select
                $("#insumo_id").html(cadena);
            } else {
                cadena += "<option value=''>No hay insumo</option>";
                $("#insumo_id").html(cadena);
            }
        });
    }

    $("#insumo_id").on("change", function() {
        var id = $(this).val();

        if (id == 0 || id.length == 0 || id.trim() == "") {
            return $("#disponibe_insumo").val("");
        }

        funcion = "traer_cantidad_insumo";
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
                $("#disponibe_insumo").val(data[0]);
            } else {
                $("#disponibe_insumo").val("");
            }
        });

    });

    function ingresar_detalle_insumo() {
        var texto = $("#insumo_id option:selected").text();
        var id = $("#insumo_id").val();

        var actual = $("#disponibe_insumo").val();
        var cantidada = $("#canti_insumo").val();

        if (id.length == 0 || id == "0" || id.trim() == "") {
            $("#insumo_pbligg").html(" - Seleccione el insumo");
            return Swal.fire(
                "Mensaje de advertencia",
                " Seleccione el insumo",
                "warning"
            );
        } else {
            $("#insumo_pbligg").html("");
        }

        if (cantidada.length == 0 || cantidada <= "0" || cantidada.trim() == "") {
            $("#canti_insumo_pbligg").html(" - Ingrese la cantidad");
            return Swal.fire(
                "Mensaje de advertencia",
                "Ingrese la cantidad",
                "warning"
            );
        } else {
            $("#canti_insumo_pbligg").html("");
        }

        if (parseInt(cantidada) > parseInt(actual)) {
            $("#canti_insumo_pbligg").html("XXX");
            $("#dispni_insumo_obligg").html("XXX");
            return Swal.fire(
                "Mensaje de advertencia",
                "La cantidad ingresada " + cantidada + ", no puede superar la cantidad de insumo " + actual + " disponible",
                "warning"
            );
        } else {
            $("#canti_insumo_pbligg").html("");
            $("#dispni_insumo_obligg").html("");
        }

        if (verificar_insumo(id)) {
            return Swal.fire(
                "Mensaje de advertencia",
                "La herramienta '" + texto + "' , ya fue agregado al detalle",
                "warning"
            );
        }

        var datos_agg = "<tr>";
        datos_agg += "<td hidden for='id'>" + id + "</td>";
        datos_agg += "<td>" + texto + "</td>";
        datos_agg += "<td>" + cantidada + "</td>";
        datos_agg +=
            "<td><button onclick='remove_insumo_(this)' class='btn btn-danger'><i class='fa fa-trash'></i></button></td>";
        datos_agg += "</tr>";

        //esto me ayuda a enviar los datos a la tabla
        $("#tbody_detalle_insumo").append(datos_agg);
        $("#canti_insumo").val("0");
    }

    function verificar_insumo(id) {
        let idverificar = document.querySelectorAll(
            "#tabla_detalle_insumo td[for='id']"
        );
        return [].filter.call(idverificar, (td) => td.textContent == id).length == 1;
    }

    function remove_insumo_(t) {
        var td = t.parentNode;
        var tr = td.parentNode;
        var table = tr.parentNode;
        table.removeChild(tr);
    }
</script>
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
                    <i class="fa fa-shopping-cart"> </i>
                </div>
                <div>
                    Nueva compra insumo
                    <div class="page-title-subheading">
                        Crear una nueva compra insumo.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <label class="form-label">Nueva compra insumo</label>
                <div class="d-inline-block dropdown">
                    <a href="../inventario/list_comprai.php"> / Listado </a>
                </div> <a href="../home/index.php"> / Principal <i class="fa fa-home"></i></a> </a>
            </div>
        </div>
    </div>

    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-title">Nueva compra insumo.</h5>

            <div class="form-row text-center">

                <div class="col-md-6 mb-3">
                    <label for="selec_proveedor">Proveedor</label> <b><label style="color: red;" id="selec_proveedor_obligg"></label></b>
                    <select class="form-cotrol selec_proveedor" style="width: 100%;" id="selec_proveedor"></select>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="fecha">Fecha</label> <b><label style="color: red;" id="fecha_obligg"></label></b>
                    <input type="date" value="<?php echo $fecha; ?>" class="form-control calendario" id="fecha" />
                </div>

                <div class="col-md-3 mb-3">
                    <label for="numero_compra">N° compra</label> <b><label style="color: red;" id="numero_compra_obligg"></label></b>
                    <input type="text" maxlength="15" class="form-control" id="numero_compra" placeholder="Numero de compra" onkeypress="return soloNumeros(event)" />
                </div>

                <div class="col-md-3 mb-3">
                    <label for="tipo_comprobante">Tipo de comprobante</label>
                    <select class="form-control tipo_comprobante" style="width: 100%;" id="tipo_comprobante">
                        <option value="Factura">Factura</option>
                        <option value="Notacompra">Nota de compra</option>
                    </select>
                </div>

                <div class="col-md-1 mb-3">
                    <label for="iva">Iva</label> <b><label style="color: red;" id="iva_obligg"></label></b>
                    <input type="text" maxlength="2" value="12" class="form-control" id="iva" placeholder="Iva" onkeypress="return soloNumeros(event)" />
                </div>

                <div class="col-md-1 mb-3">
                    <label>...</label>
                    <button onclick="modal_insumo();" class="btn btn-warning"><i class="fa fa-eye"></i> <b>Buscar...</b> </button>
                </div>

                <div class="row">

                    <input type="text" hidden id="id_insumo_t">

                    <div class="col-md-6 mb-3">
                        <label for="inumo_t">Insumo</label> <b><label style="color: red;" id="inumo_t_obligg"></label></b>
                        <input disabled type="text" class="form-control" id="inumo_t" />
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="precio_compra_t">Precio compra </label> <b><label style="color: red;" id="precio_compra_t_obligg"></label></b>
                        <input disabled type="number" class="form-control" id="precio_compra_t" placeholder="Precio de compra" value="0" />
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="cantidad_t">Cantidad</label> <b><label style="color: red;" id="cantidad_t_obligg"></label></b>
                        <input type="text" maxlength="10" class="form-control" id="cantidad_t" value="0" placeholder="Cantidad" onkeypress="return soloNumeros(event)" />
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="descuento_t">Descuento moneda/dolar</label> <b><label style="color: red;" id="descuento_t_obligg"></label></b>
                        <input type="text" onkeypress="return filterfloat(event, this);" class="form-control" id="descuento_t" placeholder="Descuento" value="0" />
                    </div>

                    <div class="col-md-1 mb-3">
                        <label>...</label>
                        <button onclick="ingresar_detalle();" class="btn btn-success"><i class="fa fa-download"></i> <b>Ingresar</b> </button>
                    </div>


                    <div class="col-md-12 mb-3">
                        <div class="col-md-12 mb-4">
                            <h4 class="bg bg-info" style="border-radius: 20px; color: black;"><b> Detalle de compra insumo</b></h4>
                        </div>
                        <table id="detalle_compra_insumo" class="table table-striped table-bordered">
                            <thead bgcolor="black" style="color:#fff;">
                                <tr>
                                    <th hidden>Id</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Desc. moneda</th>
                                    <th>Subtotal</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_detalle_compra_insumo">
                            </tbody>
                        </table>

                        <div class="col-lg-12" style="text-align: right;">
                            <label for="" id="lbl_totalneto"></label>
                            <input hidden type="text" id="txt_totalneto">
                        </div>


                        <div class="col-lg-12" style="text-align: right;">
                            <label for="" id="lbl_impuesto"></label>
                            <input hidden type="text" id="txt_impuesto">
                        </div>

                        <div class="col-lg-12" style="text-align: right;">
                            <label for="" id="lbl_a_pagar"></label>
                            <input hidden type="text" id="txt_a_pagar">
                        </div>
                    </div>
                </div>

                <div class="col-md-12 p-1">
                    <button onclick="registra_compra_insumo();" class="btn btn-primary">
                        <i class="fa fa-save"></i> Registrar
                    </button> -
                    <a href="../inventario/list_comprai.php" class="btn btn-danger">Volver</a>
                </div>

            </div>

        </div>
    </div>
</div>

<?php require "../layout/footer.php" ?>

<div class="modal" id="modal_productos_insumos">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_eitar_rolLabel">Insumos disponibles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <div class="form-row text-center">
                    <div class="col-lg-12" style="width: 100%;">
                        <table id="insumos_disponibles" class="table table-striped text-center" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Acción</th>
                                    <th>Codigo</th>
                                    <th>Nombre</th>
                                    <th>Marca</th>
                                    <th>Tipo</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Acción</th>
                                    <th>Codigo</th>
                                    <th>Nombre</th>
                                    <th>Marca</th>
                                    <th>Tipo</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Cerrar
                </button>
            </div>

        </div>
    </div>
</div>

<script src="../../js/inventario.js"></script>

<script>
    mostar_fecha(fecha_atras, fecha_adelante);

    listar_proveedor_combo();
    $(".selec_proveedor").select2();
    listar_isnumos_disponibles();

    $("#tipo_comprobante").on("change", function() {
        var valor = $(this).val();

        if (valor != "Factura") {
            $("#iva").attr("disabled", true);
            $("#iva").val("0");
        } else {
            $("#iva").removeAttr("disabled");
            $("#iva").val("12");
        }
    });

    ////////////////agregra detalle
    function ingresar_detalle() {
        var id = $("#id_insumo_t").val();
        var inumo = $("#inumo_t").val();
        var precio = $("#precio_compra_t").val();
        var cantidad = $("#cantidad_t").val();
        var descuento = $("#descuento_t").val();

        var iva = $("#iva").val();
        var comprobante = $("#tipo_comprobante").val();

        if (id.length == 0 || inumo.length == 0 || precio.length == 0) {
            $("#inumo_t_obligg").html(" - Ingrese insumo");

            return swal.fire(
                "Campos vacios",
                "Debe ingresar el insumo",
                "warning"
            );
        } else {
            $("#inumo_t_obligg").html("");
        }

        if (cantidad <= 0 || cantidad.length == 0 || cantidad.trim() == "") {
            $("#cantidad_t_obligg").html(" - Ingrese cantidad");

            return swal.fire(
                "Campo vacios",
                "Debe ingresar la cantidad, no deje el valor vacio o cero",
                "warning"
            );
        } else {
            $("#cantidad_t_obligg").html("");
        }

        if (descuento < 0 || descuento.length == 0 || descuento.trim() == "") {
            $("#descuento_t_obligg").html(" - Ingrese dato");

            return swal.fire(
                "Campo vacios",
                "Debe ingresar el descuento, o deje en valor 0",
                "warning"
            );
        } else {
            $("#descuento_t_obligg").html("");
        }

        if (iva.length == 0 || iva.trim() == "") {
            $("#iva_obligg").html(" - Iva");

            return swal.fire(
                "Campo vacios",
                "Debe ingresar el IVA, o deje el valor 0",
                "warning"
            );
        } else {
            $("#iva_obligg").html("");
        }

        if (verificar_isnumo_id(id)) {
            return Swal.fire(
                "Mensaje de advertencia",
                "El insumo '" +
                inumo + "', ya fue agregado al detalle",
                "warning"
            );
        }

        var total = 0,
            agg = 0;
        total = cantidad * parseFloat(precio).toFixed(2);
        agg = total - parseFloat(descuento).toFixed(2);

        //aqui agrego los labores para unir a la tabla
        var datos_agg = "<tr>";
        datos_agg += "<td for='id' hidden>" + id + "</td>";
        datos_agg += "<td>" + inumo + "</td>";
        datos_agg += "<td>" + cantidad + "</td>";
        datos_agg += "<td>" + precio + "</td>";
        datos_agg += "<td>" + descuento + "</td>";
        datos_agg += "<td>" + parseFloat(agg).toFixed(2); +
        "</td>";
        datos_agg +=
            "<td><button onclick='remove_insmo_detalle(this)' class='btn btn-danger'><i class='fa fa-trash'></i></button></td>";
        datos_agg += "</tr>";

        $("#tbody_detalle_compra_insumo").append(datos_agg);

        sumartotalneto();
        $("#id_insumo_t").val("");
        $("#inumo_t").val("");
        $("#precio_compra_t").val("");
        $("#cantidad_t").val("0");
        $("#descuento_t").val("0");
    }

    function remove_insmo_detalle(t) {
        var td = t.parentNode;
        var tr = td.parentNode;
        var table = tr.parentNode;
        table.removeChild(tr);
        sumartotalneto();
    }

    function sumartotalneto() {
        let arreglo_total = new Array();
        let count = 0;
        let total = 0;
        let impuestototal = 0;
        let subtotal = 0;
        let impuesto = document.getElementById("iva").value;

        $("#detalle_compra_insumo tbody#tbody_detalle_compra_insumo tr").each(
            function() {
                arreglo_total.push($(this).find("td").eq(5).text());
                count++;
            }
        );

        for (var i = 0; i < count; i++) {
            var suma = arreglo_total[i];
            subtotal = (parseFloat(subtotal) + parseFloat(suma)).toFixed(2);
            impuestototal = parseFloat(subtotal * impuesto / 100).toFixed(2);
        }

        total = (parseFloat(subtotal) + parseFloat(impuestototal)).toFixed(2);

        $("#lbl_totalneto").html("<b>Total neto: </b> $. " + subtotal);
        $("#lbl_impuesto").html(
            "<b>impuesto: % " + impuesto + " </b> $. " + impuestototal
        );
        $("#lbl_a_pagar").html("<b>Total a pagar: </b> $. " + total);

        $("#txt_totalneto").val(subtotal);
        $("#txt_impuesto").val(impuestototal);
        $("#txt_a_pagar").val(total);
    }

    function verificar_isnumo_id(id) {
        let idverificar = document.querySelectorAll(
            "#tbody_detalle_compra_insumo td[for='id']"
        );
        return [].filter.call(idverificar, (td) => td.textContent == id).length == 1;
    }
</script>
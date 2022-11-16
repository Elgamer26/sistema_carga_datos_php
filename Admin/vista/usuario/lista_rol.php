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
        background: rgb(0, 123, 255);
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

    .keyss {
        padding: 5px;
    }
</style>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-list"> </i>
                </div>
                <div>
                    Listado de roles - <a style="color: white;" href="../usuario/tipo_rol.php" class="btn btn-primary "><i class="fa fa-plus"></i> Nuevo rol</a> - <a style="color: white;" href="../usuario/listado.php" class="btn btn-success "><i class="fa fa-users"></i> Usuarios</a>
                    <div class="page-title-subheading">
                        Lista de roles disponibles
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <label class="form-label">Listado </label>
                <div class="d-inline-block dropdown">
                    <a href="../home/index.php"> / Principal <i class="fa fa-home"></i></a>
                </div>
            </div>
        </div>
    </div>



    <table id="tabla_rol" class="mb-0 table table-striped" style="width: 100%;">
        <thead>
            <tr>
                <th>#</th>
                <th>Acción</th>
                <th>Nombres</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
            <tr>
                <th>#</th>
                <th>Acción</th>
                <th>Nombres</th>
                <th>Estado</th>
            </tr>
        </tfoot>
    </table>

</div>

<?php require "../layout/footer.php" ?>
<script src="../../js/usuario.js"></script>
<script>
    listar_rol();
</script>

<!-- modal de esitar rol -->
<div class="modal fade" id="modal_eitar_rol" role="dialog" aria-labelledby="modal_eitar_rolLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_eitar_rolLabel">Editar rol</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input type="text" id="id_rol" hidden>

                <div class="form-group">
                    <label for="nombre_rol" class="col-form-label">Nonbre del rol:</label> <label style="color: red;" id="nombre_rol_edit_obligg"></label>
                    <input type="text" class="form-control" id="nombre_rol" />
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Cerrar
                </button>
                <button onclick="editar_rol()" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- modal permisos del usuario -->
<div class="modal fade" id="modal_permisos" role="dialog" aria-labelledby="modal_permisosLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_permisosLabel">Permisos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input type="text" id="id_rol_permiso" hidden>

                <div class="col-md-12 p-3">
                    <div class="box-header with-border center" style="text-align: center; background: orange; color:black; padding: -30px;">
                        <b>
                            <h4 class="box-title"><i class="fa fa-key"></i> <b>Permisos del rol</b></h4>
                        </b>
                    </div>
                </div>

                <div class='col-md-12' style="text-align:center;">

                    <div class="row">

                        <div class='col-md-2 keyss'>
                            <label for='usuario_p'>Usuarios</label><br>
                            <input type='checkbox' id='usuario_p'><br>
                        </div>

                        <div class='col-md-2 keyss'>
                            <label for='empresa_p'>Empresa</label><br>
                            <input type='checkbox' id='empresa_p'><br>
                        </div>

                        <div class='col-md-2 keyss'>
                            <label for='insumo_p'>Insumos</label><br>
                            <input type='checkbox' id='insumo_p'><br>
                        </div>

                        <div class='col-md-2 keyss'>
                            <label for='herramienta_p'>Herramienta</label><br>
                            <input type='checkbox' id='herramienta_p'><br>
                        </div>

                        <div class='col-md-2 keyss'>
                            <label for='proveedor_p'>Proveedor</label><br>
                            <input type='checkbox' id='proveedor_p'><br>
                        </div>

                        <div class='col-md-2 keyss'>
                            <label for='compra_i_p'>Compra insumo</label><br>
                            <input type='checkbox' id='compra_i_p'><br>
                        </div>

                        <br>

                        <div class='col-md-2 keyss'>
                            <label for='compra_h_p'>Compra herramienta</label><br>
                            <input type='checkbox' id='compra_h_p'><br>
                        </div>

                        <div class='col-md-2 keyss'>
                            <label for='actividad_p'>Actividades</label><br>
                            <input type='checkbox' id='actividad_p'><br>
                        </div>

                        <div class='col-md-2 keyss'>
                            <label for='trabajador_p'>Trabajadores</label><br>
                            <input type='checkbox' id='trabajador_p'><br>
                        </div>

                        <div class='col-md-2 keyss'>
                            <label for='asiganar_p'>Asignar actividad</label><br>
                            <input type='checkbox' id='asiganar_p'><br>
                        </div>

                        <div class='col-md-2 keyss'>
                            <label for='cinta_p'>Cintas</label><br>
                            <input type='checkbox' id='cinta_p'><br>
                        </div>

                        <div class='col-md-2 keyss'>
                            <label for='lote_p'>Lotes</label><br>
                            <input type='checkbox' id='lote_p'><br>
                        </div>

                        <br>

                        <div class='col-md-2 keyss'>
                            <label for='produccion_p'>Produccion</label><br>
                            <input type='checkbox' id='produccion_p'><br>
                        </div>

                        <div class='col-md-2 keyss'>
                            <label for='encinte_p'>Encinte</label><br>
                            <input type='checkbox' id='encinte_p'><br>
                        </div>

                        <div class='col-md-2 keyss'>
                            <label for='fruta_p'>Frutas</label><br>
                            <input type='checkbox' id='fruta_p'><br>
                        </div>

                        <div class='col-md-2 keyss'>
                            <label for='proceso_c_p'>Proceso cajas</label><br>
                            <input type='checkbox' id='proceso_c_p'><br>
                        </div>

                        <div class='col-md-2 keyss'>
                            <label for='data_c_p'>Data excel cajas</label><br>
                            <input type='checkbox' id='data_c_p'><br>
                        </div>

                        <div class='col-md-2 keyss'>
                            <label for='proceso_e_p'>Proceso enfunde</label><br>
                            <input type='checkbox' id='proceso_e_p'><br>
                        </div>

                        <div class='col-md-2 keyss'>
                            <label for='data_f_p'>Data excel funda</label><br>
                            <input type='checkbox' id='data_f_p'><br>
                        </div>

                        <div class='col-md-2 keyss'>
                            <label for='proceso_r_p'>Proceso recobro</label><br>
                            <input type='checkbox' id='proceso_r_p'><br>
                        </div>

                        <div class='col-md-2 keyss'>
                            <label for='data_r_p'>Data excel recobro</label><br>
                            <input type='checkbox' id='data_r_p'><br>
                        </div>

                        <div class='col-md-2 keyss'>
                            <label for='proceso_p_p'>Proceso produccion</label><br>
                            <input type='checkbox' id='proceso_p_p'><br>
                        </div>

                        <div class='col-md-2 keyss'>
                            <label for='data_p_p'>Data excel produccion</label><br>
                            <input type='checkbox' id='data_p_p'><br>
                        </div>

                        <div class='col-md-2 keyss'>
                            <label for='prediccion_c_p'>Prediccion cajas</label><br>
                            <input type='checkbox' id='prediccion_c_p'><br>
                        </div>

                        <div class='col-md-2 keyss'>
                            <label for='prediccion_e_p'>Prediccion enfunde</label><br>
                            <input type='checkbox' id='prediccion_e_p'><br>
                        </div>

                        <div class='col-md-2 keyss'>
                            <label for='prediccion_r_p'>Prediccion recobro</label><br>
                            <input type='checkbox' id='prediccion_r_p'><br>
                        </div>

                        <div class='col-md-2 keyss'>
                            <label for='prediccion_p_p'>Prediccion produccion</label><br>
                            <input type='checkbox' id='prediccion_p_p'><br>
                        </div>

                        <div class='col-md-2 keyss'>
                            <label for='informe_p'>Informes</label><br>
                            <input type='checkbox' id='informe_p'><br>
                        </div>

                        <br>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Cerrar
                </button>
                <button onclick="editar_permisos()" id="btn_editar_p" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
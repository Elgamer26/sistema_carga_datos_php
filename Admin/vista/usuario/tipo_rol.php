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
                    <i class="fa fa-bookmark"> </i>
                </div>
                <div>
                    Nuevo rol
                    <div class="page-title-subheading">
                        Crear un rol con sus permisos.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <label class="form-label">Rol</label>
                <div class="d-inline-block dropdown">
                    <a href="../usuario/lista_rol.php"> / Listado </a>
                </div> <a href="../home/index.php"> / Principal <i class="fa fa-home"></i></a>
            </div>
        </div>
    </div>

    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-title">Nuevo rol.</h5>

            <div class="form-row text-center">

                <div class="col-md-6 mx-auto">
                    <label for="nombre_rol">Nombre del rol</label> <b><label style="color: red;" id="nombre_rol_obligg"></label></b>
                    <input type="text" class="form-control" id="nombre_rol" placeholder="Ingrese el nombre rol de usuario" />
                </div>

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

                <div class="col-md-12 mx-auto p-3">
                    <button onclick="registra_rol();" class="btn btn-primary" type="submit">
                        <i class="fa fa-save"></i> Registrar
                    </button> -
                    <a href="../usuario/lista_rol.php" class="btn btn-danger">Volver</a>
                </div>

            </div>

        </div>
    </div>
</div>

<?php require "../layout/footer.php" ?>
<script src="../../js/usuario.js"></script>
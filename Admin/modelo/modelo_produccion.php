<?php
require_once 'modelo_conexion.php';
class modelo_produccion extends modelo_conexion
{
    function registra_actividad($nombre)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM actividad where actividad = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {

                $sql_a = "INSERT INTO actividad (actividad) VALUES (?)";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $nombre);

                if ($querya->execute()) {
                    $res = 1;
                } else {
                    $res = 0;
                }
            } else {
                $res = 2; // ya esxiste
            }
            return $res;

            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function listar_actividad()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM actividad";
            $query = $c->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo["data"][] = $respuesta;
            }
            return $arreglo;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function cambiar_estado_actividad($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_a = "UPDATE actividad SET estado = ? where id = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $dato);
            $querya->bindParam(2, $id);

            if ($querya->execute()) {
                $res = 1;
            } else {
                $res = 0;
            }

            return $res;

            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function editar_actividad($id, $nombre)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM actividad where actividad = ? AND id != ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre);
            $query->bindParam(2, $id);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {

                $sql_a = "UPDATE actividad SET actividad = ? WHERE id = ?";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $nombre);
                $querya->bindParam(2, $id);

                if ($querya->execute()) {
                    $res = 1;
                } else {
                    $res = 0;
                }
            } else {
                $res = 2; // ya esxiste
            }
            return $res;

            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function registra_trabajador($nombres, $apellidos, $fecha, $cedula, $direccions, $telefono, $correo, $sexo)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM empleado where cedula = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $cedula);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {

                $sql_a = "INSERT INTO empleado (nombres,apellidos,fecha,cedula,direccions,telefono,correo,sexo) VALUES (?,?,?,?,?,?,?,?)";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $nombres);
                $querya->bindParam(2, $apellidos);
                $querya->bindParam(3, $fecha);
                $querya->bindParam(4, $cedula);
                $querya->bindParam(5, $direccions);
                $querya->bindParam(6, $telefono);
                $querya->bindParam(7, $correo);
                $querya->bindParam(8, $sexo);

                if ($querya->execute()) {
                    $res = 1;
                } else {
                    $res = 0;
                }
            } else {
                $res = 2; // ya esxiste
            }
            return $res;

            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function listar_trabajador()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM empleado";
            $query = $c->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo["data"][] = $respuesta;
            }
            return $arreglo;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function cambiar_estado_trabajador($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_a = "UPDATE empleado SET estado = ? where id = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $dato);
            $querya->bindParam(2, $id);

            if ($querya->execute()) {
                $res = 1;
            } else {
                $res = 0;
            }

            return $res;

            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function editar_trabajador($id, $nombres, $apellidos, $fecha, $cedula, $direccions, $telefono, $correo, $sexo)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM empleado where cedula = ? AND id != ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $cedula);
            $query->bindParam(2, $id);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {

                $sql_a = "UPDATE empleado SET nombres=?,apellidos=?,fecha=?,cedula=?,direccions=?,telefono=?,correo=?,sexo=? WHERE id=?";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $nombres);
                $querya->bindParam(2, $apellidos);
                $querya->bindParam(3, $fecha);
                $querya->bindParam(4, $cedula);
                $querya->bindParam(5, $direccions);
                $querya->bindParam(6, $telefono);
                $querya->bindParam(7, $correo);
                $querya->bindParam(8, $sexo);
                $querya->bindParam(9, $id);

                if ($querya->execute()) {
                    $res = 1;
                } else {
                    $res = 0;
                }
            } else {
                $res = 2; // ya esxiste
            }
            return $res;

            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function listar_actividad_combo()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM actividad WHERE estado = 1";
            $query = $c->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_BOTH);
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo[] = $respuesta;
            }
            return $arreglo;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function listar_trabajador_combo()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            empleado.id,
            CONCAT_WS( ' ', ' Nombres: ', empleado.nombres, empleado.apellidos, ' - Cedula: ', empleado.cedula ) AS empleado 
            FROM
            empleado 
            WHERE
            empleado.estado = 1";
            $query = $c->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_BOTH);
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo[] = $respuesta;
            }
            return $arreglo;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function registra_asignacion($empleado, $actividad, $fecha, $costo)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM asignacion_actividad where actividad_id = ? AND trabajador_id = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $actividad);
            $query->bindParam(2, $empleado);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {

                $sql_a = "INSERT INTO asignacion_actividad (actividad_id,trabajador_id,valor,fecha) VALUES (?,?,?,?)";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $actividad);
                $querya->bindParam(2, $empleado);
                $querya->bindParam(3, $costo);
                $querya->bindParam(4, $fecha);

                if ($querya->execute()) {
                    $res = 1;
                } else {
                    $res = 0;
                }
            } else {
                $res = 2; // ya esxiste
            }
            return $res;

            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function listar_asignacion()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            asignacion_actividad.id,
            asignacion_actividad.actividad_id,
            asignacion_actividad.trabajador_id,
            CONCAT_WS( ' ', empleado.nombres, empleado.apellidos, ' - ', empleado.cedula ) AS trabajador,
            actividad.actividad,
            asignacion_actividad.valor,
            asignacion_actividad.fecha,
            asignacion_actividad.estado 
            FROM
            asignacion_actividad
            INNER JOIN actividad ON asignacion_actividad.actividad_id = actividad.id
            INNER JOIN empleado ON asignacion_actividad.trabajador_id = empleado.id";
            $query = $c->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo["data"][] = $respuesta;
            }
            return $arreglo;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function cambiar_estado_asignacion($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_a = "UPDATE asignacion_actividad SET estado = ? where id = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $dato);
            $querya->bindParam(2, $id);

            if ($querya->execute()) {
                $res = 1;
            } else {
                $res = 0;
            }

            return $res;

            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function editar_asignacion($id, $empleado, $actividad, $fecha, $costo)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM asignacion_actividad where actividad_id = ? AND trabajador_id = ? AND id != ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $actividad);
            $query->bindParam(2, $empleado);
            $query->bindParam(3, $id);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {

                $sql_a = "UPDATE asignacion_actividad SET actividad_id=?,trabajador_id=?,valor=?,fecha=? WHERE id=?";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $actividad);
                $querya->bindParam(2, $empleado);
                $querya->bindParam(3, $costo);
                $querya->bindParam(4, $fecha);
                $querya->bindParam(5, $id);

                if ($querya->execute()) {
                    $res = 1;
                } else {
                    $res = 0;
                }
            } else {
                $res = 2; // ya esxiste
            }
            return $res;

            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function listar_tipo_cintas()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM tipo_cinta";
            $query = $c->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo["data"][] = $respuesta;
            }
            return $arreglo;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function editar_color($id, $color)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "UPDATE tipo_cinta SET color=? WHERE id=?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $color);
            $querya->bindParam(2, $id);

            if ($querya->execute()) {
                $res = 1;
            } else {
                $res = 0;
            }
            return $res;

            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function registrar_lotes($lote)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM lote where nombre = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $lote);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {

                $sql_a = "INSERT INTO lote (nombre) VALUES (?)";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $lote);

                if ($querya->execute()) {
                    $res = $c->lastInsertId();
                } else {
                    $res = 0;
                }
            } else {
                $res = 2; // ya esxiste
            }
            return $res;

            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function registrar_detalle_hectarea($id, $hectarea)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "INSERT INTO hectarea (lote_id, nombre) VALUES (?,?)";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id);
            $querya->bindParam(2, $hectarea);

            if ($querya->execute()) {
                $res = 1;
            } else {
                $res = 0;
            }

            return $res;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function listar_lotes()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM lote";
            $query = $c->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo["data"][] = $respuesta;
            }
            return $arreglo;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function cargra_detalle_lote($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM hectarea WHERE lote_id = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo["data"][] = $respuesta;
            }
            return $arreglo;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function editar_lotes($id, $lote)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM lote where nombre = ? AND id != ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $lote);
            $query->bindParam(2, $id);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {

                $sql_a = "UPDATE lote SET nombre = ? WHERE id = ?";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $lote);
                $querya->bindParam(2, $id);

                if ($querya->execute()) {
                    $res = 1;
                } else {
                    $res = 0;
                }
            } else {
                $res = 2; // ya esxiste
            }
            return $res;

            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function estado_lote($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "UPDATE lote SET estado = ? WHERE id = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $dato);
            $querya->bindParam(2, $id);

            if ($querya->execute()) {
                $res = 1;
            } else {
                $res = 0;
            }

            return $res;

            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function listar_lote()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM lote WHERE estado = 1";
            $query = $c->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_BOTH);
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo[] = $respuesta;
            }
            return $arreglo;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function cargra_detalle_lote_disponibles($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM hectarea WHERE lote_id = ? AND estado = 1";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo["data"][] = $respuesta;
            }
            return $arreglo;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function listar_actividad_combo_produccion()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            asignacion_actividad.id, 
            CONCAT_WS( ' ', empleado.nombres, empleado.apellidos) AS trabajador,
            actividad.actividad
            FROM
                asignacion_actividad
                INNER JOIN actividad ON asignacion_actividad.actividad_id = actividad.id
                INNER JOIN empleado ON asignacion_actividad.trabajador_id = empleado.id 
            WHERE
                asignacion_actividad.estado = 1 
                AND asignacion_actividad.ocupado = 0";
            $query = $c->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_BOTH);
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo[] = $respuesta;
            }
            return $arreglo;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function listar_herramienta_combo()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            herramienta.id,
            herramienta.codigo,
            herramienta.nombre,
            tipo_herramienta.tipo_herramienta 
            FROM
                herramienta
                INNER JOIN tipo_herramienta ON herramienta.tipo = tipo_herramienta.id 
            WHERE
            herramienta.estado = 1";
            $query = $c->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_BOTH);
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo[] = $respuesta;
            }
            return $arreglo;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function traer_cantidad_herramienta($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            herramienta.cantidad
            FROM
            herramienta WHERE herramienta.id = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_BOTH);
            return $result;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function listar_insumo_combo_produccion()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            insumo.id, 
            insumo.codigo, 
            insumo.nombre, 
            tipo_insumo.tipo_insumo
            FROM
            tipo_insumo
            INNER JOIN
            insumo
            ON 
            tipo_insumo.id = insumo.tipo WHERE insumo.estado = 1";
            $query = $c->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_BOTH);
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo[] = $respuesta;
            }
            return $arreglo;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function traer_cantidad_insumo($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            insumo.cantidad
            FROM
            insumo WHERE insumo.id = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_BOTH);
            return $result;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function registrar_produccion_save($produccion, $f_i, $f_f, $lote_id, $usuario)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "INSERT INTO produccion (nombre, f_i, f_f, lote_id, usuario_id) VALUES (?,?,?,?,?)";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $produccion);
            $querya->bindParam(2, $f_i);
            $querya->bindParam(3, $f_f);
            $querya->bindParam(4, $lote_id);
            $querya->bindParam(5, $usuario);

            if ($querya->execute()) {
                $res = $c->lastInsertId();
            } else {
                $res = 0;
            }

            return $res;

            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function detalle_hectreas_produccion($id, $hectarea)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "INSERT INTO produccion_hectarea (produccion_id, hectarea_id) VALUES (?,?)";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id);
            $querya->bindParam(2, $hectarea);

            if ($querya->execute()) {
                $res = 1;
            } else {
                $res = 0;
            }

            return $res;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function detalle_actividades_produccion($id, $actividad)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "INSERT INTO produccion_actividades (produccion_id, actividad_id) VALUES (?,?)";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id);
            $querya->bindParam(2, $actividad);

            if ($querya->execute()) {
                $res = 1;
            } else {
                $res = 0;
            }

            return $res;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function detalle_herraienta_produccion($id, $herramienta, $cantidad)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "INSERT INTO produccion_herramienta (produccion_id, herraienta_id, cantidad) VALUES (?,?,?)";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id);
            $querya->bindParam(2, $herramienta);
            $querya->bindParam(3, $cantidad);

            if ($querya->execute()) {

                $sql_h = "UPDATE herramienta SET cantidad = cantidad - ? WHERE id = ? ";
                $queryh = $c->prepare($sql_h);
                $queryh->bindParam(1, $cantidad);
                $queryh->bindParam(2, $herramienta);

                if ($queryh->execute()) {
                    $res = 1;
                } else {
                    $res = 0;
                }
            } else {
                $res = 0;
            }

            return $res;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function detalle_insumo_produccion($id, $insumo, $cantidad)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "INSERT INTO produccion_insumo (produccion_id, insumo_id, cantidad) VALUES (?,?,?)";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id);
            $querya->bindParam(2, $insumo);
            $querya->bindParam(3, $cantidad);

            if ($querya->execute()) {

                $sql_h = "UPDATE insumo SET cantidad = cantidad - ? WHERE id = ? ";
                $queryh = $c->prepare($sql_h);
                $queryh->bindParam(1, $cantidad);
                $queryh->bindParam(2, $insumo);

                if ($queryh->execute()) {
                    $res = 1;
                } else {
                    $res = 0;
                }
            } else {
                $res = 0;
            }

            return $res;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function listar_produccion()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            produccion.id, 
            produccion.nombre, 
            produccion.f_i, 
            produccion.f_f, 
            lote.nombre as lote, 
            produccion.estado
            FROM
            produccion
            INNER JOIN
            lote
            ON 
            produccion.lote_id = lote.id";
            $query = $c->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo["data"][] = $respuesta;
            }
            return $arreglo;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function cargar_detalle_produccion_lote($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            produccion_hectarea.id,
            hectarea.nombre 
            FROM
                produccion_hectarea
                INNER JOIN hectarea ON produccion_hectarea.hectarea_id = hectarea.id 
            WHERE
            produccion_hectarea.produccion_id = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_BOTH);
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo["data"][] = $respuesta;
            }
            return $arreglo;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function cargar_detalle_produccion_actividades($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            CONCAT_WS( ' ', empleado.nombres, empleado.apellidos ) AS empleado,
            actividad.actividad,
            produccion_actividades.produccion_id 
            FROM
                produccion_actividades
                INNER JOIN asignacion_actividad ON produccion_actividades.actividad_id = asignacion_actividad.id
                INNER JOIN actividad ON asignacion_actividad.actividad_id = actividad.id
                INNER JOIN empleado ON asignacion_actividad.trabajador_id = empleado.id 
            WHERE
            produccion_actividades.produccion_id = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_BOTH);
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo["data"][] = $respuesta;
            }
            return $arreglo;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function cargar_detalle_produccion_herramientas($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            produccion_herramienta.produccion_id,
            CONCAT_WS( ' ', herramienta.nombre, ' - ', tipo_herramienta.tipo_herramienta ) AS herramientas,
            produccion_herramienta.cantidad 
            FROM
            produccion_herramienta
            INNER JOIN herramienta ON produccion_herramienta.herraienta_id = herramienta.id
            INNER JOIN tipo_herramienta ON herramienta.tipo = tipo_herramienta.id 
            WHERE
            produccion_herramienta.produccion_id = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_BOTH);
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo["data"][] = $respuesta;
            }
            return $arreglo;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function cargar_detalle_produccion_insumo($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            produccion_insumo.produccion_id,
            CONCAT_WS( ' ', insumo.nombre, ' - ', tipo_insumo.tipo_insumo ) AS insumo,
            produccion_insumo.cantidad 
            FROM
            produccion_insumo
            INNER JOIN insumo ON produccion_insumo.insumo_id = insumo.id
            INNER JOIN tipo_insumo ON insumo.tipo = tipo_insumo.id
            WHERE
            produccion_insumo.produccion_id = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_BOTH);
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo["data"][] = $respuesta;
            }
            return $arreglo;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function cancelar_produccion($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "UPDATE produccion SET estado = ? WHERE id = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $dato);
            $querya->bindParam(2, $id);

            if ($querya->execute()) {
                $res = 1;
            } else {
                $res = 0;
            }

            return $res;

            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function listar_produccion_combo()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            produccion.id,
            produccion.nombre,
            lote.nombre as lote
            FROM
                produccion
                INNER JOIN lote ON produccion.lote_id = lote.id 
            WHERE
            produccion.estado = 1";
            $query = $c->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_BOTH);
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo[] = $respuesta;
            }
            return $arreglo;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function traer_cantidad_semanas_produccion($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            COUNT(encinte.produccion_id) as cantidad
            FROM
            encinte WHERE encinte.produccion_id = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_BOTH);
            return $result;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function cargar_detalle_encinte_produccion($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            encinte.id,
            encinte.produccion_id,
            tipo_cinta.semana,
            encinte.fecha,
            encinte.detalle,
            tipo_cinta.color 
            FROM
                encinte
                INNER JOIN tipo_cinta ON encinte.cinta_id = tipo_cinta.id 
            WHERE
            encinte.produccion_id = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_BOTH);
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo["data"][] = $respuesta;
            }
            return $arreglo;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function cargar_detalle_produccion_racimos($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            racimos.produccion_id,
            racimos.fecha,
            racimos.tipo,
            racimos.cantidad,
            CONCAT_WS( ' ', produccion.nombre, lote.nombre ) AS lote 
            FROM
                racimos
                INNER JOIN produccion ON racimos.produccion_id = produccion.id
                INNER JOIN lote ON produccion.lote_id = lote.id 
            WHERE
            racimos.produccion_id = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_BOTH);
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo["data"][] = $respuesta;
            }
            return $arreglo;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function cargar_detalle_produccion_desechos($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            desechos.produccion_id,
            desechos.fecha,
            desechos.tipo,
            desechos.cantidad,
            CONCAT_WS( ' ', produccion.nombre, lote.nombre ) AS lote 
            FROM
                desechos
                INNER JOIN produccion ON desechos.produccion_id = produccion.id
                INNER JOIN lote ON produccion.lote_id = lote.id 
            WHERE
            desechos.produccion_id = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_BOTH);
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo["data"][] = $respuesta;
            }
            return $arreglo;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function guardar_encinte_produccion($id, $numero, $fecha, $detalle)
    {
        try {
            $n = $numero + 1;
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "INSERT INTO encinte (produccion_id, cinta_id, fecha, detalle) VALUES (?,?,?,?)";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id);
            $querya->bindParam(2, $n);
            $querya->bindParam(3, $fecha);
            $querya->bindParam(4, $detalle);

            if ($querya->execute()) {
                if ($n == 8) {
                    $sql_n = "UPDATE produccion SET estado = 2 WHERE id = ?";
                    $query_n = $c->prepare($sql_n);
                    $query_n->bindParam(1, $id);
                    $query_n->execute();
                }
                $res = 1;
            } else {
                $res = 0;
            }

            return $res;

            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function eliminar_detalle_cinta($id, $idpro)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "DELETE FROM encinte WHERE id = ? AND produccion_id = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id);
            $querya->bindParam(2, $idpro);

            if ($querya->execute()) {
                $res = 1;
            } else {
                $res = 0;
            }

            return $res;

            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function registro_frutasa($id, $fecha, $tipo, $numero)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            if ($tipo == "Racimos") {
                $sql_a = "INSERT INTO racimos (produccion_id, fecha, tipo, cantidad) VALUES (?,?,?,?)";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $id);
                $querya->bindParam(2, $fecha);
                $querya->bindParam(3, $tipo);
                $querya->bindParam(4, $numero);
            } else {
                $sql_a = "INSERT INTO desechos (produccion_id, fecha, tipo, cantidad) VALUES (?,?,?,?)";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $id);
                $querya->bindParam(2, $fecha);
                $querya->bindParam(3, $tipo);
                $querya->bindParam(4, $numero);
            }

            if ($querya->execute()) {
                $res = 1;
            } else {
                $res = 0;
            }

            return $res;

            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function listar_racimos_produccion()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            racimos.id,
            racimos.fecha,
            racimos.tipo,
            racimos.cantidad,
            CONCAT_WS( ' ', ' Nombre: ', produccion.nombre, ' - lote: ', lote.nombre ) AS lote 
            FROM
                racimos
                INNER JOIN produccion ON racimos.produccion_id = produccion.id
                INNER JOIN lote ON produccion.lote_id = lote.id 
            ORDER BY
            racimos.id DESC";
            $query = $c->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_BOTH);
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo["data"][] = $respuesta;
            }
            return $arreglo;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function listar_desecho_produccion()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            desechos.id,
            desechos.fecha,
            desechos.tipo,
            desechos.cantidad,
            CONCAT_WS( ' ', ' Nombre: ', produccion.nombre, ' - lote: ', lote.nombre ) AS lote 
            FROM
                desechos
                INNER JOIN produccion ON desechos.produccion_id = produccion.id
                INNER JOIN lote ON produccion.lote_id = lote.id 
            ORDER BY
            desechos.id DESC";
            $query = $c->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_BOTH);
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo["data"][] = $respuesta;
            }
            return $arreglo;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function eliminar_racimos_list($id)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "DELETE FROM racimos WHERE id = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id);

            if ($querya->execute()) {
                $res = 1;
            } else {
                $res = 0;
            }
            return $res;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function eliminar_desechos_list($id)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "DELETE FROM desechos WHERE id = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id);

            if ($querya->execute()) {
                $res = 1;
            } else {
                $res = 0;
            }
            return $res;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }
}

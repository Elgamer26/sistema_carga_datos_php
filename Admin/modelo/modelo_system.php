<?php
require_once 'modelo_conexion.php';
class modelo_system extends modelo_conexion
{
    function traer_datos_de_empresa()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM empresa WHERE empresa_id = 1";
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

    function editar_foto_perfil_empresa($ruta)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "UPDATE empresa SET foto = ? WHERE empresa_id = 1";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $ruta);
            if ($querya->execute()) {
                $res = 1; // SE UPDATE CORRECTAMENTE
            } else {
                $res = 0; // FALLO EN LA MATRIX
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

    function editar_empresa($nomber, $ruc, $direcc, $telefono, $correo, $dueño, $descrp, $tele_dueño)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "UPDATE empresa SET nombre = ?, ruc = ?, direccion = ?, telefono = ?, correo = ?, encargado = ?, actividad = ?, telefono_encargado = ? WHERE empresa_id = 1";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $nomber);
            $querya->bindParam(2, $ruc);
            $querya->bindParam(3, $direcc);
            $querya->bindParam(4, $telefono);
            $querya->bindParam(5, $correo);
            $querya->bindParam(6, $dueño);
            $querya->bindParam(7, $descrp);
            $querya->bindParam(8, $tele_dueño);

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

    function datos_usuario_logeado($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            usuario.usuario_id, 
            usuario.nombres, 
            usuario.apellidos, 
            usuario.correo, 
            usuario.cedula, 
            usuario.usuario, 
            usuario.`contraseña`, 
            usuario.foto, 
            usuario.rol_id, 
            rol.rol, 
            usuario.estado
            FROM
            usuario
            INNER JOIN
            rol
            ON 
            usuario.rol_id = rol.rol_id WHERE usuario.usuario_id = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
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

    function llamar_etiquetas()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "CALL llamer_etiquetas()";
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

    function herramientas_usadas()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            CONCAT_WS( ' ', herramienta.nombre, ' - ', tipo_herramienta.tipo_herramienta ) AS herramientas,
            COUNT( produccion_herramienta.herraienta_id ) AS cantidad 
            FROM
                produccion_herramienta
                INNER JOIN herramienta ON produccion_herramienta.herraienta_id = herramienta.id
                INNER JOIN tipo_herramienta ON herramienta.tipo = tipo_herramienta.id 
            GROUP BY
            produccion_herramienta.herraienta_id";
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

    function insumos_usadas()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            CONCAT_WS( ' ', insumo.nombre, ' - ', tipo_insumo.tipo_insumo ) AS insumos,
            COUNT( produccion_insumo.insumo_id ) AS cantidad 
            FROM
                produccion_insumo
                INNER JOIN insumo ON produccion_insumo.insumo_id = insumo.id
                INNER JOIN tipo_insumo ON insumo.tipo = tipo_insumo.id 
            GROUP BY
            produccion_insumo.insumo_id";
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
}

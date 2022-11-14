<?php
require_once 'modelo_conexion.php';
class modulo_inventario extends modelo_conexion
{

    function registrar_tipo_insumo($nombre)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM tipo_insumo where tipo_insumo = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {

                $sql_a = "INSERT INTO tipo_insumo (tipo_insumo) VALUES (?)";
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

    function listar_tipo_insumo()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            *
            FROM
            tipo_insumo";
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

    function estado_tipo_insumo($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_a = "UPDATE tipo_insumo SET estado = ? where id = ?";
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

    function editar_tipo_i($id, $nombre)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM tipo_insumo where tipo_insumo = ? AND id != ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre);
            $query->bindParam(2, $id);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {

                $sql_a = "UPDATE tipo_insumo SET tipo_insumo = ? WHERE id = ?";
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

    function listar_tipo_insumo_COMBO()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM tipo_insumo WHERE estado = 1";
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

    function registra_insumo($codigo, $nombre, $marca, $tipo, $precio, $cantidad, $descripcion, $ruta)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM insumo where codigo = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $codigo);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {

                $sql_a = "INSERT INTO insumo (codigo, nombre, marca, tipo, precio, cantidad, descripcion, ruta) VALUES (?,?,?,?,?,?,?,?)";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $codigo);
                $querya->bindParam(2, $nombre);
                $querya->bindParam(3, $marca);
                $querya->bindParam(4, $tipo);
                $querya->bindParam(5, $precio);
                $querya->bindParam(6, $cantidad);
                $querya->bindParam(7, $descripcion);
                $querya->bindParam(8, $ruta);

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

    function llistar_tabla_insumo()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            insumo.id,
            insumo.codigo,
            insumo.nombre,
            insumo.marca,
            insumo.tipo,
            insumo.precio,
            insumo.cantidad,
            insumo.descripcion,
            insumo.ruta,
            insumo.estado,
            insumo.eliminado,
            tipo_insumo.tipo_insumo 
            FROM
            insumo
            INNER JOIN tipo_insumo ON insumo.tipo = tipo_insumo.id";
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

    function cambiar_estado_insumo($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_a = "UPDATE insumo SET estado = ? where id = ?";
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

    function editar_insumo($id ,$codigo, $nombre, $marca, $tipo, $precio, $cantidad, $descripcion)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM insumo where codigo = ? AND id != ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $codigo);
            $query->bindParam(2, $id);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {

                $sql_a = "UPDATE insumo SET codigo = ?, nombre = ?, marca = ?, tipo = ?, precio = ?, cantidad = ?, descripcion = ? WHERE id = ?";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $codigo);
                $querya->bindParam(2, $nombre);
                $querya->bindParam(3, $marca);
                $querya->bindParam(4, $tipo);
                $querya->bindParam(5, $precio);
                $querya->bindParam(6, $cantidad);
                $querya->bindParam(7, $descripcion);
                $querya->bindParam(8, $id);

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

    function editar_foto_insumo($id, $ruta)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_a = "UPDATE insumo SET ruta = ? where id = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $ruta);
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

    function registrar_tipo_herramienta($nombre)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM tipo_herramienta where tipo_herramienta = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {

                $sql_a = "INSERT INTO tipo_herramienta (tipo_herramienta) VALUES (?)";
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

    function listar_tipo_herramienta()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            *
            FROM
            tipo_herramienta";
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

    function cambiar_estado_tipo_e($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_a = "UPDATE tipo_herramienta SET estado = ? where id = ?";
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

    function editar_tipo_h($id, $nombre)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM tipo_herramienta where tipo_herramienta = ? AND id != ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre);
            $query->bindParam(2, $id);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {

                $sql_a = "UPDATE tipo_herramienta SET tipo_herramienta = ? WHERE id = ?";
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

    function listar_tipo_herramienta_COMBO()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM tipo_herramienta WHERE estado = 1";
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

    function registra_herramienta($codigo, $nombre, $marca, $tipo, $precio, $cantidad, $descripcion, $ruta)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM herramienta where codigo = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $codigo);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {

                $sql_a = "INSERT INTO herramienta (codigo, nombre, marca, tipo, precio, cantidad, descripcion, ruta) VALUES (?,?,?,?,?,?,?,?)";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $codigo);
                $querya->bindParam(2, $nombre);
                $querya->bindParam(3, $marca);
                $querya->bindParam(4, $tipo);
                $querya->bindParam(5, $precio);
                $querya->bindParam(6, $cantidad);
                $querya->bindParam(7, $descripcion);
                $querya->bindParam(8, $ruta);

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

    function listar_tabla_herramienta()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            herramienta.id,
            herramienta.codigo,
            herramienta.nombre,
            herramienta.marca,
            herramienta.tipo,
            herramienta.precio,
            herramienta.cantidad,
            herramienta.descripcion,
            herramienta.ruta,
            herramienta.estado,
            herramienta.eliminado,
            tipo_herramienta.tipo_herramienta 
            FROM
            herramienta
            INNER JOIN tipo_herramienta ON herramienta.tipo = tipo_herramienta.id";
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

    function cambiar_estado_herramienta($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_a = "UPDATE herramienta SET estado = ? where id = ?";
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

    function editar_herramienta($id, $codigo, $nombre, $marca, $tipo, $precio, $cantidad, $descripcion)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM herramienta where codigo = ? AND id != ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $codigo);
            $query->bindParam(2, $id);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {

                $sql_a = "UPDATE herramienta SET codigo = ?, nombre = ?, marca = ?, tipo = ?, precio = ?, cantidad = ?, descripcion = ? WHERE id = ?";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $codigo);
                $querya->bindParam(2, $nombre);
                $querya->bindParam(3, $marca);
                $querya->bindParam(4, $tipo);
                $querya->bindParam(5, $precio);
                $querya->bindParam(6, $cantidad);
                $querya->bindParam(7, $descripcion);
                $querya->bindParam(8, $id);

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

    function editar_foto_herramienta($id, $ruta)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_a = "UPDATE herramienta SET ruta = ? where id = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $ruta);
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

    function registra_proveedor($razon_social, $ruc, $telefono, $direccion, $correo, $encargado, $descripcion)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM proveedor where ruc = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $ruc);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {

                $sql_a = "INSERT INTO proveedor (razon_social, ruc, telefono, direccion, correo, encargado, descripcion) VALUES (?,?,?,?,?,?,?)";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $razon_social);
                $querya->bindParam(2, $ruc);
                $querya->bindParam(3, $telefono);
                $querya->bindParam(4, $direccion);
                $querya->bindParam(5, $correo);
                $querya->bindParam(6, $encargado);
                $querya->bindParam(7, $descripcion);

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

    function listar_tabla_proveedor()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            *
            FROM
            proveedor";
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

    function cambiar_estado_proveedor($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_a = "UPDATE proveedor SET estado = ? where id = ?";
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

    function editara_proveedor($id, $razon_social, $ruc, $telefono, $direccion, $correo, $encargado, $descripcion)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM proveedor where ruc = ? AND id != ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $ruc);
            $query->bindParam(2, $id);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {

                $sql_a = "UPDATE proveedor SET razon_social = ?, ruc = ?, telefono = ?, direccion = ?, correo = ?, encargado = ?, descripcion = ? WHERE id = ?";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $razon_social);
                $querya->bindParam(2, $ruc);
                $querya->bindParam(3, $telefono);
                $querya->bindParam(4, $direccion);
                $querya->bindParam(5, $correo);
                $querya->bindParam(6, $encargado);
                $querya->bindParam(7, $descripcion);
                $querya->bindParam(8, $id);

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

    function listar_proveedor_combo()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM proveedor WHERE estado = 1";
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

    function listar_isnumos_disponibles()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            insumo.id,
            insumo.codigo,
            insumo.nombre,
            insumo.marca,
            insumo.tipo,
            insumo.precio,
            insumo.cantidad,
            insumo.descripcion,
            insumo.ruta,
            insumo.estado,
            insumo.eliminado,
            tipo_insumo.tipo_insumo 
            FROM
            insumo
            INNER JOIN tipo_insumo ON insumo.tipo = tipo_insumo.id WHERE insumo.estado = 1";
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

    function registrar_compra_insumo($proveedor, $fecha, $numero_compra, $tipo_comprobante, $iva, $txt_totalneto, $txt_impuesto, $txt_a_pagar)
    {
        try {
            $res = ""; 
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM compra_insumos where numero_compra = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $numero_compra);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {

                $sql_a = "INSERT INTO compra_insumos (proveedor, fecha, numero_compra, tipo_comprobante, iva, txt_totalneto, txt_impuesto, txt_a_pagar) VALUES (?,?,?,?,?,?,?,?)";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $proveedor);
                $querya->bindParam(2, $fecha);
                $querya->bindParam(3, $numero_compra);
                $querya->bindParam(4, $tipo_comprobante);
                $querya->bindParam(5, $iva);
                $querya->bindParam(6, $txt_totalneto);
                $querya->bindParam(7, $txt_impuesto);
                $querya->bindParam(8, $txt_a_pagar);

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

    function registrar_detalle_compra_insumo(
        $id,
        $arraglo_idpm,
        $arraglo_cantidad,
        $arraglo_precio,
        $arraglo_des,
        $arraglo_sutotal
    ) {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "INSERT INTO detalle_compra_insumo (id_compra, id_insumo, cantidad, precio, descuento, total) VALUES (?,?,?,?,?,?)";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id);
            $querya->bindParam(2, $arraglo_idpm);
            $querya->bindParam(3, $arraglo_cantidad);
            $querya->bindParam(4, $arraglo_precio);
            $querya->bindParam(5, $arraglo_des);
            $querya->bindParam(6, $arraglo_sutotal);

            if ($querya->execute()) {

                $sql_p = "SELECT cantidad FROM insumo where id = ?";
                $query_p = $c->prepare($sql_p);
                $query_p->bindParam(1, $arraglo_idpm);
                $query_p->execute();
                $data = $query_p->fetch(PDO::FETCH_BOTH);
                $arreglo = array();
                foreach ($data as $respuesta) {
                    $arreglo[] = $respuesta;
                }

                $stock = $arreglo[0];
                if ($stock == "" || $stock == 0) {
                    $stock = 0;
                }
                $stock = $stock + $arraglo_cantidad;

                $sql_m = "UPDATE insumo SET cantidad = ? where id = ?";
                $query_m = $c->prepare($sql_m);
                $query_m->bindParam(1, $stock);
                $query_m->bindParam(2, $arraglo_idpm);
                if ($query_m->execute()) {
                    $res = 1;
                } else {
                    $res = 0; // error de update
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

    function listar_compras_insumos()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            compra_insumos.id,
            proveedor.razon_social,
            compra_insumos.fecha,
            compra_insumos.numero_compra,
            compra_insumos.tipo_comprobante,
            compra_insumos.iva,
            compra_insumos.txt_totalneto,
            compra_insumos.txt_impuesto,
            compra_insumos.txt_a_pagar,
            compra_insumos.estado 
            FROM
            compra_insumos
            INNER JOIN proveedor ON compra_insumos.proveedor = proveedor.id";
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

    function anular_compra_insumo($id)
    {
        try {
            $res = "";
            $stock = 0;
            $c = modelo_conexion::conexionPDO();

            $sql_c = "SELECT * FROM detalle_compra_insumo WHERE id_compra = ?";
            $query_c = $c->prepare($sql_c);
            $query_c->bindParam(1, $id);
            $query_c->execute();
            $data = $query_c->fetchAll(PDO::FETCH_BOTH);
            foreach ($data as $respuesta) {

                $sql_a = "SELECT * FROM insumo WHERE id = ?";
                $query_a = $c->prepare($sql_a);
                $query_a->bindParam(1, $respuesta[2]);
                $query_a->execute();
                $dato = $query_a->fetchAll(PDO::FETCH_BOTH);
                foreach ($dato as $respuesto) {

                    //stok
                    $stock =  $respuesto[6] - $respuesta[3];

                    $sql_p = "UPDATE insumo SET cantidad = ? where id = ?";
                    $query_p = $c->prepare($sql_p);
                    $query_p->bindParam(1, $stock);
                    $query_p->bindParam(2, $respuesta[2]);

                    if ($query_p->execute()) {
                        $sql_d = "UPDATE detalle_compra_insumo SET estado = 0 where id_compra = ?";
                        $query_d = $c->prepare($sql_d);
                        $query_d->bindParam(1, $id);
                        $query_d->execute();
                    }
                }
            }

            $sql_F = "UPDATE compra_insumos SET estado = 0 WHERE id = ?";
            $query_F = $c->prepare($sql_F);
            $query_F->bindParam(1, $id);
            if ($query_F->execute()) {
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

    function listar_herramientas_disponibles()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            herramienta.id,
            herramienta.codigo,
            herramienta.nombre,
            herramienta.marca,
            herramienta.tipo,
            herramienta.precio,
            herramienta.cantidad,
            herramienta.descripcion,
            herramienta.ruta,
            herramienta.estado,
            herramienta.eliminado,
            tipo_herramienta.tipo_herramienta 
            FROM
            herramienta
            INNER JOIN tipo_herramienta ON herramienta.tipo = tipo_herramienta.id WHERE herramienta.estado = 1";
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

    function registrar_compra_herramienta($proveedor, $fecha, $numero_compra, $tipo_comprobante, $iva, $txt_totalneto, $txt_impuesto, $txt_a_pagar)
    {
        try {
            $res = ""; 
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM compra_herramienta where numero_compra = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $numero_compra);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {

                $sql_a = "INSERT INTO compra_herramienta (proveedor, fecha, numero_compra, tipo_comprobante, iva, txt_totalneto, txt_impuesto, txt_a_pagar) VALUES (?,?,?,?,?,?,?,?)";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $proveedor);
                $querya->bindParam(2, $fecha);
                $querya->bindParam(3, $numero_compra);
                $querya->bindParam(4, $tipo_comprobante);
                $querya->bindParam(5, $iva);
                $querya->bindParam(6, $txt_totalneto);
                $querya->bindParam(7, $txt_impuesto);
                $querya->bindParam(8, $txt_a_pagar);

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

    function registrar_detalle_compra_herramienta(
        $id,
        $arraglo_idpm,
        $arraglo_cantidad,
        $arraglo_precio,
        $arraglo_des,
        $arraglo_sutotal
    ) {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "INSERT INTO detalle_compra_herramienta (id_compra, id_herramienta, cantidad, precio, descuento, total) VALUES (?,?,?,?,?,?)";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id);
            $querya->bindParam(2, $arraglo_idpm);
            $querya->bindParam(3, $arraglo_cantidad);
            $querya->bindParam(4, $arraglo_precio);
            $querya->bindParam(5, $arraglo_des);
            $querya->bindParam(6, $arraglo_sutotal);

            if ($querya->execute()) {

                $sql_p = "SELECT cantidad FROM herramienta where id = ?";
                $query_p = $c->prepare($sql_p);
                $query_p->bindParam(1, $arraglo_idpm);
                $query_p->execute();
                $data = $query_p->fetch(PDO::FETCH_BOTH);
                $arreglo = array();
                foreach ($data as $respuesta) {
                    $arreglo[] = $respuesta;
                }

                $stock = $arreglo[0];
                if ($stock == "" || $stock == 0) {
                    $stock = 0;
                }
                $stock = $stock + $arraglo_cantidad;

                $sql_m = "UPDATE herramienta SET cantidad = ? where id = ?";
                $query_m = $c->prepare($sql_m);
                $query_m->bindParam(1, $stock);
                $query_m->bindParam(2, $arraglo_idpm);
                if ($query_m->execute()) {
                    $res = 1;
                } else {
                    $res = 0; // error de update
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

    function listar_compras_herramienta()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            compra_herramienta.id,
            proveedor.razon_social,
            compra_herramienta.fecha,
            compra_herramienta.numero_compra,
            compra_herramienta.tipo_comprobante,
            compra_herramienta.iva,
            compra_herramienta.txt_totalneto,
            compra_herramienta.txt_impuesto,
            compra_herramienta.txt_a_pagar,
            compra_herramienta.estado 
            FROM
            compra_herramienta
            INNER JOIN proveedor ON compra_herramienta.proveedor = proveedor.id";
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

    function anular_compra_herramienta($id)
    {
        try {
            $res = "";
            $stock = 0;
            $c = modelo_conexion::conexionPDO();

            $sql_c = "SELECT * FROM detalle_compra_herramienta WHERE id_compra = ?";
            $query_c = $c->prepare($sql_c);
            $query_c->bindParam(1, $id);
            $query_c->execute();
            $data = $query_c->fetchAll(PDO::FETCH_BOTH);
            foreach ($data as $respuesta) {

                $sql_a = "SELECT * FROM herramienta WHERE id = ?";
                $query_a = $c->prepare($sql_a);
                $query_a->bindParam(1, $respuesta[2]);
                $query_a->execute();
                $dato = $query_a->fetchAll(PDO::FETCH_BOTH);
                foreach ($dato as $respuesto) {

                    //stok
                    $stock =  $respuesto[6] - $respuesta[3];

                    $sql_p = "UPDATE herramienta SET cantidad = ? where id = ?";
                    $query_p = $c->prepare($sql_p);
                    $query_p->bindParam(1, $stock);
                    $query_p->bindParam(2, $respuesta[2]);

                    if ($query_p->execute()) {
                        $sql_d = "UPDATE detalle_compra_herramienta SET estado = 0 where id_compra = ?";
                        $query_d = $c->prepare($sql_d);
                        $query_d->bindParam(1, $id);
                        $query_d->execute();
                    }
                }
            }

            $sql_F = "UPDATE compra_herramienta SET estado = 0 WHERE id = ?";
            $query_F = $c->prepare($sql_F);
            $query_F->bindParam(1, $id);
            if ($query_F->execute()) {
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
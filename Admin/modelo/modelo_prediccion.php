<?php
require_once 'modelo_conexion.php';
class modelo_prediccion extends modelo_conexion
{
    ///// cajas
    function cargar_excel_caja($ruta)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM archivo_caja where nombre = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $ruta);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {

                $sql_a = "INSERT INTO archivo_caja (nombre,fecha) VALUES (?,CURDATE())";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $ruta);

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

    function cargar_excel_cajas_()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM archivo_caja WHERE estado = 1";
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

    function eliminar_archivo_excel_cajas($id)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "DELETE FROM archivo_caja WHERE id = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id);

            if ($querya->execute()) {
                // $sql_b = "UPDATE caja_excel SET estado = 0 WHERE id_excel = ?";
                // $queryb = $c->prepare($sql_b);
                // $queryb->bindParam(1, $id);
                // if ($queryb->execute()) {
                $res = 1;
                // } else {
                //     $res = 0;
                // }
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

    function Tabla_data_excel_cajas($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT *
            FROM caja_excel WHERE estado = 1 AND id_excel = ?";
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

    ////////// enfunde
    function cargar_excel_enfunde($ruta)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM archivo_enfunde where nombre = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $ruta);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {

                $sql_a = "INSERT INTO archivo_enfunde (nombre,fecha) VALUES (?,CURDATE())";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $ruta);

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

    function cargar_excel_enfunde_()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM archivo_enfunde WHERE estado = 1";
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

    function eliminar_archivo_excel_funda($id)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "DELETE FROM archivo_enfunde WHERE id = ?";
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

    function Tabla_data_excel_enfunde($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            tipo_cinta.color, 
            tipo_cinta.semana, 
            enfunde_excel.lote_1A, 
            enfunde_excel.lote_1B, 
            enfunde_excel.lote_1C, 
            enfunde_excel.lote_2, 
            enfunde_excel.lote_3, 
            enfunde_excel.lote_4, 
            enfunde_excel.lote_5, 
            enfunde_excel.lote_6, 
            enfunde_excel.lote_7, 
            enfunde_excel.lote_8, 
            enfunde_excel.lote_A, 
            enfunde_excel.lote_B, 
            enfunde_excel.lote_C, 
            enfunde_excel.lote_D, 
            enfunde_excel.total, 
            enfunde_excel.estado, 
            enfunde_excel.fecha
           FROM
            enfunde_excel
            INNER JOIN
            tipo_cinta
            ON 
            enfunde_excel.id_cinta = tipo_cinta.id 
            WHERE enfunde_excel.estado = 1 AND enfunde_excel.id_excel = ?";
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

    ////////// recobro
    function cargar_excel_recobro($ruta)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM archivo_recobro where nombre = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $ruta);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {

                $sql_a = "INSERT INTO archivo_recobro (nombre,fecha) VALUES (?,CURDATE())";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $ruta);

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

    function cargar_excel_recobro_()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM archivo_recobro WHERE estado = 1";
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

    function eliminar_archivo_excel_recargo($id)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "DELETE FROM archivo_recobro WHERE id = ?";
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

    function Tabla_data_excel_recobro($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            tipo_cinta.color,
            recobro_excel.1A_cai,
            recobro_excel.1A_saldo,
            recobro_excel.1B_cai,
            recobro_excel.1B_saldo,
            recobro_excel.1C_cai,
            recobro_excel.1C_saldo,
            recobro_excel.2_cai,
            recobro_excel.2_saldo,
            recobro_excel.3_cai,
            recobro_excel.3_saldo,
            recobro_excel.4_cai,
            recobro_excel.4_saldo,
            recobro_excel.5_cai,
            recobro_excel.5_saldo,
            recobro_excel.6_cai,
            recobro_excel.6_saldo,
            recobro_excel.7_cai,
            recobro_excel.7_saldo,
            recobro_excel.8_cai,
            recobro_excel.8_saldo,
            recobro_excel.A_cai,
            recobro_excel.A_saldo,
            recobro_excel.B_cai,
            recobro_excel.B_saldo,
            recobro_excel.C_cai,
            recobro_excel.C_saldo,
            recobro_excel.D_cai,
            recobro_excel.D_saldo,
            recobro_excel.caidos,
            recobro_excel.total,
            recobro_excel.saldos,
            recobro_excel.porcentaje,
            recobro_excel.id_excel,
            recobro_excel.id 
        FROM
            recobro_excel
            INNER JOIN tipo_cinta ON recobro_excel.id_cinta = tipo_cinta.id 
        WHERE
            recobro_excel.id_excel = ?
        ORDER BY
            recobro_excel.id ASC";
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


    ///////////////
    function Llamar_dato_grafica($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            CONCAT_WS(' ', caja_excel.dia, caja_excel.fecha ) AS FECHA,
            caja_excel.caja,
            caja_excel.caja2 
            FROM
                caja_excel 
            WHERE
                caja_excel.id_excel = ?
            ORDER BY
                caja_excel.id ASC";
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

    //// enfundes
    function Llamar_total_grafica($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            caja_excel.tipo_caja, 
            SUM(caja_excel.caja) as caja1, 
            SUM(caja_excel.caja2) as caja2
            FROM
            caja_excel WHERE
            caja_excel.id_excel = ?
            GROUP BY caja_excel.tipo_caja";
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

    ///////////////
    function Llamar_dato_grafica_enfunde($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            tipo_cinta.semana,
            enfunde_excel.total 
            FROM
                enfunde_excel
                INNER JOIN tipo_cinta ON enfunde_excel.id_cinta = tipo_cinta.id 
                WHERE
                enfunde_excel.id_excel = ?
            ORDER BY
            enfunde_excel.id ASC";
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

    function Llamar_graficas_fundas_primeros_lotes($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            tipo_cinta.semana, 
            enfunde_excel.lote_1A, 
            enfunde_excel.lote_1B, 
            enfunde_excel.lote_1C
            FROM
                enfunde_excel
                INNER JOIN
                tipo_cinta
                ON 
                    enfunde_excel.id_cinta = tipo_cinta.id
                    WHERE
                    enfunde_excel.id_excel = ?
            ORDER BY
            enfunde_excel.id ASC";
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

    function Llamar_graficas_fundas_segundos_lotes($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            tipo_cinta.semana, 
            enfunde_excel.lote_2, 
            enfunde_excel.lote_3, 
            enfunde_excel.lote_4, 
            enfunde_excel.lote_5
            FROM
                enfunde_excel
                INNER JOIN
                tipo_cinta
                ON 
                enfunde_excel.id_cinta = tipo_cinta.id
                WHERE
            enfunde_excel.id_excel = ?
            ORDER BY
            enfunde_excel.id ASC ";
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

    function Llamar_graficas_fundas_tercer_lotes($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            tipo_cinta.semana, 
            enfunde_excel.lote_6, 
            enfunde_excel.lote_7, 
            enfunde_excel.lote_8
            FROM
                enfunde_excel
                INNER JOIN
                tipo_cinta
                ON 
                    enfunde_excel.id_cinta = tipo_cinta.id
                    WHERE
                enfunde_excel.id_excel = ?
            ORDER BY
            enfunde_excel.id ASC";
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

    function Llamar_graficas_fundas_cuarto_lotes($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            tipo_cinta.semana,
            enfunde_excel.lote_A,
            enfunde_excel.lote_B,
            enfunde_excel.lote_C,
            enfunde_excel.lote_D 
            FROM
                enfunde_excel
                INNER JOIN tipo_cinta ON enfunde_excel.id_cinta = tipo_cinta.id 
            WHERE
                enfunde_excel.id_excel = ? 
            ORDER BY
            enfunde_excel.id ASC";
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

    function Llamar_total_fundas_lotes($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "CALL total_enfunde_lotes(?)";
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

    //// recobros de cintas
    function Llamar_dato_grafica_recobro($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            tipo_cinta.semana,
            recobro_excel.total 
            FROM
                recobro_excel
                INNER JOIN tipo_cinta ON recobro_excel.id_cinta = tipo_cinta.id 
            WHERE
                recobro_excel.id_excel = ? 
            ORDER BY
            recobro_excel.id ASC";
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

    function Llamar_dato_grafica_recobro_saldo_caidos($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            tipo_cinta.semana,
            recobro_excel.caidos,
            recobro_excel.saldos 
            FROM
                recobro_excel
                INNER JOIN tipo_cinta ON recobro_excel.id_cinta = tipo_cinta.id
            WHERE
                recobro_excel.id_excel = ?
            ORDER BY
            recobro_excel.id ASC";
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

    function recobro_total_caidos_saldo_lote($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "CALL recobro_total_caidos_lote(?)";
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

    // para los caidos
    function recobro_caidos_semana_uno($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            tipo_cinta.semana, 
            recobro_excel.1A_cai, 
            recobro_excel.1B_cai, 
            recobro_excel.1C_cai, 
            recobro_excel.2_cai
            FROM
                recobro_excel
                INNER JOIN
                tipo_cinta
                ON 
                    recobro_excel.id_cinta = tipo_cinta.id
            WHERE
                recobro_excel.id_excel = ?
            ORDER BY
            recobro_excel.id ASC";
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

    function recobro_caidos_semana_dos($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            tipo_cinta.semana, 
            recobro_excel.3_cai, 
            recobro_excel.4_cai, 
            recobro_excel.5_cai, 
            recobro_excel.6_cai
            FROM
                recobro_excel
                INNER JOIN
                tipo_cinta
                ON 
                    recobro_excel.id_cinta = tipo_cinta.id
            WHERE
                recobro_excel.id_excel = ?
            ORDER BY
            recobro_excel.id ASC";
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

    function recobro_caidos_semana_tres($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            tipo_cinta.semana, 
            recobro_excel.7_cai, 
            recobro_excel.8_cai, 
            recobro_excel.A_cai, 
            recobro_excel.B_cai
            FROM
                recobro_excel
                INNER JOIN
                tipo_cinta
                ON 
                    recobro_excel.id_cinta = tipo_cinta.id
            WHERE
                recobro_excel.id_excel = ?
            ORDER BY
            recobro_excel.id ASC";
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

    function recobro_caidos_semana_cuatro($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            tipo_cinta.semana, 
            recobro_excel.C_cai, 
            recobro_excel.D_cai
            FROM
                recobro_excel
                INNER JOIN
                tipo_cinta
                ON 
                recobro_excel.id_cinta = tipo_cinta.id
            WHERE
                recobro_excel.id_excel = ?
            ORDER BY
            recobro_excel.id ASC";
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

    // para los saldo
    function recobro_saldos_semana_uno($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            tipo_cinta.semana,
            recobro_excel.1A_saldo,
            recobro_excel.1B_saldo,
            recobro_excel.1C_saldo,
            recobro_excel.2_saldo 
            FROM
                recobro_excel
                INNER JOIN tipo_cinta ON recobro_excel.id_cinta = tipo_cinta.id 
            WHERE
                recobro_excel.id_excel = ? 
            ORDER BY
            recobro_excel.id ASC";
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

    function recobro_saldos_semana_dos($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            tipo_cinta.semana,
            recobro_excel.3_saldo,
            recobro_excel.4_saldo,
            recobro_excel.5_saldo,
            recobro_excel.6_saldo 
            FROM
                recobro_excel
                INNER JOIN tipo_cinta ON recobro_excel.id_cinta = tipo_cinta.id 
            WHERE
                recobro_excel.id_excel = ? 
            ORDER BY
            recobro_excel.id ASC";
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

    function recobro_saldos_semana_tres($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            tipo_cinta.semana,
            recobro_excel.7_saldo,
            recobro_excel.8_saldo,
            recobro_excel.A_saldo,
            recobro_excel.B_saldo 
            FROM
                recobro_excel
                INNER JOIN tipo_cinta ON recobro_excel.id_cinta = tipo_cinta.id 
            WHERE
                recobro_excel.id_excel = ? 
            ORDER BY
            recobro_excel.id ASC";
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

    function recobro_saldos_semana_cuatro($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            tipo_cinta.semana,
            recobro_excel.C_saldo,
            recobro_excel.D_saldo 
            FROM
                recobro_excel
                INNER JOIN tipo_cinta ON recobro_excel.id_cinta = tipo_cinta.id 
            WHERE
                recobro_excel.id_excel = ? 
            ORDER BY
            recobro_excel.id ASC";
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

    //PORCENTAJE
    function recobro_porcentaje($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            tipo_cinta.semana,
            recobro_excel.porcentaje 
            FROM
                recobro_excel
                INNER JOIN tipo_cinta ON recobro_excel.id_cinta = tipo_cinta.id 
            WHERE
                recobro_excel.id_excel = ? 
            ORDER BY
            recobro_excel.id ASC";
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
}

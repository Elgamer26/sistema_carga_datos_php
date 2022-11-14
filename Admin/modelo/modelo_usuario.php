<?php
require_once 'modelo_conexion.php';
class modelo_usuario extends modelo_conexion
{
    function verifcar_usuario($usuario, $passs)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            usuario.usuario_id,
            usuario.usuario,
            usuario.`contraseña`,
            usuario.estado,
            usuario.rol_id
            FROM
                usuario 
            WHERE
            BINARY usuario.usuario = ? 
            AND BINARY usuario.`contraseña` = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $usuario);
            $query->bindParam(2, $passs);
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

    function verificar_correo($correo)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            correo
            FROM
            usuario 
            WHERE
            BINARY correo = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $correo);
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

    // function retablecer_password($correo, $password)
    // {
    //     try {
    //         $res = "";
    //         $c = modelo_conexion::conexionPDO();

    //         $sql_a = "UPDATE usuario SET contraseña = ? WHERE correo = ?";
    //         $querya = $c->prepare($sql_a);
    //         $querya->bindParam(1, $password);
    //         $querya->bindParam(2, $correo);

    //         if ($querya->execute()) {
    //             $res = 1;
    //         } else {
    //             $res = 0;
    //         }

    //         return $res;

    //         //cerramos la conexion
    //         modelo_conexion::cerrar_conexion();
    //     } catch (Exception $e) {
    //         modelo_conexion::cerrar_conexion();
    //         echo "Error: " . $e->getMessage();
    //     }
    //     exit();
    // }


    function listar_rol()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            rol.rol_id, 
            rol.rol, 
            rol.estado
            FROM
            rol";
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

    function registrar_rol($nombre)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM rol where rol = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {

                $sql_a = "INSERT INTO rol (rol) VALUES (?)";
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

    function estado_rol($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_a = "UPDATE rol SET estado = ? where rol_id = ?";
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

    function editar_rol($id, $nombre)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM rol where rol = ? AND rol_id != ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre);
            $query->bindParam(2, $id);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {

                $sql_a = "UPDATE rol SET rol = ? WHERE rol_id = ?";
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

    function listar_rol_usu()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM rol WHERE estado = 1";
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

    function registra_usuario($nombres, $apellidos, $correo, $cedula, $tipo_rol, $usuario, $password, $ruta)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM usuario where correo = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $correo);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {

                $sql_c = "SELECT * FROM usuario where cedula = ?";
                $query_c = $c->prepare($sql_c);
                $query_c->bindParam(1, $cedula);
                $query_c->execute();
                $data_c = $query_c->fetch(PDO::FETCH_ASSOC);
                if (empty($data_c)) {

                    $sql_u = "SELECT * FROM usuario where usuario = ?";
                    $query_u = $c->prepare($sql_u);
                    $query_u->bindParam(1, $usuario);
                    $query_u->execute();
                    $data_u = $query_u->fetch(PDO::FETCH_ASSOC);
                    if (empty($data_u)) {

                        $sql_a = "INSERT INTO usuario (nombres, apellidos, correo, cedula, usuario, contraseña, foto, rol_id) 
                        VALUES (?,?,?,?,?,?,?,?)";
                        $querya = $c->prepare($sql_a);
                        $querya->bindParam(1, $nombres);
                        $querya->bindParam(2, $apellidos);
                        $querya->bindParam(3, $correo);
                        $querya->bindParam(4, $cedula);
                        $querya->bindParam(5, $usuario);
                        $querya->bindParam(6, $password);
                        $querya->bindParam(7, $ruta);
                        $querya->bindParam(8, $tipo_rol);

                        if ($querya->execute()) {
                            $res = 1;
                        } else {
                            $res = 0;
                        }
                    } else {
                        $res = 4; // ya esxiste usuario
                    }
                } else {
                    $res = 3; // ya esxiste cedula
                }
            } else {
                $res = 2; // ya esxiste correo
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

    function listar_usuario()
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
            usuario.rol_id = rol.rol_id";
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

    function cambiar_estado_usuario($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_a = "UPDATE usuario SET estado = ? where usuario_id = ?";
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

    function editar_foto_usuario($id, $ruta)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_a = "UPDATE usuario SET foto = ? where usuario_id = ?";
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

    function editando_usuario($id, $nombres, $apellidos, $correo, $cedula, $tipo_rol, $usuario)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM usuario where correo = ? AND usuario_id != ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $correo);
            $query->bindParam(2, $id);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {

                $sql_c = "SELECT * FROM usuario where cedula = ? AND usuario_id != ?";
                $query_c = $c->prepare($sql_c);
                $query_c->bindParam(1, $cedula);
                $query_c->bindParam(2, $id);
                $query_c->execute();
                $data_c = $query_c->fetch(PDO::FETCH_ASSOC);
                if (empty($data_c)) {

                    $sql_u = "SELECT * FROM usuario where usuario = ? AND usuario_id != ?";
                    $query_u = $c->prepare($sql_u);
                    $query_u->bindParam(1, $usuario);
                    $query_u->bindParam(2, $id);
                    $query_u->execute();
                    $data_u = $query_u->fetch(PDO::FETCH_ASSOC);
                    if (empty($data_u)) {

                        $sql_a = "UPDATE usuario SET nombres = ?, apellidos = ?, correo = ?, cedula = ?, usuario = ?, rol_id = ? WHERE usuario_id = ?";
                        $querya = $c->prepare($sql_a);
                        $querya->bindParam(1, $nombres);
                        $querya->bindParam(2, $apellidos);
                        $querya->bindParam(3, $correo);
                        $querya->bindParam(4, $cedula);
                        $querya->bindParam(5, $usuario);
                        $querya->bindParam(6, $tipo_rol);
                        $querya->bindParam(7, $id);

                        if ($querya->execute()) {
                            $res = 1;
                        } else {
                            $res = 0;
                        }
                    } else {
                        $res = 4; // ya esxiste usuario
                    }
                } else {
                    $res = 3; // ya esxiste cedula
                }
            } else {
                $res = 2; // ya esxiste correo
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

    function editando_usuario_logeado($id, $nombres, $apellidos, $correo, $usuario)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM usuario where correo = ? AND usuario_id != ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $correo);
            $query->bindParam(2, $id);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {

                $sql_u = "SELECT * FROM usuario where usuario = ? AND usuario_id != ?";
                $query_u = $c->prepare($sql_u);
                $query_u->bindParam(1, $usuario);
                $query_u->bindParam(2, $id);
                $query_u->execute();
                $data_u = $query_u->fetch(PDO::FETCH_ASSOC);
                if (empty($data_u)) {

                    $sql_a = "UPDATE usuario SET nombres = ?, apellidos = ?, correo = ?, usuario = ? WHERE usuario_id = ?";
                    $querya = $c->prepare($sql_a);
                    $querya->bindParam(1, $nombres);
                    $querya->bindParam(2, $apellidos);
                    $querya->bindParam(3, $correo);
                    $querya->bindParam(4, $usuario);
                    $querya->bindParam(5, $id);

                    if ($querya->execute()) {
                        $res = 1;
                    } else {
                        $res = 0;
                    }
                } else {
                    $res = 3; // ya esxiste correo
                }
            } else {
                $res = 2; // ya esxiste usuaio
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

    function editar_passwoed_logeado($id, $pass_nue)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "UPDATE usuario SET contraseña = ? WHERE usuario_id = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $pass_nue);
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
}

<?php
require '../../modelo/modelo_prediccion.php';
require '../../modelo/conect/conect.php';
$MPD = new modelo_prediccion();

///////////////////////////////////// cajas
if ($_POST["funcion"] === "cargar_excel_caja") {

    $nombrearchivo = htmlspecialchars($_POST['nombrearchivo'], ENT_QUOTES, 'UTF-8');
    //esto es para saber si el file trae datos

    if (is_array($_FILES) && count($_FILES) > 0) {
        $ruta = 'img/archivo_cajas/' . $nombrearchivo . '.xlsx';
        $consulta = $MPD->cargar_excel_caja($ruta);

        if ($consulta === 0 || $consulta === 2) {
            echo $consulta;
        } else {

            if (move_uploaded_file($_FILES['foto']["tmp_name"], "../../img/archivo_cajas/" . $nombrearchivo . ".xlsx")) {

                require 'vendor/autoload.php';
                // para tener los datos de una celda especifica mayores al numero colocado e la funcion
                class MyReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter
                {
                    public function readCell($columnAddress, $row, $worksheetName = '')
                    {
                        if ($row > 3) {
                            return true;
                        }
                        return false;
                    }
                }

                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                $inputFileName = '../../img/archivo_cajas/' . $nombrearchivo . '.xlsx';

                $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
                $reader->setReadFilter(new MyReadFilter());
                $spreadsheet = $reader->load($inputFileName);
                $cantidad = $spreadsheet->getActiveSheet()->toArray();

                try {
                    $count = 0;

                    foreach ($cantidad as $dia) {

                        if ($dia[1] != '') {
                            $fecha = date('Y-m-d', strtotime($dia[2]));
                            $count++;
                            $sql = "INSERT INTO caja_excel (id,id_excel,dia,fecha,caja,peso_prim,caja2,pes_seg,tipo_caja,contenedor,fecha_carga) 
                                     VALUES ('$count', '$consulta', '$dia[1]', '$fecha', '$dia[3]', '$dia[4]', '$dia[5]', '$dia[6]', '$dia[7]', '$dia[8]',CURDATE())";
                            $result = $mysqli->query($sql);
                        }
                    }

                    exit($mysqli->close());
                } catch (Exception $e) {

                    $sql_detele = "DELETE FROM archivo_caja WHERE id = '$consulta'";
                    $result = $mysqli->query($sql_detele);
                    unlink($inputFileName);

                    echo "Error: " . $e->getMessage();
                }
            } else {
                echo 0;
            }
        }
    }
    exit();
}

////////////////////////
if ($_POST["funcion"] === "cargar_excel_cajas_") {
    $consulta = $MPD->cargar_excel_cajas_();
    if (empty($consulta)) {
        echo 0;
    } else {
        echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    }
}

////////////////////////
if ($_POST["funcion"] === "eliminar_archivo_excel_cajas") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $imagen = htmlspecialchars($_POST["imagen"], ENT_QUOTES, 'UTF-8');

    $consulta = $MPD->eliminar_archivo_excel_cajas($id);
    if ($consulta === 1) {
        unlink("../../img/archivo_cajas/" . $imagen . ".xlsx");
        echo $consulta;
    } else {
        echo $consulta;
    }
}

/////////////////////////////////////
if ($_POST["funcion"] === "ver_data_excel_cajas") {

    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');

    $data = $MPD->Tabla_data_excel_cajas($id);
    if ($data) {
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    } else {
        echo '{
                "sEcho": 1,
                "iTotalRecords": "0",
                "iTotalDisplayRecords": "0",
                "aaData": []
            }';
    }
    exit();
}

///////////////////////////////////// enfunde
if ($_POST["funcion"] === "cargar_excel_enfunde") {

    $nombrearchivo = htmlspecialchars($_POST['nombrearchivo'], ENT_QUOTES, 'UTF-8');

    if (is_array($_FILES) && count($_FILES) > 0) {
        $ruta = 'img/archivo_enfunde/' . $nombrearchivo . '.xlsx';
        $consulta = $MPD->cargar_excel_enfunde($ruta);

        if ($consulta === 0 || $consulta === 2) {

            echo $consulta;
        } else {

            if (move_uploaded_file($_FILES['foto']["tmp_name"], "../../img/archivo_enfunde/" . $nombrearchivo . ".xlsx")) {

                require 'vendor/autoload.php';
                // para tener los datos de una celda especifica mayores al numero colocado e la funcion
                class MyReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter
                {
                    public function readCell($columnAddress, $row, $worksheetName = '')
                    {
                        if ($row > 4) {
                            return true;
                        }
                        return false;
                    }
                }

                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                $inputFileName = '../../img/archivo_enfunde/' . $nombrearchivo . '.xlsx';

                $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
                $reader->setReadFilter(new MyReadFilter());
                $spreadsheet = $reader->load($inputFileName);
                $cantidad = $spreadsheet->getActiveSheet()->toArray();

                try {
                    $count = 0;
                    $cinta = 0;

                    foreach ($cantidad as $dia) {
                        if ($dia[2] != '') {

                            $count++;

                            if ($cinta > 7) {
                                $cinta = 1;
                            } else {
                                $cinta++;
                            }

                            // $lote_1A = $dia[2] . ' | ' . bcdiv($dia[2], '5.09', 1);
                            // $lote_1B = $dia[5] . ' | ' . bcdiv($dia[5], '3.71', 1);
                            // $lote_1C = $dia[8] . ' | ' . bcdiv($dia[8], '3.36', 1);

                            // $lote_2 = $dia[11] . ' | ' . bcdiv($dia[11], '12.6', 1);
                            // $lote_3 = $dia[14] . ' | ' . bcdiv($dia[14], '9.7', 1);
                            // $lote_4 = $dia[17] . ' | ' . bcdiv($dia[17], '9', 1);
                            // $lote_5 = $dia[20] . ' | ' . bcdiv($dia[20], '6.6', 1);
                            // $lote_6 = $dia[23] . ' | ' . bcdiv($dia[23], '4.9', 1);
                            // $lote_7 = $dia[26] . ' | ' . bcdiv($dia[26], '2.7', 1);
                            // $lote_8 = $dia[29] . ' | ' . bcdiv($dia[29], '3.1', 1);

                            // $lote_A = $dia[32] . ' | ' . bcdiv($dia[32], '13.27', 1);
                            // $lote_B = $dia[35] . ' | ' . bcdiv($dia[35], '11.58', 1);
                            // $lote_C = $dia[38] . ' | ' . bcdiv($dia[38], '8.44', 1);
                            // $lote_D = $dia[41] . ' | ' . bcdiv($dia[41], '2.77', 1);

                            // $total = $dia[44] . ' | ' . bcdiv($dia[44], '96.82', 1);

                            ///////////////
                            $lote_1A = $dia[2];
                            $lote_1B = $dia[5];
                            $lote_1C = $dia[8];
                            $lote_2 = $dia[11];
                            $lote_3 = $dia[14];
                            $lote_4 = $dia[17];
                            $lote_5 = $dia[20];
                            $lote_6 = $dia[23];
                            $lote_7 = $dia[26];
                            $lote_8 = $dia[29];
                            $lote_A = $dia[32];
                            $lote_B = $dia[35];
                            $lote_C = $dia[38];
                            $lote_D = $dia[41];
                            $total = $dia[44];

                            $sql = "INSERT INTO enfunde_excel (id,id_excel,id_cinta,lote_1A,lote_1B,lote_1C,lote_2,lote_3,lote_4,lote_5,lote_6,lote_7,lote_8,lote_A,lote_B,lote_C,lote_D,total,fecha) 
                            VALUES ('$count', '$consulta', '$cinta', 
                            '$lote_1A', 
                            '$lote_1B',
                            '$lote_1C',
                            '$lote_2',
                            '$lote_3', 
                            '$lote_4',
                            '$lote_5', 
                            '$lote_6',
                            '$lote_7', 
                            '$lote_8',
                            '$lote_A', 
                            '$lote_B',
                            '$lote_C', 
                            '$lote_D',
                            '$total',
                            CURDATE())";
                            $result = $mysqli->query($sql);
                        }
                    }

                    exit($mysqli->close());
                } catch (Exception $e) {

                    $sql_delete = "DELETE FROM archivo_enfunde WHERE id = '$consulta'";
                    $result = $mysqli->query($sql_delete);
                    unlink($inputFileName);

                    echo "Error: " . $e->getMessage();
                }
            } else {
                echo 0;
            }
        }
    }

    exit();
}

////////////////////////
if ($_POST["funcion"] === "cargar_excel_enfunde_") {
    $consulta = $MPD->cargar_excel_enfunde_();
    if (empty($consulta)) {
        echo 0;
    } else {
        echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    }
}

////////////////////////
if ($_POST["funcion"] === "eliminar_archivo_excel_funda") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $imagen = htmlspecialchars($_POST["imagen"], ENT_QUOTES, 'UTF-8');

    $consulta = $MPD->eliminar_archivo_excel_funda($id);
    if ($consulta === 1) {
        unlink("../../img/archivo_enfunde/" . $imagen . ".xlsx");
        echo $consulta;
    } else {
        echo $consulta;
    }
}

if ($_POST["funcion"] === "ver_data_excel_enfunde") {

    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');

    $data = $MPD->Tabla_data_excel_enfunde($id);
    if ($data) {
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    } else {
        echo '{
                "sEcho": 1,
                "iTotalRecords": "0",
                "iTotalDisplayRecords": "0",
                "aaData": []
            }';
    }
    exit();
}

///////////////////////////////////// recobro
if ($_POST["funcion"] === "cargar_excel_recobro") {

    $nombrearchivo = htmlspecialchars($_POST['nombrearchivo'], ENT_QUOTES, 'UTF-8');

    if (is_array($_FILES) && count($_FILES) > 0) {
        $ruta = 'img/archivo_recobro/' . $nombrearchivo . '.xlsx';
        $consulta = $MPD->cargar_excel_recobro($ruta);

        if ($consulta === 0 || $consulta === 2) {

            echo $consulta;
        } else {

            if (move_uploaded_file($_FILES['foto']["tmp_name"], "../../img/archivo_recobro/" . $nombrearchivo . ".xlsx")) {

                require 'vendor/autoload.php';
                // para tener los datos de una celda especifica mayores al numero colocado e la funcion
                class MyReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter
                {
                    public function readCell($columnAddress, $row, $worksheetName = '')
                    {
                        if ($row > 3) {
                            return true;
                        }
                        return false;
                    }
                }

                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                $inputFileName = '../../img/archivo_recobro/' . $nombrearchivo . '.xlsx';

                $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
                $reader->setReadFilter(new MyReadFilter());
                $spreadsheet = $reader->load($inputFileName);
                $cantidad = $spreadsheet->getActiveSheet()->toArray();

                try {
                    $count = 0;
                    $cinta = 0;

                    foreach ($cantidad as $dia) {
                        if ($dia[2] != '') {
                            $count++;
                            if ($cinta > 7) {
                                $cinta = 1;
                            } else {
                                $cinta++;
                            }
                            //35
                            //32
                            $sql = "INSERT INTO recobro_excel (id,id_excel,id_cinta,1A_cai,1A_saldo,1B_cai,1B_saldo,1C_cai,1C_saldo,2_cai,2_saldo,3_cai,3_saldo,4_cai,4_saldo,5_cai,5_saldo,6_cai,6_saldo,7_cai,7_saldo,8_cai,8_saldo,A_cai,A_saldo,B_cai,B_saldo,C_cai,C_saldo,D_cai,D_saldo,caidos,total,saldos,porcentaje) 
                            VALUES ('$count', '$consulta', '$cinta', 
                            '$dia[8]', 
                            '$dia[9]',

                            '$dia[16]',
                            '$dia[17]',

                            '$dia[24]', 
                            '$dia[25]',

                            '$dia[32]', 
                            '$dia[33]',

                            '$dia[40]', 
                            '$dia[41]',

                            '$dia[48]', 
                            '$dia[49]',
                            
                            '$dia[56]', 
                            '$dia[57]',

                            '$dia[64]',
                            '$dia[65]', 

                            '$dia[72]',
                            '$dia[73]',

                            '$dia[80]', 
                            '$dia[81]',

                            '$dia[88]', 
                            '$dia[89]',

                            '$dia[96]', 
                            '$dia[97]',

                            '$dia[104]',
                            '$dia[105]',

                            '$dia[112]',
                            '$dia[113]',

                            '$dia[114]',
                            '$dia[115]',
                            '$dia[116]',
                            '$dia[117]')";
                            $result = $mysqli->query($sql);
                        }
                    }

                    exit($mysqli->close());
                } catch (Exception $e) {

                    $sql_delete = "DELETE FROM archivo_recobro WHERE id = '$consulta'";
                    $result = $mysqli->query($sql_delete);
                    unlink($inputFileName);

                    echo "Error: " . $e->getMessage();
                }
            } else {
                echo 0;
            }
        }
    }

    exit();
}

////////////////////////
if ($_POST["funcion"] === "cargar_excel_recobro_") {
    $consulta = $MPD->cargar_excel_recobro_();
    if (empty($consulta)) {
        echo 0;
    } else {
        echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    }
}

////////////////////////
if ($_POST["funcion"] === "eliminar_archivo_excel_recargo") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $imagen = htmlspecialchars($_POST["imagen"], ENT_QUOTES, 'UTF-8');

    $consulta = $MPD->eliminar_archivo_excel_recargo($id);
    if ($consulta === 1) {
        unlink("../../img/archivo_recobro/" . $imagen . ".xlsx");
        echo $consulta;
    } else {
        echo $consulta;
    }
}

//////////////////////7
if ($_POST["funcion"] === "ver_data_excel_recobro") {

    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');

    $data = $MPD->Tabla_data_excel_recobro($id);
    if ($data) {
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    } else {
        echo '{
                "sEcho": 1,
                "iTotalRecords": "0",
                "iTotalDisplayRecords": "0",
                "aaData": []
            }';
    }
    exit();
}


/////////////////////////////////////
if ($_POST["funcion"] === "llamar_dato_grafica") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $datos = $MPD->Llamar_dato_grafica($id);
    if (!empty($datos)) {
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "llamar_total_grafica") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $datos = $MPD->Llamar_total_grafica($id);
    if (!empty($datos)) {
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}

///////////////////////////////////// enfunde grafica
if ($_POST["funcion"] === "llamar_dato_grafica_enfunde") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $datos = $MPD->Llamar_dato_grafica_enfunde($id);
    if (!empty($datos)) {
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "llamar_graficas_fundas_primeros_lotes") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $datos = $MPD->Llamar_graficas_fundas_primeros_lotes($id);
    if (!empty($datos)) {
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "llamar_graficas_fundas_segundos_lotes") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $datos = $MPD->Llamar_graficas_fundas_segundos_lotes($id);
    if (!empty($datos)) {
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "llamar_graficas_fundas_tercer_lotes") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $datos = $MPD->Llamar_graficas_fundas_tercer_lotes($id);
    if (!empty($datos)) {
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "llamar_graficas_fundas_cuarto_lotes") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $datos = $MPD->Llamar_graficas_fundas_cuarto_lotes($id);
    if (!empty($datos)) {
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "Llamar_total_fundas_lotes") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $datos = $MPD->Llamar_total_fundas_lotes($id);
    if (!empty($datos)) {
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}

///////////////////////////////////// recobro grafica
if ($_POST["funcion"] === "llamar_dato_grafica_recobro") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $datos = $MPD->Llamar_dato_grafica_recobro($id);
    if (!empty($datos)) {
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "Llamar_dato_grafica_recobro_saldo_caidos") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $datos = $MPD->Llamar_dato_grafica_recobro_saldo_caidos($id);
    if (!empty($datos)) {
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "recobro_total_caidos_saldo_lote") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $datos = $MPD->recobro_total_caidos_saldo_lote($id);
    if (!empty($datos)) {
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}

///////////////////////////////////// caidos
if ($_POST["funcion"] === "recobro_caidos_semana_uno") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $datos = $MPD->recobro_caidos_semana_uno($id);
    if (!empty($datos)) {
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "recobro_caidos_semana_dos") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $datos = $MPD->recobro_caidos_semana_dos($id);
    if (!empty($datos)) {
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "recobro_caidos_semana_tres") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $datos = $MPD->recobro_caidos_semana_tres($id);
    if (!empty($datos)) {
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "recobro_caidos_semana_cuatro") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $datos = $MPD->recobro_caidos_semana_cuatro($id);
    if (!empty($datos)) {
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}


///////////////////////////////////// saldos
if ($_POST["funcion"] === "recobro_saldos_semana_uno") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $datos = $MPD->recobro_saldos_semana_uno($id);
    if (!empty($datos)) {
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "recobro_saldos_semana_dos") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $datos = $MPD->recobro_saldos_semana_dos($id);
    if (!empty($datos)) {
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "recobro_saldos_semana_tres") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $datos = $MPD->recobro_saldos_semana_tres($id);
    if (!empty($datos)) {
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "recobro_saldos_semana_cuatro") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $datos = $MPD->recobro_saldos_semana_cuatro($id);
    if (!empty($datos)) {
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}

/////////////////////////////////////PORCENTAJE
if ($_POST["funcion"] === "recobro_porcentaje") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $datos = $MPD->recobro_porcentaje($id);
    if (!empty($datos)) {
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}


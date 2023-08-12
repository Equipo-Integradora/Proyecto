        <?php
                require_once "../class/database.php";

                if ($_SERVER["REQUEST_METHOD"] == "POST") 
                {
                    function isValidPrice($input) 
                    {
                        return preg_match('/^\d+(\.\d+)?$/', $input) && floatval($input) >= 0;
                    }
        
                    $db = new database();
                    $db->conectarDB();
        
                    $id_registro_cita = $_POST['id_registro_cita'];
                    $id_detalle_registro_cita_texto = $_POST['id_detalle_registro_cita'];
                    $estado_registro_cita = $_POST['estado_registro_cita'];
                    $precios = $_POST['precios'];
        
                    $hasInvalidPrice = false;
        
                    foreach ($precios as $precio) 
                    {
                        if (!isValidPrice($precio)) 
                        {
                            $hasInvalidPrice = true;
                            $response = array("success" => false, "message" => "Formato de precio inválido");
                            echo json_encode($response);
                            exit;
                        }
                    }
        
                    if (!$hasInvalidPrice) 
                    {
                        $id_detalle_registro_cita = explode(',', $id_detalle_registro_cita_texto);
                        $precios_texto = implode(',', $precios);
        
                        $consulta1 = "call sweet_beauty.actualizar_estado_cita('$id_registro_cita', '$estado_registro_cita')";
                        $resultado1 = $db->ejecuta($consulta1);
        
                        $consulta2 ="call sweet_beauty.cambio_precio_servicio_cita('$id_detalle_registro_cita_texto', '$precios_texto')";
                        $resultado2 = $db->ejecuta($consulta2);
        
                        $db->desconectarDB();
        
                        $response = array("error" => true);
                        echo json_encode($response);
                        exit;
                    }
                }
        ?>


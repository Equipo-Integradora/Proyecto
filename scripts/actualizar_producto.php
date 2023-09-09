<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" >
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container">
        <?php
        include '../class/database.php';
        $db = new database();
        $db->conectarDB();
        extract($_POST);
if(isset($actualizar)){
                $query  = "UPDATE productos SET nombre_producto = '$nombre',descripcion_producto = '$descripcion',precio_producto = '$precio'
                ,categoria_producto_FK = '$categoria'
                WHERE id_producto = '$producto' ";
                
                $queryx  = "UPDATE detalle_productos
                    SET color_detalle_producto_FK = '$color',existencias_detalle_producto = '$existencias'
                    WHERE id_detalle_producto = '$detallproducto' ";

            if (isset($_FILES['ima']) && $_FILES['ima']['error'] === UPLOAD_ERR_OK) {
                $verificar="SELECT detalle_productos.imagen_detalle_producto from detalle_productos
                where `detalle_productos`.`id_detalle_producto`='$detallproducto'";
    
                $ar=$db->ejecuta($verificar);
                $ar->imagen_detalle_producto;
                $carpetaDestino = '../img/productos/';
    
                $borrarimagenantigua = $carpetaDestino . $ar->imagen_detalle_producto;

                 unlink($borrarimagenantigua);

                $nombreArchivo = $_FILES['ima']['name'];
    
                $rutaDestino = $carpetaDestino . $nombreArchivo;
                
                if (file_exists($rutaDestino)) {
                    $fileInfo = pathinfo($nombreArchivo);
                    $fileExtension = $fileInfo['extension'];
                    $baseFileName = $fileInfo['filename'];
            
                    $counter = 1;
                    
                    while (file_exists($targetFilePath)) {
                        $nuevonombre = $baseFileName . '(' . $counter . ').' . $fileExtension;
                        $targetFilePath = $carpetaDestino . $newFileName;
                        $counter++;
                    }
            
                    $rutaDestino=$targetFilePath;
            
                }    
                if (move_uploaded_file($_FILES['ima']['tmp_name'], $rutaDestino)) {
    
                    $queryl  = "UPDATE detalle_productos
                    SET imagen_detalle_producto = '$nombreArchivo'
                    WHERE id_detalle_producto = '$detallproducto'";
                    $db->ejecuta($queryl);
                }
            }

            $db->ejecuta($query);
            $db->ejecuta($queryx);
            $db->desconectarDB();
            echo "<script>";
            echo "Swal.fire({";
            echo "  icon: 'success',";
            echo "  title: 'Guardado',";
            echo "  showConfirmButton: false,";
            echo "  timer: 1500";
            echo "});";
            echo "</script>";
            header("refresh:2; ../scripts/inventario.php");
            exit;
        }else if (isset($surtir)){

            $queryx  = "UPDATE detalle_productos
            SET existencias_detalle_producto = '$surt'
            WHERE id_detalle_producto = '$productor'; ";

            $db->ejecuta($queryx);
            echo "<script>";
            echo "Swal.fire({";
            echo "  icon: 'success',";
            echo "  title: 'Producto surtido',";
            echo "  showConfirmButton: false,";
            echo "  timer: 1500";
            echo "});";
            echo "</script>";
            header("refresh:2; ../scripts/inventario.php");
            exit;
        }
?>
    </div>

</body>

</html>
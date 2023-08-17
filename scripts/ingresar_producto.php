<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css"S>
</head>
<body>
    <div class="container">
        <?php
        include '../class/database.php';
        $db = new database();
        $db->conectarDB();

        extract($_POST);
        if(isset($informacion)){
            if($db->color($informacion)){
            echo "error" ;

            }else{
                $nuevo="INSERT INTO colores (nombre_color) values ('$informacion')";
                $db->ejecuta($nuevo);
                $db->desconectarDB();
            echo "exito";

            }
        }else{
       if($db->productdobl($producto)){
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>";
        echo "Swal.fire({";
        echo "  icon: 'warning',";
        echo "  title: 'Ya existe este producto.',";
        echo "  showConfirmButton: false,";
        echo "  timer: 3000";
        echo "});";
        echo "</script>";
        header("refresh:2; ../scripts/inventario.php");
        exit;
       }else{

        $query  = "INSERT INTO productos(nombre_producto, descripcion_producto, precio_producto, categoria_producto_FK) VALUES 
        ('$producto', '$descripcion', '$precio', '$tipocat')";

        $db->ejecuta($query);
        $productos=$db->ultimaid();
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $carpetaDestino = '../img/productos/';
        
            $nombreArchivo = $_FILES['imagen']['name'];
        
            $rutaDestino = $carpetaDestino . $nombreArchivo;
        
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)) {
                    $querry = "INSERT INTO detalle_productos (detalle_producto_detalle_producto_FK, color_detalle_producto_FK, existencias_detalle_producto, imagen_detalle_producto) VALUES
                    ('$productos', '$colors', '$existenciass', '$nombreArchivo')";
                
            }
        }
        $db->ejecuta($querry);
        $db->desconectarDB();

        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>";
        echo "Swal.fire({";
        echo "  icon: 'success',";
        echo "  title: 'Producto Registrado.',";
        echo "  showConfirmButton: false,";
        echo "  timer: 3000";
        echo "});";
        echo "</script>";
        header("refresh:2; ../scripts/inventario.php");
        exit;
       }
    }
        ?>
    </div>
    
</body>
</html>
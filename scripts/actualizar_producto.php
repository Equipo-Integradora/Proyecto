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
        $con = 0;

        extract($_POST);

        if(!empty($nombre))
        {
            $query  = "UPDATE productos
            SET nombre_producto = '$nombre'
            WHERE id_producto = $producto;";
            $con++;
            
        }

        if(!empty($descripcion))
        {
            $query  = "UPDATE productos
            SET descripcion_producto = '$descripcion'
            WHERE id_producto = $producto;";
            $con++;
            
        }

        if(!empty($precio))
        {
            $query  = "UPDATE productos
            SET precio_producto = '$precio'
            WHERE id_producto = $producto;";
            $con++;
            
        }

        if(!empty($categoria) AND $categoria != "")
        {
            $query  = "UPDATE productos
            SET categoria_producto_FK = '$categoria'
            WHERE id_producto = $producto;";
            $con++;
            
        }

        if(!empty($color) AND $color != "")
        {
            $query  = "UPDATE detalle_productos
            SET color_detalle_producto_FK = '$color'
            WHERE id_detalle_producto = $detallproducto;";
            $con++;
            
        }

        if(!empty($existencias))
        {
            $query  = "UPDATE detalle_productos
            SET existencias_detalle_producto = '$existencias'
            WHERE id_detalle_producto = $detallproducto;";
            $con++;
            
        }

        if (isset($_FILES['ima']) && $_FILES['ima']['error'] === UPLOAD_ERR_OK)
        {
            $carpetaDestino = '../img/productos/';
            
            $nombreArchivo = $_FILES['ima']['name'];
            
            $rutaDestino = $carpetaDestino . $nombreArchivo;
            
            if (move_uploaded_file($_FILES['ima']['tmp_name'], $rutaDestino)) 
            {
            
                $query  = "UPDATE detalle_productos
                SET imagen_detalle_producto = '$nombreArchivo'
                WHERE id_detalle_producto = $detallproducto;";
                $con++;
            }
        }
        
        if($con > 0)
        {
            $db->ejecuta($query);
            $db->desconectarDB();
            if($con > 1)
            {
                echo "<div class='alert alert-success'>Datos Actualizados</div>";
            }else
            {
                echo "<div class='alert alert-success'>Dato Actualizado</div>";
            }
        }
       
        header("refresh:2; ../scripts/inventario.php")
        ?>
    </div>
    
</body>
</html>
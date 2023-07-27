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
            
        }elseif(!empty($descripcion))
        {
            $query  = "UPDATE productos
            SET descripcion_producto = '$descripcion'
            WHERE id_producto = $producto;";
            $con++;
            
        }elseif(!empty($precio))
        {
            $query  = "UPDATE productos
            SET precio_producto = '$precio'
            WHERE id_producto = $producto;";
            $con++;
            
        }elseif(!empty($categoria) AND $categoria != "")
        {
            $query  = "UPDATE productos
            SET categoria_producto_FK = '$categoria'
            WHERE id_producto = $producto;";
            $con++;
            
        }elseif(!empty($color) AND $color != "")
        {
            $query  = "UPDATE detalle_productos
            SET color_detalle_producto_FK = '$color'
            WHERE id_detalle_producto = $detallproducto;";
            $con++;
            
        }elseif(!empty($existencias))
        {
            $query  = "UPDATE detalle_productos
            SET existencias_detalle_producto = '$existencias'
            WHERE id_detalle_producto = $detallproducto;";
            $con++;
            
        }elseif(!empty($ima))
        {
            $query  = "UPDATE detalle_productos
            SET imagen_detalle_producto = '$ima'
            WHERE id_detalle_producto = $detallproducto;";
            $con++;
            
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
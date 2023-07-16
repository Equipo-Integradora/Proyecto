<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 align="center">Productos</h1>

        <?php
            include "../class/database.php";
            $conexion = new database();
            $conexion->conectarDB();

            $consulta ="SELECT productos.nombre_producto, productos.precio_producto, tipo_categorias.nombre_tipo_categoria, detalle_productos.existencias_detalle_producto, detalle_productos.imagen_detalle_producto
            FROM detalle_productos INNER JOIN productos ON productos.id_producto = detalle_productos.detalle_producto_detalle_producto_FK
            INNER JOIN tipo_categorias ON tipo_categorias.id_tipo_categoria = productos.categoria_producto_FK;";

            $tabla = $conexion->seleccionar($consulta);

            echo "<table class='table table-hover'>
            <thead class='table-dark'>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Tipo de Categoria</th>
                    <th>Existencias</th>
                    <th>Imagen</th>
                </tr>
            </thead>
            <tbody>";

            foreach($tabla as $reg)
            {
                echo "<tr>";
                echo "<td> $reg->nombre_producto</td>";
                echo "<td> $reg->precio_producto</td>";
                echo "<td> $reg->nombre_tipo_categoria</td>";
                echo "<td> $reg->existencias_detalle_producto</td>";
                echo "<td> <img style='height: auto; width: 5rem;' src='../img/productos/".$reg->imagen_detalle_producto."' alt=".$reg->imagen_detalle_producto."></td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            $conexion->desconectarDB();
            
        ?>


    </div>
    
</body>
</html>
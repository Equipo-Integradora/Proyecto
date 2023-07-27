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
      
        $query  = "INSERT INTO productos(nombre_producto, descripcion_producto, precio_producto, categoria_producto_FK) VALUES 
        ('$producto', '$descripcion', '$precio', '$cat')";

        $db->ejecuta($query);
        $db->desconectarDB();

        echo "<div class='alert alert-success'>Producto Registrado</div>";
        header("refresh:2; ../scripts/inventario.php")
        ?>
    </div>
    
</body>
</html>
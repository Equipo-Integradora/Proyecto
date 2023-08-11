<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" S>
</head>

<body>
    <div class="container">
        <?php
        include '../class/database.php';
        $db = new database();
        $db->conectarDB();
        $con = 0;
        $exito=false;
        extract($_POST);


        $query  = "UPDATE productos
            SET nombre_producto = '$nombre',descripcion_producto = '$descripcion',precio_producto = '$precio'
            ,categoria_producto_FK = '$categoria'
            WHERE id_producto = '$producto' ";
            

        if (empty($color)) {
            $queryx  = "UPDATE detalle_productos
            SET existencias_detalle_producto = '$existencias'
            WHERE id_detalle_producto = '$detallproducto' ";
        } else {
            $queryx  = "UPDATE detalle_productos
                SET color_detalle_producto_FK = '$color',existencias_detalle_producto = '$existencias'
                WHERE id_detalle_producto = '$detallproducto' ";
        }

        if (isset($_FILES['ima']) && $_FILES['ima']['error'] === UPLOAD_ERR_OK) {
            $verificar="SELECT detalle_productos.imagen_detalle_producto from detalle_productos
            where `detalle_productos`.`id_detalle_producto`='$detallproducto'";

            $ar=$db->ejecuta($verificar);
            $ar->imagen_detalle_producto;
            $carpetaDestino = '../img/productos/';

            $borrarimagenantigua = $carpetaDestino . $ar->imagen_detalle_producto;

            if(unlink($borrarimagenantigua)){
                echo "borrado con exito";
            }else{
                echo "no se borro";
            }

            $nombreArchivo = $_FILES['ima']['name'];

            $rutaDestino = $carpetaDestino . $nombreArchivo;

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


        header("refresh 3; ../scripts/inventario.php");
        exit;
        ?>
    </div>

</body>

</html>
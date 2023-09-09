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

if($db->duplas($producto,$color))
{
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>";
    echo "Swal.fire({";
    echo "  icon: 'error',";
    echo "  title: 'No es posible agregar otro producto igual',";
    echo "  showConfirmButton: false,";
    echo "  timer: 3000";
    echo "});";
    echo "</script>";
    header("refresh:2; ../scripts/inventario.php");
    exit;

}else{

if (isset($_FILES['ima']) && $_FILES['ima']['error'] === UPLOAD_ERR_OK) {
    $carpetaDestino = '../img/productos/';

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
     
            $query = "INSERT INTO detalle_productos (detalle_producto_detalle_producto_FK, color_detalle_producto_FK, existencias_detalle_producto, imagen_detalle_producto) VALUES
            ('$producto', '$color', '$existencias', '$nombreArchivo')";

    }
        $db->ejecuta($query);
        $db->desconectarDB();
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>";
        echo "Swal.fire({";
        echo "  icon: 'success',";
        echo "  title: 'Producto agregado con exito',";
        echo "  showConfirmButton: false,";
        echo "  timer: 1500";
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
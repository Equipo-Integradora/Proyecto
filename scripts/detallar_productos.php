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

if (isset($_FILES['ima']) && $_FILES['ima']['error'] === UPLOAD_ERR_OK) {
    $carpetaDestino = '../img/productos/';

    $nombreArchivo = $_FILES['ima']['name'];

    $rutaDestino = $carpetaDestino . $nombreArchivo;

    if (move_uploaded_file($_FILES['ima']['tmp_name'], $rutaDestino)) {
        if (empty($color)) {
            $query = "INSERT INTO detalle_productos (detalle_producto_detalle_producto_FK, existencias_detalle_producto, imagen_detalle_producto) VALUES
            ('$producto', '$existencias', '$nombreArchivo')";
        } else {
            $query = "INSERT INTO detalle_productos (detalle_producto_detalle_producto_FK, color_detalle_producto_FK, existencias_detalle_producto, imagen_detalle_producto) VALUES
            ('$producto', '$color', '$existencias', '$nombreArchivo')";
        }

        $db->ejecuta($query);
        $db->desconectarDB();

        $response = array(
            'success' => true,
            'message' => 'El producto se ha registrado exitosamente.'
        );

        echo json_encode($response);
    } else {
        $response = array(
            'success' => false,
            'message' => 'Error al subir la imagen.'
        );

        echo json_encode($response);
    }
} else {
    $response = array(
        'success' => false,
        'message' => 'Debes seleccionar una imagen válida.'
    );

    echo json_encode($response);
}
?>
        
        ?>
    </div>
    
</body>
</html>
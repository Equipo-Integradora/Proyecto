<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
session_start();
include '../class/database.php';
$conexion = new database();
$conexion->conectarDB();
$aidi=$_POST['id'];

    $caducar="update orden_venta
        set
        estado_orden_venta='Cancelado'
        where id_venta='$aidi'";
        $resultado=$conexion->ejecuta($caducar);


        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>";
        echo "Swal.fire({";
        echo "  icon: 'error',";
        echo "  title: 'Orden cancelada.',";
        echo "  showConfirmButton: false,";
        echo "  timer: 3000";
        echo "});";
        echo "</script>";
header("refresh:3; ../views/mis_ordenes.php");
    ?>
</body>
</html>
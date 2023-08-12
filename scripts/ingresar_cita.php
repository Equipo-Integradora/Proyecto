<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Realizar cita</title>
</head>
<body>
    <div class="container">
    <?php
session_start();

include "../class/database.php";

$db = new database();
$db->conectarDB();

extract($_POST);

    $registro = "INSERT INTO registros_cita(cliente_registro_cita_FK, fecha_cita_registro_cita, hora_registro_cita, descripcion_registro_cita)
    VALUES ('{$_SESSION["id"]}', '$selectedDate', '$selectedTime', '$descripcion');";
    $db->ejecuta($registro);

    $registro = $db->ultimaid();

    foreach($servicio as $ser)
    {
    $detalle = "INSERT INTO detalles_registros_cita(registro_cita_detalle_registro_FK, tipo_servicio_registro_cita_FK, precio_registro_cita)
    VALUES('$registro', '$ser', '$precio');";
    $db->ejecuta($detalle);
    }

$db->desconectarDB();

echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
echo "<script>";
echo "Swal.fire({";
echo "  icon: 'success',";
echo "  title: 'Cita realizada con éxito',";
echo "  showConfirmButton: false,";
echo "  timer: 3000";
echo "});";
echo "</script>";
header("refresh:3 ; ../views/home.php")
?>
    </div>
</body>
</html>
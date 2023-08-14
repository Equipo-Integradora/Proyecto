<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Cita cancelada</title>
</head>
<body>
    <div class="container">
    <?php
include "../class/database.php";
$conexion = new database();
$conexion->conectarDB();


$id = $_POST['id'];
$cancelar = "CALL cancelar_cita($id);";
$conexion->ejecuta($cancelar);

$conexion->desconectarDB();
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>";
                echo "Swal.fire({";
                echo "  icon: 'error',";
                echo "  title: 'Su cita se ha cancelado',";
                echo "  showConfirmButton: false,";
                echo "  timer: 3000";
                echo "});";
                echo "</script>";
header("refresh:3 ; ../views/mis_citas.php")
?>
    </div>
</body>
</html>
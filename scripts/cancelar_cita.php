<link rel="stylesheet" href="../css/bootstrap.min.css">
<?php
include "../class/database.php";
$conexion = new database();
$conexion->conectarDB();


$id = $_POST['id'];
$cancelar = "CALL cancelar_cita($id);";
$conexion->ejecuta($cancelar);

$conexion->desconectarDB();
echo "<div class='alert alert-danger'>Su cita se ha cancelado</div>";
header("refresh:1 ; ../views/mis_citas.php")
?>
<?php
require_once "../class/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new database();

    $db->conectarDB();

    $id_registro_cita = $_POST['id_registro_cita'];
    $precio_registro_cita = $_POST['precio_registro_cita'];
    $estado_registro_cita = $_POST['estado_registro_cita'];

    $consulta1 = "CALL sweet_beauty.actualizar_estado_cita('$id_registro_cita', '$estado_registro_cita')";
    
    $resultado1 = $db->ejecuta($consulta1);

    if ($resultado1) {
        echo "<script>alert('Cita actualizada exitosamente');</script>";
    } else {
        echo "<script>alert('Error al actualizar la cita');</script>";
    }

    $db->desconectarDB();
}
?>

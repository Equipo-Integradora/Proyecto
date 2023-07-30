<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id_registro_cita"])) {
    $id_registro_cita = $_POST["id_registro_cita"];

    require_once "../class/database.php";
    $db = new database();
    $db->conectarDB();

    $sql1 = "DELETE FROM detalles_registros_cita WHERE registro_cita_detalle_registro_FK = '$id_registro_cita'";
    $sql2 = "DELETE FROM registros_cita WHERE id_registro_cita = '$id_registro_cita'";

    $resultado1 = $db->ejecuta($sql1);
    $resultado2 = $db->ejecuta($sql2);

    if ($resultado1 && $resultado2) {
        echo "<script>alert('La cita se ha eliminado exitosamente');</script>";
    } else {
        echo "<script>alert('Error al eliminar la cita');</script>";
    }
    $db->desconectarDB();
}
?>

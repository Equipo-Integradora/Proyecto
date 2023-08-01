<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id_venta"])) {
    $id_venta = $_POST["id_venta"];

    require_once "../class/database.php";
    $db = new database();
    $db->conectarDB();

    $sql1 = "DELETE FROM detalle_orden_venta WHERE orden_venta_detalle_orden_FK = '$id_venta'";
    $sql2 = "DELETE FROM orden_venta WHERE id_venta = '$id_venta'";

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

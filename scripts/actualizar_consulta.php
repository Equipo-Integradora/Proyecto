<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id_venta"])) {
    $id_venta = $_POST["id_venta"];

    require_once "../class/database.php";
    $db = new database();
    $db->conectarDB();

    $sql1 = "call sweet_beauty.confirmar_venta('$id_venta')";
    
    $resultado1 = $db->ejecuta($sql1);
    
    if ($resultado1) {
        echo "<script>alert('La cita se ha eliminado exitosamente');</script>";
    } else {
        echo "<script>alert('Error al eliminar la cita');</script>";
    }
    $db->desconectarDB();
}
?>

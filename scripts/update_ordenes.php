<?php
require_once "../class/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $db = new database();

    $db->conectarDB();

    $id_venta = $_POST['id_venta'];
    $fecha_entrega_orden_venta = $_POST['fecha_entrega_orden_venta'];
    $estado_orden_venta = $_POST['estado_orden_venta'];

    if(!empty($fecha_entrega_orden_venta))
    {
        $consulta1 = "UPDATE orden_venta
                  SET fecha_entrega_orden_venta = '$fecha_entrega_orden_venta', estado_orden_venta = '$estado_orden_venta'
                  WHERE id_venta = '$id_venta'";

        $resultado1 = $db->ejecuta($consulta1);

        if ($resultado1) {
            echo "<script>alert('Cita actualizada exitosamente');</script>";
        } else {
            echo "<script>alert('Error al actualizar la cita');</script>";
        }
    }
    else
    {
        $consulta1 = "UPDATE orden_venta
                  SET fecha_entrega_orden_venta = '0000-00-00', estado_orden_venta = '$estado_orden_venta'
                  WHERE id_venta = '$id_venta'";

        $resultado1 = $db->ejecuta($consulta1);

        if ($resultado1) {
            echo "<script>alert('Cita actualizada exitosamente');</script>";
        } else {
            echo "<script>alert('Error al actualizar la cita');</script>";
        }
        
    }
    $db->desconectarDB();
}
?>

<?php
require_once "../class/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $db = new database();

    $db->conectarDB();

    $id_registro_cita = $_POST['id_registro_cita'];
    $precio_registro_cita = $_POST['precio_registro_cita'];
    $estado_registro_cita = $_POST['estado_registro_cita'];

    $consulta1 = "UPDATE detalles_registros_cita 
                  SET precio_registro_cita = '$precio_registro_cita' 
                  WHERE registro_cita_detalle_registro_FK = '$id_registro_cita'";
    $consulta2 = "UPDATE registros_cita 
                  SET estado_registro_cita = '$estado_registro_cita' 
                  WHERE id_registro_cita = '$id_registro_cita'";

    $resultado1 = $db->ejecuta($consulta1);
    $resultado2 = $db->ejecuta($consulta2);

    if ($resultado1 && $resultado2) {
        echo "<script>alert('Cita actualizada exitosamente');</script>";
    } else {
        echo "<script>alert('Error al actualizar la cita');</script>";
    }
    
    $db->desconectarDB();
}
?>

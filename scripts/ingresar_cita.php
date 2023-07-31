<?php
session_start();

include "../class/database.php";

$db = new database();
$db->conectarDB();

extract($_POST);

$registro = "INSERT INTO registros_cita(cliente_registro_cita_FK, fecha_cita_registro_cita, hora_registro_cita, descripcion_registro_cita)
VALUES ('{$_SESSION["id"]}', 'selectedDate', 'selectedTime', 'descripcion_registro_cita');";
$db->ejecuta($registro);

$registro = $db->ultimaid();

foreach($servicio as $ser)
{
 $detalle = "INSERT INTO detalles_registros_cita(registro_cita_detalle_registro_FK, tipo_servicio_registro_cita_FK, precio_registro_cita)
 VALUES('$registro', '$ser', '$precio');";
}

$db->ejecuta($detalle);
$db->desconectarDB();

echo "<div class='alert alert-success'>Cita hecha</div>";

        ?>
    </div>
    
</body>
</html>
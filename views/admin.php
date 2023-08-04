<?php
include "../templates/sidebar.php";
?>

<div class="text-center">
    <h3 class="m-0">Bienvenida</h3>
</div>
<div class="container-fluid px-4">
    <div class="row g-3 my-2">

        <div class="col-md-12">
            <div class="container-clock">
                <h1 id="time">00:00:00</h1>
                <p id="date">fecha</p>
            </div>
        </div>

        <!-- CITAS RECIENTEMENTE AGENDADAS -->
        <div class="row my-5">
            <h3 class="fs-4 mb-3 fw-bold">Citas agendadas recientemente</h3>
            <div class="table-responsive">
                <!-- TABLA -->
                <?php
                $consulta = "SELECT * FROM sweet_beauty.`citas recientes`";

                $tablacitas = $conexion->seleccionar($consulta);

                if (!empty($tablacitas)) {
                    echo "<table class='table shadow-sm table-hover'>
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Tipo de servicio</th>
                                <th>Fecha de la cita</th>
                                <th>Hora de la cita</th>
                                <th>Estatus</th>
                            </tr>
                        </thead>
                        <tbody class='table-border-bottom-0'>";

                    foreach ($tablacitas as $reg) {
                        echo "<tr>";
                        echo "<td> $reg->nombre_usuario</td>";
                        echo '<td>';
                        echo '<button class="btn btn-secondary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#servicios-' . $reg->id_registro_cita . '">Ver servicios</button>';
                        echo '<div class="collapse" id="servicios-' . $reg->id_registro_cita . '">';
                        $servicios = explode(', ', $reg->tipos_servicio);
                        echo '<ul>';
                        foreach ($servicios as $servicio) {
                            echo '<li>' . $servicio . '</li>';
                        }
                        echo '</ul>';
                        echo '</div>';
                        echo '</td>';
                        echo "<td> $reg->fecha_cita_registro_cita</td>";
                        echo "<td> $reg->hora_registro_cita</td>";
                        if ($reg->estado_registro_cita == "Aceptada") {
                            echo "<td><span class='badge text-bg-success'>$reg->estado_registro_cita</span></td>";
                        } else if ($reg->estado_registro_cita == "Cancelada") {
                            echo "<td><span class='badge text-bg-danger'>$reg->estado_registro_cita</span></td>";
                        } else if ($reg->estado_registro_cita == "Pendiente") {
                            echo "<td><span class='badge text-bg-secondary'>$reg->estado_registro_cita</span></td>";
                        }
                    }
                    echo "</tbody>
                    </table>";
                } else {
                    echo "<p class='fw-bold text-center'>No se encontraron citas recientes.</p>";
                }
                ?>
                <!-- FIN TABLA -->
            </div>
        </div>
    </div>
</div>
<!-- SCRIPTS -->
<script src="../js/clock.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function () {
        el.classList.toggle("toggled");
    };
</script>
</body>

</html>

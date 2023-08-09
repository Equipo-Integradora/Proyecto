<?php
session_start();
if (isset($_SESSION["admin"])) {


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
                                <th>Descripción</th>
                                <th>Fecha de la cita</th>
                                <th>Hora de la cita</th>
                                <th>Estatus</th>
                            </tr>
                        </thead>
                        <tbody class='table-border-bottom-0'>";

                        foreach ($tablacitas as $reg) {
                            echo "<tr>";
                            echo "<td>  <button type='button' class='btn btn-sm btn-cliente' 
                                data-nombre='$reg->nombre_usuario>'
                                data-telefono='$reg->telefono'
                                data-correo='$reg->email'
                                data-bs-toggle='modal' data-bs-target='#clienteModal'>
                                $reg->nombre_usuario
                                </button></td>";
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
                            echo "<td><button type='button' class='btn btn-secondary btn-sm btn-desc' data-bs-toggle='modal' data-bs-target='#exampleModal' data-descripcion='$reg->Descripcion'>Ver descripción</button></td>";
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

    <!-- MODAL DE LOS DATOS -->
<div class="modal fade" id="clienteModal" tabindex="-1" aria-labelledby="clienteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="clienteModalLabel">Datos de contacto del cliente</h5>
            </div>
            <div class="modal-body">
            <div class="mb-3">
                    <label for="modalTelefono" class="form-label"><strong>Teléfono:</strong></label>
                    <span id="modalTelefono">
                </div>
                <div class="mb-3">
                    <label for="modalCorreo" class="form-label"><strong>Correo:</strong></label>
                    <span id="modalCorreo"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn boton" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL DE LA DESCRIPCION -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Descripción</h1>
      </div>
      <div class="modal-body">
        <textarea id="descripcionModalBody" cols="48" rows="10" readonly></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn boton" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
              
    <!-- SCRIPTS -->
    <script
  src="https://code.jquery.com/jquery-3.7.0.js"
  integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
  crossorigin="anonymous"></script>
    <script src="../js/clock.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
    <script>
    $(document).ready(function () {
        $('.btn-cliente').on('click', function () {
            var nombre = $(this).data('nombre');
            var telefono = $(this).data('telefono');
            var correo = $(this).data('correo');
            
            $('#modalNombre').text(nombre);
            $('#modalTelefono').text(telefono);
            $('#modalCorreo').text(correo);
        });

        $('.btn-desc').on('click', function () {
        var descripcion = $(this).data('descripcion');
      if (descripcion && descripcion.trim().length > 0) 
      {
        $('#descripcionModalBody').text(descripcion);
      } else {
        $('#descripcionModalBody').text('No hay descripción de la cita');
      }
    });
    });
</script>
    </body>

    </html>

    <?php

}

?>
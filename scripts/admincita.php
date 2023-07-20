<?php
include "../templates/sidebar.php";
?>

    <div class="text-center">
        <h3 class="m-0">Citas</h3>
    </div>
    
    <div class="container-fluid px-4">
    <form method="post">
    <div class="mb-3 col-6">
        <label  class="form-label"><h3 class="fw-bold">Buscar por cliente</h3></label>
        <input type="text" name="nombre_usuario" class="form-control mt-2">
    </div>


        <div class="col-12">
        <label  class="form-label"><h3 class="fw-bold">Filtrar por</h3></label>
        <table class="table">
            <thead>
               <tr>
               <th>
                   <p class="fw-bold">Estado</p>
                   <select name="estado" class="form-control mt-2" >
                   <option value="">Seleccionar...</option>
                    <option value="Aceptada">Aceptadas</option>
                    <option value="Cancelada">Canceladas</option>
                    <option value="Pendiente">Pendientes</option>
                    </select>
                </th>
                <th>
                    <p class="fw-bold">Fecha Desde</p>
                    <input type="date" name="fecha_desde" class="form-control mt-2">
                </th>
                <th>
                    <p class="fw-bold">Fecha Hasta</p>
                    <input type="date" name="fecha_hasta" class="form-control mt-2">
                </th>
                <th>
                    <div class="d-grid gap-2 mx-auto">
                    <button class="btn boton" type="submit">Ver</button>
                    </div>
                </th>
               </tr>
            </thead>
        </table>
        </div>
    </form>
    </div>

    <?php
    extract($_POST);
    if ($_POST)
    { ?>
    <?php
    $citas = "SELECT id_registro_cita, 
    nombre_usuario, 
    GROUP_CONCAT(nombre_tipo_servicio SEPARATOR ', ') AS tipos_servicio,
    SUM(precio_registro_cita + precio_tipo_servicio) AS precio_total_cita,
    fecha_creacion_registro_cita,
    fecha_cita_registro_cita,
    hora_registro_cita,
    estado_registro_cita
    FROM sweet_beauty.`todas las citas`
    WHERE 1 = 1";

    if (!empty($estado)) {
        $citas .= " AND estado_registro_cita = '$estado'";
    }

    if (!empty($fecha_desde) && !empty($fecha_hasta)) {
        $citas .= " AND fecha_creacion_registro_cita BETWEEN '$fecha_desde' AND '$fecha_hasta'";
    }

    if (!empty($nombre_usuario)) {
        $citas .= " AND nombre_usuario LIKE '%$nombre_usuario%'";
    }
    $citas .= " GROUP BY id_registro_cita";
    $tablac = $conexion->seleccionar($citas);
    ?>
                    <div class="table-responsive container-fluid">
                    <table class="table shadow-sm table-hover">
                        <thead>
                        <tr>
                               <th>ID cita</th>
                               <th>Cliente</th>
                               <th>Tipo de servicio</th>
                               <th>Precio</th>
                               <th>Fecha de registro</th>
                               <th>Fecha de la cita</th>
                               <th>Hora de la cita</th>
                               <th>Estado</th>
                               <th>Opciones</th>
                               </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php
                            if (empty($tablac)) 
                            {
                               echo "<tr><td colspan='9'><p class='fw-bold text-center'>No se encontraron resultados.</p></td></tr>";
                            }
                            else
                            {
                                foreach($tablac as $reg)
                            {
                                echo "<tr>";
                                echo "<td> $reg->id_registro_cita</td>";
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
                                echo "<td> $$reg->precio_total_cita</td>";
                                echo "<td> $reg->fecha_creacion_registro_cita</td>";
                                echo "<td> $reg->fecha_cita_registro_cita</td>";
                                echo "<td> $reg->hora_registro_cita</td>";
                                if ($reg->estado_registro_cita == "Aceptada")
                                {
                                    echo "<td><span class='badge text-bg-success'>$reg->estado_registro_cita</span></td>";
                                }
                                else if ($reg->estado_registro_cita == "Cancelada")
                                {
                                    echo "<td><span class='badge text-bg-danger'>$reg->estado_registro_cita</span></td>";
                                }
                                else if ($reg->estado_registro_cita == "Pendiente")
                                {
                                    echo "<td><span class='badge text-bg-secondary'>$reg->estado_registro_cita</span></td>";
                                }
                                echo "<td>
                                <div class='dropdown'>
                                  <button type='button' class='btn p-0 dropdown-toggle hide-arrow' data-bs-toggle='dropdown'>
                                    <i class='bx bx-dots-vertical-rounded'></i>
                                  </button>
                                  <div class='dropdown-menu'>
                                    <a class='dropdown-item'>
                                      <i class='bx bx-edit-alt me-1'></i> Editar</a>
                                    <a class='dropdown-item'><i class='bx bx-trash me-1'></i> Eliminar</a
                                    >
                                  </div>
                                </div>
                              </td>";
                                echo "</tr>";
                            }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <?php } ?>

<!-- SCRIPTS -->
<script src="../prueba/js/clock.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
</body>
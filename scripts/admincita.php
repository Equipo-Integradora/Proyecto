<?php
include "../templates/sidebar.php";
?>

    <div class="text-center">
        <h3 class="m-0">Citas</h3>
    </div>
    
    <div class="container-fluid px-4 p-3">
    <form method="post">
    <div class="mb-3 col-6">
        <label  class="form-label"><h3 class="fw-bold">Buscar por cliente</h3></label>
        <input type="text" name="nombre_usuario" class="form-control mt-2">
    </div>


        <div class="col-12 table-responsive">
        <label  class="form-label"><h3 class="fw-bold">Filtrar por</h3></label>
        <table class="table">
            <thead>
               <tr>
               <th>
                   <p class="fw-bold">Estado</p>
                   <select name="estado" class="form-control mt-2">
                   <option value="">Seleccionar</option>
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
if ($_POST) {
    if (empty($estado) && empty($fecha_desde) && empty($fecha_hasta) && empty($nombre_usuario)) {
        echo "<p class='fw-bold text-center'>Ingresa algún criterio de búsqueda para ver resultados.</p>";
    } else {
        $citas = "SELECT *
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
                               <th>Descripcion</th>
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
                                echo '<button class="btn btn-secondary btn-sm" type="button" data-bs-toggle="collapse"  data-bs-target="#servicios-' . $reg->id_registro_cita . '">Ver servicios</button>';
                                echo '<div class="collapse" id="servicios-' . $reg->id_registro_cita . '">';
                                $servicios = explode(', ', $reg->tipos_servicio);
                                $precios = explode(', ', $reg->precio_cita);
                                $id_detalle = explode(', ', $reg->id_detalle_registro_cita);
                                echo '<ul>';
                                for ($i = 0; $i < count($servicios); $i++) {
                                    echo '<li>' . $servicios[$i];
                                    if (!empty($precios[$i])) {
                                        echo '<strong><br> $' . $precios[$i] . '</strong>';
                                    }
                                    echo '</li>';
                                    echo '<br>';
                                }
                                echo '</ul>';
                                echo '</div>';
                                echo '</td>';
                                echo "<td><button type='button' class='btn btn-secondary btn-sm btn-desc' data-bs-toggle='modal' data-bs-target='#exampleModal' data-descripcion='$reg->Descripcion'>Ver descripción</button></td>";
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
                                    <i class='bi bi-three-dots-vertical'></i>
                                  </button>
                                  <div class='dropdown-menu'>
                                    <a class='dropdown-item btn-editar' href='#' 
                                        data-tipos-servicio='$reg->tipos_servicio'
                                        data-registro-id='$reg->id_registro_cita' 
                                        data-detalle-id='$reg->id_detalle_registro_cita'
                                        data-precio-registro-cita='$reg->precio_cita' 
                                        data-estado-registro-cita='$reg->estado_registro_cita' 
                                        data-bs-toggle='modal' 
                                        data-bs-target='#modalEditar-$reg->id_registro_cita'> <!-- ID único para el modal -->
                                        <i class='bi bi-pencil-square me-1'></i> Editar
                                    </a>
                                    <!-- <button class='dropdown-item btn-eliminar' href='#' data-registro-id='$reg->id_registro_cita'>
                                    <i class='bi bi-trash3-fill me-1'></i> Eliminar
                                    </button> -->
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
    <?php
    }
}
?>

<!-- MODAL DE LA DESCRIPCION -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Descripcion</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="descripcionModalBody">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn boton" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal de Edición -->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarLabel">Editar Cita</h5>
            </div>
            <div class="modal-body">
                <form method="post" action="update_cita.php">
                    <input type="hidden" name="id_registro_cita" id="id_registro_cita"> 
                    <input type="hidden" name="id_detalle_registro_cita" id="id_detalle_registro_cita"> 
                    <div class="mb-3">
                        <label class="form-label fw-bold">Servicios</label>
                        <div id="servicios_editar">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="edit_estado_registro_cita" class="form-label fw-bold">Cambiar estado de la cita</label>
                        <select name="estado_registro_cita" id="estado_registro_cita" class="form-control">
                            <option value="Aceptada">Aceptada</option>
                            <option value="Cancelada">Cancelada</option>
                            <option value="Pendiente">Pendiente</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn boton" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn boton" id="btnGuardarCambios">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

            
<!-- SCRIPTS -->
<script
  src="https://code.jquery.com/jquery-3.7.0.js"
  integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
  crossorigin="anonymous"></script>
<script src="../prueba/js/clock.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function () {
    $('.btn-editar').on('click', function () {
        var id_registro_cita = $(this).data('registro-id');
        var id_detalle_cita = $(this).data('detalle-id');
        var estado_registro_cita = $(this).data('estado-registro-cita');
        var servicios = $(this).data('tipos-servicio').split(',');
        var precios = $(this).data('precio-registro-cita').split(',');
        
        $('#modalEditar #id_registro_cita').val(id_registro_cita);
        $('#modalEditar #id_detalle_registro_cita').val(id_detalle_cita);
        $('#modalEditar #estado_registro_cita').val(estado_registro_cita);

        var html = '';
        for (var i = 0; i < servicios.length; i++) {
            html += '<div class="mb-3">';
            html += '<p>' + servicios[i] + '</p>';
            html += '<input type="text" name="precios[]" class="form-control" value="' + precios[i] + '">';
            html += '</div>';
        }

        $('#modalEditar #servicios_editar').html(html);

        $('#modalEditar').modal('show');
    });

    $('#modalEditar').on('hidden.bs.modal', function () {
        $('#modalEditar #servicios_editar').html('');
    });

    $('.btn-desc').on('click', function () {
        var descripcion = $(this).data('descripcion');
      if (descripcion && descripcion.trim().length > 0) {
        $('#descripcionModalBody').text(descripcion);
      } else {
        $('#descripcionModalBody').text('No hay descripción de la cita');
      }
    });

        $('.btn-eliminar').on('click', function () {
            var id_registro_cita = $(this).data('registro-id');

            Swal.fire({
                title: '¿Estás seguro?',
                text: '¿Deseas eliminar esta cita?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post('delete_cita.php', {
                        id_registro_cita: id_registro_cita
                    }, function (data) {
                            Swal.fire({
                                title: '¡Cita eliminada!',
                                text: 'La cita ha sido eliminada correctamente.',
                                icon: 'success',
                                didClose: () => {
                                    window.location.reload();
                                }
                            });
                    });
                }
            });
        });
    });
</script>
</body>
<?php
include "../templates/sidebar.php";
?>

    <div class="text-center">
        <h3 class="m-0">Ordenes de venta</h3>
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
                   <select name="estado" class="form-control mt-2" >
                   <option value="">Seleccionar</option>
                    <option value="Pagado">Pagadas</option>
                    <option value="Pendiente">Pendientes</option>
                    <option value="Caducado">Caducadas</option>
                    <option value="Cancelado">Canceladas</option>
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
    if (empty($nombre_usuario) && empty($estado) && empty($fecha_desde) && empty($fecha_hasta)) {
        echo "<p class='fw-bold text-center'>Ingresa algún criterio de búsqueda para ver resultados.</p>";
    } else {
        $ordenes = "SELECT
            id_venta,
            nombre_usuario,
            GROUP_CONCAT(nombre_producto SEPARATOR ', ') AS productos,
            SUM(cantidad_producto_orden_venta) AS cantidad_total,
            SUM(precio_producto * cantidad_producto_orden_venta) AS precio_total,
            fecha_creacion_orden_venta,
            fecha_entrega_orden_venta,
            estado_orden_venta
            FROM sweet_beauty.`todas las ordenes`
            WHERE 1 = 1";

        if (!empty($estado)) {
            $ordenes .= " AND estado_orden_venta = '$estado'";
        }

        if (!empty($fecha_desde) && !empty($fecha_hasta)) {
            $ordenes .= " AND fecha_creacion_orden_venta BETWEEN '$fecha_desde' AND '$fecha_hasta'";
        }

        if (!empty($nombre_usuario)) {
            $ordenes .= " AND nombre_usuario LIKE '%$nombre_usuario%'";
        }
        $ordenes .= " GROUP BY id_venta";
        $tablac = $conexion->seleccionar($ordenes);
        ?>
        <div class="table-responsive container-fluid">
            <table class="table shadow-sm table-hover">
                <thead>
                    <tr>
                        <th>ID venta</th>
                        <th>Cliente</th>
                        <th>Productos</th>
                        <th>Cantidad</th>
                        <th>Precio total</th>
                        <th>Fecha de compra</th>
                        <th>Fecha de entrega</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php
                    if (empty($tablac)) {
                        echo "<tr><td colspan='9'><p class='fw-bold text-center'>No se encontraron resultados.</p></td></tr>";
                    } else {
                        foreach ($tablac as $reg) {
                            echo "<tr>";
                            echo "<td> $reg->id_venta</td>";
                            echo "<td> $reg->nombre_usuario</td>";
                            echo '<td>';
                            echo '<button class="btn btn-secondary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#productos-' . $reg->id_venta . '">Ver productos</button>';
                            echo '<div class="collapse" id="productos-' . $reg->id_venta . '">';
                            $productos = explode(', ', $reg->productos);
                            echo '<ul>';
                            foreach ($productos as $producto) {
                                if (empty($reg->productos)) {
                                    echo "No hay productos";
                                } else {
                                    echo '<li>' . $producto . '</li>';
                                }
                            }
                            echo '</ul>';
                            echo '</div>';
                            echo '</td>';
                            if ($reg->cantidad_total == 0 OR $reg->cantidad_total == "") {
                                echo "<td class='text-center'> Sin cantidad </td>";
                            } else {
                                echo "<td class='text-center'> $reg->cantidad_total</td>";
                            }
                            if ($reg->precio_total == 0 OR $reg->precio_total == "") {
                                echo "<td> Sin calcular </td>";
                            } else {
                                echo "<td> $$reg->precio_total</td>";
                            }
                            echo "<td> $reg->fecha_creacion_orden_venta</td>";
                            if ($reg->fecha_entrega_orden_venta == "" OR $reg->fecha_entrega_orden_venta == "0000-00-00") {
                                echo "<td>Sin especificar fecha</td>";
                            } else {
                                echo "<td> $reg->fecha_entrega_orden_venta</td>";
                            }
                            if ($reg->estado_orden_venta == "Pagado") {
                                echo "<td><span class='badge text-bg-success'>$reg->estado_orden_venta</span></td>";
                            } else if ($reg->estado_orden_venta == "Cancelado") {
                                echo "<td><span class='badge text-bg-danger'>$reg->estado_orden_venta</span></td>";
                            } else if ($reg->estado_orden_venta == "Pendiente") {
                                echo "<td><span class='badge text-bg-secondary'>$reg->estado_orden_venta</span></td>";
                            } else if ($reg->estado_orden_venta == "Caducado") {
                                echo "<td><span class='badge text-bg-warning'>$reg->estado_orden_venta</span></td>";
                            }
                            echo "<td>
                                <div class='dropdown'>
                                  <button type='button' class='btn p-0 dropdown-toggle hide-arrow' data-bs-toggle='dropdown'>
                                    <i class='bi bi-three-dots-vertical'></i>
                                  </button>
                                  <div class='dropdown-menu'>
                                  <a class='dropdown-item btn-editar' href='#'
                                    data-registro-id='$reg->id_venta'
                                    data-fecha-entrega-orden='$reg->fecha_entrega_orden_venta'
                                    data-estado-orden-venta='$reg->estado_orden_venta'
                                    data-bs-toggle='modal'
                                    data-bs-target='#modalEditar-$reg->id_venta'> <!-- ID único para el modal -->
                                    <i class='bi bi-pencil-square me-1'></i> Editar
                                </a>
                                <button class='dropdown-item btn-eliminar' href='#' data-registro-id='$reg->id_venta'>
                                    <i class='bi bi-trash3-fill me-1'></i> Eliminar
                                </button>
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

                
            <!-- Modal de Edición -->
            <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditarLabel">Editar Cita</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="">
                                <input type="hidden" name="id_venta" id="id_venta">
                                <div class="mb-3">
                                    <label for="edit_fecha_entrega_orden_venta" class="form-label">Fecha de entrega</label>
                                    <input type="date" step="0.01" name="fecha_entrega_orden_venta" id="fecha_entrega_orden_venta" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="edit_estado_orden_venta" class="form-label">Cambiar estado de la cita</label>
                                    <select name="estado_orden_venta" id="estado_orden_venta" class="form-control">
                                    <option value="Pagado">Pagada</option>
                                    <option value="Cancelado">Cancelada</option>
                                    <option value="Pendiente">Pendiente</option>
                                    <option value="Caducado">Caducada</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn boton" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn boton">Guardar Cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

<!-- SCRIPTS -->
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
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
            var id_venta = $(this).data('registro-id');
            var fecha_entrega_orden_venta = $(this).data('fecha-entrega-orden');
            var estado_orden_venta = $(this).data('estado-orden-venta');

            $('#id_venta').val(id_venta);
            $('#fecha_entrega_orden_venta').val(fecha_entrega_orden_venta);
            $('#estado_orden_venta').val(estado_orden_venta);

            $('#modalEditar').modal('show');
        });

        $('#modalEditar form').submit(function (event) {
            event.preventDefault(); 

            var id_venta = $('#id_venta').val();
            var fecha_entrega_orden_venta = $('#fecha_entrega_orden_venta').val();
            var estado_orden_venta = $('#estado_orden_venta').val();

            $('#modalEditar').modal('hide');

            Swal.fire({
                title: '¿Estás seguro?',
                text: '¿Deseas guardar los cambios?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Guardar',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post('update_ordenes.php', {
                        id_venta: id_venta,
                        fecha_entrega_orden_venta: fecha_entrega_orden_venta,
                        estado_orden_venta: estado_orden_venta
                    }, function (data) {
                        Swal.fire({
                            title: '¡Cita actualizada!',
                            text: 'Los datos se han actualizado exitosamente.',
                            icon: 'success',
                            didClose: () => 
                            {
                                window.location.reload();
                            }
                        });
                    });
                }
                else 
                {
                    Swal.fire({
                        title: '¡Error!',
                        text: 'Ha ocurrido un error al procesar la solicitud.',
                        icon: 'error',
                    });
                }
            });
        });
        
        $('.btn-eliminar').on('click', function () {
            var id_venta = $(this).data('registro-id');

            Swal.fire({
                title: '¿Estás seguro?',
                text: '¿Deseas eliminar esta cita?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post('delete_orden.php', {
                        id_venta: id_venta
                    }, function (data) {
                            Swal.fire({
                                title: '¡Orden eliminada!',
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
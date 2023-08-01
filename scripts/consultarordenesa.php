<?php
session_start();
include "../templates/sidebar.php";
$id_venta = isset($_POST['id_venta']) ? $_POST['id_venta'] : '';
?>

<div class="text-center">
    <h3 class="m-0">Consultar ordenes de venta</h3>
</div>

<div class="container-fluid px-4 p-3">
    <form method="post">
        <div class="table-responsive">
            <label class="form-label"><h3 class="fw-bold">Buscar codigo</h3></label>
            <table class="table">
                <tr>
                    <th class="col-8">
                        <input type="text" name="id_venta" class="form-control mt-2 form-control-sm"
                               placeholder="Codigo..."  required value="<?php echo htmlspecialchars($id_venta); ?>">
                    </th>
                    <th>
                        <div>
                            <button class="btn boton" type="submit">Ver</button>
                        </div>
                    </th>
                </tr>
            </table>
        </div>
    </form>
</div>

<?php
if ($_POST && !empty($id_venta)) 
{
    $consultaordenes = "SELECT *
        FROM sweet_beauty.`consulta_ordenes`
        WHERE id_venta LIKE '%$id_venta%' AND estado_orden_venta = 'Pendiente'
        ORDER BY id_venta";

    $tablac = $conexion->seleccionar($consultaordenes);

    if (!empty($tablac)) {
        $totalPrecioDetalleOrden = 0;
        ?>
        <div class="table-responsive container-fluid">
            <table id="orden-venta-table" class="table shadow-sm table-hover text-center">
                <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                <?php
                foreach ($tablac as $reg) {
                    $imagenes = explode(', ', $reg->imagen_detalle_producto);
                    $productos = explode(', ', $reg->productos);
                    $cantidades = explode(', ', $reg->cantidad_producto_orden_venta);
                    $precios = explode(', ', $reg->precio_producto);
                    $colores = explode(', ', $reg->color);
                    $num_productos = count($productos);

                    for ($i = 0; $i < $num_productos; $i++) {
                        echo "<tr>";
                        echo "<td class='text-center'><img class='w-25' src='../img/productos/" . $imagenes[$i] . "'></td>";
                        echo '<td>' . $productos[$i] . ' <br> ';
                        if (!empty($colores[$i])) 
                        {
                            echo 'Color: <strong>' . $colores[$i] . '</strong>';
                        }
                        echo '</td>';
                        echo "<td>" . $cantidades[$i] . "</td>";
                        echo "<td>$" . $precios[$i] * $cantidades[$i] . "</td>";
                        echo "</tr>";

                        $totalPrecioDetalleOrden += (float)$precios[$i] * $cantidades[$i];
                    }
                }
                echo "<h3 class='fw-bold text-center'>$reg->nombre_usuario</h3>";
                ?>
                </tbody>
            </table>
            <?php
            $ordenPendienteEncontrada = false;
            foreach ($tablac as $reg) {
                if ($reg->estado_orden_venta === 'Pendiente') {
                    $ordenPendienteEncontrada = true;
                    break;
                }
            }
            if ($ordenPendienteEncontrada) {
                echo "<div class='d-grid gap-2 d-md-flex justify-content-md-start'>";
                echo "<h3 class='fw-bold'>Precio total: <span class='badge text-bg-dark'>$$totalPrecioDetalleOrden</span></h3>";
                echo "<button class='fw-bold btn btn-secondary mb-3 btn-actualizar' href='#' data-registro-id='$reg->id_venta'>Marcar como Pagado</button>";
                echo "</div>";
            }
            ?>
        </div>
    <?php
    } else {
        echo "<p class='fw-bold text-center'>No se encontraron resultados.</p>";
    }
}

?>

<!-- SCRIPTS -->
<script src="../prueba/js/clock.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function () {
        el.classList.toggle("toggled");
    };
</script>
<script>
    $(document).ready(function () {
        $('.btn-actualizar').on('click', function () {
            var id_venta = $(this).data('registro-id');

            Swal.fire({
                title: '¿Estás seguro?',
                text: '¿Deseas marcar la orden como pagada?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post('actualizar_consulta.php', {
                        id_venta: id_venta
                    }, function (data) {
                            Swal.fire({
                                title: '¡Orden pagada!',
                                text: 'La orden se ha actualizado correctamente.',
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
</html>

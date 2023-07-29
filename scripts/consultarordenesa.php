<?php
include "../templates/sidebar.php";
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
                               placeholder="Codigo...">
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
extract($_POST);
if ($_POST && !empty($id_venta)) {
    $consultaordenes = "SELECT
    imagen_detalle_producto,
    id_venta,
    nombre_producto AS productos,
    cantidad_producto_orden_venta,
    precio_producto,
    estado_orden_venta
    FROM sweet_beauty.`todas las ordenes`
    WHERE id_venta LIKE '%$id_venta%' and estado_orden_venta = 'Pendiente'
    ORDER BY id_venta";

    $tablac = $conexion->seleccionar($consultaordenes);
    ?>
    <div class="table-responsive container-fluid">
        <table class="table shadow-sm table-hover">
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
            if (empty($tablac)) {
                echo "<tr><td colspan='5'><p class='fw-bold text-center'>No se encontraron resultados.</p></td></tr>";
            } else {
                foreach ($tablac as $reg) {
                    $imagenes = explode(', ', $reg->imagen_detalle_producto);
                    $productos = explode(', ', $reg->productos);
                    $cantidades = explode(', ', $reg->cantidad_producto_orden_venta);
                    $precios = explode(', ', $reg->precio_producto);
                    $num_productos = count($productos);

                    for ($i = 0; $i < $num_productos; $i++) {
                        echo "<tr>";
                        echo "<td class='text-center'><img class='w-25' src='../img/productos/" . $imagenes[$i] . "'></td>";
                        echo "<td>" . $productos[$i] . "</td>";
                        echo "<td>" . $cantidades[$i] . "</td>";
                        echo "<td>$" . $precios[$i] . "</td>";
                        echo "</tr>";
                    }
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

<?php
include "../templates/sidebar.php";
?>

<div class="text-center">
    <h3 class="m-0">Ordenes de venta</h3>
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
    id_venta,
    nombre_usuario,
    GROUP_CONCAT(nombre_producto SEPARATOR ', ') AS productos,
    SUM(cantidad_producto_orden_venta) AS cantidad_total,
    SUM(precio_producto * cantidad_producto_orden_venta) AS precio_total,
    estado_orden_venta
    FROM sweet_beauty.`todas las ordenes`
    WHERE id_venta LIKE '%$id_venta%' 
    GROUP BY id_venta";
    
    $tablac = $conexion->seleccionar($consultaordenes);
    ?>
    <div class="table-responsive container-fluid">
        <table class="table shadow-sm table-hover">
            <thead>
            <tr>
                <th>Cliente</th>
                <th>Productos</th>
                <th>Cantidad total</th>
                <th>Precio total</th>
                <th>Estado</th>
            </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            <?php
            if (empty($tablac)) {
                echo "<tr><td colspan='9'><p class='fw-bold text-center'>No se encontraron resultados.</p></td></tr>";
            } else {
                foreach ($tablac as $reg) {
                    echo "<tr>";
                    echo "<td> $reg->nombre_usuario</td>";
                    echo '<td>';
                    echo '<div class="collapse show">';
                    $productos = explode(', ', $reg->productos);
                    echo '<ul style="list-style-type: none;">';
                    foreach ($productos as $producto) 
                    {
                        if (empty($reg->productos)) 
                        {
                            echo "<li>No hay productos</li>";
                        } else 
                        {
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
                    if ($reg->estado_orden_venta == "Pagado") {
                        echo "<td><span class='badge text-bg-success'>$reg->estado_orden_venta</span></td>";
                    } else if ($reg->estado_orden_venta == "Cancelado") {
                        echo "<td><span class='badge text-bg-danger'>$reg->estado_orden_venta</span></td>";
                    } else if ($reg->estado_orden_venta == "Pendiente") {
                        echo "<td><span class='badge text-bg-secondary'>$reg->estado_orden_venta</span></td>";
                    } else if ($reg->estado_orden_venta == "Caducado") {
                        echo "<td><span class='badge text-bg-warning'>$reg->estado_orden_venta</span></td>";
                    }
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

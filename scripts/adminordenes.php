<?php
include "../templates/sidebar.php";
?>

    <div class="text-center">
        <h3 class="m-0">Ordenes de venta</h3>
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
                    <option value="Pagado">Pagadas</option>
                    <option value="Cancelado">Canceladas</option>
                    <option value="Pendiente">Pendientes</option>
                    <option value="Caducado">Caducadas</option>
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
    $citas = "SELECT
    id_venta,
    nombre_usuario,
    GROUP_CONCAT(nombre_producto SEPARATOR ', ') AS productos,
    cantidad_producto_orden_venta,
    SUM(precio_producto * cantidad_producto_orden_venta) AS precio_total,
    fecha_creacion_orden_venta,
    fecha_entrega_orden_venta,
    estado_orden_venta
    FROM sweet_beauty.`todas las ordenes`
    WHERE 1 = 1";

    if (!empty($estado)) {
        $citas .= " AND estado_orden_venta = '$estado'";
    }

    if (!empty($fecha_desde) && !empty($fecha_hasta)) {
        $citas .= " AND fecha_creacion_orden_venta BETWEEN '$fecha_desde' AND '$fecha_hasta'";
    }

    if (!empty($nombre_usuario)) {
        $citas .= " AND nombre_usuario LIKE '%$nombre_usuario%'";
    }
    $citas .= " GROUP BY id_venta";
    $tablac = $conexion->seleccionar($citas);
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
                            if (empty($tablac)) 
                            {
                               echo "<tr><td colspan='9'><p class='fw-bold text-center'>No se encontraron resultados.</p></td></tr>";
                            }
                            else
                            {
                                foreach($tablac as $reg)
                            {
                                echo "<tr>";
                                echo "<td> $reg->id_venta</td>";
                                echo "<td> $reg->nombre_usuario</td>";
                                echo '<td>';
                                echo '<button class="btn btn-secondary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#productos-' . $reg->id_venta . '">Ver productos</button>';
                                echo '<div class="collapse" id="productos-' . $reg->id_venta . '">';
                                $productos = explode(', ', $reg->productos);
                                echo '<ul>';
                                foreach ($productos as $producto) 
                                {
                                    if (empty($reg->productos)) {
                                        echo "No hay productos";
                                    } else {
                                        echo '<li>' . $producto . '</li>';
                                    }
                                }
                                echo '</ul>';
                                echo '</div>';
                                echo '</td>';
                                if ($reg->cantidad_producto_orden_venta == 0 OR $reg->cantidad_producto_orden_venta == "")
                                {
                                    echo "<td class='text-center'> Sin cantidad </td>";
                                }
                                else
                                {
                                    echo "<td class='text-center'> $reg->cantidad_producto_orden_venta</td>";
                                }
                                if ($reg->precio_total == 0 OR $reg->precio_total == "")
                                {
                                    echo "<td> Sin calcular </td>";
                                }
                                else 
                                {
                                    echo "<td> $$reg->precio_total</td>";
                                }
                                echo "<td> $reg->fecha_creacion_orden_venta</td>";
                                if ($reg->fecha_entrega_orden_venta == '' or $reg->fecha_entrega_orden_venta == "0000-00-00")
                                {
                                    echo "<td>Sin especificar fecha</td>";
                                }
                                else
                                {
                                    echo "<td> $reg->fecha_entrega_orden_venta</td>";
                                }
                                if ($reg->estado_orden_venta == "Pagado")
                                {
                                    echo "<td><span class='badge text-bg-success'>$reg->estado_orden_venta</span></td>";
                                }
                                else if ($reg->estado_orden_venta == "Cancelado")
                                {
                                    echo "<td><span class='badge text-bg-danger'>$reg->estado_orden_venta</span></td>";
                                }
                                else if ($reg->estado_orden_venta == "Pendiente")
                                {
                                    echo "<td><span class='badge text-bg-secondary'>$reg->estado_orden_venta</span></td>";
                                }
                                else if ($reg->estado_orden_venta == "Caducado")
                                {
                                    echo "<td><span class='badge text-bg-warning'>$reg->estado_orden_venta</span></td>";
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
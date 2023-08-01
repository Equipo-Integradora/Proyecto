<?php
session_start();
if(isset($_SESSION["admin"]))
    {

        
include "../templates/sidebar.php";
?>

<div class="container-fluid px-4">
    <div class="row g-3 my-2">

    <div class="text-center">
        <h3 class="m-0">Reportes</h3>
    </div>
    
    <div class="container-fluid px-4 p-3">
    <form method="post">
        <div class="col-12 table-responsive">
        <label  class="form-label"><h3 class="fw-bold">Filtrar por fecha</h3></label>
        <table class="table">
            <thead>
               <tr>
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

        <!-- TABLAS -->
    <ul class="nav nav-pills mb-3 container-fluid px-4" id="pills-tab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Productos con cambio de precio</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Servicios con cambio de precio</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Actualizaciones de existencias</button>
  </li>
  <!-- <li class="nav-item" role="presentation">
    <button class="nav-link" id="pills-disabled-tab" data-bs-toggle="pill" data-bs-target="#pills-disabled" type="button" role="tab" aria-controls="pills-disabled" aria-selected="false" disabled>Disabled</button>
  </li> -->
</ul>
<div class="tab-content row my-3 px-4" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
  <div class="row my-1">
<?php
extract($_POST);
if ($_POST) {
    if (empty($fecha_desde) && empty($fecha_hasta)) 
    {
        echo "<p class='fw-bold text-center'>Ingresa algún criterio de búsqueda para ver resultados.</p>";
    } 
    else 
    {
        $cambios2 = "SELECT *
        FROM sweet_beauty.`cambio_precio_producto`
        WHERE 1 = 1";

    if (!empty($fecha_desde) && !empty($fecha_hasta)) 
    {
        $cambios2 .= " AND fecha_cambio_p_p BETWEEN '$fecha_desde' AND '$fecha_hasta'";
    }

    $tablacambios = $conexion->seleccionar($cambios2);
    ?>
                    <div class="table-responsive container-fluid">
                    <h3 class="fs-4 mb-3 fw-bold">Productos con cambio de precio</h3>
                    <table class="table shadow-sm table-hover">
                        <thead>
                            <tr>
                               <th>Producto</th>
                               <th>Precio antiguo</th>
                               <th>Precio nuevo</th>
                               <th>fecha del cambio</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php
                            if (empty($tablacambios)) 
                            {
                               echo "<tr><td colspan='9'><p class='fw-bold text-center'>No se encontraron resultados.</p></td></tr>";
                            }
                            else
                            {
                                foreach($tablacambios as $reg)
                            {
                                echo "<tr>";
                                echo "<td> $reg->producto_modificado</td>";
                                echo "<td> $reg->precio_viejo</td>";
                                echo "<td> $reg->precio_nuevo</td>";
                                echo "<td> $reg->fecha_cambio_p_p</td>";
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
</div>
</div>

  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
    <div class="row my-1">
<?php
extract($_POST);
if ($_POST) {
    if (empty($fecha_desde) && empty($fecha_hasta)) 
    {
        echo "<p class='fw-bold text-center'>Ingresa algún criterio de búsqueda para ver resultados.</p>";
    } 
    else 
    {
        $cambios1 = "SELECT *
        FROM sweet_beauty.`cambio_precio_servicio`
        WHERE 1 = 1";

    if (!empty($fecha_desde) && !empty($fecha_hasta)) 
    {
        $cambios1 .= " AND fecha_cambio_p_s BETWEEN '$fecha_desde' AND '$fecha_hasta'";
    }

    $tablacambiosS = $conexion->seleccionar($cambios1);
    ?>
                    <div class="table-responsive container-fluid">
                    <h3 class="fs-4 mb-3 fw-bold">Servicios con cambio de precio</h3>
                    <table class="table shadow-sm table-hover">
                        <thead>
                            <tr>
                               <th>Servicio modificado</th>
                               <th>Precio antiguo</th>
                               <th>Precio nuevo</th>
                               <th>Fecha del cambio</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php
                            if (empty($tablacambiosS)) 
                            {
                               echo "<tr><td colspan='9'><p class='fw-bold text-center'>No se encontraron resultados.</p></td></tr>";
                            }
                            else
                            {
                                foreach($tablacambiosS as $reg)
                            {
                                echo "<tr>";
                                echo "<td> $reg->servicio_modificado</td>";
                                echo "<td> $reg->servicio_viejo</td>";
                                echo "<td> $reg->servicio_nuevo</td>";
                                echo "<td> $reg->fecha_cambio_p_s</td>";
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
</div>
  </div>

  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
  <div class="row my-1">
<?php
extract($_POST);
if ($_POST) {
    if (empty($fecha_desde) && empty($fecha_hasta)) 
    {
        echo "<p class='fw-bold text-center'>Ingresa algún criterio de búsqueda para ver resultados.</p>";
    } 
    else 
    {
        $cambios3 = "SELECT *
        FROM sweet_beauty.`existencias_productos`
        WHERE 1 = 1";

    if (!empty($fecha_desde) && !empty($fecha_hasta)) 
    {
        $cambios3 .= " AND movimiento BETWEEN '$fecha_desde' AND '$fecha_hasta'";
    }

    $tablaexitencias = $conexion->seleccionar($cambios3);
    ?>
                    <div class="table-responsive container-fluid">
                    <h3 class="fs-4 mb-3 fw-bold">Servicios con cambio de precio</h3>
                    <table class="table shadow-sm table-hover">
                        <thead>
                            <tr>
                               <th>Producto</th>
                               <th>Actualizacion de las exitencias</th>
                               <th>Fecha del cambio</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php
                            if (empty($tablaexitencias)) 
                            {
                               echo "<tr><td colspan='9'><p class='fw-bold text-center'>No se encontraron resultados.</p></td></tr>";
                            }
                            else
                            {
                                foreach($tablaexitencias as $reg)
                            {
                                echo "<tr>";
                                echo "<td> $reg->servicio_modificado</td>";
                                echo "<td> $reg->existencias_cambiadas</td>";
                                echo "<td> $reg->movimiento</td>";
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
</div>
</div>

  <!-- <div class="tab-pane fade" id="pills-disabled" role="tabpanel" aria-labelledby="pills-disabled-tab" tabindex="0">...</div> -->
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
<?php 

    }

?>
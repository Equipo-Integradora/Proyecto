<?php
include "../templates/sidebar.php"
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
                         $consulta = "SELECT * FROM sweet_beauty.`citas recientes`;";

                         $tablacitas = $conexion->seleccionar($consulta);

                         echo "<table class='table shadow-sm table-hover'>
                             <thead>
                               <tr>
                                 <th>Cliente</th>
                                 <th>Tipo de servicio</th>
                                 <th>Fecha de la cita</th>
                                 <th>Estatus</th>
                               </tr>
                             </thead>
                             <tbody class='table-border-bottom-0'>";

                             foreach($tablacitas as $reg)
                             {
                                echo "<tr>";
                                echo "<td> $reg->Cliente</td>";
                                echo "<td> $reg->Tipo_de_servicio</td>";
                                echo "<td> $reg->Fecha_de_la_cita</td>";
                                if ($reg->Estatus == "Aceptada")
                                {
                                    echo "<td><span class='badge text-bg-success'>$reg->Estatus</span></td>";
                                }
                                else if ($reg->Estatus == "Cancelada")
                                {
                                    echo "<td><span class='badge text-bg-danger'>$reg->Estatus</span></td>";
                                }
                                else if ($reg->Estatus == "Pendiente")
                                {
                                    echo "<td><span class='badge text-bg-secondary'>$reg->Estatus</span></td>";
                                }
                             }
                             echo "</tbody>
                             </table>";
                        ?>
                        <!-- FIN TABLA -->
                    </div>
                </div>

                <!-- ORDENES RECIENTES -->
                <div class="row my-2">
                    <h3 class="fs-4 mb-3 fw-bold">Ordenes recientes</h3>
                    <div class="table-responsive">
                        <!-- TABLA -->
                        <?php
                         $consulta = "SELECT * FROM sweet_beauty.`ventas recientes`;";

                         $tablaventas = $conexion->seleccionar($consulta);

                         echo "<table class='table shadow-sm table-hover'>
                             <thead>
                               <tr>
                                 <th>ID orden</th>
                                 <th>Cliente</th>
                                 <th>Fecha de entrega</th>
                                 <th>Estatus</th>
                               </tr>
                             </thead>
                             <tbody class='table-border-bottom-0'>";

                             foreach($tablaventas as $reg)
                             {
                                echo "<tr>";
                                echo "<td> $reg->ID_venta</td>";
                                echo "<td> $reg->Cliente</td>";
                                
                                if ($reg->fecha_entrega == "0000-00-00" OR $reg->fecha_entrega == "")
                                {
                                    echo "<td>Sin especificar fecha</td>";
                                }
                                else
                                {
                                    echo "<td> $reg->fecha_entrega</td>";
                                }
                                if ($reg->estatus == "Pagado")
                                {
                                    echo "<td><span class='badge text-bg-success'>$reg->estatus</span></td>";
                                }
                                else if ($reg->estatus == "Cancelado")
                                {
                                    echo "<td><span class='badge text-bg-danger'>$reg->estatus</span></td>";
                                }
                                else if ($reg->estatus == "Pendiente")
                                {
                                    echo "<td><span class='badge text-bg-secondary'>$reg->estatus</span></td>";
                                }
                                else if ($reg->estatus == "Caducado")
                                {
                                    echo "<td><span class='badge text-bg-warning'>$reg->estatus</span></td>";
                                }
                             }
                             echo "</tbody>
                             </table>";
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
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
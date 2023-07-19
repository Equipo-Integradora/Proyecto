<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="../css/admins.css" />
    <title>Administrar</title>
    <?php
    include "../class/database.php";
    $conexion = new database();
    $conexion->conectarDB();
    ?>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 fs-4 fw-bold border-bottom"><span>Sweet </span>Beauty</div>
            <div class="list-group list-group-flush my-3">
                <a href="#" class="list-group-item list-group-item-action second-text active"><i class="bi bi-house-heart-fill me-2"></i>Inicio</a>
                
                <a href="#citas" class="list-group-item list-group-item-action second-text fw-bold"><i class="bi bi-calendar-heart-fill me-2"></i><span>Citas</span></a>

                <a href="#ordenes" class="list-group-item list-group-item-action second-text fw-bold"><i class="bi bi-clipboard-heart-fill me-2"></i><span>Ordenes</span></a>

                <a href="#" class="list-group-item list-group-item-action second-text fw-bold"><i class="bi bi-box2-heart-fill me-2"></i><span>Inventario</span></a>

                <a href="#" class="list-group-item list-group-item-action second-text fw-bold"><i class="bi bi-people-fill me-2"></i><span>Clientes</span></a>

            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Inicio</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i>Username
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#"><i class="bi bi-pencil-fill me-2"></i>Editar Perfil</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-gear-fill me-2"></i> Configuracion</a></li>
                                <li><a class="dropdown-item" href="../views/home.php"><i class="bi bi-house-heart me-2"></i> Home</a></li>
                                <!-- <li><hr class="drowpwon-divider"></li> -->
                                <li><a class="dropdown-item" href="../scripts/cerrar_sesion.php"><i class="bi bi-person-x-fill me-2"></i> Cerrar Sesion</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

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
                    <h3 id="citas" class="fs-4 mb-3 fw-bold">Citas recientemente agendadas</h3>
                    <div class="col">
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
                    <h3 id="ordenes" class="fs-4 mb-3 fw-bold">Ordenes recientes</h3>
                    <div class="col">
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
                                echo "<td> $reg->fecha_entrega</td>";
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
                             }
                             echo "</tbody>
                             </table>";
                        ?>
                        <!-- FIN DE LA TABLA -->
                    </div>
                </div>

            </div>
        </div>
    </div>
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
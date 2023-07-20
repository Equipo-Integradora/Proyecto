<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="../css/admins.css">
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
                <a href="../views/admin.php" class="list-group-item list-group-item-action second-text fw-bold"><i class="bi bi-house-heart-fill me-2"></i>Inicio</a>
                
                <a href="../scripts/admincita.php" class="list-group-item list-group-item-action second-text fw-bold"><i class="bi bi-calendar-heart-fill me-2"></i><span>Citas</span></a>

                <a href="#" class="list-group-item list-group-item-action second-text fw-bold"><i class="bi bi-tags-fill me-2"></i><span>Ordenes</span></a>

                <a href="#" class="list-group-item list-group-item-action second-text fw-bold"><i class="bi bi-box2-heart-fill me-2"></i><span>Inventario</span></a>

                <a href="#" class="list-group-item list-group-item-action second-text fw-bold"><i class="bi bi-people-fill me-2"></i><span>Clientes</span></a>
                
                <a href="#" class="list-group-item list-group-item-action second-text fw-bold"><i class="bi bi-clipboard-heart-fill me-2"></i><span>Reportes</span></a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
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
                                <li><a class="dropdown-item" href="#"><i class="bi bi-pencil-fill me-2"></i>Editar perfil</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-gear-fill me-2"></i> Configuracion</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-person-x-fill me-2"></i> cerrar sesion</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
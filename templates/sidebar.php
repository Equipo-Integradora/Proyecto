<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../img/home/logo.png" type="logo/png">
    <link rel="icon" href="../img/home/logo1.png" type="logo1/png">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="../css/admins.css">
    <title>Panel del administrador</title>

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
        <a href="../index.php" style="text-decoration: none; color:black"><div class="sidebar-heading text-center py-4 fs-4 fw-bold border-bottom"><span>Sweet </span>Beauty</div></a>
            <div class="list-group list-group-flush my-3">

                <a href="../views/admin.php" class="list-group-item list-group-item-action second-text fw-bold"><i class="bi bi-house-heart-fill me-2"></i>Inicio</a>
                
                <a href="../scripts/admincita.php" class="list-group-item list-group-item-action second-text fw-bold"><i class="bi bi-calendar-heart-fill me-2"></i><span>Citas</span></a>
                
                <a href="../views/calendario.php" class="list-group-item list-group-item-action second-text fw-bold"><i class="bi bi-calendar-week me-2"></i><span>Calendario</span></a>

                <a href="../scripts/adminordenes.php" class="list-group-item list-group-item-action second-text fw-bold"><i class="bi bi-tags-fill me-2"></i><span>Ordenes</span></a>

                <a href="../scripts/consultarordenesa.php" class="list-group-item list-group-item-action second-text fw-bold"><i class="bi bi-search-heart-fill me-2"></i><span>Consultar orden</span></a>

                <a href="../scripts/inventario.php" class="list-group-item list-group-item-action second-text fw-bold"><i class="bi bi-box2-heart-fill me-2"></i><span>Inventario</span></a>
                
                <a href="../scripts/admin_reportes.php" class="list-group-item list-group-item-action second-text fw-bold"><i class="bi bi-clipboard-heart-fill me-2"></i><span>Reportes</span></a>

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
                                
                                <i class="fas fa-user me-2"></i><?php echo $_SESSION["usuario"]?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                <?php
                                if(isset($_SESSION["usuario"]))
                                {
                                    echo "<a class='dropdown-item' href='../views/perfil.php'><i class='fas fa-user me-2'></i>Mi perfil</a>";
                                }
                                ?>
                                </li>
                                <li>
                                <?php 
                                if(isset($_SESSION["usuario"]))
                                {    
                                    echo "<a class='dropdown-item' href='../scripts/cerrar_sesion.php'><i class='fas fa-user-xmark me-2'></i>Cerrar sesion</a>";
                                }
                                ?>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
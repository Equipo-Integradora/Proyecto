<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/home/logo1.png" type="logo1/png">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/productos_gene.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css" integrity="sha512-OTcub78R3msOCtY3Tc6FzeDJ8N9qvQn1Ph49ou13xgA9VsH9+LRxoFU6EqLhW4+PKRfU+/HReXmSZXHEkpYoOA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Sweet Beauty</title>
</head>
<body>
    <?php
    session_start();
    if(isset($_SESSION["usuario"]))
    {
      include '../class/database.php';
      $db = new Database();
      $db->conectarDB();
  
      $admin = $db->admin();
      echo $admin;
    }
    
    ?>
    <!-- INICIO DE LA BARRA DE NAVEGACION -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
        <!-- LOGO -->
        <!-- DURAAAANNNNNNNNNNNNNn -->
          <a class="navbar-brand logo fs-2 " href="../views/home.php"><span>Sweet </span>Beauty</a>
        <!-- Toggle btn-->
          <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <!-- Barra lateral -->
          <div class="offcanvas offcanvas-start border-bottom" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <!-- Barra lateral header -->
            <div class="offcanvas-header">
              <h5 class="offcanvas-title logo" id="offcanvasNavbarLabel"><span>Sweet </span>Beauty</h5>
              <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <!-- Barra lateral body -->
            <div class="offcanvas-body d-flex flex-column flex-lg-row">
              <ul class="navbar-nav justify-content-center flex-grow-0 pe-3 align-items-center fa-bars">
                <li class="nav-item mx-2">
                  <a class="nav-link" href="../views/home.php">Inicio</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="../views/Agendar_cita.php">Agendar cita</a>
                  </li>
                  <li class="nav-item mx-2">
                    <a class="nav-link" href="../views/ver_producto_general.php">Productos</a>
                  </li>
              </ul>
              <!-- BARRA DE BUSQUEDA -->
              <div class="group d-flex justify-content-center align-items-center mx-auto">
                <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><g><path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path></g></svg>
                <form action="../scripts/buscar_producto.php" method="post">
                  <input placeholder="Buscar..." type="search" class="input" name="buscar">
                </form>
                
              </div>
              <!-- BOTONES DE CARRITO E INICIO DE SESION/REGISTRO -->
              <div class="d-flex justify-content-center align-items-center gap-lg-1 icons">
                <a href="#" class="bi bi-bag-heart-fill icono1"><a>
                    <div class="dropdown">
                        <a class="bi bi-person-fill icono2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg-end">
                          <?php
                             if(!isset($_SESSION["usuario"]))
                             {
                          ?>
                          <li><a class="dropdown-item fs-6" href="../views/login.php">Iniciar sesion</a></li>
                          <li><a class="dropdown-item fs-6 " href="../views/registrarse.php">Registrarse</a></li>
                          <?php
                            }
                          ?>
                          <li><?php
                                 if(isset($_SESSION["usuario"]))
                                 {
                                     echo "<a class='dropdown-item fs-6' href='../views/perfil.php'>Mi Perfil</a>";
                                 }
                              ?>
                        </li>
                        <li>
                            <?php
                                if(isset($_SESSION["usuario"]))
                                {
                                    echo "<a class='dropdown-item fs-6 ' href='../scripts/cerrar_sesion.php'>Cerrar Sesión</a>";
                                }
                              ?>
                      </li>
                      <li>
                            <?php
                            if(isset($_SESSION["usuario"]))
                            {
                              if ($admin == 0)
                              {
                                  echo "<a class='dropdown-item fs-6 ' href='../views/admin.php'>Administrar</a>";
                              }
                            }
                                
                            ?>
                      </li>
                                           
                        </ul>
                      </div>
              </div>
            </div>
          </div>
        </div>
      </nav>
      <!-- FIN DE LA BARRA DE NAVEGACION -->

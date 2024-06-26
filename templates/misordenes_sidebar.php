<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../img/home/logo.png" type="logo1/png">
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
<style>
       .infoicon
       {
        color:black;
       }

       .infoicon:hover
       {
        color:#e84393;
       }
       .infoicon:hover button
       {
        color:#e84393;
       }
    </style>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <a href="../index.php" style="text-decoration: none; color:black"><div class="sidebar-heading text-center py-4 fs-4 fw-bold border-bottom"><span>Sweet </span>Beauty</div></a>
            <div class="list-group list-group-flush my-3">

                <a href="../index.php" class="list-group-item list-group-item-action second-text fw-bold"><i class="bi bi-door-open-fill me-2"></i>Inicio</a>            

                <a href="../views/mis_ordenes.php" class="list-group-item list-group-item-action second-text fw-bold"><i class="bi bi-box-seam-fill"></i> Todas las ordenes</a>

                <a href="../views/mis_ordenes_pe.php" class="list-group-item list-group-item-action second-text fw-bold"><i class="bi bi-hourglass-split"></i> Pendiente</a>
                
                <a href="../views/mis_ordenes_pa.php" class="list-group-item list-group-item-action second-text fw-bold"><i class="bi bi-clipboard2-check-fill"></i><span> Pagado</span></a>
                
                <a href="../views/mis_ordenes_can.php" class="list-group-item list-group-item-action second-text fw-bold"><i class="bi bi-xbox"></i><span> Cancelado</span></a>

                <a href="../views/mis_ordenes_cad.php" class="list-group-item list-group-item-action second-text fw-bold"><i class="bi bi-hourglass-bottom"></i><span> Caducado</span></a>


                <div class="infoicon list-group-item list-group-item-action second-text fw-bolds">
                    <i style="margin-right: .2rem;" class="bi bi-info-circle"></i>
                    <button  type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                    Ayuda
                    </button>
                </div>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!--Inicio de la ayuda-->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasRightLabel"><span style="color:#e84393;">Sweet</span> Beauty</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
  <div>
        <div>
            <h5 class="offcanvas-title">Avisos</h5>
            <ul>
                <li>Aquí podrá ver sus ordenes hechas.</li>
                <li>Podrá cancelar sus ordenes Pendientes.</li>
                <li>Si cancela una orden, no la podrá activar y tendrá que apartar otra.</li>
                <li>Si no va por su pedido en menos de 3 días, se caducará y tendrá que comprarlo de nuevo si es que lo quiere.</li>
                <li>Los pedidos se pagarán y se recojerán en el local.</li>
            </ul>
        </div>
        <div>
            <h5 class="offcanvas-title">Guia</h5>
            Se puede filtrar sus ordenes:
            <ul>
                <li>Filtrar por articulo:</li>
                <ol>
                    <li>Ingrese el nombre del articulo en el buscador que se encuentra arriba.</li>
                    <li>Después de ingresar el nombre completo o como inicia, darle a enter  y se mostrará todo su pedido.</li>
                </ol>
                <li>Filtrar por código:</li>
                <ol>
                    <li>Al hacer su orden, se le genero un código, el cuál lo puede copiar, este se podra ingresar en el buscador.</li>
                    <li>Después de ingresar el código completo, darle a enter y se mostrará todo su pedido.</li>
                </ol>
                <li>Filtrar por estados:</li>
                <ol>
                    <li>Seleccione el estado por el que quiere ver sus ordenes, los cuales estan en la parte izquierda.</li>
                </ol>
            </ul>
            Se puede cancelar ordenes:
            <ol>
                <li>Busque el pedido que ya no quiere.</li>
                <li>Seleccionar el bóton y cancele la orden.</li>
            </ol>
        </div>
      
    </div>
  </div>
</div>
        <!--Fin de la ayuda-->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                </div>

                

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            
                            
                        </li>
                    </ul>
                </div>
                
            </nav>
        
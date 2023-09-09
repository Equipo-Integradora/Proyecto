<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../img/home/logo1.png" type="logo1/png">
    <link rel="stylesheet" href="../css/perfil.css">
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


    $conexion->perfil();
    $query = "SELECT * FROM usuarios WHERE id_usuario = '{$_SESSION["id"]}'";
    $pro=$conexion->usr($query);

    foreach($pro as $reg)
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
        color: #e84393;
       }
    </style>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">

        <div class="row">
  <div style="text-align: center; margin:1rem;" class="col-12">
  <?php
            if($reg->sexo_usuario == "Femenino")
            {
                ?>
                <img class="iconperfil" src="../img/productos/icono_mujer.png" alt="mujer foto">
                <?php
            }if($reg->sexo_usuario == "Masculino")
            {
                ?>
                <img class="iconperfil" src="../img/productos/icono_hombre.webp" alt="hombre foto">
                <?php
            }if($reg->sexo_usuario == "Otro")
            {
                ?>
                <img class="iconperfil" src="../img/productos/icono_otro.jpg" alt="otro foto">
                <?php
            }
        ?>
  </div>
  </div>

  <a href="../index.php" style="text-decoration: none; color:black"><div class="sidebar-heading text-center py-4 fs-4 fw-bold border-bottom"><span>Sweet </span>Beauty</div></a>
            <div class="list-group list-group-flush my-3">


                <a href="../views/perfil2.php" class="list-group-item list-group-item-action second-text fw-bold"><i class="bi bi-person-fill"></i> Perfil</a>
                
                <a href="../views/editar_perfil.php" class="list-group-item list-group-item-action second-text fw-bold"><i class="bi bi-pencil"></i><span> Editar Perfil</span></a>
                
                <a href="../views/Datos_cuenta.php" class="list-group-item list-group-item-action second-text fw-bold"><i class="bi bi-gear-wide"></i><span> Datos de la cuenta</span></a>

                <a href="../index.php" class="list-group-item list-group-item-action second-text fw-bold"><i class="bi bi-door-open-fill me-2"></i> Página principal</a>

                <div style="font-weight: bold;" class="infoicon list-group-item list-group-item-action second-text fw-bold">
                <i style="font-weight: bold; margin-right: .2rem;" class="bi bi-info-circle"></i>
                <button style="font-weight: bold;" class="infoicon" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
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
                <li>Aquí podrá ver su perfil.</li>
                <li>Podrá editar sus datos y verlos.</li>
                <li>Si cambia un dato y no se acuerda, no nos hacemos responsables.</li>
                <li>Para cambiar la contraseña, debe recordar su contraseña.</li>
                <li>Pudes regresar al inicio con el bóton de "Página principal" o seleccionando "<span style="font-weight: bold;"><span style="color:#e84393;">Sweet</span> Beauty</span>", que se encuentra abajo de la foto.</li>
                <li>Las fotos son predeterminadas, no se pueden cambiar.</li>
            </ul>
        </div>
        <div>
            <h5 class="offcanvas-title">Guia</h5>
            <ul>
                <li>En la parte de editar datos, puede cambiar sus datos personales (nombre, fecha de nacimiento y genero).</li>
            </ul>
            <ul>
                <li>En la parte de datos de la cuenta, puede cambiar los datos de identificación (correo, contraseña y telefono).</li>
            </ul>
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

                
            </nav>
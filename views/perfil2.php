
<?php  
session_start();
if(!isset($_SESSION["usuario"]))
{
  header("Location: ../views/login.php");
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/home/logo.png" type="logo/png">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/pruebatexto.css">
    <title>Sweet Beauty</title>
</head>
<body style="background-color:#f5f5f5">
<?php
    include "../templates/perfil_sidebar.php";
    

    $conexion->perfil();
    $query = "SELECT * FROM usuarios WHERE id_usuario = '{$_SESSION["id"]}'";
    $pro=$conexion->usr($query);
?>


<div style="margin: 3rem;" class="col-md-6 offset-lg-1 col-lg-8">
        <div>
        <?php
        foreach($pro as $re)
        {
           echo "<h3 class='fw-bold'>Usuario <i class='bi bi-person'></i></h3><p> $re->nombre_usuario</p>";
           echo "<h3 class='fw-bold'>Correo <i class='bi bi-envelope-heart'></i></h3><p> $re->email_usuario</p>";
           echo "<h3 class='fw-bold'>Teléfono <i class='bi bi-phone'></i></h3><p> $re->telefono_usuario</p>";
           echo "<h3 class='fw-bold'>Sexo";
           if($reg->sexo_usuario == "Femenino")
           {
               ?>
               <i class="bi bi-gender-female"></i>
               <?php
           }if($reg->sexo_usuario == "Masculino")
           {
               ?>
               <i class="bi bi-gender-male"></i>
               <?php
           }if($reg->sexo_usuario == "Otro")
           {
               ?>
              <i class='bi bi-rainbow'></i>
               <?php
           }
           echo "</h3><p>$re->sexo_usuario</p>";
        }
        ?>
    </div>
<!--Fin de imagenes-->
<!--Fin del perfil-->
        </div>



<script
  src="https://code.jquery.com/jquery-3.7.0.js"
  integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
<script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
    <script>
        
        function cambiarTituloPestana(nuevoTitulo) {
          document.title = nuevoTitulo;
        }


        window.addEventListener("focus", function() {
          cambiarTituloPestana("Sweet Beauty");
        });


        window.addEventListener("blur", function() {
          cambiarTituloPestana("Aún puedes hacer más cosas");
        });
    </script>
</body>
</html>
<!--Inicio de consultas e incluciones-->
<?php 
$perfil = true;
include "../templates/header.php";

if(isset($_SESSION["usuario"]))
{
    include "../class/database.php";
    $conexion = new database();
    $conexion->conectarDB();
    $query = "SELECT * FROM usuarios WHERE id_usuario = '{$_SESSION["id"]}'";
    $pro=$conexion->usr($query);
    ?>
    <div class="container" style="margin-top: 80px;">
    <?php
    foreach($pro as $reg)
    ?>
    
<!--Fin de consultas e incluciones-->


<!--Inicio del perfil-->
    <div class="container">
    <div class="row">
        <div class="col-md-6 col-lg-3">
<!--Inicio de imagenes-->
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
<!--Fin de imagenes-->

<!--Inicio de los datos-->
        </div>
        <div class="col-md-6 col-lg-9">
        <div>
        <?php
        foreach($pro as $re)
        {
           echo "<p>Usuario: $re->nombre_usuario</p>";
           echo "<p>Correo: $re->email_usuario</p>";
           echo "<p>Telefono: $re->telefono_usuario</p>";
           echo "<p>Sexo: $re->sexo_usuario</p>";
        }
        ?>
    </div>
<!--Fin de imagenes-->

        </div>
      </div>
    </div>
    <div class="card conteperfil" style="display:block;" >            
    </div>
    </div>
</div>
<!--Fin del perfil-->

<!--Inicio de PHP y links-->
<link rel="stylesheet" href="../css/perfil.css">
<?php
include "../templates/footer.php";
}
else
{
    header("Location: ../views/login.php");
}
?>
<!--Fin de PHP y links-->

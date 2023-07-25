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
<div class="d-flex align-items-start" >
  <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="background-color: #e84393;">
    <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Perfil</button>
    <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Editar perfil</button>
    <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Datos de la cuenta</button>
    <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</button>

    
  </div>
  <div class="tab-content" id="v-pills-tabContent">
    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
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
<!--Fin del perfil-->
        </div>
      </div>
    </div>
    <div class="card conteperfil" style="display:block;" >            
    </div>
    </div>
</div>
    </div>
    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">...</div>
    <div class="tab-pane fade" id="v-pills-disabled" role="tabpanel" aria-labelledby="v-pills-disabled-tab" tabindex="0">...</div>
    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab" tabindex="0">...</div>
    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab" tabindex="0">...</div>
  </div>
    


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

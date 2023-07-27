<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../js/bootstrap.js">
    <title>Document</title>
</head>
<body>
  <div class="container">
    
<?php
include "../templates/header.php";
include "../class/database.php";

$conexion = new database();
$conexion->conectarDB();

    session_start();
    if(isset($_SESSION["usuario"]))
    {
        ?>
    <div class="d-flex align-items-start">
    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="background-color: #e84393;">
    <button class="nav-link" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Perfil</button>
    <button class="nav-link active" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Editar perfil</button>
    <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Datos de la cuenta</button>
    <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</button>
  </div>






<?php

$aidi=$_SESSION["id"];
$con="select *
from usuarios
where usuarios.id_usuario=$aidi";
    $si=$conexion->ejecuta($con);
    ?>


  <div class="tab-content" id="v-pills-tabContent">
    <div class="" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
        <div class="row">
            <div class="col">
                <br>
                <h3>Editar perfil</h3>
                <br>
                <a href="" style="text-decoration:none"><div style="width: 450px; color:black" class="p-3 bg-secondary bg-opacity-10 border border-black rounded">Editar contraseña</div></a>
                <br>
                <a href="" style="text-decoration:none"><div style="width: 450px; color:black" class="p-3 bg-secondary bg-opacity-10 border border-black rounded">Editar correo</div></a>
                <a href="" style="text-decoration:none"><div style="width: 450px; color:black" class="p-3 bg-secondary bg-opacity-10 border border-black rounded">Editar telefono</div></a>
                <form action="../scripts/verificar_login.php" method="post">
                        <div class="input-field">
                            <label for="usuario">Nombre</label>
                            <input type="text" class="input" name="nombre" value="<?php echo$_SESSION["usuario"];?>"
                             required autocomplete="off">
                        </div>
                        
                        <div class="input-field">
                            <label for="pass">Contraseña actual</label>
                            <input type="password" class="input" name="pass" required autocomplete="off">
                        </div>
                        <div class="input-field">
                            <label for="pass">Contraseña nueva</label>
                            <input type="password" class="input" name="pass" required autocomplete="off">
                        </div>
                        <div class="input-field">
                            <label for="pass">Confirmar contraseña nueva</label>
                            <input type="password" class="input" name="pass" required autocomplete="off">
                        </div>
                        <div class="input-field">
                        <label for="usuario">Telefono</label>
                            <input type="tel" class="input" name="telefono"  value="<?php echo $si->telefono_usuario;?>" required>
                        </div>
                        <div class="input-field">
                        <label for="usuario">Fecha de nacimiento</label>
                            <input type="date" class="form-control" name="fecha"  value="<?php echo $si->fecha_nacimiento_usuario;?>" required>
                        </div>
                        <div class="input-field">
                            <input type="submit" class="submit" value="Guardar cambios">      
                        </div>
                        </form>
                

                        


            </div>
        </div>
    </div>


    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">...</div>
    <div class="tab-pane fade" id="v-pills-disabled" role="tabpanel" aria-labelledby="v-pills-disabled-tab" tabindex="0">...</div>
    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab" tabindex="0">
        <div class="form-label">Editar contraseña</div>
    </div>
    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab" tabindex="0">...</div>
  </div>
</div>
    <?php
    
    }
    else
    {
        header("Location: ../views/login.php");
    }
    ?>
    <script src="js/bootstrap.bundle.min.js"></script>
  </div>
</body>

</html>
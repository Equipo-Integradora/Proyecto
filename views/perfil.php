<!--Inicio de consultas e incluciones-->
<?php 
session_start();
if(isset($_SESSION["usuario"]))
{
  $perfil = true;
  include "../templates/header.php";
  include "../class/database.php";
  $conexion = new database();
  $conexion->conectarDB();
  $conexion->perfil();
  $query = "SELECT * FROM usuarios WHERE id_usuario = '{$_SESSION["id"]}'";
  $pro=$conexion->usr($query);
  ?>
  <div class="container" style="margin-top: 80px;">
  <?php
  foreach($pro as $reg)
?>
    
<!--Fin de consultas e incluciones-->


<div class="d-flex align-items-start">
  <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="width: 200px; height:400px">
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
  <div class="col-12" style="text-align: center;"><?php echo $reg->nombre_usuario ?></div>
  </div>
  <div style="text-align: left; width:100%;">
    
    <button style="width: 100%;" class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Perfil</button>
    <button style="width: 100%;" class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Editar perfil</button>
    <button style="width: 100%;" class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Datos de la cuenta</button>
    <button style="width: 100%;" class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</button>
  
    </div>
</div>
  <div class="tab-content" id="v-pills-tabContent">
    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
            <div class="container">
    <div class="row">
        

<!--Inicio de los datos-->
        <div style="margin: 3rem;" class="col-md-6 offset-lg-1 col-lg-8">
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
    </div>

    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
    <div class="row">
    <div class="col-12">
        <p style="font-size:20px">Edición de perfil</p>
    </div>
    <form action="../scripts/editar_sencillo.php" method="post">

                        <div class=" col-12 input-field">
                            <label for="usuario">Nombre</label>
                            <input type="text" class="input" name="nombre" value="<?php echo $reg->nombre_usuario;?>"
                             required autocomplete="off">
                        </div>
                        <br>
                        
                        <div class="col-12 input-field">
                        <label for="usuario">Fecha de nacimiento</label>
                            <input type="date" class="form-control" name="fecha"  value="<?php echo $reg->fecha_nacimiento_usuario;?>" required>
                        </div>
<br>
                        <div class="col-12 form-group " id="genero-group">
                            <label for="genero">Género</label>
                            <div class="genero-categoria">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="genero" value="1" <?php if ($reg->sexo_usuario == 'Masculino')echo 'checked';?>>
                                    <label class="form-check-label" for="genero">Masculino</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="genero" value="2" <?php if ($reg->sexo_usuario == 'Femenino')echo 'checked';?>>
                                    <label class="form-check-label" for="genero">Femenino</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="genero" value="3" <?php if ($reg->sexo_usuario == 'Otro')echo 'checked';?>>
                                    <label class="form-check-label" for="genero">Otro</label>
                                </div>
                            </div>
                        </div>
                        <br>


                        <div class="col-12 input-field">
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </div>
                        </form>
    </div>
    </div>



    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab" tabindex="0"><br>
    <div class="container" style="margin: 30px;">
    <div class="row">
    <div class="col-12">
        <p style="font-size:20px">Configuración de datos de la cuenta</p>
    </div>
    <div class="col-12" style="margin-bottom: 20px;">
    <!--class="btn btn-primary" -->
    <button type="button" style="width: 450px; color:black; height:60px" class="row p-3 bg-secondary bg-opacity-10 border border-black rounded" data-bs-toggle="modal" data-bs-target="#exampleModalM">
      <div class="col-lg-5">
        <p>Editar correo</p>
      </div>
      <div class="offset-lg-5 col-lg-2">
        <img style="float:left; width: 30px; width:30px" src="../img/perfil/pencil-square.svg" alt="">
      </div>
    </button>
    </div>
    <br>
    <div class="col-12" style="margin-bottom: 20px;">
    <!--class="btn btn-primary" -->
        <button type="button" style="width: 450px; color:black; height:60px" class="row p-3 bg-secondary bg-opacity-10 border border-black rounded" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <div class="col-lg-5">
                    <p>Editar contraseña</p>
                </div>
                <div class="offset-lg-5 col-lg-2">
                    <img style="float:left; width: 30px; width:30px" src="../img/perfil/pencil-square.svg" alt="">
                </div>
        </button>
           
    </div>
    <br>
    <div class="col-12" style="margin-bottom: 20px;">
    <!--class="btn btn-primary" -->
        <button type="button" style="width: 450px; color:black; height:60px" class="row p-3 bg-secondary bg-opacity-10 border border-black rounded" data-bs-toggle="modal" data-bs-target="#tele">
        <div class="col-lg-5">
                    <p>Editar telefono</p>
                </div>
                <div class="offset-lg-5 col-lg-2">
                    <img style="float:left; width: 30px; width:30px" src="../img/perfil/pencil-square.svg" alt="">
                </div>
        </button>
           
    </div>
         <br>

    </div>
    </div>


    <!-- Modal Coreo
<div class="modal fade" id="correo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div  class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar correo</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="../scripts/editardatos.php" method="post">  
      <div class="modal-body">

      <label for="usuario">Correo</label>
      <input type="email" class="input" name="email" required>

      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary" onclick="cambiarcorreo()">Guardar cambios</button>
        </form>
      </div>
      
      </div>
      
    </div>
    Fin modal-->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar contraseña</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="../scripts/editardatos.php" method="post" onsubmit="return validarContrasenaIgual();">
  <div class="modal-body">
    <label for="usuario">Contraseña actual</label>
    <input type="password" class="input" name="pass" required>
    <label for="usuario">Contraseña nueva</label>
    <input type="password" class="input" name="passn" id="passn" required>
    <label for="usuario">Confirmar Contraseña</label>
    <input type="password" class="input" name="passcn" id="passcn" required>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
    <button type="submit" class="btn btn-primary">Guardar cambios</button>
  </div>
</form>

      </div>
    </div>
  </div>
</div>


    
 <!-- Modal tel-->
 <div class="modal fade" id="tele" tabindex="-1" aria-labelledby="si" aria-hidden="true">
  <div  class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="si">Editar telefono</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="../scripts/editardatos.php" method="post">  
      <div class="modal-body">

      <label for="usuario">Telefono</label>
      <input type="tel" class="input" name="tel" required>

      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary" >Guardar cambios</button>
        </form>
      </div>
      
      </div>
      
    </div>
    <!--Fin modal-->

    
  </div>
</div>
  
           

    </div>
    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab" tabindex="0">
    <div class="row">
    <div class="col-12">
        <p style="font-size:20px">Configuración</p>
    </div>
    
    <div class="accordion" id="accordionExample">
  <div class="col-12">
    
    <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        Tema
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong><div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
  <label class="form-check-label" for="flexSwitchCheckDefault">Modo oscuro</label>
</div>

        </div>
    </div>
  </div>
  
  </div>
  <div class="col-12">

  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        Accordion Item #2
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong></div>
    </div>
  </div>
    
  </div>
</div>
</div>
    </div>
  </div>
</div>


<script>
  function validarContrasenaIgual() {
    var passnueva = document.getElementById('passn').value;
    var confirmarContrasena = document.getElementById('passcn').value;

    if (passnueva !== confirmarContrasena) {
      alert("Las contraseñas no coinciden. Por favor, verifica y vuelve a intentarlo.");
      return false; // Evita el envío del formulario si las contraseñas no coinciden
    }

    return true; // Permite el envío del formulario si las contraseñas coinciden
  }
</script>



<!--Inicio del perfil-->


    <div class="card conteperfil" style="display:block;" >            
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

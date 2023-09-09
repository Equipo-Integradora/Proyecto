<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="icon" href="../img/home/logo.png" type="logo/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/pruebatexto.css">
    <link rel="stylesheet" href="../css/home.css">
    <title>Sweet Beauty</title>
</head>
<body style="background-color:#f5f5f5">
<?php
    session_start();
    include "../templates/perfil_sidebar.php";
    

    $conexion->perfil();
    $query = "SELECT * FROM usuarios WHERE id_usuario = '{$_SESSION["id"]}'";
    $pro=$conexion->usr($query);

    foreach($pro as $reg)

    ?>

<div class="container" style="margin: 30px;">
<div class="row">
    <div class="col-12">
        <p style="font-size:20px">Configuracion de la cuenta</p>
    </div>
    <div class="col-12" style="margin-bottom: 20px;">
    <!--class="btn btn-primary" -->
    <button type="button" style="width:300px; color:black; height:60px" class="row p-3 bg-secondary bg-opacity-10 border border-black rounded" data-bs-toggle="modal" data-bs-target="#exampleModalM">
      <div class="col-lg-8 col-7">
        <p>Editar correo</p>
      </div>
      <div class="offset-lg-2 col-lg-2 offset-3 col-2">
                    <img style="float:left; width: 30px; width:30px" src="../img/perfil/pencil-square.svg" alt="">
                </div>
</div>
<br>
    <div class="col-12" style="margin-bottom: 20px;">
    <!--class="btn btn-primary" -->
        <button type="button" style="width: 300px; color:black; height:60px" class="row p-3 bg-secondary bg-opacity-10 border border-black rounded" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <div class="col-lg-8 col-7">
                    <p>Editar contraseña</p>
                </div>
                <div class="offset-lg-2 col-lg-2 offset-3 col-2">
                    <img style="float:left; width: 30px; width:30px" src="../img/perfil/pencil-square.svg" alt="">
                </div>
        </button>
           
    </div>
    <br>
    <div class="col-12" style="margin-bottom: 20px;">
    <!--class="btn btn-primary" -->
        <button type="button" style="width: 300px; color:black; height:60px" class="row p-3 bg-secondary bg-opacity-10 border border-black rounded" data-bs-toggle="modal" data-bs-target="#tele">
        <div class="col-lg-8 col-7">
                    <p>Editar telefono</p>
                </div>
                <div class="offset-lg-2 col-lg-2 offset-3 col-2">
                    <img style="float:left; width: 30px; width:30px" src="../img/perfil/pencil-square.svg" alt="">
                </div>
        </button>
           
    </div>
         <br>


    </div>

    <!-- Modal Coreo-->
    <div class="modal fade" id="exampleModalM" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div  class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar correo</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="../scripts/editardatos.php" method="post">  
      <div class="modal-body">

      <label for="email">Correo</label>
      <input type="email" class="input" name="email" id="correo" required>

      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn boton" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn boton" onclick="return validarCorreo();">Guardar cambios</button>
      </div>
      
      </form>
      </div>
      
    </div>
</div>


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
    <button type="button" class="btn boton" data-bs-dismiss="modal">Cerrar</button>
    <button type="submit" class="btn boton">Guardar cambios</button>
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
      <input type="tel" class="input" maxlength="10" name="tel" id="telefono" required>

      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn boton" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn boton" id="submitButton" onclick="return validarTelefono();">Guardar cambios</button>
        </form>
      </div>
      
      </div>
      
    </div>


<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

<script
  src="https://code.jquery.com/jquery-3.7.0.js"
  integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
  crossorigin="anonymous"></script>
    <script src="../js/clock.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
<script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
    <script>
  function validarCorreo(){
  var correo = document.getElementById('correo').value;
  if (correo === '') {
            Swal.fire({
                icon: 'info',
                title: 'Ingrese un correo.',
                showConfirmButton: false,
                timer: 1500
            });
            return false;
        }
        const expresion = /^[a-zA-Z0-9._-]+@(uttcampus\.edu|gmail|outlook|hotmail|icloud|live|utt\.edu)\.(com|es|mx|org|net)$/;
        const isValid = expresion.test(correo);
        if (!isValid) {
            Swal.fire({
                icon: 'error',
                title: 'Ingrese un correo válido.',
                showConfirmButton: false,
                timer: 1500
            });
            return false;
        }
      }
</script>

<script>
function validarTelefono() {
    var telefono = document.getElementById('telefono').value;
    if(telefono.length !=10 ){
        
        Swal.fire({
            icon: 'info',
            title: 'Numero de caracteres debe ser 10.',
            showConfirmButton: false,
            timer: 1500

        });
        return false;
    }
    if (telefono === '') {
        Swal.fire({
            icon: 'info',
            title: 'Ingrese su teléfono.',
            showConfirmButton: false,
            timer: 1500
        });
        return false;
    }
    const expresionTelefono = /(?!(\d)\1{6})\d{7}$/;
    const isValidTelefono = expresionTelefono.test(telefono);
    if (!isValidTelefono) {
        Swal.fire({
            icon: 'error',
            title: 'Ingrese un número de teléfono válido.',
            showConfirmButton: false,
            timer: 1500
        });
        return false;
    }
    return true; // Devolver true si la validación es exitosa
}
</script>
<script>
  function validarContrasenaIgual() {
    var passnueva = document.getElementById('passn').value;
    var confirmarContrasena = document.getElementById('passcn').value;

    if (passnueva !== confirmarContrasena) {
      Swal.fire({
        icon: 'error',
        title: 'Las contraseñas no coinciden',
        text: 'Por favor, verifica y vuelve a intentarlo.'
      });
      return false;
    }
    if (passnueva.length <7  || confirmarContrasena.length < 7) {
      Swal.fire({
        icon: 'error',
        title: 'Contraseña minimo 7 caracteres',
        text: 'Por favor, verifica y vuelve a intentarlo.'
      });
      return false;
    }

    return true;
  }
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
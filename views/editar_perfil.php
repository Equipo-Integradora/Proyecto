<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="icon" href="../img/home/logo.png" type="logo/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/pruebatexto.css">
   
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

<div class="container">
<div class="row">
    <div class="col-12">
        <p style="font-size:20px">Edición de perfil</p>
    </div>
    <form action="../scripts/editar_sencillo.php" method="post">

                        <div class=" col-12 input-field">
                            <label for="usuario">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" maxlength="70" value="<?php echo $reg->nombre_usuario;?>"
                             required autocomplete="off">
                        </div>
                        <br>
                        
                        <div class="col-12 input-field">
                        <label for="usuario">Fecha de nacimiento</label>
                            <input type="date" class="form-control" id="fecha" name="fecha"  value="<?php echo $reg->fecha_nacimiento_usuario;?>" required>
                        </div>
<br>
                        <div class="col-12 form-group " id="genero-group">
                            <label for="genero">Género</label>
                            <div class="genero-categoria">
                                <div class="form-check">
                                    <input class="radio form-check-input" type="radio" name="genero" value="1" <?php if ($reg->sexo_usuario == 'Masculino')echo 'checked';?>>
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
                        <button type="submit" class="btn boton" onclick="return validarCamposLlenos();validarFechaGenero();">Guardar cambios</button>
                        </div>
                        </form>
    </div>

    </div>

<script
  src="https://code.jquery.com/jquery-3.7.0.js"
  integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>

    <script>
        function validarCamposLlenos() {
        var nombre = document.getElementById('nombre').value;
        var fecha = document.getElementById('fecha').value;


        if (nombre === '') {
            Swal.fire({
                icon: 'info',
                title: 'Ingrese su nombre.',
                showConfirmButton: false,
                timer: 1500
            });
            return false;
        }
        
        if (nombre.length <8) {
            Swal.fire({
                icon: 'info',
                title: 'Nombre muy corto.',
                showConfirmButton: false,
                timer: 1500
            });
            return false;
        }
        if (fecha === '') {
            Swal.fire({
                icon: 'info',
                title: 'Ingrese la fecha de nacimiento.',
                showConfirmButton: false,
                timer: 1500
            });
            return false;
        }



      
        if (!validarFechaNacimiento(fecha)) {
            return false;
        }

        

        return true;


        function validarFechaNacimiento(fecha) {
        if (!fecha) {
            Swal.fire({
                icon: 'info',
                title: 'Seleccione una fecha de nacimiento.',
                showConfirmButton: false,
                timer: 1500
            });
            return false;
        }

        
        var fechaSeleccionada = new Date(fecha);
        var fechaActual = new Date();

      
      var fechaMin = new Date();
      var fechaMax = new Date();
      fechaMin.setFullYear(fechaActual.getFullYear() - 18);
      fechaMax.setFullYear(fechaActual.getFullYear() - 100);

      
      if (fechaSeleccionada >= fechaMax) 
      {;
          if (fechaSeleccionada >= fechaMin) 
        {;
            Swal.fire({
                icon: 'warning',
                title: 'Solo se permiten mayores de edad.',
                showConfirmButton: false,
                timer: 1500
            });
          return false;
        }
        
      }else{
        Swal.fire({
                icon: 'info',
                title: 'Ingrese una fecha adecuada.',
                showConfirmButton: false,
                timer: 1500
            });
          return false;
        }

        var genero = document.querySelector('input[name="genero"]:checked');

        if (!genero) {
            Swal.fire({
                icon: 'info',
                title: 'Defina su género.',
                showConfirmButton: false,
                timer: 1500
            });
            return false;
        }

        return true;
    }
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
<?php
session_start();
if(!isset($_SESSION["usuario"]))
{
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/home/logo.png" type="logo1/png">
    <link rel="stylesheet" href="../css/registrarse.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Registrarse</title>
    <style>
        .hidden 
        {
            display: none;
        }
        
        .main 
        {
            padding-top: 10px;
            padding-bottom: 10px;
        }
        
        .form-group label 
        {
            margin-bottom: 3px;
        }
        
        .alert 
        {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container main">
        <div class="row">
            <div class="col-md-6 col-12 image">
            <button type="button" class="hidden1 btn-close m-3" aria-label="Close" onclick="redirectToHome()"></button>
                <div class="text text-center mt-md-5">
                    <p class="logo fs-1 m-auto hidden1"><span>Sweet</span> Beauty</p>
                    <p class="hidden1">Maquillaje y peinados</p>
                </div>
            </div>
            <div class="col-md-6 col-12 right">
            <form action="../scripts/ingresar_usuario.php" method="post" onsubmit="return validarFormulario(); cambiarTextoBoton(); verificarValor();">
                    <header class="text-center m-3 fw-bold fs-3">Registrarse</header>
                    <div class="input-box">
                        <div class="form-group input-field mt-5">
                            <input type="text" class="input" id="nombre" name="nombre" required autocomplete="off">
                            <label for="nombre" id="nombreText">Nombre completo</label>
                        </div>
                        <div class="form-group input-field mt-3">
                            <input type="email" class="input" id="correo" name="correo" required autocomplete="off">
                            <label for="correo" id="correoText">Correo</label>
                        </div>
                        <div class="form-group input-field mt-3">
                            <input type="tel" class="input" id="telefono" name="telefono" required autocomplete="off">
                            <label for="correo" id="telefonoText">Teléfono</label>
                        </div>
                        <div class="form-group mt-3" id="genero-group">
                            <label for="genero">Género</label>
                            <div class="genero-categoria">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="genero" value="1">
                                    <label class="form-check-label" for="genero">Masculino</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="genero" value="2">
                                    <label class="form-check-label" for="genero">Femenino</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="genero" value="3">
                                    <label class="form-check-label" for="genero">Otro</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3" id="fecha-group">
                            <label for="fecha">Fecha de nacimiento</label>
                            <input type="date" class="form-control nose" name="fecha" id="fecha" required>
                        </div>

                        <div class="form-group hidden input-field" id="pass-group">
                            <input type="password" class="input" name="pass" id="pass" required autocomplete="off">
                            <label for="pass">Contraseña</label>
                        </div>
                        <div class="form-group hidden input-field mt-3" id="passconf-group">
                            <input type="password" class="input" name="passconf" id="passconf" required autocomplete="off">
                            <label for="passconf">Confirmar contraseña</label>
                        </div>
                        <div class="input-field mt-4">
                            <input type="submit" class="submit m-auto" id="submitButton" value="Continuar" onclick="return validarCamposLlenos();cambiarTextoBoton();validarFechaGenero();">
                        </div>
                        <div class="alert">
                            <span>Ya tienes una cuenta? <a href="../views/login.php">Inicia sesión aqui</a></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
<script>
          function validarCamposLlenos() {
        var nombre = document.getElementById('nombre').value;
        var correo = document.getElementById('correo').value;
        var telefono = document.getElementById('telefono').value;
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
        if (correo === '') {
            Swal.fire({
                icon: 'info',
                title: 'Ingrese un correo.',
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
        if (fecha === '') {
            Swal.fire({
                icon: 'info',
                title: 'Ingrese la fecha de nacimiento.',
                showConfirmButton: false,
                timer: 1500
            });
            return false;
        }

        const expresion = /^[a-zA-Z0-9._-]+@(uttcampus\.edu|gmail|outlook|hotmail|icloud)\.(com|es|mx|org)$/;
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

        const expresionTelefono = /^871(?!(\d)\1{6})\d{7}$/;
        const isValidTelefono = expresionTelefono.test(telefono);
        if (!isValidTelefono) {
            Swal.fire({
                icon: 'error',
                title: 'Ingrese un número de teléfono valido.',
                showConfirmButton: false,
                timer: 1500
            });
            return false;
        }

      
        if (!validarFechaNacimiento(fecha)) {
            return false;
        }

        if (!validarContrasenaIgual()) {
            return false;
        }

        mostrarCamposContraseña();
        cambiarTextoBoton();

        return true;
    }
        
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

    function validarContrasenaIgual() {
        var pass = document.getElementById('pass').value;
        var passconf = document.getElementById('passconf').value;
        
        if (pass !== passconf) {
            Swal.fire({
                icon: 'error',
                title: 'Las contraseñas no coinciden',
                showConfirmButton: false,
                timer: 1500
            });
            return false;
        }
        
        return true;
    }

    function mostrarCamposContraseña() {
        document.getElementById('nombre').classList.add('hidden');
        document.getElementById('nombreText').classList.add('hidden');
        document.getElementById('correoText').classList.add('hidden');
        document.getElementById('correo').classList.add('hidden');
        document.getElementById('telefonoText').classList.add('hidden');
        document.getElementById('telefono').classList.add('hidden');
        document.getElementById('genero-group').classList.add('hidden');
        document.getElementById('fecha-group').classList.add('hidden');
        document.getElementById('pass-group').classList.remove('hidden');
        document.getElementById('passconf-group').classList.remove('hidden');
    }

    function cambiarTextoBoton() {
        document.getElementById('submitButton').value = 'Registrarse';
    }

</script>
<script>
        function redirectToHome() 
        {
        window.location.href = "../index.php";
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
          cambiarTituloPestana("Aún no te has registrado");
        });
    </script>
</body>
</html>
<?php
}
else
{
    header("refresh:1 ; ../index.php");
}
?>
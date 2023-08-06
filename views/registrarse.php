<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/registrarse.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Registrarse</title>
    <style>
        .hidden {
            display: none;
        }
        
        .main {
            padding-top: 30px;
        }
        
        .logo 
        {
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        
        .content 
        {
            margin-top: 30px;
        }
        
        .form-group label {
            margin-bottom: 5px;
        }
        
        .submit {
            margin-top: 15px;
        }
        
        .alert {
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
                <div class="text">
                    <p class="logo fs-1 m-auto"><span>Sweet</span> Beauty</p>
                    <p>Maquillaje y peinados</p>
                </div>
            </div>
            <div class="col-md-6 right">
            <form action="../scripts/ingresar_usuario.php" method="post" onsubmit="return validarCamposLlenos(); cambiarTextoBoton();">
                    <header class="text-center m-3 fw-bold fs-3">Registrarse</header>
                    <div class="input-box">
                        <div class="form-group input-field mt-3">
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
                            <input type="date" class="form-control" name="fecha" id="fecha" required>
                        </div>

                        <div class="form-group hidden input-field" id="pass-group">
                            <input type="password" class="input" name="pass" id="pass" required autocomplete="off">
                            <label for="pass">Contraseña</label>
                        </div>
                        <div class="form-group hidden input-field mt-3" id="passconf-group">
                            <input type="password" class="input" name="passconf" id="passconf" required autocomplete="off">
                            <label for="passconf">Confirmar contraseña</label>
                        </div>
                        <div class="input-field mt-3">
                            <input type="submit" class="submit" id="submitButton" value="Continuar" onclick="return validarCamposLlenos();cambiarTextoBoton();validarFechaGenero();">
                        </div>
                        <div class="alert" style="margin-bottom:1rem;">
                            <span>Ya tienes una cuenta? <a href="../views/login.php">Inicia sesión aqui</a></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<br><br>

<!-- SCRIPTS -->
<script src="../js/bootstrap.bundle.min.js"></script>
<script>
          function validarCamposLlenos() {
        var nombre = document.getElementById('nombre').value;
        var correo = document.getElementById('correo').value;
        var telefono = document.getElementById('telefono').value;
        var fecha = document.getElementById('fecha').value;


        if (nombre === '') {
            alert("Ingrese su nombre.");
            return false;
        }
        if (correo === '') {
            alert("Ingrese un correo.");
            return false;
        }
        if (telefono === '') {
            alert("Ingrese su teléfono.");
            return false;
        }
        if (fecha === '') {
            alert("Ingrese la fecha de nacimiento")
            return false;
        }

        const expresion = /^[a-zA-Z0-9._-]+@(uttcampus\.edu|gmail|outlook|hotmail|icloud)\.(com|es|mx|org)$/;
        const isValid = expresion.test(correo);
        if (!isValid) {
            alert("Ingrese un correo válido.");
            return false;
        }

        const expresionTelefono = /^[0-9]{10}$/;
        const isValidTelefono = expresionTelefono.test(telefono);
        if (!isValidTelefono) {
            alert("Ingrese un número de teléfono de 10 dígitos.");
            return false;
        }

      
        if (!validarFechaNacimiento(fecha)) {
            return false;
        }

        // Validación de contraseñas
        if (!validarContrasenaIgual()) {
            return false;
        }

        mostrarCamposContraseña();
        cambiarTextoBoton();

        return true;
    }
        
    function validarFechaNacimiento(fecha) {
        if (!fecha) {
            alert("Seleccione una fecha de nacimiento.");
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
          alert("Solo se permiten mayores de edad.");
          return false;
        }
        
      }else{
          alert("Ingrese una fecha adecuada.");
          return false;
        }

        var genero = document.querySelector('input[name="genero"]:checked');

        if (!genero) {
            alert("Defina su género.");
            return false;
        }

        return true;
    }

    function validarContrasenaIgual() {
        var pass = document.getElementById('pass').value;
        var passconf = document.getElementById('passconf').value;
        
        if (pass !== passconf) {
            alert("Las contraseñas no coinciden");
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
    
</body>
</html>
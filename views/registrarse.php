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
        
        .logo {
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        
        .content {
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
            <div class="col-md-6 image">
                <div class="text">
                    <p class="logo"><span>Sweet</span> Beauty</p>
                    <p>Maquillaje y peinados</p>
                </div>
            </div>
            <div class="col-md-6 right">
                <form action="../scripts/ingresar_usuario.php" method="post" onsubmit="return validarContraseña(); cambiarTextoBoton()">
                    <header style="text-align: center;font-size: 25px;">Registrarse</header>
                    <div class="content">
                        <div class="form-group input-field">
                            <label for="nombre" id="nombreText">Nombre completo</label>
                            <input type="text" class="input" id="nombre" name="nombre" required autocomplete="off">
                        </div>
                        <div class="form-group input-field">
                            <label for="correo" id="correoText">Correo</label>
                            <input type="email" class="input" id="correo" name="correo" required autocomplete="off">
                        </div>
                        <div class="form-group input-field">
                            <label for="correo" id="telefonoText">Telefono</label>
                            <input type="tel" class="input" id="telefono" name="telefono" required autocomplete="off">
                        </div>
                        <div class="form-group " id="genero-group">
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
                            </div>
                        </div>
                        <div class="form-group hidden input-field" id="pass-group">
                            <label for="pass">Contraseña</label>
                            <input type="password" class="input" name="pass" id="pass" required autocomplete="off">
                        </div>
                        <div class="form-group hidden input-field" id="passconf-group">
                            <label for="passconf">Confirmar contraseña</label>
                            <input type="password" class="input" name="passconf" id="passconf" required autocomplete="off">
                        </div>
                        <div class="form-group" id="fecha-group">
                            <label for="fecha">Fecha de nacimiento</label>
                            <input type="date" class="form-control" name="fecha">
                        </div>
                        <div class="input-field">
                            <input type="submit" class="submit" id="submitButton" value="Continuar" onclick="mostrarCamposContraseña(); cambiarTextoBoton();">
                        </div>
                        <div class="alert">
                            <p>¿Ya tienes una cuenta? <a href="../views/login.php">Inicia sesión aquí</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPTS -->
<script src="../js/bootstrap.bundle.min.js"></script>
<script>
     function validarCamposLlenos() {
        var nombre = document.getElementById('nombre').value;
        var correo = document.getElementById('correo').value;
        var telefono = document.getElementById('telefono').value;
        
        if (nombre === '' || correo === '' || telefono === '') {
            alert("Por favor, complete todos los campos requeridos.");
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

    function validarContraseña() {
        var pass = document.getElementById('pass').value;
        var passconf = document.getElementById('passconf').value;
        
        if (pass !== passconf) {
            alert("Las contraseñas no coinciden");
            return false;
        }
        
        return true;
    }
    
    function cambiarTextoBoton() {
        document.getElementById('submitButton').value = 'Registrarse';
    }
</script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/registrarse.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Registrarse</title>
</head>
<body>
    <div class="containter">
        <form action="../scripts/ingresar_usuario.php" method="post">
            <h2 class="fs-1">Sweet Beauty</h2>
            <h4 class="fs-5">Registrarse</h4>
            <div class="content">
                <div class="input-box">
                    <input type="text" class="input" name="nombre" required autocomplete="off">
                    <label for="nombre">Nombre completo</label>
                </div>
                <div class="input-box">
                    <input type="email" class="input" name="correo" required autocomplete="off">
                    <label for="correo">Correo</label>
                </div>
                <div class="input-box">
                    <input type="tel" class="input" name="telefono" required autocomplete="off">
                    <label for="telefono">Telefono</label>
                </div>
                <div class="input-box">
                    <input type="password" class="input" name="pass" required autocomplete="off">
                    <label for="pass">Contraseña</label>
                </div>
                <div class="input-box">
                    <input type="password" class="input" name="passconf" required autocomplete="off">
                    <label for="passconf">Confirmar contraseña</label>
                </div>
                <span class="genero-titulo">Genero</span>
                    <div class="genero-categoria">
                        <input type="radio" name="genero" value="1">
                        <label for="genero">Masculino</label>
                        <input type="radio" name="genero" value="2">
                        <label for="genero">Femenino</label>
                    </div>
                <div class="input-box">
                    <input type="date" name="fecha">
                    <label for="fecha">Fecha de nacimiento</label>
                </div>
                <div class="alert">
                    <p>Ya tienes cuenta? <a href="../views/login.php">Inicia sesion aqui</a></p>
                </div>
                <div class="button-container">
                    <button type="submit">Registrarse</button>
                </div>
            </div>
        </form>
    </div>
    
      <!-- SCRIPTS -->
      <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
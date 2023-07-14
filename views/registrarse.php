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
<div class="wrapper">
        <div class="container main">
            <div class="row">
                <div class="col-md-6 image">
                    <div class="text">
                        <p class="logo fs-1 m-auto"><span>Sweet </span>Beauty</p>
                        <p>Maquillaje y peinados</p>
                    </div>
                </div>
                <div class="col-md-6 right">
        <form action="../scripts/ingresar_usuario.php" method="post">
        <header style="text-align: center;font-size: 25px;padding:35px">Registrarse</header>
            <div class="content">
                <div class="input-box">
                    <label for="nombre">Nombre completo</label>
                    <input type="text" class="input" name="nombre" required autocomplete="off">
                </div>
                <div class="input-box">
                    <label for="correo">Correo</label>
                    <input type="email" class="input" name="correo" required autocomplete="off">
                </div>
                <div class="input-box">
                    <label for="telefono">Telefono</label>
                    <input type="tel" class="input" name="telefono" required autocomplete="off">
                </div>
                <div class="input-box">
                    <label for="pass">Contraseña</label>
                    <input type="password" class="input" name="pass" required autocomplete="off">
                </div>
                <div class="input-box">
                    <label for="passconf">Confirmar contraseña</label>
                    <input type="password" class="input" name="passconf" required autocomplete="off">
                </div>
                <div>
                <span class="genero-titulo">Genero</span>
                    <div class="genero-categoria">
                        <input type="radio" name="genero" value="1">
                        <label for="genero">Masculino</label><br>
                        <input type="radio" name="genero" value="2">
                        <label for="genero">Femenino</label>
                    </div>
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
            </div>
        </div>
    </div>
    
      <!-- SCRIPTS -->
      <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
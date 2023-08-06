<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Inicio de sesion</title>
</head>
<body>
    <div class="wrapper">
        <div class="container main">
            <div class="row">
                <div class="col-md-6 side-image">
                    <div class="text">
                        <p class="logo fs-1 m-auto"><span>Sweet </span>Beauty</p>
                        <p>Maquillaje y peinados</p>
                    </div>
                </div>
                <div class="col-md-6 right">
                     <div class="input-box">
                        <header class="fs-3">Iniciar Sesión</header>
                        <form action="../scripts/verificar_login.php" method="post">
                        <div class="input-field">
                            <input type="text" class="input" name="usuario" required autocomplete="off">
                            <label for="usuario">Correo</label>
                        </div>
                        <div class="input-field">
                            <input type="password" class="input" name="contra" required>
                            <label for="contra">Contraseña</label>
                        </div>
                        <div class="input-field">
                            <input type="submit" class="submit" value="Iniciar sesión">      
                        </div>
                        </form>
                        <div class="registro">
                            <span>No tienes cuenta? <a href="../views/registrarse.php">registrate aqui</a></span>
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
    
      <!-- SCRIPTS -->
      <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
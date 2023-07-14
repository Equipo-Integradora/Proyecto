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
                        <div class="form-group">
                            <label for="nombre">Nombre completo</label>
                            <input type="text" class="form-control" name="nombre" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="correo">Correo</label>
                            <input type="email" class="form-control" name="correo" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="telefono">Telefono</label>
                            <input type="tel" class="form-control" name="telefono" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="pass">Contraseña</label>
                            <input type="password" class="form-control" name="pass" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="passconf">Confirmar contraseña</label>
                            <input type="password" class="form-control" name="passconf" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <span class="genero-titulo">Género</span>
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
                        <div class="form-group">
                            <input type="date" class="form-control" name="fecha">
                            <label for="fecha">Fecha de nacimiento</label>
                        </div>
                        <div class="alert">
                            <p>¿Ya tienes una cuenta? <a href="../views/login.php">Inicia sesión aquí</a></p>
                        </div>
                        <div class="button-container">
                            <button type="submit" class="btn btn-primary">Registrarse</button>
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>registro exitoso</title>
</head>
<body>
    <div class="container">
    <?php
include '../class/database.php';
$db = new database();
$db->conectarDB();

extract($_POST);
$ver = "SELECT usuarios.email_usuario
FROM usuarios
WHERE usuarios.email_usuario = '$correo'";
$corra = $db->seleccionar($ver);

echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
if (!empty($corra))
{?>
    <script>
    Swal.fire({
      icon: 'error',
      title: 'Error en el Registro',
      text: 'El correo electrónico ya está registrado.',
      showConfirmButton: false,
      timer: 3000
    });
    setTimeout(function() {
    window.location.href = "../views/registrarse.php";;
}, 3000);
    </script>
    <?php
}else
{
    $hash = password_hash($pass, PASSWORD_DEFAULT);        
    $query  = "INSERT INTO usuarios(nombre_usuario, contraseña_usuario, email_usuario, telefono_usuario, fecha_nacimiento_usuario, sexo_usuario) 
            VALUES ('$nombre', '$hash', '$correo', '$telefono', '$fecha', '$genero')";

    $resultado = $db->ejecuta($query);
    ?>
    <script>
    Swal.fire({
      icon: 'success',
      title: 'Usuario Registrado',
      showConfirmButton: false,
      timer: 2000
    });
    setTimeout(function() {
    window.location.href = "../views/login.php";
}, 2000);
    </script>
    <?php
}

$db->desconectarDB();
?>

    </div>
</body>
</html>
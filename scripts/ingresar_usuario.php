<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css"S>
</head>
<body>
    <div class="container">
        <?php
        include '../class/database.php';
        $db = new database();
        $db->conectarDB();

        extract($_POST);

        $hash = password_hash($pass, PASSWORD_DEFAULT);        
        $query  = "Insert Into usuarios(nombre_usuario, contraseña_usuario, email_usuario, telefono_usuario, fecha_nacimiento_usuario, sexo_usuario) 
        Values ('$nombre', '$hash', '$correo', '$telefono', '$fecha', '$genero')";

        $db->ejecuta($query);
        $db->desconectarDB();

        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>";
        echo "Swal.fire({";
        echo "  icon: 'success',";
        echo "  title: 'Usuario Registrado',";
        echo "  showConfirmButton: false,";
        echo "  timer: 2000";
        echo "});";
        echo "</script>";
        header("refresh:2 ; ../views/login.php")
        ?>
    </div>
    
</body>
</html>
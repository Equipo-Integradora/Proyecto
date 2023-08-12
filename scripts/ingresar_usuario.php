<?php
include '../class/database.php';
$db = new database();
$db->conectarDB();

extract($_POST);

$hash = password_hash($pass, PASSWORD_DEFAULT);        
$query  = "INSERT INTO usuarios(nombre_usuario, contraseña_usuario, email_usuario, telefono_usuario, fecha_nacimiento_usuario, sexo_usuario) 
            VALUES ('$nombre', '$hash', '$correo', '$telefono', '$fecha', '$genero')";

$resultado = $db->ejecuta($query);

if ($resultado === true) 
{
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>";
    echo "Swal.fire({";
    echo "  icon: 'success',";
    echo "  title: 'Usuario Registrado',";
    echo "  showConfirmButton: false,";
    echo "  timer: 2000";
    echo "});";
    echo "</script>";
    header("refresh:2 ; ../views/login.php");
} 
else 
{
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>";
    echo "Swal.fire({";
    echo "  icon: 'error',";
    echo "  title: 'Error en el Registro',";
    echo "  text: 'El correo electrónico ya está registrado.',";
    echo "  showConfirmButton: false,";
    echo "  timer: 3000";
    echo "});";
    echo "</script>";
    header("refresh:3 ; ../views/registrarse.php");
}

$db->desconectarDB();
?>

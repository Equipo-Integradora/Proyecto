<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
    </style>
</head>
<body>
    
<div class="container">
<?php
session_start();
include '../class/database.php';
$db = new Database();
$db->conectarDB();
$db->perfil();

$chec = "select *
from usuarios
WHERE id_usuario = '{$_SESSION["id"]}';";
$vamo = $db->seleccionar($chec);
extract($_POST);

        
        
        if(empty($email))
        {

        }
        else{

        
        if(isset($vamo->email_usuario)!=$email)
        {
        $con ="update usuarios 
        set
        email_usuario='$email'
        WHERE id_usuario = '{$_SESSION["id"]}';";
        $resultado = $db->ejecuta($con);

                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>";
                echo "Swal.fire({";
                echo "  icon: 'success',";
                echo "  title: 'Cambio realizado',";
                echo "  showConfirmButton: false,";
                echo "  timer: 2000";
                echo "});";
                echo "</script>";
                header("refresh:2, ../views/perfil2.php");
        }
        else{
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>";
                echo "Swal.fire({";
                echo "  icon: 'error',";
                echo "  title: 'Cambio NO realizado',";
                echo "  showConfirmButton: false,";
                echo "  timer: 2000";
                echo "});";
                echo "</script>";
                header("refresh:2, ../views/perfil2.php");
        }
    }
        if(empty($tel))
        {

        }
        else{
        if(isset($vamo->telefono_usuario)!=$tel)
        {
        $con ="update usuarios 
        set
        telefono_usuario='$tel'
        WHERE id_usuario = '{$_SESSION["id"]}';";
        $resultado = $db->ejecuta($con);

                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>";
                echo "Swal.fire({";
                echo "  icon: 'success',";
                echo "  title: 'Cambio realizado',";
                echo "  showConfirmButton: false,";
                echo "  timer: 2000";
                echo "});";
                echo "</script>";
                header("refresh:2, ../views/perfil2.php");
        }
        else{
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>";
                echo "Swal.fire({";
                echo "  icon: 'error',";
                echo "  title: 'Cambio NO realizado',";
                echo "  showConfirmButton: false,";
                echo "  timer: 2000";
                echo "});";
                echo "</script>";
                header("refresh:2, ../views/perfil2.php");
        }
    }
    

    if(empty($pass))
    {

    }
    else{
    if(isset($vamo['contraseña_usuario']) != $pass)
    {
        $usuario = isset($vamo['email_usuario']);
        
        $db->cambio($passn,$usuario, $pass);
        }
        else
        {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>";
                echo "Swal.fire({";
                echo "  icon: 'error',";
                echo "  title: 'Cambio NO realizado',";
                echo "  showConfirmButton: false,";
                echo "  timer: 2000";
                echo "});";
                echo "</script>";
                header("refresh:2, ../views/perfil2.php");
        }

    }
        $db->desconectarDB();

        ?>
    </div>

</body>
</html>
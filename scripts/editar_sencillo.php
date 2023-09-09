<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
        *
        {
                font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
</style>
<body>
<div class="container">
        <?php
        session_start();
        
        include '../class/database.php';
        $db = new Database();
        $db->conectarDB();
        $db->perfil();

        $chec="select *
        from usuarios
        WHERE id_usuario = '{$_SESSION["id"]}';";
        $vamo=$db->seleccionar($chec);
        extract($_POST);


        $con ="update usuarios 
        set
        nombre_usuario='$nombre'
        WHERE id_usuario = '{$_SESSION["id"]}';";
        $resultado = $db->ejecuta($con);

        $con ="update usuarios 
        set
        fecha_nacimiento_usuario='$fecha'
        WHERE id_usuario = '{$_SESSION["id"]}';";
        $resultado = $db->ejecuta($con);

        $con ="update usuarios 
        set
        sexo_usuario='$genero'
        WHERE id_usuario = '{$_SESSION["id"]}';";
        $resultado = $db->ejecuta($con);
        

        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>";
        echo "Swal.fire({";
        echo "  icon: 'success',";
        echo "  title: 'Cambio realizado.',";
        echo "  showConfirmButton: false,";
        echo "  timer: 3000";
        echo "});";
        echo "</script>";
                header("refresh:3, ../views/perfil2.php");
        ?>
</div>
</body>
</html>
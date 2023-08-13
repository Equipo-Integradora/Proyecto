<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
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
        

        echo "<div class='alert alert-succes'>";
                echo "<h2 align='center'> Cambio realizado</h2>";
                echo "</div>";    
                header("refresh:0, ../views/perfil2.php");
        ?>
</div>
</body>
</html>
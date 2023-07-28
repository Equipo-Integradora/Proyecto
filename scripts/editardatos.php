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
        
        include '../class/database.php';
        $db = new Database();
        $db->conectarDB();
        $db->perfil();

        $chec="select *
        from usuarios
        WHERE id_usuario = '{$_SESSION["id"]}';";
        $vamo=$db->seleccionar($chec);
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


        echo "<div class='alert alert-succes'>";
                echo "<h2 align='center'> Cambio realizado</h2>";
                echo "</div>";    
                header("refresh:2, ../views/perfil.php");
        }
        else{
            echo "<div class='alert alert-danger'>";
                echo "<h2 align='center'> Cambio NO realizado</h2>";
                echo "</div>";
                header("refresh:2, ../views/perfil.php");
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


        echo "<div class='alert alert-succes'>";
                echo "<h2 align='center'> Cambio realizado</h2>";
                echo "</div>";    
                header("refresh:2, ../views/perfil.php");
        }
        else{
            echo "<div class='alert alert-danger'>";
                echo "<h2 align='center'> Cambio NO realizado</h2>";
                echo "</div>";
                header("refresh:2, ../views/perfil.php");
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
        else{
            echo "<div class='alert alert-danger'>";
                echo "<h2 align='center'> Cambio NOoooooooooo realizado</h2>";
                echo "</div>";
        }

    }







        $db->desconectarDB();

        ?>
    </div>

</body>
</html>
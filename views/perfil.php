<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    session_start();
    if(isset($_SESSION["usuario"]))
    {
        ?>
    <h2>Aqui veremos el perfil</h2>
    <?php
    
    }
    else
    {
        header("Location: ../views/login.php");
    }
    ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Document</title>
</head>
<body>
<?php
    session_start();
include '../class/database.php';
$db = new database();
$db->conectarDB();
include "../templates/header.php";
    
    if(isset($_SESSION["usuario"]))
    {
        ?>
<div class="container" style="margin-top: 100px ; width: 100%;">
        <h2>Aqui el usuario verá sus ordenes</h2>

        





        
    
    
    
    <?php
    
    }
    else
    {

        header("Location: ../views/login.php");
    }

    ?>
  </div>  
    <?php
//include "../templates/footer.php";
?>
</body>

</html>

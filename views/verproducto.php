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
    include "../templates/header.php";
    include "../class/database.php";

    $conexion = new database();
    $conexion->conectarDB();
    ?>


    <h2>Aquí saldra el producto que seleccionaste</h2>
   
   
</body>
</html>
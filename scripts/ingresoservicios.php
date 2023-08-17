<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso exitoso</title>
</head>
<body>
<?php
include "../class/database.php";
$urss = new database();
extract($_POST);
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    
    // Realizar el procesamiento de datos aquí y devolver una respuesta
    $respuesta = array("nombre" => $nombre, "email" => $email);
    
    header("Content-Type: application/json");
    echo json_encode($respuesta);
  }
?>
</body>
</html>
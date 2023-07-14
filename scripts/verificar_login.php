<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

    <div class="container">
        <?php
        
        include '../class/database.php';
        $db = new Database();
        $db->conectarDB();

        extract($_POST);

        $db->verifica($usuario, $contra);
        $db->desconectarDB();

        ?>
    </div>
    
</body>
</html>
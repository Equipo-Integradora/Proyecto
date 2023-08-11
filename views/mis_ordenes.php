<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="stylesheet" href="../css/login.css">-->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/pruebatexto.css">
    <title>Document</title>
</head>
<body style="background-color:#f5f5f5">
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
<?php 

$citas = "SELECT *
FROM mis_ordenes
WHERE id_usuario= '{$_SESSION["id"]}'";
$tablac = $db->seleccionar($citas); ?>
        <div class="container" >
        <div class="row" >
            
        </div>

        
    <?php
        
        foreach($tablac as $reg){
            
            $imagenes = explode('| ', $reg->imagen_detalle_producto);
            ?>
            <div class="row" style="background-color: white; margin-top:30px; width:800px; height:200px">
            <div class="row">
            <div class="col-3" style="margin-top: 15px;"><p><b>Entrega <?php echo $reg->estado_orden_venta ?></b></p></div>
            
            <div class="col-5">
                <div style="font-size: 12px; text-align:right; margin-top: 10px;">
                    <div class="col-12">
                        <p style="margin: 0;">Pedido efectuado el <?php echo $reg->fecha_creacion_orden_venta ?></p>

                    <p style="margin: 0;">No. de pedido: #<?php echo $reg->id_venta ?> <a href="">Copiar</a></p>
                </div>
                </div>

            </div>
            
            <div class="col-4" style=" text-align:right;margin-top: 15px;">
            
                <a href="" style="text-decoration: none; color:black; "><p><b>Detalles del pedido > </b></p></a>
            </div>
            </div>
            <hr style="margin: 0;">
            <div class="nav-container" style="height: 129px;" >
        <button class="btn prev-button"><i class="bi bi-caret-left"></i></button>
            <?php  
            for($i=0;$i<count($imagenes);$i++){
              ?>

        <div class="nav-items-container">
          <ul class="nav-items">
          <li class="nav-item" style="height: 200px;">
          <div class="col-4" style="width: 70px; height: 90px; position: relative; margin-right:30px;">

              <?php
                echo "<div class='col-12'><img style='height:80px; width:80px;' src='../img/productos/" . $imagenes[$i] . "'></div>";
                ?>
          </div>
                </li>
      </ul>
              </div>
              
                  <?php 
            }
            
            ?>
            <button class="btn next-button"><i class="bi bi-caret-right"></i></button>
            </div>
          
                </div>
    <?php
        }
    ?>
    </div>
    




        
    
    
    
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

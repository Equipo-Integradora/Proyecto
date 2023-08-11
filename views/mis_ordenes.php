<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/pruebatexto.css">
    <title>Document</title>
</head>
<body style="background-color:#f5f5f5">
<?php
    session_start();
    include "../templates/misordenes_sidebar.php";
    
    if(isset($_SESSION["usuario"])) {
        ?>
        <div class="container" style=" width: 100%;">
            <?php 
            $citas = "SELECT *
                      FROM mis_ordenes
                      WHERE id_usuario= '{$_SESSION["id"]}'";
            $tablac = $conexion->seleccionar($citas);
            ?>
            <div class="container">
                <div class="row">
                    <!-- Loop through orders -->
                    <?php
                    foreach($tablac as $reg) {
                        $imagenes = explode('| ', $reg->imagen_detalle_producto);
                    ?>
                    <div class="col-lg-12 col-12" style="background-color: white; margin-top:30px; width:800px; height:200px">
                        <div class="row">
                            <!-- Order Details -->
                            <div class="col-3" style="margin-top: 15px;">
                                <p><b>Entrega <?php echo $reg->estado_orden_venta ?></b></p>
                            </div>
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
                        <!-- Image Carousel -->
                        <div class="nav-container" style="height: 129px;">
                            <button class="btn prev-button"><i class="bi bi-caret-left"></i></button>
                            <div class="nav-items-container">
                                <ul class="nav-items">
                                    <?php
                                    $tot = 0;
                                    for($i=0; $i<count($imagenes); $i++){
                                        ?>
                                        <li class="nav-item" style="height: 200px;">
                                            <div class="col-4" style="width: 70px; height: 90px; position: relative; margin-right:30px;">
                                                <img style='height:80px; width:80px;' src='../img/productos/<?php echo $imagenes[$i] ?>' alt="no">
                                            </div>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            <button class="btn next-button"><i class="bi bi-caret-right"></i></button>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    } else {
        header("Location: ../views/login.php");
    }
?>
<!-- Rest of your scripts and closing body/html tags -->
<script
  src="https://code.jquery.com/jquery-3.7.0.js"
  integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
  crossorigin="anonymous"></script>
    <script src="../js/clock.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
</body>
</html>

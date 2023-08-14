<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/pruebatexto.css">
    <link rel="icon" href="../img/home/logo.png" type="logo/png">
    <link rel="stylesheet" href="../css/home.css">
    <title>Sweet Beauty</title>
</head>
<body style="background-color:#f5f5f5">
<?php
    session_start();
    include "../templates/misordenes_sidebar.php";
    
    if(isset($_SESSION["usuario"])) {
        ?>
        <div class="container" style=" width: 100%;">
            <?php 
                extract($_POST);
                
            $citas = "SELECT *
                      FROM mis_ordenes
                      WHERE id_usuario= '{$_SESSION["id"]}' and estado_orden_venta='Cancelado'
                      order by fecha_creacion_orden_venta desc;";
            $tablac = $conexion->seleccionar($citas);
            ?>
             <div class="container" style="margin-top: 20px;">
                <div class="row">
                <?php	
                    if(count($tablac)===0){
                        ?>
                        <div class="container text-center">
                        <div class="row">
                        <div class="col-lg-12 col-12" style="background-color: white; margin-top:30px; width:800px; height:400px">
                        <div class="col-12 align-self-center" style="margin-top: 50px;">
                            <img style="width: 250px; height:250px" src="../img/carrito/orden.png" alt="">
                        </div>
                        <div class="col-12">
                            <p>Se encuentra vacío :c </p>
                        </div>
                        </div>
                        </div>
                        <?php
                    }else{
                     
                    ?>
                    <div class="col-12" style="background-color: white; width:800px; height:60px">
                    <div class="col-5 " style="margin-top: 9px; ">
                <form action="../scripts/buscar_orcan.php" method="post">
                  <input style="width: 290px;" placeholder="No. de orden o  Artículo..." type="search" class="input" name="buscar">
                </form>
                
              </div>
                    </div>
                    <?php
                    foreach($tablac as $reg) {
                        $imagenes = explode('| ', $reg->imagen_detalle_producto);
                        $nombre= explode('| ', $reg->productos);
                        $color= explode(', ', $reg->color);
                        $precios=explode('| ',$reg->Precios);
                        $cantidad=explode(', ', $reg->cantidades);
                        $ids=explode('| ',$reg->id_productos);
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
                                        <p style="margin: 0;">No. de pedido: #<?php echo $reg->id_venta ?>
                                        <a href="" onclick="copyTextToClipboard('<?php echo $reg->id_venta ?>')">Copiar</a>
                                    </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4" style=" text-align:right;margin-top: 15px;">
                            <a data-bs-toggle="modal" data-bs-target="#deta<?php echo $reg->id_venta?>" href="#" style="text-decoration: none; color:black; "><p><b>Detalles del pedido > </b></p></a>
                            </div>
                        </div>
                        <hr style="margin: 0;">
                        <!-- Image Carousel -->
                        <div class="nav-container" style="height: 129px;">
                            <div class="nav-items-container" style="padding-left: 20px; padding-right:20px;">
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
                        </div>
                    </div>
                    <div class="modal fade" id="deta<?php echo $reg->id_venta?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Orden #<?php echo $reg->id_venta ?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <?php
          for($i=0; $i<count($imagenes); $i++){
       ?>
       <div class="row" style="margin-bottom: 15px; height:90px">
        <div class="col-3" style="margin-top:5px;" >
        <a href="../views/verproducto.php?id=<?php echo $ids[$i] ?>"><img style=' height:80px; width:80px;' src='../img/productos/<?php echo $imagenes[$i] ?>' alt="no"></a>
        </div>
        <div class="col-9"  >
            <div class="col-12 mb-0">
                <p class="mb-0" style="overflow: hidden; white-space: nowrap;text-overflow: ellipsis; font-size: 15px;"><?php echo $nombre[$i] ?></p>
            </div>
            <?php 
            if($color[$i]!='Sin Color' and $color[$i]!= 'Multicolor'){

            
            ?>
            <div class="col-12 mb-0">
                <p class="mb-0" style="font-size: 15px; color:gray">Color: <?php echo $color[$i] ?></p>
            </div>
            <?php
            }
            ?>
            <div class="col-5 mb-0">
                <p class="mb-0" style="font-size: 15px;">Mx $<?php echo $precios[$i] ?></p>
            </div>
            <div class="col-5 mb-0">
                <p class="mb-0" style="font-size: 15px; color:gray">x<?php echo $cantidad[$i] ?></p>
            </div>
        </div>
        </div>
        <?php }
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
      </div>
    </div>
  </div>
</div>
                    <?php
                    }
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
        function copyTextToClipboard(text) {
  var textarea = document.createElement("textarea");
  textarea.value = text;
  document.body.appendChild(textarea);
  textarea.select();
  document.execCommand("copy");
  document.body.removeChild(textarea);  
  event.preventDefault(); // Evitar recarga de la página

}

    </script>
    <script>
        
        function cambiarTituloPestana(nuevoTitulo) {
          document.title = nuevoTitulo;
        }


        window.addEventListener("focus", function() {
          cambiarTituloPestana("Sweet Beauty");
        });


        window.addEventListener("blur", function() {
          cambiarTituloPestana("Aún puedes hacer más cosas");
        });
    </script>
</body>
</html>

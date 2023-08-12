<?php
session_start();
$citas = false;
$ordenes = false;
$perfil = false;
include "../templates/header.php";
include "../class/database.php";

    $conexion = new database();
    $conexion->conectarDB();
    
    $consulta = "SELECT productos.nombre_producto, productos.precio_producto, detalle_productos.imagen_detalle_producto, detalle_productos.id_detalle_producto
    FROM orden_venta INNER JOIN detalle_orden_venta ON orden_venta.id_venta = detalle_orden_venta.orden_venta_detalle_orden_FK
    INNER JOIN detalle_productos ON detalle_productos.id_detalle_producto = detalle_orden_venta.producto_orden_venta_FK
    INNER JOIN productos ON detalle_productos.detalle_producto_detalle_producto_FK = productos.id_producto
    GROUP BY productos.nombre_producto, productos.precio_producto
    ORDER BY detalle_orden_venta.cantidad_producto_orden_venta DESC
    LIMIT 3;";

    $tabla = $conexion->seleccionar($consulta);
?>
      <!-- BANNER -->
      <section class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-auto">
                    <h3>Sweet Beauty</h3>
                    <span>Maquillaje & servicios</span>
                    <p>Sweet Beauty es un local de venta de productos y realización de servicios de belleza, que busca realzar la belleza natural de sus clientes. Ofrece una amplia gama de productos de calidad y citas para tratamientos de cuidado personal, todo con un enfoque en la satisfacción del cliente y la seguridad. ¡Encuentra tu belleza dulce con Sweet Beauty!</p>
                    <a href="../views/Agendar_cita.php" class="boton btn-sm">Agendar cita</a>
                </div>
            </div>
        </div>
      </section>
      <!-- FIN DE BANNER -->

      <!-- PORTAFOLIO -->
      <section class="portafolio section-padding">
        <h1 class="heading m-5"><span> Mi </span> portafolio </h1>
        <div class="container">
            <div class="row">
                <!-- CAROUSEL -->
                <div id="carouselExampleAutoplaying" class="carousel slide col-lg-6" data-bs-ride="carousel">
                    <div class="carousel-inner imagenes">
                      <div class="carousel-item active">
                        <img src="../img/home/portafolio/5.jpg" class="d-block img-fluid" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="../img/home/portafolio/2.jpg" class="d-block img-fluid" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="../img/home/portafolio/3.jpg" class="d-block img-fluid" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="../img/home/portafolio/4.jpg" class="d-block img-fluid" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="../img/home/portafolio/1.jpg" class="d-block img-fluid" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="../img/home/portafolio/6.jpg" class="d-block img-fluid" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="../img/home/portafolio/7.jpg" class="d-block img-fluid" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="../img/home/portafolio/8.jpg" class="d-block img-fluid" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="../img/home/portafolio/9.jpg" class="d-block img-fluid" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="../img/home/portafolio/10.jpg" class="d-block img-fluid" alt="...">
                      </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
                <!-- FIN DEL CAROUSEL -->
                <div class="content col-lg-6">
                    <h3>Algunos de mis trabajos</h3>
                    <p>Como esteticista profesional, mi objetivo es realzar la belleza única de cada cliente, brindando soluciones personalizadas y resultados excepcionales. A lo largo de mi carrera, he trabajado con personas de todas las edades y con diversas necesidades, lo que me ha permitido desarrollar un enfoque versátil y adaptable a cada situación.
                      Mi formación constante y mi compromiso con las últimas tendencias en estética me han permitido dominar técnicas innovadoras y utilizar productos de la más alta calidad. La satisfacción de mis clientes es mi máxima prioridad, y siempre me esfuerzo por superar sus expectativas, proporcionando una experiencia relajante y enriquecedora.</p>
                </div>
               </div>
            </div>
        </div>
      </section>
      <!-- FIN DE PORTAFOLIO -->

      <!-- PRODUCTOS -->
    <section class="products section-padding">
        <h1 class="heading m-5">Lo más <span>Vendido </span></h1>
        <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">
              <!-- INICIO ITEM-->
              <?php
              foreach ($tabla as $reg) 
              { ?>

              <!-- INICIO ITEM-->
              
            <div class="col">
              <div class="card h-100">
                <div   style=" display: flex; align-content:center; align-items: center; padding-right:15%; padding-left: 15%">
                <a style="margin: auto;" href="../views/verproducto.php?id=<?php echo $reg->id_detalle_producto ?>" id="<?php echo $reg->id_detalle_producto ?> "><img class="card-img-top pro" src="../img/productos/<?php echo $reg->imagen_detalle_producto; ?>" alt="..."></a>
                </div>
                        <div class="card-body text-center">
                          <div class="icons card-title">
                          </div>
                          <div class="card-text">
                          <a href="../views/verproducto.php?id=<?php echo $reg->id_detalle_producto ?>">
                            <?php
                            $max_caracteres = 20;
                            $nombre_producto = $reg->nombre_producto;

                            
                             if (strlen($nombre_producto) > $max_caracteres) {
                                 echo substr($nombre_producto, 0, $max_caracteres) . '...';
                             } else {
                                 echo $nombre_producto;
                            }
                           ?>    
                          </a>
                            <div class="price">
                            <?php echo'$'.$reg->precio_producto; ?>
                          </div>
                          </div>
                        </div>
                  </div>
            </div>
                  <!-- END ITEM -->
                <?php
              }
                  $conexion->desconectarDB();
                  ?>

            </div>
        </div>
    </div>
        </section>
      <!-- FIN DE PRODUCTOS -->
   

      <!-- FOOTER -->
<?php
include "../templates/footer.php"
?>
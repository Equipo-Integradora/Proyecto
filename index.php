<?php
session_start();
$citas = false;
$ordenes = false;
$perfil = false;
include "class/database.php";

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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/home/logo.png" type="logo/png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/home.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/productos_gene.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@5.10.0/main.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@5.10.0/main.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@5.10.0/main.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          locale:'es',
          initialView: 'dayGridMonth',

        });
        calendar.render();
      });

    </script>

<!--Cantidad de productos agregados al carrito-->
<?php 
if(isset($_SESSION['carrito'])){
  $carrito_mio=$_SESSION['carrito'];
}
if(isset ($_SESSION ['carrito'])){

  for($i=0;$i<=count ($carrito_mio)-1; $i++){
    if(isset ($carrito_mio[$i])){
      if($carrito_mio[$i]!=null){
        if(!isset ($carrito_mio['cantidad'])){
          $carrito_mio['cantidad']=0;
        }else{
          $carrito_mio['cantidad']= $carrito_mio['cantidad'];          ;
        }
        $total_cantidad=$carrito_mio['cantidad'];
        $total_cantidad ++;
        if(!isset($totalcantidad))
        {
          $totalcantidad='0';
        }else{
          $totalcantidad=$totalcantidad;
        }
        $totalcantidad+=$total_cantidad;
      }
    }
  }
}
if(!isset($totalcantidad)){
  $totalcantidad='';
}else{
  $totalcantidad=$totalcantidad;
}
?>
    <title>Sweet Beauty</title>
</head>
<body>
    <!-- INICIO DE LA BARRA DE NAVEGACION -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
        <!-- LOGO -->
        <!-- DURAAAANNNNNNNNNNNNNn -->
        <a class="navbar-brand logo fs-2 " href="index.php">
          <img src="img/home/logo.png" class="logooo">
          <span>Sweet </span>Beauty
        </a>
        <!-- Toggle btn-->
          <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <!-- Barra lateral -->
          <div class="offcanvas offcanvas-start border-bottom" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <!-- Barra lateral header -->
            <div class="offcanvas-header">
              <h5 class="offcanvas-title logo" id="offcanvasNavbarLabel"><span>Sweet </span>Beauty</h5>
              <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <!-- Barra lateral body -->
            <div class="offcanvas-body d-flex flex-column flex-lg-row">
              <ul class="navbar-nav justify-content-center flex-grow-0 pe-3 align-items-center fa-bars">
                <li class="nav-item mx-2">
                  <a class="nav-link" href="index.php">Inicio</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="views/Agendar_cita.php">Agendar cita</a>
                  </li>
                  <li class="nav-item mx-2">
                    <a class="nav-link" href="views/ver_producto_general.php">Productos</a>
                  </li>
              </ul>
              <!-- BARRA DE BUSQUEDA -->
              <div class="group d-flex justify-content-center align-items-center mx-auto">
                <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><g><path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path></g></svg>
                <form action="scripts/buscar_producto.php" method="post">
                  <input placeholder="Buscar..." type="search" class="input" name="buscar">
                </form>
                
              </div>
              <!-- BOTONES DE CARRITO E INICIO DE SESION/REGISTRO -->
              
              <div class="d-flex justify-content-center align-items-center gap-lg-1 icons">
                
              <a href="views/carrito2.php" class="bi bi-bag-heart-fill icono1 position-relative">
              <?php
              if(isset($_SESSION['carrito']))
              {
                if($_SESSION['carrito'] >= 1)
                {
                ?>
              <span style="font-size: 15px; background-color: #e84393;" class="position-absolute top-0 start-100 translate-middle badge rounded-circle">
              <span class="count">
                  <?php
                    echo count($_SESSION['carrito']);
                  ?>
                
                </span>
                <span class="visually-hidden">unread messages</span>
              </span>
              <?php
                }
            }
              ?>
                </a>
              
                


                    <div class="dropdown">
                        <a class="bi bi-person-fill icono2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg-end">
                          <?php
                             if(!isset($_SESSION["usuario"]))
                             {
                          ?>
                          <li><a class="dropdown-item fs-6" href="views/login.php">Iniciar sesión</a></li>
                          <li><a class="dropdown-item fs-6 " href="views/registrarse.php">Registrarse</a></li>
                          <?php
                            }
                          ?>
                          <li><?php
                                 if(isset($_SESSION["usuario"]))
                                 {
                                  if(!$perfil)
                                  {
                                    echo "<a class='dropdown-item fs-6' href='views/perfil2.php'><i class='fas fa-user me-2'></i>Mi perfil</a>";
                                  }else
                                  {
                                  }
                                 }
                              ?>
                        </li>
                        <li>
                            <?php
                            if(isset($_SESSION["admin"]))
                            {
                                  echo "<a class='dropdown-item fs-6 ' href='views/admin.php'><i class='fa fa-gear me-2'></i>Administrar</a>";
                            }
                                
                            ?>
                      </li>
                        <li>
                            <?php
                            if(!isset($_SESSION["admin"]))
                            {
                                if(isset($_SESSION["usuario"]))
                                {
                                  if(!$citas)
                                  {
                                    echo "<a class='dropdown-item fs-6 ' href='views/mis_citas.php'><i class='fas fa-user-xmark me-2'></i>Mis citas</a>";
                                  }
                                }
                            }
                              ?>
                      </li>
                        <li>
                            <?php
                            if(!isset($_SESSION["admin"]))
                            {
                                if(isset($_SESSION["usuario"]))
                                {
                                  if(!$ordenes)
                                  {
                                    echo "<a class='dropdown-item fs-6 ' href='views/mis_ordenes.php'><i class='fas fa-user-xmark me-2'></i>Mis ordenes </a>";
                                  }
                                }
                            }
                              ?>
                      </li>
                        <li>
                            <?php
                                if(isset($_SESSION["usuario"]))
                                {
                                    echo "<a class='dropdown-item fs-6 ' href='scripts/cerrar_sesion.php'><i class='fas fa-user-xmark me-2'></i>Cerrar sesion</a>";
                                }
                              ?>
                      </li>
                                           
                        </ul>
                      </div>
              </div>
            </div>
          </div>
        </div>
      </nav>
      <!-- FIN DE LA BARRA DE NAVEGACION -->

      <!-- BANNER -->
      <section class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-auto">
                    <h3>Sweet Beauty</h3>
                    <span>Maquillaje & servicios</span>
                    <p>Sweet Beauty es un local de venta de productos y realización de servicios de belleza, que busca realzar la belleza natural de sus clientes. Ofrece una amplia gama de productos de calidad y citas para tratamientos de cuidado personal, todo con un enfoque en la satisfacción del cliente y la seguridad. ¡Encuentra tu belleza dulce con Sweet Beauty!</p>
                    <a href="views/Agendar_cita.php" class="boton btn-sm">Agendar cita</a>
                </div>
            </div>
        </div>
      </section>
      <!-- FIN DE BANNER -->

      <!--Ubicación-->
      <section class="portafolio section-padding">
        <h1 class="heading m-5"><span> Encuentranos </span> en... <span><i class="bi bi-geo-alt-fill"></i></span></h1>
        <div class="container">
            <div class="row">
                <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3598.0597182579218!2d-103.37461222460487!3d25.60293177745201!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMjXCsDM2JzEwLjYiTiAxMDPCsDIyJzE5LjMiVw!5e0!3m2!1ses-419!2smx!4v1692073736768!5m2!1ses-419!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
      </section>
      <!--Fin de ubicación-->

      <!-- PORTAFOLIO -->
      <section class="portafolio section-padding">
        <h1 class="heading m-5"><span> Mi </span> portafolio </h1>
        <div class="container">
            <div class="row">
                <!-- CAROUSEL -->
                <div id="carouselExampleAutoplaying" class="carousel slide col-lg-6" data-bs-ride="carousel">
                    <div class="carousel-inner imagenes">
                      <div class="carousel-item active">
                        <img src="img/home/portafolio/5.jpg" class="d-block img-fluid" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="img/home/portafolio/2.jpg" class="d-block img-fluid" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="img/home/portafolio/3.jpg" class="d-block img-fluid" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="img/home/portafolio/4.jpg" class="d-block img-fluid" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="img/home/portafolio/1.jpg" class="d-block img-fluid" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="img/home/portafolio/6.jpg" class="d-block img-fluid" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="img/home/portafolio/7.jpg" class="d-block img-fluid" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="img/home/portafolio/8.jpg" class="d-block img-fluid" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="img/home/portafolio/9.jpg" class="d-block img-fluid" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="img/home/portafolio/10.jpg" class="d-block img-fluid" alt="...">
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
                <a style="margin: auto;" href="views/verproducto.php?id=<?php echo $reg->id_detalle_producto ?>" id="<?php echo $reg->id_detalle_producto ?> "><img class="card-img-top pro" src="img/productos/<?php echo $reg->imagen_detalle_producto; ?>" alt="..."></a>
                </div>
                        <div class="card-body text-center">
                          <div class="icons card-title">
                          </div>
                          <div class="card-text">
                          <a href="views/verproducto.php?id=<?php echo $reg->id_detalle_producto ?>">
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

      <!-- FOOTER -->
      <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-3 mx-auto">
                    <div class="single-box">
                        <h2>Acceso rápido</h2>
                    <ul>
                        <li><a href="#">Inicio</a></li>
                        <li><a href="views/Agendar_cita.php">Agendar cita</a></li>
                        <li><a href="views/ver_producto_general.php">Productos</a></li>
                    </ul>
                    </div>                    
                </div>
                <div class="col-lg-3 col-sm-3 mx-auto">
                    <div class="single-box">
                        <h2>Extra links</h2>
                    <ul>
                        <li><a href="views/perfil2.php">Mi cuenta</a></li>
                        <li><a href="views/mis_ordenes.php">Mis ordenes</a></li>
                        <li><a href="views/mis_citas.php">Mis citas</a></li>
                    </ul>
                    </div>                    
                </div>
                <div class="col-lg-3 col-sm-3 mx-auto">
                    <div class="single-box">
                        <h2>Información de contacto</h2>
                        <ul>
                        <li><a href="https://www.facebook.com/Dulcsalon?mibextid=ZbWKwL" target="_blank">Facebook <i class="bi bi-facebook"></i></a></li>
                        <li><a href="mailto:sweetbeautyutt@gmail.com" target="_blank">SweetBeautyUtt@gmail.com <i class="bi bi-envelope-heart"></i></a></li>
                        <li><a href="https://www.google.com/maps?q=25.602931834354884,-103.37203726085112" target="_blank">Ubicacion <i class="bi bi-geo-alt"></i></a></li>
                    </ul>
                        <p></p>
                        <a href=""></a>
                        <p> </a>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="credit text-center">Creado por <span>Carlos, José, Erick, Lizeth, Fernando</span> | all rigth reserve.</div>
        <div style="font-size: 9px;" class="m-1 text-center"><i class="bi bi-c-circle"></i>2023-2023, SweetBeauty.com, Inc. o sus afiliados.</div>
    </footer>
      <!-- FIN DE FOOTER -->

      <!-- SCRIPTS -->
<script src="js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }
})
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/listas.js"></script>
    <script>
    const enlaces = document.querySelectorAll(".tcategoria");

    enlaces.forEach(enlace => {
        enlace.addEventListener("click", function(event) {
            event.preventDefault();
            const valor = this.innerText;
            const form = document.createElement("form");
            form.action = "scripts/verproductos_cat.php";
            form.method = "post";

            const input = document.createElement("input");
            input.type = "hidden";
            input.name = "tip_cater";
            input.value = valor;
            form.appendChild(input);

            document.body.appendChild(form);
            form.submit();
        });
    });
</script>
</body>
</html>
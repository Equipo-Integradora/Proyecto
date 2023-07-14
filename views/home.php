<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/home2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css" integrity="sha512-OTcub78R3msOCtY3Tc6FzeDJ8N9qvQn1Ph49ou13xgA9VsH9+LRxoFU6EqLhW4+PKRfU+/HReXmSZXHEkpYoOA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Sweet </title>
</head>
<body>
    <?php
    session_start();
    ?>
    <!-- INICIO DE LA BARRA DE NAVEGACION -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
        <!-- LOGO -->
        <!-- carlos -->
          <a class="navbar-brand logo fs-2" href="#"><span>Sweet </span>Beauty</a>
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
                  <a class="nav-link" href="#">Inicio</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="#">Agendar cita</a>
                  </li>
                  <li class="nav-item mx-2">
                    <a class="nav-link" href="../scripts/verproductos.php">Productos</a>
                  </li>
              </ul>
              <!-- BARRA DE BUSQUEDA -->
              <div class="group d-flex justify-content-center align-items-center mx-auto">
                <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><g><path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path></g></svg>
                <form action="../scripts/buscar_producto.php" method="post">
                  <input placeholder="Buscar..." type="search" class="input" name="buscar">
                </form>
                
              </div>
              <!-- BOTONES DE CARRITO E INICIO DE SESION/REGISTRO -->
              <div class="d-flex justify-content-center align-items-center gap-lg-1 icons">
                <a href="#" class="bi bi-bag-heart-fill icono1"><a>
                    <div class="dropdown">
                        <a class="bi bi-person-fill icono2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg-end">
                          <?php
                             if(!isset($_SESSION["usuario"]))
                             {
                          ?>
                          <li><a class="dropdown-item fs-6" href="../views/login.php">Iniciar sesion</a></li>
                          <li><a class="dropdown-item fs-6 " href="../views/registrarse.php">Registrarse</a></li>
                          <?php
                            }
                          ?>
                          <li><?php
                                 if(isset($_SESSION["usuario"]))
                                 {
                                     echo "<a class='dropdown-item fs-6' href='#'>".$_SESSION["usuario"]."</a>";
                                 }
                              ?>
                        </li>
                        <li>
                            <?php
                                if(isset($_SESSION["usuario"]))
                                {
                                    echo "<a class='dropdown-item fs-6 ' href='../scripts/cerrar_sesion.php'>[Cerrar Sesión]</a>";
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
                    <span>Maquillaje & peinados</span>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum sapiente hic provident quae minima fuga libero ut et aliquid reprehenderit. Ex adipisci fuga architecto minus nemo repellendus soluta amet molestiae.</p>
                    <a href="#" class="boton btn-sm">Agendar cita</a>
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
                        <img src="../img/home/ej10.jpg" class="d-block img-fluid" alt="...">
                        <h3>Ejemplos</h3>
                      </div>
                      <div class="carousel-item">
                        <img src="../img/home/ej3.jpg" class="d-block img-fluid" alt="...">
                        <h3>Ejemplos</h3>
                      </div>
                      <div class="carousel-item">
                        <img src="../img/home/ej2.jpg" class="d-block img-fluid" alt="...">
                        <h3>Ejemplos</h3>
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
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos, maxime! Voluptate voluptatem sequi dolor modi nulla, quia accusantium iure est quo nemo dignissimos laudantium aspernatur repudiandae rerum minus ea atque.</p>
                    <a href="#" class="boton link">Ver más</a>
                </div>
               </div>
            </div>
        </div>
      </section>
      <!-- FIN DE PORTAFOLIO -->

      <!-- PRODUCTOS -->
    <section class="products section-padding">
        <h1 class="heading m-5"><span>Últimos </span>Productos</h1>
        <div class="container">
          <div class="owl-carousel owl-theme">
            <!-- CARDS DE LOS PRODUCTOS -->

            <div class="item">
              <div class="card">
                <span class="aviso">-10%</span>
                  <img src="../img/home/m1.jpg" class="card-img-top" alt="...">
                  <div class="card-body text-center">
                    <div class="icons card-title">
                      <a href="#" class="bi bi-suit-heart-fill"></a>
                      <a href="#" class="bi bi-bag-heart-fill"> Agregar al carrito</a>
                      <a href="#" class="bi bi-share"></a>
                    </div>
                    <div class="card-text">
                      <h3>Paleta de Sombras Cooky BT21</h3>
                      <div class="price">
                          $369.00 <span>$410.00</span>
                    </div>
                    </div>
                  </div>
            </div>
          </div>
          <!-- END ITEM -->

          <div class="item">
            <div class="card">
                <img src="../img/home/es1.jpg" class="card-img-top" alt="...">
                <div class="card-body text-center">
                  <div class="icons card-title">
                    <a href="#" class="bi bi-suit-heart-fill"></a>
                    <a href="#" class="bi bi-bag-heart-fill"> Agregar al carrito</a>
                    <a href="#" class="bi bi-share"></a>
                  </div>
                  <div class="card-text">
                    <h3>Esmalte H&M rosa</h3>
                    <div class="price">
                      $45.00
                  </div>
                  </div>
                </div>
          </div>
        </div>
        <!-- END ITEM -->

        <div class="item">
          <div class="card">
              <img src="../img/home/es2.jpg" class="card-img-top" alt="...">
              <div class="card-body text-center">
                <div class="icons card-title">
                  <a href="#" class="bi bi-suit-heart-fill"></a>
                  <a href="#" class="bi bi-bag-heart-fill"> Agregar al carrito</a>
                  <a href="#" class="bi bi-share"></a>
                </div>
                <div class="card-text">
                  <h3>Esmalte H&M Morado</h3>
                  <div class="price">
                    $45.00
                </div>
                </div>
              </div>
        </div>
      </div>
      <!-- END ITEM -->

      <div class="item">
        <div class="card">
            <img src="../img/home/es3.jpg" class="card-img-top" alt="...">
            <div class="card-body text-center">
              <div class="icons card-title">
                <a href="#" class="bi bi-suit-heart-fill"></a>
                <a href="#" class="bi bi-bag-heart-fill"> Agregar al carrito</a>
                <a href="#" class="bi bi-share"></a>
              </div>
              <div class="card-text">
                <h3>Esmalte H&M naranja</h3>
                <div class="price">
                  $45.00
              </div>
              </div>
            </div>
      </div>
    </div>
    <!-- END ITEM -->

    <div class="item">
      <div class="card">
        <span class="aviso">-10%</span>
          <img src="../img/home/es4.jpg" class="card-img-top" alt="...">
          <div class="card-body text-center">
            <div class="icons card-title">
              <a href="#" class="bi bi-suit-heart-fill"></a>
              <a href="#" class="bi bi-bag-heart-fill"> Agregar al carrito</a>
              <a href="#" class="bi bi-share"></a>
            </div>
            <div class="card-text">
              <h3>Esmalte H&M rosa palido</h3>
              <div class="price">
                $40.50 <span>$45.00</span>
            </div>
            </div>
          </div>
    </div>
  </div>
  <!-- END ITEM -->

  <div class="item">
    <div class="card">
        <img src="../img/home/es5.jpg" class="card-img-top" alt="...">
        <div class="card-body text-center">
          <div class="icons card-title">
            <a href="#" class="bi bi-suit-heart-fill"></a>
            <a href="#" class="bi bi-bag-heart-fill"> Agregar al carrito</a>
            <a href="#" class="bi bi-share"></a>
          </div>
          <div class="card-text">
            <h3>Esmalte H&M dorado</h3>
            <div class="price">
              $45.00
          </div>
          </div>
        </div>
  </div>
</div>
          <!-- END ITEM -->
      <!-- FIN CARDS DE LOS PRODUCTOS -->
        </div>
        </section>
      <!-- FIN DE PRODUCTOS -->

      <!-- CONTACTANOS -->
      <!-- FIN DE CONTACTANOS -->

      <!-- FOOTER -->
      <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-3 mx-auto">
                    <div class="single-box">
                        <h2>Acceso rápido</h2>
                    <ul>
                        <li><a href="#">Inicio</a></li>
                        <li><a href="#">Agendar cita</a></li>
                        <li><a href="#">Productos</a></li>
                        <li><a href="#">Contacto</a></li>
                    </ul>
                    </div>                    
                </div>
                <div class="col-lg-3 col-sm-3 mx-auto">
                    <div class="single-box">
                        <h2>Extra links</h2>
                    <ul>
                        <li><a href="#">Mi cuenta</a></li>
                        <li><a href="#">Mis ordenes</a></li>
                        <li><a href="#">Mis citas</a></li>
                    </ul>
                    </div>                    
                </div>
                <div class="col-lg-3 col-sm-3 mx-auto">
                    <div class="single-box">
                        <h2>Información de contacto</h2>
                        <p>8713719607</p>
                        <p>SweetBeauty@gmail.com </a>
                        <p>Torreón Coahuila México - 27000</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="credit m-5 text-center">Creado por <span>Charly, José, Erick, Lizeth, Fernando</span> | all rigth reserve.</div>
    </footer>
      <!-- FIN DE FOOTER -->

      <!-- SCRIPTS -->
<script src="../js/bootstrap.bundle.min.js"></script>
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
</body>
</html>